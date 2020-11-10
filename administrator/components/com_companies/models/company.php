<?php
defined('_JEXEC') or die;
use Joomla\CMS\MVC\Model\AdminModel;
use Joomla\CMS\MVC\Model\ListModel;

class CompaniesModelCompany extends AdminModel {

    public function getItem($pk = null)
    {
        $item = parent::getItem($pk);
        if ($item->id !== null && is_numeric($item->id)) {
            //Роительская компания
            $item->hidden_parent_id = $this->loadParentID((int) $item->id);
            if ($item->hidden_parent_id !== '') $item->hidden_parent_title = $this->loadParentTitle($item->hidden_parent_id);
            //Дочерние компании
            $item->children = $this->loadChildren($item->id);
            //Виды деятельности
            $item->activities = $this->loadActivities($item->id);
            //Контакты
            $item->contacts = $this->loadContacts($item->id);
            //Компании-сёстры
            $item->sisters = $this->loadSisters($item->id);
            //История участия в форумах
            $item->armies = $this->loadArmies($item->id);
            //История участия в чужих форумах
            $item->other_projects = $this->loadOtherProjects($item->id);
        }
        else {
            $app = JFactory::getApplication();
            $title = $app->getUserState("company.title");
            if (!empty($title)) {
                $item->title = $title;
                $app->setUserState("company.title", "");
            }
        }
        //Города, по умолчанию - Москва
        $legal_city = $this->loadCity(($item->legal_city !== null) ? $item->legal_city : 4400);
        $item->hidden_legal_city_id = $legal_city->id;
        $item->hidden_legal_city_title = sprintf("%s (%s)", $legal_city->city, $legal_city->region);
        $fact_city = $this->loadCity(($item->fact_city !== null) ? $item->fact_city : 4400);
        $item->hidden_fact_city_id = $fact_city->id;
        $item->hidden_fact_city_title = sprintf("%s (%s)", $fact_city->city, $fact_city->region);
        $main_office_city = $this->loadCity(($item->main_office_city !== null) ? $item->main_office_city : 4400);
        $item->hidden_main_office_city_id = $main_office_city->id;
        $item->hidden_main_office_city_title = sprintf("%s (%s)", $main_office_city->city, $main_office_city->region);

        return $item;
    }

    public function save($data)
    {
        $s1 = parent::save($data);
        $companyID = $data['id'] ?? JFactory::getDbo()->insertid();
        $s2 = $this->saveParentID((int) $companyID, (int) $data['parentID'] ?? 0);
        $s3 = $this->saveActivities((int) $companyID, (array) $data['activities'] ?? array());
        //Удаляем компанию из списка для сравнения
        $app = JFactory::getApplication();
        $complainID = $app->getUserState("company.complainID", 0);
        if ($s1 && $data['id'] === null && $complainID > 0) {
            $table = JTable::getInstance('Complain', 'TableCompanies');
            if ($table->delete($complainID)) $app->setUserState("company.complainID", '');
        }
        //Пишем в историю
        if ($s1 && $s2 && $s3) {
            $hst = [];
            $hst['managerID'] = JFactory::getUser()->id;
            $hst['itemID'] = $companyID;
            $hst['action'] = ($data['id'] !== null) ? 'update' : 'add';
            $hst['section'] = 'company';
            $hst['new_data'] = json_encode($data);
            $hst['old_data'] = '';
            if ($hst['action'] === 'update') {
                $item = parent::getItem($data['id']);
                $hst['old_data'] = json_encode($item);
            }
            JTable::addIncludePath(JPATH_ADMINISTRATOR . "/components/com_mkv/tables");
            $history = JTable::getInstance('History', 'TableMkv');
            $history->save($hst);
        }
        return $s1 && $s2 && $s3;
    }

    public function loadArmies(int $companyID)
    {
        $model = ListModel::getInstance('Armies', 'CompaniesModel', array('companyID' => $companyID));
        return $model->getItems();
    }

    public function getLinks(): array
    {
        $item = parent::getItem();
        $links = array('contact_add', 'children_add');
        if ($item->id === null) return $links;
        $return = CompaniesHelper::getReturnUrl();
        $url = JRoute::_("index.php?option={$this->option}&amp;task=contact.add&amp;companyID={$item->id}&amp;return={$return}");
        $links['contact_add'] = JHtml::link($url, JText::sprintf('COM_COMPANIES_LINK_COMPANY_ADD_CONTACT'));
        $url = JRoute::_("index.php?option={$this->option}&amp;task=parent.add&amp;parentID={$item->id}&amp;return={$return}");
        $links['parent_add'] = JHtml::link($url, JText::sprintf('COM_COMPANIES_LINK_COMPANY_ADD_CHILD'));
        $url = JRoute::_("index.php?option={$this->option}&amp;task=army.add&amp;companyID={$item->id}&amp;return={$return}");
        $links['army_add'] = JHtml::link($url, JText::sprintf('COM_COMPANIES_LINK_COMPANY_ADD_ARMY'));
        $url = JRoute::_("index.php?option={$this->option}&amp;task=otherProject.add&amp;companyID={$item->id}&amp;return={$return}");
        $links['other_project_add'] = JHtml::link($url, JText::sprintf('COM_COMPANIES_LINK_COMPANY_ADD_OTHER_PROJECT'));
        $url = JRoute::_("index.php?option={$this->option}&amp;task=client.add&amp;companyID={$item->id}&amp;return={$return}");
        $links['client_add'] = JHtml::link($url, JText::sprintf('COM_COMPANIES_LINK_COMPANY_ADD_INFO'));
        $url = JRoute::_("index.php?option={$this->option}&amp;task=cooperation.add&amp;companyID={$item->id}&amp;return={$return}");
        $links['cooperation_add'] = JHtml::link($url, JText::sprintf('COM_COMPANIES_LINK_COMPANY_ADD_INFO'));
        $url = JRoute::_("index.php?option={$this->option}&amp;task=companiesfoiv.add&amp;companyID={$item->id}&amp;return={$return}");
        $links['foiv_add'] = JHtml::link($url, JText::sprintf('COM_COMPANIES_LINK_COMPANY_ADD_INFO'));

        return $links;
    }

    public function getTable($name = 'Companies', $prefix = 'TableCompanies', $options = array())
    {
        return JTable::getInstance($name, $prefix, $options);
    }

    public function getForm($data = array(), $loadData = true)
    {
        $id = JFactory::getApplication()->input->getInt('id', 0);
        $name = "company";
        if (CompaniesHelper::canDo('core.access.dossier') && $id > 0) $name .= "_dossier";
        $form = $this->loadForm(
            "{$this->option}.company", $name, array('control' => 'jform', 'load_data' => $loadData)
        );
        if (empty($form))
        {
            return false;
        }

        //Делаем необязательные поля для заполнения из настроек компонента необязательными в форме
        $all = array('form', 'title_full', 'title_en', 'phone_1', 'phone_1_comment', 'director_name', 'director_post', 'email', 'site'); //Все поля, которые можно сделать необязательными
        $required = $this->getRequiredFields();
        foreach ($all as $item) if (!in_array($item, $required)) $form->setFieldAttribute($item, 'required', false);

        return $form;
    }

    protected function loadFormData()
    {
        $data = JFactory::getApplication()->getUserState($this->option.'.edit.company.data', array());
        if (empty($data))
        {
            $data = $this->getItem();
        }

        return $data;
    }

    protected function prepareTable($table)
    {
        $all = get_class_vars($table);
        unset($all['_errors']);
        $nulls = array('form', 'title_full', 'title_en', 'director_name', 'director_post', 'legal_index', 'legal_street', 'legal_house', 'fact_index', 'fact_street', 'fact_house',
            'phone_1', 'phone_1_additional', 'phone_1_comment', 'phone_2', 'phone_2_additional', 'phone_2_comment', 'fax', 'fax_additional', 'email', 'site', 'inn', 'kpp', 'rs', 'ks', 'bank',
            'associations', 'representations', 'branches', 'main_office_city', 'main_office_index', 'main_office_street', 'main_office_house', 'moscow_office_index', 'moscow_office_street', 'moscow_office_house',
            'targets', 'bik', 'comment'); //Поля, которые NULL
        foreach ($all as $field => $v) {
            if (empty($field)) continue;
            if (in_array($field, $nulls)) {
                if (!strlen($table->$field)) {
                    $table->$field = NULL;
                    continue;
                }
            }
            if (!empty($field)) $table->$field = trim($table->$field);
            if ($field === 'director_name' || $field === 'director_post') $table->$field = mb_convert_case($table->$field, MB_CASE_TITLE, "UTF-8");
        }

        parent::prepareTable($table);
    }

    public function saveActivities(int $companyID, array $activities = array()): bool
    {
        $current = $this->loadActivities($companyID);
        if (empty($current)) {
            if (empty($activities)) return true;
            foreach ($activities as $activityID)
                if (!$this->addActivity($companyID, $activityID)) return false;
        }
        else {
            foreach ($activities as $item)
                if (($key = array_search($item, $current)) === false)
                    if (!$this->addActivity($companyID, $item)) return false;
            foreach ($current as $item)
                if (($key = array_search($item, $activities)) === false)
                    if (!$this->deleteActivity($companyID, $item)) return false;
        }
        return true;
    }

    public function getFoivs(): array
    {
        $item = parent::getItem();
        if ($item->id === null) return [];
        $model = ListModel::getInstance('CompaniesFoivs', 'CompaniesModel', ['companyID' => $item->id, 'ignore_request' => true]);
        return $model->getItems();
    }

    public function getClients(): array
    {
        $item = parent::getItem();
        if ($item->id === null) return [];
        $model = ListModel::getInstance('Clients', 'CompaniesModel', ['companyID' => $item->id, 'ignore_request' => true]);
        return $model->getItems();
    }

    public function getCooperations(): array
    {
        $item = parent::getItem();
        if ($item->id === null) return [];
        $model = ListModel::getInstance('Cooperations', 'CompaniesModel', ['companyID' => $item->id, 'ignore_request' => true]);
        return $model->getItems();
    }

    public function getContracts(): array
    {
        $item = parent::getItem();
        if ($item->id === null) return [];
        JModelLegacy::addIncludePath(JPATH_ADMINISTRATOR . "/components/com_contracts/models", "ContractsModel");
        $model = JModelLegacy::getInstance('Contracts', 'ContractsModel', ['companyID' => $item->id, 'ignore_request' => true]);
        return $model->getItems();
    }

    public function delete(&$pks)
    {
        //Пишем историю
        JTable::addIncludePath(JPATH_ADMINISTRATOR . "/components/com_mkv/tables");
        foreach ($pks as $pk) {
            $item = parent::getItem($pk);
            $d = parent::delete($pk);
            if ($d) {
                $hst = [];
                $hst['managerID'] = JFactory::getUser()->id;
                $hst['itemID'] = $item->id;
                $hst['section'] = 'company';
                $hst['action'] = 'delete';
                $hst['old_data'] = json_encode($item);
                $hst['new_data'] = '';
                $history = JTable::getInstance('History', 'TableMkv');
                $history->save($hst);
            }
            else return false;
        }
        return true;
    }

    protected function canEditState($record)
    {
        $user = JFactory::getUser();

        if (!empty($record->id))
        {
            return $user->authorise('core.edit.state', $this->option . '.company.' . (int) $record->id);
        }
        else
        {
            return parent::canEditState($record);
        }
    }

    private function loadContacts(int $companyID): array
    {
        $model = ListModel::getInstance('Contacts', 'CompaniesModel', ['companyID' => $companyID]);
        return $model->getItems();
    }

    private function loadOtherProjects(int $companyID): array
    {
        $model = ListModel::getInstance('OtherProjects', 'CompaniesModel', ['companyID' => $companyID]);
        return $model->getItems();
    }

    private function loadActivities(int $companyID)
    {
        $model = ListModel::getInstance('Companies_activities', 'CompaniesModel', ['companyID' => $companyID]);
        $items = $model->getItems();
        $ids = array();
        foreach ($items as $item) {
            $ids[] = $item['activityID'];
        }
        return $ids;
    }

    private function addActivity(int $companyID, int $activityID): bool
    {
        $table = $this->getTable('Companies_activities', 'TableCompanies');
        $data = array('id' => null, 'companyID' => $companyID, 'activityID' => $activityID);
        return $table->save($data);
    }

    private function deleteActivity(int $companyID, int $activityID): bool
    {
        if ($companyID == 0 || $activityID == 0) return true;
        $table = $this->getTable('Companies_activities', 'TableCompanies');
        $table->load(array('companyID' => $companyID, 'activityID' => $activityID));
        return $table->delete($table->id);
    }

    public function loadSisters(int $companyID): array
    {
        $parentID = $this->loadParentID($companyID);
        return (!is_numeric($parentID)) ? array() : $this->loadChildren($parentID);
    }

    private function loadCity(int $cityID)
    {
        $table = $this->getTable('Cities');
        $table->load($cityID);
        return $table;
    }

    private function loadParentID(int $companyID)
    {
        if ($companyID <= 0) return '';
        $table = $this->getTable('Parents');
        $table->load(array('companyID' => $companyID));
        return $table->parentID ?? '';
    }

    private function saveParentID(int $companyID, int $parentID = 0): bool
    {
        if ($companyID === 0) return true;
        $table = $this->getTable('Parents');
        $table->load(array('companyID' => $companyID));
        if ($parentID > 0) {
            $arr = array('id' => $table->id ?? null, 'companyID' => $companyID, 'parentID' => $parentID);
            return $table->save($arr);
        }
        else {
            return ($table->id !== null) ? $table->delete($table->id) : true;
        }
    }

    private function loadParentTitle(int $companyID): string
    {
        if ($companyID <= 0) return '';
        $table = $this->getTable();
        $table->load($companyID);
        return $table->title ?? '';
    }

    private function loadChildren(int $companyID): array
    {
        $params = array('raw' => true, 'parentID' => $companyID);
        $model = ListModel::getInstance('Parents', 'CompaniesModel', $params);
        return $model->getItems();
    }

    private function getRequiredFields()
    {
        $config = CompaniesHelper::getConfig('settings_company_required_fields');
        return ($config !== null) ? $config : array();
    }


    public function getScript()
    {
        return 'administrator/components/' . $this->option . '/models/forms/company.js';
    }

}