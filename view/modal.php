<div id="editNameModal" class="modal fade" tabindex="-1" aria-labelledby="editNameModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">เพิ่มข้อมูล</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="php/action.php" method="post">
                    <div class="modal-header border-bottom-0">
                        
                    </div>
                    <div class="modal-body pt-5">
                        <div class="mb-3">
                            <label for="editDate" class="form-label fs-5">วันที่</label>
                            <input class="form-control" id="editDate" name="editDate" type="date">
                        </div>
                        <div class="mb-3">
                            <label for="editReport" class="form-label fs-5">รายการ</label>
                            <input class="form-control" id="editReport" name="editReport" type="text">
                        </div>
                        <div class="mb-3">
                            <label for="editReport" class="form-label fs-5">จำนวนเงิน</label>
                            <input class="form-control" id="editReport" name="editReport" type="number">
                        </div>
                        <select class="form-select mb-4 rounded-pill" id="inputTname" name="inputTname">
                            <option selected disabled>--ประเภท--</option>
                            <option value="ประจำ">ประจำ</option>
                            <option value="ไม่ประจำ">ไม่ประจำ</option>
                        </select>
                        <div class="mb-3">
                            <label for="editReport" class="form-label fs-5">เพิ่มไฟล์ที่นี่</label>
                            <input class="form-control" id="editReport" name="editReport" type="file">
                        </div>

                    </div>
                    
            </div>

            <button type="submit" class="btn btn-primary float-end">บันทึกข้อมูล</button>
            </form>
        </div>
    </div>
</div>
</div>