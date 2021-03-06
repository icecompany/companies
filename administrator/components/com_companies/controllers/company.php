<?php
defined('_JEXEC') or die;
use Joomla\CMS\MVC\Controller\FormController;

class CompaniesControllerCompany extends FormController {
    public function display($cachable = false, $urlparams = array())
    {
        return parent::display($cachable, $urlparams);
    }

    public function add()
    {
        $app = JFactory::getApplication();
        $title = $app->input->getString('title');
        $complainID = $app->input->getInt('complainID', 0);
        if (!empty($title)) {
            $app->setUserState($this->context . ".title", urldecode($title));
            if ($complainID > 0) $app->setUserState($this->context . ".complainID", $complainID);
        }
        return parent::add();
    }

    public function add_contract()
    {
        $referer = JUri::getInstance($_SERVER['HTTP_REFERER']);
        $view = $referer->getVar('view');
        $companyID = $referer->getVar('id');
        if ($view === 'company' && $companyID > 0) {
            $query = [
                'option' => 'com_contracts',
                'task' => 'contract.add',
                'companyID' => $companyID,
                'return' => base64_encode($referer->toString())
            ];
            $this->setRedirect("index.php?" . http_build_query($query));
            $this->redirect();
            jexit();
        }
    }
}