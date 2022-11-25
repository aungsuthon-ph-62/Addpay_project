<?php
include("../../layout/head.php");
?>


<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script>
        $(function() {
            $("body").on("click", "#add_sub", function(e) {
                e.preventDefault()
                $(this).closest("#row_sub_add").append("<div id='row_sub_remove' class='mt-1 form-inline '> <p class='col-md-1'><input class='form-control w-100' mane='[]' placeholder='ที่' require></p> <p class='col-md-4'><input class='form-control w-100' mane='[]' placeholder='รายการ' require></p> <p class='col-md-2'><input class='form-control w-100' mane='[]' placeholder='จำนวน' require></p> <p class='col-md-2'><input class='form-control w-100' mane='[]' placeholder='ราคา/หน่วย' require></p> <p class='col-md-2'><input class='form-control w-100' mane='[]' placeholder='280.00' disabled></p> <p class='col-md-1'><button type='button' class='float-right mr-1 btn btn-danger btn-sm' id='remove_sub'><i class='fa-solid fa-trash-can'></i></button></p> </div>")
            });

            $("body").on("click", "#remove_sub", function(e) {
                e.preventDefault()
                $(this).closest("#row_sub_remove").remove()
            });

        });
    </script>
    </script>

    </script>
</head>

<style>
    body {
        font-family: "Kanit", sans-serif;
        font-family: "Noto Sans", sans-serif;
        font-family: "Noto Sans Thai", sans-serif;
        font-family: "Poppins", sans-serif;
        font-family: "Prompt", sans-serif;
    }
</style>

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
            <div>
                <h3>ข้อมูลใบเสนอราคา Quotation</h3>
            </div>


            <!-- modal form -->
            <form action="" method="post" class="px-md-5 py-md-5">
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
                        <input type="text" id="inputrev" class="form-control " pattern="[0-9]{13}" title="กรุณากรอกตัวเลข 0-9 จำนวน 13 หลัก ไม่มี (-)" required>
                    </div>
                </div>
                <div class="row g-3 align-items-center mb-3">
                    <div class="col-md-3 ">
                        <label for="itemtitle" class="col-form-label">รายการใบเสนอราคากลาง :</label>
                    </div>


                    <div class="border border-secondary rounded-3 py-md-3" id="main_row">
                        <div id="row_sub_add" class="row d-flex align-items-center">
                            <div class="form-inline">
                                <p class="col-md-1 ">ลำดับที่</p>
                                <p class="col-md-4 ">รายการ / Description</p>
                                <p class="col-md-2 text-center ">จำนวน <br> Amount</p>
                                <p class="col-md-2 text-center ">ราคา/หน่วย <br> Price / Unit</p>
                                <p class="col-md-2 text-center ">จำนวนเงิน <br> บาท </p>
                                <p class="col-md-1 text-center"><button type="button" class="btn btn-success btn-outline-success text-light rounded-4 btn-sm mr-1 float-right" id="add_sub"><i class="fa fa-plus-circle text-white"></i> เพิ่มรายการ</button></p>
                            </div>
                            <div id="row_sub_remove" class="mt-1 form-inline">
                                <p class="col-md-1"><input class="form-control w-100" placeholder="ที่" required></p>
                                <p class="col-md-4"><input class="form-control w-100" placeholder="รายการ" required></p>
                                <p class="col-md-2"><input class="form-control w-100" placeholder="จำนวน" required></p>
                                <p class="col-md-2"><input class="form-control w-100" placeholder="ราคา/หน่วย" required></p>
                                <p class="col-md-2"><input class="form-control w-100" placeholder="280.00" disabled></p>
                                <p class="col-md-1"><button type="button" class="float-right mr-1 btn btn-danger btn-sm" id="remove_sub"><i class="fa-solid fa-trash-can"></i></button></p>
                            </div>
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
                                <label for="inputsum" class="col-form-label">รวมเป็นเงิน :</label>
                            </div>

                            <div class="col-md-5">
                                <input type="text" id="inputsum" class="form-control " placeholder="280.00" disabled>
                            </div>
                        </div>
                        <div class="row g-3 align-items-center mb-3">
                            <div class="col-md-6 ">
                                <label for="inputdis" class="col-form-label text-danger">หักส่วนลดพิเศษ :</label>
                            </div>

                            <div class="col-md-5">
                                <input type="text" id="inputdis" class="form-control " placeholder="20.00" title="กรุณากรอกส่วนลด หากไม่มี (-)" required>
                            </div>
                        </div>
                        <div class="row g-3 align-items-center mb-3">
                            <div class="col-md-6 ">
                                <label for="afterdis" class="col-form-label">ยอดรวมหลังหักส่วนลด :</label>
                            </div>

                            <div class="col-md-5">
                                <input type="text" id="afterdis" class="form-control " placeholder="260.00" disabled>
                            </div>
                        </div>
                        <div class="row g-3 align-items-center mb-3">
                            <div class="col-md-6 ">
                                <label for="vat" class="col-form-label">ภาษีมูลค่าเพิ่ม 7% :</label>
                            </div>

                            <div class="col-md-5">
                                <input type="text" id="vat" class="form-control " placeholder="280.00" disabled>
                            </div>
                        </div>
                        <div class="row g-3 align-items-center mb-3">
                            <div class="col-md-6">
                                <label for="total" class="col-form-label">จํานวนเงินรวมทั้งสิ้น :</label>
                            </div>

                            <div class="col-md-5">
                                <input type="text" id="total" class="form-control " placeholder="280.00" disabled>
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





                <!-- Submit button -->
                <div class="mx-auto d-flex justify-content-end">
                    <button type="reset" class="col-md-3 btn btn-outline-danger btn btn-outline-success p-2 mt-2 rounded-pill fs-5 fw-bold btn-addpay"><i class="fa-solid fa-eraser"></i> ล้างข้อมูล</button>
                    <button type="submit" class="ms-3 col-md-3 btn btn-outline-success p-2 mt-2 rounded-pill fs-5 fw-bold btn-addpay">ต่อไป <i class="fa-solid fa-angles-right"></i></button>
                </div>


            </form>





        </div>



    </div>
</div> 