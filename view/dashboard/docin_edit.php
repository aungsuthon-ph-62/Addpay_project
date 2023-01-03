<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index">หน้าหลัก</a></li>
        <li class="breadcrumb-item"><a href="?page=doc">หนังสือ</a></li>
        <li class="breadcrumb-item"><a href="?page=doc_in">หนังสือเข้า</a></li>
        <li class="breadcrumb-item active" aria-current="page">แก้ไขข้อมูลหนังสือเข้า</li>
    </ol>
</nav>
<hr>

<div class="container bg-secondary-addpay rounded-5">
    <div class="main-body p-md-5 text-white">
        <div id="paperquotation" class="container p-3 p-md-5">

            <div class="p-4 p-md-5 bg-white rounded-5 shadow-lg">
                <div class="text-center text-md-start text-dark my-3">
                    <h3>แก้ไขข้อมูลหนังสือเข้า #</h3>
                </div>
                <form action="" method="post" class="p-md-5">
                    <div class="row align-items-center text-dark px-md-5 mb-3">
                        <div class="col-md-3">
                            <h6 for="inputsrcname" class="col-form-label">ชื่อบริษัทต้นทาง </h6>
                        </div>
                        <div class="col-md-9">
                            <input type="text" id="inputsrcname" class="form-control " required>
                        </div>
                    </div>
                    <div class="row align-items-center text-dark px-md-5 mb-3">
                        <div class="col-md-3">
                            <h6 for="inputDate" class="col-form-label">วันที่ </h6>
                        </div>
                        <div class="col-md-9">
                            <input type="date" id="inputDate" class="form-control " required>
                        </div>
                    </div>
                    <div class="row align-items-center text-dark px-md-5 mb-3">
                        <div class="col-md-3">
                            <h6 for="inputTitle" class="col-form-label">ชื่อเรื่อง </h6>
                        </div>
                        <div class="col-md-9">
                            <input type="text" id="inputTitle" class="form-control " required>
                        </div>
                    </div>
                    <div class="row align-items-center text-dark px-md-5 mb-3">
                        <div class="col-md-3 ">
                            <h6 for="inputTo" class="col-form-label">เรียน (ถึงใคร) </h6>
                        </div>

                        <div class="col-md-9">
                            <input type="text" id="inputTo" class="form-control " required>
                        </div>
                    </div>
                    <div class="row align-items-center text-dark px-md-5 mb-3">
                        <div class="col-md-3 ">
                            <h6 for="inputFile" class="col-form-label">เพิ่มไฟล์ </h6>
                        </div>

                        <div class="col-md-9">
                            <input type="file" id="inputFile" class="form-control " required>
                        </div>
                    </div>

                    <!-- Submit button -->
                    <div class="row mt-5">
                        <div class="col-md-12">
                            <div class="d-flex justify-content-end">
                                <button type="reset" class="btn bg-secondary-addpay text-white me-3"><i class="fa-solid fa-arrow-rotate-left"></i> ล้างข้อมูล</button>
                                <button type="submit" class="btn btn-addpay text-white">บันทึก <i class="fa-solid fa-cloud-arrow-up"></i></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>