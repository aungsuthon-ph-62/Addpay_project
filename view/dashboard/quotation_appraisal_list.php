<?php
session_start();
include("../../layout/head.php");
require_once("../../php/conn.php");

if(isset($_GET["deletequo"]))
  {
    $id = $_GET["deletequo"];
    
    $sql = "DELETE FROM quotation_appraisal WHERE quo_id = '$id'";
    $query = $conn->query($sql);
    if($query){
        $_SESSION['success'] = "ลบใบเสนอราคากลางสำเร็จ!";
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
<<<<<<< HEAD

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
                <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">ใบเสนอราคากลาง</li>
            </ol>
        </nav>
        <hr>
=======
}

@media (min-width: 768px) {
    .table-responsive {
        overflow: inherit;
    }
}
</style>
>>>>>>> Jomtap

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
                    <h3>ใบเสนอราคา quotation</h3>
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
                                    <th scope="col" style="width:12%">เลขที่ใบ<br>เสนอราคา</th>
                                    <th scope="col" style="width:10%">วันที่ในใบ<br>เสนอราคา</th>
                                    <th scope="col" style="width:26%">ชื่อโครงการ</th>
                                    <th scope="col" style="width:26%">ชื่อลูกค้า<br>หน่วยงาน</th>
                                    <th scope="col" style="width:13%">จำนวนเงินรวม</th>
                                    <th scope="col" style="width:10%">ตัวเลือก</th>
                                </tr>
                            </thead>
                            <?php
                                
                                $sql = "SELECT * FROM quotation_appraisal";
                                $query = $conn->query($sql);
                                while ($rows = $query->fetch_assoc()) {
                                    echo '
                                    <tr>
                                        <td>'.$rows["quo_no"].'</td>
                                        <td>'.$rows["quo_date"].'</td>
                                        <td>'.$rows["quo_namepj"].'</td>
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
                            title: 'ต้องการลบใบเสนอราคากลางนี้ !',
                            text: "เลขที่ใบเสนอราคากลาง : " + show_quo_no,
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
<<<<<<< HEAD

            <div class="mx-auto d-flex justify-content-end">
                <a class="btn btn-success px-2 px-md-4 mt-2 rounded-3 fs-5 fw-bold " role="button" href="../dashboard/quotation_appraisal_add.php"><i class="fa-solid fa-file-circle-plus"></i> สร้างใบเสนอราคา</a>
            </div>


            <div class="border border-secondary rounded-3 py-md-4 px-md-4 mt-2 mt-md-4" id="main_row">
                <div class="table-responsive">
                    <table class="table" id="quotationTable">
                        <thead>
                            <tr class="align-center" class="rows">
                                <th scope="col" style="width:12%" class=" text-center">วันที่สร้าง</th>
                                <th scope="col" style="width:15%" class=" text-center">เลขที่ใบเสนอราคา</th>
                                <th scope="col" style="width:21%" class=" text-center">ชื่อโครงการ</th>
                                <th scope="col" style="width:27%" class=" text-center">ชื่อลูกค้า/หน่วยงาน</th>
                                <th scope="col" style="width:15%" class=" text-center">จำนวนเงินรวม</th>
                                <th scope="col" style="width:10%" class=" text-center">ตัวเลือก</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <tr>
                                <td>13/04/2565</td>
                                <td>64578</td>
                                <td>พัฒนาชุมชน 2565</td>
                                <td>IMCO PACK CORPRATION LIMITED</td>
                                <td>11,181.50</td>
                                <td>
                                    <div>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-dark dropdown-toggle px-2 px-md-4" data-bs-toggle="dropdown" aria-expanded="false"><b>เลือก</b> </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="../dashboard/quotation_appraisal_form.php">พิมพ์เอกสาร</a></li>
                                                <li><a class="dropdown-item" href="../dashboard/quotation_appraisal_edit.php">แก้ไข</a></li>
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
                            <tr>
                                <td>13/04/2565</td>
                                <td>64598</td>
                                <td>พัฒนาชุมชน 2565</td>
                                <td>IMCO CORPRATION LIMITED</td>
                                <td>11,181.50</td>
                                <td>
                                    <div>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-dark dropdown-toggle px-2 px-md-4" data-bs-toggle="dropdown" aria-expanded="false"><b>เลือก</b> </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="../dashboard/quotation_appraisal_form.php">พิมพ์เอกสาร</a></li>
                                                <li><a class="dropdown-item" href="../dashboard/quotation_appraisal_edit.php">แก้ไข</a></li>
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
                            <tr>
                                <td>13/04/2565</td>
                                <td>64576</td>
                                <td>พัฒนาชุมชน 2565</td>
                                <td>IMCO PACK LIMITED</td>
                                <td>11,181.50</td>
                                <td>
                                    <div>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-dark dropdown-toggle px-2 px-md-4" data-bs-toggle="dropdown" aria-expanded="false"><b>เลือก</b> </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="../dashboard/quotation_appraisal_form.php">พิมพ์เอกสาร</a></li>
                                                <li><a class="dropdown-item" href="../dashboard/quotation_appraisal_edit.php">แก้ไข</a></li>
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




=======
>>>>>>> Jomtap
        </div>
    </div>
</body>