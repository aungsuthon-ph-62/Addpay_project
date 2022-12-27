<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">หน้าหลัก</li>
    </ol>
</nav>
<hr>
<?php
if (!$user['gender'] || !$user['age'] || !$user['email'] || !$user['position'] || !$user['department'] || !$user['phone']) { ?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong><i class="fa-solid fa-triangle-exclamation"></i> แจ้งเตือน !</strong> กรุณาเพิ่มหรือแก้ไขข้อมูลส่วนตัวของท่านด้วย.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php } ?>
<?php
include_once 'dashboard/profile.php';
include_once 'dashboard/profileedit.php';
?>