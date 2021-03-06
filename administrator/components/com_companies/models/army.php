<?php
defined('_JEXEC') or die;
use Joomla\CMS\MVC\Model\AdminModel;

class CompaniesModelArmy extends AdminModel {

    public function getItem($pk = null)
    {
        $item = parent::getItem($pk);
        if ($item->id === null) {
            $item->companyID = $this->getState('army.companyID');
        }
        $item->company = $this->getCompanyTitle($item->companyID);

        return $item;
    }

    public function save($data)
    {
        return parent::save($data);
    }

    public function getTable($name = 'Army_history', $prefix = 'TableCompanies', $options = array())
    {
        return JTable::getInstance($name, $prefix, $options);
    }

    public function getForm($data = array(), $loadData = true)
    {
        $form = $this->loadForm(
            $this->option.'.army', 'army', array('control' => 'jform', 'load_data' => $loadData)
        );
        if (empty($form))
        {
            return false;
        }

        return $form;
    }

    protected function loadFormData()
    {
        $data = JFactory::getApplication()->getUserState($this->option.'.edit.army.data', array());
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
        $nulls = array('square_type', 'square_value', 'targets', 'thematics', 'stand', 'exposition', 'diversification', 'forum_new_items', 'full_new_items', 'is_ndp', 'is_report', 'comment'); //Поля, которые NULL
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
            return $user->authorise('core.edit.state', $this->option . '.contact.' . (int) $record->id);
        }
        else
        {
            return parent::canEditState($record);
        }
    }

    protected function populateState()
    {
        $companyID = JFactory::getApplication()->getUserStateFromRequest("{$this->option}.army.companyID", 'army.companyID', 0);
        $this->setState('army.companyID', $companyID);
        parent::populateState();
    }

    public function getScript()
    {
        return 'administrator/components/' . $this->option . '/models/forms/army.js';
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