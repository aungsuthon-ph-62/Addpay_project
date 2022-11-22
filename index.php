<?php
include 'layout/head.php';
?>

<body>
    <?php if (isset($_GET['login'])) {
        include 'view/login.php';
    } else if (isset($_GET['register'])) {
        include 'view/login.php';
    } else if (isset($_GET['profile'])) {
        include 'view/dashboard/profile.php';
    } else {
        include 'view/dashboard.php';
    }
    ?>

    <?php
    include 'layout/footer.php';
    ?>