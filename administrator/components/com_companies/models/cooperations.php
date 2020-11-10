<?php
use Joomla\CMS\MVC\Model\ListModel;

defined('_JEXEC') or die;

class CompaniesModelCooperations extends ListModel
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
            ->select("c1.name as city_parent")
            ->select("c2.name as city_client")
            ->from("#__mkv_companies_cooperation cl")
            ->leftJoin("#__mkv_companies as p on p.id = cl.companyID")
            ->leftJoin("#__mkv_companies as d on d.id = cl.clientID")
            ->leftJoin("#__grph_cities c1 on c1.id = p.fact_city")
            ->leftJoin("#__grph_cities c2 on c2.id = d.fact_city");

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
            $arr['activities'] = $this->getActivities(($item->companyID != $this->companyID) ? $item->companyID : $item->clientID);
            $arr['contracts'] = $this->getContracts(($item->companyID != $this->companyID) ? $item->companyID : $item->clientID);
            $arr["city"] = ($item->companyID != $this->companyID) ? $item->city_parent : $item->city_client;
            $arr['company_link'] = JHtml::link(($item->companyID != $this->companyID) ? $url_parent : $url_client, ($item->companyID != $this->companyID) ? $item->parent : $item->client);
            $url = JRoute::_("index.php?option={$this->option}&amp;task=cooperations.delete&amp;cid[]={$item->id}&amp;return={$return}");
            $arr['delete_link'] = JHtml::link($url, JText::sprintf('COM_COMPANIES_HEAD_DELETE'));
            $result[$type][] = $arr;
        }
        return $result;
    }

    private function getActivities(int $companyID): array
    {
        $am = ListModel::getInstance('Companies_Activities', 'CompaniesModel', ['companyID' => $companyID]);
        $activities = $am->getItems();
        $result = [];
        if (empty($activities)) return [];
        foreach ($activities as $activity) {
            $table = JTable::getInstance('Activities', 'TableCompanies');
            $table->load($activity['activityID']);
            $result[] = $table->title;
        }
        return $result;
    }

    private function getContracts(int $companyID): array
    {
        JModelLegacy::addIncludePath(JPATH_ADMINISTRATOR . "/components/com_contracts/models", "ContractsModel");
        $model = JModelLegacy::getInstance('Contracts', 'ContractsModel', ['companyID' => $companyID, 'ignore_request' => true]);
        return $model->getItems();
    }


    /* Сортировка по умолчанию */
    protected function populateState($ordering = 'd.title', $direction = 'ASC')
    {
        parent::populateState($ordering, $direction);
    }

    private $export, $companyID;
}
