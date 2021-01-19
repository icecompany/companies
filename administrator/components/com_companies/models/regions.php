<?php
use Joomla\CMS\MVC\Model\ListModel;

defined('_JEXEC') or die;

class CompaniesModelRegions extends ListModel
{
    public function __construct($config = array())
    {
        if (empty($config['filter_fields'])) {
            $config['filter_fields'] = array(
                'id',
                'struct',
            );
        }
        parent::__construct($config);
        $input = JFactory::getApplication()->input;
        $this->export = ($input->getString('task', 'display') !== 'export') ? false : true;
        $this->companyID = $config['companyID'];
    }

    protected function _getListQuery()
    {
        $db = $this->getDbo();
        $query = $db->getQuery(true);

        $query
            ->select("cr.id, cr.companyID, cr.struct, cr.comment, rr.title as region")
            ->from("#__mkv_companies_regions cr")
            ->leftJoin("#__russian_regions rr on rr.id = cr.regionID");

        $this->setState('list.limit', 0);

        if (is_numeric($this->companyID)) $query->where("cr.companyID = {$db->q($this->companyID)}");

        /* Сортировка */
        $orderCol = $this->state->get('list.ordering');
        $orderDirn = $this->state->get('list.direction');
        $query->order("rr.title ASC");

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
            $arr['region'] = $item->region;
            $arr['struct'] = $item->struct;
            $arr['comment'] = $item->comment;
            $url = JRoute::_("index.php?option={$this->option}&amp;task=region.edit&amp;id={$item->id}&amp;return={$return}");
            $arr['edit_link'] = JHtml::link($url, $item->region);
            $url = JRoute::_("index.php?option={$this->option}&amp;task=regions.delete&amp;cid[]={$item->id}&amp;return={$return}");
            $arr['delete_link'] = JHtml::link($url, JText::sprintf('COM_COMPANIES_HEAD_DELETE'));
            $result[] = $arr;
        }
        return $result;
    }

    /* Сортировка по умолчанию */
    protected function populateState($ordering = 'rr.title', $direction = 'ASC')
    {
        parent::populateState($ordering, $direction);
    }

    private $export, $companyID;
}
