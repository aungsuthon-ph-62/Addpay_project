<?php
include_once '../../layout/head.php';
?>


<style>
   .font{
    font-size: 1rem;
   }
   body {
        font-family: "Kanit", sans-serif;
        font-family: "Noto Sans", sans-serif;
        font-family: "Noto Sans Thai", sans-serif;
        font-family: "Poppins", sans-serif;
        font-family: "Prompt", sans-serif;
    }
</style>

<div class="container">
    <div class="modal modal-sheet d-block" tabindex="-1">
        <div class="modal-dialog">
            <form action="../../php/action.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="action" value="editArchives">
                <!-- <input type="hidden" name="ExpensesID" value="<?= $rows['id'] ?>">
                <input type="hidden" name="hdn_file" value="<?= $rows['Expenses_file'] ?>"> -->
                <div class="modal-content rounded-4 shadow">
                    <div class="modal-header border-bottom-0">
                        <h1 class="modal-title fs-5"><i class="fa-solid fa-pen-to-square"></i> แก้ไขข้อมูลเอกสารสำคัญ </h1>
                        <a href="../dashboard/archives.php" class="btn-close"></a>
                    </div>
                    <div class="modal-body pt-5">
                        <div class="mb-3">
                            <label for="editArchives" class="form-label ">ชื่อเรื่อง</label>
                            <input class="form-control" id="editArchives" name="editArchives" type="text">
                        </div>
                        <div class="mb-3">
                            <label for="editArchives" class="form-label ">เพิ่มไฟล์ที่นี่</label>
                            <input class="form-control" id="editArchives" name="editArchives" type="file">
                        </div>

                    </div>
                    <div class="modal-footer flex-column border-top-0 pt-5">
                        <button type="submit" class="btn btn-lg btn-primary w-100 mx-0 mb-2">บันทึกข้อมูล</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>