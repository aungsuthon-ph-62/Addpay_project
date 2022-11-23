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
        include 'view/login.php';
        exit;
    } else {
        require 'view/dashboard.php';
    }
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>