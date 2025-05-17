<div class="modal fade fixed-right" id="update_<?php echo $expenses['expense_id']; ?>" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered  modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header align-items-center">
                <div class="text-center">
                    <h6 class="mb-0 text-bold">Update expense</h6>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="needs-validation" method="post" enctype="multipart/form-data" role="form">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="">Expense type</label>
                            <input type="hidden" value="<?php echo $expenses['expense_id']; ?>" required name="expense_id" class="form-control">
                            <input type="text" value="<?php echo $expenses['expense_type']; ?>" required name="expense_type" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Property details</label>
                            <select type="text" required name="expense_property_id" class="form-control select2bs4" style="width: 100%;">
                                <option value="<?php echo $expenses['property_id']; ?>"><?php echo $expenses['property_name']; ?></option>
                                <?php
                                $property_sql = mysqli_query(
                                    $mysqli,
                                    "SELECT * FROM properties WHERE  property_id != '{$expenses['property_id']}'"
                                );
                                if (mysqli_num_rows($property_sql) > 0) {
                                    while ($houses = mysqli_fetch_array($property_sql)) {
                                ?>
                                        <option value="<?php echo $houses['property_id']; ?>"><?php echo $houses['property_name']; ?></option>
                                <?php }
                                } ?>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="">House number (optional)</label>
                            <input type="text" name="expense_house_number" value="<?php echo $expenses['expense_house_number']; ?>" class="form-control">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="">Expense amount</label>
                            <input type="text" value="<?php echo $expenses['expense_amount']; ?>" required name="expense_amount" class="form-control">
                        </div>
                        <div class="form-group col-md-">
                            <label for="">Date</label>
                            <input type="text" value="<?php echo $expenses['expense_date']; ?>" required name="expense_date" class="form-control datepicker">
                        </div>
                    </div>
                    <div class="text-right">
                        <button type="submit" name="Update_Expense" class="btn btn-outline-success">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Delete Modal -->
<div class="modal fade" id="delete_<?php echo $expenses['expense_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form method="POST">
                <div class="modal-body text-center text-danger">
                    <img src='../public/img/bin.gif' height="120px">
                    <h4>Delete expense?</h4>
                    <br>
                    <!-- Hide This -->
                    <input type="hidden" name="expense_id" value="<?php echo $expenses['expense_id']; ?>">
                    <button type="button" class="text-center btn btn-success" data-dismiss="modal">No</button>
                    <button type="submit" name="Delete_Expense" class="text-center btn btn-danger">Yes, Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Modal -->