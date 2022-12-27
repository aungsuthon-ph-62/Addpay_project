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
                <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="../dashboard/quotation_appraisal_list.php">ใบเสนอราคากลาง</a></li>
                <li class="breadcrumb-item active" aria-current="page">เพิ่มเอกสารสำคัญ</li>
            </ol>
        </nav>
        <hr>

        <div id="paperquotation" class="container pb-md-0 mb-5">
            <div>
                <h3>เอกสารสำคัญ</h3>
            </div>
            <div class="px-md-5 py-md-4 d-flex justify-content-center">
                <div class="p-2 px-md-5 py-md-4 border rounded-3 ">
                    <form action="" method="post" class="">
                        <div class="row g-3 align-items-center mb-3">
                            <div class="col-md-3">
                                <label for="Archiname" class="col-form-label">ชื่อเรื่อง </label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" id="Archiname" class="form-control " required>
                            </div>
                        </div>
                        <div class="row g-3 align-items-center mb-3">
                            <div class="col-md-3">
                                <label for="Archifile" class="col-form-label">เพิ่มไฟล์ที่นี่ </label>
                            </div>
                            <div class="col-md-9">
                                <input type="file" id="Archifile" class="form-control " required>
                            </div>
                        </div>

                        <!-- Submit button -->
                        <div class="mx-auto d-flex justify-content-end">
                            <button type="reset" class="btn btn-outline-danger btn btn-outline-success px-2 mt-2 rounded-3 fw-bold"><i class="fa-solid fa-eraser"></i> ล้างข้อมูล</button>
                            <button type="submit" class="ms-3  btn btn-outline-success px-2 mt-2 rounded-3  fw-bold">บันทึก <i class="fa-solid fa-angles-right"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>