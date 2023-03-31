<div class="modal fade fixed-right" id="update_<?php echo $payments['payment_id']; ?>" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered  modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header align-items-center">
                <div class="text-center">
                    <h6 class="mb-0 text-bold">Update payment</h6>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="needs-validation" method="post" enctype="multipart/form-data" role="form">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="">Invoice Number</label>
                            <input readonly type="hidden" value="<?php echo $payments['payment_id']; ?>" required name="payment_id" class="form-control">
                            <input readonly type="text" value="<?php echo $payments['payment_invoice_number']; ?>" required name="payment_invoice_number" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Payment Amount</label>
                            <input type="text" value="<?php echo $payments['payment_amount']; ?>" required name="payment_amount" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Payment Means</label>
                            <select type="text" required name="payment_type" class="form-control select2bs4">
                                <?php
                                if ($payments['payment_type'] == 'Mpesa') {
                                    echo '
                                    <option selected>Mpesa</option>
                                    <option>Bank Deposit</option>
                                    <option>Cash</option>  
                                    ';
                                } else if ($payments['payment_type'] == 'Bank Deposit') {
                                    echo '
                                    <option selected>Bank Deposit</option>
                                    <option>Mpesa</option>
                                    <option>Cash</option>
                                    ';
                                } else if ($payments['payment_type'] == 'Cash') {
                                    echo '
                                    <option selected>Cash</option>
                                    <option>Mpesa</option>
                                    <option>Bank Deposit</option>
                                    ';
                                } else {
                                    echo '<option selected>Choose Payment Means</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Date Paid</label>
                            <input type="text" value="<?php echo $payments['payment_date']; ?>" required name="payment_date" class="form-control datepicker">
                        </div>
                    </div>
                    <div class="text-right">
                        <button type="submit" name="Update_Payment" class="btn btn-outline-success">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Delete Modal -->
<div class="modal fade" id="delete_<?php echo $payments['payment_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form method="POST">
                <div class="modal-body text-center text-danger">
                    <img src='../public/img/bin.gif' height="120px">
                    <h4>Delete <?php echo $payments['payment_id']; ?>?</h4>
                    <br>
                    <!-- Hide This -->
                    <input type="hidden" name="payment_id" value="<?php echo $payments['payment_id']; ?>">
                    <button type="button" class="text-center btn btn-success" data-dismiss="modal">No</button>
                    <button type="submit" name="Delete_Payment" class="text-center btn btn-danger">Yes, Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Modal -->