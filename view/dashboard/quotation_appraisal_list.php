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

    .btn-group {
        white-space: nowrap;
    }

    @media (max-width: 767px) {
        .table-responsive .dropdown-menu {
            position: static !important;
        }
    }

    @media (min-width: 768px) {
        .table-responsive {
            overflow: inherit;
        }
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

        <div id="listquotation" class="container pb-md-0 mb-5">
            <div>
                <h3>ใบเสนอราคา Quotation</h3>
            </div>

            <div class="mx-auto d-flex justify-content-end">
                <a class="btn btn-success px-2 px-md-4 mt-2 rounded-3 fs-5 fw-bold " role="button" href="../dashboard/quotation_appraisal_add.php"><i class="fa-solid fa-file-circle-plus"></i> สร้างใบเสนอราคา</a>
            </div>


            <div class="border border-secondary rounded-3 py-md-4 px-md-4 mt-2 mt-md-4" id="main_row">
                <div class="table-responsive">
                    <table class="table" id="quotationTable">
                        <thead>
                            <tr class="align-center" class="rows">
                                <th scope="col" style="width:12%" class=" text-center">วันที่สร้าง</th>
                                <th scope="col" style="width:12%" class=" text-center">วันที่<br>ในใบเสนอราคา</th>
                                <th scope="col" style="width:20%" class=" text-center">เลขที่ใบเสนอราคา</th>
                                <th scope="col" style="width:31%" class=" text-center">ชื่อลูกค้า</th>
                                <th scope="col" style="width:15%" class=" text-center">จำนวนเงินรวม</th>
                                <th scope="col" style="width:10%" class=" text-center">ตัวเลือก</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <tr>
                                <td>13/04/2565</td>
                                <td>13/04/2565</td>
                                <td>64578</td>
                                <td>IMCO PACK CORPRATION LIMITED</td>
                                <td>11,181.50</td>
                                <td>
                                    <div>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-dark dropdown-toggle px-2 px-md-4" data-bs-toggle="dropdown" aria-expanded="false"><b>เลือก</b> </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="#">พิมพ์เอกสาร</a></li>
                                                <li><a class="dropdown-item" href="#">แก้ไข</a></li>
                                                <li><a class="dropdown-item" href="#">ลบ</a></li>

                                            </ul>
                                        </div>

                                        <!-- <a href="../dashboard/edit_archives.php">
                                            <button type="button" class="float-start mr-1 btn btn-warning btn-sm text-white px-3"><i class="fa-solid fa-pen-to-square"></i></button>
                                        </a>

                                        <a href="" class="">
                                            <button type="button" class="float-end mr-1 btn btn-danger btn-sm px-3"><i class="fa-solid fa-trash-can"></i></button>
                                        </a> -->
                                    </div>

                                </td>
                            </tr>
                            <tr>
                                <td>13/04/2565</td>
                                <td>13/04/2565</td>
                                <td>64598</td>
                                <td>IMCO  CORPRATION LIMITED</td>
                                <td>11,181.50</td>
                                <td>
                                    <div>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-dark dropdown-toggle px-2 px-md-4" data-bs-toggle="dropdown" aria-expanded="false"><b>เลือก</b> </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="#">พิมพ์เอกสาร</a></li>
                                                <li><a class="dropdown-item" href="#">แก้ไข</a></li>
                                                <li><a class="dropdown-item" href="#">ลบ</a></li>

                                            </ul>
                                        </div>

                                        <!-- <a href="../dashboard/edit_archives.php">
                                            <button type="button" class="float-start mr-1 btn btn-warning btn-sm text-white px-3"><i class="fa-solid fa-pen-to-square"></i></button>
                                        </a>

                                        <a href="" class="">
                                            <button type="button" class="float-end mr-1 btn btn-danger btn-sm px-3"><i class="fa-solid fa-trash-can"></i></button>
                                        </a> -->
                                    </div>

                                </td>
                            </tr>
                            <tr>
                                <td>13/04/2565</td>
                                <td>13/04/2565</td>
                                <td>64576</td>
                                <td>IMCO PACK LIMITED</td>
                                <td>11,181.50</td>
                                <td>
                                    <div>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-dark dropdown-toggle px-2 px-md-4" data-bs-toggle="dropdown" aria-expanded="false"><b>เลือก</b> </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="#">พิมพ์เอกสาร</a></li>
                                                <li><a class="dropdown-item" href="#">แก้ไข</a></li>
                                                <li><a class="dropdown-item" href="#">ลบ</a></li>

                                            </ul>
                                        </div>

                                        <!-- <a href="../dashboard/edit_archives.php">
                                            <button type="button" class="float-start mr-1 btn btn-warning btn-sm text-white px-3"><i class="fa-solid fa-pen-to-square"></i></button>
                                        </a>

                                        <a href="" class="">
                                            <button type="button" class="float-end mr-1 btn btn-danger btn-sm px-3"><i class="fa-solid fa-trash-can"></i></button>
                                        </a> -->
                                    </div>

                                </td>
                            </tr>

                        </tbody>


                    </table>
                </div>



            </div>
            <!-- Data table -->
            <script type="text/javascript">
                $(document).ready(function() {
                    $('#quotationTable').DataTable();
                });
            </script>
            <!-- Data table -->




        </div>




    </div>
</div>