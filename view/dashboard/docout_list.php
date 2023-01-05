<?php
if (isset($_GET["deletedocout"])) {
    $id = $_GET["deletedocout"];

    $sql = "DELETE FROM docout WHERE docout_id = '$id'";
    $query = $conn->query($sql);

    if ($query) {
        $_SESSION['success'] = "ลบใบเสนอราคากลางสำเร็จ!";
        header("Location: docout_list.php");
        exit;
    }

    $_SESSION['error'] = "เกิดข้อผิดพลาด! กรุณาลองอีกครั้ง";
    header("Location: docout_list.php");
    exit;
}

?>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index">หน้าหลัก</a></li>
        <li class="breadcrumb-item"><a href="?page=doc">หนังสือ</a></li>
        <li class="breadcrumb-item active" aria-current="page">หนังสือออก</li>
    </ol>
</nav>
<hr>

<div class="container bg-secondary-addpay rounded-5">
    <div class="main-body p-md-5 text-white">
        <div class="container">
            <div id="listquotation" class="p-3 p-md-5 text-white">
                <div class="text-center text-md-start">
                    <h3>หนังสือออก</h3>
                </div>

                <div class="my-4 my-md-3 text-center text-md-end">
                    <a class="btn btn-addpay px-md-4 rounded-3 " href="?page=doc_out_add">
                        <i class="fa-solid fa-file-circle-plus"></i> เพิ่มข้อมูล</a>
                </div>

                <div class="p-3 p-md-5 bg-light rounded-5 shadow-lg" id="main_row">
                    <div class="table-responsive">
                        <table class="table" id="docoutTable">
                            <thead>
                                <tr class="align-center" class="rows">
                                    <th style="width:17%" scope="col">เลขที่</th>
                                    <th style="width:15%" scope="col">วันที่</th>
                                    <th style="width:30%" scope="col">เรื่อง</th>
                                    <th style="width:28%" scope="col">เรียน (ถึงใคร)</th>
                                    <th style="width:10%" scope="col">ตัวเลือก</th>
                                </tr>
                            </thead>
                            <?php
                            require_once "php/action.php";
                            require_once "php/key.inc.php";
                            $sql = "SELECT * FROM docout";
                            $query = $conn->query($sql);
                            while ($rows = $query->fetch_assoc()) {
                                echo '
                                    <tr>
                                        <td>' . $rows["docout_no"] . '</td>
                                        <td>' . $rows["docout_date"] . '</td>
                                        <td>' . $rows["docout_title"] . '</td>
                                        <td>' . $rows["docout_to"] . '</td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-dark dropdown-toggle px-2 px-md-4"
                                                    data-bs-toggle="dropdown" aria-expanded="false"><b>เลือก</b>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item"
                                                            href="view/dashboard/docout_form.php?pdfdocout=' . $rows["docout_id"] . '" target="_blank">พิมพ์เอกสาร</a>
                                                    </li>
                                                    <li><a class="dropdown-item"
                                                            href="?page=doc_out_edit&editdocout=' . encode($rows["docout_id"], secret_key()) . '">แก้ไข</a>
                                                    </li>
                                                    <li><a class="dropdown-item deletedocout" href="#" data-docout-no="' . $rows["docout_no"] . '" id="' . $rows["docout_id"] . '" >ลบ</a></li>
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
                        $('#docoutTable').DataTable();
                    });

                    $(document).on('click', '.deletedocout', function() {
                        var id = $(this).attr("id");
                        var show_docout_no = $(this).attr("data-docout-no");
                        swal.fire({
                            title: 'ต้องการลบหนังสืออกกนี้ !',
                            text: "เลขที่หนังสืออก : " + show_docout_no,
                            type: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#d33',
                            cancelButtonColor: '#3085d6',
                            confirmButtonText: 'yes!',
                            cancelButtonText: 'no'
                        }).then((result) => {
                            if (result.value) {
                                window.location.href = "?deletedocout=" + id;
                            }
                        });
                    });
                </script>
                <!-- Data table -->
            </div>
        </div>
    </div>
</div>