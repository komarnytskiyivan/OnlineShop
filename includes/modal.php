<div class="modal" id="ModalAdd" tabindex="-1" role="dialog">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Buy product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group" style="display:none;">
            <label for="name" class="col-form-label">Id:</label>
            <input type="text" class="form-control edit-item-id" readonly name="id" placeholder="id">
          </div>
          <div class="form-group">
            <label for="name" class="col-form-label">Name:</label>
            <input type="text" class="form-control" readonly name="name">
          </div>
          <div class="form-group">
            <label for="pricing" class="col-form-label">Pricing:</label>
            <input type="text" class="form-control" readonly name="pricing">
          </div>
          <div class="form-group">
            <label for="count" class="col-form-label">Count:</label>
            <input type="text" class="form-control" required name="count">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary add-product" data-dismiss="modal">Add to cart</button>
      </div>
   </div>
</div>
</div>
<div class="modal" id="ModalConfirm" tabindex="-1" role="dialog">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title modal-title-confirm">Confirm action</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <p class="modal-text modal-text-confirm">Are you sure want to do this?</p>
         </div>
         <div class="modal-footer">
            <a href="" class="btn btn-primary btn-save-changes btn-delete-solo" data-dismiss="modal">Apply</a>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
         </div>
      </div>
   </div>
</div>
<div class="modal" id="ModalCart" tabindex="-1" role="dialog">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title modal-title-confirm">My cart</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div>
         <div class="modal-body">
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
                                                <th class="text-center"><span>Count</span></th>
                                                <th class="text-center"><span>Pricing</span></th>
                                                <th class="text-center"><span>Delete</span></th>
                                            </tr>
                                        </thead>
                                        <tbody class="modal-cart-content">
                                                <?php 
                                                $products = mysqli_query($connection,"SELECT * FROM `shopping_cart` WHERE `count` >= 1 ORDER BY `id` ");
                                                ?>
                                                <?php
                                                while($product = mysqli_fetch_assoc($products)){
                                                ?>
                                                <tr class="product-item">
                                                <td>
                                                        <p><?php echo $product['name']; ?> </p>
                                                </td>
                                                <td class="text-center">
                                                        <!-- <p><?php echo $product['count']; ?></p> -->
                                                        <input type="text" onchange="changeCount(<?php echo $product['id']; ?>)" class="form-control edit-count" name="count" value="<?php echo $product['count']; ?>">
                                                </td>
                                                <td class="text-center">
                                                    <p><?php echo $product['price']; ?></p>
                                                    <p><?php echo $product['description']; ?></p>
                                                </td>
                                                <td class="text-center" style="width: 20%;">
                                                    <span class="fa-stack ">
                                                    <i class="fa fa-square fa-stack-2x "></i>
                                                    <i onclick="deleteProduct(
                                                            <?php echo $product['id']; ?>
                                                            )" class="fa fa-trash-o fa-stack-1x fa-inverse del btn-delete-submit"></i>
                                                    </span>
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
         </div>
            <div class="form-group">
                <label for="delivery">Please select delivery:</label>
                <select class="form-control select-delivery" id="delivery">
                <option value=""></option>
                <option value="pickup">Pick Up(0 USD)</option>
                <option value="ups">UPS(5)</option>
                </select>
            </div>
         </div>
         <div class="modal-footer">
            <button type="submit" class="btn btn-primary cart-pay"  onclick="submitProducts()" data-dismiss="modal">Please select delivery</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
         </div>
      </div>
   </div>
</div>