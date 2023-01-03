<?php
include_once '../../layout/head.php';
?>


<style>
    .font {
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

<div class="container py-5">
    <div class="main-body">
        <nav aria-label="breadcrumb" class="main-breadcrumb mt-2">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="../dashboard.php">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="../dashboard/expenses.php">ใบสำคัญจ่าย</a></li>
                <li class="breadcrumb-item active" aria-current="page">เพิ่มข้อมูลใบสำคัญจ่าย</li>
            </ol>
        </nav>
        <hr>

        <div id="paperquotation" class="container pb-md-0 mb-5">
            <div>
                <h3>เพิ่มข้อมูลใบสำคัญจ่าย</h3>
            </div>
            <div class=" px-md-5 py-md-4 justify-content-center">
                <div class="p-2 py-md-4 px-md-5 border rounded-3">
                    <!-- modal form -->
                    <form action="" method="post" class="">
                        <div class="row g-3 align-items-center mb-3">
                            <div class="col-md-3">
                                <label for="inputDate" class="col-form-label">วันที่  </label>
                            </div>
                            <div class="col-md-9">
                                <input type="date" id="inputDate" class="form-control " required>
                            </div>
                        </div>
                        <div class="row g-3 align-items-center mb-3">
                            <div class="col-md-3">
                                <label for="inputList" class="col-form-label">รายการ  </label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" id="inputList" class="form-control " required>
                            </div>
                        </div>
                        <div class="row g-3 align-items-center mb-3">
                            <div class="col-md-3">
                                <label for="inputAmount" class="col-form-label">จำนวนเงิน </label>
                            </div>
                            <div class="col-md-9">
                                <input type="number" id="inputAmount" class="form-control " required>
                            </div>
                        </div>
                        <div class="row g-3 mb-3">
                            <div class="col-md-3 ">
                                <label for="inputType" class="col-form-label">เลือกประเภท </label>
                            </div>
                            <div class="col-md-9">
                                <select class="form-select" id="inputType" name="inputType">
                                    <option selected disabled>--ประเภท--</option>
                                    <option value="ประจำ">ประจำ</option>
                                    <option value="ไม่ประจำ">ไม่ประจำ</option>
                                </select>
                            </div>
                        </div>
                        <div class="row g-3 align-items-center mb-3">
                            <div class="col-md-3 ">
                                <label for="inputFile" class="col-form-label">เพิ่มไฟล์ </label>
                            </div>

                            <div class="col-md-9">
                                <input type="file" id="inputFile" class="form-control " required>
                            </div>
                        </div>

                        <!-- Submit button -->
                        <div class="mx-auto d-flex justify-content-end">
                            <button type="reset" class=" btn btn-outline-danger btn btn-outline-success px-2 mt-2 rounded-3 fw-bold"><i class="fa-solid fa-eraser"></i> ล้างข้อมูล</button>
                            <button type="submit" class="ms-3  btn btn-outline-success px-2 mt-2 rounded-3  fw-bold">บันทึก <i class="fa-solid fa-angles-right"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>