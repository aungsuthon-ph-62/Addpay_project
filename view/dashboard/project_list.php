<?php
unset($_SESSION['svinput']);

if(isset($_GET["deleteproject"])){
    
    $id = $_GET["deleteproject"];
    
    $sql = "SELECT project_file FROM project WHERE project_id = '$id'";
    $query = $conn->query($sql);
    $row = $query->fetch_assoc();
    $oldfile = $row['project_file'];
    
    $sql = "DELETE FROM project WHERE project_id = '$id'";
    $query = $conn->query($sql);
    
    if($query){
            
        unlink("uploadfile/projectfile/$oldfile");
        $_SESSION['success'] = "ลบโครงการสำเร็จ!";
        echo "<script> window.history.back()</script>";
        exit; 
        
    }
    
    $_SESSION['error'] = "เกิดข้อผิดพลาด! กรุณาลองอีกครั้ง";
    echo "<script> window.history.back()</script>";
    exit;
    
  }

?>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index">หน้าหลัก</a></li>
        <li class="breadcrumb-item active" aria-current="page">โครงการประมูล</li>
    </ol>
</nav>
<hr>

<div class="container bg-secondary-addpay rounded-5">
    <div class="main-body py-md-5 px-md-1 text-white">
        <div class="container">
            <div id="listquotation" class="py-4 p-md-5 text-white">
                <div class="text-center text-md-start">
                    <h3>โครงการประมูล</h3>
                </div>

                <div class="my-4 my-md-3 text-center text-md-end">
                    <a class="btn btn-addpay px-md-4 rounded-3 " href="?page=project_add">
                        <i class="fa-solid fa-file-circle-plus"></i> เพิ่มข้อมูล</a>
                </div>

                <div class="p-3 p-md-5 bg-light rounded-5 shadow-lg" id="main_row">
                    <div class="table-responsive text-dark">
                        <table class="table table-hover" id="projectTable">
                            <thead>
                                <tr class="align-center col">
                                    <th class="text-left" style="width:13%" scope="col">วันที่บันทึก</th>
                                    <th class="text-left" style="width:32%" scope="col">โครงการ</th>
                                    <th class="text-left" style="width:25%" scope="col">หน่วยงานเจ้าของโครงการ</th>
                                    <th class="text-center" style="width:20%" scope="col">เลขที่ใบเสนอราคากลาง</th>
                                    <th class="text-center" style="width:10%" scope="col">ตัวเลือก</th>
                                </tr>
                            </thead>
                            <?php
                            $sql = "SELECT * FROM project";
                            $query = $conn->query($sql);
                            while ($rows = $query->fetch_assoc()) {
                                echo '
                                    <tr>
                                        <td class="text-left" >'.ConvDate($rows["project_create"]).'</td>
                                        <td class="text-left" >'.$rows["project_name"].'</td>
                                        <td>'.$rows["project_agency"].'</td>
                                        <td class="text-center">'.$rows["project_quono"].'</td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-dark dropdown-toggle px-2 px-md-4"
                                                    data-bs-toggle="dropdown" aria-expanded="false"><b>เลือก</b>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" target="_blank"
                                                            href="uploadfile/projectfile/'.$rows["project_file"].'">เปิดเอกสาร</a>
                                                    </li>
                                                    <li><a class="dropdown-item"
                                                            href="?page=project_edit&editproject=' . encode($rows["project_id"], secret_key()) . '">แก้ไข</a>
                                                    </li>
                                                    <li><a class="dropdown-item deleteproject" href="#" data-project-title="'.$rows["project_name"].'" id="'.$rows["project_id"].'" >ลบ</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    ';
                                }
                            ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $conn->close(); ?>
<script type="text/javascript">
$(document).ready(function() {
    $('#projectTable').DataTable();
});

$(document).on('click', '.deleteproject', function() {
    var id = $(this).attr("id");
    var show_project_title = $(this).attr("data-project-title");
    swal.fire({
        title: 'ต้องการลบโครงการนี้ !',
        text: "ชื่อโครงการ : " + show_project_title,
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'yes!',
        cancelButtonText: 'no'
    }).then((result) => {
        if (result.value) {
            window.location.href = "?page=project&deleteproject=" + id;
        }
    });
});
</script>