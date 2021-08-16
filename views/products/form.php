<?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
        <?php foreach ($errors as $error): ?>
            <div><?php echo $error ?></div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<form method="post" enctype="multipart/form-data" class="mx-auto mt-3" style="width: 800px">
    <?php if ($product['image']): ?> 
        <img src="../<?php echo $product['image'] ?>" class="product-img-view" style="width: 100px">
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
    <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Price</label>
      <input type="number" step=".01" name="price" class="form-control" value="<?php echo $price ?>">
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">discount %</label>
      <input type="number" step=".01" name="discount" class="form-control" value="<?php echo $discount ?>">
    </div>
  </div>
    <div class="form-group">
        <label>Product quantity</label>
        <input type="number" step=".01" name="quantity" class="form-control" value="<?php echo $quantity ?>">
    </div>
    <!-- select brand -->
    <div>
<select class="form-select form-select-sm" aria-label=".form-select-sm example" name = "brand">
    <option value = "" selected></option>
        <?php foreach($brand as $bra) { ?>
    <option value="<?php echo $bra['bid'] ?>" <?php if ($bra1 == $bra['bid']) { echo "selected";} ?>>  <?php echo $bra['tit'] ?> </option>
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
    <button type="submit" class="btn btn-primary">Submit</button>
</form>