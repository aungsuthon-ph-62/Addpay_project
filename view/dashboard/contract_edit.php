<?php
if (isset($_GET['editcontract'])) {
    
    $get_decode = $_GET['editcontract'];
    $id = decode($get_decode, secret_key());

    $sql = "SELECT * FROM contract WHERE contract_id ='$id'";
    $query = $conn->query($sql);
    $row = $query->fetch_assoc();
    
    if (!$row) {
        $_SESSION['error'] = "ไม่พบหน้าดังกล่าว!";
        echo "<script> window.history.back()</script>";
        exit;
    }
}

if(isset($_POST['action'])){
    if ($_POST['action'] == 'edit_contract') {
        
        date_default_timezone_set('Asia/Bangkok');
        $date = date("Y-m-d H:i:s");
        global $conn;
        
        $id= mysqli_real_escape_string($conn,trim($_POST['contract_id']));
        $input_lgdeld= mysqli_real_escape_string($conn,trim($_POST['input_lgdeld']));
        $input_lgexpd= mysqli_real_escape_string($conn,trim($_POST['input_lgexpd']));
        $input_comp= mysqli_real_escape_string($conn,trim($_POST['input_comp']));
        $input_title= mysqli_real_escape_string($conn,trim($_POST['input_title']));
        $input_ann= mysqli_real_escape_string($conn,trim($_POST['input_ann']));
        $uid = $_SESSION['id'];

        $query = "UPDATE contract SET contract_lgdeld='$input_lgdeld', contract_lgexpd='$input_lgexpd', contract_comp='$input_comp',
                    contract_title='$input_title', contract_ann='$input_ann', contract_update='$date', contract_uid='$uid'";
            
        if ($conn->query($query)) {
            
            if (!empty($_FILES["input_file"]["name"]) && !empty($_FILES["input_filesigner"]["name"])) {

                filecase1();
                exit;
            
            }elseif(!empty($_FILES["input_file"]["name"])){

                filecase2();
                exit; 
                
            }elseif(!empty($_FILES["input_filesigner"]["name"])){

                filecase3();
                exit;
                
            }else{
                
                $_SESSION['success'] = "แก้ไขเอกสารสัญญาสำเร็จ!";
                echo "<script> window.location.href='?page=contract';</script>";
                exit;
                        
            }
        } else {
            
            $_SESSION['error'] = "เกิดข้อผิดพลาด! กรุณาลองอีกครั้ง";
            echo "<script> window.history.back()</script>";
            exit;
            
        }

    }
}

function filecase1(){
    
    date_default_timezone_set('Asia/Bangkok');
    $namedate = date('YmdHis');
    global $conn;
    
    $id= mysqli_real_escape_string($conn,trim($_POST['contract_id']));

    $targetDir = "uploadfile/contractfile/";
    $allowTypes = array('jpg', 'png', 'jpeg', 'pdf', 'word', 'txt', 'doc', 'docx', 'ppt', 'pptx','PDF');

    $temp1 = explode(".", $_FILES["input_file"]["name"]);
    $fileName1 = 'contract-'.$namedate. '.' . end($temp1);
    $targetFilePath1 = $targetDir . $fileName1;
    $fileType1 = strtolower(pathinfo($targetFilePath1, PATHINFO_EXTENSION));

    $temp2 = explode(".", $_FILES["input_filesigner"]["name"]);
    $fileName2 = 'filesigner-'.$namedate. '.' . end($temp2);
    $targetFilePath2 = $targetDir . $fileName2;
    $fileType2 = strtolower(pathinfo($targetFilePath2, PATHINFO_EXTENSION));

    if (in_array($fileType1, $allowTypes) && in_array($fileType2, $allowTypes)) {
    
        $sql = "SELECT * FROM contract WHERE contract_id = '$id'";
        $query = $conn->query($sql);
        $row = $query->fetch_assoc();
        $oldfile1 = $row['contract_file'];
        $oldfile2 = $row['contract_filesigner'];

        if (move_uploaded_file($_FILES["input_file"]["tmp_name"], $targetFilePath1) 
        && move_uploaded_file($_FILES["input_filesigner"]["tmp_name"], $targetFilePath2)) {

            $query = "UPDATE contract SET contract_file='$fileName1', contract_filesigner='$fileName2' WHERE contract_id ='$id'";

            if ($conn->query($query)) {
                
                unlink("uploadfile/contractfile/$oldfile1");
                unlink("uploadfile/contractfile/$oldfile2");
                $_SESSION['success'] = "แก้ไขเอกสารสัญญาสำเร็จ!";
                echo "<script> window.location.href='?page=contract';</script>";
                exit;
                
            } else {
                
                unlink("uploadfile/contractfile/$fileName1");
                unlink("uploadfile/contractfile/$fileName2");
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

function filecase2(){
    
    date_default_timezone_set('Asia/Bangkok');
    $namedate = date('YmdHis');
    global $conn;

    $id= mysqli_real_escape_string($conn,trim($_POST['contract_id']));

    $targetDir = "uploadfile/contractfile/";
    $allowTypes = array('jpg', 'png', 'jpeg', 'pdf', 'word', 'txt', 'doc', 'docx', 'ppt', 'pptx','PDF');
    
    $temp = explode(".", $_FILES["input_file"]["name"]);
    $fileName = 'contract-'.$namedate. '.' . end($temp);
    $targetFilePath = $targetDir . $fileName;
    $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

    if(in_array($fileType, $allowTypes)){

        $sql = "SELECT contract_file FROM contract WHERE contract_id = '$id'";
        $query = $conn->query($sql);
        $row = $query->fetch_assoc();
        $oldfile = $row['contract_file'];

        if(move_uploaded_file($_FILES["input_file"]["tmp_name"], $targetFilePath)){

            $query = "UPDATE contract SET contract_file='$fileName' WHERE contract_id ='$id'";
            
            if ($conn->query($query)) {
                
                unlink("uploadfile/contractfile/$oldfile");
                $_SESSION['success'] = "แก้ไขเอกสารสัญญาสำเร็จ!";
                echo "<script> window.location.href='?page=contract';</script>";
                exit;
                
            } else {
                
                unlink("uploadfile/contractfile/$fileName");
                $_SESSION['error'] = "เกิดข้อผิดพลาด! กรุณาลองอีกครั้ง";
                echo "<script> window.history.back()</script>";
                exit;
                
            }
        }else {
            
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

function filecase3(){

    date_default_timezone_set('Asia/Bangkok');
    $namedate = date('YmdHis');
    global $conn;

    $id= mysqli_real_escape_string($conn,trim($_POST['contract_id']));

    $targetDir = "uploadfile/contractfile/";
    $allowTypes = array('jpg', 'png', 'jpeg', 'pdf', 'word', 'txt', 'doc', 'docx', 'ppt', 'pptx','PDF');
    
    $temp = explode(".", $_FILES["input_filesigner"]["name"]);
    $fileName = 'filesigner-'.$namedate. '.' . end($temp);
    $targetFilePath = $targetDir . $fileName;
    $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

    if(in_array($fileType, $allowTypes)){

        $sql = "SELECT contract_filesigner FROM contract WHERE contract_id = '$id'";
        $query = $conn->query($sql);
        $row = $query->fetch_assoc();
        $oldfile = $row['contract_filesigner'];

        if(move_uploaded_file($_FILES["input_filesigner"]["tmp_name"], $targetFilePath)){

            $query = "UPDATE contract SET contract_filesigner='$fileName' WHERE contract_id ='$id'";
            
            if ($conn->query($query)) {
                
                unlink("uploadfile/contractfile/$oldfile");
                $_SESSION['success'] = "แก้ไขเอกสารสัญญาสำเร็จ!";
                echo "<script> window.location.href='?page=contract';</script>";
                exit;
                
            } else {
                
                unlink("uploadfile/contractfile/$fileName");
                $_SESSION['error'] = "เกิดข้อผิดพลาด! กรุณาลองอีกครั้ง";
                echo "<script> window.history.back()</script>";
                exit;
                
            }
        }else {
            
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

?>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index">หน้าหลัก</a></li>
        <li class="breadcrumb-item"><a href="?page=contract">เอกสารสัญญา</a></li>
        <li class="breadcrumb-item active" aria-current="page">แก้ไขข้อมูลเอกสารสัญญา</li>
    </ol>
</nav>
<hr>
<div class="container bg-secondary-addpay rounded-5">
    <div class="main-body py-md-5 px-md-1 text-white">
        <div id="" class="container p-3 p-md-5">
            <div class="p-4 p-md-5 bg-white rounded-5 shadow-lg">
                <div class="text-center text-md-start text-dark my-3">
                    <h3>แก้ไขข้อมูลเอกสารสัญญา</h3>
                </div>
                <form action="?page=contract_edit&editcontract=<?php echo encode($row['contract_id'], secret_key()); ?>"
                    method="post" class="" enctype="multipart/form-data">
                    <div class="row align-items-center text-dark px-md-5 mb-3">
                        <div class="col-md-3">
                            <label for="input_lgdeld" class="col-form-label">วันที่ส่ง LG</label>
                        </div>
                        <div class="col-md-3">
                            <input type="date" id="input_lgdeld" name="input_lgdeld" class="form-control " required
                                value="<?= $row['contract_lgdeld'] ?>">
                        </div>
                    </div>
                    <div class="row align-items-center text-dark px-md-5 mb-3">
                        <div class="col-md-3">
                            <label for="input_lgexpd" class="col-form-label">วันหมดอายุ LG</label>
                        </div>
                        <div class="col-md-3">
                            <input type="date" id="input_lgexpd" name="input_lgexpd" class="form-control " required
                                value="<?= $row['contract_lgexpd'] ?>">
                        </div>
                    </div>
                    <div class="row align-items-center text-dark px-md-5 mb-3">
                        <div class="col-md-3">
                            <label for="input_comp" class="col-form-label">ชื่อบริษัท</label>
                        </div>
                        <div class="col-md-6">
                            <input type="text" id="input_comp" name="input_comp" class="form-control " required
                                value="<?= $row['contract_comp'] ?>">
                        </div>
                    </div>
                    <div class="row align-items-center text-dark px-md-5 mb-3">
                        <div class="col-md-3">
                            <label for="input_title" class="col-form-label">ชื่อสัญญา </label>
                        </div>
                        <div class="col-md-6">
                            <input type="text" id="input_title" name="input_title" class="form-control " required
                                value="<?= $row['contract_title'] ?>">
                        </div>
                    </div>
                    <div class="row align-items-center text-dark px-md-5 mb-3">
                        <div class="col-md-3">
                            <label for="input_file" class="col-form-label">ไฟล์สัญญา</label>
                        </div>
                        <div class="col-md-6">
                            <input type="file" id="input_file" name="input_file" class=" form-control ">
                        </div>
                    </div>
                    <div class=" row align-items-center text-dark px-md-5 mb-3">
                        <div class="col-md-3 ">
                            <label for="input_filesigner" class="col-form-label">ไฟล์เอกสารผู้เซ็นสัญญา</label>
                        </div>
                        <div class="col-md-6">
                            <input type="file" id="input_filesigner" name="input_filesigner" class="form-control ">
                        </div>
                    </div>
                    <div class="row align-items-center text-dark px-md-5 mb-3">
                        <div class="col-md-3 ">
                            <label for="input_ann" class="col-form-label">วันประกาศผล</label>
                        </div>

                        <div class="col-md-3">
                            <input type="date" id="input_ann" name="input_ann" class="form-control " required
                                value="<?= $row['contract_ann'] ?>">
                        </div>
                    </div>
                    <!-- Submit button -->
                    <div class="row mt-5">
                        <div class="col-md-12">
                            <div class="d-flex justify-content-end">
                                <button type="reset" class="btn bg-secondary-addpay text-white me-3"><i
                                        class="fa-solid fa-arrow-rotate-left"></i> ล้างข้อมูล</button>
                                <button type="submit" name="action" value="edit_contract"
                                    class=" btn btn-addpay text-white">บันทึกการแก้ไข<i
                                        class="fa-solid fa-cloud-arrow-up"></i></button>
                                <input type="hidden" name="contract_id" id="contract_id"
                                    value="<?= $row['contract_id'];?>" />
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php  $conn->close();?>