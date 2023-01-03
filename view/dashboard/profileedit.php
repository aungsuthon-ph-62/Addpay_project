<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#previewprofile')
                    .attr('src', e.target.result);
                $('#stored_picture').hide();
            };

            reader.readAsDataURL(input.files[0]);
        } else {
            $('#stored_picture').hide();
        }
    }
</script>

<!-- Edit Profile -->
<div class="modal fade" id="profileeditdataModal" tabindex="-1" aria-labelledby="profileeditdataModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="profileeditdataModalLabel">แก้ไขข้อมูลส่วนตัว</h5>
            </div>
            <form method="post" action="php/action.php">
                <div class="modal-body">
                    <input type="hidden" name="action" value="editProfile">
                    <input type="hidden" name="id" value="<?= $user['id'] ?>">
                    <div class="p-3">
                        <div class="row align-items-center">
                            <div class="col-4">
                                <select class="form-select mb-4 rounded-pill" id="inputTname" name="inputTname">
                                    <?php if ($user['prefix']) { ?>
                                        <?php if ($user['prefix'] == 'นาย') { ?>
                                            <option value="นาย" selected><?= $user['prefix'] ?></option>
                                            <option value="นาง">นาง</option>
                                            <option value="นางสาว">นางสาว</option>
                                        <?php } elseif ($user['prefix'] == 'นาง') { ?>
                                            <option value="นาย">นาย</option>
                                            <option value="นาง" selected><?= $user['prefix'] ?></option>
                                            <option value="นางสาว">นางสาว</option>
                                        <?php } elseif ($user['prefix'] == 'นางสาว') { ?>
                                            <option value="นาย">นาย</option>
                                            <option value="นาง">นาง</option>
                                            <option value="นางสาว" selected><?= $user['prefix'] ?></option>
                                        <?php } ?>
                                    <?php } else { ?>
                                        <option selected disabled>--คำนำหน้าชื่อ--</option>
                                        <option value="นาย">นาย</option>
                                        <option value="นาง">นาง</option>
                                        <option value="นางสาว">นางสาว</option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-4">
                                <div class="form-floating mb-4">
                                    <input type="text" class="form-control border border-start-0 border-top-0 border-end-0 rounded-0" id="inputFname" name="inputFname" placeholder="กรอกชื่อจริง" value="<?= $user['fname'] ?>">
                                    <label for="inputFname" class="form-label">ชื่อ</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-floating mb-4">
                                    <input type="text" class="form-control border border-start-0 border-top-0 border-end-0 rounded-0" id="inputLname" name="inputLname" placeholder="กรอกนามสกุล" value="<?= $user['lname'] ?>">
                                    <label for="inputLname" class="form-label">นามสกุล</label>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-3 col-md-4">
                                <div class="form-floating mb-4">
                                    <input type="number" class="form-control border border-start-0 border-top-0 border-end-0 rounded-0" id="inputAge" name="inputAge" placeholder="กรอกเบอร์โทร" pattern="[1-9]{3}" value="<?= $user['age'] ?>">
                                    <label for="inputAge" class="form-label">
                                        อายุ
                                    </label>
                                </div>
                            </div>
                            <div class="col-9 col-md-8 text-md-center mb-3">
                                <label>เพศ :</label>
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="btn-check" name="inputGender" id="male-outlined" value="ชาย" <?php if ($user['gender'] == 'ชาย') {
                                                                                                                                echo "checked";
                                                                                                                            } ?>>
                                    <label class="btn btn-outline-info rounded-pill" for="male-outlined">ชาย</label>
                                    <input type="radio" class="btn-check" name="inputGender" id="female-outlined" value="หญิง" <?php if ($user['gender'] == 'หญิง') {
                                                                                                                                    echo "checked";
                                                                                                                                } ?>>
                                    <label class="btn btn-outline-warning rounded-pill" for="female-outlined">หญิง</label>
                                    <input type="radio" class="btn-check" name="inputGender" id="other-outlined" value="อื่นๆ" <?php if ($user['gender'] == 'อื่นๆ') {
                                                                                                                                    echo "checked";
                                                                                                                                } ?>>
                                    <label class="btn btn-outline-dark rounded-pill" for="other-outlined">อื่นๆ</label>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-5">
                                <!-- phone input -->
                                <div class="form-floating mb-4">
                                    <input type="number" class="form-control border border-start-0 border-top-0 border-end-0 rounded-0" id="inputPhone" name="inputPhone" placeholder="กรอกเบอร์โทร" value="<?= $user['phone'] ?>">
                                    <label for="inputLname" class="form-label">
                                        เบอร์โทร
                                    </label>
                                </div>
                            </div>
                            <div class="col-7">
                                <!-- email input -->
                                <div class="form-floating mb-4">
                                    <input type="email" class="form-control border border-start-0 border-top-0 border-end-0 rounded-0" id="inputEmail" name="inputEmail" placeholder="กรอกอีเมลล์" value="<?= $user['email'] ?>">
                                    <label for="inputEmail" class="form-label">อีเมลล์</label>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-6">
                                <div class="form-floating mb-4">
                                    <input type="text" class="form-control border border-start-0 border-top-0 border-end-0 rounded-0" id="inputPosition" name="inputPosition" placeholder="กรอกตำแหน่ง" value="<?= $user['position'] ?>">
                                    <label for="inputPosition" class="form-label">ตำแหน่ง</label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-floating mb-4">
                                    <input type="text" class="form-control border border-start-0 border-top-0 border-end-0 rounded-0" id="inputDepartment" name="inputDepartment" placeholder="กรอกแผนก" value="<?= $user['department'] ?>">
                                    <label for="inputDepartment" class="form-label">แผนก</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="px-3">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark bg-secondary-addpay border-0" data-bs-dismiss="modal">ยกเลิก</button>
                        <button class="btn btn-dark btn-addpay border-0" type="submit" name="submit">บันทึก</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Username -->
<div class="modal fade" id="profileedituserModal" tabindex="-1" aria-labelledby="profileedituserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="profileedituserModalLabel">แก้ไขชื่อผู้ใช้</h5>
            </div>
            <form method="post" action="php/action.php">
                <div class="modal-body">
                    <input type="hidden" name="action" value="editUsername">
                    <input type="hidden" name="id" value="<?= $user['id'] ?>">
                    <input type="hidden" name="stored_username" value="<?= $user['username'] ?>">
                    <div class="p-3 p-md-5">
                        <div class="form-floating mb-4">
                            <input type="text" class="form-control form-control-lg border border-start-0 border-top-0 border-end-0 rounded-0" id="inputUsername" name="inputUsername" placeholder="ชื่อผู้ใช้ปัจจุบัน">
                            <label for="inputUsername" class="form-label">ชื่อผู้ใช้ปัจจุบัน</label>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="text" class="form-control form-control-lg border border-start-0 border-top-0 border-end-0 rounded-0" id="inputNewUsername" name="inputNewUsername" placeholder="ชื่อผู้ใช้ใหม่">
                            <label for="inputNewUsername" class="form-label">ชื่อผู้ใช้ใหม่</label>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="text" class="form-control form-control-lg border border-start-0 border-top-0 border-end-0 rounded-0" id="confirmNewUsername" name="confirmNewUsername" placeholder="ยืนยันชื่อผู้ใช้ใหม่">
                            <label for="confirmNewUsername" class="form-label">ยืนยันชื่อผู้ใช้ใหม่</label>
                        </div>
                    </div>
                </div>
                <div class="px-3">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark bg-secondary-addpay border-0" data-bs-dismiss="modal">ยกเลิก</button>
                        <button class="btn btn-dark btn-addpay border-0" type="submit" name="submit">บันทึก</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Change Password -->
<div class="modal fade" id="profileeditpassModal" tabindex="-1" aria-labelledby="profileeditpassModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="profileeditpassModalLabel">แก้ไขรหัสผ่าน</h5>
            </div>
            <form method="post" action="php/action.php">
                <div class="modal-body">
                    <input type="hidden" name="action" value="editPassword">
                    <input type="hidden" name="id" value="<?= $user['id'] ?>">
                    <input type="hidden" name="stored_password" value="<?= $user['password'] ?>">
                    <div class="p-3 p-md-5">
                        <div class="form-floating mb-4">
                            <input type="password" class="form-control form-control-lg border border-start-0 border-top-0 border-end-0 rounded-0" id="inputPassword" name="inputPassword" placeholder="รหัสผ่านปัจจุบัน">
                            <label for="inputPassword" class="form-label">รหัสผ่านปัจจุบัน</label>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="password" class="form-control form-control-lg border border-start-0 border-top-0 border-end-0 rounded-0" id="inputNewPassword" name="inputNewPassword" placeholder="รหัสผ่านใหม่">
                            <label for="inputNewPassword" class="form-label">ชื่อผู้ใช้ใหม่</label>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="password" class="form-control form-control-lg border border-start-0 border-top-0 border-end-0 rounded-0" id="confirmNewPassword" name="confirmNewPassword" placeholder="ยืนยันรหัสผ่านใหม่">
                            <label for="confirmNewPassword" class="form-label">ยืนยันรหัสผ่านใหม่</label>
                        </div>
                    </div>
                </div>
                <div class="px-3">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark bg-secondary-addpay border-0" data-bs-dismiss="modal">ยกเลิก</button>
                        <button class="btn btn-dark btn-addpay border-0" type="submit" name="submit">บันทึก</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit User profile -->
<div class="modal fade" id="profileeditimgModal" tabindex="-1" aria-labelledby="profileeditimgModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="profileeditimgModalLabel">แก้ไขรูปภาพส่วนตัว</h5>
            </div>
            <form method="post" action="php/action.php" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" name="action" value="editProfilePicture">
                    <input type="hidden" name="id" value="<?= $user['id'] ?>">
                    <?php if (isset($user['img'])) { ?>
                        <input type="hidden" name="oldPictureName" value="<?= $user['img'] ?>">
                    <?php } ?>
                    <div class="px-4 text-center">
                        <input class="form-control" id="profile" name="image" type="file" accept="image/*" onchange="readURL(this);">
                        <br>
                        <div class="p-3">
                            <img class="img-fluid" id='previewprofile' width="250px">
                        </div>
                        <div id="stored_picture">
                            <?php if ($user['img']) { ?>
                                <div class="p-3">
                                    <img src="image/profile/<?= $user['img'] ?>" class="img-fluid" width="250px">
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark bg-secondary-addpay border-0" data-bs-dismiss="modal">ยกเลิก</button>
                        <button class="btn btn-dark btn-addpay border-0" type="submit" name="submit">บันทึก</button>
                    </div>
            </form>
        </div>
    </div>
</div>