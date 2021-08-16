<div class="modal fade bd-example-modal-lg" id="UpdateBrand<?php echo $order['orid'] ?>" tabindex="-1" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    <form method="POST" action="../../public/brands/brand_edit.php" enctype="multipart/form-data">
      <div class="modal-header">
        <h5 class="modal-title" id="myLargeModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="mb-3">
      <?php foreach ($carts as $cart) { ?>
    <?php  if ($order['orid'] == $cart['order_id']) { ?>
        <p> <?php echo $cart['title'] ?> <br> <?php echo $cart ['price'];?>
        </p>
        <?php } ?>
     <?php } ?>
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
      
    </div>
  </div>
  </form>
</div>
