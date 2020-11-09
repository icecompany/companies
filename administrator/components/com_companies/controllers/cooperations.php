<?php
use Joomla\CMS\MVC\Controller\AdminController;
use Joomla\Utilities\ArrayHelper;

defined('_JEXEC') or die;

class CompaniesControllerCooperations extends AdminController
{
    public function getModel($name = 'Cooperation', $prefix = 'CompaniesModel', $config = array())
    {
        return parent::getModel($name, $prefix, $config);
    }

    public function delete()
    {
        $cid = $this->input->get('cid', array(), 'array');
        if (!is_array($cid) || count($cid) < 1)
        {
            \JLog::add(\JText::_($this->text_prefix . '_NO_ITEM_SELECTED'), \JLog::WARNING, 'jerror');
        }
        else
        {
            $model = $this->getModel();
            $cid = ArrayHelper::toInteger($cid);

            if ($model->delete($cid))
            {
                $this->setMessage(\JText::plural($this->text_prefix . '_N_ITEMS_DELETED', count($cid)));
            }
            else
            {
                $this->setMessage($model->getError(), 'error');
            }

            $this->postDeleteHook($model, $cid);
        }

        $this->setRedirect($_SERVER['HTTP_REFERER']);
        $this->redirect();
        jexit();
    }
}