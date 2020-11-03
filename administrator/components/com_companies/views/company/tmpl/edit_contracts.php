<?php
defined('_JEXEC') or die;
?>
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
            <td>
                <?php if (!empty($contract['stand_items'])): ?>
                    <table class="table table-stripped">
                        <thead>
                            <tr>
                                <th><?php echo JText::sprintf('COM_CONTRACTS_HEAD_STANDS_NUMBER');?></th>
                                <th><?php echo JText::sprintf('COM_MKV_HEAD_AMOUNT');?></th>
                                <th><?php echo JText::sprintf('COM_MKV_HEAD_TITLE');?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($contract['stand_items'] as $stand_item): ?>
                                <tr>
                                    <td><?php echo $stand_item['square'];?></td>
                                    <td><?php echo $stand_item['amount'];?></td>
                                    <td><?php echo $stand_item['item'];?></td>
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
                                    <td></td>
                                </tr>
                        </tbody>
                    </table>
                <?php endif; ?>
            </td>
            <td><?php echo $contract['amount_full'];?></td>
            <td><?php echo $contract['manager'];?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>