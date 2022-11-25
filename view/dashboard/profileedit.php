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
                            <option selected disabled>--คำนำหน้าชื่อ--</option>
                            <option value="นาย">นาย</option>
                            <option value="นาง">นาง</option>
                            <option value="นางสาว">นางสาว</option>
                        </select>

                        <div class="form-floating mb-4">
                            <input type="text" class="form-control form-control-lg border border-start-0 border-top-0 border-end-0 rounded-0" id=" inputFname" name="inputFname" placeholder="กรอกชื่อ">
                            <label for="inputFname" class="form-label">ชื่อ</label>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="text" class="form-control form-control-lg border border-start-0 border-top-0 border-end-0 rounded-0" id=" inputLname" name="inputLname" placeholder="กรอกนามสกุล">
                            <label for="inputLname" class="form-label">นามสกุล</label>
                        </div>
                        <!-- username input -->
                        <div class="form-floating mb-4">
                            <input type="text" class="form-control form-control-lg border border-start-0 border-top-0 border-end-0 rounded-0" id=" inputUsername" name="inputUsername" placeholder="กรอกชื่ผู้ใช้">
                            <label for="inputLname" class="form-label">
                                ชื่อผู้ใช้</label>
                        </div>
                        <!-- Password input -->
                        <div class="form-floating mb-4">
                            <input type="password" class="form-control form-control-lg border border-start-0 border-top-0 border-end-0 rounded-0" id="inputPassword" name="inputPassword" placeholder="กรอกรหัสผ่าน" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="พาสเวิร์ดต้องมีตัวเลขอย่างน้อยหนึ่งตัว, มีตัวพิมพ์ใหญ่และพิมพ์เล็ก และมีความยาวไม่น้อยกว่า 8 ตัวอักษร !">
                            <label for="inputPassword" class="form-label">รหัสผ่าน</label>
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
            <form method="post" action="">
                <div class="modal-body">
                    <input type="hidden" name="" value="">
                    <div class="p-3">
                        <!-- username input -->
                        <div class="form-floating mb-4">
                            <input type="text" class="form-control form-control-lg border border-start-0 border-top-0 border-end-0 rounded-0" id="inpUsername" name="inputUsername" placeholder="กรอกชื่ผู้ใช้">
                            <label for="inpUsername" class="form-label">
                                ชื่อผู้ใช้</label>
                        </div>
                        <!-- Password input -->
                        <div class="form-floating mb-4">
                            <input type="password" class="form-control form-control-lg border border-start-0 border-top-0 border-end-0 rounded-0" id="inpPWD" name="inputPassword" placeholder="กรอกรหัสผ่าน" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="พาสเวิร์ดต้องมีตัวเลขอย่างน้อยหนึ่งตัว, มีตัวพิมพ์ใหญ่และพิมพ์เล็ก และมีความยาวไม่น้อยกว่า 8 ตัวอักษร !">
                            <label for="inpPWD" class="form-label">รหัสผ่าน</label>
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