<?php
include 'layout/head.php';
?>

<body>
    <?php if (isset($_GET['login'])) {
        include 'view/login.php';
        exit;
    } else if (isset($_GET['register'])) {
        include 'view/login.php';
        exit;
    }
    ?>



    <?php
    include 'layout/footer.php';
    ?>