<?php
session_start();
include("../../layout/head.php");
require_once("../../php/conn.php");

if(isset($_GET["deletecontract"]))
  {
    $id = $_GET["deletecontract"];
    
    $sql = "SELECT * FROM contract WHERE contract_id = '$id'";
    $query = $conn->query($sql);
    $row = $query->fetch_assoc();
    $oldfile1 = $row['contract_file'];
    $oldfile2= $row['contract_filesigner'];
    
    $sql = "DELETE FROM contract WHERE contract_id = '$id'";
    $query = $conn->query($sql);
    
    if($query && unlink("../../uploadfile/contractfile/$oldfile1") 
    && unlink("../../uploadfile/contractfile/$oldfile2")){
            
        $_SESSION['success'] = "ลบเพิ่มเอกสารสัญญาสำเร็จ!";
        header("Location: contract_list.php");
        exit; 
        
    }
    
    $_SESSION['error'] = "เกิดข้อผิดพลาด! กรุณาลองอีกครั้ง";
    header("Location: contract_list.php");
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
    <div class="container">
        <div class="main-body">
            <nav aria-label="breadcrumb" class="main-breadcrumb mt-2">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Contrat</li>
                </ol>
            </nav>
            <hr>
            <div class="container pb-md-0 mb-5">
                <div>
                    <h3>หนังสือเข้า</h3>
                </div>
                <div class="mx-auto d-flex justify-content-end">
                    <a class="btn btn-success px-2 px-md-4 mt-2 rounded-3 fs-5 fw-bold " role="button"
                        href="../dashboard/docin_add.php"><i class="fa-solid fa-file-circle-plus"></i> เพิ่มข้อมูล</a>
                </div>

                <div class="border border-secondary rounded-3 py-md-4 px-md-4 mt-2 mt-md-4" id="main_row">
                    <div class="table-responsive">
                        <table class="table" id="docinTable">
                            <thead>
                                <tr class="align-center" class="rows">
                                    <th style="width:10%" scope="col">วันที่ส่ง LG</th>
                                    <th style="width:10%" scope="col">วันหมดอายุ LG</th>
                                    <th style="width:20%" scope="col">ชื่อบริษัท</th>
                                    <th style="width:20%" scope="col">ชื่อสัญญา</th>
                                    <th style="width:10%" scope="col">วันประกาศผล</th>
                                    <th style="width:10%" scope="col">ตัวเลือก</th>
                                </tr>
                            </thead>
                            <?php
                                
                                $sql = "SELECT * FROM docin";
                                $query = $conn->query($sql);
                                while ($rows = $query->fetch_assoc()) {
                                    echo '
                                    <tr>
                                        <td>'.$rows["docin_no"].'</td>
                                        <td>'.$rows["docin_date"].'</td>
                                        <td>'.$rows["docin_srcname"].'</td>
                                        <td>'.$rows["docin_title"].'</td>
                                        <td>'.$rows["docin_file"].'</td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-dark dropdown-toggle px-2 px-md-4"
                                                    data-bs-toggle="dropdown" aria-expanded="false"><b>เลือก</b>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" target="_blank"
                                                            href="../../uploadfile/docinfile/'.$rows["docin_file"].'">เปิดเอกสาร</a>
                                                    </li>
                                                    <li><a class="dropdown-item"
                                                            href="../dashboard/docin_edit.php?editdocin='.$rows["docin_id"].'">แก้ไข</a>
                                                    </li>
                                                    <li><a class="dropdown-item deletedocin" href="#" data-docin-no="'.$rows["docin_no"].'" id="'.$rows["docin_id"].'" >ลบ</a></li>
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
                    $('#docinTable').DataTable();
                });

                $(document).on('click', '.deletedocin', function() {
                    var id = $(this).attr("id");
                    var show_docin_no = $(this).attr("data-docin-no");
                    swal.fire({
                        title: 'ต้องการลบหนังสือเข้านี้ !',
                        text: "เลขที่หนังสือเข้า : " + show_docin_no,
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'yes!',
                        cancelButtonText: 'no'
                    }).then((result) => {
                        if (result.value) {
                            window.location.href = "?deletedocin=" + id;
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









<div class="row gutters-md">
    <div class="col-md-12">
        <div class="card mb-3">
            <div class="card-body">
                <div class="d-flex justify-content-end me-2 mb-2">
                    <button type="button" class="btn p-1  text-white" data-bs-toggle="modal"
                        data-bs-target="#contractaddModal" style="background-color:#FE9100 ;"><i
                            class="fa-solid fa-file-circle-plus">&nbsp;เพิ่มเอกสาร</i></button>
                </div>
                <div class=" row">
                    <div class="col-lg-12">
                        <div class="main-box clearfix">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="hidden"><span>id</span></th>
                                            <th><span>วันที่ส่ง LG</span></th>
                                            <th><span>วันหมดอายุ LG</span></th>
                                            <th><span>ชื่อสัญญา</span></th>
                                            <th><span>ชื่อบริษัท</span></th>
                                            <th><span>ไฟล์สัญญา</span></th>
                                            <th><span>ไฟล์เอกสารผู้เซ็นสัญญา</span></th>
                                            <th><span>วันประกาศผล</span></th>
                                            <th>&nbsp;</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="hidden">12</td>
                                            <td><?=date("Y-m-d");?></td>
                                            <td><?=date("Y-m-d");?></td>
                                            <td>สัญญาเมื่อสายัน</td>
                                            <td>แอดเพย์ เซอวิสพอยท์</td>
                                            <td><a href="#">test.pdf</a></td>
                                            <td><a href="#">test2.pdf</a></td>
                                            <td><?=date("Y-m-d");?></td>
                                            <td style="width: 10%;">
                                                <a class="table-link contracteditModal">
                                                    <span class="fa-stack">
                                                        <i class="fa fa-square fa-stack-2x"></i>
                                                        <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>
                                                    </span>
                                                </a>
                                                <a class="table-link danger contractdeleteModal">
                                                    <span class="fa-stack">
                                                        <i class="fa fa-square fa-stack-2x"></i>
                                                        <i class="fa fa-trash fa-stack-1x fa-inverse"></i>
                                                    </span>
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <ul class="pagination pull-right">
                                <li><a href="#"><i class="fa fa-chevron-left"></i></a></li>
                                <li>&nbsp;</li>
                                <li><a href="#">1</a></li>
                                <li>&nbsp;</li>
                                <li><a href="#">2</a></li>
                                <li>&nbsp;</li>
                                <li><a href="#">3</a></li>
                                <li>&nbsp;</li>
                                <li><a href="#"><i class="fa fa-chevron-right"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>