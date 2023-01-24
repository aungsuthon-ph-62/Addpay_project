<?php

if(isset($_POST['action'])){
    if ($_POST['action'] == 'create_expenses') {
        
        date_default_timezone_set('Asia/Bangkok');
        $date = date("Y-m-d H:i:s");
        $namedate = date('YmdHis');
        global $conn;
        
        $inputType= mysqli_real_escape_string($conn,trim($_POST['inputType']));
        $inputDate= mysqli_real_escape_string($conn,trim($_POST['inputDate']));
        $inputList= mysqli_real_escape_string($conn,trim($_POST['inputList']));
        $inputAmount= mysqli_real_escape_string($conn,trim($_POST['inputAmount']));
        $uid = $_SESSION['id'];

        if (!empty($_FILES["inputFile"]["name"])) {
        
            $targetDir = "uploadfile/expensesfile/";
            $temp = explode(".", $_FILES["inputFile"]["name"]);
            $fileName = 'expenses-'.$namedate. '.' . end($temp); //ตั้งชื่อไฟล์
            $targetFilePath = $targetDir . $fileName;
            $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
            $allowTypes = array('jpg', 'png', 'jpeg', 'pdf', 'word', 'txt', 'doc', 'docx', 'ppt', 'pptx','PDF');
        
            if (in_array($fileType, $allowTypes)) {
                
                if (move_uploaded_file($_FILES["inputFile"]["tmp_name"], $targetFilePath)) {

                    $query = "INSERT INTO expenses (expenses_type, expenses_date, expenses_list, expenses_price, expenses_file, expenses_create, expenses_uid)
                    VALUES ('$inputType', '$inputDate', '$inputList', '$inputAmount', '$fileName', '$date', '$uid')";

                    if ($conn->query($query)) {
                        
                        $_SESSION['success'] = "บันทึกข้อมูลใบสำคัญจ่ายสำเร็จ!";
                        echo "<script> window.location.href='?page=expenses';</script>";
                        exit;
                        
                    } else {
                       
                        unlink("uploadfile/expensesfile/$fileName");
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
        <li class="breadcrumb-item"><a href="?page=expenses">ใบสำคัญจ่าย</a></li>
        <li class="breadcrumb-item active" aria-current="page">เพิ่มข้อมูลใบสำคัญจ่าย</li>
    </ol>
</nav>
<hr>

<div class="container bg-secondary-addpay rounded-5">
    <div class="main-body py-md-5 px-md-1 text-white">
        <div id="" class="container p-3 p-md-5">
            <div class="p-4 p-md-5 bg-white rounded-5 shadow-lg">
                <div class="text-center text-md-start text-dark my-3">
                    <h3>เพิ่มข้อมูลใบสำคัญจ่าย</h3>
                </div>
                <form action="?page=expenses_add" method="post" class="" enctype="multipart/form-data">
                    <div class="row align-items-center text-dark px-md-5 mb-3">
                        <div class="col-md-3 ">
                            <label for="inputType" class="col-form-label">เลือกประเภท </label>
                        </div>
                        <div class="col-md-9">
                            <select class="form-select" id="inputType" name="inputType" required>
                                <option value="">--ประเภท--</option>
                                <option value="ประจำ">ประจำ</option>
                                <option value="ไม่ประจำ">ไม่ประจำ</option>
                            </select>
                        </div>
                    </div>
                    <div class="row align-items-center text-dark px-md-5 mb-3">
                        <div class="col-md-3">
                            <label for="inputDate" class="col-form-label">วันที่จ่าย </label>
                        </div>
                        <div class="col-md-9">
                            <input type="date" id="inputDate" name="inputDate" class="form-control " required>
                        </div>
                    </div>
                    <div class="row align-items-center text-dark px-md-5 mb-3">
                        <div class="col-md-3">
                            <label for="inputList" class="col-form-label">รายการ </label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" id="inputList" name="inputList" class="form-control " required>
                        </div>
                    </div>
                    <div class="row align-items-center text-dark px-md-5 mb-3">
                        <div class="col-md-3">
                            <label for="inputAmount" class="col-form-label">จำนวนเงิน </label>
                        </div>
                        <div class="col-md-9">
                            <input type="number" id="inputAmount" name="inputAmount" class="form-control " step="any" required>
                        </div>
                    </div>

                    <div class="row align-items-center text-dark px-md-5 mb-3">
                        <div class="col-md-3 ">
                            <label for="inputFile" class="col-form-label">เพิ่มไฟล์ </label>
                        </div>

                        <div class="col-md-9">
                            <input type="file" id="inputFile" name="inputFile" class="form-control " required>
                        </div>
                    </div>

                    <!-- Submit button -->
                    <div class="row mt-5">
                        <div class="col-md-12">
                            <div class="d-flex justify-content-end">
                                <button type="reset" class="btn bg-secondary-addpay text-white me-3"><i
                                        class="fa-solid fa-arrow-rotate-left"></i> ล้างข้อมูล</button>
                                <button type="submit" name="action" value="create_expenses"
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