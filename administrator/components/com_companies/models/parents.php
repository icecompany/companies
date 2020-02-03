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
            ->select("p.id as itemID, p.companyID, p.parentID")
            ->select("c.*")
            ->from("#__mkv_companies_parents p")
            ->leftJoin("#__mkv_companies c on c.id = p.companyID");
        if ($this->companyID == 0 && $this->parentID > 0) {
            $query
                ->where("p.parentID = {$this->parentID}")
                ->order("c.title");
        }
        $this->setState('list.limit', 0);

        return $query;
    }

    public function getItems()
    {
        $items = parent::getItems();
        $result = array();
        $return = CompaniesHelper::getReturnUrl();
        $token = JSession::getFormToken();
        foreach ($items as $item) {
            $arr = array();
            $arr['id'] = $item->itemID;
            $arr['companyID'] = $item->companyID;
            $arr['parentID'] = $item->parentID;
            $arr['title'] = $item->title;
            $url = JRoute::_("index.php?option=com_companies&amp;task=company.edit&amp;id={$item->companyID}&amp;return={$return}");
            $params = array('target' => '_blank');
            $arr['edit_link'] = JHtml::link($url, $item->title, $params);
            $url = JRoute::_("index.php?option=com_companies&amp;{$token}=1&amp;task=parents.delete&amp;cid[]={$item->itemID}");
            $arr['delete_link'] = JHtml::link($url, JText::sprintf('COM_COMPANIES_LINK_COMPANY_DELETE_CHILD'));
            $result[] = $arr;
        }
        return $result;
    }

    private $export, $companyID, $parentID;

}