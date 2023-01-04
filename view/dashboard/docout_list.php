<?php
session_start();
include("../../layout/head.php");
require_once("../../php/conn.php");

if(isset($_GET["deletedocout"]))
  {
    $id = $_GET["deletedocout"];
    
    $sql = "DELETE FROM docout WHERE docout_id = '$id'";
    $query = $conn->query($sql);
    
    if($query){
        $_SESSION['success'] = "ลบใบเสนอราคากลางสำเร็จ!";
        header("Location: docout_list.php");
        exit;
    }
    
    $_SESSION['error'] = "เกิดข้อผิดพลาด! กรุณาลองอีกครั้ง";
    header("Location: docout_list.php");
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
                    <li class="breadcrumb-item"><a href="../dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="./doc.php">หนังสือ</a></li>
                    <li class="breadcrumb-item active" aria-current="page">หนังสือออก</li>
                </ol>
            </nav>
            <hr>
            <div id="listquotation" class="container pb-md-0 mb-5">
                <div>
                    <h3>หนังสือออก</h3>
                </div>
                <div class="mx-auto d-flex justify-content-end">
                    <a class="btn btn-success px-2 px-md-4 mt-2 rounded-3 fs-5 fw-bold " role="button"
                        href="../dashboard/docout_add.php"><i class="fa-solid fa-file-circle-plus"></i> เพิ่มข้อมูล</a>
                </div>

                <div class="border border-secondary rounded-3 py-md-4 px-md-4 mt-2 mt-md-4" id="main_row">
                    <div class="table-responsive">
                        <table class="table" id="docoutTable">
                            <thead>
                                <tr class="align-center" class="rows">
                                    <th style="width:17%" scope="col">เลขที่</th>
                                    <th style="width:15%" scope="col">วันที่</th>
                                    <th style="width:30%" scope="col">เรื่อง</th>
                                    <th style="width:28%" scope="col">เรียน (ถึงใคร)</th>
                                    <th style="width:10%" scope="col">ตัวเลือก</th>
                                </tr>
                            </thead>
                            <?php
                                
                                $sql = "SELECT * FROM docout";
                                $query = $conn->query($sql);
                                while ($rows = $query->fetch_assoc()) {
                                    echo '
                                    <tr>
                                        <td>'.$rows["docout_no"].'</td>
                                        <td>'.$rows["docout_date"].'</td>
                                        <td>'.$rows["docout_title"].'</td>
                                        <td>'.$rows["docout_to"].'</td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-dark dropdown-toggle px-2 px-md-4"
                                                    data-bs-toggle="dropdown" aria-expanded="false"><b>เลือก</b>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item"
                                                            href="../dashboard/docout_form.php?pdfdocout='.$rows["docout_id"].'">พิมพ์เอกสาร</a>
                                                    </li>
                                                    <li><a class="dropdown-item"
                                                            href="../dashboard/docout_edit.php?editdocout='.$rows["docout_id"].'">แก้ไข</a>
                                                    </li>
                                                    <li><a class="dropdown-item deletedocout" href="#" data-docout-no="'.$rows["docout_no"].'" id="'.$rows["docout_id"].'" >ลบ</a></li>
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
                    $('#docoutTable').DataTable();
                });

                $(document).on('click', '.deletedocout', function() {
                    var id = $(this).attr("id");
                    var show_docout_no = $(this).attr("data-docout-no");
                    swal.fire({
                        title: 'ต้องการลบหนังสือออกนี้ !',
                        text: "เลขที่หนังสือออก : " + show_docout_no,
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'yes!',
                        cancelButtonText: 'no'
                    }).then((result) => {
                        if (result.value) {
                            window.location.href = "?deletedocout=" + id;
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