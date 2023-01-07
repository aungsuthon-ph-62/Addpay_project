<?php

if(isset($_GET["deletedocin"])){
    
    $id = $_GET["deletedocin"];
    
    $sql = "SELECT docin_file FROM docin WHERE docin_id = '$id'";
    $query = $conn->query($sql);
    $row = $query->fetch_assoc();
    $oldfile = $row['docin_file'];
    
    $sql = "DELETE FROM docin WHERE docin_id = '$id'";
    $query = $conn->query($sql);
    
    if($query){
            
        unlink("uploadfile/docinfile/$oldfile");
        $_SESSION['success'] = "ลบหนังสือเข้าสำเร็จ!";
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
        <li class="breadcrumb-item"><a href="?page=doc">หนังสือ</a></li>
        <li class="breadcrumb-item active" aria-current="page">หนังสือเข้า</li>
    </ol>
</nav>
<hr>

<div class="container bg-secondary-addpay rounded-5">
    <div class="main-body p-md-5 text-white">
        <div class="container">
            <div id="listquotation" class="p-3 p-md-5 text-white">
                <div class="text-center text-md-start">
                    <h3>หนังสือเข้า</h3>
                </div>

                <div class="my-4 my-md-3 text-center text-md-end">
                    <a class="btn btn-addpay px-md-4 rounded-3 " href="?page=doc_in_add">
                        <i class="fa-solid fa-file-circle-plus"></i> เพิ่มข้อมูล</a>
                </div>

                <div class="p-3 p-md-5 bg-light rounded-5 shadow-lg" id="main_row">
                    <div class="table-responsive">
                        <table class="table" id="quotationTable">
                            <thead>
                                <tr class="align-center" class="rows">
                                    <th style="width:25%" scope="col">เลขที่</th>
                                    <th style="width:15%" scope="col">วันที่</th>
                                    <th style="width:30%" scope="col">ชื่อบริษัทต้นทาง</th>
                                    <th style="width:30%" scope="col">เรื่อง</th>
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
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-dark dropdown-toggle px-2 px-md-4"
                                                    data-bs-toggle="dropdown" aria-expanded="false"><b>เลือก</b>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" target="_blank"
                                                            href="uploadfile/docinfile/'.$rows["docin_file"].'">เปิดเอกสาร</a>
                                                    </li>
                                                    <li><a class="dropdown-item"
                                                            href="?page=doc_in_edit&editdocin=' . encode($rows["docin_id"], secret_key()) . '">แก้ไข</a>
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
                            window.location.href = "?page=doc_in&deletedocin=" + id;
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