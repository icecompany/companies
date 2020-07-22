<?php
defined('_JEXEC') or die;
use Joomla\CMS\Response\JsonResponse;
use Joomla\CMS\MVC\Controller\BaseController;

class CompaniesControllerCities extends BaseController
{
    public function getModel($name = 'Cities', $prefix = 'CompaniesModel', $config = [])
    {
        return parent::getModel($name, $prefix, ['search' => $this->input->getString('q', '')]);
    }

    public function execute($task)
    {
        $items = $this->getModel()->getItems();
        echo new JsonResponse($items);
    }
}