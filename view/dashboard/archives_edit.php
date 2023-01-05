<?php
session_start();
include_once ("../../layout/head.php");
require_once("../../php/conn.php");

if (isset($_GET['editarchives'])) {
    
    $id = $_GET['editarchives'];

    $sql = "SELECT * FROM archives WHERE archives_id ='$id'";
    $query = $conn->query($sql);
    $row = $query->fetch_assoc();
    
}

if(isset($_POST['action'])){
    if ($_POST['action'] == 'edit_archives') {

        date_default_timezone_set('Asia/Bangkok');
        $date = date("Y-m-d H:i:s");
        $namedate = date('YmdHis');
        global $conn;
        
        $id= mysqli_real_escape_string($conn,trim($_POST['archives_id']));
        $input_title= mysqli_real_escape_string($conn,trim($_POST['input_title']));
        $uid = 1;

        $query = "UPDATE archives SET archives_title='$input_title', archives_update='$date', archives_uid='$uid' WHERE archives_id ='$id'";
    
        if ($conn->query($query)) {
            
            if (!empty($_FILES["input_file"]["name"])) {
        
                $targetDir = "../../uploadfile/archivesfile/";
                $temp = explode(".", $_FILES["input_file"]["name"]);
                $fileName = 'archives-'.$namedate. '.' . end($temp);
                $targetFilePath = $targetDir . $fileName;
                $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
                $allowTypes = array('jpg', 'png', 'jpeg', 'pdf', 'word', 'txt', 'doc', 'docx', 'ppt', 'pptx','PDF');
            
                if (in_array($fileType, $allowTypes)) {
    
                    $sql = "SELECT archives_file FROM archives WHERE archives_id = '$id'";
                    $query = $conn->query($sql);
                    $row = $query->fetch_assoc();
                    $oldfile = $row['archives_file'];
                    
                    if (move_uploaded_file($_FILES["input_file"]["tmp_name"], $targetFilePath)) {
    
                        $query = "UPDATE archives SET archives_file='$fileName' WHERE archives_id ='$id'";
    
                        if ($conn->query($query)) {
                            
                            unlink("../../uploadfile/archivesfile/$oldfile");
                            $_SESSION['success'] = "บันทึกหนังสือสำคัญสำเร็จ!";
                            header("Location: archives_list.php");
                            exit;
                            
                        } else {
                            
                            unlink("../../uploadfile/archivesfile/$fileName");
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
            
        } else {
            
            $_SESSION['success'] = "บันทึกหนังสือสำคัญสำเร็จ!";
            header("Location: archives_list.php");
            exit;
            
        }   
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
                        <form action="archives_edit.php" method="post" class="" enctype="multipart/form-data">
                            <div class="row g-3 align-items-center mb-3">
                                <div class="col-md-3">
                                    <label for="input_title" class="col-form-label">ชื่อเอกสาร </label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" id="input_title" name="input_title" class="form-control" required
                                        value="<?= $row['archives_title'] ?>">
                                </div>
                            </div>
                            <div class="row g-3 align-items-center mb-3">
                                <div class="col-md-3 ">
                                    <label for="input_file" class="col-form-label">เพิ่มไฟล์ </label>
                                </div>

                                <div class="col-md-9">
                                    <input type="file" id="input_file" name="input_file" class="form-control ">
                                </div>
                            </div>

                            <!-- Submit button -->
                            <div class="mx-auto d-flex justify-content-end">
                                <button type="reset"
                                    class=" btn btn-outline-danger btn btn-outline-success px-2 mt-2 rounded-3 fw-bold"><i
                                        class="fa-solid fa-eraser"></i> ล้างข้อมูล</button>
                                <button type="submit" name="action" value="edit_archives"
                                    class="ms-3  btn btn-outline-success px-2 mt-2 rounded-3  fw-bold">บันทึก
                                    <i class="fa-solid fa-angles-right"></i></button>
                                <input type="hidden" name="archives_id" id="archives_id"
                                    value="<?= $row['archives_id'];?>" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<?php  $conn->close();?>