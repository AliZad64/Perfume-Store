

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" enctype="multipart/form-data">
      <?php $errors = [];

$title = '';
$description = '';
$price = '';
$product = [
    'image' => ''
];
$quantity = '';
$brando = '';
$gendero = '';
$gen1 = ''; 
?>
      <div class="modal-body">
      <?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
        <?php foreach ($errors as $error): ?>
            <div><?php echo $error ?></div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
    
      <div class="modal-body">
    <?php if ($product['image']): ?> 
        <img src="../<?php echo $product['image'] ?>" class="product-img-view">
    <?php endif; ?>
    <div class="form-group">
        <label>Product Image</label><br>
        <input type="file" name="image">
    </div>
    <div class="form-group">
        <label>Product title</label>
        <input type="text" name="title" class="form-control" value="<?php echo $title ?>">
    </div>
    <div class="form-group">
        <label>Product description</label>
        <textarea class="form-control" name="description"><?php echo $description ?></textarea>
    </div>
    <div class="form-group">
        <label>Product price</label>
        <input type="number" step=".01" name="price" class="form-control" value="<?php echo $price ?>">
    </div>
    <div class="form-group">
        <label>Product quantity</label>
        <input type="number" step=".01" name="quantity" class="form-control" value="<?php echo $quantity ?>">
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
</form>
</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="Submit" name="create" class="btn btn-primary">Submit</button>
      </div>
      </form>
    </div>
  </div>
</div>