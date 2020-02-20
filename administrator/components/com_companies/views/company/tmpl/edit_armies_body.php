<?php
defined('_JEXEC') or die;
$ii = 0;
?>
<?php foreach ($this->item->armies['items'] as $sister): ?>
    <tr>
        <td><?php echo ++$ii; ?></td>
        <td><?php echo $sister['army_year']; ?></td>
        <td><?php echo $sister['square']; ?></td>
        <td><?php echo $sister['comment']; ?></td>
    </tr>
<?php endforeach; ?>
