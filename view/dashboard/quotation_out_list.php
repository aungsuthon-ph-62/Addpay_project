<?php
if (isset($_GET["deletequoout"])) {
    
    $id = $_GET["deletequoout"];

    $sql = "DELETE FROM quotation_out WHERE quoout_id = '$id'";
    $query = $conn->query($sql);
    
    if ($query) {
        $_SESSION['success'] = "ลบใบเสนอราคาสำเร็จ!";
        echo "<script> window.history.back()</script>";
        exit;
    }
    $_SESSION['error'] = "เกิดข้อผิดพลาด! กรุณาลองอีกครั้ง";
    echo "<script> window.history.back()</script>";
    exit;
}
unset($_SESSION['svinput']);unset($_SESSION['deli']);unset($_SESSION['spe']);
?>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index">หน้าหลัก</a></li>
        <li class="breadcrumb-item active" aria-current="page">ใบเสนอราคาออก</li>
    </ol>
</nav>
<hr>
<div class="container bg-secondary-addpay rounded-5">
    <div class="main-body py-md-5 px-md-1 text-white">
        <div class="container">
            <div id="listquotation" class="py-4 p-md-5 text-white">
                <div class="text-center text-md-start">
                    <h3>ใบเสนอราคาออก</h3>
                </div>

                <div class="my-4 my-md-3 text-center text-md-end">
                    <a class="btn btn-addpay px-md-4 rounded-3 " href="?page=quo_out_add">
                        <i class="fa-solid fa-file-circle-plus"></i> สร้างใบเสนอราคาออก</a>
                </div>

                <div class="p-3 p-md-5 bg-light rounded-5 shadow-lg" id="main_row">
                    <div class="table-responsive text-dark">
                        <table class="table table-hover" id="quotationoutTable">
                            <thead>
                                <tr class="rows align-center">
                                    <th scope="col" class="text-start" style="width:10%">เลขที่</th>
                                    <th scope="col" class="text-center" style="width:20%">วันที่ในใบเสนอราคา</th>
                                    <th scope="col" class="text-start" style="width:45%">ชื่อลูกค้า</th>
                                    <th scope="col" class="text-center" style="width:15%">จำนวนเงินรวม</th>
                                    <th scope="col" class="text-center" style="width:10%">ตัวเลือก</th>
                                </tr>
                            </thead>
                            <?php

                            $sql = "SELECT * FROM quotation_out";
                            $query = $conn->query($sql);
                            while ($rows = $query->fetch_assoc()) {
                                echo '
                                    <tr>
                                        <td class="text-start">' . $rows["quoout_no"] . '</td>
                                        <td class="text-center">' . ConvDate($rows["quoout_date"]) . '</td>
                                        <td class="text-start">' . $rows["quoout_name"] . '</td>
                                        <td class="text-end">' . number_format($rows["quoout_total"], 2) . '</td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-dark dropdown-toggle px-2 px-md-4"
                                                    data-bs-toggle="dropdown" aria-expanded="false"><b>เลือก</b>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item"
                                                        href="view/dashboard/quotation_out_form.php?pdfquoout_id=' . $rows["quoout_id"] . '" target="_blank"">พิมพ์เอกสาร</a>
                                                    </li>
                                                    <li><a class="dropdown-item"
                                                            href="?page=quo_out_edit&editquoout=' . encode($rows["quoout_id"], secret_key()) . '">แก้ไข</a>
                                                    </li>
                                                    <li><a class="dropdown-item deletequoout" href="#" data-quoout-no="' . $rows["quoout_no"] . '" id="' . $rows["quoout_id"] . '" >ลบ</a></li>
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
                    $('#quotationoutTable').DataTable();

                    $(document).on('click', '.deletequoout', function() {
                        var id = $(this).attr("id");
                        var show_quoout_no = $(this).attr("data-quoout-no");
                        swal.fire({
                            title: 'ต้องการลบใบเสนอราคานี้ !',
                            text: "เลขที่ใบเสนอราคา : " + show_quoout_no,
                            type: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#d33',
                            cancelButtonColor: '#3085d6',
                            confirmButtonText: 'yes!',
                            cancelButtonText: 'no'
                        }).then((result) => {
                            if (result.value) {
                                window.location.href = "?deletequoout=" + id;
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