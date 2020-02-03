<?php
defined('_JEXEC') or die;
$ii = 0;
?>
<?php foreach ($this->item->contacts as $person): ?>
    <tr>
        <td><?php echo ++$ii; ?></td>
        <td><?php echo $person['edit_link']; ?></td>
        <td><?php echo $person['post']; ?></td>
        <td><a href="tel:<?php echo $person['phone_work']; ?>"><?php echo $person['phone_work']; ?></a></td>
        <td><a href="tel:<?php echo $person['phone_mobile']; ?>"><?php echo $person['phone_mobile']; ?></a></td>
        <td><a href="mailto:<?php echo $person['email']; ?>"><?php echo $person['email']; ?></a></td>
        <td><?php echo $person['for_accreditation']; ?></td>
        <td><?php echo $person['for_building']; ?></td>
        <td><?php echo $person['comment']; ?></td>
        <td><?php echo $person['delete_link']; ?></td>
        <td><?php echo $person['id']; ?></td>
    </tr>
<?php endforeach; ?>
