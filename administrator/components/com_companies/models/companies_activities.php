<?php

use Joomla\CMS\MVC\Model\ListModel;

defined('_JEXEC') or die;

class CompaniesModelCompanies_activities extends ListModel
{
    public function __construct($config = array())
    {
        if (empty($config['filter_fields'])) {
            $config['filter_fields'] = array(
                'id',
                'companyID',
                'activityID',
            );
        }
        $this->export = false;
        $this->companyID = (!isset($config['companyID'])) ? 0 : $config['companyID'];
        $this->activityID = (!isset($config['activityID'])) ? 0 : $config['activityID'];
        parent::__construct($config);
    }

    protected function _getListQuery()
    {
        $db = $this->getDbo();
        $query = $db->getQuery(true);
        $query
            ->select("a.id, a.companyID, a.activityID")
            ->from("#__mkv_companies_activities a");
        if ($this->companyID == 0 && $this->activityID > 0) {
            $query
                ->where("a.activityID = {$this->activityID}");
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
            $arr['companyID'] = $item->companyID;
            $arr['activityID'] = $item->activityID;
            $result[] = $arr;
        }
        return $result;
    }

    private $export, $companyID, $activityID;

}