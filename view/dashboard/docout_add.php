<?php

if (isset($_POST['action'])) {
    if ($_POST['action'] == 'create_docout') {

        date_default_timezone_set('Asia/Bangkok');
        $date = date("Y-m-d H:i:s");
        global $conn;

        $input_no = mysqli_real_escape_string($conn, trim($_POST['input_no']));
        $input_date = mysqli_real_escape_string($conn, trim($_POST['input_date']));
        $input_title = mysqli_real_escape_string($conn, trim($_POST['input_title']));
        $input_to = mysqli_real_escape_string($conn, trim($_POST['input_to']));
        $input_send = mysqli_real_escape_string($conn, trim($_POST['input_send']));
        $input_content = mysqli_real_escape_string($conn, trim($_POST['input_content']));
        $input_name = mysqli_real_escape_string($conn, trim($_POST['input_name']));
        $input_position = mysqli_real_escape_string($conn, trim($_POST['input_position']));
        $uid = $_SESSION['id'];

        if (empty($input_send) || empty($input_content)) {
            $_SESSION['error'] = "กรุณากรอกข้อมูลสิ่งที่ส่งมาด้วยและเนื้อหา";
            echo "<script> window.history.back()</script>";
            exit;
        }


        $no_check_query = "SELECT * FROM docout WHERE docout_no = '$input_no'";
        $query = $conn->query($no_check_query);
        $check = $query->fetch_assoc();

        if ($check) {

            $_SESSION['error'] = "เลขที่นี้มีในระบบแล้ว!";
            echo "<script> window.history.back()</script>";
            exit;
        } else {

            $query = "INSERT INTO docout (docout_no, docout_date, docout_title, docout_to, docout_send, docout_details, docout_signame, docout_position, docout_create, docout_uid)
            VALUES ('$input_no', '$input_date', '$input_title', '$input_to', '$input_send', '$input_content', '$input_name', '$input_position', '$date', '$uid')";

            if ($conn->query($query) === TRUE) {

                $_SESSION['success'] = "บันทึกหนังสือออกสำเร็จ!";
                echo "<script> window.location.href='?page=doc_out'</script>";
                exit;
            } else {

                $_SESSION['error'] = "เกิดข้อผิดพลาด! กรุณาลองอีกครั้ง";
                echo "<script> window.history.back()</script>";
                exit;
            }
        }
        $conn->close();
    }
}

?>

<style>
    .ck-send .ck-editor__editable_inline {
        min-height: 100px;
    }

    .ck-content .ck-editor__editable_inline {
        min-height: 250px;
    }
</style>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index">หน้าหลัก</a></li>
        <li class="breadcrumb-item"><a href="?page=doc">หนังสือ</a></li>
        <li class="breadcrumb-item"><a href="?page=doc_out">หนังสือออก</a></li>
        <li class="breadcrumb-item active" aria-current="page">เพิ่มข้อมูลหนังสือออก</li>
    </ol>
</nav>
<hr>


<div class="container bg-secondary-addpay rounded-5">
    <div class="main-body py-md-5 px-md-1 text-white">
        <div id="docout_add" class="container p-3 p-md-5">

            <div class="p-4 p-md-5 bg-white rounded-5 shadow-lg">
                <div class="text-center text-md-start text-dark my-3">
                    <h3>เพิ่มข้อมูลหนังสือออก</h3>
                </div>
                <form action="?page=doc_out_add" method="post" name="docout_add" id="docout_add" class="p-md-5">
                    <div class="row align-items-center text-dark px-md-5 mb-3">
                        <div class="col-md-3">
                            <label for="input_no" class="col-form-label">เลขที่</label>
                        </div>
                        <div class="col-auto">
                            <input type="text" id="input_no" name="input_no" class="form-control " required>
                        </div>
                    </div>
                    <div class="row align-items-center text-dark px-md-5 mb-3">
                        <div class="col-md-3">
                            <label for="inputdate" class="col-form-label">วันที่ </label>
                        </div>
                        <div class="col-auto">
                            <input type="date" id="input_date" name="input_date" class="form-control " required>
                        </div>
                    </div>
                    <div class="row align-items-center text-dark px-md-5 mb-3">
                        <div class="col-md-3">
                            <label for="input_title" class="col-form-label">ชื่อเรื่อง </label>
                        </div>
                        <div class="col-md-6">
                            <input type="text" id="input_title" name="input_title" class="form-control " required>
                        </div>
                    </div>
                    <div class="row align-items-center text-dark px-md-5 mb-3">
                        <div class="col-md-3 ">
                            <label for="input_to" class="col-form-label">เรียน (ถึงใคร) </label>
                        </div>

                        <div class="col-md-6">
                            <input type="text" id="input_to" name="input_to" class="form-control " required>
                        </div>
                    </div>
                    <div class="row align-items-center text-dark px-md-5 mb-3">
                        <div class="col-md-3 ">
                            <label for="input_send" class="col-form-label">สิ่งที่ส่งมาด้วย </label>
                        </div>
                        <div class="ck-send col-md-6">
                            <textarea type="text" id="input_send" name="input_send" class="form-control " rows="3"></textarea>
                        </div>
                    </div>
                    <div class="row align-items-center text-dark px-md-5 mb-3">
                        <div class="col-md-3">
                            <label for="input_content" class="col-form-label">เนื้อหาข้อความ </label>
                        </div>
                        <div class="ck-content col-md-9">
                            <textarea id="input_content" name="input_content" class="form-control" cols="40" rows="10" placeholder="พิมพ์เนื้อหา..."></textarea>
                        </div>
                    </div>
                    <div class="row align-items-center text-dark px-md-5 mb-3">
                        <div class="col-md-3 ">
                            <label for="input_name" class="col-form-label">ชื่อกำกับลายเซ็น</label>
                        </div>
                        <div class="col-md-6">
                            <input type="text" id="input_name" name="input_name" class="form-control " required>
                        </div>
                    </div>
                    <div class="row align-items-center text-dark px-md-5 mb-3">
                        <div class="col-md-3 ">
                            <label for="input_position" class="col-form-label">ตำแหน่งกำกับลายเซ็น</label>
                        </div>
                        <div class="col-md-6">
                            <input type="text" id="input_position" name="input_position" class="form-control " required>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-md-12">
                            <div class="d-flex justify-content-end">
                                <button type="reset" class="btn bg-secondary-addpay text-white me-3"><i class="fa-solid fa-arrow-rotate-left"></i> ล้างข้อมูล</button>
                                <button type="submit" class="btn btn-addpay text-white create_docout" name="action" value="create_docout">บันทึก <i class="fa-solid fa-cloud-arrow-up"></i></button>
                            </div>
                        </div>
                    </div>
                    <script>
                        ClassicEditor
                            .create(document.querySelector('#input_send'))

                            .catch(error => {
                                console.error(error);
                            });
                    </script>
                    <script>
                        ClassicEditor
                            .create(document.querySelector('#input_content'))

                            .catch(error => {
                                console.error(error);
                            });
                    </script>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- <script>
$(document).ready(function() {
    $(document).on('click', '.create_docout', function() {
        document.docout_add.submit();

    });

});
</script> -->