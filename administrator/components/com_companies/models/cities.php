<?php

use Joomla\CMS\MVC\Model\ListModel;

defined('_JEXEC') or die;

class CompaniesModelCities extends ListModel
{
    public function __construct($config = array())
    {
        if (empty($config['filter_fields'])) {
            $config['filter_fields'] = array(
                'id',
                'is_capital',
            );
        }
        parent::__construct($config);
        $this->search = $config['search'];
    }

    protected function _getListQuery()
    {
        $db = $this->getDbo();
        $query = $db->getQuery(true);
        $query
            ->select("c.id, c.name")
            ->select("r.name as region")
            ->select("s.name as country")
            ->from("#__grph_cities c")
            ->leftJoin("#__grph_regions r on r.id = c.region_id")
            ->leftJoin("#__grph_countries s on s.id = r.country_id")
            ->order("c.is_capital DESC");
        if (!empty($this->search) && strlen($this->search) > 1) {
            $q = $db->q("{$this->search}%");
            $query->where("c.name like {$q}");
        }
        $this->setState('list.limit', 0);

        return $query;
    }

    public function getItems()
    {
        $items = parent::getItems();
        $result = array();
        foreach ($items as $item) {
            $arr = array();
            $arr['id'] = $item->id;
            $arr['region'] = $item->region;
            $arr['country'] = $item->country;
            $arr['name'] = $item->name;
            $result[] = $arr;
        }
        return $result;
    }

    private $search;

}