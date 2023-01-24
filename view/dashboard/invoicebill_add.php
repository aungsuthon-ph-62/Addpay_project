<?php

if (isset($_POST['action'])) {
    if ($_POST['action'] == 'create_invoicebill') {

        date_default_timezone_set('Asia/Bangkok');
        $date = date("Y-m-d H:i:s");
        global $conn;

        $input_invbill_no = mysqli_real_escape_string($conn, trim($_POST['input_invbill_no']));
        $input_invbill_date = mysqli_real_escape_string($conn, trim($_POST['input_invbill_date']));
        $input_invbill_name = mysqli_real_escape_string($conn, trim($_POST['input_invbill_name']));
        $input_invbill_address = mysqli_real_escape_string($conn, trim($_POST['input_invbill_address']));
        $input_invbill_cusid = mysqli_real_escape_string($conn, trim($_POST['input_invbill_cusid']));
        $input_invbill_deli = mysqli_real_escape_string($conn, trim($_POST['input_invbill_deli']));
        $input_invbill_total = mysqli_real_escape_string($conn, trim($_POST['input_invbill_total']));
        $input_invbill_page = mysqli_real_escape_string($conn, trim($_POST['input_invbill_page']));
        $input_invbill_remark = mysqli_real_escape_string($conn, trim($_POST['input_invbill_remark']));
        $uid = $_SESSION['id'];

        $invbill_no_check_query = "SELECT * FROM invoicebill WHERE invbill_no =  '$input_invbill_no'";
        $query = mysqli_query($conn, $invbill_no_check_query);
        $check = mysqli_fetch_assoc($query);

        if ($check) {
            $_SESSION['error'] = "เลขที่ใบวางบิลนี้มีในระบบแล้ว!";

            unset($_SESSION['svinput']);unset($_SESSION['deli']);
            if($input_invbill_deli>0){$_SESSION['deli'] = $input_invbill_deli;}
        
            $inputArray = array();
            
            for ($count = 0; $count < $_POST["total_item"]; $count++) {
                
                $item_name = mysqli_real_escape_string($conn, trim($_POST['item_name'][$count]));
                $item_inv_date = mysqli_real_escape_string($conn, trim($_POST['item_inv_date'][$count]));
                $item_due_date = mysqli_real_escape_string($conn, trim($_POST['item_due_date'][$count]));
                
                $item_price = mysqli_real_escape_string($conn, trim($_POST['item_price'][$count]));
                $item_vat = mysqli_real_escape_string($conn, trim($_POST['item_vat'][$count]));
                $item_total = mysqli_real_escape_string($conn, trim($_POST['item_total'][$count]));

                $subinputArray = array($item_name,$item_inv_date,$item_due_date,$item_price,$item_vat,$item_total);
                $inputArray[] = $subinputArray;
        
            }

            $_SESSION['svinput']=$inputArray;

            echo("<script> window.history.back()</script>");
            exit;

        } else {
            $query = "INSERT INTO invoicebill (invbill_no, invbill_date, invbill_name, invbill_address, invbill_cusid, invbill_deli, invbill_total, invbill_page, invbill_remark, invbill_create, invbill_uid)
            VALUES ('$input_invbill_no', '$input_invbill_date', '$input_invbill_name', '$input_invbill_address', '$input_invbill_cusid', '$input_invbill_deli', '$input_invbill_total','$input_invbill_page', '$input_invbill_remark', '$date', '$uid')";

            if ($conn->query($query) === TRUE) {

                $last_id = $conn->insert_id;

                for ($count = 0; $count < $_POST["total_item"]; $count++) {

                    $item_name = mysqli_real_escape_string($conn, trim($_POST['item_name'][$count]));
                    $item_inv_date = mysqli_real_escape_string($conn, trim($_POST['item_inv_date'][$count]));
                    $item_due_date = mysqli_real_escape_string($conn, trim($_POST['item_due_date'][$count]));
                    
                    $item_price = mysqli_real_escape_string($conn, trim($_POST['item_price'][$count]));
                    $item_vat = mysqli_real_escape_string($conn, trim($_POST['item_vat'][$count]));
                    $item_total = mysqli_real_escape_string($conn, trim($_POST['item_total'][$count]));


                    $query = "INSERT INTO invoicebill_details (invbilld_bid, invbilld_item, invbilld_inv_date, invbilld_due_date, invbilld_price, invbilld_vat, invbilld_result, invbilld_create, invbilld_uid)
                    VALUES ('$last_id', '$item_name', '$item_inv_date', '$item_due_date', '$item_price', '$item_vat', '$item_total', '$date', '$uid')";
                    $conn->query($query);
                }
                
                $_SESSION['success'] = "บันทึกใบวางบิลสำเร็จ!";
                unset($_SESSION['svinput']);unset($_SESSION['deli']);
                echo("<script> window.location.href='?page=invoicebill'</script>");
                exit;
            } else {

                $_SESSION['error'] = "เกิดข้อผิดพลาด! กรุณาลองอีกครั้ง";
                unset($_SESSION['svinput']);unset($_SESSION['deli']);
                if($input_invbill_deli>0){$_SESSION['deli'] = $input_invbill_deli;}
                
                $inputArray = array();
                
                for ($count = 0; $count < $_POST["total_item"]; $count++) {
                    
                    $item_name = mysqli_real_escape_string($conn, trim($_POST['item_name'][$count]));
                    $item_inv_date = mysqli_real_escape_string($conn, trim($_POST['item_inv_date'][$count]));
                    $item_due_date = mysqli_real_escape_string($conn, trim($_POST['item_due_date'][$count]));
                    
                    $item_price = mysqli_real_escape_string($conn, trim($_POST['item_price'][$count]));
                    $item_vat = mysqli_real_escape_string($conn, trim($_POST['item_vat'][$count]));
                    $item_total = mysqli_real_escape_string($conn, trim($_POST['item_total'][$count]));

                    $subinputArray = array($item_name,$item_inv_date,$item_due_date,$item_price,$item_vat,$item_total);
                    $inputArray[] = $subinputArray;
            
                }

                $_SESSION['svinput']=$inputArray;
                echo("<script> window.history.back()</script>");
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
        <li class="breadcrumb-item"><a href="?page=invoicebill">ใบแจ้งหนี้/ใบวางบิล</a></li>
        <li class="breadcrumb-item active" aria-current="page">สร้างใบแจ้งหนี้/ใบวางบิล</li>
    </ol>
</nav>
<hr>

<div class="container bg-secondary-addpay rounded-5">
    <div class="main-body py-md-5 px-md-1 text-white">
        <div id="invoicebill" class="container p-3 p-md-5">

            <div class="p-4 p-md-5 bg-white rounded-5 shadow-lg">
                <div class="text-center text-md-start text-dark my-3">
                    <h3>ข้อมูลใบแจ้งหนี้/ใบวางบิล</h3>
                </div>

                <form action="?page=invoicebill_add" method="post" name="invoicebill_add" id="invoicebill_add"
                    class="p-md-5">
                    <div class="row align-items-center text-dark px-md-5 mb-3">
                        <div class="col-md-3 text-md-end">
                            <label for="input_invbill_no" class="col-form-label">เลขที่ No.</label>
                        </div>
                        <div class="col-auto">
                            <input type="text" id="input_invbill_no" name="input_invbill_no" class="form-control "
                                required>
                        </div>
                    </div>
                    <div class="row align-items-center text-dark px-md-5 mb-3">
                        <div class="col-md-3 text-md-end">
                            <label for="input_invbill_date" class="col-form-label">วันที่ date.</label>
                        </div>
                        <div class="col-auto">
                            <input type="date" id="input_invbill_date" name="input_invbill_date" class="form-control "
                                required>
                        </div>
                    </div>
                    <div class="row align-items-center text-dark px-md-5 mb-3">
                        <div class="col-md-3 text-md-end">
                            <label for="input_invbill_name" class="col-form-label">ชื่อลูกค้า :</label>
                        </div>

                        <div class="col-6">
                            <input type="text" id="input_invbill_name" name="input_invbill_name" class="form-control "
                                required>
                        </div>
                    </div>
                    <div class=" row align-items-center text-dark px-md-5 mb-3">
                        <div class="col-md-3 text-md-end">
                            <label for="input_invbill_address" class="col-form-label">ที่อยู่ :</label>
                        </div>
                        <div class="col-6">
                            <textarea class="form-control" id="input_invbill_address" name="input_invbill_address"
                                rows="3" required></textarea>
                        </div>
                    </div>
                    <div class="row align-items-center text-dark px-md-5 mb-3">
                        <div class="col-md-3 text-md-end">
                            <label for="input_invbill_cusid" class="col-form-label">เลขประจำตัวผู้เสียภาษี :</label>
                        </div>
                        <div class="col-6">
                            <input type="text" id="input_invbill_cusid" name="input_invbill_cusid" class="form-control "
                                required>

                        </div>
                    </div>
                    <div class="row align-items-center text-dark px-md-2 mb-3">
                        <div class="col-md-3 ">
                            <h6>รายการใบวางบิล :</h6>
                        </div>
                        <div class="border border-secondary rounded-3 p-4">
                            <div class="table-responsive">
                                <table id="invoice-item-table" class="table ">
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
                                    <?php if(isset($_SESSION['svinput'])) {
                                        
                                        $svinput=$_SESSION["svinput"];
                                        $n=0;
                                        
                                        foreach($svinput as $index => $array){
                                            $n++;
                                            ?>
                                    <tr id="row_id_<?= $n; ?>">
                                        <td><span id="sr_no"></span></td>
                                        <td><input type="text" name="item_name[]" id="item_name1"
                                                class="form-control input-sm" value="<?= $svinput[$index][0] ?>"
                                                required /></td>
                                        <td><input type="date" name="item_inv_date[]" id="item_inv_date1"
                                                class="form-control input-sm item_inv_date"
                                                value="<?= $svinput[$index][1] ?>" /></td>
                                        <td><input type="date" name="item_due_date[]" id="item_due_date1"
                                                class="form-control input-sm item_due_date"
                                                value="<?= $svinput[$index][2] ?>" /></td>
                                        <td><input type="number" name="item_price[]" id="item_price1" data-srno="1"
                                                class="form-control input-sm item_price" step="any"
                                                value="<?= $svinput[$index][3] ?>" required /></td>
                                        <td><input type="number" name="item_vat[]" id="item_vat1" data-srno="1"
                                                class="form-control input-sm item_vat"
                                                value="<?= $svinput[$index][4] ?>" required readonly /></td>
                                        <td><input type="number" name="item_total[]" id="item_total1" data-srno="1"
                                                class="form-control input-sm item_total"
                                                value="<?= $svinput[$index][5] ?>" required readonly /></td>
                                        <td>
                                            <button type="button" name="remove_row" id="<?= $n; ?>"
                                                class="btn btn-danger btn-xs remove_row">X</button>
                                        </td>
                                    </tr>

                                    <?php }
                                }else{ 
                                    $n=1;$deli=0;
                                    ?>
                                    <tr id="row_id_1">
                                        <td><span id="sr_no"></span></td>
                                        <td><input type="text" name="item_name[]" id="item_name1"
                                                class="form-control input-sm" required /></td>
                                        <td><input type="date" name="item_inv_date[]" id="item_inv_date1"
                                                class="form-control input-sm item_inv_date" /></td>
                                        <td><input type="date" name="item_due_date[]" id="item_due_date1"
                                                class="form-control input-sm item_due_date" /></td>
                                        <td><input type="number" name="item_price[]" id="item_price1" data-srno="1"
                                                class="form-control input-sm item_price" step="any" required /></td>
                                        <td><input type="number" name="item_vat[]" id="item_vat1" data-srno="1"
                                                class="form-control input-sm item_vat" required readonly /></td>
                                        <td><input type="number" name="item_total[]" id="item_total1" data-srno="1"
                                                class="form-control input-sm item_total" required readonly /></td>
                                    </tr>
                                    <?php 
                                } 
                                ?>
                                </table>
                                <div class="text-center">
                                    <button type="button" id="add_row" class="btn btn-addpay px-md-4 rounded-3"><i
                                            class="fa fa-plus-circle text-white"></i> เพิ่มรายการ</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row align-items-center text-dark mb-3">
                                <div class="col-md-4 ">
                                    <label for="input_invbill_remark" class="col-form-label">หมายเหตุ :</label>
                                </div>
                                <div class="col-auto">
                                    <textarea class="form-control" id="input_invbill_remark" name="input_invbill_remark"
                                        rows="2"></textarea>
                                </div>
                            </div>
                            <div class="row align-items-center text-dark mb-3">
                                <div class="col-md-4">
                                    <label for="input_invbill_page" class="col-form-label">จำนวนเอกสารรวม :</label>
                                </div>
                                <div class="col-md-5">
                                    <input type="number" id="input_invbill_page" name="input_invbill_page"
                                        class="form-control " required>
                                </div>
                                <div class="col-md-3">
                                    <label for="input_invbill_page" class="col-form-label">ฉบับ</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mt-md-4">
                            <div class="row align-items-center text-dark mb-3">
                                <div class="col-md-5 ">
                                    <label for="input_invbill_deli" class="col-form-label ">ค่าขนส่ง (บาท) :</label>
                                </div>

                                <div class="col-auto">
                                    <input type="number" id="input_invbill_deli" name="input_invbill_deli"
                                        class="form-control" placeholder="0.00" title="กรุณากรอกค่าขนส่ง หากมี"
                                        value="<?php if(isset($_SESSION['deli'])) {echo $_SESSION["deli"];}else{echo 0;} ?>">
                                </div>
                            </div>

                            <div class="row align-items-center text-dark mb-3">
                                <div class="col-md-5 ">
                                    <label for="input_invbill_total" class="col-form-label">ยอดรวมทั้งสิ้น (บาท)
                                        :</label>
                                </div>
                                <div class="col-auto">
                                    <input type="number" id="input_invbill_total" name="input_invbill_total"
                                        class="form-control bg" readonly>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mx-auto d-flex justify-content-end">
                        <div class="col-md-12">
                            <div class="d-flex justify-content-end">
                                <button type="reset" class="btn bg-secondary-addpay text-white me-3"><i
                                        class="fa-solid fa-arrow-rotate-left"></i> ล้างข้อมูล</button>
                                <button type="submit" name="action" value="create_invoicebill"
                                    class="btn btn-addpay text-white">บันทึก <i
                                        class="fa-solid fa-cloud-arrow-up"></i></button>
                            </div>
                        </div>
                        <input type="hidden" name="total_item" id="total_item" value="<?=$n;?>" />
                    </div>

                </form>
                <script>
                $(document).ready(function() {
                    var final_total_price = $('#final_total_price').text();
                    var count = <?=$n;?>;
                    var total_item = <?=$n;?>;

                    $(document).on('click', '#add_row', function() {
                        count++;
                        total_item++;
                        $('#total_item').val(total_item);
                        var html_code = '';
                        html_code += '<tr id="row_id_' + count + '">';
                        html_code += '<td><span id="sr_no"></span></td>';

                        html_code += '<td><input type="text" name="item_name[]" id="item_name' + count +
                            '" class="form-control input-sm" required/></td>';

                        html_code +=
                            '<td><input type="date" name="item_inv_date[]" id="item_inv_date' +
                            count + '" data-srno="' + count +
                            '" class="form-control input-sm  item_inv_date" /></td>';

                        html_code +=
                            '<td><input type="date" name="item_due_date[]" id="item_due_date' +
                            count + '" data-srno="' + count +
                            '" class="form-control input-sm  item_due_date" /></td>';

                        html_code +=
                            '<td><input type="number" name="item_price[]" id="item_price' +
                            count + '" data-srno="' + count +
                            '" class="form-control input-sm number_only item_price" required step="any"/></td>';

                        html_code +=
                            '<td><input type="number" name="item_vat[]" id="item_vat' +
                            count + '" data-srno="' + count +
                            '" class="form-control input-sm item_vat" required readonly /></td>';

                        html_code +=
                            '<td><input type="number" name="item_total[]" id="item_total' +
                            count + '" data-srno="' + count +
                            '" class="form-control input-sm number_only item_total" required readonly /></td>';

                        html_code += '<td><button type="button" name="remove_row" id="' + count +
                            '" class="btn btn-danger btn-xs remove_row">X</button></td>';
                        html_code += '</tr>';
                        $('#invoice-item-table').append(html_code);
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
                            var price = 0;
                            var vat7per = 0;
                            var total_price = 0;

                            price = $('#item_price' + j).val();

                            if (price > 0) {

                                vat7per = (parseFloat(price) * 0.07);
                                $('#item_vat' + j).val(vat7per.toFixed(2));

                                total_price = (parseFloat(price) + parseFloat(vat7per));
                                $('#item_total' + j).val(total_price.toFixed(2));


                                final_total_price = (final_total_price + total_price);
                            }
                        }

                        var deli = 0;
                        var final_total = 0;
                        deli = $('#input_invbill_deli').val();
                        final_total = final_total_price;
                        if (deli > 0) {
                            final_total = (final_total + parseFloat(deli));
                        }

                        $('#input_invbill_total').val(final_total.toFixed(2));
                    }


                    $(document).on('change', '.item_price', function() {
                        cal_final_total(count);
                    });

                    $(document).on('change', '#input_invbill_deli', function() {
                        cal_final_total(count);
                    });

                    <?php if(isset($_SESSION['svinput'])){
                        echo "cal_final_total(count);";
                    }?>
                });
                </script>
            </div>
        </div>
    </div>
</div>