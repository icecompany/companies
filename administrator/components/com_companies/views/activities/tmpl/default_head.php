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
        <?php echo JHtml::_('searchtools.sort', 'COM_COMPANIES_HEAD_ACTIVITIES_TITLE', 'title', $listDirn, $listOrder); ?>
    </th>
    <th>
        <?php echo JText::sprintf('COM_COMPANIES_HEAD_ACTIVITIES_FIND_COMPANIES'); ?>
    </th>
    <th>
        <?php echo JHtml::_('searchtools.sort', 'COM_COMPANIES_HEAD_ACTIVITIES_FOR_CONTRACTOR', 'for_contractor', $listDirn, $listOrder); ?>
    </th>
    <th>
        <?php echo JHtml::_('searchtools.sort', 'COM_COMPANIES_HEAD_ACTIVITIES_FOR_NDP', 'for_ndp', $listDirn, $listOrder); ?>
    </th>
    <th>
        <?php echo JHtml::_('searchtools.sort', 'COM_COMPANIES_HEAD_ACTIVITIES_WEIGHT', 'weight', $listDirn, $listOrder); ?>
    </th>
    <th>
        <?php echo JHtml::_('searchtools.sort', 'COM_COMPANIES_HEAD_ACTIVITIES_ID', 'id', $listDirn, $listOrder); ?>
    </th>
</tr>