<?php
defined('_JEXEC') or die;
use Joomla\CMS\MVC\Model\AdminModel;

class CompaniesModelCooperation extends AdminModel {

    public function getItem($pk = null)
    {
        $item = parent::getItem($pk);
        if ($item->id === null) {
            $item->companyID = JFactory::getApplication()->getUserState("{$this->option}.cooperation.companyID");
        }
        else {
            $item->hidden_client_id = $item->clientID;
            $item->hidden_client_title = $this->loadClientTitle($item->clientID);
        }
        $item->company = $this->getCompanyTitle($item->companyID);

        return $item;
    }

    public function save($data)
    {
        return parent::save($data);
    }

    private function loadClientTitle(int $clientID): string
    {
        if ($clientID <= 0) return '';
        $table = $this->getTable('Companies', 'TableCompanies');
        $table->load($clientID);
        return $table->title ?? '';
    }

    public function getTable($name = 'Cooperation', $prefix = 'TableCompanies', $options = array())
    {
        return JTable::getInstance($name, $prefix, $options);
    }

    public function getForm($data = array(), $loadData = true)
    {
        $form = $this->loadForm(
            $this->option.'.cooperation', 'cooperation', array('control' => 'jform', 'load_data' => $loadData)
        );
        if (empty($form))
        {
            return false;
        }

        return $form;
    }

    protected function loadFormData()
    {
        $data = JFactory::getApplication()->getUserState($this->option.'.edit.cooperation.data', array());
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
            return $user->authorise('core.edit.state', $this->option . '.cooperation.' . (int) $record->id);
        }
        else
        {
            return parent::canEditState($record);
        }
    }

    public function getScript()
    {
        return 'administrator/components/' . $this->option . '/models/forms/cooperation.js';
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