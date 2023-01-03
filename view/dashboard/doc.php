<?php
include_once '../../layout/head.php';
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

<div class="container py-5">
    <div class="main-body">
        <nav aria-label="breadcrumb" class="main-breadcrumb mt-2">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="../dashboard.php">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">หนังสือ</li>
            </ol>
        </nav>
        <hr>

        <div class="col-12 rounded-5 p-3 ">
            <div class="row p-4 text-center d-flex justify-content-center">
                <div class="col-10 col-md-4 rounded-2 mb-3 ">
                    <div class="card  p-3 ">
                        <div class="card-title fw-bold p-3">
                            <img src="../../image/doc-in.png" alt="" width="50%">
                        </div>
                        <div class="card-text">
                            <a class="text-decoration-none" href="../../view/dashboard/docin_add.php">หนังสือเข้า</a>
                        </div>
                    </div>
                </div>
                <div class="col-10 col-md-4 rounded-2 mb-3">
                    <div class="card  p-3">
                        <div class="card-title fw-bold p-3">
                            <img src="../../image/doc-out.png" alt="" width="50%">
                        </div>
                        <div class="card-text">
                            <a class="text-decoration-none" href="../../view/dashboard/docout_add.php">หนังสือออก</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>