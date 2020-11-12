<?php
defined('_JEXEC') or die;
use Joomla\CMS\MVC\Controller\FormController;

class CompaniesControllerPartner extends FormController {
    public function display($cachable = false, $urlparams = array())
    {
        return parent::display($cachable, $urlparams);
    }

    public function add()
    {
        $input = $this->input;
        $companyID = $input->getInt('companyID', 0);
        $type = $input->getString('type', 'partner');
        if ($companyID > 0) {
            JFactory::getApplication()->setUserState("{$this->option}.partner.companyID", $companyID);
        }
        JFactory::getApplication()->setUserState("{$this->option}.partner.type", $type);
        return parent::add();
    }
}