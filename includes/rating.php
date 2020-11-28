<?php
include "./config.php";
mysqli_query($connection, "UPDATE `products`  SET `rate` =(`rate` + ".$_POST['rate'].")/2 WHERE `id` =  " . $_POST['id_product']) or die(mysqli_error($connection));
$current_rate = mysqli_query($connection,"SELECT * FROM `products` WHERE id = ".$_POST['id_product']);
while($current = mysqli_fetch_assoc($current_rate)){
?>
<strong><?php echo $current['rate'];?></strong>
<?php
}
