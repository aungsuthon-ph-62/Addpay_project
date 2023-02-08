<?php

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
        <li class="breadcrumb-item"><a href="?page=project">โครงการประมูล</a></li>
        <li class="breadcrumb-item active" aria-current="page">เพิ่มโครงการประมูล</li>
    </ol>
</nav>
<hr>

<div class="container bg-secondary-addpay rounded-5">
    <div class=" main-body py-md-5 px-md-1 text-white">
        <div id="paperproject" class="container p-3 p-md-5">
            <div class="p-4 p-md-5 bg-white rounded-5 shadow-lg">
                <div class="text-center text-md-start text-dark my-3">
                    <h3>เพิ่มโครงการประมูล</h3>
                </div>
                <form method="post" id="project_form" action="?page=project_add" class="form-anticlear mt-md-5">
                    <div class="row align-items-center text-dark px-md-5 mb-3">
                        <div class="col-md-3 text-md-end">
                            <h6 class="col-form-label">ชื่อโครงการ :</h6>
                        </div>

                        <div class="col-md-8">
                            <input type="text" id="input_pjname" name="input_pjname" class="form-control "
                                required>
                        </div>
                    </div>
                    
                    <div class=" row align-items-center text-dark px-md-5 mb-3">
                        <div class="col-md-3 text-md-end">
                            <h6 class="col-form-label"> หน่วยงานเจ้าของโครงการ :</h6>
                        </div>
                        <div class="col-md-8">
                            <input type="text" id="input_agency" name="input_agency" class="form-control " required>
                        </div>
                    </div>

                    <div class="row align-items-center text-dark px-md-5 mb-3">
                        <div class="col-md-3 text-md-end">
                            <h6 class="col-form-label">งบประมาณโครงการ :</h6>
                        </div>
                        <div class="col-md-8">
                            <input type="text" id="input_budget" name="input_budget" class="form-control " required>
                        </div>
                    </div>

                    <div class="row align-items-center text-dark px-md-5 mb-3">
                        <div class="col-md-3 text-md-end">
                            <h6 class="col-form-label">รายละเอียดพอสังเขป :</h6>
                        </div>
                        <div class="col-md-8">
                            <textarea class="form-control" id="input_detail" name="input_detail" rows="5"
                                required></textarea>
                        </div>
                    </div>

                    <div class="row align-items-center text-dark px-md-5 mb-3">
                        <div class="col-md-3 text-md-end">
                            <h6 class="col-form-label">เลขที่ใบเสนอราคากลาง :</h6>
                        </div>
                        <div class="col-md-3">
                            <input type="text" id="input_budget" name="input_budget" class="form-control " required>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-addpay text-white"> <i class="fa-solid fa-magnifying-glass"></i> ค้นหา</button>
                        </div>
                    </div>
                    <div class="row align-items-center text-dark px-md-5 mb-3">
                        <div class="col-md-3 text-md-end">
                            <h6 class="col-form-label">วันที่ในใบเสนอราคากลาง :</h6>
                        </div>
                        <div class="col-md-3">
                            <input type="text" id="input_date" name="input_date" class="form-control " readonly>
                        </div>
                    </div>
                    <div class="row align-items-center text-dark px-md-5 mb-3">
                        <div class="col-md-3 text-md-end">
                            <h6 class="col-form-label">จำนวนเงินใบเสนอราคากลาง :</h6>
                        </div>
                        <div class="col-md-3">
                            <input type="text" id="input_num" name="input_num" class="form-control "  readonly>
                        </div>
                    </div>
                    <div class="row align-items-center text-dark px-md-5 mb-3">
                        <div class="col-md-3 text-md-end">
                            <h6 class="col-form-label">ไฟล์ใบเสนอราคาที่เซ็นเรียบร้อย :</h6>
                        </div>
                        <div class="col-md-6">
                            <input type="file" id="input_file" name="input_file" class=" form-control " required>
                        </div>
                    </div>




                    <div class="row align-items-center text-dark px-md-5 mb-3">
                        <div class="col-md-3">
                            <h6>รายการตาม TOR :</h6>
                        </div>
                        <div class="border border-secondary rounded-3 p-4">
                            <div class="table-responsive">
                                <table id="project-item-table" class="table ">
                                    <tr>
                                        <th width="7%">ลำดับ <br>Number</th>
                                        <th width="40%">รายการ <br> Description </th>
                                        <th width="13%">จำนวน <br> Amount</th>
                                        <th width="15%">ราคา/หน่วย <br> Price/Unit</th>
                                        <th width="20%">จำนวนเงิน(บาท)</th>
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
                                        <td>
                                            <input type="text" name="item_name[]" id="item_name<?= $n; ?>"
                                                class="form-control input-sm item_name" data-srno="<?= $n; ?>"
                                                value="<?= $svinput[$index][0] ?>" required />
                                        </td>
                                        <td>
                                            <input type="number" name="item_amount[]" id="item_amount<?= $n; ?>"
                                                data-srno="<?= $n; ?>" class="form-control input-sm item_amount"
                                                value="<?= $svinput[$index][1] ?>" required />
                                        </td>
                                        <td>
                                            <input type="number" name="item_price[]" id="item_price<?= $n; ?>"
                                                data-srno="<?= $n; ?>" class="form-control input-sm  item_price"
                                                value="<?= $svinput[$index][2] ?>" required />
                                        </td>
                                        <td>
                                            <input type="number" name="total_price[]" id="total_price<?= $n; ?>"
                                                data-srno="<?= $n; ?>" class="form-control input-sm total_price"
                                                value="<?= $svinput[$index][3] ?>" readonly />
                                        </td>
                                        <td>
                                            <button type="button" name="remove_row" id="<?= $n; ?>"
                                                class="btn btn-danger btn-xs remove_row">X</button>
                                        </td>
                                    </tr>

                                    <?php }
                                }else{ 
                                    $n=1;$deli=0;$spe=0;
                                    ?>
                                    <tr id="row_id_1">
                                        <td><span id="sr_no"></span></td>
                                        <td><input type="text" name="item_name[]" id="item_name1" data-srno="1"
                                                class="form-control input-sm item_name" required />
                                        </td>
                                        <td>
                                            <input type="number" name="item_amount[]" id="item_amount1" data-srno="1"
                                                class="form-control input-sm item_amount" required />
                                        </td>
                                        <td>
                                            <input type="number" name="item_price[]" id="item_price1" data-srno="1"
                                                class="form-control input-sm  item_price" step="any" required />
                                        </td>
                                        <td>
                                            <input type="number" name="total_price[]" id="total_price1" data-srno="1"
                                                class="form-control input-sm total_price" readonly />
                                        </td>
                                        <td></td>
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
                            <div class="row align-items-center text-dark px-md-5 mb-3">
                                <div class="col-md-6 text-md-end">
                                    <h6>ค่าขนส่ง(บาท) :</h6>
                                </div>
                                <div class="col-md-6">
                                    <input type="number" id="input_quo_deli" name="input_quo_deli" class="form-control"
                                        placeholder="0.00" title="กรุณากรอกค่าขนส่ง หากมี"
                                        value="<?php if(isset($_SESSION['deli'])) {echo $_SESSION["deli"];}else{echo 0;} ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row align-items-center text-dark px-md-5 mb-3">
                                <div class="col-md-6 text-md-end">
                                    <label for="input_quo_sum" class="col-form-label">รวมเป็นเงิน(บาท) :</label>
                                </div>

                                <div class="col-md-6">
                                    <input type="number" id="input_quo_sum" name="input_quo_sum" class="form-control "
                                        placeholder="0.00" readonly>
                                </div>
                            </div>
                            <div class="row align-items-center text-dark px-md-5 mb-3">
                                <div class="col-md-6 text-md-end">
                                    <label for="input_quo_specialdis"
                                        class="col-form-label text-danger ">หักส่วนลดพิเศษ(บาท)
                                        :</label>
                                </div>

                                <div class="col-md-6">
                                    <input type="number" id="input_quo_specialdis" name="input_quo_specialdis"
                                        class="form-control " placeholder="0.00" title="กรุณากรอกส่วนลด หากมี"
                                        value="<?php if(isset($_SESSION['spe'])) {echo $_SESSION["spe"];}else{echo 0;}  ?>">
                                </div>
                            </div>
                            <div class="row align-items-center text-dark px-md-5 mb-3">
                                <div class="col-md-6 text-md-end">
                                    <label for="input_quo_afterdis" class="col-form-label">ยอดรวมหลังหักส่วนลด(บาท)
                                        :</label>
                                </div>

                                <div class="col-md-6">
                                    <input type="number" id="input_quo_afterdis" name="input_quo_afterdis"
                                        class="form-control " placeholder="0.00" readonly>
                                </div>
                            </div>
                            <div class="row align-items-center text-dark px-md-5 mb-3">
                                <div class="col-md-6 text-md-end">
                                    <label for="input_quo_vat" class="col-form-label">ภาษีมูลค่าเพิ่ม 7%(บาท) :</label>
                                </div>

                                <div class="col-md-6">
                                    <input type="number" id="input_quo_vat" name="input_quo_vat" class="form-control "
                                        placeholder="0.00" readonly>
                                </div>
                            </div>
                            <div class="row align-items-center text-dark px-md-5 mb-3">
                                <div class="col-md-6 text-md-end">
                                    <label for="input_quo_total" class="col-form-label">จํานวนเงินรวมทั้งสิ้น(บาท)
                                        :</label>
                                </div>

                                <div class="col-md-6">
                                    <input type="number" id="input_quo_total" name="input_quo_total"
                                        class="form-control " placeholder="0.00" readonly>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-5">
                        <div class="col-md-12">
                            <div class="d-flex justify-content-end">
                                <button type="reset" class="btn bg-secondary-addpay text-white me-3"><i
                                        class="fa-solid fa-arrow-rotate-left"></i> ล้างข้อมูล</button>
                                <button type="submit" name="action" value="create_quotation"
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
                        html_code += '<tr id=" row_id_' + count + '">';
                        html_code
                            += '<td><span id="sr_no"></span></td>';
                        html_code
                            += '<td><input type="text" name="item_name[]" id="item_name' + count +
                            '" class="form-control input-sm" required /></td>';
                        html_code
                            += '<td><input type="number" name="item_amount[]" id="item_amount' + count +
                            '" data-srno="' +
                            count +
                            '" class="form-control input-sm number_only item_amount" required /></td>';
                        html_code += '<td><input type="number" name="item_price[]" id="item_price' +
                            count +
                            '" data-srno="' + count +
                            '" class="form-control input-sm number_only item_price" required step="any" /></td>';
                        html_code += '<td><input type="text" name="total_price[]" id="total_price' +
                            count +
                            '" data-srno="' + count +
                            '" class="form-control input-sm total_price" readonly /></td>';
                        html_code += '<td><button type="button" name="remove_row" id="' + count +
                            '" class="btn btn-danger btn-xs remove_row">X</button></td>';
                        html_code += '</tr>';
                        $('#quotation-item-table').append(html_code);
                    });
                    $(document).on('click', '.remove_row',
                        function() {
                            var row_id = $(this).attr("id");
                            $('#row_id_' + row_id).remove();
                            total_item--;
                            $('#total_item').val(total_item);
                            cal_final_total(count);
                        });

                    
                });
                </script>
            </div>
        </div>
    </div>
</div>
<!-- <script src="https://cdn.jsdelivr.net/gh/akjpro/form-anticlear/base.js"></script> -->