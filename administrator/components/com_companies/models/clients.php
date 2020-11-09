<?php
use Joomla\CMS\MVC\Model\ListModel;

defined('_JEXEC') or die;

class CompaniesModelClients extends ListModel
{
    public function __construct($config = array())
    {
        if (empty($config['filter_fields'])) {
            $config['filter_fields'] = array(
                'd.title',
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
            ->select("cl.id, cl.companyID, cl.clientID")
            ->select("p.title as parent")
            ->select("d.title as client")
            ->from("#__mkv_companies_clients cl")
            ->leftJoin("#__mkv_companies as p on p.id = cl.companyID")
            ->leftJoin("#__mkv_companies as d on d.id = cl.clientID");

        $this->setState('list.limit', 0);

        if (is_numeric($this->companyID)) $query->where("(cl.companyID = {$db->q($this->companyID)} or cl.clientID = {$db->q($this->companyID)})");

        /* Сортировка */
        $query->order("d.title ASC");

        return $query;
    }

    public function getItems()
    {
        $items = parent::getItems();
        $result = ['client' => [], 'parent' => []];
        $return = CompaniesHelper::getReturnUrl();
        foreach ($items as $item) {
            $arr = [];
            $arr['id'] = $item->id;
            $url_parent = JRoute::_("index.php?option={$this->option}&amp;task=company.edit&amp;id={$item->companyID}&amp;return={$return}");
            $url_client = JRoute::_("index.php?option={$this->option}&amp;task=company.edit&amp;id={$item->clientID}&amp;return={$return}");
            $type = ($item->companyID != $this->companyID) ? 'parent' : 'client';
            $arr['company_link'] = JHtml::link(($item->companyID != $this->companyID) ? $url_parent : $url_client, ($item->companyID != $this->companyID) ? $item->parent : $item->client);
            $url = JRoute::_("index.php?option={$this->option}&amp;task=clients.delete&amp;cid[]={$item->id}&amp;return={$return}");
            $arr['delete_link'] = JHtml::link($url, JText::sprintf('COM_COMPANIES_HEAD_DELETE'));
            $result[$type][] = $arr;
        }
        return $result;
    }

    /* Сортировка по умолчанию */
    protected function populateState($ordering = 'd.title', $direction = 'ASC')
    {
        parent::populateState($ordering, $direction);
    }

    private $export, $companyID;
}
