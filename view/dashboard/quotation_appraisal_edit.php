<?php
session_start();
include("../../layout/head.php");
require_once("../../php/conn.php");

// $uid = $_SESSION['id'];

if (isset($_GET['editquo'])) {
    
    $id = $_GET['editquo'];

    $sql = "SELECT * FROM quotation_appraisal WHERE quo_id ='$id'";
    $query = $conn->query($sql);
    $row = $query->fetch_assoc();
    
}

if (isset($_POST['action'])) {
    if ($_POST['action'] == 'edit_quotation') {
        
        $id= mysqli_real_escape_string($conn,trim($_POST['quo_id']));
        $quo_no_check= mysqli_real_escape_string($conn,trim($_POST['quo_no_check']));
        $input_quo_no= mysqli_real_escape_string($conn,trim($_POST['input_quo_no']));
        
        
        if($input_quo_no == $quo_no_check){
            
            edit_quo();
            exit;
            
        }else{
            
            $quo_no_check = "SELECT * FROM quotation_appraisal WHERE quo_no =  '$input_quo_no'";
            $query = $conn->query($quo_no_check);
            $check = $query->fetch_assoc();
            
            if ($check) {
                $_SESSION['error'] = "เลขที่ใบเสนอราคากลางนี้มีในระบบแล้ว!";
                header('Location: quotation_appraisal_edit.php?editquo='.$id);
                exit;
                
            }else{
                
                edit_quo();
                exit;
                
            }
        }
    } 
}

function edit_quo()
{

    global $conn;
    date_default_timezone_set('Asia/Bangkok');
    $date = date("Y-m-d H:i:s");
    
    $id= mysqli_real_escape_string($conn,trim($_POST['quo_id']));
    $quo_date_create= mysqli_real_escape_string($conn,trim($_POST['quo_date_create']));
    $input_quo_no= mysqli_real_escape_string($conn,trim($_POST['input_quo_no']));
    $input_quo_date= mysqli_real_escape_string($conn,trim($_POST['input_quo_date']));
    $input_quo_namepj= mysqli_real_escape_string($conn,trim($_POST['input_quo_namepj']));
    $input_quo_name= mysqli_real_escape_string($conn,trim($_POST['input_quo_name']));
    $input_quo_address= mysqli_real_escape_string($conn,trim($_POST['input_quo_address']));
    $input_quo_sum= mysqli_real_escape_string($conn,trim($_POST['input_quo_sum']));
    $input_quo_specialdis= mysqli_real_escape_string($conn,trim($_POST['input_quo_specialdis']));
    $input_quo_afterdis= mysqli_real_escape_string($conn,trim($_POST['input_quo_afterdis']));
    $input_quo_vat= mysqli_real_escape_string($conn,trim($_POST['input_quo_vat']));
    $input_quo_total= mysqli_real_escape_string($conn,trim($_POST['input_quo_total']));
    $uid = 1;
    
    $query1 = "UPDATE quotation_appraisal SET quo_no='$input_quo_no', quo_date='$input_quo_date', quo_namepj='$input_quo_namepj',
        quo_name='$input_quo_name', quo_address='$input_quo_address', quo_sum='$input_quo_sum',quo_specialdis='$input_quo_specialdis',
        quo_afterdis='$input_quo_afterdis', quo_vat='$input_quo_vat', quo_total='$input_quo_total',quo_update='$date', quo_uid='$uid' WHERE quo_id='$id'";
                
    $query2 = "DELETE FROM quotation_appraisal_details WHERE quode_quoid = '$id'";
    
    if ($conn->query($query1) === TRUE && $conn->query($query2) === TRUE) {

        for($count=0; $count<$_POST["total_item"]; $count++){
        
            $item_name= mysqli_real_escape_string($conn,trim($_POST['item_name'][$count]));
            $item_amount= mysqli_real_escape_string($conn,trim($_POST['item_amount'][$count]));
            $item_price= mysqli_real_escape_string($conn,trim($_POST['item_price'][$count]));
            $total_price= mysqli_real_escape_string($conn,trim($_POST['total_price'][$count]));

            $query = "INSERT INTO quotation_appraisal_details (quode_quoid, quode_item, quode_amount, quode_price,  quode_result, quode_create, quode_update, quode_uid)
                VALUES ('$id', '$item_name', '$item_amount', '$item_price', '$total_price', '$quo_date_create', '$date', '$uid')";
            $conn->query($query);
        }

        $_SESSION['success'] = "แก้ไขใบเสนอราคากลางสำเร็จ!";
        header("Location: quotation_appraisal_list.php");
        exit;
        
    } else {
        $_SESSION['error'] = "เกิดข้อผิดพลาด! กรุณาลองอีกครั้ง";
        header('Location: quotation_appraisal_edit.php?editquo='.$id);
        exit;
        
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

<body>
    <div class="container-fluid">
        <nav aria-label="breadcrumb" class="main-breadcrumb mt-2">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a
                        href="../dashboard/quotation_appraisal_list.php">ใบเสนอราคากลาง</a></li>
                <li class="breadcrumb-item active" aria-current="page">แก้ไขใบเสนอราคากลาง</li>
            </ol>
        </nav>
        <hr>
        <div>
            <h3>แก้ไขข้อมูลใบเสนอราคากลาง quotation appraisal</h3>
        </div>
        <form method="post" id="quotation_form" action="quotation_appraisal_edit.php" class="px-md-5 py-md-5">
            <div class="row g-3 align-items-center mb-3">
                <div class="col-md-3">
                    <label for="input_quo_no" class="col-form-label">เลขที่ No.</label>
                </div>
                <div class="col-auto">
                    <input type="number" id="input_quo_no" name="input_quo_no" class="form-control " required
                        value="<?= $row['quo_no'] ?>">
                </div>
            </div>
            <div class="row g-3 align-items-center mb-3">
                <div class="col-md-3">
                    <label for="input_quo_date" class="col-form-label">วันที่ date.</label>
                </div>
                <div class="col-auto">
                    <input type="date" id="input_quo_date" name="input_quo_date" class="form-control " required
                        value="<?= $row['quo_date'] ?>">
                </div>
            </div>
            <div class="row g-3 align-items-center mb-3">
                <div class="col-md-3 ">
                    <label for="input_quo_namepj" class="col-form-label">ชื่อโครงการ :</label>
                </div>

                <div class="col-md-8">
                    <input type="text" id="input_quo_namepj" name="input_quo_namepj" class="form-control " required
                        value="<?= $row['quo_namepj'] ?>">
                </div>
            </div>
            <div class=" row g-3 align-items-center mb-3">
                <div class="col-md-3">
                    <label for="input_quo_name" class="col-form-label">ชื่อลูกค้า/หน่วยงาน :</label>
                </div>
                <div class="col-md-8">
                    <input type="text" id="input_quo_name" name="input_quo_name" class="form-control " required
                        value="<?= $row['quo_name'] ?>">
                </div>
            </div>
            <div class="row g-3 mb-3">
                <div class="col-md-3 ">
                    <label for="input_quo_address" class="col-form-label">ที่อยู่ :</label>
                </div>
                <div class="col-md-8">
                    <textarea class="form-control" id="input_quo_address" name="input_quo_address" rows="3"
                        required><?= $row['quo_address']; ?></textarea>
                </div>
            </div>
            <div class="row g-3 align-items-center mb-3">
                <div class="col-md-3 ">
                    <label for="itemtitle" class="col-form-label">แก้ไขรายการใบเสนอราคากลาง :</label>
                </div>
                <div class="border border-secondary rounded-3 py-md-4 px-md-4">
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
                            <?php
                            
                                $sql = "SELECT * FROM quotation_appraisal_details WHERE quode_quoid ='$id'";
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
                                        class="form-control input-sm item_name" value="<?= $rows["quode_item"]; ?>"
                                        required />
                                </td>
                                <td>
                                    <input type="number" name="item_amount[]" id="item_amount<?= $n; ?>"
                                        data-srno="<?= $n; ?>" class="form-control input-sm item_amount"
                                        value="<?= $rows["quode_amount"]; ?>" required />
                                </td>
                                <td>
                                    <input type="number" name="item_price[]" id="item_price<?= $n; ?>"
                                        data-srno="<?= $n; ?>" class="form-control input-sm  item_price"
                                        value="<?= $rows["quode_price"]; ?>" required />
                                </td>
                                <td>
                                    <input type="number" name="total_price[]" id="total_price<?= $n; ?>"
                                        data-srno="<?= $n; ?>" class="form-control input-sm total_price"
                                        value="<?= $rows["quode_result"];?>" readonly />
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
                            <label for="input_quo_sum" class="col-form-label">รวมเป็นเงิน(บาท) :</label>
                        </div>

                        <div class="col-md-5">
                            <input type="number" id="input_quo_sum" name="input_quo_sum" class="form-control "
                                placeholder="0.00" readonly value="<?= $row['quo_sum'] ?>">
                        </div>
                    </div>
                    <div class="row g-3 align-items-center mb-3">
                        <div class="col-md-6 ">
                            <label for="input_quo_specialdis" class="col-form-label text-danger">หักส่วนลดพิเศษ(บาท)
                                :</label>
                        </div>

                        <div class="col-md-5">
                            <input type="number" step="any" id="input_quo_specialdis" name="input_quo_specialdis"
                                class="form-control " placeholder="0.00" title="กรุณากรอกส่วนลด หากมี"
                                value="<?= $row['quo_specialdis'] ?>">
                        </div>
                    </div>
                    <div class="row g-3 align-items-center mb-3">
                        <div class="col-md-6 ">
                            <label for="input_quo_afterdis" class="col-form-label">ยอดรวมหลังหักส่วนลด(บาท)
                                :</label>
                        </div>

                        <div class="col-md-5">
                            <input type="number" id="input_quo_afterdis" name="input_quo_afterdis" class="form-control "
                                placeholder="0.00" readonly value="<?= $row['quo_afterdis'] ?>">
                        </div>
                    </div>
                    <div class="row g-3 align-items-center mb-3">
                        <div class="col-md-6 ">
                            <label for="input_quo_vat" class="col-form-label">ภาษีมูลค่าเพิ่ม 7%(บาท) :</label>
                        </div>

                        <div class="col-md-5">
                            <input type="number" id="input_quo_vat" name="input_quo_vat" class="form-control "
                                placeholder="0.00" readonly value="<?= $row['quo_vat'] ?>">
                        </div>
                    </div>
                    <div class="row g-3 align-items-center mb-3">
                        <div class="col-md-6">
                            <label for="input_quo_total" class="col-form-label">จํานวนเงินรวมทั้งสิ้น(บาท) :</label>
                        </div>

                        <div class="col-md-5">
                            <input type="number" id="input_quo_total" name="input_quo_total" class="form-control "
                                placeholder="0.00" readonly value="<?= $row['quo_total'] ?>">
                        </div>
                    </div>
                </div>
            </div>

            <div class="mx-auto d-flex justify-content-end">
                <button type="reset"
                    class="col-md-3 btn btn-outline-danger btn btn-outline-success p-2 mt-2 rounded-pill fs-5 fw-bold"><i
                        class="fa-solid fa-eraser"></i> ล้างข้อมูล</button>
                <button type="submit" name="action" value="edit_quotation"
                    class="ms-3 col-md-3 btn btn-outline-success p-2 mt-2 rounded-pill fs-5 fw-bold">บันทึกการแก้ไข
                    <i class="fa-solid fa-angles-right"></i></button>
                <input type="hidden" name="total_item" id="total_item" value="<?= $n;?>" />
                <input type="hidden" name="quo_no_check" id="quo_no_check" value="<?= $row['quo_no'];?>" />
                <input type="hidden" name="quo_id" id="quo_id" value="<?= $row['quo_id'];?>" />
                <input type="hidden" name="quo_date_create" id="quo_date_create" value="<?= $row['quo_create'];?>" />
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
                            total_price = parseFloat(quantity) * parseFloat(price);
                            $('#total_price' + j).val(
                                total_price
                                .toFixed(2));

                            final_total_price = (final_total_price + total_price);

                        }
                    }
                }
                $('#input_quo_sum').val(final_total_price.toFixed(2));
                var discount = 0;
                var afterdis = 0;
                var vat7per = 0;
                var aftervat = 0;
                discount = $('#input_quo_specialdis').val();
                afterdis = final_total_price - discount;
                $('#input_quo_afterdis').val(afterdis.toFixed(2));
                vat7per = (afterdis * 0.07);
                $('#input_quo_vat').val(vat7per.toFixed(2));
                aftervat = (afterdis + vat7per);
                $('#input_quo_total').val(aftervat.toFixed(2));
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

        });
        </script>
    </div>
</body>
<?php  $conn->close();?>