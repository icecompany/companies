<?php
use Joomla\CMS\Form\FormRule;
defined('_JEXEC') or die;

class JFormRuleIndex extends FormRule
{
    protected $regex = '^([A-Za-z0-9-]{0,6})$';
}