<?php
session_start();
include("../../layout/head.php");
require_once("../../php/conn.php");

// $uid = $_SESSION['id'];

if (isset($_GET['editdocout'])) {
    
    $id = $_GET['editdocout'];

    $sql = "SELECT * FROM docout WHERE docout_id ='$id'";
    $query = $conn->query($sql);
    $row = $query->fetch_assoc();
    
}

if(isset($_POST['action'])){
    if ($_POST['action'] == 'edit_docout') {

        $id= mysqli_real_escape_string($conn,trim($_POST['docout_id']));
        $no_check= mysqli_real_escape_string($conn,trim($_POST['no_check']));
        $input_no= mysqli_real_escape_string($conn,trim($_POST['input_no']));
        
        if($input_no == $no_check){
            
            edit_docout();
            exit;
            
        }else{
            
            $no_check_query = "SELECT * FROM docout WHERE docout_no = '$input_no'";
            $query = $conn->query($no_check_query);
            $check = $query->fetch_assoc();
            
            if ($check) {
                $_SESSION['error'] = "เลขที่นี้มีในระบบแล้ว!";
                header('Location: docout_edit.php?editdocout='.$id);
                exit;
                
            }else{
                
                edit_docout();
                exit;
                
            }
        }
    }
}

function edit_docout(){
    
    date_default_timezone_set('Asia/Bangkok');
    $date = date("Y-m-d H:i:s");
    global $conn;
    
    $id= mysqli_real_escape_string($conn,trim($_POST['docout_id']));
    $input_no= mysqli_real_escape_string($conn,trim($_POST['input_no']));
    $input_date= mysqli_real_escape_string($conn,trim($_POST['input_date']));
    $input_title= mysqli_real_escape_string($conn,trim($_POST['input_title']));
    $input_to= mysqli_real_escape_string($conn,trim($_POST['input_to']));
    $input_send= mysqli_real_escape_string($conn,trim($_POST['input_send']));
    $input_content= mysqli_real_escape_string($conn,trim($_POST['input_content']));
    $input_name= mysqli_real_escape_string($conn,trim($_POST['input_name']));
    $input_position= mysqli_real_escape_string($conn,trim($_POST['input_position']));
    $uid = 1;

    $query = "UPDATE docout SET docout_no='$input_no', docout_date='$input_date', docout_title='$input_title', docout_to='$input_to',
        docout_send='$input_send', docout_details='$input_content', docout_signame='$input_name', docout_position='$input_position',
        docout_update='$date', docout_uid='$uid' WHERE docout_id ='$id'";
    
    if ($conn->query($query) === TRUE) {

        $_SESSION['success'] = "แก้ไขหนังสือออกสำเร็จ!";
        header("Location: docout_list.php");
        exit;
        
    } else {
        
        $_SESSION['error'] = "เกิดข้อผิดพลาด! กรุณาลองอีกครั้ง";
        header('Location: docout_edit.php?editdocout='.$id);
        exit;
        
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
                        <form action="docout_edit.php" method="post" name="docout_edit" id="docout_edit">
                            <div class=" row g-3 align-items-center mb-3">
                                <div class="col-md-3">
                                    <label for="input_no" class="col-form-label">เลขที่</label>
                                </div>
                                <div class="col-auto">
                                    <input type="text" id="input_no" name="input_no" class="form-control " required
                                        value="<?= $row['docout_no'] ?>">
                                </div>
                            </div>
                            <div class="row g-3 align-items-center mb-3">
                                <div class="col-md-3">
                                    <label for="inputdate" class="col-form-label">วันที่ </label>
                                </div>
                                <div class="col-auto">
                                    <input type="date" id="input_date" name="input_date" class="form-control " required
                                        value="<?= $row['docout_date'] ?>">
                                </div>
                            </div>
                            <div class="row g-3 align-items-center mb-3">
                                <div class="col-md-3">
                                    <label for="input_title" class="col-form-label">ชื่อเรื่อง </label>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" id="input_title" name="input_title" class="form-control "
                                        required value="<?= $row['docout_title'] ?>">
                                </div>
                            </div>
                            <div class="row g-3 align-items-center mb-3">
                                <div class="col-md-3 ">
                                    <label for="input_to" class="col-form-label">เรียน (ถึงใคร) </label>
                                </div>

                                <div class="col-md-6">
                                    <input type="text" id="input_to" name="input_to" class="form-control " required
                                        value="<?= $row['docout_to'] ?>">
                                </div>
                            </div>
                            <div class="row g-3  mb-3 ">
                                <div class="col-md-3">
                                    <label for="input_send" class="col-form-label">สิ่งที่ส่งมาด้วย </label>
                                </div>
                                <div class="ck-send col-md-9 ">
                                    <textarea id="input_send" name="input_send" class="form-control"
                                        placeholder="พิมพ์เนื้อหา..."><?= $row['docout_dend'] ?></textarea>
                                </div>
                            </div>
                            <div class="row g-3  mb-3">
                                <div class="col-md-3">
                                    <label for="input_content" class="col-form-label">เนื้อหาข้อความ </label>
                                </div>
                                <div class="ck-details col-md-9">
                                    <textarea id="input_content" name="input_content" class="form-control" cols="40"
                                        rows="10" placeholder="พิมพ์เนื้อหา..."><?= $row['docout_details'] ?></textarea>
                                </div>
                            </div>
                            <div class="row g-3 align-items-center mt-3">
                                <div class="col-md-3 ">
                                    <label for="input_name" class="col-form-label">ชื่อกำกับลายเซ็น</label>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" id="input_name" name="input_name" class="form-control " required
                                        value="<?= $row['docout_signame'] ?>">
                                </div>
                            </div>
                            <div class="row g-3 align-items-center mt-1 mb-3">
                                <div class="col-md-3 ">
                                    <label for="input_position" class="col-form-label">ตำแหน่งกำกับลายเซ็น</label>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" id="input_position" name="input_position" class="form-control "
                                        required value="<?= $row['docout_position'] ?>">
                                </div>
                            </div>
                            <div class="mx-auto d-flex justify-content-end">
                                <button type="reset"
                                    class=" btn btn-outline-danger btn btn-outline-success px-2 mt-2 rounded-3 fw-bold"><i
                                        class="fa-solid fa-eraser"></i> ล้างข้อมูล</button>
                                <button type="submit" name="action" value="edit_docout"
                                    class="ms-3  btn btn-outline-success px-2 mt-2 rounded-3  fw-bold">บันทึกการแก้ไข
                                    <i class="fa-solid fa-angles-right"></i></button>
                                <input type="hidden" name="no_check" id="no_check" value="<?= $row['docout_no'];?>" />
                                <input type="hidden" name="docout_id" id="docout_id" value="<?= $row['docout_id'];?>" />
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
<?php  $conn->close();?>