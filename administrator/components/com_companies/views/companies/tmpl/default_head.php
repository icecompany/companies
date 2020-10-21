<?php
defined('_JEXEC') or die;
$listOrder    = $this->escape($this->state->get('list.ordering'));
$listDirn    = $this->escape($this->state->get('list.direction'));
?>
<tr>
    <th style="width: 1%;">
        <?php echo JHtml::_('grid.checkall'); ?>
    </th>
    <th style="width: 1%;">
        №
    </th>
    <th>
        <?php echo JHtml::_('searchtools.sort', 'COM_COMPANIES_HEAD_COMPANIES_TITLE', 'e.title', $listDirn, $listOrder); ?>
    </th>
    <?php if (is_numeric($this->state->get('filter.in_project'))): ?>
        <th>
            <?php echo JText::sprintf('COM_COMPANIES_HEAD_COMPANIES_IN_PROJECT');?>
        </th>
    <?php endif;?>
    <?php if (is_numeric($this->notInProject)): ?>
        <th>
            <?php echo JText::sprintf('COM_COMPANIES_BUTTON_ADD_CONTRACT');?>
        </th>
    <?php endif;?>
    <th>
        <?php echo JHtml::_('searchtools.sort', 'COM_COMPANIES_HEAD_COMPANIES_CITY', 'city', $listDirn, $listOrder); ?>
    </th>
    <th>
        <?php echo JHtml::_('searchtools.sort', 'COM_COMPANIES_HEAD_COMPANIES_ID', 'e.id', $listDirn, $listOrder); ?>
    </th>
</tr>