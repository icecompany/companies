<?php
use Joomla\CMS\MVC\Controller\AdminController;
use Joomla\Utilities\ArrayHelper;

defined('_JEXEC') or die;

class CompaniesControllerComplain extends AdminController
{
    public function getModel($name = 'Complain_company', $prefix = 'CompaniesModel', $config = array())
    {
        return parent::getModel($name, $prefix, $config);
    }
}
