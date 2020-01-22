<?php
defined('_JEXEC') or die;
use Joomla\CMS\MVC\Model\AdminModel;

class CompaniesModelCompany extends AdminModel {

    public function getItem($pk = null)
    {
        return parent::getItem($pk);
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