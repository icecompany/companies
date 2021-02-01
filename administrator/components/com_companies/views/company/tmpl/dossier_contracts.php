<?php
defined('_JEXEC') or die;
//exit(var_dump($this->contracts['items']));
?>
<div class="center"><h4><?php echo JText::sprintf('COM_COMPANIES_HEAD_CURRENT_PROJECT');?></h4></div>
<table class="table table-stripped">
    <thead>
    <tr>
        <th style="width: 7%"><?php echo JText::sprintf('COM_MKV_HEAD_PROJECT');?></th>
        <th style="width: 7%"><?php echo JText::sprintf('COM_MKV_HEAD_STATUS');?></th>
        <th><?php echo JText::sprintf('COM_MKV_HEAD_STANDS');?></th>
        <th style="width: 10%"><?php echo JText::sprintf('COM_MKV_HEAD_AMOUNT');?></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($this->contracts['items'] as $contract): ?>
        <?php if ($contract['projectID'] != PrjHelper::getActiveProject(MkvHelper::getConfig('default_project'))) continue;?>
        <tr>
            <td><?php echo $contract['project'];?></td>
            <td><?php echo $contract['status'];?></td>
            <td>
                <?php if (!empty($contract['stand_items'])): ?>
                    <table class="table table-stripped">
                        <thead>
                            <tr>
                                <th><?php echo JText::sprintf('COM_CONTRACTS_HEAD_STANDS_NUMBER');?></th>
                                <th><?php echo JText::sprintf('COM_MKV_HEAD_AMOUNT');?></th>
                                <th><?php echo JText::sprintf('COM_CONTRACTS_FORM_STAND_BYPASSING_LABEL');?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($contract['stand_items'] as $stand_item): ?>
                                <tr>
                                    <td><?php echo $stand_item['square'];?></td>
                                    <td><?php echo $stand_item['amount'];?></td>
                                    <td><?php echo JText::sprintf(($stand_item['bypassing']) ? 'JYES' : 'JNO');?></td>
                                </tr>
                            <?php endforeach; ?>
                                <tr>
                                    <td><?php echo JText::sprintf('COM_CONTRACTS_HEAD_ITEMS_AMOUNT_FOR_SQUARES');?></td>
                                    <td colspan="2">
                                        <?php
                                            $currency = mb_strtoupper($contract['currency_clean']);
                                            $amount = number_format((float) $contract['stand_items']['total'], MKV_FORMAT_DEC_COUNT, MKV_FORMAT_SEPARATOR_FRACTION, MKV_FORMAT_SEPARATOR_DEC);
                                            echo JText::sprintf("COM_CONTRACTS_CURRENCY_{$currency}_AMOUNT_SHORT", $amount);
                                        ?>
                                    </td>
                                </tr>
                        </tbody>
                    </table>
                <?php endif; ?>
            </td>
            <td><?php echo $contract['amount_full'];?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?php echo "<strong>", JText::sprintf('COM_CONTRACTS_HEAD_THEMATICS'), "</strong>", ": ", $contract['thematics'] ?? 'Нет информации';?><br>
<?php echo "<strong>", JText::sprintf('COM_COMPANIES_HEAD_ARMY_EXPOSITION'), "</strong>", ": ", $this->item->current_army->exposition ?? 'Нет информации';?><br>
<?php echo "<strong>", JText::sprintf('COM_COMPANIES_HEAD_ARMY_FORUM_NEW_ITEMS'), "</strong>", ": ", $this->item->current_army->forum_new_items ?? 'Нет информации';?><br>
<?php echo "<strong>", JText::sprintf('COM_COMPANIES_HEAD_ARMY_NEW_IN_WORLD_ITEMS'), "</strong>", ": ", $this->item->current_army->full_new_items ?? 'Нет информации';?><br>
<?php echo "<strong>", JText::sprintf('COM_COMPANIES_HEAD_ARMY_DIVERSIFICATION'), "</strong>", ": ", $this->item->current_army->diversification ?? 'Нет информации';?><br>
<?php echo "<strong>", JText::sprintf('COM_COMPANIES_HEAD_ARMY_TARGETS'), "</strong>", ": ", $this->item->targets ?? 'Нет информации';?><br>

<div class="center"><h4><?php echo JText::sprintf('COM_COMPANIES_HEAD_PREVIOUS_PROJECT');?></h4></div>

<table class="table table-stripped">
    <thead>
    <tr>
        <th style="width: 7%"><?php echo JText::sprintf('COM_MKV_HEAD_PROJECT');?></th>
        <th style="width: 7%"><?php echo JText::sprintf('COM_MKV_HEAD_STATUS');?></th>
        <th><?php echo JText::sprintf('COM_MKV_HEAD_STANDS');?></th>
        <th style="width: 10%"><?php echo JText::sprintf('COM_MKV_HEAD_AMOUNT');?></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($this->contracts['items'] as $contract): ?>
        <?php if ($contract['projectID'] == PrjHelper::getActiveProject(MkvHelper::getConfig('default_project')) || !in_array($contract['status_code'], [1, 5, 6, 9, 10, 13])) continue;?>
        <tr>
            <td><?php echo $contract['project'];?></td>
            <td><?php echo $contract['status'];?></td>
            <td>
                <?php if (!empty($contract['stand_items'])): ?>
                    <table class="table table-stripped">
                        <thead>
                            <tr>
                                <th><?php echo JText::sprintf('COM_CONTRACTS_HEAD_STANDS_NUMBER');?></th>
                                <th><?php echo JText::sprintf('COM_MKV_HEAD_AMOUNT');?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($contract['stand_items'] as $stand_item): ?>
                                <tr>
                                    <td><?php echo $stand_item['square'];?></td>
                                    <td><?php echo $stand_item['amount'];?></td>
                                </tr>
                            <?php endforeach; ?>
                                <tr>
                                    <td><?php echo JText::sprintf('COM_CONTRACTS_HEAD_ITEMS_AMOUNT_FOR_SQUARES');?></td>
                                    <td>
                                        <?php
                                            $currency = mb_strtoupper($contract['currency_clean']);
                                            $amount = number_format((float) $contract['stand_items']['total'], MKV_FORMAT_DEC_COUNT, MKV_FORMAT_SEPARATOR_FRACTION, MKV_FORMAT_SEPARATOR_DEC);
                                            echo JText::sprintf("COM_CONTRACTS_CURRENCY_{$currency}_AMOUNT_SHORT", $amount);
                                        ?>
                                    </td>
                                </tr>
                        </tbody>
                    </table>
                <?php endif; ?>
            </td>
            <td><?php echo $contract['amount_full'];?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>