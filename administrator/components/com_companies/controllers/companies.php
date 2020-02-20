<?php
use Joomla\CMS\MVC\Controller\AdminController;
use Joomla\Utilities\ArrayHelper;

defined('_JEXEC') or die;

class CompaniesControllerCompanies extends AdminController
{
    public function getModel($name = 'Company', $prefix = 'CompaniesModel', $config = array())
    {
        return parent::getModel($name, $prefix, $config);
    }

    public function sync()
    {
        $db = JFactory::getDbo();
        $db->setQuery("call #__sync_old_and_new_data()")->execute();
        $url = "index.php?option={$this->option}&view=companies";
        $msg = JText::sprintf("COM_COMPANIES_MESSAGE_SYNC_COMPLETED");
        $this->setRedirect($url, $msg);
        $this->redirect();
    }
}
