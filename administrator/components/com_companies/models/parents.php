<?php
use Joomla\CMS\MVC\Model\ListModel;
defined('_JEXEC') or die;

class CompaniesModelParents extends ListModel
{
    public function __construct($config = array())
    {
        if (empty($config['filter_fields'])) {
            $config['filter_fields'] = array(
                'id',
                'companyID',
                'parentID',
            );
        }
        $this->export = false;
        $this->companyID = (!isset($config['companyID'])) ? 0 : $config['companyID'];
        $this->parentID = (!isset($config['parentID'])) ? 0 : $config['parentID'];
        parent::__construct($config);
    }

    protected function _getListQuery()
    {
        $db = $this->getDbo();
        $query = $db->getQuery(true);
        $query
            ->select("id, companyID, parentID")
            ->from("#__mkv_companies_parents");
        if ($this->companyID > 0 && $this->parentID == 0) $query->where("companyID = {$this->companyID}");
        if ($this->companyID == 0 && $this->parentID > 0) $query->where("parentID = {$this->parentID}");
        $this->setState('list.limit', 0);

        return $query;
    }

    public function getItems()
    {
        $items = parent::getItems();
        $result = array();
        if ($this->companyID == 0 && $this->parentID > 0) {
            return $items[0]->companyID;
        }
        foreach ($items as $item) {
            if ($this->companyID > 0 && $this->parentID == 0) {
                $result[] = $item->parentID;
            }
            else {
                $arr = array();
                $arr['id'] = $item->id;
                $arr['companyID'] = $item->companyID;
                $arr['parentID'] = $item->parentID;
                $result[] = $arr;
            }
        }
        return $result;
    }

    private $export, $companyID, $parentID;

}