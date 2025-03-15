<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RoomShare - Forgot Password</title>
    <!-- Bootstrap 5 CSS from CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/forgot.css" rel="stylesheet">
</head>
<body>
  <div class="container">
    <div class="forgot-container mx-auto">
      <div class="card shadow">
        <div class="card-body p-4 p-md-5">
          <div class="text-center">
            <img src="../assets/images/200x60.svg" alt="RoomShare Logo" class="brand-logo">
            <h2 class="mb-3">Forgot your password</h2>
            <p class="text-muted mb-4">Enter your email address and we'll send you instructions to reset your password.</p>
          </div>
          
          <form>
            <div class="mb-4">
              <label for="email" class="form-label">Email address</label>
              <input type="email" class="form-control form-control-lg" id="email" placeholder="name@example.com" required>
            </div>
            
            <div class="d-grid gap-2 mb-4">
              <button type="submit" class="btn btn-primary btn-lg">Send Reset Link</button>
            </div>
          </form>
          
          <div class="alert alert-light border py-3">
            <div class="d-flex">
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-info-circle info-icon mt-1" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
              </svg>
              <div>
                <p class="mb-0">
                  Didn't receive the email? Check your spam folder or
                  <a href="#" class="text-decoration-none">try another email address</a>.
                </p>
              </div>
            </div>
          </div>
          
          <p class="text-center mt-4">
            <a href="login.php" class="text-decoration-none">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
              </svg>
              Back to login
            </a>
          </p>
        </div>
      </div>
      
      <div class="text-center mt-4 text-muted">
        <small>© 2025 RoomShare. All rights reserved.</small>
      </div>
    </div>
  </div>

  <!-- Bootstrap 5 JS Bundle with Popper from CDN -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>