<?php
if (isset($_POST['action'])) {
    if ($_POST['action'] == 'create_quoin') {

        date_default_timezone_set('Asia/Bangkok');
        $date = date("Y-m-d H:i:s");
        $namedate = date('YmdHis');
        global $conn;

        $input_quoin_no = mysqli_real_escape_string($conn, trim($_POST['input_quoin_no']));
        $input_quoin_date = mysqli_real_escape_string($conn, trim($_POST['input_quoin_date']));
        $input_quoin_company = mysqli_real_escape_string($conn, trim($_POST['input_quoin_company']));
        $input_quoin_status = mysqli_real_escape_string($conn, trim($_POST['input_quoin_status']));
        $input_quoin_remark = mysqli_real_escape_string($conn, trim($_POST['input_quoin_remark']));
        $uid = 1;

        $quoin_no_check_query = "SELECT * FROM quotation_in WHERE quoin_no =  '$input_quoin_no'";
        $query = $conn->query($quoin_no_check_query);
        $check = $query->fetch_assoc();

        if ($check) {
            $_SESSION['error'] = "เลขที่ใบเสนอราคานี้มีในระบบแล้ว!";
            header("Location: quotation_in_add.php");
            exit;
        } else {

            if (!empty($_FILES["input_quoin_file"]["name"])) {

                $targetDir = "../../uploadfile/quotationinfile/";

                $temp = explode(".", $_FILES["input_quoin_file"]["name"]);
                $fileName = 'quotationin-' . $namedate . '.' . end($temp);
                $targetFilePath = $targetDir . $fileName;
                $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
                $allowTypes = array('jpg', 'png', 'jpeg', 'pdf', 'word', 'txt', 'doc', 'docx', 'ppt', 'pptx', 'PDF');

                if (in_array($fileType, $allowTypes)) {

                    if (move_uploaded_file($_FILES["input_quoin_file"]["tmp_name"], $targetFilePath)) {

                        $query = "INSERT INTO quotation_in (quoin_no, quoin_date, quoin_company, quoin_file, quoin_status, quoin_remark, quoin_create, quoin_uid)
                                    VALUES ('$input_quoin_no', '$input_quoin_date', '$input_quoin_company', '$fileName', '$input_quoin_status', '$input_quoin_remark', '$date', '$uid')";

                        if ($conn->query($query)) {

                            $_SESSION['success'] = "บันทึกหนังสือเข้าสำเร็จ!";
                            header("Location: quotation_in_list.php");
                            exit;
                        } else {

                            unlink("../../uploadfile/quotationinfile/$fileName");
                            $_SESSION['error'] = "เกิดข้อผิดพลาด! กรุณาลองอีกครั้ง";
                            header("Location: quotation_in_add.php");
                            exit;
                        }
                    } else {

                        $_SESSION['error'] = "เกิดข้อผิดพลาด! อัพโหลดไฟล์ไม่สำเร็จ!";
                        header("Location: quotation_in_add.php");
                        exit;
                    }
                } else {
                    $_SESSION['error'] = "เกิดข้อผิดพลาด! ไม่รองรับนามสกุลไฟล์ชนิดนี้!";
                    header("Location: quotation_in_add.php");
                    exit;
                }
            }
        }
        $conn->close();
    }
}

?>
<style>
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

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index">หน้าหลัก</a></li>
        <li class="breadcrumb-item"><a href="?page=quo_in">ใบเสนอราคาเข้า</a></li>
        <li class="breadcrumb-item active" aria-current="page">สร้างใบเสนอราคาเข้า</li>
    </ol>
</nav>
<hr>

<div class="container bg-secondary-addpay rounded-5">
    <div class="main-body py-md-5 px-md-1 text-white">
        <div id="paperquotation" class="container p-3 p-md-5">
            <div class="p-4 p-md-5 bg-white rounded-5 shadow-lg">
                <div class="text-center text-md-start text-dark my-3">
                    <h3>สร้างใบเสนอราคาเข้า</h3>
                </div>
                <form method="post" action="?page=quo_in_add" enctype="multipart/form-data" class="mt-md-5">
                    <div class="row align-items-center text-dark px-md-5 mb-3">
                        <div class="col-md-3 text-md-end">
                            <h6 class="col-form-label">เลขที่ในใบเสนอราคา No.</h6>
                        </div>
                        <div class="col-auto">
                            <input type="text" id="input_quoin_no" name="input_quoin_no" class="form-control " required>
                        </div>
                    </div>
                    <div class="row align-items-center text-dark px-md-5 mb-3">
                        <div class="col-md-3 text-md-end">
                            <h6 class="col-form-label">วันที่ในใบเสนอราคา date.</h6>
                        </div>
                        <div class="col-auto">
                            <input type="date" id="input_quoin_date" name="input_quoin_date" class="form-control " required>
                        </div>
                    </div>
                    <div class="row align-items-center text-dark px-md-5 mb-3">
                        <div class="col-md-3 text-md-end">
                            <h6 class="col-form-label">ชื่อบริษัทที่ออกใบเสนอราคา :</h6>
                        </div>
                        <div class="col-md-8">
                            <input type="text" id="input_quoin_company" name="input_quoin_company" class="form-control " required>
                        </div>
                    </div>

                    <div class="row align-items-center text-dark px-md-5 mb-3">
                        <div class="col-md-3 text-md-end">
                            <h6 class="col-form-label">อัพโหลดไฟล์ :</h6>
                        </div>
                        <div class="col-md-8">
                            <input class="form-control" type="file" id="input_quoin_file" name="input_quoin_file" required>
                        </div>
                    </div>
                    <div class="row align-items-center text-dark px-md-5 mb-3">
                        <div class="col-md-3 text-md-end">
                            <h6 class="col-form-label">สถานะ :</h6>
                        </div>

                        <div class="col-md-8">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="input_quoin_status" id="input_quoin_status0" value="อนุมัติ" required>
                                <label class="form-check-label" for="input_quoin_status0">อนุมัติ</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="input_quoin_status" id="input_quoin_status1" value="รออนุมัติ" required>
                                <label class="form-check-label" for="input_quoin_status1">รออนุมัติ</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="input_quoin_status" id="input_quoin_status2" value="ไม่อนุมัติ" required>
                                <label class="form-check-label" for="input_quoin_status2">ไม่อนุมัติ</label>
                            </div>
                        </div>
                    </div>
                    <div class="row align-items-center text-dark px-md-5 mb-3">
                        <div class="col-md-3 text-md-end">
                            <h6 class="col-form-label">หมายเหตุ :</h6>
                        </div>
                        <div class="col-md-8">
                            <input type="text" id="input_quoin_remark" name="input_quoin_remark" class="form-control ">
                        </div>
                    </div>

                    <div class="row mt-5">
                        <div class="col-md-12">
                            <div class="d-flex justify-content-end">
                                <button type="reset" class="btn bg-secondary-addpay text-white me-3"><i class="fa-solid fa-arrow-rotate-left"></i> ล้างข้อมูล</button>
                                <button type="submit" name="action" value="create_quoin" class="btn btn-addpay text-white">บันทึก <i class="fa-solid fa-cloud-arrow-up"></i></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>