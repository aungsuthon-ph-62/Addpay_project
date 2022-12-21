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
        // the tname is empty
        $errors['tname'] = 'กรุณาเลือกคำนำหน้าชื่อ';
    }

    if (empty($fname)) {
        // the tname is empty
        $errors['fname'] = 'กรุณากรอกชื่อจริง';
    }

    if (empty($lname)) {
        // the tname is empty
        $errors['lname'] = 'กรุณากรอกนามสกุล';
    }

    if (empty($username)) {
        // the username is empty
        $errors['username'] = 'กรุณากรอกชื่อผู้ใช้';
    }

    if (empty($password)) {
        // the password is empty
        $errors['password'] = 'กรุณากรอกรหัสผ่าน';
    }

    if (empty($confirm)) {
        // the password is empty
        $errors['confirm'] = 'กรุณาติ๊กที่ช่องยืนยันข้อมูลก่อน';
    }
}
