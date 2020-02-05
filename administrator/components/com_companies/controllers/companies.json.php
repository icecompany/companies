<?php
defined('_JEXEC') or die;
use Joomla\CMS\Response\JsonResponse;
use Joomla\CMS\MVC\Controller\BaseController;

class CompaniesControllerCompanies extends BaseController
{
    public function getModel($name = 'Companies', $prefix = 'CompaniesModel', $config = array())
    {
        return parent::getModel($name, $prefix, $config);
    }

    public function execute($task)
    {
        $items = $this->getModel()->getItems();
        echo new JsonResponse($items['items']);
    }
}