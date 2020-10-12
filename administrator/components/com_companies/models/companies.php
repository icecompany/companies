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
                'activity',
                'in_project',
                'not_in_project',
                'state',
            );
        }
        parent::__construct($config);
        $input = JFactory::getApplication()->input;
        $this->export = ($input->getString('format', 'html') === 'html') ? false : true;
        $this->not = (int) $input->getInt('not', 0);
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
            ->select("r.name as city")
            ->from("#__mkv_companies e")
            ->leftJoin("#__grph_cities as r ON r.id = e.legal_city");
        /* Поиск */
        $search = (!$this->export) ? $this->getState('filter.search') : JFactory::getApplication()->input->getString('search', '');
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
        //Фильтр по виду деятельности
        $activity = $this->getState('filter.activity');
        if (is_numeric($activity))
        {
            $params = array('activityID' => $activity);
            $model = ListModel::getInstance('Companies_activities', 'CompaniesModel', $params);
            $items = $model->getItems();
            $ids = array();
            foreach ($items as $item) $ids[] = $item['companyID'];
            $ids = implode(', ', $ids);
            $query->where("e.id in ({$ids})");
        }
        //Фильтр по состоянию
        $state = $this->getState('filter.state');
        if (is_numeric($state))
        {
            $state = $db->q($state);
            $query->where("e.published = {$state}");
        }
        else {
            $query->where("e.published = 1");
        }
        //Отсеиваем текущую компанию (для AJAX-запросов)
        if ($this->export) {
            if ($this->not > 0){
                $not = $db->q($this->not);
                $query->where("e.id <> {$not}");
            }
        }
        else {
            $in_project = $this->getState('filter.in_project');
            if (is_numeric($in_project)) {
                $query
                    ->select("cip.id as contractID_in_project")
                    ->select("sip.title as status_in_project")
                    ->leftJoin("#__mkv_contracts cip on cip.companyID = e.id")
                    ->leftJoin("#__mkv_contract_statuses sip on sip.code = cip.status")
                    ->where("(cip.projectID = {$this->_db->q($in_project)} and cip.id is not null)");
            }
            $not_in_project = $this->getState('filter.not_in_project');
            if (is_numeric($not_in_project)) {
                $ids = $this->getCompaniesInProject($not_in_project);
                if (!empty($ids)) $query->where("e.id not in ({$ids})");
            }
        }
        //Ограничение длины списка
        $limit = (!$this->export) ? $this->getState('list.limit') : 0;
        $this->setState('list.limit', $limit);

        $query->order($db->escape($orderCol . ' ' . $orderDirn));

        return $query;
    }

    public function getItems()
    {
        $items = parent::getItems();
        $result = array('items' => array());
        $return = CompaniesHelper::getReturnUrl();
        foreach ($items as $item) {
            $arr = array();
            $arr['id'] = $item->id;
            $arr['title'] = $item->title;
            $arr['title_full'] = $item->title_full;
            $arr['title_en'] = $item->title_en;
            $arr['city'] = $item->city;
            if (is_numeric($this->state->get('filter.in_project'))) {
                $url = JRoute::_("index.php?option=com_contracts&amp;task=contract.edit&amp;id={$item->contractID_in_project}&amp;return={$return}");
                $arr['in_project'] = JHtml::link($url, $item->status_in_project ?? JText::sprintf('COM_MKV_STATUS_IN_PROJECT'));
            }
            $arr['manager'] = $item->manager ?? JText::sprintf('COM_COMPANIES_MESSAGE_UNKNOWN');
            $result['items'][] = $this->prepare($arr);
        }
        return $result;
    }

    private function getCompaniesInProject(int $projectID): string
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query
            ->select("distinct companyID")
            ->from("#__mkv_contracts")
            ->where("projectID = {$db->q($projectID)}");
        $result = $db->setQuery($query)->loadColumn();
        return (!empty($result)) ? implode(', ', $result) : '';
    }

    private function prepare(array $item): array
    {
        if (!$this->export) {
            $url = JRoute::_("index.php?option={$this->option}&amp;task=company.edit&amp;id={$item['id']}");
            $title = $item['title'];
            $params = array('title' => $item['title_full'] ?? '');
            $item['title'] = JHtml::link($url, $title, $params);
        }
        else {
            $remove = array('title_full', 'title_en', 'managerID', 'manager'); //Удаляемые поля
            foreach ($remove as $param) unset($item[$param]);
        }
        return $item;
    }

    /* Сортировка по умолчанию */
    protected function populateState($ordering = 'e.id', $direction = 'DESC')
    {
        $search = $this->getUserStateFromRequest($this->context . '.filter.search', 'filter_search');
        $this->setState('filter.search', $search);
        $activity = $this->getUserStateFromRequest($this->context . '.filter.activity', 'filter_activity', '', 'string');
        $this->setState('filter.activity', $activity);
        $state = $this->getUserStateFromRequest($this->context . '.filter.state', 'filter_state', '', 'string');
        $this->setState('filter.state', $state);
        $city = $this->getUserStateFromRequest($this->context . '.filter.city', 'filter_city', '', 'string');
        $this->setState('filter.city', $city);
        $in_project = $this->getUserStateFromRequest($this->context . '.filter.in_project', 'filter_in_project', '', 'string');
        $this->setState('filter.in_project', $in_project);
        $not_in_project = $this->getUserStateFromRequest($this->context . '.filter.not_in_project', 'filter_not_in_project', '', 'string');
        $this->setState('filter.not_in_project', $not_in_project);
        parent::populateState($ordering, $direction);
        CompaniesHelper::check_refresh();
    }

    protected function getStoreId($id = '')
    {
        $id .= ':' . $this->getState('filter.search');
        $id .= ':' . $this->getState('filter.activity');
        $id .= ':' . $this->getState('filter.state');
        $id .= ':' . $this->getState('filter.city');
        $id .= ':' . $this->getState('filter.in_project');
        $id .= ':' . $this->getState('filter.not_in_project');
        return parent::getStoreId($id);
    }

    private $export, $not;
}
