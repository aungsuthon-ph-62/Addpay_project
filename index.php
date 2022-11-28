<?php
include 'layout/head.php';
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
        require 'view/login.php';
    } else if (isset($_GET['register'])) {
        require 'view/register.php';
    } else {
        require 'view/dashboard.php';
        require 'view/dashboard/profileedit.php';
    }
    ?>



</body>

</html>