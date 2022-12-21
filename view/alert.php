<?php if (isset($_SESSION['success'])) { ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: '<?php echo $_SESSION['success']; ?>',
            showConfirmButton: true,
            timer: '5000'
        })
        <?php
            unset ($_SESSION['success']);
        ?>
    </script>
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
        <?php
            unset ($_SESSION['error']);
        ?>
    </script>
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