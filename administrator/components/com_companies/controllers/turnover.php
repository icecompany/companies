<?php
defined('_JEXEC') or die;
use Joomla\CMS\MVC\Controller\FormController;

class CompaniesControllerTurnover extends FormController {
    public function display($cachable = false, $urlparams = array())
    {
        return parent::display($cachable, $urlparams);
    }

    public function add()
    {
        $input = $this->input;
        $companyID = $input->getInt('companyID', 0);
        if ($companyID > 0) {
            JFactory::getApplication()->setUserState("{$this->option}.turnover.companyID", $companyID);
        }
        return parent::add();
    }
}