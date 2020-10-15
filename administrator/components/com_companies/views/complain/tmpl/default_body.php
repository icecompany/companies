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
                            <th style="width: 5%;"><?php echo JText::sprintf('COM_COMPANIES_HEAD_COMPLAIN_PERCENT');?></th>
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
            <?php } else {
                $title = urlencode($item['old_title']);
                $url = JRoute::_("index.php?option=com_companies&amp;task=company.add&amp;title={$title}&amp;complainID={$item['id']}&amp;return={$this->return}");
                $link = JHtml::link($url, JText::sprintf('COM_COMPANIES_LINK_COMPANY_ADD_COMPANY_WITH_NAME'));
                echo sprintf("%s. %s", JText::sprintf('COM_COMPANIES_MESSAGE_NOT_COMPLAIN'), $link);
            }
            ?>
        </td>
        <td>
            <?php echo $item['id'];?>
        </td>
    </tr>
<?php endforeach; ?>