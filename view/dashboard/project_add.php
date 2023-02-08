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
                                        <th width="7%">ลำดับ</th>
                                        <th width="30%">หัวข้อ</th>
                                        <th width="58%">รายละเอียด</th>
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
                                            <input type="text" name="title_name[]" id="title_name<?= $n; ?>"
                                                class="form-control input-sm title_name" data-srno="<?= $n; ?>"
                                                value="<?= $svinput[$index][0] ?>" required />
                                        </td>
                                        <td>
                                            <textarea class="form-control title_detail" name="title_detail[]" id="title_detail<?= $n; ?>" 
                                            data-srno="<?= $n; ?>"rows="3" value="<?= $svinput[$index][1] ?>" required></textarea>
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
                                        <td><input type="text" name="title_name[]" id="title_name1" data-srno="1"
                                                class="form-control input-sm title_name" required />
                                        </td>
                                        <td>
                                            <textarea class="form-control title_detail" name="title_detail[]" id="title_detail1" 
                                                data-srno="1"rows="3"  required></textarea>
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
                        html_code += '<tr id="row_id_' + count + '">';
                        html_code += '<td><span id="sr_no"></span></td>';

                        html_code +=
                            '<td><input type="text" name="title_name[]" id="title_name' + count +
                            '" class="form-control input-sm" required/></td>';
                        html_code +=
                            '<td><textarea class="form-control title_detail" name="title_detail[]" id="title_detail' + count + 
                             '" data-srno="' + count +'" rows="3" required/></textarea></td>';
                        html_code +=
                            '<td><button type="button" name="remove_row" id="' + count +
                            '" class="btn btn-danger btn-xs remove_row">X</button></td>';
                        html_code += '</tr>';
                        $('#project-item-table').append(html_code);
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