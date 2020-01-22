<?php
use Joomla\CMS\Form\FormRule;
use Joomla\Registry\Registry;
use Joomla\CMS\Form\Form;

defined('_JEXEC') or die;

class JFormRuleCity extends FormRule
{
    protected $regex = '^([0-9]{1,})$';

    public function test(\SimpleXMLElement $element, $value, $group = null, Registry $input = null, Form $form = null)
    {
        if (empty($value)) return false;
        return parent::test($element, $value, $group, $input, $form);
    }
}