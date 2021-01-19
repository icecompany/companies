<?php
defined('_JEXEC') or die;
?>
<div class="center"><h2><?php echo JText::sprintf('COM_COMPANIES_LAYOUT_COMPANY_TURNOVER'); ?></h2></div>
<div>
    <?php echo $this->links['turnover_add'];?>
</div>
<table class="table table-stripped">
    <thead>
    <tr>
        <th style="width: 5%"><?php echo JText::sprintf('COM_COMPANIES_HEAD_ARMY_YEAR');?></th>
        <th style="width: 10%;"><?php echo JText::sprintf('COM_COMPANIES_HEAD_ARMY_FINANCES');?></th>
        <th style="width: 5%;"><?php echo JText::sprintf('COM_COMPANIES_HEAD_OTHER_PROJECT_DELETE');?></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($this->item->turnovers as $project): ?>
        <tr>
            <td><?php echo $project['edit_link'];?></td>
            <td><?php echo $project['turnover'];?></td>
            <td><?php echo $project['delete_link'];?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>