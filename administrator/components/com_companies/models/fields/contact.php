<?php
defined('_JEXEC') or die;
jimport('joomla.form.helper');
JFormHelper::loadFieldClass('list');

class JFormFieldContact extends JFormFieldList
{
    protected $type = 'Contact';
    protected $loadExternally = 0;

    protected function getOptions()
    {
        $app = JFactory::getApplication();
        $view = $app->input->getString('task', null);
        $fq = $app->input->getInt('contractID', null);
        $taskID = $app->input->getInt('id', 0);
        if ($view === 'task' && $taskID > 0)
        {
            $contractID = $this->getContract($taskID);
        }
        else {
            $contractID = $fq ?? $app->getUserState("com_scheduler.task.contractID");
        }

        $contract = $this->getContract($contractID);
        $companyID = $contract->companyID;

        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query
            ->select("c.id, c.companyID, c.fio, c.post")
            ->from("#__mkv_companies_contacts c")
            ->where("c.companyID = {$companyID}")
            ->order("c.main desc");

        $result = $db->setQuery($query)->loadObjectList();

        $options = array();

        foreach ($result as $item) {
            $title = (!empty($item->post)) ? sprintf("%s (%s)", $item->fio, $item->post) : $item->fio;
            $options[] = JHtml::_('select.option', $item->id, $title);
        }

        if (!$this->loadExternally) {
            $options = array_merge(parent::getOptions(), $options);
        }

        return $options;
    }

    private function getTask(int $taskID = 0)
    {
        JTable::addIncludePath(JPATH_ADMINISTRATOR . "/components/com_scheduler/tables");
        $table = JTable::getInstance('Scheduler', 'TableScheduler');
        $table->load($taskID);
        return $table->contractID;
    }

    private function getContract(int $contractID)
    {
        JModelLegacy::addIncludePath(JPATH_ADMINISTRATOR . "/components/com_contracts/models");
        JTable::addIncludePath(JPATH_ADMINISTRATOR . "/components/com_contracts/tables");
        $model = JModelLegacy::getInstance('Contract', 'ContractsModel');
        return $model->getItem($contractID);
    }

    public function getOptionsExternally()
    {
        $this->loadExternally = 1;
        return $this->getOptions();
    }
}