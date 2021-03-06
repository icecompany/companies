<?php
use Joomla\CMS\MVC\Model\ListModel;

defined('_JEXEC') or die;

class CompaniesModelActivities extends ListModel
{
    public function __construct($config = array())
    {
        if (empty($config['filter_fields'])) {
            $config['filter_fields'] = array(
                'id',
                'title',
                'for_contractor', 'contractor',
                'for_ndp', 'ndp',
                'weight',
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
            ->select("id, title, for_contractor, for_ndp, weight")
            ->from("#__mkv_activities");
        /* Поиск */
        $search = $this->getState('filter.search');
        if (!empty($search)) {
            $text = $db->q("%{$search}%");
            $query->where("title like {$text}");
        }

        //Фильтр по подрядчикам
        $contractor = $this->getState('filter.contractor');
        if (is_numeric($contractor)) {
            $contractor = $db->q($contractor);
            $query->where("for_contractor = {$contractor}");
        }

        //Фильтр по НДП
        $ndp = $this->getState('filter.ndp');
        if (is_numeric($ndp)) {
            $ndp = $db->q($ndp);
            $query->where("for_ndp = {$ndp}");
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
            $arr['weight'] = $item->weight;
            $arr['for_contractor'] = JText::sprintf((!$item->for_contractor) ? 'JNO' : 'JYES');
            $arr['for_ndp'] = JText::sprintf((!$item->for_ndp) ? 'JNO' : 'JYES');
            $result['items'][] = $this->prepare($arr);
        }
        return $result;
    }

    private function prepare(array $item): array
    {
        if (!$this->export) {
            $canDo = true;
            if ($canDo) {
                $url = JRoute::_("index.php?option={$this->option}&amp;task=activity.edit&amp;id={$item['id']}");
                $title = $item['title'];
                $params = array('title' => $item['title'] ?? '');
                $item['title'] = JHtml::link($url, $title, $params);
            }
            $url = JRoute::_("index.php?option={$this->option}&amp;view=companies&amp;filter_activity={$item['id']}&amp;filter_state=");
            $options = array('target' => '_blank');
            $item['link_find'] = JHtml::link($url, JText::sprintf('COM_COMPANIES_LINK_ACTIVITIES_FIND_COMPANIES'), $options);
        }
        return $item;
    }

    /* Сортировка по умолчанию */
    protected function populateState($ordering = 'weight', $direction = 'asc')
    {
        $search = $this->getUserStateFromRequest($this->context . '.filter.search', 'filter_search');
        $this->setState('filter.search', $search);
        $contractor = $this->getUserStateFromRequest($this->context . '.filter.contractor', 'filter_contractor', '', 'string');
        $this->setState('filter.contractor', $contractor);
        $ndp = $this->getUserStateFromRequest($this->context . '.filter.ndp', 'filter_ndp', '', 'string');
        $this->setState('filter.ndp', $ndp);
        parent::populateState($ordering, $direction);
        CompaniesHelper::check_refresh();
    }

    protected function getStoreId($id = '')
    {
        $id .= ':' . $this->getState('filter.search');
        $id .= ':' . $this->getState('filter.contractor');
        $id .= ':' . $this->getState('filter.ndp');
        return parent::getStoreId($id);
    }

    private $export;
}
