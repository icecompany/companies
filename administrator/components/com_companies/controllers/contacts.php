<?php
use Joomla\CMS\MVC\Controller\AdminController;

defined('_JEXEC') or die;

class CompaniesControllerContacts extends AdminController
{
    public function getModel($name = 'Contact', $prefix = 'CompaniesModel', $config = array())
    {
        return parent::getModel($name, $prefix, $config);
    }

    public function delete()
    {
        $uri = JUri::getInstance($_SERVER['HTTP_REFERER']);
        $itemID = $uri->getVar('id');
        $this->view_list = "company&layout=edit&id={$itemID}";
        parent::delete();
    }

    public function checkToken($method = 'get', $redirect = true)
    {
        return parent::checkToken($method, $redirect);
    }
}
