<?php
/**
 * @var $payments array
 */
foreach ($payments as $payment): ?>
    <tr>
        <td><?= $payment['serial'] ?></td>
        <td><?= date('d-m-Y', strtotime($payment['payment_date']));?></td>
        <td><?= $payment['monthly_amount'] ?> Тг.</td>
        <td><?= $payment['percent_amount'] ?> Тг.</td>
        <td><?= $payment['main_amount']?> Тг.</td>
        <td><?= $payment['principal_debt']?> Тг.</td>
    </tr>
<?php endforeach; ?>