<div class="container my-4">
  
  <h1 class="my-4 text-center text-uppercase fw-bold text-primary">Sign Up</h1>

  <?php
  if (isset($_SESSION['errors'])): ?>
      <div class="alert alert-danger text-center">
          <?php
          foreach ($_SESSION['errors'] as $error) {
              echo "<p>$error</p>";
          }
          unset($_SESSION['errors']); // Xóa lỗi sau khi hiển thị
          ?>
      </div>
  <?php endif; ?>

  <div class="row justify-content-center">
    <div class="col-md-5">
      <div class="bg-form rounded">

        <form action="/CV-management-website/Controllers/signup_handler.php" method="post" class="p-5 mb-5" id="signup_form">
          
        <div class="mb-3">
            <label for="fullname" class="form-label" >Full name</label>
            <input type="text" class="form-control" id="full_name" name="full_name" placeholder="Enter your full name" required>
          </div>

          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name = "email" placeholder="Enter your email" required>
          </div>

          <div class="mb-3">
            <label for="username" class="form-label" >Username</label>
            <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username" required>
          </div>

          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
          </div>

          <button type="submit" class="mt-2 btn btn-primary">Sign Up</button>

          <p class="mt-4">Already have an account?
          <a href="?page=login" class="text-primary fw-bold">Log in</a>
          </p>

          <!-- Hiển thị lỗi -->
          <div id="errorMessagesSignup" style="color: red; font-size: 0.9rem; margin-top: 10px;"></div>
        </form>
      </div>
    </div>
  </div>
</div>

<script src="/CV-management-website/Controllers/Scripts/validation.js"></script>