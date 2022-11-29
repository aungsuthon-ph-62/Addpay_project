<script>
$(document).ready(function() {

    $('.contracteditModal').on('click', function() {

        $('#contracteditModal').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function() {
            return $(this).text();
        }).get();

        console.log(data);

        $('#ide').val(data[0]);
        $('#lgd').val(data[1]);
        $('#lge').val(data[2]);
        $('#conname').val(data[3]);
        $('#comname').val(data[4]);
        $('#ann').val(data[7]);
    });
    $('.contractdeleteModal').on('click', function() {

        $('#contractdeleteModal').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function() {
            return $(this).text();
        }).get();

        console.log(data);

        $('#idd').val(data[0]);
        document.getElementById("testc").innerHTML = data[3];
    });
});
</script>
<style>
.table a.table-link {
    text-decoration: none;
}

.table a.table-link:hover {
    color: #2aa493;
}

.table a.table-link.danger {
    text-decoration: none;
    color: #fe635f;
}

.table a.table-link.danger:hover {
    color: #dd504c;
}

.hidden {
    display: none;
    visibility: hidden;
}
</style>
<div class="container">
    <div class="main-body">
        <nav aria-label="breadcrumb" class="main-breadcrumb mt-2">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Contrat</li>
            </ol>
        </nav>
        <hr>
        <div class="row gutters-md">
            <div class="col-md-12">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-end me-2 mb-2">
                            <button type="button" class="btn p-1  text-white" data-bs-toggle="modal"
                                data-bs-target="#contractaddModal" style="background-color:#FE9100 ;"><i
                                    class="fa-solid fa-file-circle-plus">&nbsp;เพิ่มเอกสาร</i></button>
                        </div>
                        <div class=" row">
                            <div class="col-lg-12">
                                <div class="main-box clearfix">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th class="hidden"><span>id</span></th>
                                                    <th><span>วันที่ส่ง LG</span></th>
                                                    <th><span>วันหมดอายุ LG</span></th>
                                                    <th><span>ชื่อสัญญา</span></th>
                                                    <th><span>ชื่อบริษัท</span></th>
                                                    <th><span>ไฟล์สัญญา</span></th>
                                                    <th><span>ไฟล์เอกสารผู้เซ็นสัญญา</span></th>
                                                    <th><span>วันประกาศผล</span></th>
                                                    <th>&nbsp;</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="hidden">12</td>
                                                    <td><?=date("Y-m-d");?></td>
                                                    <td><?=date("Y-m-d");?></td>
                                                    <td>สัญญาเมื่อสายัน</td>
                                                    <td>แอดเพย์ เซอวิสพอยท์</td>
                                                    <td><a href="#">test.pdf</a></td>
                                                    <td><a href="#">test2.pdf</a></td>
                                                    <td><?=date("Y-m-d");?></td>
                                                    <td style="width: 10%;">
                                                        <a class="table-link contracteditModal">
                                                            <span class="fa-stack">
                                                                <i class="fa fa-square fa-stack-2x"></i>
                                                                <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>
                                                            </span>
                                                        </a>
                                                        <a class="table-link danger contractdeleteModal">
                                                            <span class="fa-stack">
                                                                <i class="fa fa-square fa-stack-2x"></i>
                                                                <i class="fa fa-trash fa-stack-1x fa-inverse"></i>
                                                            </span>
                                                        </a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <ul class="pagination pull-right">
                                        <li><a href="#"><i class="fa fa-chevron-left"></i></a></li>
                                        <li>&nbsp;</li>
                                        <li><a href="#">1</a></li>
                                        <li>&nbsp;</li>
                                        <li><a href="#">2</a></li>
                                        <li>&nbsp;</li>
                                        <li><a href="#">3</a></li>
                                        <li>&nbsp;</li>
                                        <li><a href="#"><i class="fa fa-chevron-right"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require("contractmodal.php");?>