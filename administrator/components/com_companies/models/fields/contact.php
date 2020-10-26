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
        $fq = $app->input->getInt('contractID', null);
        $contract = $this->getContract($fq ?? $app->getUserState("com_scheduler.task.contractID"));
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