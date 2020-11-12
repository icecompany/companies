<?php
defined('_JEXEC') or die;
use Joomla\CMS\MVC\Model\AdminModel;

class CompaniesModelPartner extends AdminModel {

    public function getItem($pk = null)
    {
        $item = parent::getItem($pk);
        if ($item->id === null) {
            $item->company_1_ID = JFactory::getApplication()->getUserState("{$this->option}.partner.companyID");
            $item->type = JFactory::getApplication()->getUserState("{$this->option}.partner.type");
        }
        $item->company = $this->getCompanyTitle($item->company_1_ID);

        return $item;
    }

    public function save($data)
    {
        return parent::save($data);
    }

    public function getTable($name = 'Partners', $prefix = 'TableCompanies', $options = array())
    {
        return JTable::getInstance($name, $prefix, $options);
    }

    public function getForm($data = array(), $loadData = true)
    {
        $form = $this->loadForm(
            $this->option.'.partner', 'partner', array('control' => 'jform', 'load_data' => $loadData)
        );
        if (empty($form))
        {
            return false;
        }

        return $form;
    }

    protected function loadFormData()
    {
        $data = JFactory::getApplication()->getUserState($this->option.'.edit.partner.data', array());
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
        $nulls = ['comment']; //Поля, которые NULL
        foreach ($all as $field => $v) {
            if (empty($field)) continue;
            if (in_array($field, $nulls)) {
                if (!strlen($table->$field)) {
                    $table->$field = NULL;
                    continue;
                }
            }
            if (!empty($field)) $table->$field = trim($table->$field);
        }

        parent::prepareTable($table);
    }

    protected function canEditState($record)
    {
        $user = JFactory::getUser();

        if (!empty($record->id))
        {
            return $user->authorise('core.edit.state', $this->option . '.partner.' . (int) $record->id);
        }
        else
        {
            return parent::canEditState($record);
        }
    }

    public function getScript()
    {
        return 'administrator/components/' . $this->option . '/models/forms/partner.js';
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