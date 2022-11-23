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
<div class="modal fade" id="profileeditdataModal" tabindex="-1" aria-labelledby="profileeditdataModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="profileeditdataModalLabel">Edit Profile</h5>
            </div>
            <form class="row" id="" method="post" action="">
                <div class="modal-body">
                    <input type="hidden" name="" value="">
                    <div class="px-5 ">
                        <label class="form-label">ชื่อ</label>
                        <input type="text" class="form-control" required name="fname" value="ชื่อออ">

                        <label class="form-label">สกุล</label>
                        <input type="text" class="form-control" required name="lname" value="สกุลลล">

                        <label class="form-label">ตำแหน่ง</label>
                        <input type="text" class="form-control" required name="position" value="ตำแหน่งงงง">

                        <label class="form-label">แผนก</label>
                        <input type="text" class="form-control" required name="department" value="แผนกกก">

                        <label class="form-label">อีเมลล์</label>
                        <input type="text" class="form-control" required name="email" value="อีเมลลลลลลล์">

                        <label class="form-label">เบอร์โทร</label>
                        <input type="text" class="form-control" required name="phone" value="เบอร์โทรรรรรรร">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-primary" type="submit" name="submit">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="profileedituserModal" tabindex="-1" aria-labelledby="profileedituserModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="profileedituserModalLabel">Edit Profile</h5>
            </div>
            <form class="row" id="" method="post" action="">
                <div class="modal-body">
                    <input type="hidden" name="" value="">
                    <div class="px-5 ">
                        <label class="form-label">ชื่อผู้ใช้</label>
                        <input type="text" class="form-control" required name="fname" value="userrrr">

                        <label class="form-label">รหัสผ่านเก่า</label>
                        <input type="password" class="form-control" required name="lname" value="">

                        <label class="form-label">รหัสผ่านใหม่</label>
                        <input type="password" class="form-control" required name="position" value="">


                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-primary" type="submit" name="submit">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="profileeditimgModal" tabindex="-1" aria-labelledby="profileeditimgModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="profileeditimgModalLabel">Upload Profile</h5>
            </div>
            <form class="row" id="" method="post" action="" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" name="" value="">
                    <div class="px-4 text-center">
                        <input class="form-control form-control-sm " id="profile" name="profile" type="file"
                            accept="image/*" onchange="readURL(this);" />
                        <br>
                        <div class="p-3">
                            <img class="img-fluid" id='previewprofile' width="250px" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button class="btn btn-primary" type="submit" name="submit">Save</button>
                    </div>
            </form>
        </div>
    </div>
</div>