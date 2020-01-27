<?php
use Joomla\CMS\MVC\Controller\AdminController;

defined('_JEXEC') or die;

class CompaniesControllerActivities extends AdminController
{
    public function getModel($name = 'Activities', $prefix = 'CompaniesModel', $config = array())
    {
        return parent::getModel($name, $prefix, $config);
    }
}
