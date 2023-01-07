<?php
if (isset($_POST['action'])) {
    if ($_POST['action'] == 'create_quotation') {

        date_default_timezone_set('Asia/Bangkok');
        $date = date("Y-m-d H:i:s");
        global $conn;

        $input_quo_no = mysqli_real_escape_string($conn, trim($_POST['input_quo_no']));
        $input_quo_date = mysqli_real_escape_string($conn, trim($_POST['input_quo_date']));
        $input_quo_namepj = mysqli_real_escape_string($conn, trim($_POST['input_quo_namepj']));
        $input_quo_name = mysqli_real_escape_string($conn, trim($_POST['input_quo_name']));
        $input_quo_address = mysqli_real_escape_string($conn, trim($_POST['input_quo_address']));
        $input_quo_sum = mysqli_real_escape_string($conn, trim($_POST['input_quo_sum']));
        $input_quo_specialdis = mysqli_real_escape_string($conn, trim($_POST['input_quo_specialdis']));
        $input_quo_afterdis = mysqli_real_escape_string($conn, trim($_POST['input_quo_afterdis']));
        $input_quo_vat = mysqli_real_escape_string($conn, trim($_POST['input_quo_vat']));
        $input_quo_deli = mysqli_real_escape_string($conn, trim($_POST['input_quo_deli']));
        $input_quo_total = mysqli_real_escape_string($conn, trim($_POST['input_quo_total']));
        $uid = $_SESSION['id'];

        $quo_no_check_query = "SELECT * FROM quotation_appraisal WHERE quo_no =  $input_quo_no";
        $query = $conn->query($quo_no_check_query);
        $check = $query->fetch_assoc();

        if ($check) {
            $_SESSION['error'] = "เลขที่ใบเสนอราคากลางนี้มีในระบบแล้ว!";
            echo "<script> window.history.back()</script>";
            exit;
        } else {
            $query = "INSERT INTO quotation_appraisal (quo_no, quo_date, quo_namepj, quo_name, quo_address, quo_sum, quo_specialdis, quo_afterdis, quo_vat, quo_deli, quo_total, quo_create, quo_uid)
                VALUES ('$input_quo_no', '$input_quo_date', '$input_quo_namepj', '$input_quo_name', '$input_quo_address', '$input_quo_sum', '$input_quo_specialdis', '$input_quo_afterdis', '$input_quo_vat','$input_quo_deli', '$input_quo_total', '$date', '$uid')";

            if ($conn->query($query) === TRUE) {

                $last_id = $conn->insert_id;

                for ($count = 0; $count < $_POST["total_item"]; $count++) {

                    $item_name = mysqli_real_escape_string($conn, trim($_POST['item_name'][$count]));
                    $item_amount = mysqli_real_escape_string($conn, trim($_POST['item_amount'][$count]));
                    $item_price = mysqli_real_escape_string($conn, trim($_POST['item_price'][$count]));
                    $total_price = mysqli_real_escape_string($conn, trim($_POST['total_price'][$count]));

                    $query = "INSERT INTO quotation_appraisal_details (quode_quoid, quode_item, quode_amount, quode_price, quode_result, quode_create, quode_uid)
                        VALUES ('$last_id', '$item_name', '$item_amount', '$item_price', '$total_price', '$date', '$uid')";
                    $conn->query($query);
                }

                $_SESSION['success'] = "บันทึกใบเสนอราคากลางสำเร็จ!";
                echo "<script> window.location.href='?page=quo'</script>";
                exit;
            } else {

                $_SESSION['error'] = "เกิดข้อผิดพลาด! กรุณาลองอีกครั้ง";
                echo "<script> window.history.back()</script>";
                exit;
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
        <li class="breadcrumb-item"><a href="?page=quo">ใบเสนอราคากลาง</a></li>
        <li class="breadcrumb-item active" aria-current="page">สร้างใบเสนอราคากลาง</li>
    </ol>
</nav>
<hr>

<div class="container bg-secondary-addpay rounded-5">
    <div class="main-body py-md-5 px-md-1 text-white">
        <div id="paperquotation" class="container p-3 p-md-5">
            <div class="p-4 p-md-5 bg-white rounded-5 shadow-lg">
                <div class="text-center text-md-start text-dark my-3">
                    <h3>สร้างใบเสนอราคากลาง</h3>
                </div>
                <form method="post" id="quotation_form" action="?page=quo_add" class="mt-md-5">
                    <div class="row align-items-center text-dark px-md-5 mb-3">
                        <div class="col-md-3 text-md-end">
                            <h6 class="col-form-label">เลขที่ No.</h6>
                        </div>
                        <div class="col-auto">
                            <input type="number" id="input_quo_no" name="input_quo_no" class="form-control " pattern="[0-9]{1,}" title="กรุณากรอกตัวเลข 0-9 อย่างน้อย 1 ตัว" required>
                        </div>

                    </div>
                    <div class="row align-items-center text-dark px-md-5 mb-3">
                        <div class="col-md-3 text-md-end">
                            <h6 class="col-form-label">วันที่ date.</h6>
                        </div>
                        <div class="col-auto">
                            <input type="date" id="input_quo_date" name="input_quo_date" class="form-control " required>
                        </div>
                    </div>
                    <div class="row align-items-center text-dark px-md-5 mb-3">
                        <div class="col-md-3 text-md-end">
                            <h6 class="col-form-label">ชื่อโครงการ :</h6>
                        </div>

                        <div class="col-md-8">
                            <input type="text" id="input_quo_namepj" name="input_quo_namepj" class="form-control " required>
                        </div>
                    </div>
                    <div class=" row align-items-center text-dark px-md-5 mb-3">
                        <div class="col-md-3 text-md-end">
                            <h6 class="col-form-label">ชื่อลูกค้า/หน่วยงาน :</h6>
                        </div>
                        <div class="col-md-8">
                            <input type="text" id="input_quo_name" name="input_quo_name" class="form-control " required>
                        </div>
                    </div>
                    <div class="row align-items-center text-dark px-md-5 mb-3">
                        <div class="col-md-3 text-md-end">
                            <h6 class="col-form-label">ที่อยู่ :</h6>
                        </div>
                        <div class="col-md-8">
                            <textarea class="form-control" id="input_quo_address" name="input_quo_address" rows="3" required></textarea>
                        </div>
                    </div>
                    <div class="row align-items-center text-dark px-md-5 mb-3">
                        <div class="col-md-3">
                            <h6>รายการใบเสนอราคากลาง :</h6>
                        </div>
                        <div class="border border-secondary rounded-3 p-4">
                            <div class="table-responsive">
                                <table id="quotation-item-table" class="table ">
                                    <tr>
                                        <th width="7%">ลำดับ <br>Number</th>
                                        <th width="40%">รายการ <br> Description </th>
                                        <th width="13%">จำนวน <br> Amount</th>
                                        <th width="15%">ราคา/หน่วย <br> Price/Unit</th>
                                        <th width="20%">จำนวนเงิน(บาท)</th>
                                        <th width="5%">ลบ</th>
                                    </tr>

                                    <tr id="row_id_1">
                                        <td><span id="sr_no"></span></td>
                                        <td><input type="text" name="item_name[]" id="item_name1" class="form-control input-sm" required />
                                        </td>
                                        <td>
                                            <input type="number" name="item_amount[]" id="item_amount1" data-srno="1" class="form-control input-sm item_amount" required />
                                        </td>
                                        <td>
                                            <input type="number" name="item_price[]" id="item_price1" data-srno="1" class="form-control input-sm number_only item_price" step="any" required />
                                        </td>
                                        <td>
                                            <input type="number" name="total_price[]" id="total_price1" data-srno="1" class="form-control input-sm total_price" readonly />
                                        </td>
                                        <td></td>
                                    </tr>
                                </table>
                                <div class="text-center">
                                    <button type="button" id="add_row" class="btn btn-addpay px-md-4 rounded-3" id="add_sub"><i class="fa fa-plus-circle text-white"></i> เพิ่มรายการ</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row align-items-center text-dark px-md-5 mb-3">
                                <div class="col-md-6 text-md-end">
                                    <h6>ค่าขนส่ง(บาท) :</h6>
                                </div>
                                <div class="col-md-6">
                                    <input type="number" id="input_quo_deli" name="input_quo_deli" class="form-control" placeholder="0.00" title="กรุณากรอกค่าขนส่ง หากมี">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row align-items-center text-dark px-md-5 mb-3">
                                <div class="col-md-6 text-md-end">
                                    <label for="input_quo_sum" class="col-form-label">รวมเป็นเงิน(บาท) :</label>
                                </div>

                                <div class="col-md-6">
                                    <input type="number" id="input_quo_sum" name="input_quo_sum" class="form-control " placeholder="0.00" readonly>
                                </div>
                            </div>
                            <div class="row align-items-center text-dark px-md-5 mb-3">
                                <div class="col-md-6 text-md-end">
                                    <label for="input_quo_specialdis" class="col-form-label text-danger">หักส่วนลดพิเศษ(บาท)
                                        :</label>
                                </div>

                                <div class="col-md-6">
                                    <input type="number" id="input_quo_specialdis" name="input_quo_specialdis" class="form-control " placeholder="0.00" title="กรุณากรอกส่วนลด หากมี">
                                </div>
                            </div>
                            <div class="row align-items-center text-dark px-md-5 mb-3">
                                <div class="col-md-6 text-md-end">
                                    <label for="input_quo_afterdis" class="col-form-label">ยอดรวมหลังหักส่วนลด(บาท)
                                        :</label>
                                </div>

                                <div class="col-md-6">
                                    <input type="number" id="input_quo_afterdis" name="input_quo_afterdis" class="form-control " placeholder="0.00" readonly>
                                </div>
                            </div>
                            <div class="row align-items-center text-dark px-md-5 mb-3">
                                <div class="col-md-6 text-md-end">
                                    <label for="input_quo_vat" class="col-form-label">ภาษีมูลค่าเพิ่ม 7%(บาท) :</label>
                                </div>

                                <div class="col-md-6">
                                    <input type="number" id="input_quo_vat" name="input_quo_vat" class="form-control " placeholder="0.00" readonly>
                                </div>
                            </div>
                            <div class="row align-items-center text-dark px-md-5 mb-3">
                                <div class="col-md-6 text-md-end">
                                    <label for="input_quo_total" class="col-form-label">จํานวนเงินรวมทั้งสิ้น(บาท) :</label>
                                </div>

                                <div class="col-md-6">
                                    <input type="number" id="input_quo_total" name="input_quo_total" class="form-control " placeholder="0.00" readonly>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-5">
                        <div class="col-md-12">
                            <div class="d-flex justify-content-end">
                                <button type="reset" class="btn bg-secondary-addpay text-white me-3"><i class="fa-solid fa-arrow-rotate-left"></i> ล้างข้อมูล</button>
                                <button type="submit" name="action" value="create_quotation" class="btn btn-addpay text-white">บันทึก <i class="fa-solid fa-cloud-arrow-up"></i></button>
                            </div>
                        </div>
                        <input type="hidden" name="total_item" id="total_item" value="1" />
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

                            html_code +=
                                '<td><input type="text" name="item_name[]" id="item_name' + count +
                                '" class="form-control input-sm" required/></td>';
                            html_code +=
                                '<td><input type="number" name="item_amount[]" id="item_amount' +
                                count + '" data-srno="' + count +
                                '" class="form-control input-sm number_only item_amount" required/></td>';
                            html_code +=
                                '<td><input type="number" name="item_price[]" id="item_price' +
                                count + '" data-srno="' + count +
                                '" class="form-control input-sm number_only item_price" required step="any"/></td>';
                            html_code +=
                                '<td><input type="text" name="total_price[]" id="total_price' +
                                count + '" data-srno="' + count +
                                '" class="form-control input-sm total_price" readonly /></td>';
                            html_code +=
                                '<td><button type="button" name="remove_row" id="' + count +
                                '" class="btn btn-danger btn-xs remove_row">X</button></td>';
                            html_code += '</tr>';
                            $('#quotation-item-table').append(html_code);
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
                                        total_price = (parseFloat(quantity) * parseFloat(price));
                                        $('#total_price' + j).val(total_price.toFixed(2));

                                        final_total_price = (final_total_price + total_price);

                                    }
                                }
                            }
                            $('#input_quo_sum').val(final_total_price.toFixed(2));
                            var discount = 0;
                            var afterdis = 0;
                            var vat7per = 0;
                            var aftervd = 0;
                            var afterdeli = 0;
                            var deli = 0;
                            discount = $('#input_quo_specialdis').val();
                            deli = $('#input_quo_deli').val();
                            afterdis = (final_total_price - discount);
                            $('#input_quo_afterdis').val(afterdis.toFixed(2));
                            vat7per = (afterdis * 0.07);
                            $('#input_quo_vat').val(vat7per.toFixed(2));
                            aftervd = (afterdis + vat7per);
                            if (deli > 0) {
                                aftervd = (aftervd + parseFloat(deli));
                            }

                            $('#input_quo_total').val(aftervd.toFixed(2));
                        }

                        $(document).on('change', '.item_price', function() {
                            cal_final_total(count);
                        });

                        $(document).on('change', '.item_amount', function() {
                            cal_final_total(count);
                        });

                        $(document).on('change', '#input_quo_specialdis', function() {
                            cal_final_total(count);
                        });

                        $(document).on('change', '#input_quo_deli', function() {
                            cal_final_total(count);
                        });

                    });
                </script>
            </div>
        </div>
    </div>
</div>