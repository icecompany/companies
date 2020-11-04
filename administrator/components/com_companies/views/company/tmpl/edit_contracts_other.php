<?php
defined('_JEXEC') or die;
?>
<div class="center"><h2><?php echo JText::sprintf('COM_COMPANIES_LAYOUT_COMPANY_OTHER_PROJECTS'); ?></h2></div>
<div>
    <?php echo $this->links['other_project_add'];?>
</div>
<table class="table table-stripped">
    <thead>
    <tr>
        <th style="width: 5%"><?php echo JText::sprintf('COM_COMPANIES_HEAD_ARMY_YEAR');?></th>
        <th><?php echo JText::sprintf('COM_MKV_HEAD_PROJECT');?></th>
        <th style="width: 10%;"><?php echo JText::sprintf('COM_COMPANIES_HEAD_ARMY_FINANCES');?></th>
        <th style="width: 5%;"><?php echo JText::sprintf('COM_COMPANIES_HEAD_OTHER_PROJECT_DELETE');?></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($this->item->other_projects as $project): ?>
        <tr>
            <td><?php echo $project['year'];?></td>
            <td><?php echo $project['edit_link'];?></td>
            <td><?php echo $project['finances'];?></td>
            <td><?php echo $project['delete_link'];?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>