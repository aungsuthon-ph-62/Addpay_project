<?php
include_once '../../layout/head.php';
?>

<style>
    body {
        font-family: "Kanit", sans-serif;
        font-family: "Noto Sans", sans-serif;
        font-family: "Noto Sans Thai", sans-serif;
        font-family: "Poppins", sans-serif;
        font-family: "Prompt", sans-serif;
    }
</style>

<div class="container py-5">
    <nav aria-label="breadcrumb" class="main-breadcrumb mt-2">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="../dashboard.php">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="doc.php">หนังสือ</a></li>
            <li class="breadcrumb-item"><a href="docout.php">หนังสือออก</a></li>
            <li class="breadcrumb-item active" aria-current="page">เพิ่มข้อมูลหนังสือเข้า</li>
        </ol>
    </nav>
    <hr>
    <!-- <div class="d-flex flex-row-reverse mb-3">
        <a class="btn btn-primary" role="button" href="../dashboard/docin_add.php">เพิ่มข้อมูล <i class="fa-solid fa-plus"></i></a>
    </div> -->
    <form action="" method="post" class="px-md-5 py-md-5">
        <div class="row g-3 align-items-center mb-3">
            <div class="col-md-3">
                <label for="inputNo" class="col-form-label">ที่ อพ.</label>
            </div>
            <div class="col-auto">
                <input type="text" id="inputNo" class="form-control " required>
            </div>
        </div>
        <div class="row g-3 align-items-center mb-3">
            <div class="col-md-3">
                <label for="inputNo" class="col-form-label">วันที่ </label>
            </div>
            <div class="col-auto">
                <input type="date" id="inputdate" class="form-control " required>
            </div>
        </div>
        <div class="row g-3 align-items-center mb-3">
            <div class="col-md-3">
                <label for="inputname" class="col-form-label">เรื่อง </label>
            </div>
            <div class="col-md-8">
                <input type="text" id="inputname" class="form-control " required>
            </div>
        </div>
        <div class="row g-3 align-items-center mb-3">
            <div class="col-md-3">
                <label for="inputname" class="col-form-label">เรียน </label>
            </div>
            <div class="col-md-8">
                <input type="text" id="inputname" class="form-control " required>
            </div>
        </div>
        <div class="row g-3 mb-3">
            <div class="col-md-3 ">
                <label for="inputposition" class="col-form-label">รายละเอียดหนังสือ </label>
            </div>
            <div class="col-md-8">
                <textarea class="form-control" id="inputposition" rows="3" required></textarea>
            </div>
        </div>
       
        <!-- Submit button -->
        <div class="mx-auto d-flex justify-content-end">
            <button type="reset" class="col-md-3 btn btn-outline-danger btn btn-outline-success p-2 mt-2 rounded-pill fs-5 fw-bold btn-addpay"><i class="fa-solid fa-eraser"></i> ล้างข้อมูล</button>
            <button type="submit" class="ms-3 col-md-3 btn btn-outline-success p-2 mt-2 rounded-pill fs-5 fw-bold btn-addpay">ต่อไป <i class="fa-solid fa-angles-right"></i></button>
        </div>


    </form>


</div>



<!-- add expenses -->
<!-- <div class="modal fade" id="addExpensesModal" tabindex="-1" aria-labelledby="addExpensesModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addExpensesModal">เพิ่มข้อมูลใบสำคัญจ่าย</h5>
            </div>
            <form method="post" action="">
                <div class="modal-body">
                    <input type="hidden" name="" value="">
                    <div class="p-3 p-md-5">
                        <div class="form-floating mb-4">
                            <input type="text" class="form-control form-control-lg border border-start-0 border-top-0 border-end-0 rounded-0" id=" inputDate" name="inputDate" placeholder="กรอกชื่อ">
                            <label for="inputDate" class="form-label">วันที่</label>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="text" class="form-control form-control-lg border border-start-0 border-top-0 border-end-0 rounded-0" id=" inputList" name="inputList" placeholder="กรอกชื่อ">
                            <label for="inputList" class="form-label">รายการ</label>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="text" class="form-control form-control-lg border border-start-0 border-top-0 border-end-0 rounded-0" id=" inputPrice" name="inputPrice" placeholder="กรอกนามสกุล">
                            <label for="inputPrice" class="form-label">จำนวนเงิน</label>
                        </div>
                        <select class="form-select mb-4 rounded-pill" id="inputType" name="inputType">
                            <option selected disabled>--ประเภท--</option>
                            <option value="ประจำ">ประจำ</option>
                            <option value="ไม่ประจำ">ไม่ประจำ</option>
                        </select>
                        
                        <div class="form-floating mb-4">
                            <input type="file" class="form-control form-control-lg border border-start-0 border-top-0 border-end-0 rounded-0" id=" inputPrice" name="inputPrice" placeholder="กรอกนามสกุล">
                            
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
</div> -->