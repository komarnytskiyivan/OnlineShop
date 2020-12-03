<?php require "./includes/config.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>OnlineShop</title>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="./includes/style.css" rel="stylesheet">
</head>

<body>
    <div class="modal" id="ModalCart" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">My cart</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div>
                    <div class="modal-body">
                        <p>My balance is: <strong class="balance">
                        <?php
                        $balance = mysqli_query($connection,"SELECT * FROM `pays` ORDER BY `id` DESC LIMIT 1");
                        if(mysqli_num_rows($balance) > 0){
                            while($money = mysqli_fetch_assoc($balance)){
                                echo $money['next_balance'];
                            }
                        }else{
                            echo "100";
                        }
                        ?>
                        </strong> $</p>
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
                                $products = mysqli_query($connection,"SELECT * FROM `shopping_cart` ORDER BY `id` ");
                                while($product = mysqli_fetch_assoc($products)){
                                ?>
                                <tr class="product-item">
                                    <td class="text-center">
                                        <img style="width:100px; height:100px;" src="<?php echo $product['image']; ?>"
                                            alt="<?php echo $product['name']; ?>" />
                                    </td>
                                    <td>
                                        <p><?php echo $product['name']; ?> </p>
                                    </td>
                                    <td class="text-center">
                                        <input type="text" onchange="changeCount(<?php echo $product['id_product']; ?>)"
                                            class="form-control edit-count edit-count-<?php echo $product['id_product']; ?>"
                                            name="count" value="<?php echo $product['count']; ?>">
                                    </td>
                                    <td class="text-center">
                                        <p><strong class="price"><?php echo $product['price']; ?></strong>$</p>
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
                                <?php
                        }
                        ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="form-group">
                    <label for="delivery">Please select delivery:</label>
                    <select class="select-delivery" id="delivery">
                        <option value=""></option>
                        <option value="0">Pick Up(0 USD)</option>
                        <option value="5">UPS(5)</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary cart-pay" onclick="submitProducts()"
                        data-dismiss="modal">Pay</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="ModalAdd" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">My cart</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="count" class="col-form-label">Count:</label>
                        <input type="text" class="form-control adding_count" required name="count">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-add-count" data-dismiss="modal">Add</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="container bootstrap snippets bootdey">
        <div class="row">
            <div class="col-lg-12">
                <div class="main-box no-header clearfix">
                    <div class="main-box-body clearfix">
                        <button data-toggle="modal" data-target="#ModalCart" type="button"
                            class="btn btn-primary cart-button">My cart</button>
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
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="text-center"><span>Image</span></th>
                                        <th class="text-center"><span>Name</span></th>
                                        <th class="text-center"><span>Pricing</span></th>
                                        <th class="text-center"><span>Rate product</span></th>
                                        <th class="text-center"><span>Buy</span></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                 $products = mysqli_query($connection,"SELECT * FROM `products` ORDER BY `id` ");
                                 while($product = mysqli_fetch_assoc($products)){
                                 ?>
                                    <tr>
                                        <td class="text-center">
                                            <img style="width:100px; height:100px;"
                                                src="<?php echo $product['image']; ?>"
                                                alt="<?php echo $product['name']; ?>" />
                                        </td>
                                        <td class="text-center" style="width: 20%;">
                                            <p><?php echo $product['name']; ?></p>
                                        </td>
                                        <td class="text-center">
                                            <p><?php echo $product['price']; ?>$</p>
                                            <p><?php echo $product['description']; ?></p>
                                        </td>
                                        <td class="text-center">
                                            <div class="rate">
                                                <label for="rate">Rate this:</label>
                                                <select class="select-rate select-rate-<?php echo $product['id']; ?>"
                                                    id="rate" onchange="changeRate(<?php echo $product['id']; ?>)">
                                                    <option value=""></option>
                                                    <option value="0">0</option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                </select>
                                                <p class="current-rate-<?php echo $product['id']; ?>">
                                                    Current:<strong><?php echo $product['rate']; ?></strong>
                                                    <p>
                                            </div>
                                        </td>
                                        <td class="text-center" style="width: 20%;">
                                            <button data-toggle="modal" data-target="#ModalAdd" onclick="addProduct(
                                       <?php echo $product['id']; ?>,
                                       `<?php echo $product['name']; ?>`,
                                       `<?php echo $product['description']; ?>`,
                                       <?php echo $product['price']; ?>,
                                       `<?php echo $product['image']; ?>`
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
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
    <script src="./includes/main.js" type="text/javascript"></script>
</body>

</html>