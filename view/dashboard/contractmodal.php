<div class="modal fade" id="contractaddModal" tabindex="-1" aria-labelledby="contractaddModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="contractaddModalLabel">Upload Contrat</h5>
            </div>
            <div class="modal-body">
                <form class="row" id="" method="post" action="" enctype="multipart/form-data">
                    <input type="hidden" name="" value="">
                    <div class="col-md-6 mb-2">
                        <label class="form-label">วันที่ส่ง LG</label>
                        <input type="date" class="form-control form-control-sm" name="">
                    </div>
                    <div class="col-md-6 mb-2">
                        <label class="form-label">วันหมดอายุ LG</label>
                        <input type="date" class="form-control form-control-sm" name="">
                    </div>
                    <div class="col-md-6 mb-2">
                        <label class="form-label">ชื่อบริษัท</label>
                        <input type="text" class="form-control form-control-sm" name="" placeholder="ชื่อบริษัท">
                    </div>
                    <div class="col-md-6 mb-2">
                        <label class="form-label">ชื่อสัญญา</label>
                        <input type="text" class="form-control form-control-sm" name="" placeholder="ชื่อสัญญา">
                    </div>
                    <div class="col-md-6 mb-2">
                        <label class="form-label">ไฟล์สัญญา</label>
                        <input type="file" class="form-control form-control-sm " id="" name="" />
                    </div>
                    <div class="col-md-6 mb-2">
                        <label class="form-label">ไฟล์เอกสารผู้เซ็นสัญญา</label>
                        <input type="file" class="form-control form-control-sm " id="" name="" />
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label">วันประกาศผล</label>
                        <input type="date" class="form-control form-control-sm" name="">
                    </div>
                    <div class=" modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button class="btn btn-primary" type="submit" name="submit">Save</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<div class="modal fade" id="contracteditModal" tabindex="-1" aria-labelledby="contracteditModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="contracteditModalLabel">Edit Contrat</h5>
            </div>
            <div class="modal-body">
                <form class="row" id="" method="post" action="" enctype="multipart/form-data">
                    <input type="hidden" name="ide" id="ide">
                    <div class="col-md-6 mb-2">
                        <label class="form-label">วันที่ส่ง LG</label>
                        <input type="text" class="form-control form-control-sm" id="lgd" name="lgd">
                    </div>
                    <div class="col-md-6 mb-2">
                        <label class="form-label">วันหมดอายุ LG</label>
                        <input type="text" class="form-control form-control-sm" id="lge" name="lge">
                    </div>
                    <div class="col-md-12 mb-2">
                        <label class="form-label">ชื่อบริษัท</label>
                        <input type="text" class="form-control form-control-sm" id="comname" name="comname">
                    </div>
                    <div class="col-md-12 mb-2">
                        <label class="form-label">ชื่อสัญญา</label>
                        <input type="text" class="form-control form-control-sm" id="conname" name="conname">
                    </div>
                    <div class="col-md-6 mb-2">
                        <label class="form-label">ไฟล์สัญญา</label>
                        <input type="file" class="form-control form-control-sm " id="filecon" name="filecon" />
                    </div>
                    <div class="col-md-6 mb-2">
                        <label class="form-label">ไฟล์เอกสารผู้เซ็นสัญญา</label>
                        <input type="file" class="form-control form-control-sm " id="filedoc" name="filedoc" />
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label">วันประกาศผล</label>
                        <input type="date" class="form-control form-control-sm" id="ann" name="ann">
                    </div>
                    <div class=" modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button class="btn btn-primary" type="submit" name="submit">Save</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<div class="modal fade" id="contractdeleteModal" tabindex="-1" aria-labelledby="contractdeleteModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="contractdeleteModalLabel" style="color: black;">ลบข้อมูลสัญญา?</h5>
            </div>
            <div class="modal-body">
                <form class="row" id="" method="post" action="">
                    <input type="hidden" name="ide" id="ide">
                    <div class="col-md-12 mb-2">
                        <label class="form-label">ชื่อสัญญา</label>
                        <input type="text" class="form-control form-control-sm" id="connamed" name="connamed"
                            disabled="true">
                    </div>
                    <div class=" modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button class="btn btn-danger" type="submit" name="submit">Confirm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>