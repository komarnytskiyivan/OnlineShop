<?php
include "./config.php";
mysqli_query($connection, "INSERT INTO `pays`  (`prev_balance`, `sum`, `next_balance`) VALUES (" . $_POST['prev_balance'] . ", " . $_POST['sum'] . ", " . $_POST['next_balance'].")") or die(mysqli_error($connection));
$pays = mysqli_query($connection,"SELECT * FROM `pays` ORDER BY `id` DESC LIMIT 1");
while($pay = mysqli_fetch_assoc($pays)){
     ?>
     <tr>
     <td class="text-center" style="width: 20%;">
          <p><?php echo $pay['prev_balance']; ?> </p>
     </td>
     <td class="text-center" style="width: 20%;">
          <p><?php echo $pay['sum']; ?> </p>
     </td>
     <td class="text-center" style="width: 20%;">
          <p><?php echo $pay['next_balance']; ?> </p>
     </td>
     </tr>
     <?php
}