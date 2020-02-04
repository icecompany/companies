<?php
// Запрет прямого доступа.
defined('_JEXEC') or die;
$ii = JFactory::getApplication()->input->getInt('limitstart', 0);
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
            <?php echo $item['edit_link'];?>
        </td>
        <td>
            <?php echo $item['post'];?>
        </td>
        <td>
            <?php echo $item['company_link'];?>
        </td>
        <td>
            <?php echo $item['phone_work_link'];?>
        </td>
        <td>
            <?php echo $item['phone_mobile_link'];?>
        </td>
        <td>
            <?php echo $item['email_link'];?>
        </td>
        <td>
            <?php echo $item['for_accreditation'];?>
        </td>
        <td>
            <?php echo $item['for_building'];?>
        </td>
        <td>
            <?php echo $item['comment'];?>
        </td>
        <td>
            <?php echo $item['id'];?>
        </td>
    </tr>
<?php endforeach; ?>