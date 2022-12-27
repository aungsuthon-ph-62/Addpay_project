<?php
include_once '../../layout/head.php';
?>


<style>
    .font {
        font-size: 1rem;
    }

    body {
        font-family: "Kanit", sans-serif;
        font-family: "Noto Sans", sans-serif;
        font-family: "Noto Sans Thai", sans-serif;
        font-family: "Poppins", sans-serif;
        font-family: "Prompt", sans-serif;
    }
</style>

<div class="container py-5">
    <div class="main-body">
        <nav aria-label="breadcrumb" class="main-breadcrumb mt-2">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="../../view/dashboard.php">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="../dashboard/doc.php">หนังสือ</a></li>
                <li class="breadcrumb-item"><a href="../dashboard/docout.php">หนังสือออก</a></li>
                <li class="breadcrumb-item active" aria-current="page">เพิ่มข้อมูลหนังสือออก</li>
            </ol>
        </nav>
        <hr>

        <div id="paperquotation" class="container pb-md-0 mb-5">
            <div>
                <h3>เพิ่มข้อมูลหนังสือออก</h3>
            </div>
            <div class=" px-md-5 py-md-4 justify-content-center">
                <div class="p-2 py-md-4 px-md-5 border rounded-3">
                    <!-- modal form -->
                    <form action="" method="post" class="">
                        <div class="row g-3 align-items-center mb-3">
                            <div class="col-md-3">
                                <label for="inputname" class="col-form-label">ชื่อบริษัทต้นทาง  </label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" id="inputname" class="form-control " required>
                            </div>
                        </div>
                        <div class="row g-3 align-items-center mb-3">
                            <div class="col-md-3">
                                <label for="inputDate" class="col-form-label">วันที่  </label>
                            </div>
                            <div class="col-md-9">
                                <input type="date" id="inputDate" class="form-control " required>
                            </div>
                        </div>
                        <div class="row g-3 align-items-center mb-3">
                            <div class="col-md-3">
                                <label for="inputTitle" class="col-form-label">ชื่อเรื่อง </label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" id="inputTitle" class="form-control " required>
                            </div>
                        </div>
                        <div class="row g-3 align-items-center mb-3">
                            <div class="col-md-3 ">
                                <label for="inputTo" class="col-form-label">เรียน (ถึงใคร) </label>
                            </div>

                            <div class="col-md-9">
                                <input type="text" id="inputTo" class="form-control " required>
                            </div>
                        </div>
                        <div class="row g-3 align-items-center mb-3">
                            <div class="col-md-3 ">
                                <label for="inputSend" class="col-form-label">สิ่งที่ส่งมาด้วย </label>
                            </div>

                            <div class="col-md-9">
                                <input type="text" id="inputSend1" class="form-control " required>
                            </div>
                            <div class="col-md-9">
                                <input type="text" id="inputSend2" class="form-control ">
                            </div>
                            <div class="col-md-9">
                                <input type="text" id="inputSend3" class="form-control ">
                            </div>
                        </div>
                        <div class="row g-3 align-items-center mb-3">
                            <div class="col-md-3 ">
                                <label for="inputDetails1" class="col-form-label">รายละเอียดหนังสือ (ย่อหน้า 1)</label>
                            </div>

                            <div class="col-md-9">
                            <textarea class="form-control" id="textDetails1" rows="5" require></textarea>
                            </div>
                        </div>
                        <div class="row g-3 align-items-center mb-3">
                            <div class="col-md-3 ">
                                <label for="inputDetails2" class="col-form-label">รายละเอียดหนังสือ (ย่อหน้า 2)</label>
                            </div>

                            <div class="col-md-9">
                            <textarea class="form-control" id="textDetails2" rows="5" require></textarea>
                            </div>
                        </div>

                        <!-- Submit button -->
                        <div class="mx-auto d-flex justify-content-end">
                            <button type="reset" class=" btn btn-outline-danger btn btn-outline-success px-2 mt-2 rounded-3 fw-bold"><i class="fa-solid fa-eraser"></i> ล้างข้อมูล</button>
                            <button type="submit" class="ms-3  btn btn-outline-success px-2 mt-2 rounded-3  fw-bold">บันทึก <i class="fa-solid fa-angles-right"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>