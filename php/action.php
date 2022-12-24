<?php
require_once 'conn.php';

if (isset($_POST['action'])) {
    if ($_POST['action'] == 'register') {
        register();
        exit;
    } elseif ($_POST['action'] == 'login') {
        login();
        exit;
    } elseif ($_POST['action'] == 'logout') {
        logout();
        exit;
    } elseif ($_POST['action'] == 'editUserPass') {
        editUserPass();
        exit;
    }
}

// Encode
function encode($message, $encryption_key)
{
    // $key = hex2bin($encryption_key);
    // $nonceSize = openssl_cipher_iv_length('aes-256-ctr');
    // $nonce = openssl_random_pseudo_bytes($nonceSize);
    // $ciphertext = openssl_encrypt(
    //     $message,
    //     'aes-256-ctr',
    //     $key,
    //     OPENSSL_RAW_DATA,
    //     $nonce
    // );
    // return base64_encode($nonce . $ciphertext);
    $ciphertext = openssl_encrypt($message, "AES-128-ECB", $encryption_key);
    return $ciphertext; // Outputs: encrypted string
}

// Decode
function decode($message, $encryption_key)
{
    // $key = hex2bin($encryption_key);
    // $message = base64_decode($message);
    // $nonceSize = openssl_cipher_iv_length('aes-256-ctr');
    // $nonce = mb_substr($message, 0, $nonceSize, '8bit');
    // $ciphertext = mb_substr($message, $nonceSize, null, '8bit');
    // $plaintext = openssl_decrypt(
    //     $ciphertext,
    //     'aes-256-ctr',
    //     $key,
    //     OPENSSL_RAW_DATA,
    //     $nonce
    // );
    // return $plaintext;
    $decrypted_text = openssl_decrypt($message, "AES-128-ECB", $encryption_key);
    echo $decrypted_text;
}

function register()
{
    session_start();
    global $conn;
    date_default_timezone_set('Asia/Bangkok');
    $date = date("Y-m-d H:i:s");

    require_once 'key.inc.php';

    $tname = mysqli_real_escape_string($conn, $_POST['inputTname']);
    $fname = mysqli_real_escape_string($conn, $_POST['inputFname']);
    $lname = mysqli_real_escape_string($conn, $_POST['inputLname']);
    $username = mysqli_real_escape_string($conn, $_POST['inputUsername']);
    $password = mysqli_real_escape_string($conn, $_POST['inputPassword']);
    $confirm = mysqli_real_escape_string($conn, $_POST['inputConfirm']);

    $enc_fname = encode($fname, secret_key());
    $enc_lname = encode($lname, secret_key());
    $enc_username = encode($username, secret_key());
    $enc_password = encode($password, secret_key());

    $data = 'tname=' . $tname . '&fname=' . $enc_fname . '&lname=' . $enc_lname . '&username=' . $enc_username . '&password=' . $enc_password . '&confirm=' . $confirm;


    if (empty($tname)) {
        $_SESSION['error'] = "กรุณาเลือกคำนำหน้าชื่อ";
        header("Location: ../register?$data");
        exit;
    }

    if (empty($fname)) {
        $_SESSION['error'] = "กรุณากรอกชื่อจริง";
        header("Location: ../register?$data");
        exit;
    } else {
        if (!preg_match("/^[a-zA-Z ก-์ ะ-ู เ-แ ]*$/", $fname)) {
            $_SESSION['error'] = "กรุณากรอกด้วยตัวอักษร [ก-ฮ,a-z,A-Z]";
            header("Location: ../register?$data");
            exit;
        }
    }

    if (empty($lname)) {
        $_SESSION['error'] = "กรุณากรอกนามสกุล";
        header("Location: ../register?$data");
        exit;
    } else {
        if (!preg_match("/^[a-zA-Z ก-์ ะ-ู เ-แ ]*$/", $lname)) {
            $_SESSION['error'] = "กรุณากรอกด้วยตัวอักษร [ก-ฮ,a-z,A-Z]";
            header("Location: ../register?$data");
            exit;
        }
    }

    if (empty($username)) {
        $_SESSION['error'] = "กรุณากรอกชื่อผู้ใช้";
        header("Location: ../register?$data");
        exit;
    } else {
        if (!preg_match("/^[a-zA-Z_]*$/", $username)) {
            $_SESSION['error'] = "กรุณากรอกด้วยตัวอักษร [a-z,A-Z,_]";
            header("Location: ../register?$data");
            exit;
        }
    }

    if (empty($password)) {
        $_SESSION['error'] = "กรุณากรอกรหัสผ่าน";
        header("Location: ../register?$data");
        exit;
    } else {
        if (!preg_match("/^(?=.*[A-Z])(?=.*[!@#$%^&*()_+-=])[a-zA-Z0-9!@#$%^&*()_+-=]{0,8}$/", $password)) {
            $_SESSION['error'] = 'รหัสผ่านจำเป็นต้องมี ตัวพิมพ์ใหญ่ไม่น้อยกว่า 1 ตัว, ตัวอักษรพิเศษ 1 ตัว และมีความยาวไม่เกิน 8 ตัวอักษร';
            header("Location: ../register?$data");
            exit;
        }
    }

    if (empty($confirm)) {
        $_SESSION['error'] = "กรุณาติ๊กที่ช่องยืนยัน";
        header("Location: ../register?$data");
        exit;
    }

    if ($tname == '1') {
        $tname = "นาย";
    } elseif ($tname == '2') {
        $tname = "นาง";
    } elseif ($tname == '3') {
        $tname = "นางสาว";
    }

    $password_hash = password_hash($password, PASSWORD_DEFAULT);


    // check duplicate data
    $user_check_query = "SELECT * FROM users WHERE fname = '$fname' AND lname = '$lname'";
    $query = mysqli_query($conn, $user_check_query);
    $check = mysqli_fetch_assoc($query);

    if ($check) {
        $_SESSION['error'] = "ชื่อจริงหรือนามสกุลนี้มีในระบบแล้ว!";
        header("Location: ../register?$data");
        mysqli_close($conn);
        exit;
    } else {
        $query = "INSERT INTO users (prefix, fname, lname, username, password, created_at)
        VALUES ('$tname', '$fname', '$lname', '$username', '$password_hash', '$date')";
        $result_query =  mysqli_query($conn, $query);
        if ($result_query) {
            $_SESSION['success'] = "สมัครสมาชิกสำเร็จ!";
            header("Location: ../login");
            mysqli_close($conn);
            exit;
        } else {
            $_SESSION['error'] = "เกิดข้อผิดพลาด! กรุณาลองอีกครั้ง";
            header("Location: ../register?$data");
            mysqli_close($conn);
            exit;
        }
    }
}

function login()
{
    session_start();
    global $conn;
    require_once 'key.inc.php';

    $username = mysqli_real_escape_string($conn, $_POST['inputUsername']);
    $password = mysqli_real_escape_string($conn, $_POST['inputPassword']);

    $enc_username = encode($username, secret_key());
    $enc_password = encode($password, secret_key());

    $data = 'username=' . $enc_username . '&password=' . $enc_password;

    if (empty($username)) {
        $_SESSION['error'] = "กรุณากรอกชื่อผู้ใช้";
        header("Location: ../login?$data");
        exit;
    }

    if (empty($password)) {
        $_SESSION['error'] = "กรุณากรอกพาสเวิร์ด";
        header("Location: ../login?$data");
        exit;
    }

    $user = "SELECT * FROM users WHERE username = '$username'";
    $query = mysqli_query($conn, $user);
    $result = mysqli_fetch_assoc($query);

    if ($result > 0) {
        $stored_pass = $result['password'];
        if (password_verify($password, $stored_pass)) {
            $_SESSION['id'] = $result['id'];
            $_SESSION['success'] = "เข้าสู่ระบบสำเร็จ!";
            header("location: ../index");
            mysqli_close($conn);
            exit;
        } else {
            $_SESSION['error'] = "รหัสผ่านไม่ถูกต้อง";
            header("location: ../login?$data");
            mysqli_close($conn);
            exit;
        }
    } else {
        $_SESSION['error'] = "ชื่อผู้ใช้ไม่ถูกต้อง";
        header("location: ../login?$data");
        mysqli_close($conn);
        exit;
    }
}

function logout()
{
    // Start the session
    session_start();

    // Destroy the session
    session_destroy();

    // Redirect the user to the login page
    header('Location: ../login.php?success=ออกจากระบบสำเร็จ!');
    exit;
}

function editUserPass()
{
    session_start();
    global $conn;
    date_default_timezone_set('Asia/Bangkok');
    $date = date("Y-m-d H:i:s");

    $username = mysqli_real_escape_string($conn, $_POST['inputUsername']);
    $password = mysqli_real_escape_string($conn, $_POST['inputPassword']);
    $usernameNew = mysqli_real_escape_string($conn, $_POST['inputUsernameNew']);
    $passwordNew = mysqli_real_escape_string($conn, $_POST['inputPasswordNew']);
    $usernameOld = mysqli_real_escape_string($conn, $_POST['username']);
    $passwordOld = mysqli_real_escape_string($conn, $_POST['password']);

    $id = mysqli_real_escape_string($conn, $_POST['id']);

    if (empty($username)) {
        $username = $usernameOld;
    }

    if (empty($usernameNew)) {
        $usernameNew = $usernameOld;
    } else {
        if (!preg_match("/^[a-zA-Z_]*$/", $usernameNew)) {
            $_SESSION['error'] = "กรุณากรอกด้วยตัวอักษร [a-z,A-Z,_]";
            header("Location: ../index");
            exit;
        }
    }

    if (empty($password)) {
        $password = $passwordOld;
    }

    if (empty($passwordNew)) {
        $passwordNew = $passwordOld;
    } else {
        if (!preg_match("/^(?=.*[A-Z])(?=.*[!@#$%^&*()_+-=])[a-zA-Z0-9!@#$%^&*()_+-=]{0,8}$/", $passwordNew)) {
            $_SESSION['error'] = 'รหัสผ่านจำเป็นต้องมี ตัวพิมพ์ใหญ่ไม่น้อยกว่า 1 ตัว, ตัวอักษรพิเศษ 1 ตัว และมีความยาวไม่เกิน 8 ตัวอักษร';
            header("Location: ../index");
            exit;
        }
    }

    $password_hash = password_hash($passwordNew, PASSWORD_DEFAULT);
    $edit_user = "UPDATE users SET username='$usernameNew', password='$password_hash', updated_at='$date' WHERE id = '$id'";
    $editQuery = mysqli_query($conn, $edit_user);
    if ($editQuery) {
        $_SESSION['success'] = "แก้ไขข้อมูลสำเร็จ!";
        header("Location: ../index");
        mysqli_close($conn);
        exit;
    } else {
        $_SESSION['error'] = "เกิดข้อผิดพลาด!";
        header("Location: ../index");
        mysqli_close($conn);
        exit;
    }
}
