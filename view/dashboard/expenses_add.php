<?php
session_start();
include("../../layout/head.php");
require_once("../../php/conn.php");

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
        $inputFile= mysqli_real_escape_string($conn,trim($_POST['inputFile']));
        $uid = 1;

        $no_check_query = "SELECT * FROM expenses WHERE expenses_date = '$inputDate' && expenses_list = '$inputList';";
        $query = $conn->query($no_check_query);
        $check = $query->fetch_assoc();
    
        if ($check) {
            
            $_SESSION['error'] = "รายการนี้มีในระบบแล้ว!";
            header("Location: expenses_add.php");
            exit;
            
        } else {
            
            if (!empty($_FILES["inputFile"]["name"])) {
            
                $targetDir = "../../uploadfile/expensesfile/";
                // $fileName = basename($_FILES["inputFile"]["name"]);
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
                            header("Location: expenses_list.php");
                            exit;
                            
                        } else {
                            
                            $_SESSION['error'] = "เกิดข้อผิดพลาด! กรุณาลองอีกครั้ง";
                            header("Location: expenses_add.php");
                            exit;
                            
                        }
                    } else {
                        
                        $_SESSION['error'] = "เกิดข้อผิดพลาด! อัพโหลดไฟล์ไม่สำเร็จ!";
                        header("Location: expenses_add.php");
                        exit;
                        
                    }
                    
                } else {
                    
                    $_SESSION['error'] = "เกิดข้อผิดพลาด! ไม่รองรับนามสกุลไฟล์ชนิดนี้!";
                    header("Location: expenses_add.php");
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

<div class="container py-5">
    <div class="main-body">
        <nav aria-label="breadcrumb" class="main-breadcrumb mt-2">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="../dashboard.php">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="../dashboard/expenses_list.php">ใบสำคัญจ่าย</a></li>
                <li class="breadcrumb-item active" aria-current="page">เพิ่มข้อมูลใบสำคัญจ่าย</li>
            </ol>
        </nav>
        <hr>

        <div id="paperquotation" class="container pb-md-0 mb-5">
            <div>
                <h3>เพิ่มข้อมูลใบสำคัญจ่าย</h3>
            </div>
            <div class=" px-md-5 py-md-4 justify-content-center">
                <div class="p-2 py-md-4 px-md-5 border rounded-3">
                    <!-- modal form -->
                    <form action="expenses_add.php" method="post" class="" enctype="multipart/form-data">
                        <div class="row g-3 mb-3">
                            <div class="col-md-3 ">
                                <label for="inputType" class="col-form-label">เลือกประเภท </label>
                            </div>
                            <div class="col-md-9">
                                <select class="form-select" id="inputType" name="inputType">
                                    <option selected disabled>--ประเภท--</option>
                                    <option value="ประจำ">ประจำ</option>
                                    <option value="ไม่ประจำ">ไม่ประจำ</option>
                                </select>
                            </div>
                        </div>
                        <div class="row g-3 align-items-center mb-3">
                            <div class="col-md-3">
                                <label for="inputDate" class="col-form-label">วันที่จ่าย </label>
                            </div>
                            <div class="col-md-9">
                                <input type="date" id="inputDate" name="inputDate"  class="form-control " required>
                            </div>
                        </div>
                        <div class="row g-3 align-items-center mb-3">
                            <div class="col-md-3">
                                <label for="inputList" class="col-form-label">รายการ </label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" id="inputList" name="inputList" class="form-control " required>
                            </div>
                        </div>
                        <div class="row g-3 align-items-center mb-3">
                            <div class="col-md-3">
                                <label for="inputAmount" class="col-form-label">จำนวนเงิน </label>
                            </div>
                            <div class="col-md-9">
                                <input type="number" id="inputAmount" name="inputAmount" class="form-control " required>
                            </div>
                        </div>

                        <div class="row g-3 align-items-center mb-3">
                            <div class="col-md-3 ">
                                <label for="inputFile" class="col-form-label">เพิ่มไฟล์ </label>
                            </div>

                            <div class="col-md-9">
                                <input type="file" id="inputFile" name="inputFile" class="form-control " required>
                            </div>
                        </div>

                        <!-- Submit button -->
                        <div class="mx-auto d-flex justify-content-end">
                            <button type="reset" class=" btn btn-outline-danger btn btn-outline-success px-2 mt-2 rounded-3 fw-bold"><i class="fa-solid fa-eraser"></i> ล้างข้อมูล</button>
                            <button type="submit" name="action" value="create_expenses" class="ms-3  btn btn-outline-success px-2 mt-2 rounded-3  fw-bold">บันทึก <i class="fa-solid fa-angles-right"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>