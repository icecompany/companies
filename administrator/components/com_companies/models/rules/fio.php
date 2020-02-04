<?php
use Joomla\CMS\Form\FormRule;
defined('_JEXEC') or die;

class JFormRuleFio extends FormRule
{
    protected $regex = '^[А-Яа-яA-Za-z\s-]{3,255}$';
}