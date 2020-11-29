<?php
include "./config.php";
if (isset($_POST['id_product']))
{
    $query = "SELECT * FROM `shopping_cart` WHERE `id_product` = ".$_POST['id_product'];
    $result = mysqli_query($connection, $query);
    if(mysqli_num_rows($result) != 0 && $_POST['count'] == 'increment'){
        mysqli_query($connection, "UPDATE `shopping_cart` SET `count` = `count` + 1 WHERE `id_product` =  " . $_POST['id_product']) or die(mysqli_error($connection));
    }else if(mysqli_num_rows($result) != 0 && $_POST['count'] != 0){
        mysqli_query($connection, "UPDATE `shopping_cart` SET `count` = '".$_POST['count']."' WHERE `id_product` =  " . $_POST['id_product']) or die(mysqli_error($connection));
    }else if(mysqli_num_rows($result) == 0 && $_POST['count'] == 'increment'){
        mysqli_query($connection, "INSERT INTO `shopping_cart`  (`id_product`, `name`, `description`, `price`, `count`, `image`) VALUES (" . $_POST['id_product'] . ", '" . $_POST['name'] . "', '" . $_POST['description'] . "', '" . $_POST['price'] . "', 1, '".$_POST['image']."')") or die(mysqli_error($connection));
    }else if(mysqli_num_rows($result) != 0 && $_POST['count'] == 0){
        mysqli_query($connection, "DELETE FROM `shopping_cart` WHERE `id_product` = " . $_POST['id_product']);
    }
}
   $products = mysqli_query($connection,"SELECT * FROM `shopping_cart` ORDER BY `id_product` ");
   while($product = mysqli_fetch_assoc($products)){
   ?>
<tr class="product-item">
    <td class="text-center">
        <img style="width:100px; height:100px;" src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>"/>
    </td>
   <td>
        <p><?php echo $product['name']; ?> </p>
   </td>
   <td class="text-center">
        <input type="text" onchange="changeCount(<?php echo $product['id_product']; ?>)" class="form-control edit-count edit-count-<?php echo $product['id_product']; ?>" name="count" value="<?php echo $product['count']; ?>">
   </td>
   <td class="text-center">
      <p><strong  class="price" ><?php echo $product['price']; ?></strong>$</p>
      <p><?php echo $product['description']; ?></p>
   </td>
   <td class="text-center" style="width: 20%;">
      <span class="fa-stack ">
      <i class="fa fa-square fa-stack-2x "></i>
      <i onclick="deleteProduct(
            <?php echo $product['id_product']; ?>
            )" class="fa fa-trash-o fa-stack-1x fa-inverse del"></i>
      </span>
   </td>
</tr>
<?php
   }