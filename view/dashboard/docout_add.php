<?php
session_start();
include("../../layout/head.php");
require_once("../../php/conn.php");

// $uid = $_SESSION['id'];

if(isset($_POST['action'])){
    if ($_POST['action'] == 'create_docout') {
        
        date_default_timezone_set('Asia/Bangkok');
        $date = date("Y-m-d H:i:s");
        global $conn;
        
        $input_no= mysqli_real_escape_string($conn,trim($_POST['input_no']));
        $input_date= mysqli_real_escape_string($conn,trim($_POST['input_date']));
        $input_title= mysqli_real_escape_string($conn,trim($_POST['input_title']));
        $input_to= mysqli_real_escape_string($conn,trim($_POST['input_to']));
        $input_send= mysqli_real_escape_string($conn,trim($_POST['input_send']));
        $input_content= mysqli_real_escape_string($conn,trim($_POST['input_content']));
        $input_name= mysqli_real_escape_string($conn,trim($_POST['input_name']));
        $input_position= mysqli_real_escape_string($conn,trim($_POST['input_position']));
        $uid = 1;
        
        $no_check_query = "SELECT * FROM docout WHERE docout_no = '$input_no'";
        $query = $conn->query($no_check_query);
        $check = $query->fetch_assoc();
    
        if ($check) {
            
            $_SESSION['error'] = "เลขที่นี้มีในระบบแล้ว!";
            header("Location: docout_add.php");
            exit;
            
        } else {
            
            $query = "INSERT INTO docout (docout_no, docout_date, docout_title, docout_to, docout_send, docout_details, docout_signame, docout_position, docout_create, docout_uid)
            VALUES ('$input_no', '$input_date', '$input_title', '$input_to', '$input_send', '$input_content', '$input_name', '$input_position', '$date', '$uid')";
            
            if ($conn->query($query) === TRUE) {

                $_SESSION['success'] = "บันทึกหนังสือออกสำเร็จ!";
                header("Location: docout_list.php");
                exit;
                
            } else {
                
                $_SESSION['error'] = "เกิดข้อผิดพลาด! กรุณาลองอีกครั้ง";
                header("Location: docout_add.php");
                exit;
                
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

.ck-send .ck-editor__editable_inline {
    min-height: 100px;
}

.ck-details .ck-editor__editable_inline {
    min-height: 250px;
}
</style>

<body>
    <?php require("../alert.php");?>
    <div class="container py-5">
        <div class="main-body">
            <nav aria-label="breadcrumb" class="main-breadcrumb mt-2">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="../../view/dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="../dashboard/doc.php">หนังสือ</a></li>
                    <li class="breadcrumb-item"><a href="../dashboard/docout_list.php">หนังสือออก</a></li>
                    <li class="breadcrumb-item active" aria-current="page">เพิ่มข้อมูลหนังสือออก</li>
                </ol>
            </nav>
            <hr>
            <div id="docout_add" class="container pb-md-0 mb-5">
                <div>
                    <h3>เพิ่มข้อมูลหนังสือออก</h3>
                </div>
                <div class=" px-md-5 py-md-4 justify-content-center">
                    <div class="p-2 py-md-4 px-md-5 border rounded-3">
                        <form action="docout_add.php" method="post" name="docout_add" id="docout_add">
                            <div class=" row g-3 align-items-center mb-3">
                                <div class="col-md-3">
                                    <label for="input_no" class="col-form-label">เลขที่</label>
                                </div>
                                <div class="col-auto">
                                    <input type="tetx" id="input_no" name="input_no" class="form-control " required>
                                </div>
                            </div>
                            <div class="row g-3 align-items-center mb-3">
                                <div class="col-md-3">
                                    <label for="inputdate" class="col-form-label">วันที่ </label>
                                </div>
                                <div class="col-auto">
                                    <input type="date" id="input_date" name="input_date" class="form-control " required>
                                </div>
                            </div>
                            <div class="row g-3 align-items-center mb-3">
                                <div class="col-md-3">
                                    <label for="input_title" class="col-form-label">ชื่อเรื่อง </label>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" id="input_title" name="input_title" class="form-control "
                                        required>
                                </div>
                            </div>
                            <div class="row g-3 align-items-center mb-3">
                                <div class="col-md-3 ">
                                    <label for="input_to" class="col-form-label">เรียน (ถึงใคร) </label>
                                </div>

                                <div class="col-md-6">
                                    <input type="text" id="input_to" name="input_to" class="form-control " required>
                                </div>
                            </div>
                            <div class="row g-3  mb-3 ">
                                <div class="col-md-3">
                                    <label for="input_send" class="col-form-label">สิ่งที่ส่งมาด้วย </label>
                                </div>
                                <div class="ck-send col-md-9 ">
                                    <textarea id="input_send" name="input_send" class="form-control"
                                        placeholder="พิมพ์เนื้อหา..."></textarea>
                                </div>
                            </div>
                            <div class="row g-3  mb-3">
                                <div class="col-md-3">
                                    <label for="input_content" class="col-form-label">เนื้อหาข้อความ </label>
                                </div>
                                <div class=" col-md-9">
                                    <textarea id="input_content" name="input_content" class="form-control" cols="40"
                                        rows="10" placeholder="พิมพ์เนื้อหา..."></textarea>
                                </div>
                            </div>
                            <div class="row g-3 align-items-center mt-3">
                                <div class="col-md-3 ">
                                    <label for="input_name" class="col-form-label">ชื่อกำกับลายเซ็น</label>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" id="input_name" name="input_name" class="form-control " required>
                                </div>
                            </div>
                            <div class="row g-3 align-items-center mt-1 mb-3">
                                <div class="col-md-3 ">
                                    <label for="input_position" class="col-form-label">ตำแหน่งกำกับลายเซ็น</label>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" id="input_position" name="input_position" class="form-control "
                                        required>
                                </div>
                            </div>
                            <div class="mx-auto d-flex justify-content-end">
                                <button type="reset"
                                    class=" btn btn-outline-danger btn btn-outline-success px-2 mt-2 rounded-3 fw-bold"><i
                                        class="fa-solid fa-eraser"></i> ล้างข้อมูล</button>
                                <button type="submit" name="action" value="create_docout"
                                    class="ms-3  btn btn-outline-success px-2 mt-2 rounded-3  fw-bold">บันทึก <i
                                        class="fa-solid fa-angles-right"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script>
        ClassicEditor
            .create(document.querySelector('#input_content'))

            .catch(error => {
                console.error(error);
            });
        </script>
        <script>
        ClassicEditor
            .create(document.querySelector('#input_send'))

            .catch(error => {
                console.error(error);
            });
        </script>
    </div>
</body>