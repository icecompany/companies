<?php
defined('_JEXEC') or die;
$listOrder    = $this->escape($this->state->get('list.ordering'));
$listDirn    = $this->escape($this->state->get('list.direction'));
?>
<tr>
    <th style="width: 1%;"><?php echo JHtml::_('grid.checkall'); ?></th>
    <th style="width: 1%;">№</th>
    <th><?php echo JHtml::_('searchtools.sort', 'COM_COMPANIES_HEAD_COMPLAIN_OLD_TITLE', 'old_title', $listDirn, $listOrder); ?></th>
    <th><?php echo JText::sprintf('COM_COMPANIES_HEAD_COMPLAIN_ISSET_TITLE'); ?></th>
    <th><?php echo JHtml::_('searchtools.sort', 'COM_COMPANIES_HEAD_COMPANIES_ID', 'id', $listDirn, $listOrder); ?></th>
</tr>