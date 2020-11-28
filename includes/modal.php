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
                    <p>My balance is: <strong class="balance">100</strong> $</p>
                    <table class="table">
                        <thead>
                            <tr>
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
                                <td>
                                    <p><?php echo $product['name']; ?> </p>
                                </td>
                                <td class="text-center">
                                    <!-- <p><?php echo $product['count']; ?></p> -->
                                    <input type="text" onchange="changeCount(<?php echo $product['id_product']; ?>)" class="form-control edit-count edit-count-<?php echo $product['id_product']; ?>" name="count" value="<?php echo $product['count']; ?>">
                                </td>
                                <td class="text-center">
                                    <p class="price" ><?php echo $product['price']; ?></p>
                                    <p><?php echo $product['description']; ?></p>
                                </td>
                                <td class="text-center" style="width: 20%;">
                                    <span class="fa-stack ">
                                    <i class="fa fa-square fa-stack-2x "></i>
                                    <i onclick="deleteProduct(
                                        <?php echo $product['id']; ?>
                                        )" class="fa fa-trash-o fa-stack-1x fa-inverse del"></i>
                                    </span>
                                </td>
                            </tr>
                            <?php
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="form-group">
                    <label for="delivery">Please select delivery:</label>
                    <select class="form-control select-delivery" id="delivery">
                        <option value=""></option>
                        <option value="0">Pick Up(0 USD)</option>
                        <option value="5">UPS(5)</option>
                    </select>
                </div>
            </div>
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
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary cart-pay"  onclick="submitProducts()" data-dismiss="modal">Pay</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>z