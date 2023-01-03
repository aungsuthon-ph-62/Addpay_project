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

    .btn {
        transition: all 0.2s ease-in-out;
    }

    .btn:hover {
        border-color: white;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        transform: scale(1.1);
    }
</style>


<body>
    <?php
    if (isset($_SESSION['id']) || $_SESSION['id']) { ?>

        <?php
        require_once "php/conn.php";
        $user_id = $_SESSION['id'];
        $sql = "SELECT * FROM users WHERE id = '$user_id'";
        $query = mysqli_query($conn, $sql);
        $user = mysqli_fetch_assoc($query);

        if (!$user) {
            require_once 'php/logout.php';
            mysqli_close($conn);
            exit;
        }
        ?>

        <!-- Dashboard Nav -->
        <?php include_once 'layout/dashboardNav.php'; ?>
        <!-- Dashboard Nav -->

        <main class="container-fluid">
            <div class="row">
                <!-- Sidebar -->
                <?php include_once 'layout/sidebar.php'; ?>
                <!-- Sidebar -->

                <!-- Main content -->
                <section class="col-md-9 ms-sm-auto col-lg-10 py-4">
                    <?php $page = isset($_GET['page']) ? $_GET['page'] : '';
                    if ($page) { ?>
                        <?php
                        switch ($page) {
                            case "doc_out_edit":
                                include_once 'view/dashboard/docout_edit.php';
                                break;
                            case "doc_out_add":
                                include_once 'view/dashboard/docout_add.php';
                                break;
                            case "doc_out":
                                include_once 'view/dashboard/docout_list.php';
                                break;
                            case "doc_in_edit":
                                include_once 'view/dashboard/docin_edit.php';
                                break;
                            case "doc_in_add":
                                include_once 'view/dashboard/docin_add.php';
                                break;
                            case "doc_in":
                                include_once 'view/dashboard/docin_list.php';
                                break;
                            case "doc":
                                include_once 'view/dashboard/doc.php';
                                break;
                            case "quotation_edit":
                                include_once 'view/dashboard/quotation_appraisal_edit.php';
                                break;
                            case "quotation_add":
                                include_once 'view/dashboard/quotation_appraisal_add.php';
                                break;
                            case "quotation":
                                include_once 'view/dashboard/quotation_appraisal_list.php';
                                break;
                            default:
                                include_once 'view/dashboard.php';
                        }
                        ?>
                    <?php } else { ?>
                        <?php include_once 'view/dashboard.php'; ?>
                    <?php } ?>
                </section>
                <!-- Main content -->
            </div>
        </main>
    <?php } else {
        header("Location: login?error=กรุณาเข้าสู่ระบบก่อน!");
        exit;
    } ?>



    <?php
    include_once 'view/alert.php';
    ?>
</body>

</html>