<?php
// Запрет прямого доступа.
defined('_JEXEC') or die;
$ii = $this->state->get('list.start', 0);
foreach ($this->items['items'] as $i => $item) :
    ?>
    <tr class="row0">
        <td class="center">
            <?php echo JHtml::_('grid.id', $i, $item['id']); ?>
        </td>
        <td>
            <?php echo ++$ii; ?>
        </td>
        <td>
            <?php echo $item['title'];?>
        </td>
        <?php if (is_numeric($this->state->get('filter.in_project'))): ?>
            <td>
                <?php echo $item['in_project'];?>
            </td>
        <?php endif;?>
        <?php if (is_numeric($this->notInProject)): ?>
            <td>
                <?php echo $item['not_in_project'];?>
            </td>
        <?php endif;?>
        <td>
            <?php echo $item['city'];?>
        </td>
        <td>
            <?php echo $item['id'];?>
        </td>
    </tr>
<?php endforeach; ?>