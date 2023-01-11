<?php

if (isset($_GET['editexpenses'])) {

    $get_decode = $_GET['editexpenses'];
    $id = decode($get_decode, secret_key());

    $sql = "SELECT * FROM expenses WHERE expenses_id ='$id'";
    $query = $conn->query($sql);
    $row = $query->fetch_assoc();

    if (!$row) {
        $_SESSION['error'] = "ไม่พบหน้าดังกล่าว!";
        echo "<script> window.history.back()</script>";
        exit;
    }
}

if (isset($_POST['action'])) {
    if ($_POST['action'] == 'edit_expenses') {

        date_default_timezone_set('Asia/Bangkok');
        $date = date("Y-m-d H:i:s");
        $namedate = date('YmdHis');
        global $conn;

        $id = mysqli_real_escape_string($conn, trim($_POST['expenses_id']));
        $inputType = mysqli_real_escape_string($conn, trim($_POST['inputType']));
        $inputDate = mysqli_real_escape_string($conn, trim($_POST['inputDate']));
        $inputList = mysqli_real_escape_string($conn, trim($_POST['inputList']));
        $inputAmount = mysqli_real_escape_string($conn, trim($_POST['inputAmount']));
        $uid = $_SESSION['id'];

        $query = "UPDATE expenses SET expenses_type='$inputType', expenses_date='$inputDate', expenses_list='$inputList',
        expenses_price='$inputAmount',expenses_update='$date', expenses_uid='$uid' WHERE expenses_id ='$id'";

        if ($conn->query($query)) {

            if (!empty($_FILES["inputFile"]["name"])) {

                $targetDir = "uploadfile/expensesfile/";
                $temp = explode(".", $_FILES["inputFile"]["name"]);
                $fileName = 'expenses-' . $namedate . '.' . end($temp);
                $targetFilePath = $targetDir . $fileName;
                $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
                $allowTypes = array('jpg', 'png', 'jpeg', 'pdf', 'word', 'txt', 'doc', 'docx', 'ppt', 'pptx', 'PDF');

                if (in_array($fileType, $allowTypes)) {

                    $sql = "SELECT expenses_file FROM expenses WHERE expenses_id = '$id'";
                    $query = $conn->query($sql);
                    $row = $query->fetch_assoc();
                    $oldfile = $row['expenses_file'];

                    if (move_uploaded_file($_FILES["inputFile"]["tmp_name"], $targetFilePath)) {
    
                        $query = "UPDATE expenses SET expenses_file='$fileName' WHERE expenses_id ='$id'";
    
                        if ($conn->query($query)) {
    
                            unlink("uploadfile/expensesfile/$oldfile");
                            $_SESSION['success'] = "แก้ไขใบสำคัญจ่ายสำเร็จ!";
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
                    
                }else {

                    $_SESSION['error'] = "เกิดข้อผิดพลาด! ไม่รองรับนามสกุลไฟล์ชนิดนี้!";
                    echo "<script> window.history.back()</script>";
                    exit;
                }
                
            }else{
                
                $_SESSION['success'] = "แก้ไขใบสำคัญจ่ายสำเร็จ!";
                echo "<script> window.location.href='?page=expenses';</script>";
                exit;
                
            }
            
        } else {

            $_SESSION['error'] = "เกิดข้อผิดพลาด! กรุณาลองอีกครั้ง";
            echo "<script> window.history.back()</script>";
            exit;
        }
    }
}

?>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index">หน้าหลัก</a></li>
        <li class="breadcrumb-item"><a href="?page=expenses">ใบสำคัญจ่าย</a></li>
        <li class="breadcrumb-item active" aria-current="page">แก้ไขข้อมูลใบสำคัญจ่าย</li>
    </ol>
</nav>
<hr>
<div class="container bg-secondary-addpay rounded-5">
    <div class="main-body py-md-5 px-md-1 text-white">
        <div id="" class="container p-3 p-md-5">
            <div class="p-4 p-md-5 bg-white rounded-5 shadow-lg">
                <div class="text-center text-md-start text-dark my-3">
                    <h3>แก้ไขข้อมูลใบสำคัญจ่าย</h3>
                </div>
                <form action="?page=expenses_edit&editexpenses=<?php echo encode($row['expenses_id'], secret_key()); ?>"
                    method="post" class="" enctype="multipart/form-data">
                    <div class="row align-items-center text-dark px-md-5 mb-3">
                        <div class="col-md-3 ">
                            <label for="inputType" class="col-form-label">เลือกประเภท </label>
                        </div>
                        <div class="col-md-9">
                            <select class="form-select" id="inputType" name="inputType">
                                <option value="ประจำ" <?php if($row['expenses_type']=="ประจำ"): ?> selected="selected"
                                    <?php endif; ?>>ประจำ</option>
                                <option value="ไม่ประจำ" <?php if($row['expenses_type']=="ไม่ประจำ"): ?>
                                    selected="selected" <?php endif; ?>>ไม่ประจำ</option>
                            </select>
                        </div>
                    </div>
                    <div class="row align-items-center text-dark px-md-5 mb-3">
                        <div class="col-md-3">
                            <label for="inputDate" class="col-form-label">วันที่จ่าย </label>
                        </div>
                        <div class="col-md-9">
                            <input type="date" id="inputDate" name="inputDate" class="form-control " required
                                value="<?= $row['expenses_date'] ?>">
                        </div>
                    </div>
                    <div class="row align-items-center text-dark px-md-5 mb-3">
                        <div class="col-md-3">
                            <label for="inputList" class="col-form-label">รายการ </label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" id="inputList" name="inputList" class="form-control " required
                                value="<?= $row['expenses_list'] ?>">
                        </div>
                    </div>
                    <div class="row align-items-center text-dark px-md-5 mb-3">
                        <div class="col-md-3">
                            <label for="inputAmount" class="col-form-label">จำนวนเงิน </label>
                        </div>
                        <div class="col-md-9">
                            <input type="number" id="inputAmount" name="inputAmount" class="form-control " required
                                value="<?= $row['expenses_price'] ?>">
                        </div>
                    </div>
                    <div class="row align-items-center text-dark px-md-5 mb-3">
                        <div class="col-md-3 ">
                            <label for="inputFile" class="col-form-label">เพิ่มไฟล์ </label>
                        </div>

                        <div class="col-md-9">
                            <input type="file" id="inputFile" name="inputFile" class="form-control ">
                        </div>
                    </div>

                    <!-- Submit button -->
                    <div class="row mt-5">
                        <div class="col-md-12">
                            <div class="d-flex justify-content-end">
                                <button type="reset" class="btn bg-secondary-addpay text-white me-3"><i
                                        class="fa-solid fa-arrow-rotate-left"></i> ล้างข้อมูล</button>
                                <button type="submit" name="action" value="edit_expenses"
                                    class=" btn btn-addpay text-white">บันทึกการแก้ไข<i
                                        class="fa-solid fa-cloud-arrow-up"></i></button>
                                <input type="hidden" name="expenses_id" id="expenses_id"
                                    value="<?= $row['expenses_id']; ?>" />
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php  $conn->close();?>