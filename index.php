<?php
session_start();
include_once 'layout/head.php';
?>
<style>
    body {
        font-family: "Kanit", sans-serif;
        font-family: "Noto Sans", sans-serif;
        font-family: "Noto Sans Thai", sans-serif;
        font-family: "Poppins", sans-serif;
        font-family: "Prompt", sans-serif;
    }
</style>


<body>
    <?php
    if (isset($_SESSION['id']) || $_SESSION['id']) {
        $page = isset($_GET['page']) ? $_GET['page'] : '';

        if ($page) {
            switch ($page) {
                case "profile":
                    include_once 'view/dashboard/profile.php';
                    break;
                default:
                    include_once 'view/dashboard.php';
            }
        } else {
            include_once 'view/dashboard.php';
        }
    } else {
        header("Location: login?error=กรุณาเข้าสู่ระบบก่อน!");
        exit;
    }
    ?>


    <?php
    include_once 'view/alert.php';
    ?>
</body>

</html>