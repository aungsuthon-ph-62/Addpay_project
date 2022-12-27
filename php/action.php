<?php
session_start();
require_once 'conn.php';

if (isset($_POST['action'])) {
    if ($_POST['action'] == 'register') {
        register();
        exit;
    } elseif ($_POST['action'] == 'login') {

        exit;
    } elseif ($_POST['action'] == 'signUp') {

        exit;
    } elseif ($_POST['action'] == 'editReport') {

        exit;
    }
}

// Encode
function encrypt($message, $encryption_key)
{
    $key = hex2bin($encryption_key);
    $nonceSize = openssl_cipher_iv_length('aes-256-ctr');
    $nonce = openssl_random_pseudo_bytes($nonceSize);
    $ciphertext = openssl_encrypt(
        $message,
        'aes-256-ctr',
        $key,
        OPENSSL_RAW_DATA,
        $nonce
    );
    return base64_encode($nonce . $ciphertext);
}

// Decode
function decrypt($message, $encryption_key)
{
    $key = hex2bin($encryption_key);
    $message = base64_decode($message);
    $nonceSize = openssl_cipher_iv_length('aes-256-ctr');
    $nonce = mb_substr($message, 0, $nonceSize, '8bit');
    $ciphertext = mb_substr($message, $nonceSize, null, '8bit');
    $plaintext = openssl_decrypt(
        $ciphertext,
        'aes-256-ctr',
        $key,
        OPENSSL_RAW_DATA,
        $nonce
    );
    return $plaintext;
}

function register()
{
    global $conn;
    date_default_timezone_set('Asia/Bangkok');
    $date = date("Y-m-d H:i:s");

    $tname = mysqli_real_escape_string($conn, $_POST['inputTname']);
    $fname = mysqli_real_escape_string($conn, $_POST['inputFname']);
    $lname = mysqli_real_escape_string($conn, $_POST['inputLname']);
    $username = mysqli_real_escape_string($conn, $_POST['inputUsername']);
    $password = mysqli_real_escape_string($conn, $_POST['inputPassword']);
    $confirm = mysqli_real_escape_string($conn, $_POST['inputConfirm']);

    if (empty($tname)) {
        $_SESSION['error'] = "กรุณาเลือกคำนำหน้าชื่อ";
        header("Location: ../index.php?register");
        exit;
    }

    if (empty($fname)) {
        $_SESSION['error'] = "กรุณากรอกชื่อจริง";
        header("Location: ../index.php?register");
        exit;
    }

    if (empty($lname)) {
        $_SESSION['error'] = "กรุณากรอกนามสกุล";
        header("Location: ../index.php?register");
        exit;
    }

    if (empty($username)) {
        $_SESSION['error'] = "กรุณากรอกชื่อผู้ใช้";
        header("Location: ../index.php?register");
        exit;
    }

    if (empty($password)) {
        $_SESSION['error'] = "กรุณากรอกรหัสผ่าน";
        header("Location: ../index.php?register");
        exit;
    }

    if (empty($confirm)) {
        $_SESSION['error'] = "กรุณาติ๊กที่ช่องยืนยัน";
        header("Location: ../index.php?register");
        exit;
    }

    $password_hash = password_hash($password, PASSWORD_DEFAULT);


    // check duplicate data
    $user_check_query = "SELECT * FROM users WHERE fname = '$fname' AND lname = '$lname'";
    $query = mysqli_query($conn, $user_check_query);
    $check = mysqli_fetch_assoc($query);

    if ($check) {
        $_SESSION['error'] = "ชื่อจริงหรือนามสกุลนี้มีในระบบแล้ว!";
        header("Location: ../index.php?register");
        exit;
    } else {
        $query = "INSERT INTO users (prefix, fname, lname, username, password, create_at)
VALUES ('$tname', '$fname', '$lname', '$username', '$password_hash', '$date')";
        $result_query =  mysqli_query($conn, $query);
        if ($result_query) {
            $_SESSION['success'] = "สมัครสมาชิกสำเร็จ!";
            header("Location: ../index.php?login");
            exit;
        } else {
            $_SESSION['error'] = "เกิดข้อผิดพลาด! กรุณาลองอีกครั้ง";
            header("Location: ../index.php?register");
            exit;
        }
    }
}

