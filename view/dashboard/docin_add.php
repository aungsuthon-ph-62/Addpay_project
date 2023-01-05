<?php
session_start();
include("../../layout/head.php");
require_once("../../php/conn.php");

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

        $no_check_query = "SELECT * FROM docin WHERE docin_no = '$input_no'";
        $query = $conn->query($no_check_query);
        $check = $query->fetch_assoc();
    
        if ($check) {
            
            $_SESSION['error'] = "เลขที่นี้มีในระบบแล้ว!";
            header("Location: docin_add.php");
            exit;
            
        } else {
            
            if (!empty($_FILES["input_file"]["name"])) {
            
                $targetDir = "../../uploadfile/docinfile/";
                // $fileName = basename($_FILES["input_file"]["name"]);
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
                            header("Location: docin_list.php");
                            exit;
                            
                        } else {
                            
                            unlink("../../uploadfile/docinfile/$fileName");
                            $_SESSION['error'] = "เกิดข้อผิดพลาด! กรุณาลองอีกครั้ง";
                            header("Location: docin_add.php");
                            exit;
                            
                        }
                    } else {
                        
                        $_SESSION['error'] = "เกิดข้อผิดพลาด! อัพโหลดไฟล์ไม่สำเร็จ!";
                        header("Location: docin_add.php");
                        exit;
                        
                    }
                    
                } else {
                    
                    $_SESSION['error'] = "เกิดข้อผิดพลาด! ไม่รองรับนามสกุลไฟล์ชนิดนี้!";
                    header("Location: docin_add.php");
                    exit;
                    
                }
            }  
        }
        $conn->close();        
    }
}

?>


<style>
.font {
    font-size: 1rem;
}

body {
    font-family: "Kanit", sans-serif;
    font-family: "Noto Sans", sans-serif;
    font-family: "Noto Sans Thai", sans-serif;
    font-family: "Poppins", sans-serif;
    font-family: "Prompt", sans-serif;
}
</style>

<body>
    <?php require("../alert.php");?>
    <div class="container py-5">
        <div class="main-body">
            <nav aria-label="breadcrumb" class="main-breadcrumb mt-2">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="../dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="../dashboard/doc.php">หนังสือ</a></li>
                    <li class="breadcrumb-item"><a href="../dashboard/docin_list.php">หนังสือเข้า</a></li>
                    <li class="breadcrumb-item active" aria-current="page">เพิ่มข้อมูลหนังสือเข้า</li>
                </ol>
            </nav>
            <hr>

            <div class="container pb-md-0 mb-5">
                <div>
                    <h3>เพิ่มข้อมูลหนังสือเข้า</h3>
                </div>
                <div class=" px-md-5 py-md-4 justify-content-center">
                    <div class="p-2 py-md-4 px-md-5 border rounded-3">
                        <!-- modal form -->
                        <form action="docin_add.php" method="post" class="" enctype="multipart/form-data">
                            <div class="row g-3 align-items-center mb-3">
                                <div class="col-md-3">
                                    <label for="input_no" class="col-form-label">เลขที่ในใบเสนอราคา</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" id="input_no" name="input_no" class="form-control " required>
                                </div>
                            </div>
                            <div class="row g-3 align-items-center mb-3">
                                <div class="col-md-3">
                                    <label for="input_date" class="col-form-label">วันที่ในใบเสนอราคา</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="date" id="input_date" name="input_date" class="form-control " required>
                                </div>
                            </div>
                            <div class="row g-3 align-items-center mb-3">
                                <div class="col-md-3">
                                    <label for="input_srcname" class="col-form-label">ชื่อบริษัทต้นทาง </label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" id="input_srcname" name="input_srcname" class="form-control "
                                        required>
                                </div>
                            </div>
                            <div class="row g-3 align-items-center mb-3">
                                <div class="col-md-3">
                                    <label for="input_title" name="input_date" class="col-form-label">ชื่อเรื่อง
                                    </label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" id="input_title" name="input_title" class=" form-control "
                                        required>
                                </div>
                            </div>
                            <div class=" row g-3 align-items-center mb-3">
                                <div class="col-md-3 ">
                                    <label for="input_to" class="col-form-label">เรียน (ถึงใคร) </label>
                                </div>

                                <div class="col-md-9">
                                    <input type="text" id="input_to" name="input_to" class="form-control " required>
                                </div>
                            </div>
                            <div class="row g-3 align-items-center mb-3">
                                <div class="col-md-3 ">
                                    <label for="input_file" class="col-form-label">เพิ่มไฟล์ </label>
                                </div>

                                <div class="col-md-9">
                                    <input type="file" id="input_file" name="input_file" class="form-control " required>
                                </div>
                            </div>
                            <!-- Submit button -->
                            <div class="mx-auto d-flex justify-content-end">
                                <button type="reset"
                                    class=" btn btn-outline-danger btn btn-outline-success px-2 mt-2 rounded-3 fw-bold"><i
                                        class="fa-solid fa-eraser"></i> ล้างข้อมูล</button>
                                <button type="submit" name="action" value="create_docin"
                                    class="ms-3  btn btn-outline-success px-2 mt-2 rounded-3  fw-bold">บันทึก <i
                                        class="fa-solid fa-angles-right"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>