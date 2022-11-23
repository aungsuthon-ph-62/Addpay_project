<section class="vh-100 p-3 px-md-5 py-md-5 bg-primary-addpay">
  <div class="rounded-5 py-3 py-md-5 mx-md-5 bg-white h-100">

    <div class="d-flex flex-wrap align-items-center justify-content-between mb-3 px-3 px-md-5">
      <a href="?register">
        <img class="rounded-2" src="image/logorebg.png" style="width: auto; height: 3rem;">
      </a>
      <!-- back to login -->
      <a href="?login" class="btn btn-dark border-0 bg-secondary-addpay">
        <i class="fa-solid fa-right-to-bracket"></i>
        Login
      </a>
    </div>

    <div class="container">
      <!-- form register -->
      <div class="text-center" id="title" name="title">
        <h3>สมัครสมาชิก</h3>
      </div>

      <div class="container px-5">
        <div class="alert alert-success" role="alert">
          <i class="fa-solid fa-circle-check"></i>
          A simple success alert—check it out!
        </div>
        <!-- <div class="alert alert-danger" role="alert">
              <i class="fa-solid fa-triangle-exclamation"></i>
              A simple danger alert—check it out!
            </div> -->
      </div>



      <div class="container mb-4 py-3 px-md-5">
        <form action="" method="post">

          <select class="form-select mb-4 rounded-pill" id="inputTname" name="inputTname">
            <option selected disabled>--คำนำหน้าชื่อ--</option>
            <option value="นาย">นาย</option>
            <option value="นาง">นาง</option>
            <option value="นางสาว">นางสาว</option>
          </select>

          <div class="form-floating mb-4">
            <input type="text" class="form-control form-control-lg border border-start-0 border-top-0 border-end-0 rounded-0" id=" inputFname" name="inputFname" placeholder="กรอกชื่อ">
            <label for="inputFname" class="form-label">ชื่อ</label>
          </div>
          <div class="form-floating mb-4">
            <input type="text" class="form-control form-control-lg border border-start-0 border-top-0 border-end-0 rounded-0" id=" inputLname" name="inputLname" placeholder="กรอกนามสกุล">
            <label for="inputLname" class="form-label">นามสกุล</label>
          </div>
          <!-- username input -->
          <div class="form-floating mb-4">
            <input type="text" class="form-control form-control-lg border border-start-0 border-top-0 border-end-0 rounded-0" id=" inputUsername" name="inputUsername" placeholder="กรอกชื่ผู้ใช้">
            <label for="inputLname" class="form-label">
              ชื่อผู้ใช้</label>
          </div>
          <!-- Password input -->
          <div class="form-floating mb-4">
            <input type="password" class="form-control form-control-lg border border-start-0 border-top-0 border-end-0 rounded-0" id="inputPassword" name="inputPassword" placeholder="กรอกรหัสผ่าน" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="พาสเวิร์ดต้องมีตัวเลขอย่างน้อยหนึ่งตัว, มีตัวพิมพ์ใหญ่และพิมพ์เล็ก และมีความยาวไม่น้อยกว่า 8 ตัวอักษร !">
            <label for="inputPassword" class="form-label">รหัสผ่าน</label>
          </div>

          <!-- Checkbox -->
          <div class="form-check mb-4">
            <input class="form-check-input" type="checkbox" id="inputConfirm">
            <label class="form-check-label" for="inputConfirm"> ยืนยันข้อมูล </label>
          </div>

          <!-- Submit button -->
          <div class="d-grid gap-2 col-12 mx-auto mb-md-4">
            <button type="submit" name="submit" class="btn p-3 mt-3 text-white rounded-pill fs-5 fw-bold btn-addpay">สมัครสมาชิก</button>
          </div>

        </form>
      </div>
    </div>
  </div>
</section>