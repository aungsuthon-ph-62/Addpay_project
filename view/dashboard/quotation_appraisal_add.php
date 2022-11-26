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

<script>
    var items = 0;

    function addItem() {
        items++;

        var html = "<tr>";
        html += "<th scope='row'>" + items + "</th>";
        html += "<td><input type='text' class='form-control w-100' placeholder='รายการ' name='itemName[]'></td>";
        html += "<td><input type='number' class='form-control w-100' placeholder='จำนวน' name='itemamount[]'></td>";
        html += "<td><input type='number' class='form-control w-100' placeholder='ราตาต่อหน่วย' name='itemprice[]'></td>";
        html += "<td><input type='text' class='form-control w-100' placeholder='280.00' name='itemresult[]' disabled></td>";
        html += "<td><button type='button' class='float-end mr-1 btn btn-danger btn-sm' onclick='deleteRow(this);'><i class='fa-solid fa-trash-can'></i></button></td>"
        html += "</tr>";

        var row = document.getElementById("tbody").insertRow();
        row.innerHTML = html;
    }

    function deleteRow(button) {
        items--
        button.parentElement.parentElement.remove();
        // first parentElement will be td and second will be tr.
    }
</script>




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


                    <div class="border border-secondary rounded-3 py-md-4 px-md-4" id="main_row">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr class="align-top">
                                        <th scope="col" style="width:3%">ลำดับ</th>
                                        <th scope="col" style="width:47%" >รายการ / Description</th>
                                        <th scope="col" style="width:10%" class=" text-center">จำนวน <br> Amount</th>
                                        <th scope="col" style="width:20%" class=" text-center">ราคา/หน่วย <br> Price / Unit</th>
                                        <th scope="col" style="width:20%" class=" text-center">จำนวนเงิน <br> บาท </th>
                                    </tr>
                                </thead>
                                <tbody id="tbody"></tbody>


                            </table>
                        </div>
                        <div class="text-center">
                            <button type="button" onclick="addItem();" class="btn btn-success px-4 rounded-pill fs-5 fw-bold " id="add_sub"><i class="fa fa-plus-circle text-white"></i> เพิ่มรายการ</button>
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