<!----CREATE MODAL---->
<div class="modal fade" id="CreateBrand" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    <form method="POST" action="../../public/coupons/coupon_create.php" enctype="multipart/form-data">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create Brand</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
         <label for="exampleInputEmail1" class="form-label">coupon discount percentage</label>
            <input type="text" class="form-control" name = "discount">%
             </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="create">Save changes</button>
        
      </div>
        </div>
        </div>
</form>
</div>