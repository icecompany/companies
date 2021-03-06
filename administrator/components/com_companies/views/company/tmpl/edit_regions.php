<?php
defined('_JEXEC') or die;
?>
<div class="center"><h2><?php echo JText::sprintf('COM_COMPANIES_LAYOUT_COMPANY_REGIONS'); ?></h2></div>
<div>
    <?php echo $this->links['region_add'];?>
</div>
<?php if (!empty($this->item->regions)) { ?>
    <table class="table table-stripped">
        <thead>
        <tr>
            <th style="width: 30%;"><?php echo JText::sprintf('COM_COMPANIES_HEAD_REGION');?></th>
            <th><?php echo JText::sprintf('COM_COMPANIES_HEAD_FOIV_DEPARTMENT');?></th>
            <th><?php echo JText::sprintf('COM_COMPANIES_HEAD_COMMENT');?></th>
            <th style="width: 5%;"><?php echo JText::sprintf('COM_COMPANIES_HEAD_DELETE');?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($this->item->regions as $region): ?>
            <tr>
                <td><?php echo $region['edit_link'];?></td>
                <td><?php echo $region['struct'];?></td>
                <td><?php echo $region['comment'];?></td>
                <td><?php echo $region['delete_link'];?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php } else {echo JText::sprintf('COM_COMPANIES_MESSAGE_NO_INFO');} ?>
