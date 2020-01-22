<?php
defined('_JEXEC') or die;
use Joomla\CMS\MVC\Model\AdminModel;

class CompaniesModelParent extends AdminModel {
    public function getTable($name = 'Parents', $prefix = 'TableCompanies', $options = array())
    {
        return JTable::getInstance($name, $prefix, $options);
    }

    public function getItem($pk = null)
    {
        return parent::getItem($pk);;
    }

    public function delete(&$pks)
    {
        return parent::delete($pks);
    }

    public function getForm($data = array(), $loadData = true)
    {
        return false;
    }

    protected function loadFormData()
    {
        return $this->getItem();
    }

    protected function prepareTable($table)
    {
        parent::prepareTable($table);
    }
}