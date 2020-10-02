<?php
defined('_JEXEC') or die;
$listOrder    = $this->escape($this->state->get('list.ordering'));
$listDirn    = $this->escape($this->state->get('list.direction'));
?>
<tr>
    <th style="width: 1%;"><?php echo JHtml::_('grid.checkall'); ?></th>
    <th style="width: 1%;">№</th>
    <th><?php echo JHtml::_('searchtools.sort', 'COM_COMPANIES_HEAD_CONTACTS_FIO', 'c.fio', $listDirn, $listOrder); ?></th>
    <th><?php echo JText::sprintf('COM_COMPANIES_HEAD_CONTACTS_POST'); ?></th>
    <th><?php echo JHtml::_('searchtools.sort', 'COM_COMPANIES_HEAD_CONTACTS_COMPANY_TITLE', 'company', $listDirn, $listOrder); ?></th>
    <th><?php echo JText::sprintf('COM_COMPANIES_HEAD_CONTACTS_WORK_PHONE');?></th>
    <th><?php echo JText::sprintf('COM_COMPANIES_HEAD_CONTACTS_MOBILE_PHONE');?></th>
    <th><?php echo JText::sprintf('COM_COMPANIES_HEAD_CONTACTS_EMAIL');?></th>
    <th><?php echo JHtml::_('searchtools.sort', 'COM_COMPANIES_HEAD_IS_MAIN_CONTACT', 'c.main', $listDirn, $listOrder); ?></th>
    <th><?php echo JHtml::_('searchtools.sort', 'COM_COMPANIES_HEAD_CONTACTS_FOR_ACCREDITATION', 'c.for_accreditation', $listDirn, $listOrder); ?></th>
    <th><?php echo JHtml::_('searchtools.sort', 'COM_COMPANIES_HEAD_CONTACTS_FOR_BUILDING', 'c.for_building', $listDirn, $listOrder); ?></th>
    <th><?php echo JText::sprintf('COM_COMPANIES_HEAD_CONTACTS_COMMENT');?></th>
    <th><?php echo JHtml::_('searchtools.sort', 'COM_COMPANIES_HEAD_COMPANIES_ID', 'e.id', $listDirn, $listOrder); ?></th>
</tr>