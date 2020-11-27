<?php
include "./config.php";
if (isset($_GET['delete']))
{
    mysqli_query($connection, "DELETE FROM `products` WHERE `id` =" . $_GET['delete']);
    unset($_GET['delete']);
}
if (isset($_GET['deleteMany']))
{
    $id = explode(",", $_GET['deleteMany']);
    for ($i = 0;$i < count($id) - 1;$i++)
    {
        mysqli_query($connection, "DELETE FROM `products` WHERE `id` =" . $id[$i]);
    }
    unset($_GET['deleteMany']);
}
if (isset($_GET['setActive']))
{
    $id = explode(",", $_GET['setActive']);
    for ($i = 0;$i < count($id) - 1;$i++)
    {
        mysqli_query($connection, "UPDATE `products` SET `status` = 'on' WHERE `id` =" . $id[$i]);
    }
    unset($_GET['setActive']);
}
if (isset($_GET['setNotActive']))
{
    $id = explode(",", $_GET['setNotActive']);
    for ($i = 0;$i < count($id) - 1;$i++)
    {
        mysqli_query($connection, "UPDATE `products` SET `status` = '' WHERE `id` =" . $id[$i]);
    }
    unset($_GET['setNotActive']);
}
if (isset($_POST['addid']))
{
    $query = "SELECT * FROM `shopping_cart` WHERE `id` = ".$_POST['addid'];
    $result = mysqli_query($connection, $query);
    $file = 'query.txt';
    file_put_contents($file, mysqli_num_rows($result));
    if(mysqli_num_rows($result) == 0 && $_POST['count'] != 0){
        mysqli_query($connection, "INSERT INTO `shopping_cart`  (`name`, `description`, `price`, `count`) VALUES ('" . $_POST['name'] . "', '" . $_POST['description'] . "', '" . $_POST['price'] . "', '" . $_POST['count'] . "')") or die(mysqli_error($connection));
    }else if(mysqli_num_rows($result) != 0 && $_POST['count'] != 0){
        mysqli_query($connection, "UPDATE `shopping_cart` SET `count` = '" . $_POST['count'] . "' WHERE `id` =  " . $_POST['addid']) or die(mysqli_error($connection));
    }else if(mysqli_num_rows($result) != 0 && $_POST['count'] == 0){
        mysqli_query($connection, "DELETE FROM `shopping_cart` WHERE `id` = " . $_POST['addid']);
    }
    unset($_POST['addid']);
}
?>
<?php 
   $products = mysqli_query($connection,"SELECT * FROM `shopping_cart` WHERE `count` >= 1 ORDER BY `id` ");
   ?>
<?php
   while($product = mysqli_fetch_assoc($products)){
   ?>
<tr>
   <td>
        <p><?php echo $product['name']; ?> </p>
   </td>
   <td class="text-center">
        <input type="text" onchange="changeCount(<?php echo $product['id']; ?>)" class="form-control edit-count" name="count" value="<?php echo $product['count']; ?>">
   </td>
   <td class="text-center">
      <p><?php echo $product['price']; ?></p>
      <p><?php echo $product['description']; ?></p>
   </td>
   <td class="text-center" style="width: 20%;">
      <a data-toggle="modal" data-target="#ModalConfirm" class="table-link danger delete-item ">
      <span class="fa-stack ">
      <i class="fa fa-square fa-stack-2x "></i>
      <i id="<?php echo $product['id'] ?>" class="fa fa-trash-o fa-stack-1x fa-inverse del btn-delete-submit"></i>
      </span>
      </a>
   </td>
</tr>
<?php
   }
?>