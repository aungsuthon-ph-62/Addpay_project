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
    
                    $query = "UPDATE docin SET docin_file='$fileName'";
    
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

            <div id="paperquotation" class="container pb-md-0 mb-5">
                <div>
                    <h3>เพิ่มข้อมูลหนังสือเข้า</h3>
                </div>
                <div class=" px-md-5 py-md-4 justify-content-center">
                    <div class="p-2 py-md-4 px-md-5 border rounded-3">
                        <!-- modal form -->
                        <form action="docin_edit.php" method="post" class="" enctype="multipart/form-data">
                            <div class="row g-3 align-items-center mb-3">
                                <div class="col-md-3">
                                    <label for="input_no" class="col-form-label">เลขที่ในใบเสนอราคา</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" id="input_no" name="input_no" class="form-control " required
                                        value="<?= $row['docin_no'] ?>">
                                </div>
                            </div>
                            <div class="row g-3 align-items-center mb-3">
                                <div class="col-md-3">
                                    <label for="input_date" class="col-form-label">วันที่ในใบเสนอราคา</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="date" id="input_date" name="input_date" class="form-control " required
                                        value="<?= $row['docin_date'] ?>">
                                </div>
                            </div>
                            <div class="row g-3 align-items-center mb-3">
                                <div class="col-md-3">
                                    <label for="input_srcname" class="col-form-label">ชื่อบริษัทต้นทาง </label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" id="input_srcname" name="input_srcname" class="form-control "
                                        required value="<?= $row['docin_srcname'] ?>">
                                </div>
                            </div>
                            <div class="row g-3 align-items-center mb-3">
                                <div class="col-md-3">
                                    <label for="input_title" name="input_date" class="col-form-label">ชื่อเรื่อง
                                    </label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" id="input_title" name="input_title" class=" form-control "
                                        required value="<?= $row['docin_title'] ?>">
                                </div>
                            </div>
                            <div class=" row g-3 align-items-center mb-3">
                                <div class="col-md-3 ">
                                    <label for="input_to" class="col-form-label">เรียน (ถึงใคร) </label>
                                </div>

                                <div class="col-md-9">
                                    <input type="text" id="input_to" name="input_to" class="form-control " required
                                        value="<?= $row['docin_to'] ?>">
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
                                <button type="submit" name="action" value="edit_docin"
                                    class="ms-3  btn btn-outline-success px-2 mt-2 rounded-3  fw-bold">บันทึก
                                    <i class="fa-solid fa-angles-right"></i></button>
                                <input type="hidden" name="no_check" id="no_check" value="<?= $row['docin_no'];?>" />
                                <input type="hidden" name="docin_id" id="docin_id" value="<?= $row['docin_id'];?>" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<?php  $conn->close();?>