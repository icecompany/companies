<?php
defined('_JEXEC') or die;
$ii = 0;
?>
<?php foreach ($this->item->contacts as $person): ?>
    <tr>
        <td><?php echo ++$ii; ?></td>
        <td><?php echo $person['edit_link']; ?></td>
        <td><?php echo $person['post']; ?></td>
        <td><?php echo $person['phone_work_link']; ?></td>
        <td><?php echo $person['phone_mobile_link']; ?></td>
        <td><?php echo $person['email_link']; ?></td>
        <td><?php echo $person['main']; ?></td>
        <td><?php echo $person['for_accreditation']; ?></td>
        <td><?php echo $person['for_building']; ?></td>
        <td><?php echo $person['comment']; ?></td>
        <td><?php echo $person['delete_link']; ?></td>
        <td><?php echo $person['id']; ?></td>
    </tr>
<?php endforeach; ?>
