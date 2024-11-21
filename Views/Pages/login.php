<div class="container my-4">
  <h1 class="my-4 text-center text-uppercase fw-bold text-main-pink">Log In</h1>

  <?php
  #session_start(); // Khởi tạo session để đọc dữ liệu
  if (isset($_SESSION['error'])): ?>
      <div class="alert alert-danger text-center">
          <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
      </div>
    
  <?php endif; ?>

  <div class="row justify-content-center">
    <div class="col-md-5">
      <div class="bg-form rounded">

        <form action="/CV-management-website/Controllers/login_handler.php" method="post" class="p-5 mb-5" id="login_form">
          
          <div class="mb-3">
            <label for="username" class="form-label" >Username</label>
            <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username" required>
          </div>

          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
          </div>

          <button type="submit" class="mt-2 btn btn-primary">Log In</button>

          <p class="mt-4">Haven't got an account?
            <a href="?page=signup" class="text-main-pink fw-bold">Sign up</a>
          </p>
        <!-- Hiển thị lỗi -->
        <div id="errorMessages" style="color: red; font-size: 0.9rem; margin-top: 10px;"></div>
        </form>
      </div>
    </div>
  </div>
</div>


<script src="/CV-management-website/Scripts/validation.js"></script>

