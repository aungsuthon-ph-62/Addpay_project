<?php
session_start();
include("../../layout/head.php");
require_once("../../php/conn.php");

if (isset($_GET["deleteexpenses"])) {
    $id = $_GET["deleteexpenses"];

    $sql = "SELECT expenses_file FROM expenses WHERE expenses_id = '$id'";
    $query = $conn->query($sql);
    $row = $query->fetch_assoc();
    $oldfile = $row['expenses_file'];

    $sql = "DELETE FROM expenses WHERE expenses_id = '$id'";
    $query = $conn->query($sql);

    if ($query) {

        unlink("../../uploadfile/expensesfile/$oldfile");
        $_SESSION['success'] = "ลบใบสำคัญจ่ายสำเร็จ!";
        header("Location: expenses_list.php");
        exit;
    }

    $_SESSION['error'] = "เกิดข้อผิดพลาด! กรุณาลองอีกครั้ง";
    header("Location: expenses_list.php");
    exit;
}

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

<body>
    <?php require("../alert.php"); ?>
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
                    <a class="btn btn-success px-2 px-md-4 mt-2 rounded-3 fs-5 fw-bold " role="button"
                        href="../dashboard/expenses_add.php"><i class="fa-solid fa-file-circle-plus"></i>
                        เพิ่มข้อมูล</a>
                </div>

                <div class="border border-secondary rounded-3 py-md-4 px-md-4 mt-2 mt-md-4" id="main_row">
                    <div class="table-responsive">
                        <table class="table" id="quotationTable">
                            <thead>
                                <tr class="align-center" class="rows">
                                    <th style="width:15%" scope="col">เลขที่</th>
                                    <th style="width:15%" scope="col">วันที่จ่าย</th>
                                    <th style="width:30%" scope="col">รายการ</th>
                                    <th style="width:20%" scope="col">จำนวนเงิน</th>
                                    <th style="width:10%" scope="col">ประเภท</th>
                                    <th style="width:10%" scope="col">ตัวเลือก</th>
                                </tr>
                            </thead>

                            <?php

                            $sql = "SELECT * FROM expenses";
                            $query = $conn->query($sql);
                            while ($rows = $query->fetch_assoc()) {
                                echo '
                                    <tr>
                                        <td>' . $rows["expenses_id"] . '</td>
                                        <td>' . $rows["expenses_date"] . '</td>
                                        <td>' . $rows["expenses_list"] . '</td>
                                        <td>' . $rows["expenses_price"] . '</td>
                                        <td>' . $rows["expenses_type"] . '</td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-dark dropdown-toggle px-2 px-md-4"
                                                    data-bs-toggle="dropdown" aria-expanded="false"><b>เลือก</b>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" target="_blank"
                                                            href="../../uploadfile/expensesfile/' . $rows["expenses_file"] . '">เปิดเอกสาร</a>
                                                    </li>
                                                    <li><a class="dropdown-item"
                                                            href="../dashboard/expenses_edit.php?editexpenses=' . $rows["expenses_id"] . '">แก้ไข</a>
                                                    </li>
                                                    <li><a class="dropdown-item deleteexpenses" data-expenses-list="'.$rows["expenses_list"].'" id="' . $rows["expenses_id"] . '" >ลบ</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                               ';
                            }
                            ?>

                        </table>
                    </div>

                </div>
                <!-- Data table -->
                <script type="text/javascript">
                $(document).ready(function() {
                    $('#quotationTable').DataTable();
                });

                $(document).on('click', '.deleteexpenses', function() {
                    var id = $(this).attr("id");
                    var show_expenses_list = $(this).attr("data-expenses-list");
                    swal.fire({
                        title: 'ต้องการลบรายการนี้ !',
                        text: "รายการ : " + show_expenses_list,
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'yes!',
                        cancelButtonText: 'no'
                    }).then((result) => {
                        if (result.value) {
                            window.location.href = "?deleteexpenses=" + id;
                        }
                    });
                });
                </script>
                <!-- Data table -->

            </div>

        </div>
    </div>
</body>
<?php $conn->close(); ?>