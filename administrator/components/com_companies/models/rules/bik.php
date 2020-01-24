<?php
use Joomla\CMS\Form\FormRule;
defined('_JEXEC') or die;

class JFormRuleBik extends FormRule
{
    protected $regex = '^([0-9]{0,10})$';
}