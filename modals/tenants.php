<!-- Update -->
<div class="modal fade fixed-right" id="update_<?php echo $tenants['tenant_id']; ?>" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered  modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header align-items-center">
                <div class="text-center">
                    <h6 class="mb-0 text-bold">Update tenant</h6>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="needs-validation" method="post" enctype="multipart/form-data" role="form">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="">Tenant full names</label>
                            <input type="hidden" value="<?php echo $tenants['tenant_id']; ?>" required name="tenant_id" class="form-control">
                            <input type="text" value="<?php echo $tenants['tenant_name']; ?>" required name="tenant_name" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Tenant national id</label>
                            <input type="text" value="<?php echo $tenants['tenant_national_id']; ?>" required name="tenant_national_id" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Tenant mobile number</label>
                            <input type="text" value="<?php echo $tenants['tenant_mobile_number']; ?>" required name="tenant_mobile_number" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Tenant date registered</label>
                            <input type="text" value="<?php echo $tenants['tenant_date_of_registration']; ?>" required name="tenant_date_of_registration" class="form-control datepicker">
                        </div>
                    </div>
                    <div class="text-right">
                        <button type="submit" name="Update_Tenants" class="btn btn-outline-success">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Delete Modal -->
<div class="modal fade" id="delete_<?php echo $tenants['tenant_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form method="POST">
                <div class="modal-body text-center text-danger">
                    <img src='../public/img/bin.gif' height="120px">
                    <h4>Delete <?php echo $tenants['tenant_name']; ?>?</h4>
                    <br>
                    <!-- Hide This -->
                    <input type="hidden" name="tenant_id" value="<?php echo $tenants['tenant_id']; ?>">
                    <input type="hidden" name="tenant_house_id" value="<?php echo $tenants['tenant_house_id']; ?>">
                    <button type="button" class="text-center btn btn-success" data-dismiss="modal">No</button>
                    <button type="submit" name="Delete_Tenants" class="text-center btn btn-danger">Yes, Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Swap House -->
<div class="modal fade fixed-right" id="swap_<?php echo $tenants['tenant_id']; ?>" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered  modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header align-items-center">
                <div class="text-center">
                    <h6 class="mb-0 text-bold">Swap house</h6>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="needs-validation" method="post" enctype="multipart/form-data" role="form">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="">Select New House</label>
                            <input type="hidden" value="<?php echo $tenants['tenant_id']; ?>" required name="tenant_id" class="form-control">
                            <input type="hidden" value="<?php echo $tenants['tenant_house_id']; ?>" required name="tenant_old_house_id" class="form-control">
                            <?php if ($_SESSION['user_type'] == 'Administrator') { ?>
                                <div class="form-group col-md-12">
                                    <select type="text" required name="tenant_house_id" class="form-control select2bs4">
                                        <option value="">Select house details</option>
                                        <?php
                                        $property_sql = mysqli_query(
                                            $mysqli,
                                            "SELECT * FROM properties p
                                        INNER JOIN houses h ON p.property_id = h.house_property_id
                                        WHERE h.house_status = 'Vacant'"
                                        );
                                        if (mysqli_num_rows($property_sql) > 0) {
                                            while ($houses = mysqli_fetch_array($property_sql)) {
                                        ?>
                                                <option value="<?php echo $houses['house_id']; ?>">Property name: <?php echo $houses['property_name'] . ' - House number:' . $houses['house_number']; ?></option>
                                        <?php }
                                        } ?>
                                    </select>
                                </div>
                            <?php } else { ?>
                                <div class="form-group col-md-12">
                                    <select type="text" required name="tenant_house_id" class="form-control select2bs4">
                                        <option value="">Select house details</option>
                                        <?php
                                        $property_sql = mysqli_query(
                                            $mysqli,
                                            "SELECT * FROM properties p
                                        INNER JOIN houses h ON p.property_id = h.house_property_id
                                        WHERE h.house_status = 'Vacant' AND p.property_caretaker_id = '{$_SESSION['user_id']}'"
                                        );
                                        if (mysqli_num_rows($property_sql) > 0) {
                                            while ($houses = mysqli_fetch_array($property_sql)) {
                                        ?>
                                                <option value="<?php echo $houses['house_id']; ?>">House number: <?php echo  $houses['house_number']; ?></option>
                                        <?php }
                                        } ?>
                                    </select>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="text-right">
                        <button type="submit" name="Update_House" class="btn btn-outline-success">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>