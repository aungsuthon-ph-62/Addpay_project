<?php
session_start();
include_once ("../../layout/head.php");
require_once("../../php/conn.php");

if(isset($_POST['action'])){
    if ($_POST['action'] == 'create_archives') {
        
        date_default_timezone_set('Asia/Bangkok');
        $date = date("Y-m-d H:i:s");
        $namedate = date('YmdHis');
        global $conn;
        
        $input_title= mysqli_real_escape_string($conn,trim($_POST['input_title']));
        $uid = 1;

        
            
        if (!empty($_FILES["input_file"]["name"])) {
        
            $targetDir = "../../uploadfile/archivesfile/";
            // $fileName = basename($_FILES["input_file"]["name"]);
            $temp = explode(".", $_FILES["input_file"]["name"]);
            $fileName = 'archives-'.$namedate. '.' . end($temp);
            $targetFilePath = $targetDir . $fileName;
            $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
            $allowTypes = array('jpg', 'png', 'jpeg', 'pdf', 'word', 'txt', 'doc', 'docx', 'ppt', 'pptx','PDF');
        
            if (in_array($fileType, $allowTypes)) {
                
                if (move_uploaded_file($_FILES["input_file"]["tmp_name"], $targetFilePath)) {

                    $query = "INSERT INTO archives (archives_title, archives_file, archives_create, archives_uid)
                    VALUES ('$input_title', '$fileName', '$date', '$uid')";

                    if ($conn->query($query)) {
                        
                        $_SESSION['success'] = "บันทึกหนังสือสำคัญสำเร็จ!";
                        header("Location: archives_list.php");
                        exit;
                        
                    } else {
                        
                        $_SESSION['error'] = "เกิดข้อผิดพลาด! กรุณาลองอีกครั้ง";
                        header("Location: archives_add.php");
                        exit;
                        
                    }
                } else {
                    
                    $_SESSION['error'] = "เกิดข้อผิดพลาด! อัพโหลดไฟล์ไม่สำเร็จ!";
                    header("Location: archives_add.php");
                    exit;
                    
                }
                
            } else {
                
                $_SESSION['error'] = "เกิดข้อผิดพลาด! ไม่รองรับนามสกุลไฟล์ชนิดนี้!";
                header("Location: archives_add.php");
                exit;
                
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
                    <li class="breadcrumb-item"><a href="../dashboard/archives_list.php">เอกสารสำคัญ</a></li>
                    <li class="breadcrumb-item active" aria-current="page">เพิ่มเอกสารสำคัญ</li>
                </ol>
                </ol>
            </nav>
            <hr>

            <div class="container pb-md-0 mb-5">
                <div>
                    <h3>เพิ่มข้อมูลเอกสารสำคัญ</h3>
                </div>
                <div class=" px-md-5 py-md-4 justify-content-center">
                    <div class="p-2 py-md-4 px-md-5 border rounded-3">
                        <!-- modal form -->
                        <form action="archives_add.php" method="post" class="" enctype="multipart/form-data">
                            <div class="row g-3 align-items-center mb-3">
                                <div class="col-md-3">
                                    <label for="input_title" class="col-form-label">ชื่อเอกสาร </label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" id="input_title" name="input_title" class="form-control "
                                        required>
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
                                <button type="submit" name="action" value="create_archives"
                                    class="ms-3  btn btn-outline-success px-2 mt-2 rounded-3  fw-bold">บันทึก
                                    <i class="fa-solid fa-angles-right"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>