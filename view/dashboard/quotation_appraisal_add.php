<?php
include("../../layout/head.php");
?>
<style>
body {
    font-family: "Kanit", sans-serif;
    font-family: "Noto Sans", sans-serif;
    font-family: "Noto Sans Thai", sans-serif;
    font-family: "Poppins", sans-serif;
    font-family: "Prompt", sans-serif;
}
</style>
<div class="container-fluid">
    <nav aria-label="breadcrumb" class="main-breadcrumb mt-2">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a
                    href="../dashboard/quotation_appraisal_list.php">ใบเสนอราคากลาง</a></li>
            <li class="breadcrumb-item active" aria-current="page">สร้างใบเสนอราคากลาง</li>
        </ol>
    </nav>
    <hr>
    <div>
        <h3>ข้อมูลใบเสนอราคา Quotation</h3>
    </div>
    <form method="post" id="quotation_form" class="px-md-5 py-md-5">
        <div class="row g-3 align-items-center mb-3">
            <div class="col-md-3">
                <label for="inputNo" class="col-form-label">เลขที่ No.</label>
            </div>
            <div class="col-auto">
                <input type="text" id="inputNo" class="form-control " required>
            </div>
        </div>
        <div class="row g-3 align-items-center mb-3">
            <div class="col-md-3">
                <label for="inputNo" class="col-form-label">วันที่ date.</label>
            </div>
            <div class="col-auto">
                <input type="date" id="inputdate" class="form-control " required>
            </div>
        </div>
        <div class="row g-3 align-items-center mb-3">
            <div class="col-md-3">
                <label for="inputname" class="col-form-label">ชื่อลูกค้า :</label>
            </div>
            <div class="col-md-8">
                <input type="text" id="inputname" class="form-control " required>
            </div>
        </div>
        <div class="row g-3 mb-3">
            <div class="col-md-3 ">
                <label for="inputposition" class="col-form-label">ที่อยู่ :</label>
            </div>
            <div class="col-md-8">
                <textarea class="form-control" id="inputposition" rows="3" required></textarea>
            </div>
        </div>
        <div class="row g-3 align-items-center mb-3">
            <div class="col-md-3 ">
                <label for="inputrev" class="col-form-label">เลขประจำตัวผู้เสียภาษี :</label>
            </div>

            <div class="col-md-8">
                <input type="text" id="inputrev" class="form-control " pattern="[0-9]{13}"
                    title="กรุณากรอกตัวเลข 0-9 จำนวน 13 หลัก ไม่มี (-)" required>
            </div>
        </div>
        <div class="row g-3 align-items-center mb-3">
            <div class="col-md-3 ">
                <label for="itemtitle" class="col-form-label">รายการใบเสนอราคากลาง :</label>
            </div>
            <div class="border border-secondary rounded-3 py-md-4 px-md-4">
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <td colspan=" 2">

                                <table id="quotation-item-table" class="table ">
                                    <tr>
                                        <th width="7%">ลำดับ <br>Number</th>
                                        <th width="40%">รายการ <br> Description </th>
                                        <th width="13%">จำนวน <br> Amount</th>
                                        <th width="15%">ราคา/หน่วย <br> Price/Unit</th>
                                        <th width="20%">จำนวนเงิน(บาท)</th>
                                        <th width="5%">ลบ</th>

                                    </tr>

                                    <tr>
                                        <td><span id="sr_no">1</span></td>
                                        <td><input type="text" name="item_name[]" id="item_name1"
                                                class="form-control input-sm" />
                                        </td>
                                        <td><input type="number" name="item_amount[]" id="item_amount1" data-srno="1"
                                                class="form-control input-sm item_amount" /></td>
                                        <td><input type="number" name="item_price[]" id="item_price1" data-srno="1"
                                                class="form-control input-sm number_only item_price" />
                                        </td>
                                        <td><input type="text" name="total_price[]" id="total_price1" data-srno="1"
                                                class="form-control input-sm total_price" readonly />
                                        </td>
                                        <td></td>
                                    </tr>
                                </table>
                                <div class="text-center">
                                    <button type="button" id="add_row"
                                        class="btn btn-success px-4 rounded-pill fs-5 fw-bold " id="add_sub"><i
                                            class="fa fa-plus-circle text-white"></i> เพิ่มรายการ</button>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="row g-3  mb-3">
                    <div class="col-md-3 ">
                        <label for="inputremark" class="col-form-label">หมายเหตุ :</label>
                    </div>
                    <div class="col-md-8">
                        <textarea class="form-control" id="inputremark" rows="3" required></textarea>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row g-3 align-items-center mb-3">
                    <div class="col-md-6">
                        <label for="inputsum" class="col-form-label">รวมเป็นเงิน(บาท) :</label>
                    </div>

                    <div class="col-md-5">
                        <input type="text" id="final_total_price" class="form-control " placeholder="0.00" disabled>
                    </div>
                </div>
                <div class="row g-3 align-items-center mb-3">
                    <div class="col-md-6 ">
                        <label for="inputdis" class="col-form-label text-danger">หักส่วนลดพิเศษ(บาท) :</label>
                    </div>

                    <div class="col-md-5">
                        <input type="number" id="inputdis" class="form-control " placeholder="0.00"
                            title="กรุณากรอกส่วนลด หากมี" required>
                    </div>
                </div>
                <div class="row g-3 align-items-center mb-3">
                    <div class="col-md-6 ">
                        <label for="afterdis" class="col-form-label">ยอดรวมหลังหักส่วนลด(บาท) :</label>
                    </div>

                    <div class="col-md-5">
                        <input type="text" id="afterdis" class="form-control " placeholder="0.00" disabled>
                    </div>
                </div>
                <div class="row g-3 align-items-center mb-3">
                    <div class="col-md-6 ">
                        <label for="vat" class="col-form-label">ภาษีมูลค่าเพิ่ม 7%(บาท) :</label>
                    </div>

                    <div class="col-md-5">
                        <input type="text" id="vat" class="form-control " placeholder="0.00" disabled>
                    </div>
                </div>
                <div class="row g-3 align-items-center mb-3">
                    <div class="col-md-6">
                        <label for="total" class="col-form-label">จํานวนเงินรวมทั้งสิ้น(บาท) :</label>
                    </div>

                    <div class="col-md-5">
                        <input type="text" id="total" class="form-control " placeholder="0.00" disabled>
                    </div>
                </div>
            </div>
        </div>
        <div class="row g-3  mb-3">
            <div class="col-md-3">
                <label for="texttotal" class="col-form-label">จำนวนเงินตัวอักษร : <br> The Sum Of Bahts </label>
            </div>
            <div class="col-md-9">
                <textarea class="form-control" id="texttotal" rows="2" require></textarea>
            </div>
        </div>

        <div class="mx-auto d-flex justify-content-end">
            <button type="reset"
                class="col-md-3 btn btn-outline-danger btn btn-outline-success p-2 mt-2 rounded-pill fs-5 fw-bold"><i
                    class="fa-solid fa-eraser"></i> ล้างข้อมูล</button>
            <button type="submit" name="create_quotation" id="create_quotation" value="Create"
                class="ms-3 col-md-3 btn btn-outline-success p-2 mt-2 rounded-pill fs-5 fw-bold">ต่อไป
                <i class="fa-solid fa-angles-right"></i></button>
            <input type="hidden" name="total_item" id="total_item" value="1" />
        </div>

    </form>
    <script>
    $(document).ready(function() {
        // var final_total_price = $('#final_total_price').text();
        var count = 1;

        $(document).on('click', '#add_row', function() {
            count++;
            $('#total_item').val(count);
            var html_code = '';
            html_code += '<tr id="row_id_' + count + '">';
            html_code += '<td><span id="sr_no">' + count + '</span></td>';

            html_code += '<td><input type="text" name="item_name[]" id="item_name' + count +
                '" class="form-control input-sm" /></td>';

            html_code +=
                '<td><input type="number" name="item_amount[]" id="item_amount' +
                count + '" data-srno="' + count +
                '" class="form-control input-sm number_only item_amount" /></td>';
            html_code += '<td><input type="number" name="item_price[]" id="item_price' +
                count + '" data-srno="' + count +
                '" class="form-control input-sm number_only item_price" /></td>';
            html_code +=
                '<td><input type="text" name="total_price[]" id="total_price' +
                count + '" data-srno="' + count +
                '" class="form-control input-sm total_price" readonly /></td>';
            html_code += '<td><button type="button" name="remove_row" id="' + count +
                '" class="btn btn-danger btn-xs remove_row">X</button></td>';
            html_code += '</tr>';
            $('#quotation-item-table').append(html_code);
        });

        $(document).on('click', '.remove_row', function() {
            var row_id = $(this).attr("id");
            $('#row_id_' + row_id).remove();
            count--;
            $('#total_item').val(count);
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
                        $('#total_price' + j).val(total_price);

                        final_total_price = parseFloat(final_total_price) + parseFloat(total_price);

                    }
                }
            }
            $('#final_total_price').val(final_total_price);
            var discount = 0;
            var afterdis = 0;
            var vat7per = 0;
            var aftervat = 0;
            discount = $('#inputdis').val();
            afterdis = (final_total_price - discount);
            $('#afterdis').val(afterdis);
            vat7per = (afterdis * 0.07);
            $('#vat').val(vat7per.toFixed(2));
            aftervat = (afterdis + vat7per);
            $('#total').val(aftervat.toFixed(2));
        }

        $(document).on('change', '.item_price', function() {
            cal_final_total(count);
        });

        $(document).on('change', '.item_amount', function() {
            cal_final_total(count);
        });

        $(document).on('change', '#inputdis', function() {
            cal_final_total(count);
        });

        $(document).on('click', '.remove_row', function() {
            cal_final_total(count);
        });



        $('#create_quotation').click(function() {
            if ($.trim($('#order_receiver_name').val()).length == 0) {
                alert("Please Enter Reciever Name");
                return false;
            }

            if ($.trim($('#order_no').val()).length == 0) {
                alert("Please Enter Invoice Number");
                return false;
            }

            if ($.trim($('#order_date').val()).length == 0) {
                alert("Please Select Invoice Date");
                return false;
            }

            for (var no = 1; no <= count; no++) {
                if ($.trim($('#item_name' + no).val()).length == 0) {
                    alert("Please Enter Item Name");
                    $('#item_name' + no).focus();
                    return false;
                }

                if ($.trim($('#item_amount' + no).val()).length == 0) {
                    alert("Please Enter Quantity");
                    $('#item_amount' + no).focus();
                    return false;
                }

                if ($.trim($('#item_price' + no).val()).length == 0) {
                    alert("Please Enter Price");
                    $('#item_price' + no).focus();
                    return false;
                }

            }

            $('#quotation_form').submit();

        });

    });
    </script>
</div>
