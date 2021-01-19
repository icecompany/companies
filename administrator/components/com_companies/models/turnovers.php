<?php
use Joomla\CMS\MVC\Model\ListModel;

defined('_JEXEC') or die;

class CompaniesModelTurnovers extends ListModel
{
    public function __construct($config = array())
    {
        if (empty($config['filter_fields'])) {
            $config['filter_fields'] = array(
                'id',
                'year',
                'turnover',
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
            ->select("*")
            ->from("#__mkv_companies_turnover");

        $this->setState('list.limit', 0);

        if (is_numeric($this->companyID)) $query->where("companyID = {$db->q($this->companyID)}");

        /* Сортировка */
        $orderCol = $this->state->get('list.ordering');
        $orderDirn = $this->state->get('list.direction');
        $query->order("year DESC");

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
            $arr['year'] = $item->year;
            $arr['turnover'] = number_format((float) $item->turnover, MKV_FORMAT_DEC_COUNT, MKV_FORMAT_SEPARATOR_FRACTION, MKV_FORMAT_SEPARATOR_DEC);
            $url = JRoute::_("index.php?option={$this->option}&amp;task=turnover.edit&amp;id={$item->id}&amp;return={$return}");
            $arr['edit_link'] = JHtml::link($url, $item->year);
            $url = JRoute::_("index.php?option={$this->option}&amp;task=turnovers.delete&amp;cid[]={$item->id}&amp;return={$return}");
            $arr['delete_link'] = JHtml::link($url, JText::sprintf('COM_COMPANIES_HEAD_DELETE'));
            $result[] = $arr;
        }
        return $result;
    }

    /* Сортировка по умолчанию */
    protected function populateState($ordering = 'year', $direction = 'DESC')
    {
        parent::populateState($ordering, $direction);
    }

    private $export, $companyID;
}
