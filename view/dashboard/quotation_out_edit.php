<?php
session_start();
include("../../layout/head.php");
require_once("../../php/conn.php");

// $uid = $_SESSION['id'];

if (isset($_GET['editquoout'])) {
    
    $id = $_GET['editquoout'];

    $sql = "SELECT * FROM quotation_out WHERE quoout_id ='$id'";
    $query = $conn->query($sql);
    $row = $query->fetch_assoc();
    
}

if (isset($_POST['action'])) {
    if ($_POST['action'] == 'edit_quotation_out') {
        
        $id= mysqli_real_escape_string($conn,trim($_POST['quoout_id']));
        $quoout_no_check= mysqli_real_escape_string($conn,trim($_POST['quoout_no_check']));
        $input_quoout_no= mysqli_real_escape_string($conn,trim($_POST['input_quoout_no']));
        
        
        if($input_quoout_no == $quoout_no_check){
            
            edit_quoout();
            exit;
            
        }else{
            
            $quoout_no_check = "SELECT * FROM quotation_out WHERE quoout_no =  '$input_quoout_no'";
            $query = $conn->query($quoout_no_check);
            $check = $query->fetch_assoc();
            
            if ($check) {
                $_SESSION['error'] = "เลขที่ใบเสนอราคากลางนี้มีในระบบแล้ว!";
                header('Location: quotation_out_edit.php?editquoout='.$id);
                exit;
                
            }else{
                
                edit_quoout();
                exit;
                
            }
        }
    } 
}

function edit_quoout()
{

    global $conn;
    date_default_timezone_set('Asia/Bangkok');
    $date = date("Y-m-d H:i:s");
    
    $id= mysqli_real_escape_string($conn,trim($_POST['quoout_id']));
    $quoout_date_create= mysqli_real_escape_string($conn,trim($_POST['quoout_date_create']));
    $input_quoout_no= mysqli_real_escape_string($conn,trim($_POST['input_quoout_no']));
    $input_quoout_date= mysqli_real_escape_string($conn,trim($_POST['input_quoout_date']));
    $input_quoout_name= mysqli_real_escape_string($conn,trim($_POST['input_quoout_name']));
    $input_quoout_address= mysqli_real_escape_string($conn,trim($_POST['input_quoout_address']));
    $input_quoout_numtax= mysqli_real_escape_string($conn,trim($_POST['input_quoout_numtax']));
    $input_quoout_sum= mysqli_real_escape_string($conn,trim($_POST['input_quoout_sum']));
    $input_quoout_specialdis= mysqli_real_escape_string($conn,trim($_POST['input_quoout_specialdis']));
    $input_quoout_afterdis= mysqli_real_escape_string($conn,trim($_POST['input_quoout_afterdis']));
    $input_quoout_vat= mysqli_real_escape_string($conn,trim($_POST['input_quoout_vat']));
    $input_quoout_total= mysqli_real_escape_string($conn,trim($_POST['input_quoout_total']));
    $uid = 1;
    
    $query1 = "UPDATE quotation_out SET quoout_no='$input_quoout_no', quoout_date='$input_quoout_date',quoout_name='$input_quo_name',
        quoout_address='$input_quoout_address', quoout_numtax='$input_quoout_numtax', quoout_sum='$input_quoout_sum',
        quoout_specialdis='$input_quoout_specialdis', quoout_afterdis='$input_quoout_afterdis', quoout_vat='$input_quoout_vat',
        quoout_total='$input_quoout_total',quoout_update='$date', quoout_uid='$uid' WHERE quoout_id='$id'";
                
    $query2 = "DELETE FROM quotation_out_details WHERE quooutde_quooutid = '$id'";
    
    if ($conn->query($query1) === TRUE && $conn->query($query2) === TRUE) {

        for($count=0; $count<$_POST["total_item"]; $count++){
        
            $item_name= mysqli_real_escape_string($conn,trim($_POST['item_name'][$count]));
            $item_amount= mysqli_real_escape_string($conn,trim($_POST['item_amount'][$count]));
            $item_price= mysqli_real_escape_string($conn,trim($_POST['item_price'][$count]));
            $total_price= mysqli_real_escape_string($conn,trim($_POST['total_price'][$count]));

            $query = "INSERT INTO quotation_out_details (quooutde_quooutid, quooutde_item, quooutde_amount, quooutde_price, quooutde_result, quooutde_create, quooutde_update, quooutde_uid)
                VALUES ('$id', '$item_name', '$item_amount', '$item_price', '$total_price', '$quoout_date_create', '$date', '$uid')";
            $conn->query($query);
        }

        $_SESSION['success'] = "แก้ไขใบเสนอราคาสำเร็จ!";
        header("Location: quotation_out_list.php");
        exit;
        
    } else {
        
        echo "Error: " . $query . "<br>" . $conn->error;
        $_SESSION['error'] = "เกิดข้อผิดพลาด! กรุณาลองอีกครั้ง";
        header('Location: quotation_out_edit.php?editquoout='.$id);
        exit;
        
    }
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
    <?php require("../alert.php");?>
    <div class="container-fluid">
        <nav aria-label="breadcrumb" class="main-breadcrumb mt-2">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a
                        href="../dashboard/quotation_out_list.php">ใบเสนอราคา</a></li>
                <li class="breadcrumb-item active" aria-current="page">แก้ไขใบเสนอราคา</li>
            </ol>
        </nav>
        <hr>
        <div>
            <h3>แก้ไขข้อมูลใบเสนอราคา quotation appraisal</h3>
        </div>
        <form method="post" id="quoout_form" action="quotation_out_edit.php" class="px-md-5 py-md-5">
            <div class="row g-3 align-items-center mb-3">
                <div class="col-md-3">
                    <label for="input_quoout_no" class="col-form-label">เลขที่ No.</label>
                </div>
                <div class="col-auto">
                    <input type="number" id="input_quoout_no" name="input_quoout_no" class="form-control " required
                        value="<?= $row['quoout_no'] ?>">
                </div>
            </div>
            <div class="row g-3 align-items-center mb-3">
                <div class="col-md-3">
                    <label for="input_quoout_date" class="col-form-label">วันที่ date.</label>
                </div>
                <div class="col-auto">
                    <input type="date" id="input_quoout_date" name="input_quoout_date" class="form-control " required
                        value="<?= $row['quoout_date'] ?>">
                </div>
            </div>
            <div class=" row g-3 align-items-center mb-3">
                <div class="col-md-3">
                    <label for="input_quoout_name" class="col-form-label">ชื่อลูกค้า/หน่วยงาน :</label>
                </div>
                <div class="col-md-8">
                    <input type="text" id="input_quoout_name" name="input_quoout_name" class="form-control " required
                        value="<?= $row['quoout_name'] ?>">
                </div>
            </div>
            <div class="row g-3 mb-3">
                <div class="col-md-3 ">
                    <label for="input_quoout_address" class="col-form-label">ที่อยู่ :</label>
                </div>
                <div class="col-md-8">
                    <textarea class="form-control" id="input_quoout_address" name="input_quoout_address" rows="3"
                        required><?= $row['quoout_address']; ?></textarea>
                </div>
            </div>
            <div class="row g-3 align-items-center mb-3">
                <div class="col-md-3 ">
                    <label for="input_quoout_numtax" class="col-form-label">เลขประจำตัวผู้เสียภาษี :</label>
                </div>

                <div class="col-md-8">
                    <input type="number" id="input_quoout_numtax" name="input_quoout_numtax" class="form-control "
                        pattern="[0-9]{13}" title="กรุณากรอกตัวเลข 0-9 จำนวน 13 หลัก ไม่มี (-)" required
                        value="<?= $row['quoout_numtax'] ?>">
                </div>
            </div>
            <div class="row g-3 align-items-center mb-3">
                <div class="col-md-3 ">
                    <label for="itemtitle" class="col-form-label">แก้ไขรายการใบเสนอราคา :</label>
                </div>
                <div class="border border-secondary rounded-3 py-md-4 px-md-4">
                    <div class="table-responsive">
                        <table id="quoout-item-table" class="table ">
                            <tr>
                                <th width="7%">ลำดับ <br>Number</th>
                                <th width="40%">รายการ <br> Description </th>
                                <th width="13%">จำนวน <br> Amount</th>
                                <th width="15%">ราคา/หน่วย <br> Price/Unit</th>
                                <th width="20%">จำนวนเงิน(บาท)</th>
                                <th width="5%">ลบ</th>
                            </tr>
                            <?php
                            
                                $sql = "SELECT * FROM quotation_out_details WHERE quooutde_quooutid ='$id'";
                                $query = $conn->query($sql);
                                $n = 0;
                                while ($rows = $query->fetch_assoc()) 
                                {
                                $n = $n +1;
                            ?>

                            <tr id="row_id_<?= $n; ?>">
                                <td><span id="sr_no"></span></td>
                                <td>
                                    <input type="text" name="item_name[]" id="item_name<?= $n; ?>"
                                        class="form-control input-sm item_name" value="<?= $rows["quooutde_item"]; ?>"
                                        required />
                                </td>
                                <td>
                                    <input type="number" name="item_amount[]" id="item_amount<?= $n; ?>"
                                        data-srno="<?= $n; ?>" class="form-control input-sm item_amount"
                                        value="<?= $rows["quooutde_amount"]; ?>" required />
                                </td>
                                <td>
                                    <input type="number" name="item_price[]" id="item_price<?= $n; ?>"
                                        data-srno="<?= $n; ?>" class="form-control input-sm  item_price"
                                        value="<?= $rows["quooutde_price"]; ?>" required />
                                </td>
                                <td>
                                    <input type="number" name="total_price[]" id="total_price<?= $n; ?>"
                                        data-srno="<?= $n; ?>" class="form-control input-sm total_price"
                                        value="<?= $rows["quooutde_result"];?>" readonly />
                                </td>
                                <td>
                                    <button type="button" name="remove_row" id="<?= $n; ?>"
                                        class="btn btn-danger btn-xs remove_row">X</button>
                                </td>
                            </tr>

                            <?php
                                }
                            ?>
                        </table>
                        <div class="text-center">
                            <button type="button" id="add_row" class="btn btn-success px-4 rounded-pill fs-5 fw-bold "
                                id="add_sub"><i class="fa fa-plus-circle text-white"></i> เพิ่มรายการ</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                </div>
                <div class="col-md-6">
                    <div class="row g-3 align-items-center mb-3">
                        <div class="col-md-6">
                            <label for="input_quoout_sum" class="col-form-label">รวมเป็นเงิน(บาท) :</label>
                        </div>

                        <div class="col-md-5">
                            <input type="number" id="input_quoout_sum" name="input_quoout_sum" class="form-control "
                                placeholder="0.00" readonly value="<?= $row['quoout_sum'] ?>">
                        </div>
                    </div>
                    <div class="row g-3 align-items-center mb-3">
                        <div class="col-md-6 ">
                            <label for="input_quoout_specialdis" class="col-form-label text-danger">หักส่วนลดพิเศษ(บาท)
                                :</label>
                        </div>

                        <div class="col-md-5">
                            <input type="number" step="any" id="input_quoout_specialdis" name="input_quoout_specialdis"
                                class="form-control " placeholder="0.00" title="กรุณากรอกส่วนลด หากมี"
                                value="<?= $row['quoout_specialdis'] ?>">
                        </div>
                    </div>
                    <div class="row g-3 align-items-center mb-3">
                        <div class="col-md-6 ">
                            <label for="input_quoout_afterdis" class="col-form-label">ยอดรวมหลังหักส่วนลด(บาท)
                                :</label>
                        </div>

                        <div class="col-md-5">
                            <input type="number" id="input_quoout_afterdis" name="input_quoout_afterdis"
                                class="form-control " placeholder="0.00" readonly
                                value="<?= $row['quoout_afterdis'] ?>">
                        </div>
                    </div>
                    <div class="row g-3 align-items-center mb-3">
                        <div class="col-md-6 ">
                            <label for="input_quoout_vat" class="col-form-label">ภาษีมูลค่าเพิ่ม 7%(บาท) :</label>
                        </div>

                        <div class="col-md-5">
                            <input type="number" id="input_quoout_vat" name="input_quoout_vat" class="form-control "
                                placeholder="0.00" readonly value="<?= $row['quoout_vat'] ?>">
                        </div>
                    </div>
                    <div class="row g-3 align-items-center mb-3">
                        <div class="col-md-6">
                            <label for="input_quoout_total" class="col-form-label">จํานวนเงินรวมทั้งสิ้น(บาท)
                                :</label>
                        </div>

                        <div class="col-md-5">
                            <input type="number" id="input_quoout_total" name="input_quoout_total" class="form-control "
                                placeholder="0.00" readonly value="<?= $row['quoout_total'] ?>">
                        </div>
                    </div>
                </div>
            </div>

            <div class="mx-auto d-flex justify-content-end">
                <button type="reset"
                    class="col-md-3 btn btn-outline-danger btn btn-outline-success p-2 mt-2 rounded-pill fs-5 fw-bold"><i
                        class="fa-solid fa-eraser"></i> ล้างข้อมูล</button>
                <button type="submit" name="action" value="edit_quotation_out"
                    class="ms-3 col-md-3 btn btn-outline-success p-2 mt-2 rounded-pill fs-5 fw-bold">บันทึกการแก้ไข
                    <i class="fa-solid fa-angles-right"></i></button>
                <input type="hidden" name="total_item" id="total_item" value="<?= $n;?>" />
                <input type="hidden" name="quoout_no_check" id="quoout_no_check" value="<?= $row['quoout_no'];?>" />
                <input type="hidden" name="quoout_id" id="quoout_id" value="<?= $row['quoout_id'];?>" />
                <input type="hidden" name="quoout_date_create" id="quoout_date_create"
                    value="<?= $row['quoout_create'];?>" />
            </div>

        </form>
        <script>
        $(document).ready(function() {
            var final_total_price = $('#final_total_price').text();
            var count = "<?= $n;?>";
            var total_item = "<?= $n;?>";

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
                    '<td><input type="number" name="item_amount[]" id="item_amount' +
                    count + '" data-srno="' + count +
                    '" class="form-control input-sm number_only item_amount" required/></td>';
                html_code += '<td><input type="number" name="item_price[]" id="item_price' +
                    count + '" data-srno="' + count +
                    '" class="form-control input-sm number_only item_price" required step="any"/></td>';
                html_code +=
                    '<td><input type="text" name="total_price[]" id="total_price' +
                    count + '" data-srno="' + count +
                    '" class="form-control input-sm total_price" readonly /></td>';
                html_code += '<td><button type="button" name="remove_row" id="' + count +
                    '" class="btn btn-danger btn-xs remove_row">X</button></td>';
                html_code += '</tr>';
                $('#quoout-item-table').append(html_code);
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
                $('#input_quoout_sum').val(final_total_price.toFixed(2));
                var discount = 0;
                var afterdis = 0;
                var vat7per = 0;
                var aftervat = 0;
                discount = $('#input_quoout_specialdis').val();
                afterdis = final_total_price - discount;
                $('#input_quoout_afterdis').val(afterdis.toFixed(2));
                vat7per = (afterdis * 0.07);
                $('#input_quoout_vat').val(vat7per.toFixed(2));
                aftervat = (afterdis + vat7per);
                $('#input_quoout_total').val(aftervat.toFixed(2));
            }

            $(document).on('change', '.item_price', function() {
                cal_final_total(count);
            });

            $(document).on('change', '.item_amount', function() {
                cal_final_total(count);
            });

            $(document).on('change', '#input_quoout_specialdis', function() {
                cal_final_total(count);
            });

        });
        </script>
    </div>
</body>
<?php  $conn->close();?>