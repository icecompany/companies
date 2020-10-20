<?php
defined('_JEXEC') or die;
?>
<div class="center"><h2><?php echo JText::sprintf('COM_COMPANIES_LAYOUT_COMPANY_CONTRACTS');?></h2></div>
<table class="table table-stripped">
    <thead>
    <tr>
        <th><?php echo JText::sprintf('COM_MKV_HEAD_PROJECT');?></th>
        <th><?php echo JText::sprintf('COM_MKV_HEAD_STATUS');?></th>
        <th><?php echo JText::sprintf('COM_MKV_HEAD_STANDS');?></th>
        <th><?php echo JText::sprintf('COM_MKV_HEAD_AMOUNT');?></th>
        <th><?php echo JText::sprintf('COM_MKV_HEAD_MANAGER');?></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($this->contracts['items'] as $contract): ?>
        <tr>
            <td><?php echo $contract['project'];?></td>
            <td><?php echo $contract['status_link'];?></td>
            <td><?php echo $contract['stands'];?></td>
            <td><?php echo $contract['amount_full'];?></td>
            <td><?php echo $contract['manager'];?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>