<?php
defined('_JEXEC') or die;
?>
<div class="center"><h2><?php echo JText::sprintf('COM_COMPANIES_LAYOUT_COMPANY_CLIENTS'); ?></h2></div>
<div><?php echo $this->links['client_add'];?></div>
<?php if (!empty($this->clients['client'])) { ?>
    <table class="table table-stripped">
        <thead>
        <tr>
            <th><?php echo JText::sprintf('COM_MKV_HEAD_COMPANY');?></th>
            <th style="width: 10%;"><?php echo JText::sprintf('COM_COMPANIES_HEAD_COMPANIES_CITY_SIMPLE');?></th>
            <th style="width: 25%;"><?php echo JText::sprintf('COM_COMPANIES_TAB_COMPANY_IN_CONTRACTS');?></th>
            <th style="width: 35%;"><?php echo JText::sprintf('COM_COMPANIES_HEAD_COMPANY_ACTIVITIES_LABEL');?></th>
            <th style="width: 5%;"><?php echo JText::sprintf('COM_COMPANIES_HEAD_DELETE');?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($this->clients['client'] as $client): ?>
            <tr>
                <td>
                    <?php echo $client['company_link'];?><br>
                    <?php echo $client['comment'];?>
                </td>
                <td><?php echo $client['city'];?></td>
                <td>
                    <?php if (!empty($client['contracts']['items'])): ?>
                        <table class="table table-stripped">
                            <tbody>
                                <?php foreach ($client['contracts']['items'] as $contractID => $activity): ?>
                                    <tr>
                                        <td><?php echo $activity['project'];?></td>
                                        <td><?php echo $activity['status_link'];?></td>
                                    </tr>
                                <?php endforeach;?>
                            <tbody>
                        </table>
                    <?php endif;?>
                </td>
                <td>
                    <?php if (!empty($client['activities'])): ?>
                        <table class="table table-stripped">
                            <tbody>
                            <?php foreach ($client['activities'] as $activity): ?>
                                <tr>
                                    <td><?php echo $activity;?></td>
                                </tr>
                            <?php endforeach;?>
                            <tbody>
                        </table>
                    <?php endif;?>
                </td>
                <td><?php echo $client['delete_link'];?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php } else {echo JText::sprintf('COM_COMPANIES_MESSAGE_NO_INFO');} ?>

<div class="center"><h2><?php echo JText::sprintf('COM_COMPANIES_LAYOUT_COMPANY_CLIENTS_FOR'); ?></h2></div>
<?php if (!empty($this->clients['parent'])) { ?>
    <table class="table table-stripped">
        <thead>
        <tr>
            <th><?php echo JText::sprintf('COM_MKV_HEAD_COMPANY');?></th>
            <th style="width: 10%;"><?php echo JText::sprintf('COM_COMPANIES_HEAD_COMPANIES_CITY_SIMPLE');?></th>
            <th style="width: 25%;"><?php echo JText::sprintf('COM_COMPANIES_TAB_COMPANY_IN_CONTRACTS');?></th>
            <th style="width: 35%;"><?php echo JText::sprintf('COM_COMPANIES_HEAD_COMPANY_ACTIVITIES_LABEL');?></th>
            <th style="width: 5%;"><?php echo JText::sprintf('COM_COMPANIES_HEAD_DELETE');?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($this->clients['parent'] as $client): ?>
            <tr>
                <td>
                    <?php echo $client['company_link'];?><br>
                    <?php echo $client['comment'];?>
                </td>
                <td><?php echo $client['city'];?></td>
                <td>
                    <?php if (!empty($client['contracts']['items'])): ?>
                        <table class="table table-stripped">
                            <tbody>
                            <?php foreach ($client['contracts']['items'] as $contractID => $activity): ?>
                                <tr>
                                    <td><?php echo $activity['project'];?></td>
                                    <td><?php echo $activity['status_link'];?></td>
                                </tr>
                            <?php endforeach;?>
                            <tbody>
                        </table>
                    <?php endif;?>
                </td>
                <td>
                    <?php if (!empty($client['activities'])): ?>
                        <table class="table table-stripped">
                            <tbody>
                            <?php foreach ($client['activities'] as $activity): ?>
                                <tr>
                                    <td><?php echo $activity;?></td>
                                </tr>
                            <?php endforeach;?>
                            <tbody>
                        </table>
                    <?php endif;?>
                </td>
                <td><?php echo $client['delete_link'];?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php } else {echo JText::sprintf('COM_COMPANIES_MESSAGE_NO_INFO');} ?>
