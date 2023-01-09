<?php
if(isset($_GET["deletecontract"]))
  {
    $id = $_GET["deletecontract"];
    
    $sql = "SELECT * FROM contract WHERE contract_id = '$id'";
    $query = $conn->query($sql);
    $row = $query->fetch_assoc();
    $oldfile1 = $row['contract_file'];
    $oldfile2= $row['contract_filesigner'];
    
    $sql = "DELETE FROM contract WHERE contract_id = '$id'";
    $query = $conn->query($sql);
    
    if($query){
            
        unlink("uploadfile/contractfile/$oldfile1"); 
        unlink("uploadfile/contractfile/$oldfile2");
        $_SESSION['success'] = "ลบเอกสารสัญญาสำเร็จ!";
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
        <li class="breadcrumb-item active" aria-current="page">เอกสารสัญญา</li>
    </ol>
</nav>
<hr>
<div class="container bg-secondary-addpay rounded-5">
    <div class="main-body py-md-5 px-md-1 text-white">
        <div class="container">
            <div id="listquotation" class="py-4 p-md-5 text-white">
                <div class="text-center text-md-start">
                    <h3>เอกสารสัญญา</h3>
                </div>
                <div class="my-4 my-md-3 text-center text-md-end">
                    <a class="btn btn-addpay px-md-4 rounded-3 " href="?page=contract_add">
                        <i class="fa-solid fa-file-circle-plus"></i> เพิ่มข้อมูล</a>
                </div>
                <div class="p-3 p-md-5 bg-light rounded-5 shadow-lg" id="main_row">
                    <div class="table-responsive">
                        <table class="table" id="contractTable">
                            <thead>
                                <tr class="align-center" class="rows">
                                    <th style="width:10%" scope="col">วันที่ส่ง LG</th>
                                    <th style="width:10%" scope="col">วันหมดอายุ LG</th>
                                    <th style="width:20%" scope="col">ชื่อบริษัท</th>
                                    <th style="width:20%" scope="col">ชื่อสัญญา</th>
                                    <th style="width:10%" scope="col">วันประกาศผล</th>
                                    <th style="width:10%" scope="col">ตัวเลือก</th>
                                </tr>
                            </thead>
                            <?php
                                
                                $sql = "SELECT * FROM contract";
                                $query = $conn->query($sql);
                                while ($rows = $query->fetch_assoc()) {
                                    echo '
                                    <tr>
                                        <td>'.$rows["contract_lgdeld"].'</td>
                                        <td>'.$rows["contract_lgexpd"].'</td>
                                        <td>'.$rows["contract_comp"].'</td>
                                        <td>'.$rows["contract_title"].'</td>
                                        <td>'.$rows["contract_ann"].'</td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-dark dropdown-toggle px-2 px-md-4"
                                                    data-bs-toggle="dropdown" aria-expanded="false"><b>เลือก</b>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" target="_blank"
                                                            href="uploadfile/contractfile/'.$rows["contract_file"].'">เปิดเอกสารสัญญา</a>
                                                    </li>
                                                    <li><a class="dropdown-item" target="_blank"
                                                            href="uploadfile/contractfile/'.$rows["contract_filesigner"].'">เปิดเอกสารผู้เซ็นสัญญา</a>
                                                    </li>
                                                    <li><a class="dropdown-item"
                                                            href="?page=contract_edit&editcontract=' . encode($rows["contract_id"], secret_key()) . '">แก้ไข</a>
                                                    </li>
                                                    <li><a class="dropdown-item deletecontract" href="#" data-contract-title="'.$rows["contract_title"].'" id="'.$rows["contract_id"].'" >ลบ</a></li>
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
                <!-- Data table -->
                <script type="text/javascript">
                $(document).ready(function() {
                    $('#contractTable').DataTable();
                });

                $(document).on('click', '.deletecontract', function() {
                    var id = $(this).attr("id");
                    var show_contract_title = $(this).attr("data-contract-title");
                    swal.fire({
                        title: 'ต้องการลบเอกสารสัญญานี้ !',
                        text: "ชื่อสัญญา : " + show_contract_title,
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'yes!',
                        cancelButtonText: 'no'
                    }).then((result) => {
                        if (result.value) {
                            window.location.href = "?page=contract&deletecontract=" + id;
                        }
                    });
                });
                </script>
                <!-- Data table -->
            </div>
        </div>
    </div>
</div>
<?php $conn->close(); ?>