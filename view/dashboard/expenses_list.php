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
                <li class="breadcrumb-item"><a href="../dashboard/account.php">การเงิน บัญชี</a></li>
                <li class="breadcrumb-item active" aria-current="page">ใบสำคัญจ่าย</li>
            </ol>
        </nav>
        <hr>
        <div id="listquotation" class="container pb-md-0 mb-5">
            <div>
                <h3>ใบสำคัญจ่าย</h3>
            </div>
            <div class="mx-auto d-flex justify-content-end">
                <a class="btn btn-success px-2 px-md-4 mt-2 rounded-3 fs-5 fw-bold " role="button" href="../dashboard/expenses_add.php"><i class="fa-solid fa-file-circle-plus"></i> เพิ่มข้อมูล</a>
            </div>

            <div class="border border-secondary rounded-3 py-md-4 px-md-4 mt-2 mt-md-4" id="main_row">
                <div class="table-responsive">
                    <table class="table" id="quotationTable">
                        <thead>
                            <tr class="align-center" class="rows">
                                <th class="text-center" style="width:5%" scope="col">ลำดับ</th>
                                <th class="text-center" style="width:10%" scope="col">วันที่จ่าย</th>
                                <th class="text-center" style="width:25%" scope="col">รายการ</th>
                                <th class="text-center" style="width:10%" scope="col">จำนวนเงิน</th>
                                <th class="text-center" style="width:20%" scope="col">ประเภท</th>
                                
                                <th class="text-center" style="width:10%" scope="col">ตัวเลือก</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <tr>
                                <td>1</td>
                                <td>16/11/65</td>
                                <td>ค่าไฟ</td>
                                <td>3,560.75</td>
                                <td>ประจำ</td>
                                <td>
                                    <div>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-dark dropdown-toggle px-2 px-md-4" data-bs-toggle="dropdown" aria-expanded="false"><b>เลือก</b> </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="#">เปิดเอกสาร</a></li>
                                                <li><a class="dropdown-item" href="./expenses_edit.php">แก้ไข</a></li>
                                                <li><a class="dropdown-item" href="#">ลบ</a></li>

                                            </ul>
                                        </div>
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

