<?php

use Joomla\CMS\MVC\Model\ListModel;

defined('_JEXEC') or die;

class CompaniesModelCompaniesFoivs extends ListModel
{
    public function __construct($config = array())
    {
        if (empty($config['filter_fields'])) {
            $config['filter_fields'] = array(
                'id',
                'f.title',
                'company',
            );
        }
        $this->export = false;
        $this->companyID = $config['companyID'] ?? null;
        $this->foivID = $config['foivID'] ?? null;
        parent::__construct($config);
    }

    protected function _getListQuery()
    {
        $db = $this->getDbo();
        $query = $db->getQuery(true);
        $query
            ->select("cf.id, cf.companyID, cf.foivID, cf.department, cf.comment")
            ->select("f.title as foiv")
            ->select("e.title as company")
            ->from("#__mkv_companies_foivs cf")
            ->leftJoin("#__mkv_foivs f on f.id = cf.foivID")
            ->leftJoin("#__mkv_companies e on e.id = cf.companyID")
            ->order("f.title");

        if ($this->companyID !== null) {
            if (is_numeric($this->companyID)) {
                $query->where("cf.companyID = {$db->q($this->companyID)}");
            }
            if (is_array($this->companyID)) {
                $cids = implode(', ', $this->companyID);
                if (!empty($cids)) $query->where("cf.companyID in ({$cids})");
            }
        }

        if ($this->foivID !== null) {
            if (is_numeric($this->foivID)) {
                $query->where("cf.foivID = {$db->q($this->foivID)}");
            }
            if (is_array($this->foivID)) {
                $cids = implode(', ', $this->foivID);
                if (!empty($cids)) $query->where("cf.foivID in ({$cids})");
            }
        }

        $this->setState('list.limit', 0);

        return $query;
    }

    public function getItems()
    {
        $items = parent::getItems();
        $result = [];
        $return = CompaniesHelper::getReturnUrl();
        foreach ($items as $item) {
            $arr = [];
            $arr['id'] = $item->id;
            $url = JRoute::_("index.php?option={$this->option}&amp;task=companiesfoiv.edit&amp;id={$item->id}&amp;return={$return}");
            $arr['edit_link'] = JHtml::link($url, ($this->companyID !== null) ? $item->foiv : $item->company);
            $url = JRoute::_("index.php?option={$this->option}&amp;task=companiesfoivs.delete&amp;cid[]={$item->id}");
            $arr['delete_link'] = JHtml::link($url, JText::sprintf('COM_COMPANIES_HEAD_DELETE'));
            $arr['companyID'] = $item->companyID;
            $arr['company'] = $item->company;
            $arr['foiv'] = $item->foiv;
            $arr['department'] = $item->department;
            $arr['comment'] = $item->comment;
            $arr['foivID'] = $item->foivID;
            $result[] = $arr;
        }
        return $result;
    }

    private $export, $companyID, $foivID;

}