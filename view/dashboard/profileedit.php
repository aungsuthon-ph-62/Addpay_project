<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#previewprofile')
                    .attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

<!-- Edit Profile picture -->
<div class="modal fade" id="profileeditdataModal" tabindex="-1" aria-labelledby="profileeditdataModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="profileeditdataModalLabel">แก้ไขข้อมูลส่วนตัว</h5>
            </div>
            <form method="post" action="">
                <div class="modal-body">
                    <input type="hidden" name="" value="">
                    <div class="p-3 p-md-5">
                        <select class="form-select mb-4 rounded-pill" id="inputTname" name="inputTname">
                            <option selected disabled value="<?= $user['prefix'] ?>"><?= $user['prefix'] ?></option>
                            <option value="นาย">นาย</option>
                            <option value="นาง">นาง</option>
                            <option value="นางสาว">นางสาว</option>
                        </select>

                        <div class="form-floating mb-4">
                            <input type="text" class="form-control form-control-lg border border-start-0 border-top-0 border-end-0 rounded-0" id="inputFname" name="inputFname" placeholder="กรอกชื่อจริง" value="<?= $user['fname'] ?>">
                            <label for="inputFname" class="form-label">ชื่อ</label>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="text" class="form-control form-control-lg border border-start-0 border-top-0 border-end-0 rounded-0" id="inputLname" name="inputLname" placeholder="กรอกนามสกุล" value="<?= $user['lname'] ?>">
                            <label for="inputLname" class="form-label">นามสกุล</label>
                        </div>
                        <!-- phone input -->
                        <div class="form-floating mb-4">
                            <input type="number" class="form-control form-control-lg border border-start-0 border-top-0 border-end-0 rounded-0" id="inputPhone" name="inputPhone" placeholder="กรอกเบอร์โทร" pattern="[0-9]{10}" value="<?= $user['phone'] ?>">
                            <label for="inputLname" class="form-label">
                                เบอร์โทร</label>
                        </div>
                        <!-- email input -->
                        <div class="form-floating mb-4">
                            <input type="email" class="form-control form-control-lg border border-start-0 border-top-0 border-end-0 rounded-0" id="inputEmail" name="inputEmail" placeholder="กรอกอีเมลล์" title="พาสเวิร์ดต้องมีตัวเลขอย่างน้อยหนึ่งตัว, มีตัวพิมพ์ใหญ่และพิมพ์เล็ก และมีความยาวไม่น้อยกว่า 8 ตัวอักษร !" value="<?= $user['email'] ?>">
                            <label for="inputEmail" class="form-label">อีเมลล์</label>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="text" class="form-control form-control-lg border border-start-0 border-top-0 border-end-0 rounded-0" id="inputPosition" name="inputPosition" placeholder="กรอกตำแหน่ง" value="<?= $user['position'] ?>">
                            <label for="inputPosition" class="form-label">ตำแหน่ง</label>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="text" class="form-control form-control-lg border border-start-0 border-top-0 border-end-0 rounded-0" id="inputDepartment" name="inputDepartment" placeholder="กรอกแผนก" value="<?= $user['department'] ?>">
                            <label for="inputDepartment" class="form-label">แผนก</label>
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
<div class="modal fade" id="profileedituserModal" tabindex="-1" aria-labelledby="profileedituserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="profileedituserModalLabel">แก้ไขชื่อผู้ใช้และรหัสผ่าน</h5>
            </div>
            <form method="post" action="php/action.php">
                <input type="hidden" name="action" value="editUserPass">
                <input type="hidden" name="username" value="<?= $user['username'] ?>">
                <input type="hidden" name="password" value="<?= $user['password'] ?>">
                <input type="hidden" name="id" value="<?= $user['id'] ?>">
                <div class="modal-body">
                    <div class="p-3">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="User-tab" data-bs-toggle="tab" data-bs-target="#User" type="button" role="tab" aria-controls="User" aria-selected="true">แก้ไขชื่อผู้ใช้</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="Pass-tab" data-bs-toggle="tab" data-bs-target="#Pass" type="button" role="tab" aria-controls="Pass" aria-selected="false">แก้ไขรหัสผ่าน</button>
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane fade show active py-3" id="User" role="tabpanel" aria-labelledby="User-tab" tabindex="0">
                                <!-- username input -->
                                <div class="form-floating mb-4">
                                    <input type="text" class="form-control form-control-lg border border-start-0 border-top-0 border-end-0 rounded-0" id="inpUsername" name="inputUsername" placeholder="กรอกชื่อผู้ใช้เก่าเพื่อยืนยัน">
                                    <label for="inpUsername" class="form-label">
                                        กรอกชื่อผู้ใช้เก่าเพื่อยืนยัน
                                    </label>
                                </div>
                                <!-- username input -->
                                <div class="form-floating mb-4">
                                    <input type="text" class="form-control form-control-lg border border-start-0 border-top-0 border-end-0 rounded-0" id="inpUsernameNew" name="inputUsernameNew" placeholder="กรอกชื่อผู้ใช้ใหม่">
                                    <label for="inpUsernameNew" class="form-label">
                                        กรอกชื่อผู้ใช้ใหม่
                                    </label>
                                </div>
                            </div>
                            <div class="tab-pane fade py-3" id="Pass" role="tabpanel" aria-labelledby="Pass-tab" tabindex="0">
                                <!-- Password input -->
                                <div class="form-floating mb-4">
                                    <input type="password" class="form-control form-control-lg border border-start-0 border-top-0 border-end-0 rounded-0" id="inpPassword" name="inputPassword" placeholder="กรอกรหัสผ่านเก่าเพื่อยืนยัน">
                                    <label for="inpPassword" class="form-label">กรอกรหัสผ่านเก่าเพื่อยืนยัน</label>
                                </div>
                                <!-- Password input -->
                                <div class="form-floating mb-4">
                                    <input type="password" class="form-control form-control-lg border border-start-0 border-top-0 border-end-0 rounded-0" id="inpPasswordNew" name="inputPasswordNew" placeholder="รหัสผ่านใหม่">
                                    <label for="inpPasswordNew" class="form-label">รหัสผ่านใหม่</label>
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
<div class="modal fade" id="profileeditimgModal" tabindex="-1" aria-labelledby="profileeditimgModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="profileeditimgModalLabel">แก้ไขรูปภาพส่วนตัว</h5>
            </div>
            <form method="post" action="" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" name="" value="">
                    <div class="px-4 text-center">
                        <input class="form-control" id="profile" name="profile" type="file" accept="image/*" onchange="readURL(this);">
                        <br>
                        <div class="p-3">
                            <img class="img-fluid" id='previewprofile' width="250px">
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