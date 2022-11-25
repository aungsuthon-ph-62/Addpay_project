<?php
include "../../layout/head.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        Addpay-Project
    </title>
    
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

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->

        <!-- Sidebar -->

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">สัญญาแนบเข้า</li>
            </ol>
            </nav>
            <h1 class="h5 pt-2">สัญญาแนบเข้า</h1>
            <hr noshade="noshade">

            <form class="container">
            <div class="row">
                <div class="col-sm-8">
                <div class="form-floating mb-3">
                   <input type="date" class="form-control" id="contract_lgdeld" placeholder="วันที่ส่ง LG">
                   <label for="contract_lgdeld">&nbsp; วันที่ส่ง LG</label>
                </div>
                <div class="form-floating mb-3">
                   <input type="date" class="form-control" id="contract_lgexpd" placeholder="วันที่ LG หมดอายุ<">
                   <label for="contract_lgexpd">&nbsp; วันที่ LG หมดอายุ</label>
                </div>
                <div class="form-floating mb-3">
                   <input type="text" class="form-control" id="contract_title" placeholder="ชื่อสัญญา">
                   <label for="contract_title">&nbsp; ชื่อสัญญา</label>
                </div>
                <div class="form-floating mb-3">
                   <input type="text" class="form-control" id="contract_comp" placeholder="ชื่อบริษัท">
                   <label for="contract_comp">&nbsp; ชื่อบริษัท</label>
                </div>
                <div class="mb-3">
                   <label for="contract_file" class="form-label">&nbsp;แนบไฟล์สัญญา</label>
                   <input class="form-control" type="file" id="contract_file">
                </div>
                <div class="mb-3">
                   <label for="contract_filesigner" class="form-label">&nbsp;แนบไฟล์เอกสารของผู้เซ็นสัญญา</label>
                   <input class="form-control" type="file" id="contract_filesigner ">
                </div>
                <div class="col-12 mb-5">
                    <button class="btn btn-primary" type="submit">Submit form</button>
                </div>
                </div>
                <div class="col-sm-4"></div>
            </div>
            
                <h1 class="h5 pt-2" id="contract_ann ">วันประกาศผล</h1>

                <!--Table-->
                <table class="table">
                    <thead class="table-light">
                        <tr>
                        <th scope="col">วันที่ส่ง LG</th>
                        <th scope="col">วันที่ LG หมดอายุ</th>
                        <th scope="col">ชื่อสัญญา</th>
                        <th scope="col">ชื่อบริษัท</th>
                        <th scope="col">ไฟล์สัญญา</th>
                        <th scope="col">ไฟล์เอกสารของผู้เซ็นสัญญา</th>
                        <th scope="col">วันประกาศผล</th>
                        <th scope="col">แก้ไข</th>
                        </tr>
                    </thead>
                </table>
                </div>
            </form>

        </main>
    </div>
</div>

<style>
    body {
        font-family: "Kanit", sans-serif;
        font-family: "Noto Sans", sans-serif;
        font-family: "Noto Sans Thai", sans-serif;
        font-family: "Poppins", sans-serif;
        font-family: "Prompt", sans-serif;
    }
</style>