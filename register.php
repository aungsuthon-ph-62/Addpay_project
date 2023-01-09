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
  require_once 'php/action.php';
  require_once 'php/key.inc.php';
  ?>
  <main class="py-4 py-md-5 px-2 px-md-5 bg-primary-addpay overflow-hidden vh-100">
    <div class="rounded-5 py-5 px-md-5 mx-md-5 my-5 my-md-0 bg-white shadow-lg">

      <div class="d-flex flex-wrap align-items-center justify-content-between mb-3 px-3 px-md-5">
        <a href="register">
          <img class="rounded-2" src="image/logorebg.png" style="width: auto; height: 3rem;">
        </a>
        <!-- back to login -->
        <a href="login" class="btn btn-dark border-0 bg-secondary-addpay">
          <i class="fa-solid fa-right-to-bracket"></i>
          Login
        </a>
      </div>

      <div class="container">
        <!-- form register -->
        <div class="text-center" id="title" name="title">
          <h3>สมัครสมาชิก</h3>
        </div>


        <div class="container pb-md-0 mb-5">
          <form action="php/action.php" class="px-md-5" method="post">
            <input type="hidden" name="action" value="register">
            <select class="form-select mb-4 rounded-pill" id="inputTname" name="inputTname">
              <?php if (isset($_GET['tname'])) { ?>
                <?php if ($_GET['tname'] == '1') { ?>
                  <option value="1" selected>นาย</option>
                  <option value="2">นาง</option>
                  <option value="3">นางสาว</option>
                <?php } elseif ($_GET['tname'] == '2') { ?>
                  <option value="1">นาย</option>
                  <option value="2" selected>นาง</option>
                  <option value="3">นางสาว</option>
                <?php } elseif ($_GET['tname'] == '3') { ?>
                  <option value="1">นาย</option>
                  <option value="2">นาง</option>
                  <option value="3" selected>นางสาว</option>
                <?php } ?>
              <?php } else { ?>
                <option selected disabled>--คำนำหน้าชื่อ--</option>
                <option value="1">นาย</option>
                <option value="2">นาง</option>
                <option value="3">นางสาว</option>
              <?php } ?>
            </select>

            <div class="form-floating mb-4">
              <input type="text" class="form-control form-control-lg border border-start-0 border-top-0 border-end-0 rounded-0" id="inputFname" name="inputFname" placeholder="กรอกชื่อ" value="<?php if (isset($_GET['fname'])) {
                                                                                                                                                                                                  echo decode($_GET['fname'], secret_key());
                                                                                                                                                                                                } ?>">
              <label for="inputFname" class="form-label">ชื่อ</label>
            </div>
            <div class="form-floating mb-4">
              <input type="text" class="form-control form-control-lg border border-start-0 border-top-0 border-end-0 rounded-0" id="inputLname" name="inputLname" placeholder="กรอกนามสกุล" value="<?php if (isset($_GET['lname'])) {
                                                                                                                                                                                                      echo decode($_GET['lname'], secret_key());
                                                                                                                                                                                                    } ?>">
              <label for="inputLname" class="form-label">นามสกุล</label>
            </div>
            <!-- username input -->
            <div class="form-floating mb-4">
              <input type="text" class="form-control form-control-lg border border-start-0 border-top-0 border-end-0 rounded-0" id="inputUsername" name="inputUsername" placeholder="กรอกชื่ผู้ใช้" value="<?php if (isset($_GET['username'])) {
                                                                                                                                                                                                              echo decode($_GET['username'], secret_key());
                                                                                                                                                                                                            } ?>">
              <label for="inputUsername" class="form-label">
                ชื่อผู้ใช้</label>
            </div>
            <!-- Password input -->
            <div class="form-floating mb-4">
              <input type="password" class="form-control form-control-lg border border-start-0 border-top-0 border-end-0 rounded-0" id="inputPassword" name="inputPassword" placeholder="กรอกรหัสผ่าน" value="<?php if (isset($_GET['password'])) {
                                                                                                                                                                                                                echo decode($_GET['password'], secret_key());
                                                                                                                                                                                                              } ?>">
              <label for="inputPassword" class="form-label">รหัสผ่าน</label>
            </div>

            <!-- Checkbox -->
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="inputConfirm" name="inputConfirm" <?php if (isset($_GET['confirm'])) {
                                                                                                      $confirm = $_GET['confirm'];
                                                                                                      if ($confirm) {
                                                                                                        echo "checked";
                                                                                                      }
                                                                                                    } ?>>
              <label class="form-check-label" for="inputConfirm"> ยืนยันข้อมูล </label>
            </div>

            <!-- Submit button -->
            <div class="d-grid gap-2 col-12 mx-auto">
              <button type="submit" name="register-button" class="btn p-3 mt-3 text-white rounded-pill fs-5 fw-bold btn-addpay">สมัครสมาชิก</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </main>
  <?php
  include_once 'view/alert.php';
  ?>
</body>

</html>