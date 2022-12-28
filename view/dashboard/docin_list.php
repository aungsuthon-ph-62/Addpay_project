<?php
session_start();
include("../../layout/head.php");
require_once("../../php/conn.php");
?>

<style>
body {
    font-family: "Kanit", sans-serif;
    font-family: "Noto Sans", sans-serif;
    font-family: "Noto Sans Thai", sans-serif;
    font-family: "Poppins", sans-serif;
    font-family: "Prompt", sans-serif;
}

.btn-group {
    white-space: nowrap;
}

@media (max-width: 767px) {
    .table-responsive .dropdown-menu {
        position: static !important;
    }
}

@media (min-width: 768px) {
    .table-responsive {
        overflow: inherit;
    }
}
</style>

<div class="container py-5">
    <div class="main-body">
        <nav aria-label="breadcrumb" class="main-breadcrumb mt-2">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="../dashboard.php">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="./doc.php">หนังสือ</a></li>
                <li class="breadcrumb-item active" aria-current="page">หนังสือเข้า</li>
            </ol>
        </nav>
        <hr>
        <div id="listquotation" class="container pb-md-0 mb-5">
            <div>
                <h3>หนังสือเข้า</h3>
            </div>
            <div class="mx-auto d-flex justify-content-end">
                <a class="btn btn-success px-2 px-md-4 mt-2 rounded-3 fs-5 fw-bold " role="button"
                    href="../dashboard/docin_add.php"><i class="fa-solid fa-file-circle-plus"></i> เพิ่มข้อมูล</a>
            </div>

            <div class="border border-secondary rounded-3 py-md-4 px-md-4 mt-2 mt-md-4" id="main_row">
                <div class="table-responsive">
                    <table class="table" id="quotationTable">
                        <thead>
                            <tr class="align-center" class="rows">
                                <th class="text-center" style="width:5%" scope="col">ลำดับ</th>
                                <th class="text-center" style="width:30%" scope="col">ชื่อบริษัทต้นทาง</th>
                                <th class="text-center" style="width:10%" scope="col">วันที่</th>
                                <th class="text-center" style="width:20%" scope="col">เรื่อง</th>
                                <th class="text-center" style="width:20%" scope="col">เรียน (ถึงใคร)</th>
                                <th class="text-center" style="width:20%" scope="col">ไฟล์</th>
                                <th class="text-center" style="width:10%" scope="col">ตัวเลือก</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <tr>
                                <td>1</td>
                                <td>บริษัท แอดเพย์ เซอร์วิสพอยท์ จำกัด</td>
                                <td>16/11/65</td>
                                <td>หนังสือเชิญเป็นวิทยากร</td>
                                <td>คุณหัตถยา บำรุงสุข</td>
                                <td><i class="fa-solid fa-file-pdf"></i> lovetoey.pdf</td>
                                <td>
                                    <div>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-dark dropdown-toggle px-2 px-md-4"
                                                data-bs-toggle="dropdown" aria-expanded="false"><b>เลือก</b> </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="#">เปิดเอกสาร</a></li>
                                                <li><a class="dropdown-item" href="./docin_edit.php">แก้ไข</a></li>
                                                <li><a class="dropdown-item" href="#">ลบ</a></li>

                                            </ul>
                                        </div>

                                        <!-- <a href="../dashboard/edit_archives.php">
                                            <button type="button" class="float-start mr-1 btn btn-warning btn-sm text-white px-3"><i class="fa-solid fa-pen-to-square"></i></button>
                                        </a>

                                        <a href="" class="">
                                            <button type="button" class="float-end mr-1 btn btn-danger btn-sm px-3"><i class="fa-solid fa-trash-can"></i></button>
                                        </a> -->
                                    </div>

                                </td>
                            </tr>

                        </tbody>


                    </table>
                </div>



            </div>
            <!-- Data table -->
            <script type="text/javascript">
            $(document).ready(function() {
                $('#quotationTable').DataTable();
            });
            </script>
            <!-- Data table -->

        </div>

    </div>
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