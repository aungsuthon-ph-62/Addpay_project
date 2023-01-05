<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index">หน้าหลัก</a></li>
        <li class="breadcrumb-item"><a href="?page=doc">หนังสือ</a></li>
        <li class="breadcrumb-item"><a href="?page=doc_in">หนังสือเข้า</a></li>
        <li class="breadcrumb-item active" aria-current="page">แก้ไขข้อมูลหนังสือเข้า</li>
    </ol>
</nav>
<hr>
<?php
session_start();
include("../../layout/head.php");
require_once("../../php/conn.php");

if (isset($_GET['editdocin'])) {
    
    $id = $_GET['editdocin'];

    $sql = "SELECT * FROM docin WHERE docin_id ='$id'";
    $query = $conn->query($sql);
    $row = $query->fetch_assoc();
    
}

if(isset($_POST['action'])){
    if ($_POST['action'] == 'edit_docin') {

        $id= mysqli_real_escape_string($conn,trim($_POST['docin_id']));
        $no_check= mysqli_real_escape_string($conn,trim($_POST['no_check']));
        $input_no= mysqli_real_escape_string($conn,trim($_POST['input_no']));
        
        if($input_no == $no_check){
            
            edit_docin();
            exit;
            
        }else{
            
            $no_check_query = "SELECT * FROM docin WHERE docin_no = '$input_no'";
            $query = $conn->query($no_check_query);
            $check = $query->fetch_assoc();
            
            if ($check) {
                $_SESSION['error'] = "เลขที่นี้มีในระบบแล้ว!";
                header('Location: docin_edit.php?editdocin='.$id);
                exit;
                
            }else{
                
                edit_docin();
                exit;
                
            }
        }
    }
}



function edit_docin(){
    
    date_default_timezone_set('Asia/Bangkok');
    $date = date("Y-m-d H:i:s");
    $namedate = date('YmdHis');
    global $conn;

    $id= mysqli_real_escape_string($conn,trim($_POST['docin_id']));
    $input_no= mysqli_real_escape_string($conn,trim($_POST['input_no']));
    $input_date= mysqli_real_escape_string($conn,trim($_POST['input_date']));
    $input_srcname= mysqli_real_escape_string($conn,trim($_POST['input_srcname']));
    $input_title= mysqli_real_escape_string($conn,trim($_POST['input_title']));
    $input_to= mysqli_real_escape_string($conn,trim($_POST['input_to']));
    $uid = 1;

    $query = "UPDATE docin SET docin_no='$input_no', docin_date='$input_date', docin_srcname='$input_srcname', docin_title='$input_title',
                docin_to='$input_to', docin_update='$date', docin_uid='$uid' WHERE docin_id ='$id'";

    if ($conn->query($query)) {
        
        if (!empty($_FILES["input_file"]["name"])) {
            
            $targetDir = "../../uploadfile/docinfile/";
            $temp = explode(".", $_FILES["input_file"]["name"]);
            $fileName = 'docin-'.$namedate. '.' . end($temp);
            $targetFilePath = $targetDir . $fileName;
            $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
            $allowTypes = array('jpg', 'png', 'jpeg', 'pdf', 'word', 'txt', 'doc', 'docx', 'ppt', 'pptx','PDF');
            
            if (in_array($fileType, $allowTypes)) {

                $sql = "SELECT docin_file FROM docin WHERE docin_id = '$id'";
                $query = $conn->query($sql);
                $row = $query->fetch_assoc();
                $oldfile = $row['docin_file'];
                
                if (move_uploaded_file($_FILES["input_file"]["tmp_name"], $targetFilePath)) {
    
                    $query = "UPDATE docin SET docin_file='$fileName' WHERE docin_id = '$id'";
    
                    if ($conn->query($query)) {
                        
                        unlink("../../uploadfile/docinfile/$oldfile");
                        $_SESSION['success'] = "แก้ไขหนังสือเข้าสำเร็จ!";
                        header("Location: docin_list.php");
                        exit;
                        
                    } else {
                        
                        unlink("../../uploadfile/docinfile/$fileName");
                        $_SESSION['error'] = "เกิดข้อผิดพลาด! กรุณาลองอีกครั้ง";
                        header('Location: docin_edit.php?editdocin='.$id);
                        exit;
                        
                    }
                } else {
                    
                    $_SESSION['error'] = "เกิดข้อผิดพลาด! อัพโหลดไฟล์ไม่สำเร็จ!";
                    header('Location: docin_edit.php?editdocin='.$id);
                    exit;
                    
                }
                
            } else {
                
                $_SESSION['error'] = "เกิดข้อผิดพลาด! ไม่รองรับนามสกุลไฟล์ชนิดนี้!";
                header('Location: docin_edit.php?editdocin='.$id);
                exit;
                
            }
            
        }else{
            
            $_SESSION['success'] = "แก้ไขหนังสือเข้าสำเร็จ!";
            header("Location: docin_list.php");
            exit;
        }
        
    } else {
        
        $_SESSION['error'] = "เกิดข้อผิดพลาด! กรุณาลองอีกครั้ง";
        header('Location: docin_edit.php?editdocin='.$id);
        exit;
        
    }
}

?>

<div class="container bg-secondary-addpay rounded-5">
    <div class="main-body p-md-5 text-white">
        <div id="paperquotation" class="container p-3 p-md-5">

            <div class="p-4 p-md-5 bg-white rounded-5 shadow-lg">
                <div class="text-center text-md-start text-dark my-3">
                    <h3>แก้ไขข้อมูลหนังสือเข้า #</h3>
                </div>
                <form action="" method="post" class="p-md-5">
                    <div class="row align-items-center text-dark px-md-5 mb-3">
                        <div class="col-md-3">
                            <h6 for="inputsrcname" class="col-form-label">ชื่อบริษัทต้นทาง </h6>
                        </div>
                        <div class="col-md-9">
                            <input type="text" id="inputsrcname" class="form-control " required>
                        </div>
                    </div>
                    <div class="row align-items-center text-dark px-md-5 mb-3">
                        <div class="col-md-3">
                            <h6 for="inputDate" class="col-form-label">วันที่ </h6>
                        </div>
                        <div class="col-md-9">
                            <input type="date" id="inputDate" class="form-control " required>
                        </div>
                    </div>
                    <div class="row align-items-center text-dark px-md-5 mb-3">
                        <div class="col-md-3">
                            <h6 for="inputTitle" class="col-form-label">ชื่อเรื่อง </h6>
                        </div>
                        <div class="col-md-9">
                            <input type="text" id="inputTitle" class="form-control " required>
                        </div>
                    </div>
                    <div class="row align-items-center text-dark px-md-5 mb-3">
                        <div class="col-md-3 ">
                            <h6 for="inputTo" class="col-form-label">เรียน (ถึงใคร) </h6>
                        </div>

                        <div class="col-md-9">
                            <input type="text" id="inputTo" class="form-control " required>
                        </div>
                    </div>
                    <div class="row align-items-center text-dark px-md-5 mb-3">
                        <div class="col-md-3 ">
                            <h6 for="inputFile" class="col-form-label">เพิ่มไฟล์ </h6>
                        </div>

                        <div class="col-md-9">
                            <input type="file" id="inputFile" class="form-control " required>
                        </div>
                    </div>

                    <!-- Submit button -->
                    <div class="row mt-5">
                        <div class="col-md-12">
                            <div class="d-flex justify-content-end">
                                <button type="reset" class="btn bg-secondary-addpay text-white me-3"><i class="fa-solid fa-arrow-rotate-left"></i> ล้างข้อมูล</button>
                                <button type="submit" class="btn btn-addpay text-white">บันทึก <i class="fa-solid fa-cloud-arrow-up"></i></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
