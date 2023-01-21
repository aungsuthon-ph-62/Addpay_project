<?php
if (isset($_GET["deleteexpenses"])) {
    $id = $_GET["deleteexpenses"];

    $sql = "SELECT expenses_file FROM expenses WHERE expenses_id = '$id'";
    $query = $conn->query($sql);
    $row = $query->fetch_assoc();
    $oldfile = $row['expenses_file'];

    $sql = "DELETE FROM expenses WHERE expenses_id = '$id'";
    $query = $conn->query($sql);

    if ($query) {

        unlink("uploadfile/expensesfile/$oldfile");
        $_SESSION['success'] = "ลบใบสำคัญจ่ายสำเร็จ!";
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
        <li class="breadcrumb-item active" aria-current="page">ใบสำคัญจ่าย</li>
    </ol>
</nav>
<hr>
<div class="container bg-secondary-addpay rounded-5">
    <div class="main-body py-md-5 px-md-1 text-white">
        <div class="container">
            <div id="" class="py-4 p-md-5 text-white">
                <div class="text-center text-md-start">
                    <h3>ใบสำคัญจ่าย</h3>
                </div>
                <div class="my-4 my-md-3 text-center text-md-end">
                    <a class="btn btn-addpay px-md-4 rounded-3 " href="?page=expenses_add">
                        <i class="fa-solid fa-file-circle-plus"></i> เพิ่มข้อมูล</a>
                </div>
                <div class="p-3 p-md-5 bg-light rounded-5 shadow-lg" id="main_row">
                    <div class="table-responsive text-dark">
                        <table class="table table-hover" id="expensesTable">
                            <thead>
                                <tr class="align-center" class="rows">
                                    <th style="width:15%" scope="col">เลขที่</th>
                                    <th style="width:15%" scope="col">วันที่จ่าย</th>
                                    <th style="width:30%" scope="col">รายการ</th>
                                    <th style="width:20%" scope="col">จำนวนเงิน</th>
                                    <th style="width:10%" scope="col">ประเภท</th>
                                    <th style="width:10%" scope="col">ตัวเลือก</th>
                                </tr>
                            </thead>

                            <?php

                            $sql = "SELECT * FROM expenses";
                            $query = $conn->query($sql);
                            $nr=0;
                            while ($rows = $query->fetch_assoc()) {
                                $nr++;
                                echo '
                                    <tr>
                                        <td>'.$nr.'</td>
                                        <td>' . $rows["expenses_date"] . '</td>
                                        <td>' . $rows["expenses_list"] . '</td>
                                        <td>' . $rows["expenses_price"] . '</td>
                                        <td>' . $rows["expenses_type"] . '</td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-dark dropdown-toggle px-2 px-md-4"
                                                    data-bs-toggle="dropdown" aria-expanded="false"><b>เลือก</b>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" target="_blank"
                                                            href="uploadfile/expensesfile/' . $rows["expenses_file"] . '">เปิดเอกสาร</a>
                                                    </li>
                                                    <li><a class="dropdown-item"
                                                            href="?page=expenses_edit&editexpenses=' . encode($rows["expenses_id"], secret_key()) . '">แก้ไข</a>
                                                    </li>
                                                    <li><a class="dropdown-item deleteexpenses" data-expenses-list="'.$rows["expenses_list"].'" id="' . $rows["expenses_id"] . '" >ลบ</a></li>
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
                    $('#expensesTable').DataTable();
                });

                $(document).on('click', '.deleteexpenses', function() {
                    var id = $(this).attr("id");
                    var show_expenses_list = $(this).attr("data-expenses-list");
                    swal.fire({
                        title: 'ต้องการลบรายการนี้ !',
                        text: "รายการ : " + show_expenses_list,
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'yes!',
                        cancelButtonText: 'no'
                    }).then((result) => {
                        if (result.value) {
                            window.location.href = "?page=expenses&deleteexpenses=" + id;
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