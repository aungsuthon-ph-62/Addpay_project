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
    <?php if (isset($_GET['login'])) {
        include_once 'view/login.php';
    } else if (isset($_GET['register'])) {
        include_once 'view/register.php';
    } else {
        include_once 'view/dashboard.php';
        include_once 'view/dashboard/profileedit.php';
    }
    ?>


<?php
include_once 'view/alert.php';
?>
</body>

</html>