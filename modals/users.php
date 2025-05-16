<!-- Update -->
<div class="modal fade fixed-right" id="update_<?php echo $users['user_id']; ?>" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered  modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header align-items-center">
                <div class="text-center">
                    <h6 class="mb-0 text-bold">Update user</h6>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="needs-validation" method="post" enctype="multipart/form-data" role="form">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="">Full names</label>
                            <input type="hidden" required name="user_id" value="<?php echo $users['user_id']; ?>" class="form-control">
                            <input type="text" required name="user_names" value="<?php echo $users['user_names']; ?>" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Contacts</label>
                            <input type="text" required name="user_contact" value="<?php echo $users['user_contact']; ?>" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Access level</label>
                            <select type="text" required name="user_type" class="form-control select2bs4">
                                <?php if ($users['user_type'] == 'User') : ?>
                                    <option selected>User</option>
                                    <option>Administrator</option>
                                <?php else : ?>
                                    <option>User</option>
                                    <option selected>Administrator</option>
                                <?php endif; ?>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Login username</label>
                            <input type="text" required name="user_login_name" value="<?php echo $users['user_login_name']; ?>" class="form-control">
                        </div>
                    </div>
                    <div class="text-right">
                        <button type="submit" name="Update_Users" class="btn btn-outline-success">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Delete Modal -->
<div class="modal fade" id="delete_<?php echo $users['user_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form method="POST">
                <div class="modal-body text-center text-danger">
                    <img src='../public/img/bin.gif' height="120px">
                    <h4>Delete <?php echo $users['user_names']; ?>?</h4>
                    <br>
                    <!-- Hide This -->
                    <input type="hidden" name="user_id" value="<?php echo $users['user_id']; ?>">
                    <button type="button" class="text-center btn btn-success" data-dismiss="modal">No</button>
                    <button type="submit" name="Delete_Users" class="text-center btn btn-danger">Yes, Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Change password -->
<div class="modal fade fixed-right" id="password_<?php echo $users['user_id']; ?>" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered  modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header align-items-center">
                <div class="text-center">
                    <h6 class="mb-0 text-bold">Update user password</h6>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="needs-validation" method="post" enctype="multipart/form-data" role="form">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="">New password</label>
                            <input type="hidden" required name="user_id" value="<?php echo $users['user_id']; ?>" class="form-control">
                            <input type="password" required name="new_password" class="form-control" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{5,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 5 or more characters">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Confirm password</label>
                            <input type="password" required name="confirm_password" class="form-control" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{5,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 5 or more characters">
                        </div>
                    </div>
                    <div class="text-right">
                        <button type="submit" name="Change_Password" class="btn btn-outline-success">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>