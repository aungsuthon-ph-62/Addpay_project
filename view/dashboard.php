<!-- Dashboard Nav -->
<?php
if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
    require_once "php/conn.php";

    $query = "SELECT * FROM users WHERE id = '$id'";
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($result);
}
include_once 'layout/dashboardNav.php';
?>
<!-- Dashboard Nav -->

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <?php
        include_once 'layout/sidebar.php';
        ?>
        <!-- Sidebar -->

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <h1 class="h5 pt-5">หน้าหลัก</h1>
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

        </main>
    </div>
</div>