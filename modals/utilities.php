<div class="modal fade fixed-right" id="update_<?php echo $utilities['utility_id']; ?>" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered  modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header align-items-center">
                <div class="text-center">
                    <h6 class="mb-0 text-bold">Update utility</h6>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="needs-validation" method="post" enctype="multipart/form-data" role="form">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="">Utilities name</label>
                            <input type="text" required name="utility_id" value="<?php echo $utilities['utility_id']; ?>" class="form-control">
                            <input type="text" required name="utility_name" value="<?php echo $utilities['utility_name']; ?>" class="form-control">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="">Utility unit cost (Ksh)</label>
                            <input type="text" required name="utility_cost" value="<?php echo $utilities['utility_cost']; ?>" class="form-control">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="">Utility status</label>
                            <select name="utility_status" required class="form-control">
                                <option value="0" <?= ($utilities['utility_status'] == '0') ? 'selected' : '' ?>>Active</option>
                                <option value="1" <?= ($utilities['utility_status'] == '1') ? 'selected' : '' ?>>Inactive</option>
                            </select>
                        </div>

                    </div>
                    <div class="text-right">
                        <button type="submit" name="Update_Utility" class="btn btn-outline-success">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>