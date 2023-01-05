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
    
    if($query){
            
        unlink("../../uploadfile/contractfile/$oldfile1"); 
        unlink("../../uploadfile/contractfile/$oldfile2");
        $_SESSION['success'] = "ลบเอกสารสัญญาสำเร็จ!";
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
                    <h3>เอกสารสัญญา</h3>
                </div>
                <div class="mx-auto d-flex justify-content-end">
                    <a class="btn btn-success px-2 px-md-4 mt-2 rounded-3 fs-5 fw-bold " role="button"
                        href="../dashboard/docin_add.php"><i class="fa-solid fa-file-circle-plus"></i> เพิ่มข้อมูล</a>
                </div>

                <div class="border border-secondary rounded-3 py-md-4 px-md-4 mt-2 mt-md-4" id="main_row">
                    <div class="table-responsive">
                        <table class="table" id="contractTable">
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
                                
                                $sql = "SELECT * FROM contract";
                                $query = $conn->query($sql);
                                while ($rows = $query->fetch_assoc()) {
                                    echo '
                                    <tr>
                                        <td>'.$rows["contract_lgdeld"].'</td>
                                        <td>'.$rows["contract_lgexpd"].'</td>
                                        <td>'.$rows["contract_comp"].'</td>
                                        <td>'.$rows["contract_title"].'</td>
                                        <td>'.$rows["contract_ann"].'</td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-dark dropdown-toggle px-2 px-md-4"
                                                    data-bs-toggle="dropdown" aria-expanded="false"><b>เลือก</b>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" target="_blank"
                                                            href="../../uploadfile/contractfile/'.$rows["contract_file"].'">เปิดเอกสาร</a>
                                                    </li>
                                                    <li><a class="dropdown-item" target="_blank"
                                                            href="../../uploadfile/contractfile/'.$rows["contract_filesigner"].'">เปิดเอกสารผู้เซ็นสัญญา</a>
                                                    </li>
                                                    <li><a class="dropdown-item"
                                                            href="../dashboard/contract_edit.php?editcontract='.$rows["contract_id"].'">แก้ไข</a>
                                                    </li>
                                                    <li><a class="dropdown-item deletecontract" href="#" data-contract-title="'.$rows["contract_title"].'" id="'.$rows["contract_id"].'" >ลบ</a></li>
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
                    $('#contractTable').DataTable();
                });

                $(document).on('click', '.deletecontract', function() {
                    var id = $(this).attr("id");
                    var show_contract_title = $(this).attr("data-contract-title");
                    swal.fire({
                        title: 'ต้องการลบเอกสารสัญญานี้ !',
                        text: "ชื่อสัญญา : " + show_contract_title,
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'yes!',
                        cancelButtonText: 'no'
                    }).then((result) => {
                        if (result.value) {
                            window.location.href = "?deletecontract=" + id;
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