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

<div class="container">
    <div class="main-body">
        <nav aria-label="breadcrumb" class="main-breadcrumb mt-2">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">การเงิน บัญชี</li>
            </ol>
        </nav>
        <hr>
        <!-- <div class="row gutters-sm text-center justify-content-center align-items-center">
            <div class="col-5 p-3">
                <div class="box-left">
                    <div class="col">
                        <img src="../../image/budget.png" alt="" style="width: 80px;">
                    </div>
                    <a href="../dashboard/expenses.php" style="text-decoration: none;">ข้อมูลใบสำคัญจ่าย</a>
                </div>
            </div>
            <div class="col-5 p-3">
                <div class="box-left">
                    <div class="col">
                        <img src="../../image/budget.png" alt="" style="width: 80px;">
                    </div>
                    <a href="../dashboard/expenses.php" style="text-decoration: none;">ข้อมูลใบสำคัญจ่าย</a>
                </div>
            </div>
            
        </div> -->

        <div class="col-12 rounded-5 p-3 ">
            <div class="row p-4 text-center d-flex justify-content-center">
                <div class="col-10 col-md-4 rounded-2 mb-3 ">
                    <div class="card  p-3 ">
                        <div class="card-title fw-bold">
                            <img src="../../image/expenses.png" alt="" width="50%">
                        </div>
                        <div class="card-text">
                            <a class="text-decoration-none" href="../../view/dashboard/expenses.php">ข้อมูลใบสำคัญจ่าย</a>
                        </div>
                    </div>
                </div>
                <div class="col-10 col-md-4 rounded-2 mb-3">
                    <div class="card  p-3">
                        <div class="card-title fw-bold">
                            <img src="../../image/invoice.png" alt="" width="50%">
                        </div>
                        <div class="card-text">
                            <a class="text-decoration-none" href="../../view/dashboard/expenses.php">ข้อมูลใบแจ้งหนี้</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>