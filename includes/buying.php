<?php
include "./config.php";
    mysqli_query($connection, "INSERT INTO `pays`  (`prev_balance`, `sum`, `next_balance`) VALUES (" . $_POST['prev_balance'] . ", " . $_POST['sum'] . ", " . $_POST['next_balance'].")") or die(mysqli_error($connection));
   $pays = mysqli_query($connection,"SELECT * FROM `pays` ORDER BY `id` DESC LIMIT 1");
   $delete = mysqli_query($connection,"TRUNCATE TABLE `shopping_cart`");
   ?>
   <table class="table">
       <thead>
           <tr>
               <th class="text-center"><span>Image</span></th>
               <th class="text-center"><span>Name</span></th>
               <th class="text-center"><span>Count</span></th>
               <th class="text-center"><span>Pricing</span></th>
               <th class="text-center"><span>Delete</span></th>
           </tr>
       </thead>
       <tbody class="modal-cart-products">
           <?php 
               $products = mysqli_query($connection,"SELECT * FROM `shopping_cart` WHERE `count` >= 1 ORDER BY `id` ");
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
           ?>
       </tbody>
   </table>
   <table class="table">
<thead>
   <tr>
       <th class="text-center"><span>Previous balance</span></th>
       <th class="text-center"><span>Sum of payment</span></th>
       <th class="text-center"><span>Balance after purchasing</span></th>
   </tr>
</thead>
<tbody class="modal-cart-pays">
   <?php 
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
   <p>My balance is: <strong class="balance"><?php echo $pay['next_balance']; ?></strong> $</p>
   <?php
       }
       ?>
</tbody>
</table>