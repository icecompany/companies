<?php
use Joomla\CMS\MVC\Model\ListModel;

defined('_JEXEC') or die;

class CompaniesModelCompanies extends ListModel
{
    public function __construct($config = array())
    {
        if (empty($config['filter_fields'])) {
            $config['filter_fields'] = array(
                'e.id',
                'contractor',
                'ndp',
                'e.title', 'search',
                'search',
                'city',
                'manager',
            );
        }
        parent::__construct($config);
        $input = JFactory::getApplication()->input;
        $this->export = ($input->getString('task', 'display') !== 'export') ? false : true;
    }

    protected function _getListQuery()
    {
        $db = $this->getDbo();
        $query = $db->getQuery(true);

        /* Сортировка */
        $orderCol = $this->state->get('list.ordering');
        $orderDirn = $this->state->get('list.direction');

        $query
            ->select("e.id, e.title, e.title_full, e.title_en")
            ->select("u.name as manager, l.userID as managerID")
            ->select("r.name as city")
            ->from("#__mkv_companies e")
            ->leftJoin("#__prj_user_action_log l on l.itemID = e.id and l.action = 'add' and l.section = 'exhibitor'")
            ->leftJoin("#__users u on u.id = l.userID")
            ->leftJoin("#__grph_cities as r ON r.id = e.legal_city");
        /* Поиск */
        $search = $this->getState('filter.search');
        if (!empty($search)) {
            if (stripos($search, 'id:') !== false) { //Поиск по ID
                $id = explode(':', $search);
                $id = $id[1];
                if (is_numeric($id)) {
                    $id = $db->q($id);
                    $query->where("e.id = {$id}");
                }
            }
            else {
                $type = CompaniesHelper::getConfig('settings_search_algorithm', 'fulltext');
                if ($type === 'fulltext') { //Полнотекстовый поиск
                    $text = $db->q($search);
                    $query
                        ->select("match(title, title_full, title_en) against ({$text}) as score")
                        ->where("match(title, title_full, title_en) against ({$text})");
                    $orderCol = "score";
                }
                if ($type === 'simple') { //Обычный поиск
                    $text = $db->q("%{$search}%");
                    $query->where("(e.title like {$text} or e.title_full like {$text} or e.title_en like {$text} or e.inn like {$text})");
                }
            }
        }

        $query->order($db->escape($orderCol . ' ' . $orderDirn));

        return $query;
    }

    public function getItems()
    {
        $items = parent::getItems();
        $result = array('items' => array());
        foreach ($items as $item) {
            $arr = array();
            $arr['id'] = $item->id;
            $arr['title'] = $item->title;
            $arr['title_full'] = $item->title_full;
            $arr['title_en'] = $item->title_en;
            $arr['city'] = $item->city;
            $arr['managerID'] = $item->managerID;
            $arr['manager'] = $item->manager ?? JText::sprintf('COM_COMPANIES_MESSAGE_UNKNOWN');
            $result['items'][] = $this->prepare($arr);
        }
        return $result;
    }

    private function prepare(array $item): array
    {
        if (!$this->export) {
            $managerID = JFactory::getUser()->id;
            $canDo = (CompaniesHelper::canDo('core.edit.value') || (!CompaniesHelper::canDo('core.edit.value') && CompaniesHelper::canDo('core.edit.own') && $item['managerID'] == $managerID));
            if ($canDo) {
                $url = JRoute::_("index.php?option={$this->option}&amp;task=company.edit&amp;id={$item['id']}");
                $title = $item['title'];
                $params = array('title' => $item['title_full'] ?? '');
                $item['title'] = JHtml::link($url, $title, $params);
            }
        }
        return $item;
    }

    /* Сортировка по умолчанию */
    protected function populateState($ordering = 'e.id', $direction = 'asc')
    {
        $search = $this->getUserStateFromRequest($this->context . '.filter.search', 'filter_search');
        $this->setState('filter.search', $search);
        $activity = $this->getUserStateFromRequest($this->context . '.filter.activity', 'filter_activity', '', 'string');
        $this->setState('filter.state', $activity);
        $city = $this->getUserStateFromRequest($this->context . '.filter.city', 'filter_city', '', 'string');
        $this->setState('filter.city', $city);
        $projectinactive = $this->getUserStateFromRequest($this->context . '.filter.projectinactive', 'filter_projectinactive', '', 'string');
        $this->setState('filter.projectinactive', $projectinactive);
        $projectactive = $this->getUserStateFromRequest($this->context . '.filter.projectactive', 'filter_projectactive', '', 'string');
        $this->setState('filter.projectactive', $projectactive);
        parent::populateState($ordering, $direction);
    }

    protected function getStoreId($id = '')
    {
        $id .= ':' . $this->getState('filter.search');
        $id .= ':' . $this->getState('filter.activity');
        $id .= ':' . $this->getState('filter.city');
        $id .= ':' . $this->getState('filter.projectinactive');
        $id .= ':' . $this->getState('filter.projectactive');
        return parent::getStoreId($id);
    }

    private $export;
}
