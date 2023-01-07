<?php

// if(isset($_GET['enc_no'])&&isset($_GET['enc_date'])&&isset($_GET['enc_srcname'])&&isset($_GET['enc_title'])&&isset($_GET['enc_to'])){
    
//     $data1=$_GET['enc_no'];
//     $data2=$_GET['enc_date'];
//     $data3=$_GET['enc_srcname'];
//     $data4=$_GET['enc_title'];
//     $data5=$_GET['enc_to'];
        
//     $dt1 = decode($data1, secret_key());
//     $dt2 = decode($data2, secret_key());
//     $dt3 = decode($data3, secret_key());
//     $dt4 = decode($data4, secret_key());
//     $dt5 = decode($data5, secret_key());
    
// }
    

if(isset($_POST['action'])){
    if ($_POST['action'] == 'create_docin') {
        
        date_default_timezone_set('Asia/Bangkok');
        $date = date("Y-m-d H:i:s");
        $namedate = date('YmdHis');
        global $conn;
        
        $input_no= mysqli_real_escape_string($conn,trim($_POST['input_no']));
        $input_date= mysqli_real_escape_string($conn,trim($_POST['input_date']));
        $input_srcname= mysqli_real_escape_string($conn,trim($_POST['input_srcname']));
        $input_title= mysqli_real_escape_string($conn,trim($_POST['input_title']));
        $input_to= mysqli_real_escape_string($conn,trim($_POST['input_to']));
        $uid = 1;

        // $enc_no = encode($input_no, secret_key());
        // $enc_date = encode($input_date, secret_key());
        // $enc_srcname = encode($input_srcname, secret_key());
        // $enc_title = encode($input_title, secret_key());
        // $enc_to = encode($input_to, secret_key());

        // $data = 'enc_no=' . $enc_no . '&enc_date=' . $enc_date . '&enc_srcname=' . $enc_srcname . '&enc_title=' . $enc_title . '&enc_to=' . $enc_to;

        $no_check_query = "SELECT * FROM docin WHERE docin_no = '$input_no'";
        $query = $conn->query($no_check_query);
        $check = $query->fetch_assoc();
    
        if ($check) {
            
            $_SESSION['error'] = "เลขที่นี้มีในระบบแล้ว!";
            echo "<script> window.history.back()</script>";
            exit;
            
        } else {
            
            if (!empty($_FILES["input_file"]["name"])) {
            
                $targetDir = "uploadfile/docinfile/";
                $temp = explode(".", $_FILES["input_file"]["name"]);
                $fileName = 'docin-'.$namedate. '.' . end($temp);
                $targetFilePath = $targetDir . $fileName;
                $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
                $allowTypes = array('jpg', 'png', 'jpeg', 'pdf', 'word', 'txt', 'doc', 'docx', 'ppt', 'pptx','PDF');
            
                if (in_array($fileType, $allowTypes)) {
                    
                    if (move_uploaded_file($_FILES["input_file"]["tmp_name"], $targetFilePath)) {

                        $query = "INSERT INTO docin (docin_no, docin_date, docin_srcname, docin_title, docin_to, docin_file, docin_create, docin_uid)
                        VALUES ('$input_no', '$input_date', '$input_srcname', '$input_title', '$input_to', '$fileName', '$date', '$uid')";

                        if ($conn->query($query)) {
                            
                            $_SESSION['success'] = "บันทึกหนังสือเข้าสำเร็จ!";
                            echo "<script> window.location.href='?page=doc_in';</script>";
                            exit;
                            
                        } else {
                            
                            unlink("uploadfile/docinfile/$fileName");
                            $_SESSION['error'] = "เกิดข้อผิดพลาด! กรุณาลองอีกครั้ง";
                            echo "<script> window.history.back()</script>";
                            exit;
                            
                        }
                    } else {
                        
                        $_SESSION['error'] = "เกิดข้อผิดพลาด! อัพโหลดไฟล์ไม่สำเร็จ!";
                        echo "<script> window.history.back()</script>";
                        exit;
                        
                    }
                    
                } else {
                    
                    $_SESSION['error'] = "เกิดข้อผิดพลาด! ไม่รองรับนามสกุลไฟล์ชนิดนี้!";
                    echo "<script> window.history.back()</script>";
                    exit;
                    
                }
            }  
        }
        $conn->close();        
    }
}

?>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index">หน้าหลัก</a></li>
        <li class="breadcrumb-item"><a href="?page=doc">หนังสือ</a></li>
        <li class="breadcrumb-item"><a href="?page=doc_in">หนังสือเข้า</a></li>
        <li class="breadcrumb-item active" aria-current="page">เพิ่มข้อมูลหนังสือเข้า</li>
    </ol>
</nav>
<hr>
<div class="container bg-secondary-addpay rounded-5">
    <div class="main-body py-md-5 px-md-1 text-white">
        <div id="paperquotation" class="container p-3 p-md-5">

            <div class="p-4 p-md-5 bg-white rounded-5 shadow-lg">
                <div class="text-center text-md-start text-dark my-3">
                    <h3>เพิ่มข้อมูลหนังสือเข้า</h3>
                </div>
                <form action="?page=doc_in_add" id="docin_form" name="docin_form" method="post"
                    class="form-anticlear p-md-5" enctype="multipart/form-data">
                    <div class="row align-items-center text-dark px-md-5 mb-3">
                        <div class="col-md-3">
                            <h6 for="input_no" class="col-form-label">เลขที่ </h6>
                        </div>
                        <div class="col-md-9">
                            <input type="text" id="input_no" name="input_no" class="form-control " required>
                        </div>
                    </div>
                    <div class="row align-items-center text-dark px-md-5 mb-3">
                        <div class="col-md-3">
                            <h6 for="input_date" class="col-form-label">วันที่ </h6>
                        </div>
                        <div class="col-md-9">
                            <input type="date" id="input_date" name="input_date" class="form-control " required>
                        </div>
                    </div>
                    <div class="row align-items-center text-dark px-md-5 mb-3">
                        <div class="col-md-3">
                            <h6 for="input_srcname" class="col-form-label">ชื่อบริษัทต้นทาง </h6>
                        </div>
                        <div class="col-md-9">
                            <input type="text" id="input_srcname" name="input_srcname" class="form-control " required>
                        </div>
                    </div>
                    <div class="row align-items-center text-dark px-md-5 mb-3">
                        <div class="col-md-3">
                            <h6 for="input_title" class="col-form-label">ชื่อเรื่อง </h6>
                        </div>
                        <div class="col-md-9">
                            <input type="text" id="input_title" name="input_title" class="form-control " required>
                        </div>
                    </div>
                    <div class="row align-items-center text-dark px-md-5 mb-3">
                        <div class="col-md-3 ">
                            <h6 for="input_to" class="col-form-label">เรียน (ถึงใคร) </h6>
                        </div>

                        <div class="col-md-9">
                            <input type="text" id="input_to" name="input_to" class="form-control " required>
                        </div>
                    </div>
                    <div class="row align-items-center text-dark px-md-5 mb-3">
                        <div class="col-md-3 ">
                            <h6 for="input_file" class="col-form-label">เพิ่มไฟล์ </h6>
                        </div>

                        <div class="col-md-9">
                            <input type="file" id="input_file" name="input_file" class="form-control " required>
                        </div>
                    </div>

                    <!-- Submit button -->
                    <div class=" row mt-5">
                        <div class="col-md-12">
                            <div class="d-flex justify-content-end">
                                <button type="reset" class="btn bg-secondary-addpay text-white me-3"><i
                                        class="fa-solid fa-arrow-rotate-left"></i> ล้างข้อมูล</button>
                                <button type="submit" name="action" value="create_docin"
                                    class=" btn btn-addpay text-white">บันทึก <i
                                        class="fa-solid fa-cloud-arrow-up"></i></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- <script src="https://cdn.jsdelivr.net/gh/akjpro/form-anticlear/base.js"></script> -->