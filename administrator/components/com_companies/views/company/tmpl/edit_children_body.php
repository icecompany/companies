<?php
defined('_JEXEC') or die;
$ii = 0;
?>
<?php foreach ($this->item->children as $child): ?>
    <tr>
        <td><?php echo ++$ii; ?></td>
        <td><?php echo $child['edit_link']; ?></td>
        <td><?php echo $child['id']; ?></td>
    </tr>
<?php endforeach; ?>
