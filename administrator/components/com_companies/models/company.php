<?php
defined('_JEXEC') or die;
use Joomla\CMS\MVC\Model\AdminModel;
use Joomla\CMS\MVC\Model\ListModel;

class CompaniesModelCompany extends AdminModel {

    public function getItem($pk = null)
    {
        $item = parent::getItem($pk);
        if ($item->id !== null && is_numeric($item->id)) {
            $item->hidden_parent_id = $this->loadParentID((int) $item->id);
            if ($item->hidden_parent_id !== '') $item->hidden_parent_title = $this->loadParentTitle($item->hidden_parent_id);
        }
        return $item;
    }

    private function loadChildren(int $id): array
    {
        if ($id <= 0) return array();
        $model = ListModel::getInstance('Parents', 'CompaniesModel', array('companyID' => $id));
        return $model->getItems();
    }

    private function loadParentID(int $companyID)
    {
        if ($companyID <= 0) return '';
        $table = $this->getTable('Parents');
        $table->load(array('companyID' => $companyID));
        return $table->parentID ?? '';
    }

    private function loadParentTitle(int $companyID): string
    {
        if ($companyID <= 0) return '';
        $table = $this->getTable();
        $table->load($companyID);
        return $table->title ?? '';
    }

    public function getTable($name = 'Companies', $prefix = 'TableCompanies', $options = array())
    {
        return JTable::getInstance($name, $prefix, $options);
    }

    public function getForm($data = array(), $loadData = true)
    {
        $form = $this->loadForm(
            $this->option.'.company', 'company', array('control' => 'jform', 'load_data' => $loadData)
        );
        if (empty($form))
        {
            return false;
        }

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
        $nulls = array('form', 'title_full', 'title_en', 'director_name', 'director_post', 'legal_index', 'legal_street', 'legal_house', 'fact_index', 'fact_street', 'fact_house',
            'phone_1', 'phone_1_comment', 'phone_2', 'phone_2_comment', 'fax', 'email', 'site', 'inn', 'kpp', 'rs', 'ks', 'bank', 'bik', 'comment'); //Поля, которые NULL
        foreach ($nulls as $field)
        {
            if (!strlen($table->$field)) $table->$field = NULL;
        }
        parent::prepareTable($table);
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

    public function getScript()
    {
        return 'administrator/components/' . $this->option . '/models/forms/company.js';
    }
}