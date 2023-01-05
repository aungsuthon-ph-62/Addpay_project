<?php
session_start();
include("../../layout/head.php");
require_once("../../php/conn.php");

if (isset($_GET["deletequo"])) {
    
    $id = $_GET["deletequo"];

    $sql = "SELECT quoin_file FROM quotation_in WHERE quoin_id = '$id'";
    $query = $conn->query($sql);
    $row = $query->fetch_assoc();
    $oldfile = $row['quoin_file'];

    $sql = "DELETE FROM quotation_in WHERE quoin_id = '$id'";
    $query = $conn->query($sql);

    if ($query) {
        
        unlink("../../uploadfile/quotationinfile/$oldfile");
        $_SESSION['success'] = "ลบใบเสนอราคาสำเร็จ!";
        header("Location: quotation_in_list.php");
        exit;
    }
    
    $_SESSION['error'] = "เกิดข้อผิดพลาด! กรุณาลองอีกครั้ง";
    header("Location: quotation_in_list.php");
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
                    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">ใบเสนอราคาเข้า</li>
                </ol>
            </nav>
            <hr>

            <div id="listquotation" class="container pb-md-0 mb-5">
                <div>
                    <h3>ใบเสนอราคา quotation</h3>
                </div>

                <div class="mx-auto d-flex justify-content-end">
                    <a class="btn btn-success px-2 px-md-4 mt-2 rounded-3 fs-5 fw-bold " role="button"
                        href="../dashboard/quotation_in_add.php"><i class="fa-solid fa-file-circle-plus"></i>
                        สร้างใบเสนอราคา</a>
                </div>

                <div class="border border-secondary rounded-3 py-md-4 px-md-4 mt-2 mt-md-4" id="main_row">
                    <div class="table-responsive">
                        <table class="table" id="quotationTable">
                            <thead>
                                <tr class="rows align-center">
                                    <th scope="col" style="width:15%;">เลขที่</th>
                                    <th scope="col" style="width:15%;">วันที่ในใบเสนอราคา</th>
                                    <th scope="col" style="width:40%;">บริษัทที่ออกใบเสนอราคา</th>
                                    <th scope="col" style="width:20%;">สถานะ</th>
                                    <th scope="col" style="width:10%;">ตัวเลือก</th>
                                </tr>
                            </thead>
                            <?php

                            $sql = "SELECT * FROM quotation_in";
                            $query = $conn->query($sql);
                            while ($rows = $query->fetch_assoc()) {
                                echo '
                                    <tr>
                                        <td>' . $rows["quoin_no"] . '</td>
                                        <td>' . $rows["quoin_date"] . '</td>
                                        <td>' . $rows["quoin_company"] . '</td>
                                        <td>' . $rows["quoin_status"] . '</td>
                                        
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-dark dropdown-toggle px-2 px-md-4"
                                                    data-bs-toggle="dropdown" aria-expanded="false"><b>เลือก</b>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item"
                                                            href="../../uploadfile/quotationinfile/' . $rows["quoin_file"] . '">เปิดเอกสาร</a>
                                                    </li>
                                                    <li><a class="dropdown-item"
                                                            href="../dashboard/quotation_in_edit.php?editquoin=' . $rows["quoin_id"] . '">แก้ไข</a>
                                                    </li>
                                                    <li><a class="dropdown-item deletequo" href="#" data-quo-no="' . $rows["quoin_no"] . '" id="' . $rows["quoin_id"] . '" >ลบ</a></li>
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

                    $(document).on('click', '.deletequo', function() {
                        var id = $(this).attr("id");
                        var show_quo_no = $(this).attr("data-quo-no");
                        swal.fire({
                            title: 'ต้องการลบใบเสนอราคานี้ !',
                            text: "เลขที่ใบเสนอราคา : " + show_quo_no,
                            type: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#d33',
                            cancelButtonColor: '#3085d6',
                            confirmButtonText: 'yes!',
                            cancelButtonText: 'no'
                        }).then((result) => {
                            if (result.value) {
                                window.location.href = "?deletequo=" + id;
                            }
                        });
                    });
                });
                </script>
                <!-- Data table -->
            </div>
        </div>
    </div>
</body>