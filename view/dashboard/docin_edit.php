<?php

if (isset($_GET['editdocin'])) {
    
    $get_decode = $_GET['editdocin'];
    echo "<script> console.log('{$get_decode}');</script>";
    $id = decode($get_decode, secret_key());

    echo "<script> console.log('{$id}');</script>";

    $sql = "SELECT * FROM docin WHERE docin_id ='$id'";
    $query = $conn->query($sql);
    $row = $query->fetch_assoc();

    // if (!$row) {
    //     $_SESSION['error'] = "ไม่พบหน้าดังกล่าว!";
    //     echo "<script> window.location.href='?page=doc_in';</script>";
    //     exit;
    // }
    
}

if(isset($_POST['action'])){
    if ($_POST['action'] == 'edit_docin') {

        $id= mysqli_real_escape_string($conn,trim($_POST['docin_id']));
        $enid=encode($id, secret_key());
        $no_check= mysqli_real_escape_string($conn,trim($_POST['no_check']));
        $input_no= mysqli_real_escape_string($conn,trim($_POST['input_no']));
        
        if($input_no == $no_check){
            
            edit_docin();
            exit;
            
        }else{
            
            $no_check_query = "SELECT * FROM docin WHERE docin_no = '$input_no'";
            $query = $conn->query($no_check_query);
            $check = $query->fetch_assoc();
            
            if ($check) {
                $_SESSION['error'] = "เลขที่นี้มีในระบบแล้ว!";
                echo "<script> window.location.href='?page=doc_in_edit&editdocin=.$enid.'</script>";
                exit;
                
            }else{
                
                edit_docin();
                exit;
                
            }
        }
    }
}



function edit_docin(){
    
    date_default_timezone_set('Asia/Bangkok');
    $date = date("Y-m-d H:i:s");
    $namedate = date('YmdHis');
    global $conn;

    $id= mysqli_real_escape_string($conn,trim($_POST['docin_id']));
    $enid=encode($id, secret_key());
    $input_no= mysqli_real_escape_string($conn,trim($_POST['input_no']));
    $input_date= mysqli_real_escape_string($conn,trim($_POST['input_date']));
    $input_srcname= mysqli_real_escape_string($conn,trim($_POST['input_srcname']));
    $input_title= mysqli_real_escape_string($conn,trim($_POST['input_title']));
    $input_to= mysqli_real_escape_string($conn,trim($_POST['input_to']));
    $uid = $_SESSION['id'];

    $query = "UPDATE docin SET docin_no='$input_no', docin_date='$input_date', docin_srcname='$input_srcname', docin_title='$input_title',
                docin_to='$input_to', docin_update='$date', docin_uid='$uid' WHERE docin_id ='$id'";

    if ($conn->query($query)) {
        
        if (!empty($_FILES["input_file"]["name"])) {
            
            $targetDir = "../../uploadfile/docinfile/";
            $temp = explode(".", $_FILES["input_file"]["name"]);
            $fileName = 'docin-'.$namedate. '.' . end($temp);
            $targetFilePath = $targetDir . $fileName;
            $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
            $allowTypes = array('jpg', 'png', 'jpeg', 'pdf', 'word', 'txt', 'doc', 'docx', 'ppt', 'pptx','PDF');
            
            if (in_array($fileType, $allowTypes)) {

                $sql = "SELECT docin_file FROM docin WHERE docin_id = '$id'";
                $query = $conn->query($sql);
                $row = $query->fetch_assoc();
                $oldfile = $row['docin_file'];
                
                if (move_uploaded_file($_FILES["input_file"]["tmp_name"], $targetFilePath)) {
    
                    $query = "UPDATE docin SET docin_file='$fileName' WHERE docin_id = '$id'";
    
                    if ($conn->query($query)) {
                        
                        unlink("../../uploadfile/docinfile/$oldfile");
                        $_SESSION['success'] = "แก้ไขหนังสือเข้าสำเร็จ!";
                        echo "<script> window.location.href='?page=doc_in';</script>";
                        exit;
                        
                    } else {
                        
                        unlink("../../uploadfile/docinfile/$fileName");
                        $_SESSION['error'] = "เกิดข้อผิดพลาด! กรุณาลองอีกครั้ง";
                        echo "<script> window.location.href='?page=doc_in_edit&editdocin=.$enid.'</script>";
                        exit;
                        
                    }
                } else {
                    
                    $_SESSION['error'] = "เกิดข้อผิดพลาด! อัพโหลดไฟล์ไม่สำเร็จ!";
                    echo "<script> window.location.href='?page=doc_in_edit&editdocin=.$enid.'</script>";
                    exit;
                    
                }
                
            } else {
                
                $_SESSION['error'] = "เกิดข้อผิดพลาด! ไม่รองรับนามสกุลไฟล์ชนิดนี้!";
                echo "<script> window.location.href='?page=doc_in_edit&editdocin=.$enid.'</script>";
                exit;
                
            }
            
        }else{
            
            $_SESSION['success'] = "แก้ไขหนังสือเข้าสำเร็จ!";
            echo "<script> window.location.href='?page=doc_in';</script>";
            exit;
        }
        
    } else {
        
        $_SESSION['error'] = "เกิดข้อผิดพลาด! กรุณาลองอีกครั้ง";
        echo "<script> window.location.href='?page=doc_in_edit&editdocin=.$enid.'</script>";
        exit;
        
    }
}

?>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index">หน้าหลัก</a></li>
        <li class="breadcrumb-item"><a href="?page=doc">หนังสือ</a></li>
        <li class="breadcrumb-item"><a href="?page=doc_in">หนังสือเข้า</a></li>
        <li class="breadcrumb-item active" aria-current="page">แก้ไขข้อมูลหนังสือเข้า</li>
    </ol>
</nav>
<hr>
<div class="container bg-secondary-addpay rounded-5">
    <div class="main-body p-md-5 text-white">
        <div id="paperquotation" class="container p-3 p-md-5">

            <div class="p-4 p-md-5 bg-white rounded-5 shadow-lg">
                <div class="text-center text-md-start text-dark my-3">
                    <h3>แก้ไขข้อมูลหนังสือเข้า #</h3>
                </div>
                <form action="?page=doc_in_edit&editdocin=<?php echo encode($row['docin_id'], secret_key()); ?>"
                    method="post" class="p-md-5" enctype="multipart/form-data">
                    <div class="row align-items-center text-dark px-md-5 mb-3">
                        <div class="col-md-3">
                            <h6 for="input_no" class="col-form-label">เลขที่ </h6>
                        </div>
                        <div class="col-md-9">
                            <input type="text" id="input_no" name="input_no" class="form-control " required
                                value="<?= $row['docin_no'] ?>">
                        </div>
                    </div>
                    <div class="row align-items-center text-dark px-md-5 mb-3">
                        <div class="col-md-3">
                            <h6 for="input_date" class="col-form-label">วันที่ </h6>
                        </div>
                        <div class="col-md-9">
                            <input type="date" id="input_date" name="input_date" class="form-control " required
                                value="<?= $row['docin_date'] ?>">
                        </div>
                    </div>
                    <div class="row align-items-center text-dark px-md-5 mb-3">
                        <div class="col-md-3">
                            <h6 for="input_srcname" class="col-form-label">ชื่อบริษัทต้นทาง </h6>
                        </div>
                        <div class="col-md-9">
                            <input type="text" id="input_srcname" name="input_srcname" class="form-control " required
                                value="<?= $row['docin_srcname'] ?>">
                        </div>
                    </div>
                    <div class="row align-items-center text-dark px-md-5 mb-3">
                        <div class="col-md-3">
                            <h6 for="input_title" class="col-form-label">ชื่อเรื่อง </h6>
                        </div>
                        <div class="col-md-9">
                            <input type="text" id="input_title" name="input_title" class="form-control " required
                                value="<?= $row['docin_title'] ?>">
                        </div>
                    </div>
                    <div class="row align-items-center text-dark px-md-5 mb-3">
                        <div class="col-md-3 ">
                            <h6 for="input_to" class="col-form-label">เรียน (ถึงใคร) </h6>
                        </div>

                        <div class="col-md-9">
                            <input type="text" id="input_to" name="input_to" class="form-control " required
                                value="<?= $row['docin_to'] ?>">
                        </div>
                    </div>
                    <div class="row align-items-center text-dark px-md-5 mb-3">
                        <div class="col-md-3 ">
                            <h6 for="input_file" class="col-form-label">เพิ่มไฟล์ </h6>
                        </div>

                        <div class="col-md-9">
                            <input type="file" id="input_file" name="input_file" class="form-control " required>
                        </div>
                    </div>
                    <!-- Submit button -->
                    <div class="row mt-5">
                        <div class="col-md-12">
                            <div class="d-flex justify-content-end">
                                <button type="reset" class="btn bg-secondary-addpay text-white me-3"><i
                                        class="fa-solid fa-arrow-rotate-left"></i> ล้างข้อมูล</button>
                                <button type="submit" name="action" value="edit_docin" class=" btn btn-addpay
                                    text-white">บันทึก
                                    <i class="fa-solid fa-cloud-arrow-up"></i></button>
                                <input type="hidden" name="no_check" id="no_check" value="<?= $row['docin_no']; ?>" />
                                <input type="hidden" name="docin_id" id="docin_id" value="<?= $row['docin_id']; ?>" />
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $conn->close(); ?>