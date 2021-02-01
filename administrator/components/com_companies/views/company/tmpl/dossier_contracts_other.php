<?php
defined('_JEXEC') or die;
?>
<div class="center"><h2><?php echo JText::sprintf('COM_COMPANIES_LAYOUT_COMPANY_OTHER_PROJECTS'); ?></h2></div>
<?php if (!empty($this->item->other_projects)) {?>
<table class="table table-stripped">
    <thead>
    <tr>
        <th style="width: 5%"><?php echo JText::sprintf('COM_COMPANIES_HEAD_ARMY_YEAR');?></th>
        <th><?php echo JText::sprintf('COM_MKV_HEAD_PROJECT');?></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($this->item->other_projects as $project): ?>
        <tr>
            <td><?php echo $project['year'];?></td>
            <td><?php echo $project['title'];?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?php } else echo JText::sprintf('COM_COMPANIES_MESSAGE_NO_INFO');?>
