<?php

use Joomla\CMS\MVC\Model\ListModel;

defined('_JEXEC') or die;

class CompaniesModelComplain extends ListModel
{
    public function __construct($config = array())
    {
        if (empty($config['filter_fields'])) {
            $config['filter_fields'] = array(
                'id',
                'old_title',
                'search',
                'percent',
            );
        }
        $this->export = false;
        parent::__construct($config);
    }

    protected function _getListQuery()
    {
        $db = $this->getDbo();
        $query = $db->getQuery(true);
        $query
            ->select("*")
            ->from("#__mkv_companies_complain");

        /* Поиск */
        $search = $this->getState('filter.search');
        if (!empty($search)) {
            $search = $this->_db->q("%{$search}%");
            $query->where("(old_title LIKE {$search})");
        }

        /* Сортировка */
        $orderCol = $this->state->get('list.ordering');
        $orderDirn = $this->state->get('list.direction');
        $query->order($db->escape($orderCol . ' ' . $orderDirn));

        return $query;
    }

    public function getItems()
    {
        $items = parent::getItems();
        $result = array();
        foreach ($items as $item) {
            $arr = array();
            $arr['id'] = $item->id;
            $arr['old_title'] = $item->old_title;
            $arr['complain'] = $this->complain($item->old_title);
            $result[] = $arr;
        }

        return $result;
    }

    private function complain(string $text)
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $text = $db->q($text);
        $percent = $this->state->get('filter.percent', 20);
        $return = CompaniesHelper::getReturnUrl();
        $query
            ->select("id, title, match(title) against ({$text}) as complain")
            ->from("#__mkv_companies")
            ->where("match(title) against ({$text}) >= {$percent}");
        $result = $db->setQuery($query)->loadAssocList();
        if (empty($result)) return [];
        foreach ($result as $i => $item) {
            $url = JRoute::_("index.php?option=com_companies&amp;task=company.edit&amp;id={$item['id']}&amp;return={$return}");
            $result[$i]['company_link'] = JHtml::link($url, $item['title']);
            $result[$i]['percent'] = sprintf("%s%%", round((float) $item['complain']));
        }
        return $result;
    }

    /* Сортировка по умолчанию */
    protected function populateState($ordering = 'old_title', $direction = 'asc')
    {
        $search = $this->getUserStateFromRequest($this->context . '.filter.search', 'filter_search');
        $this->setState('filter.search', $search);
        $percent = $this->getUserStateFromRequest($this->context . '.filter.percent', 'filter_percent', 20, false);
        $this->setState('filter.percent', $percent);
        parent::populateState($ordering, $direction);
        CompaniesHelper::check_refresh();
    }

    protected function getStoreId($id = '')
    {
        $id .= ':' . $this->getState('filter.search');
        $id .= ':' . $this->getState('filter.percent');
        return parent::getStoreId($id);
    }

    private $export;

}