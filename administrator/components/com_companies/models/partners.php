<?php
use Joomla\CMS\MVC\Model\ListModel;

defined('_JEXEC') or die;

class CompaniesModelPartners extends ListModel
{
    public function __construct($config = array())
    {
        if (empty($config['filter_fields'])) {
            $config['filter_fields'] = array(
                'e1.title',
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
            ->select("p.id, p.company_1_ID, p.company_2_ID, p.type, p.comment")
            ->select("e1.title as company_1")
            ->select("e2.title as company_2")
            ->select("c1.name as city_1")
            ->select("c2.name as city_2")
            ->from("#__mkv_companies_partners p")
            ->leftJoin("#__mkv_companies as e1 on e1.id = p.company_1_ID")
            ->leftJoin("#__mkv_companies as e2 on e2.id = p.company_2_ID")
            ->leftJoin("#__grph_cities c1 on c1.id = e1.fact_city")
            ->leftJoin("#__grph_cities c2 on c2.id = e2.fact_city");

        $this->setState('list.limit', 0);

        if (is_numeric($this->companyID)) $query->where("(p.company_1_ID = {$db->q($this->companyID)} or p.company_2_ID = {$db->q($this->companyID)})");

        /* Сортировка */
        $query->order("e1.title ASC");

        return $query;
    }

    public function getItems()
    {
        $items = parent::getItems();
        $result = ['partner' => [], 'competitor' => []];
        $return = CompaniesHelper::getReturnUrl();
        foreach ($items as $item) {
            $arr = [];
            $arr['id'] = $item->id;
            $arr['comment'] = $item->comment;
            $company_1 = JRoute::_("index.php?option={$this->option}&amp;task=company.edit&amp;id={$item->company_1_ID}&amp;return={$return}");
            $company_2 = JRoute::_("index.php?option={$this->option}&amp;task=company.edit&amp;id={$item->company_2_ID}&amp;return={$return}");
            $need_id = ($this->companyID != $item->company_1_ID) ? $item->company_1_ID : $item->company_2_ID;
            $arr['activities'] = $this->getActivities($need_id);
            $arr['contracts'] = $this->getContracts($need_id);
            $arr["city"] = ($this->companyID != $item->company_1_ID) ? $item->city_1 : $item->city_2;
            $arr["title"] = ($this->companyID != $item->company_1_ID) ? $item->company_1 : $item->company_2;
            $arr['company_link'] = JHtml::link(($this->companyID != $item->company_1_ID) ? $company_1 : $company_2, ($this->companyID != $item->company_1_ID) ? $item->company_1 : $item->company_2);
            $url = JRoute::_("index.php?option={$this->option}&amp;task=partners.delete&amp;cid[]={$item->id}&amp;return={$return}");
            $arr['delete_link'] = JHtml::link($url, JText::sprintf('COM_COMPANIES_HEAD_DELETE'));
            $result[$item->type][] = $arr;
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
    protected function populateState($ordering = 'e1.title', $direction = 'ASC')
    {
        parent::populateState($ordering, $direction);
    }

    private $export, $companyID;
}
