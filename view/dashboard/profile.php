<div class="container">
    <div class="main-body">
        <div class="row gutters-sm bg-secondary-addpay rounded-5 p-3 p-md-5 shadow-lg">
            <div class="col-md-4 mb-5 mb-md-0">
                <div class="card-body">
                    <div class="d-flex flex-column align-items-center text-center">
                        <?php if($user['img']) { ?>
                            <img src="image/profile/<?= $user['img'] ?>" alt="profile" class="img-thumbnail rounded-circle bg-primary-addpay p-2 border-0 shadow" style="width: 300px;">
                        <?php }else { ?>
                            <img src="image/profile/cat.png" alt="profile" class="img-thumbnail rounded-circle bg-primary-addpay p-2 border-0 shadow" style="width: 300px;">
                        <?php } ?>
                        <button type="button" class="btn p-2 mt-3 text-white rounded-pill btn-addpay" data-bs-toggle="modal" data-bs-target="#profileeditimgModal"><i class="fa-solid fa-pen-to-square"></i> แก้ไขรูปภาพส่วนตัว</button>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card rounded-5 bg-light shadow">
                    <div class="card-body py-4">
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">คำนำหน้าชื่อ</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <?= $user['prefix'] ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">ชื่อ-นามสกุล</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <?= $user['fname'] ?> <?= $user['lname'] ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3 ">
                                <h6 class="mb-0">เพศ</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <?= $user['gender'] ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">อายุ</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <?= $user['age'] ?>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">ตำแหน่ง</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <?= $user['position'] ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">แผนก</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <?= $user['department'] ?>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">อีเมลล์</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <?= $user['email'] ?>
                                </udiv>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">เบอร์โทร</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <?= $user['phone'] ?>
                            </div>
                        </div>
                        <hr>
                        <div class="row text-center text-md-start">
                            <div class="col-12 mt-3">
                                <button type="button" class="btn p-2 mb-3 mx-md-2 text-white btn-addpay rounded-pill" data-bs-toggle="modal" data-bs-target="#profileeditdataModal">
                                    <i class="fa-solid fa-user-gear"></i>
                                    แก้ไขข้อมูลส่วนตัว
                                </button>

                                <button type="button" class="btn p-2 mb-3 mx-md-2 text-white btn-addpay rounded-pill" data-bs-toggle="modal" data-bs-target="#profileedituserModal">
                                    <i class="fa-solid fa-user-pen"></i>
                                    แก้ไขชื่อผู้ใช้
                                </button>

                                <button type="button" class="btn p-2 mb-3 mx-md-2 text-white btn-addpay rounded-pill" data-bs-toggle="modal" data-bs-target="#profileeditpassModal">
                                    <i class="fa-solid fa-user-pen"></i>
                                    แก้ไขรหัสผ่าน
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>