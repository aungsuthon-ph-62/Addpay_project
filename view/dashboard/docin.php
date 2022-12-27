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
            <li class="breadcrumb-item active" aria-current="page">หนังสือเข้า</li>
        </ol>
    </nav>
    <hr>
    <div class="d-flex flex-row-reverse mb-3">
         <a class="btn btn-primary" role="button" href="../dashboard/docin_add.php">เพิ่มข้อมูล <i class="fa-solid fa-plus"></i></a>
        
    </div>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped caption-top" id="showTimeTable">
                    <thead class="table text-center">
                        <tr>
                            <th class="text-center" scope="col">#</th>
                            <th class="text-center" scope="col">ชื่อบริษัทต้นทาง</th>
                            <th class="text-center" scope="col">วันที่</th>
                            <th class="text-center" scope="col">เรื่อง</th>
                            <th class="text-center" scope="col">เรียน (ถึงใคร)</th>
                            <th class="text-center" scope="col">ไฟล์</th>
                            <th class="text-center" scope="col">แก้ไข</th>
                            <th class="text-center" scope="col">ลบ</th>

                        </tr>
                    </thead>

                    <tbody class="text-center">
                        <tr>
                            <td>
                                <!-- <?= $i ?> -->
                            </td>
                            <td>
                                <!-- <?php echo $rows['docin_srcname']; ?> -->
                            </td>
                            <td>
                                <!-- <?php echo $rows['docin_date']; ?> -->
                            </td>
                            <td>
                                <!-- <?php echo $rows['docin_title']; ?> -->
                            </td>
                            <td>
                                <!-- <?php echo $rows['docin_to']; ?> -->
                            </td>
                            <td>
                                <!-- <?php echo $rows['docin_file']; ?> -->
                            </td>
                            <td><a href="../dashboard/docin_edit.php" class="data-bs-toggle='modal' data-bs-target='#editReportModal'">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                            </td>
                            <td><a href="php/action.php?delete=<?= $rows['id'] ?>" class="">
                                    <i class="fa-solid fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    </tbody>

                </table>
            </div>
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