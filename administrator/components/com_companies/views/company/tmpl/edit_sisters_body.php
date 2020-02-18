<?php
defined('_JEXEC') or die;
$ii = 0;
?>
<?php foreach ($this->item->sisters as $sister): ?>
    <tr>
        <td><?php echo ++$ii; ?></td>
        <td><?php echo $sister['title']; ?></td>
        <td><?php echo $sister['city']; ?></td>
        <td><?php echo $sister['id']; ?></td>
    </tr>
<?php endforeach; ?>
