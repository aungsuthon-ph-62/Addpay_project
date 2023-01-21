<?php

if(isset($_GET["deletearchives"]))
  {
    $id = $_GET["deletearchives"];
    
    $sql = "SELECT archives_file FROM archives WHERE archives_id = '$id'";
    $query = $conn->query($sql);
    $row = $query->fetch_assoc();
    $oldfile = $row['archives_file'];
    
    $sql = "DELETE FROM archives WHERE archives_id = '$id'";
    $query = $conn->query($sql);
    
    if($query){
            
        unlink("uploadfile/archivesfile/$oldfile");
        $_SESSION['success'] = "ลบเอกสารสำคัญสำเร็จ!";
        echo "<script> window.history.back()</script>";
        exit; 
        
    }
    
    $_SESSION['error'] = "เกิดข้อผิดพลาด! กรุณาลองอีกครั้ง";
    echo "<script> window.history.back()</script>";
    exit;
    
  }
?>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index">หน้าหลัก</a></li>
        <li class="breadcrumb-item active" aria-current="page">เอกสารสำคัญ</li>
    </ol>
</nav>
<hr>
<div class="container bg-secondary-addpay rounded-5">
    <div class="main-body py-md-5 px-md-1 text-white">
        <div class="container">
            <div id="listquotation" class="py-4 p-md-5 text-white">
                <div class="text-center text-md-start">
                    <h3>เอกสารสำคัญ</h3>
                </div>
                <div class="my-4 my-md-3 text-center text-md-end">
                    <a class="btn btn-addpay px-md-4 rounded-3 " href="?page=archives_add">
                        <i class="fa-solid fa-file-circle-plus"></i> เพิ่มข้อมูล</a>
                </div>
                <div class="p-3 p-md-5 bg-light rounded-5 shadow-lg" id="main_row">
                    <div class="table-responsive text-dark">
                        <table class="table table-hover" id="archivesTable">
                            <thead>
                                <tr class="align-center" class="rows">
                                    <th scope="col" style="width:55%">ชื่อเอกสาร</th>
                                    <th scope="col" style="width:40%">ไฟล์</th>
                                    <th scope="col" style="width:10%">ตัวเลือก</th>
                                </tr>
                            </thead>
                            <?php
                                
                                $sql = "SELECT * FROM archives";
                                $query = $conn->query($sql);
                                while ($rows = $query->fetch_assoc()) {
                                    echo '
                                    <tr>
                                        <td>'.$rows["archives_title"].'</td>
                                        <td><a target="_blank" href="uploadfile/archivesfile/'.$rows["archives_file"].'">'.$rows["archives_file"].'</a></td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-dark dropdown-toggle px-2 px-md-4"
                                                    data-bs-toggle="dropdown" aria-expanded="false"><b>เลือก</b>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" target="_blank"
                                                            href="uploadfile/archivesfile/'.$rows["archives_file"].'">เปิดเอกสาร</a>
                                                    </li>
                                                    <li><a class="dropdown-item"
                                                            href="?page=archives_edit&editarchives=' . encode($rows["archives_id"], secret_key()) . '">แก้ไข</a>
                                                    </li>
                                                    <li><a class="dropdown-item deletearchives" href="#" data-archives-title="'.$rows["archives_title"].'" id="'.$rows["archives_id"].'" >ลบ</a></li>
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
                    $('#archivesTable').DataTable();
                });

                $(document).on('click', '.deletearchives', function() {
                    var id = $(this).attr("id");
                    var show_archives_title = $(this).attr("data-archives-title");
                    swal.fire({
                        title: 'ต้องการลบเอกสารสำคัญนี้ !',
                        text: "ชื่อเอกสารสำคัญ : " + show_archives_title,
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'yes!',
                        cancelButtonText: 'no'
                    }).then((result) => {
                        if (result.value) {
                            window.location.href = "?page=archives&deletearchives=" + id;
                        }
                    });
                });
                </script>
                <!-- Data table -->
            </div>
        </div>
    </div>
</div>
<?php $conn->close(); ?>