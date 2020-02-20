<?php
defined('_JEXEC') or die;
jimport('joomla.form.helper');
JFormHelper::loadFieldClass('list');

class JFormFieldYear extends JFormFieldList
{
    protected $type = 'Year';
    protected $loadExternally = 0;

    protected function getOptions()
    {
        $max_year = (int) JDate::getInstance()->year;
        $min_year = 2015;
        $options = array();
        for ($i = $max_year; $i >= $min_year; $i--)
        {
            $options[] = JHtml::_('select.option', $i, $i);
        }

        if (!$this->loadExternally) {
            $options = array_merge(parent::getOptions(), $options);
        }

        return $options;
    }

    public function getOptionsExternally()
    {
        $this->loadExternally = 1;
        return $this->getOptions();
    }
}