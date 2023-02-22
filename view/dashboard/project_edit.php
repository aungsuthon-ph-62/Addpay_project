<?php

if (isset($_GET['editproject'])) {

    $get_decode = $_GET['editproject'];
    $id = decode($get_decode, secret_key());

    $sql = "SELECT * FROM project WHERE project_id ='$id'";
    $query = $conn->query($sql);
    $row = $query->fetch_assoc();

    if (!$row) {
        $_SESSION['error'] = "ไม่พบหน้าดังกล่าว!";
        echo "<script> window.history.back()</script>";
        exit;
    }
}

if (isset($_POST['action'])) {
    if ($_POST['action'] == 'edit_project') {

        date_default_timezone_set('Asia/Bangkok');
        $date = date("Y-m-d H:i:s");
        $namedate = date('YmdHis');
        global $conn;

        $input_pjname = mysqli_real_escape_string($conn, trim($_POST['input_pjname']));
        $input_agency = mysqli_real_escape_string($conn, trim($_POST['input_agency']));
        $input_budget = mysqli_real_escape_string($conn, trim($_POST['input_budget']));
        $input_detail = mysqli_real_escape_string($conn, trim($_POST['input_detail']));
        $pjdate = mysqli_real_escape_string($conn, trim($_POST['pjdate']));
        $input_id = mysqli_real_escape_string($conn, trim($_POST['qid']));
        $input_no = mysqli_real_escape_string($conn, trim($_POST['input_no']));
        $input_date = mysqli_real_escape_string($conn, trim($_POST['input_date']));
        $input_num = mysqli_real_escape_string($conn, trim($_POST['input_num']));
        $uid = $_SESSION['id'];

        if(empty($input_id)||empty($input_date)||empty($input_num)){
            $_SESSION['error'] = "ไม่มีข้อมูลใบเสนอราคา";
            echo "<script> window.history.back()</script>";
            exit;
            
        }else{

            if (!empty($_FILES["input_file"]["name"])) {

                $targetDir = "uploadfile/projectfile/";
                $temp = explode(".", $_FILES["input_file"]["name"]);
                $fileName = 'project-' . $namedate . '.' . end($temp);
                $targetFilePath = $targetDir . $fileName;
                $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
                $allowTypes = array('jpg', 'png', 'jpeg', 'pdf', 'word', 'txt', 'doc', 'docx', 'ppt', 'pptx', 'PDF');

                if (in_array($fileType, $allowTypes)) {
                    
                    if (move_uploaded_file($_FILES["input_file"]["tmp_name"], $targetFilePath)) {

                        $query1 = "UPDATE project SET project_name='$input_pjname', project_agency='$input_agency'
                                , project_budget='$input_budget', project_detail='$input_detail', project_quoid='$input_id'
                                , project_quono='$input_no', project_file='$fileName', project_update='$date', project_uid='$uid'";

                        $query2 = "DELETE FROM project_tor WHERE projtor_pid = '$id'";

                        if ( $conn->query($query1) === TRUE && $conn->query($query2) === TRUE) {

                            $last_id = $conn->insert_id;

                            for ($count = 0; $count < $_POST["total_item"]; $count++) {

                                $title_name = mysqli_real_escape_string($conn, trim($_POST['title_name'][$count]));
                                $title_detail = mysqli_real_escape_string($conn, trim($_POST['title_detail'][$count]));
                
                                $query = "INSERT INTO project_tor (projtor_pid, projtor_title, projtor_detail, projtor_create, projtor_update)
                                    VALUES ('$last_id', '$title_name', '$title_detail', '$date', '$pjdate')";
                                $conn->query($query);
                            }

                            $_SESSION['success'] = "บันทึกโครงการสำเร็จ!";
                            echo "<script> window.location.href='?page=project';</script>";
                            exit;
                            
                        } else {

                            unlink("uploadfile/projectfile/$fileName");
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
            }else{
                
                $query1 = "UPDATE project SET project_name='$input_pjname', project_agency='$input_agency'
                        , project_budget='$input_budget', project_detail='$input_detail', project_quoid='$input_id'
                        , project_quono='$input_no', project_update='$date', project_uid='$uid'";

                $query2 = "DELETE FROM project_tor WHERE projtor_pid = '$id'";

                if ( $conn->query($query1) === TRUE && $conn->query($query2) === TRUE) {

                    $last_id = $conn->insert_id;

                    for ($count = 0; $count < $_POST["total_item"]; $count++) {

                        $title_name = mysqli_real_escape_string($conn, trim($_POST['title_name'][$count]));
                        $title_detail = mysqli_real_escape_string($conn, trim($_POST['title_detail'][$count]));
        
                        $query = "INSERT INTO project_tor (projtor_pid, projtor_title, projtor_detail, projtor_create, projtor_update)
                            VALUES ('$last_id', '$title_name', '$title_detail', '$date', '$pjdate')";
                        $conn->query($query);
                    }

                    $_SESSION['success'] = "แก้ไขโครงการสำเร็จ!";
                    echo "<script> window.location.href='?page=project';</script>";
                    exit;
                    
                } else {

                    $_SESSION['error'] = "เกิดข้อผิดพลาด! กรุณาลองอีกครั้ง";                            
                    echo "<script> window.history.back()</script>";
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
        <li class="breadcrumb-item"><a href="?page=project">โครงการประมูล</a></li>
        <li class="breadcrumb-item active" aria-current="page">แก้ไขโครงการประมูล</li>
    </ol>
</nav>
<hr>

<div class="container bg-secondary-addpay rounded-5">
    <div class=" main-body py-md-5 px-md-1 text-white">
        <div id="paperproject" class="container p-3 p-md-5">
            <div class="p-4 p-md-5 bg-white rounded-5 shadow-lg">
                <div class="text-center text-md-start text-dark my-3">
                    <h3>แก้ไขโครงการประมูล</h3>
                </div>
                <form method="post" id="project_form" name="project_form"
                    action="?page=project_add&editproject=<?php echo encode($row['project_id'], secret_key()); ?>"
                    class="mt-md-5" enctype="multipart/form-data">
                    <div class="row align-items-center text-dark px-md-5 mb-3">
                        <div class="col-md-3 text-md-end">
                            <h6 class="col-form-label">ชื่อโครงการ :</h6>
                        </div>

                        <div class="col-md-8">
                            <input type="text" id="input_pjname" name="input_pjname" class="form-control " required
                                value="<?= $row['project_name'] ?>">
                        </div>
                    </div>

                    <div class=" row align-items-center text-dark px-md-5 mb-3">
                        <div class="col-md-3 text-md-end">
                            <h6 class="col-form-label"> หน่วยงานเจ้าของโครงการ :</h6>
                        </div>
                        <div class="col-md-8">
                            <input type="text" id="input_agency" name="input_agency" class="form-control " required
                                value="<?= $row['project_agency'] ?>">
                        </div>
                    </div>

                    <div class="row align-items-center text-dark px-md-5 mb-3">
                        <div class="col-md-3 text-md-end">
                            <h6 class="col-form-label">งบประมาณโครงการ :</h6>
                        </div>
                        <div class="col-md-8">
                            <input type="text" id="input_budget" name="input_budget" class="form-control " required
                                value="<?= $row['project_budget'] ?>">
                        </div>
                    </div>

                    <div class="row align-items-center text-dark px-md-5 mb-3">
                        <div class="col-md-3 text-md-end">
                            <h6 class="col-form-label">รายละเอียดพอสังเขป :</h6>
                        </div>
                        <div class="col-md-8">
                            <textarea class="form-control" id="input_detail" name="input_detail" rows="5"
                                required><?= $row['project_detail'] ?></textarea>
                        </div>
                    </div>

                    <div class="row align-items-center text-dark px-md-5 mb-3">
                        <div class="col-md-3 text-md-end">
                            <h6 class="col-form-label">เลขที่ใบเสนอราคากลาง :</h6>
                        </div>
                        <div class="col-md-3">
                            <input type="text" class="form-control" id="input_no" name="input_no" required
                                value="<?= $row['project_quono'] ?>">
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-addpay text-white keyquono" name="keyquono"
                                id="keyquono">
                                <i class="fa-solid fa-magnifying-glass"></i> ค้นหา</button>
                        </div>
                    </div>
                    <div class="row align-items-center text-dark px-md-5 mb-3">
                        <div class="col-md-3 text-md-end">
                            <h6 class="col-form-label">วันที่ในใบเสนอราคากลาง :</h6>
                        </div>
                        <div class="col-md-3">
                            <input type="date" id="input_date" name="input_date" class="form-control " readonly>
                        </div>
                    </div>
                    <div class="row align-items-center text-dark px-md-5 mb-3">
                        <div class="col-md-3 text-md-end">
                            <h6 class="col-form-label">จำนวนเงินใบเสนอราคากลาง :</h6>
                        </div>
                        <div class="col-md-3">
                            <input type="text" id="input_num" name="input_num" class="form-control " readonly>
                        </div>
                    </div>
                    <div class="row align-items-center text-dark px-md-5 mb-3">
                        <div class="col-md-3 text-md-end">
                            <h6 class="col-form-label">ไฟล์ใบเสนอราคาที่เซ็นอนุมัติ :</h6>
                        </div>
                        <div class="col-md-6">
                            <input type="file" id="input_file" name="input_file" class=" form-control " required>
                        </div>
                    </div>

                    <div class="row align-items-center text-dark px-md-5 mb-3">
                        <div class="col-md-3">
                            <h6>รายการตาม TOR :</h6>
                        </div>
                        <div class="border border-secondary rounded-3 p-4">
                            <div class="table-responsive">
                                <table id="project-item-table" class="table ">
                                    <tr>
                                        <th width="7%">ลำดับ</th>
                                        <th width="30%">หัวข้อ</th>
                                        <th width="58%">รายละเอียด</th>
                                        <th width="5%">ลบ</th>
                                    </tr>
                                    <?php 
                                        $sql = "SELECT * FROM project_tor WHERE projtor_pid ='$id'";
                                        $query = $conn->query($sql);
                                        $n = 0;
                                        while ($rows = $query->fetch_assoc()) {
                                            $n = $n + 1;
                                    ?>
                                    <tr id="row_id_<?= $n; ?>">
                                        <td><span id="sr_no"></span></td>
                                        <td>
                                            <input type="text" name="title_name[]" id="title_name<?= $n; ?>"
                                                class="form-control input-sm title_name" data-srno="<?= $n; ?>"
                                                value="<?= $row['projtor_title'] ?>" required />
                                        </td>
                                        <td>
                                            <textarea class="form-control title_detail" name="title_detail[]"
                                                id="title_detail<?= $n; ?>" data-srno="<?= $n; ?>" rows="3"
                                                value="<?= $row['project_detail'] ?>" required></textarea>
                                        </td>
                                        <td>
                                            <button type="button" name="remove_row" id="<?= $n; ?>"
                                                class="btn btn-danger btn-xs remove_row">X</button>
                                        </td>
                                    </tr>

                                    <?php } ?>
                                </table>
                                <div class="text-center">
                                    <button type="button" id="add_row" class="btn btn-addpay px-md-4 rounded-3"><i
                                            class="fa fa-plus-circle text-white"></i> เพิ่มรายการ</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-5">
                        <div class="col-md-12">
                            <div class="d-flex justify-content-end">
                                <button type="reset" class="btn bg-secondary-addpay text-white me-3"><i
                                        class="fa-solid fa-arrow-rotate-left"></i> ล้างข้อมูล</button>
                                <button type="submit" name="action" value="create_project"
                                    class="btn btn-addpay text-white">บันทึก <i
                                        class="fa-solid fa-cloud-arrow-up"></i></button>
                            </div>
                        </div>
                        <input type="hidden" name="qid" id="qid" />
                        <input type="hidden" name="pjdate" id="pjdate" value="<?= $row['project_create'] ?>" />
                        <input type="hidden" name="total_item" id="total_item" value="<?=$n;?>" />
                    </div>
                </form>


                <script>
                $(document).ready(function() {
                    var final_total_price = $('#final_total_price').text();
                    var count = <?=$n;?>;
                    var total_item = <?=$n;?>;

                    $(document).on('click', '#add_row', function() {
                        count++;
                        total_item++;
                        $('#total_item').val(total_item);
                        var html_code = '';
                        html_code += '<tr id="row_id_' + count + '">';
                        html_code += '<td><span id="sr_no"></span></td>';

                        html_code +=
                            '<td><input type="text" name="title_name[]" id="title_name' + count +
                            '" class="form-control input-sm" required/></td>';
                        html_code +=
                            '<td><textarea class="form-control title_detail" name="title_detail[]" id="title_detail' +
                            count +
                            '" data-srno="' + count + '" rows="3" required/></textarea></td>';
                        html_code +=
                            '<td><button type="button" name="remove_row" id="' + count +
                            '" class="btn btn-danger btn-xs remove_row">X</button></td>';
                        html_code += '</tr>';
                        $('#project-item-table').append(html_code);
                    });

                    $(document).on('click', '.remove_row', function() {
                        var row_id = $(this).attr("id");
                        $('#row_id_' + row_id).remove();
                        total_item--;
                        $('#total_item').val(total_item);
                    });

                    $(document).on('click', '.keyquono', function() {
                        var qno = $('#input_no').val();

                        if (qno != "") {
                            $.ajax({
                                type: "POST",
                                url: "https://addpaycrypto.com/addpay_eoffice/php/ajax.php",
                                data: {
                                    keyquono: qno
                                },
                                success: function(response) {
                                    var jsonData = JSON.parse(response);
                                    if (jsonData.success == "1") {

                                        var result1 = jsonData.quo_id;
                                        var result2 = jsonData.quo_date;
                                        var result3 = jsonData.quo_total;

                                        $('#qid').val(result1);
                                        $('#input_date').val(result2);
                                        $('#input_num').val(result3);

                                    } else if (jsonData.success == "2") {

                                        $('#qid').val('');
                                        $('#input_date').val('');
                                        $('#input_num').val('');
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Error!',
                                            text: 'ไม่เจอใบเสนอราคากลางนี้',
                                            showConfirmButton: true,
                                            timer: '5000'
                                        })

                                    } else {
                                        console.log("no value")
                                    }
                                }
                            })
                        }
                    })

                    $(document).on('keyup', '#input_no', function() {
                        editkey();
                    })

                    editkey();

                    function editkey() {
                        var qno = $('#input_no').val();

                        if (qno != "") {
                            $.ajax({
                                type: "POST",
                                url: "https://addpaycrypto.com/addpay_eoffice/php/ajax.php",
                                data: {
                                    keyquono: qno
                                },
                                success: function(response) {
                                    var jsonData = JSON.parse(response);
                                    if (jsonData.success == "1") {

                                        var result1 = jsonData.quo_id;
                                        var result2 = jsonData.quo_date;
                                        var result3 = jsonData.quo_total;

                                        $('#qid').val(result1);
                                        $('#input_date').val(result2);
                                        $('#input_num').val(result3);

                                    } else if (jsonData.success == "2") {

                                        $('#qid').val('');
                                        $('#input_date').val('');
                                        $('#input_num').val('');

                                    }
                                }
                            })
                        }
                    }

                });
                </script>
            </div>
        </div>
    </div>
</div>
<!-- <script src="https://cdn.jsdelivr.net/gh/akjpro/form-anticlear/base.js"></script> -->