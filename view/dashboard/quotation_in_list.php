<?php
if (isset($_GET["deletequoin"])) {

    $id = $_GET["deletequoin"];

    $sql = "SELECT quoin_file FROM quotation_in WHERE quoin_id = '$id'";
    $query = $conn->query($sql);
    $row = $query->fetch_assoc();
    $oldfile = $row['quoin_file'];

    $sql = "DELETE FROM quotation_in WHERE quoin_id = '$id'";
    $query = $conn->query($sql);

    if ($query) {

        unlink("uploadfile/quotationinfile/$oldfile");
        $_SESSION['success'] = "ลบใบเสนอราคาสำเร็จ!";
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
        <li class="breadcrumb-item active" aria-current="page">ใบเสนอราคาเข้า</li>
    </ol>
</nav>
<hr>


<div class="container bg-secondary-addpay rounded-5">
    <div class="main-body py-md-5 px-md-1 text-white">
        <div class="container">
            <div id="listquotation" class="py-4 p-md-5 text-white">
                <div class="text-center text-md-start">
                    <h3>ใบเสนอราคาเข้า</h3>
                </div>

                <div class="my-4 my-md-3 text-center text-md-end">
                    <a class="btn btn-addpay px-md-4 rounded-3 " href="?page=quo_in_add">
                        <i class="fa-solid fa-file-circle-plus"></i> สร้างใบเสนอราคา</a>
                </div>

                <div class="p-3 p-md-5 bg-light rounded-5 shadow-lg" id="main_row">
                    <div class="table-responsive text-dark">
                        <table class="table table-hover" id="quotationinTable">
                            <thead>
                                <tr class="rows align-center">
                                    <th scope="col" style="width:15%;">เลขที่</th>
                                    <th scope="col" style="width:15%;">วันที่ในใบเสนอราคา</th>
                                    <th scope="col" style="width:40%;">บริษัทที่ออกใบเสนอราคา</th>
                                    <th scope="col" style="width:20%;">สถานะ</th>
                                    <th scope="col" style="width:10%;">ตัวเลือก</th>
                                </tr>
                            </thead>
                            <?php

                            $sql = "SELECT * FROM quotation_in";
                            $query = $conn->query($sql);
                            while ($rows = $query->fetch_assoc()) {
                                echo '
                                    <tr>
                                        <td>' . $rows["quoin_no"] . '</td>
                                        <td>' . $rows["quoin_date"] . '</td>
                                        <td>' . $rows["quoin_company"] . '</td>
                                        <td>' . $rows["quoin_status"] . '</td>
                                        
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-dark dropdown-toggle px-2 px-md-4"
                                                    data-bs-toggle="dropdown" aria-expanded="false"><b>เลือก</b>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" target="_blank"
                                                            href="uploadfile/quotationinfile/' . $rows["quoin_file"] . '">เปิดเอกสาร</a>
                                                    </li>
                                                    <li><a class="dropdown-item"
                                                            href="?page=quo_in_edit&editquoin=' . encode($rows["quoin_id"], secret_key()) . '">แก้ไข</a>
                                                    </li>
                                                    <li><a class="dropdown-item deletequoin" href="#" data-quoin-no="' . $rows["quoin_no"] . '" id="' . $rows["quoin_id"] . '" >ลบ</a></li>
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
                    $('#quotationinTable').DataTable();

                    $(document).on('click', '.deletequoin', function() {
                        var id = $(this).attr("id");
                        var show_quoin_no = $(this).attr("data-quoin-no");
                        swal.fire({
                            title: 'ต้องการลบใบเสนอราคานี้ !',
                            text: "เลขที่ใบเสนอราคา : " + show_quoin_no,
                            type: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#d33',
                            cancelButtonColor: '#3085d6',
                            confirmButtonText: 'yes!',
                            cancelButtonText: 'no'
                        }).then((result) => {
                            if (result.value) {
                                window.location.href = "?page=quo_in&deletequoin=" + id;
                            }
                        });
                    });
                });
                </script>
                <!-- Data table -->
            </div>
        </div>
    </div>
</div>
<?php $conn->close(); ?>