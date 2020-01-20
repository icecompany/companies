<?php
use Joomla\CMS\Form\FormRule;
defined('_JEXEC') or die;

class JFormRuleKpp extends FormRule
{
    protected $regex = '^([0-9]{7,10})$';
}