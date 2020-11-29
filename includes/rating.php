<?php
include "./config.php";
mysqli_query($connection, "INSERT INTO `rates`  (`new_rate`,`id_product`) VALUES (" . $_POST['new_rate']."," . $_POST['id_product'].")") or die(mysqli_error($connection));
$update_rate = mysqli_query($connection,"UPDATE `products`  SET `rate` =  (SELECT AVG(`new_rate`) FROM `rates` WHERE `id_product` = ".$_POST['id_product'].") WHERE `id` =  " . $_POST['id_product']);
$current_rate = mysqli_query($connection,"SELECT * FROM `products` WHERE id = ".$_POST['id_product']);
while($current = mysqli_fetch_assoc($current_rate)){
?>
<strong><?php echo $current['rate'];?></strong>
<?php
}

