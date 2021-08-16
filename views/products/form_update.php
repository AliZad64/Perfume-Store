<div class="modal fade" id="update_modal<?php echo $product['kek']?>" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="post" action="../../public/products/update.php" enctype="multipart/form-data"> 
        <div class="modal-header">
          <h3 class="modal-title">Update User</h3>
        </div>
        <div class="modal-body">
          <div class="col-md-2"></div>
          <div class="col-md-8">
          <?php if ($product['image']): ?> 
        <img src="../<?php echo $product['image'] ?>" class="product-img-view">
    <?php endif; ?>
    <div class="form-group">
        <label>Product Image</label><br>
        <input type="file" name="image" class="form-control">
    </div>
    <div class="form-group">
    <input type="hidden" name="id" value="<?php echo $product['kek']?>">
        <label>Product title</label>
        <input type="text" name="title" class="form-control" value="<?php echo $product['title'] ?>">
    </div>
    <div class="form-group">
        <label>Product description</label>
        <textarea class="form-control" name="description"><?php echo $product['description'] ?></textarea>
    </div>
    <div class="form-group">
        <label>Product price</label>
        <input type="number" step=".01" name="price" class="form-control" value="<?php echo $product['price'] ?>">
    </div>
    <div class="form-group">
        <label>Product quantity</label>
        <input type="number" step=".01" name="quantity" class="form-control" value="<?php echo $product['quantity'] ?>">
    </div>
    <!-- select brand -->
    <div>
<select class="form-select form-select-sm" aria-label=".form-select-sm example" name = "brand">
    <option selected></option>
        <?php foreach($brand as $bra) { ?>
    <option value="<?php echo $bra['bid'] ?>"> <?php echo $bra['tit'] ?> </option>
    <?php   } ?>
</select>
    </div>

<div>
<select class="form-select form-select-sm" aria-label=".form-select-sm example" name = "gender">
        <?php foreach($gender as $gen) { ?>
    <option value="<?php echo $gen['gid'] ?>" <?php if ($gen1 == $gen['gid']) { echo "selected";} ?> > <?php echo $gen['genders_title'] ?> </option>
    <?php   } ?>
</select>
</div>
          </div>
        </div>
        <div style="clear:both;"></div>
        <div class="modal-footer">
          <button  name="update" class="btn btn-warning">Update </button>
          <button class="btn btn-danger" type="button" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Close</button>
        </form>    
        </div>
        </div>
    </div>
  </div>
</div>