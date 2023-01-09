<?php
if (isset($_GET["deleteinvbill"])) {
    $id = $_GET["deleteinvbill"];

    $sql = "DELETE FROM invoicebill WHERE invbill_id = '$id'";
    $query = $conn->query($sql);
    if ($query) {
        $_SESSION['success'] = "ลบใบแจ้งหนี้/ใบวางบิลสำเร็จ!";
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
        <li class="breadcrumb-item active" aria-current="page">ใบแจ้งหนี้/ใบวางบิล</li>
    </ol>
</nav>
<hr>

<div class="container bg-secondary-addpay rounded-5">
    <div class="main-body p-md-5 text-white">
        <div class="container">
            <div id="listinvbill" class="p-3 p-md-5 text-white">
                <div class="text-center text-md-start">
                    <h3>ใบแจ้งหนี้/ใบวางบิล</h3>
                </div>

                <div class="my-4 my-md-3 text-center text-md-end">
                    <a class="btn btn-addpay px-md-4 rounded-3 " href="?page=invoicebill_add">
                        <i class="fa-solid fa-file-circle-plus"></i> สร้างใบแจ้งหนี้/ใบวางบิล</a>
                </div>

               

                <div class="p-3 p-md-5 bg-light rounded-5 shadow-lg" id="main_row">
                    <div class="table-responsive">
                        <table class="table" id="invbillTable">
                            <thead>
                                <tr class="rows align-center">
                                    <th scope="col" class="text-center" style="width:10%;">เลขที่</th>
                                    <th scope="col" class="text-center" style="width:14%;">วันที่ในใบวางบิล</th>
                                    <th scope="col" class="text-center" style="width:26%;">ชื่อลูกค้า</th>
                                    <th scope="col" class="text-center" style="width:11%;">จำนวนเงินรวม</th>
                                    <th scope="col" class="text-center" style="width:10%;">ตัวเลือก</th>
                                </tr>
                            </thead>
                            <?php

                            $sql = "SELECT * FROM invoicebill";
                            $query = $conn->query($sql);
                            while ($rows = $query->fetch_assoc()) {
                                echo '
                                    <tr>
                                        <td class="text-center">' . $rows["invbill_no"] . '</td>
                                        <td class="text-center">' . $rows["invbill_date"] . '</td>
                                        <td class="text-start">' . $rows["invbill_name"] . '</td>
                                        <td class="text-start">' . $rows["invbill_total"] . '</td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-dark dropdown-toggle px-2 px-md-4"
                                                    data-bs-toggle="dropdown" aria-expanded="false"><b>เลือก</b>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item"
                                                            href="view/dashboard/invoicebill_form.php?pdfinvbill_id=' . $rows["invbill_id"] . '">พิมพ์เอกสาร</a>
                                                    </li>
                                                    <li><a class="dropdown-item"
                                                            href="?page=invoicebill_edit&editinvbill=' .encode($rows["invbill_id"], secret_key())  . '">แก้ไข</a>
                                                    </li>
                                                    <li><a class="dropdown-item deleteinvbill" href="#" data-invbill-no="' . $rows["invbill_no"] . '" id="' . $rows["invbill_id"] . '" >ลบ</a></li>
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
                        $('#invbillTable').DataTable();

                        $(document).on('click', '.deleteinvbill', function() {
                            var id = $(this).attr("id");
                            var show_invbill_no = $(this).attr("data-invbill-no");
                            swal.fire({
                                title: 'ต้องการลบใบวางบิลนี้ !',
                                text: "เลขที่ใบวางบิล : " + show_invbill_no,
                                type: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#d33',
                                cancelButtonColor: '#3085d6',
                                confirmButtonText: 'yes!',
                                cancelButtonText: 'no'
                            }).then((result) => {
                                if (result.value) {
                                    window.location.href = "?page=invoicebill&deleteinvbill=" + id;
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