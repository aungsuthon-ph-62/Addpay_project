<?php
session_start();
include("../../layout/head.php");
require_once("../../php/conn.php");
// $uid = $_SESSION['id'];

if (isset($_POST['action'])) {
    if ($_POST['action'] == 'create_quoin') {

        date_default_timezone_set('Asia/Bangkok');
        $date = date("Y-m-d H:i:s");
        global $conn;

        $input_quoin_no = mysqli_real_escape_string($conn, trim($_POST['input_quoin_no']));
        $input_quoin_date = mysqli_real_escape_string($conn, trim($_POST['input_quoin_date']));
        $input_quoin_name = mysqli_real_escape_string($conn, trim($_POST['input_quoin_name']));
        $input_quoin_address = mysqli_real_escape_string($conn, trim($_POST['input_quoin_address']));
        $input_quoin_numtax = mysqli_real_escape_string($conn, trim($_POST['input_quoin_numtax']));
        $input_quoin_sum = mysqli_real_escape_string($conn, trim($_POST['input_quoin_sum']));
        $input_quoin_specialdis = mysqli_real_escape_string($conn, trim($_POST['input_quoin_specialdis']));
        $input_quoin_afterdis = mysqli_real_escape_string($conn, trim($_POST['input_quoin_afterdis']));
        $input_quoin_vat = mysqli_real_escape_string($conn, trim($_POST['input_quoin_vat']));
        $input_quoin_deli = mysqli_real_escape_string($conn, trim($_POST['input_quoin_deli']));
        $input_quoin_total = mysqli_real_escape_string($conn, trim($_POST['input_quoin_total']));
        $uid = 1;

        $quoin_no_check_query = "SELECT * FROM quotation_in WHERE quoin_no =  '$input_quoin_no'";
        $query = $conn->query($quoin_no_check_query);
        $check = $query->fetch_assoc();

        if ($check) {
            $_SESSION['error'] = "เลขที่ใบเสนอราคานี้มีในระบบแล้ว!";
            header("Location: quotation_in_add.php");
            exit;
        } else {
            $query = "INSERT INTO quotation_in (quoin_no, quoin_date, quoin_name, quoin_address, quoin_numtax, quoin_sum, quoin_specialdis, quoin_afterdis, quoin_vat, quoin_deli, quoin_total, quoin_create, quoin_uid)
                VALUES ('$input_quoin_no', '$input_quoin_date', '$input_quoin_name', '$input_quoin_address', '$input_quoin_numtax', '$input_quoin_sum', '$input_quoin_specialdis', '$input_quoin_afterdis', '$input_quoin_vat', '$input_quoin_deli', '$input_quoin_total', '$date', '$uid')";

            if ($conn->query($query) === TRUE) {
                $_SESSION['success'] = "บันทึกสำเร็จ!";
                header("Location: quotation_in_list.php");
                exit;
            } else {
                echo "Error: " . $query . "<br>" . $conn->error;
                $_SESSION['error'] = "เกิดข้อผิดพลาด! กรุณาลองอีกครั้ง";
                header("Location: quotation_in_add.php");
                exit;
            }
        }
        $conn->close();
    }
}

?>
<style>
    body {
        font-family: "Kanit", sans-serif;
        font-family: "Noto Sans", sans-serif;
        font-family: "Noto Sans Thai", sans-serif;
        font-family: "Poppins", sans-serif;
        font-family: "Prompt", sans-serif;
    }

    table {
        counter-reset: rowNumber;
    }

    table tr:not(:first-child) {
        counter-increment: rowNumber;
    }

    table tr td:first-child::before {
        content: counter(rowNumber);
        min-width: 1em;
        margin-right: 0.5em;
    }
</style>

<body>
    <?php require("../alert.php"); ?>
    <div class="container-fluid">
        <nav aria-label="breadcrumb" class="main-breadcrumb mt-2">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="../dashboard/quotation_in_list.php">ใบเสนอราคาเข้า</a></li>
                <li class="breadcrumb-item active" aria-current="page">สร้างใบเสนอราคาเข้า</li>
            </ol>
        </nav>
        <hr>
        <div>
            <h3>ข้อมูลใบเสนอราคา quotation</h3>
        </div>
        <form method="post" id="quoin_form" action="quotation_in_add.php" class="px-md-5 py-md-5">
            <div class="row g-3 align-items-center mb-3">
                <div class="col-md-3">
                    <label for="input_quoin_no" class="col-form-label">เลขที่ในใบเสนอราคา No.</label>
                </div>
                <div class="col-auto">
                    <input type="number" id="input_quoin_no" name="input_quoin_no" class="form-control " required>
                </div>
            </div>
            <div class="row g-3 align-items-center mb-3">
                <div class="col-md-3">
                    <label for="input_quoin_date" class="col-form-label">วันที่ในใบเสนอราคา date.</label>
                </div>
                <div class="col-auto">
                    <input type="date" id="input_quoin_date" name="input_quoin_date" class="form-control " required>
                </div>
            </div>
            <div class="row g-3 align-items-center mb-3">
                <div class="col-md-3">
                    <label for="input_quoin_name" class="col-form-label">ชื่อบริษัทที่ออกใบเสนอราคา :</label>
                </div>
                <div class="col-md-8">
                    <input type="text" id="input_quoin_name" name="input_quoin_name" class="form-control " required>
                </div>
            </div>

            <div class="row g-3 mb-3">
                <div class="col-md-3 ">
                    <label for="input_quoin_address" class="col-form-label">อัพโหลดไฟล์ :</label>
                </div>
                <div class="col-md-8">
                    <input class="form-control" type="file" id="formFile">
                </div>
            </div>
            <div class="row g-3 align-items-center mb-3">
                <div class="col-md-3 ">
                    <label for="input_quoin_numtax" class="col-form-label">สถานะ :</label>
                </div>

                <div class="col-md-8">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                        <label class="form-check-label" for="inlineRadio1">1</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                        <label class="form-check-label" for="inlineRadio2">2</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                        <label class="form-check-label" for="inlineRadio2">2</label>
                    </div>
                </div>
            </div>


            <div class="mx-auto d-flex justify-content-end">
                <button type="reset" class="col-md-3 btn btn-inline-danger btn btn-inline-success p-2 mt-2 rounded-pill fs-5 fw-bold"><i class="fa-solid fa-eraser"></i> ล้างข้อมูล</button>
                <button type="submit" name="action" value="create_quoin" class="ms-3 col-md-3 btn btn-inline-success p-2 mt-2 rounded-pill fs-5 fw-bold">บันทึก
                    <i class="fa-solid fa-angles-right"></i></button>
                <input type="hidden" name="total_item" id="total_item" value="1" />
            </div>

        </form>

    </div>
</body>