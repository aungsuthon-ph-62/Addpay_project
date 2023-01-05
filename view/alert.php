<?php if (isset($_SESSION['success'])) { ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: '<?php echo $_SESSION['success']; ?>',
            showConfirmButton: true,
            timer: '5000'
        })
    </script>
    <?php
    unset($_SESSION['success']);
    ?>
<?php } ?>

<?php if (isset($_SESSION['error'])) { ?>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: '<?php echo $_SESSION['error']; ?>',
            showConfirmButton: true,
            timer: '5000'
        })
    </script>
    <?php
    unset($_SESSION['error']);
    ?>
<?php } ?>

<?php if (isset($_GET['success'])) { ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: '<?php echo $_GET['success']; ?>',
            showConfirmButton: true,
            timer: '5000'
        })
    </script>
<?php } ?>

<?php if (isset($_GET['error'])) { ?>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: '<?php echo $_GET['error']; ?>',
            showConfirmButton: true,
            timer: '5000'
        })
    </script>
<?php } ?>

<?php if (isset($_SESSION['confirm'])) { ?>
    <script>
        // Display the  confirmation prompt
        Swal.fire({
            title: 'Success!',
            text: '<?= $_SESSION['confirm'] ?>',
            icon: 'info',
            showCancelButton: true,
            confirmButtonText: 'ใช่, เข้าสู่ระบบใหม่อีกครั้ง',
            cancelButtonText: 'ไม่ใช่, ใช้งานต่อไป'
        }).then((result) => {
            if (result.value) {
                // Log the user out if they confirm
                window.location.replace('php/logout.php');
            } else {
                // Reload the window if they cancel
                window.location.reload();
                <?php
                unset($_SESSION['confirm']);
                ?>
            }
        });
    </script>
<?php } ?>