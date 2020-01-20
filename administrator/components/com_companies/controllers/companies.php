<?php
use Joomla\CMS\MVC\Controller\AdminController;

defined('_JEXEC') or die;

class CompaniesControllerCompanies extends AdminController
{
    public function getModel($name = 'Company', $prefix = 'CompaniesModel', $config = array())
    {
        return parent::getModel($name, $prefix, $config);
    }
}
