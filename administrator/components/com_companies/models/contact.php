<?php
defined('_JEXEC') or die;
use Joomla\CMS\MVC\Model\AdminModel;

class CompaniesModelContact extends AdminModel {

    public function getItem($pk = null)
    {
        $item = parent::getItem($pk);
        if ($item->id === null) {
            $item->companyID = $this->getState('contact.companyID');
        }
        else {

        }
        $item->company = $this->getCompanyTitle($item->companyID);

        return $item;
    }

    public function save($data)
    {
        return parent::save($data);
    }

    public function getTable($name = 'Contacts', $prefix = 'TableCompanies', $options = array())
    {
        return JTable::getInstance($name, $prefix, $options);
    }

    public function getForm($data = array(), $loadData = true)
    {
        $form = $this->loadForm(
            $this->option.'.contact', 'contact', array('control' => 'jform', 'load_data' => $loadData)
        );
        if (empty($form))
        {
            return false;
        }

        return $form;
    }

    protected function loadFormData()
    {
        $data = JFactory::getApplication()->getUserState($this->option.'.edit.contact.data', array());
        if (empty($data))
        {
            $data = $this->getItem();
        }

        return $data;
    }

    protected function prepareTable($table)
    {
        $nulls = array(); //Поля, которые NULL
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
            return $user->authorise('core.edit.state', $this->option . '.contact.' . (int) $record->id);
        }
        else
        {
            return parent::canEditState($record);
        }
    }

    protected function populateState()
    {
        $companyID = JFactory::getApplication()->getUserStateFromRequest("{$this->option}.contact.companyID", 'contact.companyID', 0);
        $this->setState('contact.companyID', $companyID);
        parent::populateState();
    }

    public function getScript()
    {
        return 'administrator/components/' . $this->option . '/models/forms/contact.js';
    }

    private function getCompanyTitle(int $companyID): string
    {
        $table = $this->getTable('Companies');
        if (!$table->load($companyID)) {
            return '';
        }
        return $table->title;
    }

}