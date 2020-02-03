<?php
defined('_JEXEC') or die;
use Joomla\CMS\MVC\Controller\FormController;

class CompaniesControllerParent extends FormController {
    public function display($cachable = false, $urlparams = array())
    {
        return parent::display($cachable, $urlparams);
    }

    public function add()
    {
        $input = $this->input;
        $parentID = $input->getInt('parentID', 0);
        if ($parentID > 0) {
            JFactory::getApplication()->setUserState("{$this->option}.parent.parentID", $parentID);
        }
        return parent::add();
    }
}
