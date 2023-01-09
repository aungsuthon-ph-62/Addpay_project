<?php

if(isset($_POST['action'])){
    if ($_POST['action'] == 'create_contract') {
        
        date_default_timezone_set('Asia/Bangkok');
        $date = date("Y-m-d H:i:s");
        $namedate = date('YmdHis');
        global $conn;
        
        $input_lgdeld= mysqli_real_escape_string($conn,trim($_POST['input_lgdeld']));
        $input_lgexpd= mysqli_real_escape_string($conn,trim($_POST['input_lgexpd']));
        $input_comp= mysqli_real_escape_string($conn,trim($_POST['input_comp']));
        $input_title= mysqli_real_escape_string($conn,trim($_POST['input_title']));
        $input_ann= mysqli_real_escape_string($conn,trim($_POST['input_ann']));
        $uid = $_SESSION['id'];

        
            
        if (!empty($_FILES["input_file"]["name"]) && !empty($_FILES["input_filesigner"]["name"])) {
        
            $targetDir = "uploadfile/contractfile/";
            
            $temp1 = explode(".", $_FILES["input_file"]["name"]);
            $fileName1 = 'contract-'.$namedate. '.' . end($temp1);
            $targetFilePath1 = $targetDir . $fileName1;
            $fileType1 = strtolower(pathinfo($targetFilePath1, PATHINFO_EXTENSION));

            $temp2 = explode(".", $_FILES["input_filesigner"]["name"]);
            $fileName2 = 'filesigner-'.$namedate. '.' . end($temp2);
            $targetFilePath2 = $targetDir . $fileName2;
            $fileType2 = strtolower(pathinfo($targetFilePath2, PATHINFO_EXTENSION));
            
            $allowTypes = array('jpg', 'png', 'jpeg', 'pdf', 'word', 'txt', 'doc', 'docx', 'ppt', 'pptx','PDF');
        
            if (in_array($fileType1, $allowTypes) && in_array($fileType2, $allowTypes)) {
                
                if (move_uploaded_file($_FILES["input_file"]["tmp_name"], $targetFilePath1) 
                && move_uploaded_file($_FILES["input_filesigner"]["tmp_name"], $targetFilePath2)) {

                    $query = "INSERT INTO contract (contract_lgdeld, contract_lgexpd, contract_comp, contract_title, contract_file, contract_filesigner, contract_ann, contract_create, contract_uid)
                    VALUES ('$input_lgdeld', '$input_lgexpd', '$input_comp', '$input_title', '$fileName1', '$fileName2', '$input_ann', '$date', '$uid')";

                    if ($conn->query($query)) {
                        
                        $_SESSION['success'] = "บันทึกเอกสารสัญญาสำเร็จ!";
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
        $conn->close();        
    }
}

?>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index">หน้าหลัก</a></li>
        <li class="breadcrumb-item"><a href="?page=contract">เอกสารสัญญา</a></li>
        <li class="breadcrumb-item active" aria-current="page">เพิ่มข้อมูลเอกสารสัญญา</li>
    </ol>
</nav>
<hr>
<div class="container bg-secondary-addpay rounded-5">
    <div class="main-body py-md-5 px-md-1 text-white">
        <div id="" class="container p-3 p-md-5">
            <div class="p-4 p-md-5 bg-white rounded-5 shadow-lg">
                <div class="text-center text-md-start text-dark my-3">
                    <h3>เพิ่มข้อมูลเอกสารสัญญา</h3>
                </div>
                <form action="?page=contract_add" method="post" class="" enctype="multipart/form-data">
                    <div class="row align-items-center text-dark px-md-5 mb-3">
                        <div class="col-md-3">
                            <label for="input_lgdeld" class="col-form-label">วันที่ส่ง LG</label>
                        </div>
                        <div class="col-md-3">
                            <input type="date" id="input_lgdeld" name="input_lgdeld" class="form-control " required>
                        </div>
                    </div>
                    <div class="row align-items-center text-dark px-md-5 mb-3">
                        <div class="col-md-3">
                            <label for="input_lgexpd" class="col-form-label">วันหมดอายุ LG</label>
                        </div>
                        <div class="col-md-3">
                            <input type="date" id="input_lgexpd" name="input_lgexpd" class="form-control " required>
                        </div>
                    </div>
                    <div class="row align-items-center text-dark px-md-5 mb-3">
                        <div class="col-md-3">
                            <label for="input_comp" class="col-form-label">ชื่อบริษัท</label>
                        </div>
                        <div class="col-md-6">
                            <input type="text" id="input_comp" name="input_comp" class="form-control " required>
                        </div>
                    </div>
                    <div class="row align-items-center text-dark px-md-5 mb-3">
                        <div class="col-md-3">
                            <label for="input_title" class="col-form-label">ชื่อสัญญา </label>
                        </div>
                        <div class="col-md-6">
                            <input type="text" id="input_title" name="input_title" class="form-control " required>
                        </div>
                    </div>
                    <div class="row align-items-center text-dark px-md-5 mb-3">
                        <div class="col-md-3">
                            <label for="input_file" class="col-form-label">ไฟล์สัญญา</label>
                        </div>
                        <div class="col-md-6">
                            <input type="file" id="input_file" name="input_file" class=" form-control " required>
                        </div>
                    </div>
                    <div class=" row align-items-center text-dark px-md-5 mb-3">
                        <div class="col-md-3 ">
                            <label for="input_filesigner" class="col-form-label">ไฟล์เอกสารผู้เซ็นสัญญา</label>
                        </div>
                        <div class="col-md-6">
                            <input type="file" id="input_filesigner" name="input_filesigner" class="form-control "
                                required>
                        </div>
                    </div>
                    <div class="row align-items-center text-dark px-md-5 mb-3">
                        <div class="col-md-3 ">
                            <label for="input_ann" class="col-form-label">วันประกาศผล</label>
                        </div>

                        <div class="col-md-3">
                            <input type="date" id="input_ann" name="input_ann" class="form-control " required>
                        </div>
                    </div>
                    <!-- Submit button -->
                    <div class="row mt-5">
                        <div class="col-md-12">
                            <div class="d-flex justify-content-end">
                                <button type="reset" class="btn bg-secondary-addpay text-white me-3"><i
                                        class="fa-solid fa-arrow-rotate-left"></i> ล้างข้อมูล</button>
                                <button type="submit" name="action" value="create_contract"
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