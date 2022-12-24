<?php
session_start();
include("../../layout/head.php");
require_once("../../php/conn.php");

if(isset($_GET["deletequo"]))
  {
    $id = $_GET["deletequo"];
    $sql1 = "DELETE FROM quotation_appraisal_details WHERE quode_quoid = '$id'";
    $query1 = $conn->query($sql1);
    if($query1){
        $sql2 = "DELETE FROM quotation_appraisal WHERE quo_id = '$id'";
        $query2 = $conn->query($sql2);
        if($query2){
            $_SESSION['success'] = "ลบใบเสนอราคาสำเร็จ!";
            header("Location: quotation_appraisal_list.php");
            exit;
        }
        $_SESSION['error'] = "เกิดข้อผิดพลาด! กรุณาลองอีกครั้ง";
        header("Location: quotation_appraisal_list.php");
        exit;
    }
    $_SESSION['error'] = "เกิดข้อผิดพลาด! กรุณาลองอีกครั้ง";
    header("Location: quotation_appraisal_list.php");
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
    <?php require("../alert.php");?>
    <div class="container py-5">
        <div class="main-body">
            <nav aria-label="breadcrumb" class="main-breadcrumb mt-2">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">ใบเสนอราคากลาง</li>
                </ol>
            </nav>
            <hr>

            <div id="listquotation" class="container pb-md-0 mb-5">
                <div>
                    <h3>ใบเสนอราคา Quotation</h3>
                </div>

                <div class="mx-auto d-flex justify-content-end">
                    <a class="btn btn-success px-2 px-md-4 mt-2 rounded-3 fs-5 fw-bold " role="button"
                        href="../dashboard/quotation_appraisal_add.php"><i class="fa-solid fa-file-circle-plus"></i>
                        สร้างใบเสนอราคา</a>
                </div>

                <div class="border border-secondary rounded-3 py-md-4 px-md-4 mt-2 mt-md-4" id="main_row">
                    <div class="table-responsive">
                        <table class="table" id="quotationTable">
                            <thead>
                                <tr class="align-center" class="rows">
                                    <th scope="col" style="width:12%">วันที่สร้าง</th>
                                    <th scope="col" style="width:12%">วันที่ใน<br>ใบเสนอราคา</th>
                                    <th scope="col" style="width:20%">เลขที่ใบเสนอราคา</th>
                                    <th scope="col" style="width:31%">ชื่อลูกค้า</th>
                                    <th scope="col" style="width:15%">จำนวนเงินรวม</th>
                                    <th scope="col" style="width:10%">ตัวเลือก</th>
                                </tr>
                            </thead>
                            <?php
                                
                                $sql = "SELECT * FROM quotation_appraisal";
                                $query = $conn->query($sql);
                                while ($rows = $query->fetch_assoc()) {
                                    echo '
                                    <tr>
                                        <td>'.$rows["quo_create"].'</td>
                                        <td>'.$rows["quo_date"].'</td>
                                        <td>'.$rows["quo_no"].'</td>
                                        <td>'.$rows["quo_name"].'</td>
                                        <td>'.$rows["quo_total"].'</td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-dark dropdown-toggle px-2 px-md-4"
                                                    data-bs-toggle="dropdown" aria-expanded="false"><b>เลือก</b>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item"
                                                            href="../dashboard/quotation_appraisal_form.php?pdfquo='.$rows["quo_id"].'">พิมพ์เอกสาร</a>
                                                    </li>
                                                    <li><a class="dropdown-item"
                                                            href="../dashboard/quotation_appraisal_edit.php?editquo='.$rows["quo_id"].'">แก้ไข</a>
                                                    </li>
                                                    <li><a class="dropdown-item deletequo" href="#" data-quo-no="'.$rows["quo_no"].'" id="'.$rows["quo_id"].'" >ลบ</a></li>
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