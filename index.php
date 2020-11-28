<?php require "./includes/config.php"; ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <title>Panel</title>
      <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
      <link href="./includes/style.css" rel="stylesheet">
   </head>
   <body>
      <?php include "./includes/modal.php" ?>
      <hr>
      <div class="container bootstrap snippets bootdey">
         <div class="row">
            <div class="col-lg-12">
               <div class="main-box no-header clearfix">
                  <div class="main-box-body clearfix">
                    <button data-toggle="modal" data-target="#ModalCart" type="button" class="btn btn-primary cart-button">My cart</button>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="container bootstrap snippets bootdey">
         <div class="row">
            <div class="col-lg-12">
               <div class="main-box no-header clearfix">
                  <div class="main-box-body clearfix">
                     <div class="table-responsive ">
                        <table class="table user-list">
                           <thead>
                              <tr>
                                 <th class="text-center"><span>Name</span></th>
                                 <th class="text-center"><span>Pricing</span></th>
                                 <th class="text-center"><span>Buy</span></th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php 
                                 $products = mysqli_query($connection,"SELECT * FROM `products` ORDER BY `id` ");
                                 while($product = mysqli_fetch_assoc($products)){
                                 ?>
                              <tr>
                                 <td class="text-center" style="width: 20%;">
                                    <p><?php echo $product['name']; ?></p> 
                                 </td>
                                 <td class="text-center">
                                    <p><?php echo $product['price']; ?>$</p> 
                                    <p><?php echo $product['description']; ?></p> 
                                 </td>
                                 <td class="text-center" style="width: 20%;">
                                    <button onclick="addProduct(
                                       <?php echo $product['id']; ?>,
                                       `<?php echo $product['name']; ?>`,
                                       `<?php echo $product['description']; ?>`, 
                                       <?php echo $product['price']; ?>
                                       )" type="button" class="btn btn-primary add-to-cart">Add to cart
                                    </button>
                                 </td>
                              </tr>
                              <?php
                                 }
                              ?>
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css">
      <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
      <script src="./includes/main.js" type="text/javascript"></script>
   </body>
</html>