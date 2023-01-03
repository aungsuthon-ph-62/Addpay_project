<?php
session_start();
include("../../layout/head.php");
require_once("../../php/conn.php");

if (isset($_POST['action'])) {
    if ($_POST['action'] == 'create_invoicebill') {
        create_invoicebill();
        exit;
    }
}

function create_invoicebill()
{

    date_default_timezone_set('Asia/Bangkok');
    $date = date("Y-m-d H:i:s");
    global $conn;

    $input_invbill_no = mysqli_real_escape_string($conn, trim($_POST['input_invbill_no']));
    $input_invbill_date = mysqli_real_escape_string($conn, trim($_POST['input_invbill_date']));
    $input_invbill_name = mysqli_real_escape_string($conn, trim($_POST['input_invbill_name']));
    $input_invbill_address = mysqli_real_escape_string($conn, trim($_POST['input_invbill_address']));
    $input_invbill_cusid = mysqli_real_escape_string($conn, trim($_POST['input_invbill_cusid']));
    $input_invbill_sum = mysqli_real_escape_string($conn, trim($_POST['input_invbill_sum']));
    $input_invbill_total = mysqli_real_escape_string($conn, trim($_POST['input_invbill_total']));
    $input_invbill_remark = mysqli_real_escape_string($conn, trim($_POST['input_invbill_remark']));
    $input_invbill_uid = 1;

    $invbill_no_check_query = "SELECT * FROM invoicebill_appraisal WHERE invbill_no =  $input_invbill_no";
    $query = mysqli_query($conn, $invbill_no_check_query);
    $check = mysqli_fetch_assoc($query);

    if ($check) {
        $_SESSION['error'] = "เลขที่ใบเสนอราคากลางนี้มีในระบบแล้ว!";
        header("Location: invoicebill_add.php");
        exit;
    } else {
        $query = "INSERT INTO invoicebill_appraisal (invbill_no, invbill_date, invbill_name, invbill_address, invbill_cusid, invbill_sum, invbill_total, invbill_remark, invbill_create, invbill_uid)
            VALUES ('$input_invbill_no', '$input_invbill_date', '$input_invbill_name', '$input_invbill_address', '$input_invbill_cusid', '$input_invbill_sum', '$input_invbill_total', '$input_invbill_remark', '$date', '$input_invbill_uid')";

        if ($conn->query($query) === TRUE) {

            $last_id = $conn->insert_id;

            for ($count = 0; $count < $_POST["total_item"]; $count++) {

                $item_name = mysqli_real_escape_string($conn, trim($_POST['item_name'][$count]));
                $item_amount = mysqli_real_escape_string($conn, trim($_POST['item_amount'][$count]));
                $item_price = mysqli_real_escape_string($conn, trim($_POST['item_price'][$count]));
                $total_price = mysqli_real_escape_string($conn, trim($_POST['total_price'][$count]));
                $input_invbillde_create = $date;
                $input_invbillde_uid = 1;

                $query = "INSERT INTO invoicebill_details (invbilld_invbillid, invbilld_item, invbilld_price, invbilld_amount, invbilld_result, invbilld_create, invbilld_uid)
                    VALUES ('$last_id', '$item_name', '$item_price', '$item_amount', '$total_price', '$input_invbillde_create', '$input_invbillde_uid')";
                mysqli_query($conn, $query);
            }

            $_SESSION['success'] = "บันทึกใบเสนอราคากลางสำเร็จ!";
            header("Location: invoicebill_list.php");
            exit;
        } else {
            echo "Error: " . $query . "<br>" . $conn->error;
            $_SESSION['error'] = "เกิดข้อผิดพลาด! กรุณาลองอีกครั้ง";
            header("Location: invoicebill_add.php");
            exit;
        }
    }
    $conn->close();
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

<body>
    <?php require("../alert.php"); ?>
    <div class="container-fluid">
        <nav aria-label="breadcrumb" class="main-breadcrumb mt-2">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="../dashboard/invoicebill_list.php">ใบแจ้งหนี้/ใบวางบิล</a></li>
                <li class="breadcrumb-item active" aria-current="page">สร้างใบแจ้งหนี้/ใบวางบิล</li>
            </ol>
        </nav>
        <hr>
        <div>
            <h3>ข้อมูลใบแจ้งหนี้/ใบวางบิล</h3>
        </div>
        <form method="post" id="invoicebill_form" action="invoicebill_add.php" class="px-md-5 py-md-5">
            <div class="row g-3 align-items-center mb-3">
                <div class="col-md-3">
                    <label for="input_invbill_no" class="col-form-label">เลขที่ No.</label>
                </div>
                <div class="col-auto">
                    <input type="number" id="input_invbill_no" name="input_invbill_no" class="form-control " required>
                </div>
            </div>
            <div class="row g-3 align-items-center mb-3">
                <div class="col-md-3">
                    <label for="input_invbill_date" class="col-form-label">วันที่ date.</label>
                </div>
                <div class="col-auto">
                    <input type="date" id="input_invbill_date" name="input_invbill_date" class="form-control " required>
                </div>
            </div>
            <div class="row g-3 align-items-center mb-3">
                <div class="col-md-3 ">
                    <label for="input_invbill_name" class="col-form-label">ชื่อลูกค้า :</label>
                </div>

                <div class="col-md-8">
                    <input type="text" id="input_invbill_name" name="input_invbill_name" class="form-control " required>
                </div>
            </div>
            <div class=" row g-3 align-items-center mb-3">
                <div class="col-md-3">
                    <label for="input_invbill_address" class="col-form-label">ที่อยู่ :</label>
                </div>
                <div class="col-md-8">
                    <textarea class="form-control" id="input_invbill_address" name="input_invbill_address" rows="3" required></textarea>
                </div>
            </div>
            <div class="row g-3 mb-3">
                <div class="col-md-3 ">
                    <label for="input_invbill_cusid" class="col-form-label">เลขประจำตัวผู้เสียภาษี :</label>
                </div>
                <div class="col-md-8">
                    <input type="text" id="input_invbill_cusid" name="input_invbill_cusid" class="form-control " required>

                </div>
            </div>
            <div class="row g-3 align-items-center mb-3">
                <div class="col-md-3 ">
                    <label for="itemtitle" class="col-form-label">รายการใบแจ้งหนี้/ใบวางบิล :</label>
                </div>
                <div class="border border-secondary rounded-3 py-md-4 px-md-4">
                    <div class="table-responsive text-center">
                        <table id="invtation-item-table" class="table ">
                            <tr>
                                <th width="7%">ลำดับที่ <br>Item</th>
                                <th width="20%">รายการ <br> Order </th>
                                <th width="10%">วันที่ใบแจ้งหนี้/ใบกำกับภาษี<br> Invoice Date</th>
                                <th width="10%">กำหนดชำระ <br> Due Date</th>
                                <th width="10%">จำนวนก่อนภาษีมูลค่าเพิ่ม<br>Amount</th>
                                <th width="10%">ภาษีมูลค่าเพิ่ม<br>Vat</th>
                                <th width="10%">จำนวนเงินรวม <br> Total Amount</th>
                                <th width="5%">ลบ</th>
                            </tr>

                            <tr id="row_id_1">
                                <td><span id="sr_no"></span></td>
                                <td><input type="text" name="item_order[]" id="item_order1" class="form-control input-sm" required /></td>
                                <td><input type="date" name="item_inv_date[]" id="item_inv_date1" data-srno="1" class="form-control input-sm item_inv_date" /></td>
                                <td><input type="date" name="item_due_date[]" id="item_due_date1" data-srno="1" class="form-control input-sm number_only item_due_date" step="any" /></td>
                                <td><input type="number" name="item_amount[]" id="item_amount1" data-srno="1" class="form-control input-sm item_amount" required /></td>
                                <td><input type="number" name="item_vat[]" id="item_vat1" class="form-control input-sm item_vat" required readonly/></td>
                                <td><input type="number" name="item_total_amount[]" id="item_total_amount1" data-srno="1" class="form-control input-sm item_total_amount" required  readonly/></td>
                            </tr>
                        </table>
                        <div class="text-center">
                            <button type="button" id="add_row" class="btn btn-success px-4 rounded-pill fs-5 fw-bold "><i class="fa fa-plus-circle text-white"></i> เพิ่มรายการ</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="row g-3  mb-3">
                        <div class="col-md-3 ">
                            <label for="input_invbill_remark" class="col-form-label">หมายเหตุ :</label>
                        </div>
                        <div class="col-md-8">
                            <textarea class="form-control" id="input_invbill_remark" name="input_invbill_remark" rows="3"></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row g-3 align-items-center mb-3">
                        <div class="col-md-6 ">
                            <label for="input_invbill_afterdis" class="col-form-label">ยอดรวมทั้งสิ้น (บาท):</label>
                        </div>
                        <div class="col-md-5">
                            <input type="number" id="input_invbill_afterdis" name="input_invbill_afterdis" class="form-control " placeholder="0.00" readonly>
                        </div>
                    </div>
                    <div class="row g-3 align-items-center mb-3">
                        <div class="col-md-6">
                            <label for="input_invbill_sum" class="col-form-label">จำนวนเอกสารรวม </label>
                        </div>
                        <div class="col-md-5">
                            <input type="number" id="input_invbill_sum" name="input_invbill_sum" class="form-control ">
                        </div>
                        <div class="col-md-1 text-end">
                            <label for="input_invbill_sum" class="col-form-label">ฉบับ</label>
                        </div>
                    </div>



                </div>
            </div>
            <div class="mx-auto d-flex justify-content-end">
                <button type="reset" class="col-md-3 btn btn-outline-danger btn btn-outline-success p-2 mt-2 rounded-pill fs-5 fw-bold"><i class="fa-solid fa-eraser"></i> ล้างข้อมูล</button>
                <button type="submit" name="create_invoicebill" id="create_invoicebill" value="Create" class="ms-3 col-md-3 btn btn-outline-success p-2 mt-2 rounded-pill fs-5 fw-bold">ต่อไป
                    <i class="fa-solid fa-angles-right"></i></button>
                <input type="hidden" name="total_item" id="total_item" value="1" />
                <input type="hidden" name="action" value="create_invoicebill">
            </div>

        </form>
        <script>
            $(document).ready(function() {
                var final_total_price = $('#final_total_price').text();
                var count = 1;
                var total_item = 1;

                $(document).on('click', '#add_row', function() {
                    count++;
                    total_item++;
                    $('#total_item').val(total_item);
                    var html_code = '';
                    html_code += '<tr id="row_id_' + count + '">';
                    html_code += '<td><span id="sr_no"></span></td>';

                    html_code += '<td><input type="text" name="item_order[]" id="item_order' + count +
                        '" class="form-control input-sm" required/></td>';
                    html_code +=
                        '<td><input type="date" name="item_inv_date[]" id="item_inv_date' +
                        count + '" data-srno="' + count +
                        '" class="form-control input-sm  item_inv_date" required/></td>';
                    html_code += '<td><input type="date" name="item_amount[]" id="item_amount' +
                        count + '" data-srno="' + count +
                        '" class="form-control input-sm  item_amount" required step="any"/></td>';
                    html_code +=
                        '<td><input type="number" name="total_vat[]" id="total_vat' +
                        count + '" data-srno="' + count +
                        '" class="form-control input-sm total_vat" required /></td>';
                    html_code +=
                        '<td><input type="number" name="item_total_amount[]" id="item_total_amount' +
                        count + '" data-srno="' + count +
                        '" class="form-control input-sm number_only item_total_amount" required/></td>';
                    // html_code += '<td><input type="number" name="item_remark[]" id="item_remark' +
                    //     count + '" data-srno="' + count +
                    //     '" class="form-control input-sm number_only item_remark" required step="any"/></td>';
                    html_code +=
                        '<td><input type="text" name="total_price[]" id="total_price' +
                        count + '" data-srno="' + count +
                        '" class="form-control input-sm total_price" readonly /></td>';

                    html_code += '<td><button type="button" name="remove_row" id="' + count +
                        '" class="btn btn-danger btn-xs remove_row">X</button></td>';
                    html_code += '</tr>';
                    $('#invtation-item-table').append(html_code);
                });

                $(document).on('click', '.remove_row', function() {
                    var row_id = $(this).attr("id");
                    $('#row_id_' + row_id).remove();
                    total_item--;
                    $('#total_item').val(total_item);
                    cal_final_total(count);

                });

                function cal_final_total(count) {
                    var final_total_price = 0;
                    for (j = 1; j <= count; j++) {
                        var quantity = 0;
                        var price = 0;
                        var total_price = 0;
                        quantity = $('#item_amount' + j).val();
                        if (quantity > 0) {
                            price = $('#item_price' + j).val();
                            if (price > 0) {
                                total_price = parseFloat(quantity) * parseFloat(price);
                                $('#total_price' + j).val(
                                    total_price
                                    .toFixed(2));

                                final_total_price = (final_total_price + total_price);

                            }
                        }
                    }
                    $('#input_invbill_sum').val(final_total_price.toFixed(2));
                    var discount = 0;
                    var afterdis = 0;
                    var vat7per = 0;
                    var aftervat = 0;
                    discount = $('#input_invbill_specialdis').val();
                    afterdis = final_total_price - discount;
                    $('#input_invbill_afterdis').val(afterdis.toFixed(2));
                    vat7per = (afterdis * 0.07);
                    $('#input_invbill_vat').val(vat7per.toFixed(2));
                    aftervat = (afterdis + vat7per);
                    $('#input_invbill_total').val(aftervat.toFixed(2));
                }

                $(document).on('change', '.item_price', function() {
                    cal_final_total(count);
                });

                $(document).on('change', '.item_amount', function() {
                    cal_final_total(count);
                });

                $(document).on('change', '#input_invbill_specialdis', function() {
                    cal_final_total(count);
                });

            });
        </script>
    </div>
</body>