<?php
if (isset($_GET["deleteinvtax"])) {
    $id = $_GET["deleteinvtax"];

    $sql = "DELETE FROM invoicetax WHERE invtax_id = '$id'";
    $query = $conn->query($sql);
    if ($query) {
        $_SESSION['success'] = "ลบใบแจ้งหนี้/ใบกำกับภาษีสำเร็จ!";
        header("Location: invoicetax_list.php");
        exit;
    }
    $_SESSION['error'] = "เกิดข้อผิดพลาด! กรุณาลองอีกครั้ง";
    header("Location: invoicetax_list.php");
    exit;
}

?>
<style>
    body {
        font-family: "Kanit", sans-serif;
        font-family: "Noto Sans", sans-serif;
        font-family: "Noto Sans Thai", sans-serif;
        font-family: "Poppins", sans-serif;
        font-family: "Prompt", sans-serif;
    }

    .btn-group {
        white-space: nowrap;
    }

    @media (max-width: 767px) {
        .table-responsive .dropdown-menu {
            position: static !important;
        }
    }

    @media (min-width: 768px) {
        .table-responsive {
            overflow: inherit;
        }
    }
</style>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index">หน้าหลัก</a></li>
        <li class="breadcrumb-item active" aria-current="page">ใบแจ้งหนี้/ใบกำกับภาษี</li>
    </ol>
</nav>
<hr>

<div class="container bg-secondary-addpay rounded-5">
    <div class="main-body py-md-5 px-md-1 text-white">
        <div class="container">
            <div id="listinvtax" class="container pb-md-0 mb-5">
                <div class="text-center text-md-start">
                    <h3>ใบแจ้งหนี้/ใบกำกับภาษี</h3>
                </div>

                <div class="my-4 my-md-3 text-center text-md-end">
                    <a class="btn btn-addpay px-md-4 rounded-3 " role="button" href="?page=invoicetax_add">
                        <i class="fa-solid fa-file-circle-plus"></i>
                        สร้างใบแจ้งหนี้/ใบกำกับภาษี</a>
                </div>

                <div class="p-3 p-md-5 bg-light rounded-5 shadow-lg" id="main_row">
                    <div class="table-responsive">
                        <table class="table" id="invtaxTable">
                            <thead>
                                <tr class="rows align-center">
                                    <th scope="col" class="text-center" style="width:10%;">เลขที่</th>
                                    <th scope="col" class="text-center" style="width:14%;">วันที่ในใบกำกับภาษี</th>
                                    <th scope="col" class="text-center" style="width:26%;">ชื่อลูกค้า</th>
                                    <th scope="col" class="text-center" style="width:11%;">จำนวนเงินรวม</th>
                                    <th scope="col" class="text-center" style="width:10%;">ตัวเลือก</th>
                                </tr>
                            </thead>
                            <?php

                            $sql = "SELECT * FROM invoicetax";
                            $query = $conn->query($sql);
                            while ($rows = $query->fetch_assoc()) {
                                echo '
                                    <tr>
                                        <td class="text-center">' . $rows["invtax_no"] . '</td>
                                        <td class="text-center">' . $rows["invtax_date"] . '</td>
                                        <td class="text-start">' . $rows["invtax_name"] . '</td>
                                        
                                        <td class="text-start">' . number_format($rows["invtax_total"], 2) . '</td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-dark dropdown-toggle px-2 px-md-4"
                                                    data-bs-toggle="dropdown" aria-expanded="false"><b>เลือก</b>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item"
                                                            href="view/dashboard/invoicetax_form.php?pdfinvtax_id=' . $rows["invtax_id"] . '" " target="_blank">พิมพ์เอกสาร</a>
                                                    </li>
                                                    <li><a class="dropdown-item"
                                                            href="?page=invoicetax_edit&editinvtax=' . $rows["invtax_id"] . '">แก้ไข</a>
                                                    </li>
                                                    <li><a class="dropdown-item deleteinvtax" href="#" data-invtax-no="' . $rows["invtax_no"] . '" id="' . $rows["invtax_id"] . '" >ลบ</a></li>
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
                        $('#invtaxTable').DataTable();

                        $(document).on('click', '.deleteinvtax', function() {
                            var id = $(this).attr("id");
                            var show_invtax_no = $(this).attr("data-invtax-no");
                            swal.fire({
                                title: 'ต้องการลบใบแจ้งหนี้/ใบกำกับภาษีนี้ !',
                                text: "เลขที่ใบแจ้งหนี้/ใบกำกับภาษี : " + show_invtax_no,
                                type: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#d33',
                                cancelButtonColor: '#3085d6',
                                confirmButtonText: 'yes!',
                                cancelButtonText: 'no'
                            }).then((result) => {
                                if (result.value) {
                                    window.location.href = "?deleteinvtax=" + id;
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