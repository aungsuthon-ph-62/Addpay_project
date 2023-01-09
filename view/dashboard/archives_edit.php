<?php
if (isset($_GET['editarchives'])) {
    
    $get_decode = $_GET['editarchives'];
    $id = decode($get_decode, secret_key());

    $sql = "SELECT * FROM archives WHERE archives_id ='$id'";
    $query = $conn->query($sql);
    $row = $query->fetch_assoc();

    if (!$row) {
        $_SESSION['error'] = "ไม่พบหน้าดังกล่าว!";
        echo "<script> window.history.back()</script>";
        exit;
    }
    
}

if(isset($_POST['action'])){
    if ($_POST['action'] == 'edit_archives') {

        date_default_timezone_set('Asia/Bangkok');
        $date = date("Y-m-d H:i:s");
        $namedate = date('YmdHis');
        global $conn;
        
        $id= mysqli_real_escape_string($conn,trim($_POST['archives_id']));
        $input_title= mysqli_real_escape_string($conn,trim($_POST['input_title']));
        $uid = $_SESSION['id'];

        $query = "UPDATE archives SET archives_title='$input_title', archives_update='$date', archives_uid='$uid' WHERE archives_id ='$id'";
    
        if ($conn->query($query)) {
            
            if (!empty($_FILES["input_file"]["name"])) {
        
                $targetDir = "uploadfile/archivesfile/";
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
                            
                            unlink("uploadfile/archivesfile/$oldfile");
                            $_SESSION['success'] = "บันทึกหนังสือสำคัญสำเร็จ!";
                            echo "<script> window.location.href='?page=archives';</script>";
                            exit;
                            
                        } else {
                            
                            unlink("ploadfile/archivesfile/$fileName");
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
            
        } else {
            
            $_SESSION['success'] = "บันทึกหนังสือสำคัญสำเร็จ!";
            echo "<script> window.location.href='?page=archives';</script>";
            exit;
            
        }   
    }
}

?>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index">หน้าหลัก</a></li>
        <li class="breadcrumb-item"><a href="?page=archives">เอกสารสำคัญ</a></li>
        <li class="breadcrumb-item active" aria-current="page">แก้ไขข้อมูลเอกสารสำคัญ</li>
    </ol>
</nav>
<hr>
<div class="container bg-secondary-addpay rounded-5">
    <div class="main-body py-md-5 px-md-1 text-white">
        <div id="" class="container p-3 p-md-5">
            <div class="p-4 p-md-5 bg-white rounded-5 shadow-lg">
                <div class="text-center text-md-start text-dark my-3">
                    <h3>แก้ไขข้อมูลเอกสารสำคัญ</h3>
                </div>
                <form action="?page=archives_edit" method="post" class="" enctype="multipart/form-data">
                    <div class="row align-items-center text-dark px-md-5 mb-3">
                        <div class="col-md-3">
                            <h6 for="input_title" class="col-form-label">ชื่อเอกสาร </h6>
                        </div>
                        <div class="col-md-9">
                            <input type="text" id="input_title" name="input_title" class="form-control " required
                                value="<?= $row['archives_title']?>">
                        </div>
                    </div>
                    <div class=" row align-items-center text-dark px-md-5 mb-3">
                        <div class="col-md-3 ">
                            <h6 for="input_file" class="col-form-label">เพิ่มไฟล์ </h6>
                        </div>

                        <div class="col-md-9">
                            <input type="file" id="input_file" name="input_file" class="form-control " required>
                        </div>
                    </div>

                    <!-- Submit button -->
                    <div class="row mt-5">
                        <div class="col-md-12">
                            <div class="d-flex justify-content-end">
                                <button type="reset" class="btn bg-secondary-addpay text-white me-3"><i
                                        class="fa-solid fa-arrow-rotate-left"></i> ล้างข้อมูล</button>
                                <button type="submit" name="action" value="edit_archives"
                                    class=" btn btn-addpay text-white">บันทึกการแก้ไข<i
                                        class="fa-solid fa-cloud-arrow-up"></i></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php  $conn->close();?>