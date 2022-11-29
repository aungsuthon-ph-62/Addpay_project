<?php
include("../../layout/head.php");

?>

<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:ital,wght@0,100;0,200;0,400;0,500;0,600;0,700;0,800;1,200;1,300;1,400;1,500&display=swap" rel="stylesheet">
</head>

<style>
    body {
        font-family: 'Sarabun', sans-serif;
    }
</style>

<div class="container  py-md-5 px-md-4" style="width: 80%;">
    <div class="main-body">
        <div id="quotationForm" class="container pb-md-0 mb-5 mt-5">
            <div class="row text-center">
                <div class="col-md-4 p-md-2">
                    <div class="text-center">
                        <img src="../../image/addpay-form-text.png" class="img-fluid position-relative" style="width: 18rem;" alt="addpay_logo_form">
                    </div>
                    <div class="text-center p-md-3 px-md-5">
                        <div class="border border-dark border-3 p-md-3 px-md-4">
                            <p class="fw-bold mb-md-4">ข้อมูลใบเสนอราคา</p>
                            <p class="fw-bold">Quotation</p>
                        </div>
                    </div>

                </div>
                <div class="col-md-8 p-md-2 pt-md-5">
                    <div class="text-center mb-md-5">
                        <p class="fw-bold mb-md-4">บริษัท แอดเพย์ เซอร์วิสพอยท์ จํากัด</p>
                        <p class="">406 หมู่ 18 ตําบลขามใหญ่ อําเภอเมือง จังหวัดอุบลราชธานี โทร. 045-317123</p>
                    </div>
                    <div class="float-end col-md-5">
                        <div class="text-center">
                            <div class="row g-3 align-items-center mb-3">
                                <div class="col-md-4">
                                    <label for="noForm" class="col-form-label">เลขที่/No.</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" id="noForm" class="form-control border border-2 border-dark border-start-0 border-top-0 border-end-0 rounded-0" required>
                                </div>
                            </div>
                        </div>
                        <div class="text-center  ">
                            <div class="row g-3 align-items-center mb-3">
                                <div class="col-md-4">
                                    <label for="DateForm" class="col-form-label">วันที่/Date.</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" id="DateForm" class="form-control border border-2 border-dark border-start-0 border-top-0 border-end-0 rounded-0" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>