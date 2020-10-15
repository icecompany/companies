<?php
// Запрет прямого доступа.
defined('_JEXEC') or die;
$ii = $this->state->get('list.start', 0);
foreach ($this->items as $i => $item) :
    ?>
    <tr class="row0">
        <td class="center">
            <?php echo JHtml::_('grid.id', $i, $item['id']); ?>
        </td>
        <td>
            <?php echo ++$ii; ?>
        </td>
        <td>
            <?php echo $item['old_title'];?>
        </td>
        <td>
            <?php if (!empty($item['complain'])) { ?>
                <table class="table table-stripped">
                    <thead>
                        <tr>
                            <th><?php echo JText::sprintf('COM_COMPANIES_HEAD_COMPANIES_TITLE');?></th>
                            <th><?php echo JText::sprintf('COM_COMPANIES_HEAD_COMPLAIN_PERCENT');?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($item['complain'] as $company) :?>
                            <tr>
                                <td><?php echo $company['company_link'];?></td>
                                <td><?php echo $company['percent'];?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php } else echo JText::sprintf('COM_COMPANIES_MESSAGE_NOT_COMPLAIN'); ?>
        </td>
        <td>
            <?php echo $item['id'];?>
        </td>
    </tr>
<?php endforeach; ?>