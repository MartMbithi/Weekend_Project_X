<div class="modal fade fixed-right" id="update_<?php echo $houses['house_id']; ?>" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered  modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header align-items-center">
                <div class="text-center">
                    <h6 class="mb-0 text-bold">Update house</h6>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="needs-validation" method="post" enctype="multipart/form-data" role="form">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="">Property name</label>
                            <select type="text" required name="house_property_id" class="form-control">
                                <option value="<?php echo $houses['property_id']; ?>"><?php echo $houses['property_name'] . ' ' . $houses['property_location']; ?></option>
                                <?php
                                $property_sql = mysqli_query(
                                    $mysqli,
                                    "SELECT * FROM properties WHERE property_id != '{$houses['property_id']}'"
                                );
                                if (mysqli_num_rows($property_sql) > 0) {
                                    while ($properties = mysqli_fetch_array($property_sql)) {
                                ?>
                                        <option value="<?php echo $properties['property_id']; ?>"><?php echo $properties['property_name'] . ' ' . $properties['property_location']; ?></option>
                                <?php }
                                } ?>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">House number</label>
                            <input type="hidden" value="<?php echo $houses['house_id']; ?>" required name="house_id" class="form-control">
                            <input type="text" value="<?php echo $houses['house_number']; ?>" required name="house_number" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">House category</label>
                            <select type="text" required name="house_category" class="form-control">
                                <?php
                                if ($houses['house_category'] == 'Singles') {
                                    echo '
                                        <option selected>Singles</option>
                                        <option>Bedsitters</option>
                                        <option>One Bedrooms</option>
                                        <option>Two Bedrooms</option>
                                    ';
                                } else if ($houses['house_category'] == 'Bedsitters') {
                                    echo '
                                        <option selected>Bedsitters</option>
                                        <option>Singles</option>
                                        <option>One Bedrooms</option>
                                        <option>Two Bedrooms</option>
                                    ';
                                } else if ($houses['house_category'] == 'One Bedrooms') {
                                    echo '<option selected>One Bedrooms</option>
                                        <option>Singles</option>
                                        <option>Bedsitters</option>
                                        <option>Two Bedrooms</option>';
                                } else if ($houses['house_category'] == 'Two Bedrooms') {
                                    echo '
                                        <option selected>Two Bedrooms</option>
                                        <option>Singles</option>
                                        <option>Bedsitters</option>
                                        <option>One Bedrooms</option>
                                    ';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">House status</label>
                            <select type="text" required name="house_status" class="form-control">
                                <?php if ($houses['house_status'] == 'Vacant') { ?>
                                    <option selected>Vacant</option>
                                    <option>Occupied</option>
                                <?php } else { ?>
                                    <option>Vacant</option>
                                    <option selected>Occupied</option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">House rent (Ksh)</label>
                            <input type="text" value="<?php echo $houses['house_rent']; ?>" required name="house_rent" class="form-control">
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


<!-- Delete Modal -->
<div class="modal fade" id="delete_<?php echo $houses['house_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form method="POST">
                <div class="modal-body text-center text-danger">
                    <img src='../public/img/bin.gif' height="120px">
                    <h4>Delete <?php echo $houses['property_name']; ?>?</h4>
                    <br>
                    <!-- Hide This -->
                    <input type="hidden" name="house_id" value="<?php echo $houses['house_id']; ?>">
                    <button type="button" class="text-center btn btn-success" data-dismiss="modal">No</button>
                    <button type="submit" name="Delete_House" class="text-center btn btn-danger">Yes, Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Modal -->