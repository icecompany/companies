<?php
defined('_JEXEC') or die;
?>
<div class="center"><h2><?php echo JText::sprintf('COM_COMPANIES_LAYOUT_COMPANY_TURNOVER'); ?></h2></div>
<?php if (!empty($this->item->turnovers)) {?>
<table class="table table-stripped">
    <thead>
    <tr>
        <th style="width: 5%"><?php echo JText::sprintf('COM_COMPANIES_HEAD_ARMY_YEAR');?></th>
        <th style="width: 10%;"><?php echo JText::sprintf('COM_COMPANIES_HEAD_ARMY_FINANCES');?></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($this->item->turnovers as $project): ?>
        <tr>
            <td><?php echo $project['year'];?></td>
            <td><?php echo $project['turnover'];?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?php } else echo JText::sprintf('COM_COMPANIES_MESSAGE_NO_INFO');?>
