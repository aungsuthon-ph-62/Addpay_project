<section class="" style="background-color: #07aaf2 ;">
  <div class="container py-3 py-sm-4 py-md-5">
    <div class="container rounded-5  px-md-5 py-md-4" style="background-color: #fff;">
      <!--  -->
      <div class="d-flex flex-wrap align-items-center justify-content-between">
        <div class="nav col-lg-auto text-small ">
          <a class="my-3 my-lg-0 me-lg-auto">
            <img class="rounded-2" src="image/logorebg.png" style="width: auto; height: 3rem;">
          </a>
        </div>
        <!-- back to login -->
        <div class="nav col-lg-auto text-small ">
          <a href="index.php" class="nav-link text-light bg-dark rounded-2 px-sm-4 px-md-5">
            <i class="fa-solid fa-right-to-bracket"></i>
            Login
          </a>
        </div>
      </div>
      <!-- form register -->
      <div class="d-flex align-items-center justify-content-center">
        <div class="col-md-7 col-lg-5 col-xl-5 ">
          <div class="text-center" id="title" name="title">
            <h3>สมัครสมาชิก</h3>
          </div>

          <div class="alert">
            <div class="alert alert-success" role="alert">
              <i class="fa-solid fa-circle-check"></i>
              A simple success alert—check it out!
            </div>
            <!-- <div class="alert alert-danger" role="alert">
              <i class="fa-solid fa-triangle-exclamation"></i>
              A simple danger alert—check it out!
            </div> -->
          </div>

          <form class="container">
            <div class="form-floating mb-4">
              <select class="form-select " id="inputTname" name="inputTname" required />
              <option value="" selected disabled>--คำนำหน้าชื่อ--</option>
              <option value="นาย">นาย</option>
              <option value="นาง">นาง</option>
              <option value="นางสาว">นางสาว</option>
              </select>
              <label for="inputTname" class="">คำนำหน้า</label>
            </div>
            <div class="form-floating mb-4">
              <input type="text" class="form-control form-control-lg"" id=" inputFname" name="inputFname" placeholder="กรอกชื่อ" required />
              <label for="inputFname" class="form-label">ชื่อ</label>
            </div>
            <div class="form-floating mb-4">
              <input type="text" class="form-control form-control-lg"" id=" inputLname" name="inputLname" placeholder="กรอกนามสกุล" required />
              <label for="inputLname" class="form-label">นามสกุล</label>
            </div>
            <!-- username input -->
            <div class="form-floating mb-4">
              <input type="text" class="form-control form-control-lg"" id=" inputLname" name="inputLname" placeholder="กรอกชื่ผู้ใช้" required />
              <label for="inputLname" class="form-label">
                ชื่อผู้ใช้</label>
            </div>
            <!-- Password input -->
            <div class="form-floating mb-4">
              <input type="password" class="form-control form-control-lg" id="inputPassword" name="inputPassword" placeholder="กรอกรหัสผ่าน" required />
              <label for="inputPassword" class="form-label">รหัสผ่าน</label>
            </div>
            <div class="justify-content-around align-items-center mb-4">
              <!-- Checkbox -->
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="form1Example3" />
                <label class="form-check-label" for="form1Example3"> ยืนยันข้อมูล </label>
              </div>
            </div>
            <!-- Submit button -->
            <div class="d-grid gap-2 col-12 mx-auto mb-4">
              <button type="submit" name="submit" class="btn p-3 mt-3 text-white" style="background-color:#FE9100 ;">สมัครสมาชิก</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
