<?php
include "../layout/head.php"
?>


<style>
   .font{
    font-size: 1rem;
   }
</style>

<body class="fs-5" >
    <div class="container">
    <div class="modal modal-sheet d-block" tabindex="-1">
        <div class="modal-dialog" >
            <form action="../../php/action.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="action" value="editExpenses">
                <!-- <input type="hidden" name="ExpensesID" value="<?= $rows['id'] ?>">
                <input type="hidden" name="hdn_file" value="<?= $rows['Expenses_file'] ?>"> -->
                <div class="modal-content rounded-4 shadow">
                    <div class="modal-header border-bottom-0">
                        <h1 class="modal-title fs-5"><i class="fa-solid fa-plus"></i> เพิ่มข้อมูลใบสำคัญจ่าย </h1>
                        <a href="../view/expenses.php" class="btn-close"></a>
                    </div>
                    <div class="modal-body pt-3 font"  >
                        <div class="mb-3">
                            <label for="editExpenses" class="form-label">วันที่</label>
                            <input class="form-control" id="editExpenses" name="editExpenses" type="date">
                        </div>
                        <div class="mb-3">
                            <label for="editExpenses" class="form-label">รายการ</label>
                            <input class="form-control" id="editExpenses" name="editExpenses" type="text">
                        </div>
                        <div class="mb-3">
                            <label for="editExpenses" class="form-label">จำนวนเงิน</label>
                            <input class="form-control" id="editExpenses" name="editExpenses" type="number">
                        </div>
                        <select class="form-select mb-4 rounded-pill" id="inputTname" name="inputTname">
                            <option selected disabled>--ประเภท--</option>
                            <option value="ประจำ">ประจำ</option>
                            <option value="ไม่ประจำ">ไม่ประจำ</option>
                        </select>
                        <div class="mb-3">
                            <label for="editExpenses" class="form-label">เพิ่มไฟล์ที่นี่</label>
                            <input class="form-control" id="editExpenses" name="editExpenses" type="file">
                        </div>

                    </div>
                    <div class="modal-footer flex-column border-top-0 pt-3 ">
                        <button type="submit" class="btn btn-lg btn-primary w-100 mx-0 mb-2 font">บันทึกข้อมูล</button>
                    </div>
                    
                </div>
            </form>
        </div>
    </div>
</div>
</body>
