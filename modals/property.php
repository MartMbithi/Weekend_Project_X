<div class="modal fade fixed-right" id="update_<?php echo $properties['property_id']; ?>" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered  modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header align-items-center">
                <div class="text-center">
                    <h6 class="mb-0 text-bold">Update property</h6>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="needs-validation" method="post" enctype="multipart/form-data" role="form">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="">Property name</label>
                            <input type="hidden" value="<?php echo $properties['property_id']; ?>" required name="property_id" class="form-control">
                            <input type="text" value="<?php echo $properties['property_name']; ?>" required name="property_name" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Property location</label>
                            <input type="text" value="<?php echo $properties['property_location']; ?>" required name="property_location" class="form-control">
                        </div>
                    </div>
                    <div class="text-right">
                        <button type="submit" name="Update_Property" class="btn btn-outline-success">Update</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>


<!-- Delete Modal -->
<div class="modal fade" id="delete_<?php echo $properties['property_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form method="POST">
                <div class="modal-body text-center text-danger">
                    <img src='../public/img/bin.gif' height="120px">
                    <h4>Delete <?php echo $properties['property_name']; ?>?</h4>
                    <br>
                    <!-- Hide This -->
                    <input type="hidden" name="property_id" value="<?php echo $properties['property_id']; ?>">
                    <button type="button" class="text-center btn btn-success" data-dismiss="modal">No</button>
                    <button type="submit" name="Delete_Property" class="text-center btn btn-danger">Yes, Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Modal -->