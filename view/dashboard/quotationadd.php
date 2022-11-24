<?php
include("../../layout/head.php");
?>

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <script>
        $(function() {
            $("body").on("click", "#add_sub", function(e) {
                e.preventDefault()
                $(this).closest("#row_sub_add").append("<div id='row_sub_remove' class='mt-1 form-inline col-12'> <p class='col-12 col-md-4'><input class='w-100' mane='[]' placeholder='รายการ'></p> <p class='col-12 col-md-2'><input class='w-100' mane='[]' placeholder='จำนวน'></p> <p class='col-12 col-md-2'><input class='w-100' mane='[]' placeholder='ราคา/หน่วย'></p> <p class='col-12 col-md-2'><input class='w-100' mane='[]' placeholder='จำนวนเงิน'></p> <p class='col-12 col-md-2'><button type='button' class='float-right mr-1 btn btn-danger btn-sm' id='remove_sub'><i class='fa fa-minus-circle text-white'></i> ลบรายการ</button></p> </div>")
            });

            $("body").on("click", "#remove_sub", function(e) {
                e.preventDefault()
                $(this).closest("#row_sub_remove").remove()
            });

        });
    </script>
</head>

<div class="container">
    <div class="main-body">
        <nav aria-label="breadcrumb" class="main-breadcrumb mt-2">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">ใบเสนอราคากลาง</li>
            </ol>
        </nav>
        <hr>

        <div id="paperquotation" class="container pb-md-0 mb-5">

            <h3>ข้อมูลใบเสนอราคา Quotation</h3>

            <!-- modal form -->
            <form action="" method="post" class="px-md-5 py-md-5">
                <div class="row g-3 align-items-center mb-3">
                    <div class="col-md-3">
                        <label for="inputNo" class="col-form-label">เลขที่ No.</label>
                    </div>
                    <div class="col-auto">
                        <input type="text" id="inputNo" class="form-control " pattern="[0-9]" title="กรุณากรอกตัวเลข 0-9">
                    </div>
                </div>
                <div class="row g-3 align-items-center mb-3">
                    <div class="col-md-3">
                        <label for="inputname" class="col-form-label">ชื่อลูกค้า :</label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" id="inputname" class="form-control ">
                    </div>
                </div>
                <div class="row g-3 align-items-center mb-3">
                    <div class="col-md-3 ">
                        <label for="inputposition" class="col-form-label">ที่อยู่ :</label>
                    </div>
                    <div class="col-md-8">
                        <textarea class="form-control" id="inputposition" rows="3"></textarea>
                    </div>
                </div>
                <div class="row g-3 align-items-center mb-3">
                    <div class="col-md-3 ">
                        <label for="inputrev" class="col-form-label">เลขประจำตัวผู้เสียภาษี :</label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" id="inputrev" class="form-control " pattern="[0-9]{13}" title="กรุณากรอกตัวเลข 0-9 จำนวน 13 หลัก">
                    </div>
                </div>

                <label for="itemtitle" class="col-form-label">รายการใบเสนอราคากลาง :</label>

                <div class=" border border-secondary rounded-5 py-md-3" id='main_row'>

                    <div id='row_sub_add' class='row col-12 d-flex align-items-center'>
                        <div class='form-inline col-12'>
                            <p class='col-12 col-md-4 '>รายการย่อย</p>
                            <p class='col-12 col-md-2 text-center '>จำนวน</p>
                            <p class='col-12 col-md-2 text-center '>ราคา/หน่วย</p>
                            <p class='col-12 col-md-2 text-center '>จำนวนเงิน</p>
                            <p class='col-12 col-md-2 text-center'><button type='button' class='btn btn-success btn-outline-success text-light rounded-4 btn-sm mr-1 float-right' id='add_sub'><i class='fa fa-plus-circle text-white'></i> เพิ่มรายการ</button></p>
                        </div>
                        <div id='row_sub_remove' class='mt-1 form-inline col-12'>
                            <p class='col-12 col-md-4'><input class='w-100' placeholder="รายการ"></p>
                            <p class='col-12 col-md-2'><input class='w-100' placeholder="จำนวน"></p>
                            <p class='col-12 col-md-2'><input class='w-100' placeholder="ราคา/หน่วย"></p>
                            <p class='col-12 col-md-2'><input class='w-100' placeholder="จำนวนเงิน"></p>
                            <p class='col-12 col-md-2'><button type='button' class='float-right mr-1 btn btn-danger btn-sm' id='remove_sub'><i class='fa fa-minus-circle text-white'></i> ลบรายการ</button></p>
                        </div>
                    </div>
                </div>


                <!-- Submit button -->
                <div class="d-grid gap-2 col-12 mx-auto">
                    <button type="submit" name="submit" class="btn p-3 mt-3 text-white rounded-pill fs-5 fw-bold btn-addpay">สมัครสมาชิก</button>
                </div>


            </form>





        </div>



    </div>
</div>