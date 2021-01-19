<?php
use Joomla\CMS\MVC\Model\ListModel;

defined('_JEXEC') or die;

class CompaniesModelOtherProjects extends ListModel
{
    public function __construct($config = array())
    {
        if (empty($config['filter_fields'])) {
            $config['filter_fields'] = array(
                'id',
                'title',
                'year',
                'finances',
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
            ->select("id, companyID, year, title")
            ->from("#__mkv_companies_projects_other");

        $this->setState('list.limit', 0);

        if (is_numeric($this->companyID)) $query->where("companyID = {$db->q($this->companyID)}");

        /* Сортировка */
        $orderCol = $this->state->get('list.ordering');
        $orderDirn = $this->state->get('list.direction');
        $query->order($db->escape($orderCol . ' ' . $orderDirn));

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
            $arr['title'] = $item->title;
            $url = JRoute::_("index.php?option={$this->option}&amp;task=otherProject.edit&amp;id={$item->id}&amp;return={$return}");
            $arr['edit_link'] = JHtml::link($url, $item->title);
            $url = JRoute::_("index.php?option={$this->option}&amp;task=otherProjects.delete&amp;cid[]={$item->id}&amp;return={$return}");
            $arr['delete_link'] = JHtml::link($url, JText::sprintf('COM_COMPANIES_HEAD_OTHER_PROJECT_DELETE'));
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
