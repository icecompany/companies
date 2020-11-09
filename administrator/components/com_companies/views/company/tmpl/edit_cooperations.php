<?php
defined('_JEXEC') or die;
?>
<div class="center"><h2><?php echo JText::sprintf('COM_COMPANIES_LAYOUT_COMPANY_COOPERATIONS'); ?></h2></div>
<div><?php echo $this->links['cooperation_add'];?></div>
<?php if (!empty($this->cooperations['client'])) { ?>
    <table class="table table-stripped">
        <thead>
        <tr>
            <th style="width: 50%"><?php echo JText::sprintf('COM_MKV_HEAD_COMPANY');?></th>
            <th><?php echo JText::sprintf('COM_COMPANIES_HEAD_COMPANIES_CITY_SIMPLE');?></th>
            <th><?php echo JText::sprintf('COM_COMPANIES_HEAD_COMPANY_ACTIVITIES_LABEL');?></th>
            <th style="width: 5%;"><?php echo JText::sprintf('COM_COMPANIES_HEAD_DELETE');?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($this->cooperations['client'] as $client): ?>
            <tr>
                <td><?php echo $client['company_link'];?></td>
                <td><?php echo $client['city'];?></td>
                <td><?php echo $client['activities'];?></td>
                <td><?php echo $client['delete_link'];?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php } else {echo JText::sprintf('COM_COMPANIES_MESSAGE_NO_INFO');} ?>

<div class="center"><h2><?php echo JText::sprintf('COM_COMPANIES_LAYOUT_COMPANY_COOPERATIONS_FOR'); ?></h2></div>
<?php if (!empty($this->cooperations['parent'])) { ?>
    <table class="table table-stripped">
        <thead>
        <tr>
            <th style="width: 50%"><?php echo JText::sprintf('COM_MKV_HEAD_COMPANY');?></th>
            <th><?php echo JText::sprintf('COM_COMPANIES_HEAD_COMPANIES_CITY_SIMPLE');?></th>
            <th><?php echo JText::sprintf('COM_COMPANIES_HEAD_COMPANY_ACTIVITIES_LABEL');?></th>
            <th style="width: 5%;"><?php echo JText::sprintf('COM_COMPANIES_HEAD_DELETE');?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($this->cooperations['parent'] as $client): ?>
            <tr>
                <td><?php echo $client['company_link'];?></td>
                <td><?php echo $client['city'];?></td>
                <td><?php echo $client['activities'];?></td>
                <td><?php echo $client['delete_link'];?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php } else {echo JText::sprintf('COM_COMPANIES_MESSAGE_NO_INFO');} ?>
