<?php
defined('_JEXEC') or die;
use Joomla\CMS\MVC\Model\AdminModel;

class CompaniesModelComplain_company extends AdminModel {
    public function getTable($name = 'Complain', $prefix = 'TableCompanies', $options = array())
    {
        return JTable::getInstance($name, $prefix, $options);
    }

    public function getItem($pk = null)
    {
        return parent::getItem($pk);
    }

    public function delete(&$pks)
    {
        return parent::delete($pks);
    }

    public function getForm($data = array(), $loadData = true)
    {
        return true;
    }

    protected function loadFormData()
    {
        return true;
    }

    protected function prepareTable($table)
    {
        parent::prepareTable($table);
    }
}