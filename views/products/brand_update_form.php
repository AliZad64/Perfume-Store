<div class="modal fade" id="UpdateBrand<?php echo $br['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    <form method="POST" action="../../public/brands/brand_edit.php" enctype="multipart/form-data">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="mb-3">
      <input type="hidden" name = "id" value="<?php echo $br['id'] ?>">
    <label for="exampleInputEmail1" class="form-label">Brand name</label>
    <input type="text" class="form-control" name = "title" value="<?php echo $br['brands_title'] ?> ">
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
