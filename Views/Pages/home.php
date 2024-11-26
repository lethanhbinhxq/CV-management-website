<div class="container my-5"> 
    <div class="mb-5">
        <div class="row align-items-center">
            <!-- Cột bên trái -->
            <div class="col-sm-6">
                <h1 class="text-center fw-bold">
                    Professional Resume Management Website
                </h1>
                <p>Build, manage, and share your resumes effortlessly with our intuitive platform.
                    Showcase your skills and experience to potential employers with just a few clicks.</p>
                
                <div class="d-flex justify-content-center">
                    <!-- PHP kiểm tra trạng thái đăng nhập -->
                    <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] > 0): ?>
                        <!-- Nếu đã đăng nhập, chuyển tới trang tạo CV -->
                        <a href="index.php?page=createCV" class="btn btn-primary btn-lg fw-bold">Get Started</a>
                    <?php else: ?>
                        <!-- Nếu chưa đăng nhập, chuyển tới trang đăng nhập -->
                        <a href="Views/Pages/login.php" class="btn btn-primary btn-lg fw-bold">Get Started</a>
                    <?php endif; ?>
                </div>
            </div> 

            <div class="col-sm-6">
                <div class="bg-secondary" style="height: 300px;"></div>
            </div>
        </div>
    </div>

    <hr class="short-divider">

    <div class="container my-5 mx-5">
    <h1 class="text-center mb-5 fw-bold">What We Offer</h1>
    <div class="d-flex justify-content-around">

  <!-- Jobseeker Features -->
  <div>
    <h3 class="text-primary text-center mb-4">For Jobseekers</h3>
    <ul class="list-unstyled">
        <li class="mb-3">
        <i class="bi bi-file-earmark-person me-2 text-primary"></i>
        Create, edit, and delete CVs.
        </li>

        <li class="mb-3">
        <i class="bi bi-cloud-upload me-2 text-primary"></i>
        Upload CVs in PDF files.
      </li>

      <li class="mb-3">
        <i class="bi bi-eye me-2 text-primary"></i>
        Specify CV visibility.
      </li>

      <li class="mb-3">
        <i class="bi bi-link-45deg me-2 text-primary"></i>
        Get a shareable link for each CV.
      </li>
    </ul>
  </div>

  <!-- Viewer Features -->
  <div>
    <h3 class="text-success text-center mb-4">For Viewers</h3>
    <ul class="list-unstyled">
        <li class="mb-3">
        <i class="bi bi-search me-2 text-success"></i>
        Search for CVs to find the right candidate.
        </li>

        <li class="mb-3">
        <i class="bi bi-eye me-2 text-success"></i>
        View CVs with varying levels of access.
      </li>

      <li class="mb-3">
      <i class="bi bi-person-lines-fill me-2 text-success"></i>
      Contact jobseekers directly.
      </li>
    </ul>
  </div>
</div>

  </div>
</div>
