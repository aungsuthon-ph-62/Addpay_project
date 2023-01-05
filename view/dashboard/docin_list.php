<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index">หน้าหลัก</a></li>
        <li class="breadcrumb-item"><a href="?page=doc">หนังสือ</a></li>
        <li class="breadcrumb-item active" aria-current="page">หนังสือเข้า</li>
    </ol>
</nav>
<hr>
<?php
session_start();
include("../../layout/head.php");
require_once("../../php/conn.php");

if(isset($_GET["deletedocin"])){
    
    $id = $_GET["deletedocin"];
    
    $sql = "SELECT docin_file FROM docin WHERE docin_id = '$id'";
    $query = $conn->query($sql);
    $row = $query->fetch_assoc();
    $oldfile = $row['docin_file'];
    
    $sql = "DELETE FROM docin WHERE docin_id = '$id'";
    $query = $conn->query($sql);
    
    if($query){
            
        unlink("../../uploadfile/docinfile/$oldfile");
        $_SESSION['success'] = "ลบหนังสือเข้าสำเร็จ!";
        header("Location: docin_list.php");
        exit; 
        
    }
    
    $_SESSION['error'] = "เกิดข้อผิดพลาด! กรุณาลองอีกครั้ง";
    header("Location: docin_list.php");
    exit;
    
  }

?>


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
                                    <th class="text-center" style="width:5%" scope="col">ลำดับ</th>
                                    <th class="text-center" style="width:30%" scope="col">ชื่อบริษัทต้นทาง</th>
                                    <th class="text-center" style="width:10%" scope="col">วันที่</th>
                                    <th class="text-center" style="width:20%" scope="col">เรื่อง</th>
                                    <th class="text-center" style="width:20%" scope="col">เรียน (ถึงใคร)</th>
                                    <th class="text-center" style="width:20%" scope="col">ไฟล์</th>
                                    <th class="text-center" style="width:10%" scope="col">ตัวเลือก</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                <tr>
                                    <td>1</td>
                                    <td>บริษัท แอดเพย์ เซอร์วิสพอยท์ จำกัด</td>
                                    <td>16/11/65</td>
                                    <td>หนังสือเชิญเป็นวิทยากร</td>
                                    <td>คุณหัตถยา บำรุงสุข</td>
                                    <td><i class="fa-solid fa-file-pdf"></i> lovetoey.pdf</td>
                                    <td>
                                        <div>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-dark dropdown-toggle px-2 px-md-4" data-bs-toggle="dropdown" aria-expanded="false"><b>เลือก</b> </button>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" href="#">เปิดเอกสาร</a></li>
                                                    <li><a class="dropdown-item" href="?page=doc_in_edit">แก้ไข</a></li>
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

            </div>
        </div>
    </div>
</div>



<!-- add expenses -->
<!-- <div class="modal fade" id="addExpensesModal" tabindex="-1" aria-labelledby="addExpensesModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addExpensesModal">เพิ่มข้อมูลใบสำคัญจ่าย</h5>
            </div>
            <form method="post" action="">
                <div class="modal-body">
                    <input type="hidden" name="" value="">
                    <div class="p-3 p-md-5">
                        <div class="form-floating mb-4">
                            <input type="text" class="form-control form-control-lg border border-start-0 border-top-0 border-end-0 rounded-0" id=" inputDate" name="inputDate" placeholder="กรอกชื่อ">
                            <label for="inputDate" class="form-label">วันที่</label>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="text" class="form-control form-control-lg border border-start-0 border-top-0 border-end-0 rounded-0" id=" inputList" name="inputList" placeholder="กรอกชื่อ">
                            <label for="inputList" class="form-label">รายการ</label>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="text" class="form-control form-control-lg border border-start-0 border-top-0 border-end-0 rounded-0" id=" inputPrice" name="inputPrice" placeholder="กรอกนามสกุล">
                            <label for="inputPrice" class="form-label">จำนวนเงิน</label>
                        </div>
                        <select class="form-select mb-4 rounded-pill" id="inputType" name="inputType">
                            <option selected disabled>--ประเภท--</option>
                            <option value="ประจำ">ประจำ</option>
                            <option value="ไม่ประจำ">ไม่ประจำ</option>
                        </select>
                        
                        <div class="form-floating mb-4">
                            <input type="file" class="form-control form-control-lg border border-start-0 border-top-0 border-end-0 rounded-0" id=" inputPrice" name="inputPrice" placeholder="กรอกนามสกุล">
                            
                        </div>
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