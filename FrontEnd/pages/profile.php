<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile | MeetSpace</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <style>
        .profile-header {
            background-color: #f8f9fa;
            border-radius: 10px;
        }
        .avatar {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 50%;
            border: 3px solid #fff;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .nav-pills .nav-link.active {
            background-color: #0d6efd;
        }
        .verification-badge {
            font-size: 0.75rem;
            padding: 0.2rem 0.5rem;
        }
        .review-avatar {
            width: 40px;
            height: 40px;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <?php require_once "../components/navbar.php" ?>

    <!-- Main Content -->
    <div class="container py-4">
        <!-- Profile Header -->
        <div class="profile-header p-4 mb-4">
            <div class="row align-items-center">
                <div class="col-md-auto mb-3 mb-md-0 text-center text-md-start">
                    <img src="../assets/images/120x120.svg" alt="Profile Picture" class="avatar">
                </div>
                <div class="col-md">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center">
                        <div>
                            <h2 class="mb-1">John Doe</h2>
                            <p class="text-muted mb-2">Member since January 2023</p>
                            <div class="mb-2">
                                <span class="badge bg-success verification-badge me-1">
                                    <i class="bi bi-check-circle-fill me-1"></i>Email Verified
                                </span>
                                <span class="badge bg-success verification-badge me-1">
                                    <i class="bi bi-check-circle-fill me-1"></i>ID Verified
                                </span>
                                <span class="badge bg-success verification-badge">
                                    <i class="bi bi-check-circle-fill me-1"></i>Phone Verified
                                </span>
                            </div>
                        </div>
                        <div class="mt-2 mt-md-0">
                            <button class="btn btn-outline-primary me-2">
                                <i class="bi bi-pencil me-1"></i>Edit Profile
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Profile Content -->
        <div class="row">
            <!-- Left Side Navigation -->
            <div class="col-md-3 mb-4">
                <div class="card">
                    <div class="card-body p-0">
                        <div class="nav flex-column nav-pills" id="profile-tabs" role="tablist">
                            <button class="nav-link active text-start p-3 rounded-0" id="personal-info-tab" data-bs-toggle="pill" data-bs-target="#personal-info" type="button" role="tab">
                                <i class="bi bi-person me-2"></i>Personal Information
                            </button>
                            <button class="nav-link text-start p-3 rounded-0" id="booking-history-tab" data-bs-toggle="pill" data-bs-target="#booking-history" type="button" role="tab">
                                <i class="bi bi-calendar-check me-2"></i>Booking History
                            </button>
                            <button class="nav-link text-start p-3 rounded-0" id="reviews-tab" data-bs-toggle="pill" data-bs-target="#reviews" type="button" role="tab">
                                <i class="bi bi-star me-2"></i>Reviews
                            </button>
                            <button class="nav-link text-start p-3 rounded-0" id="verification-tab" data-bs-toggle="pill" data-bs-target="#verification" type="button" role="tab">
                                <i class="bi bi-shield-check me-2"></i>Verification
                            </button>
                            <button class="nav-link text-start p-3 rounded-0" id="listings-tab" data-bs-toggle="pill" data-bs-target="#listings" type="button" role="tab">
                                <i class="bi bi-building me-2"></i>My Listings
                            </button>
                            <button class="nav-link text-start p-3 rounded-0" id="settings-tab" data-bs-toggle="pill" data-bs-target="#settings" type="button" role="tab">
                                <i class="bi bi-gear me-2"></i>Account Settings
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side Content -->
            <div class="col-md-9">
                <div class="card">
                    <div class="card-body">
                        <div class="tab-content" id="profile-tabsContent">
                            <!-- Personal Information Tab -->
                            <div class="tab-pane fade show active" id="personal-info" role="tabpanel">
                                <h4 class="mb-4">Personal Information</h4>
                                <form id="profileForm">
                                    <div class="row mb-3">
                                        <div class="col-md-6 mb-3 mb-md-0">
                                            <label for="firstName" class="form-label">First Name</label>
                                            <input type="text" class="form-control" id="firstName" value="John">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="lastName" class="form-label">Last Name</label>
                                            <input type="text" class="form-control" id="lastName" value="Doe">
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email Address</label>
                                        <input type="email" class="form-control" id="email" value="john.doe@example.com">
                                    </div>
                                    <div class="mb-3">
                                        <label for="phone" class="form-label">Phone Number</label>
                                        <input type="tel" class="form-control" id="phone" value="+1 (555) 123-4567">
                                    </div>
                                    <div class="mb-3">
                                        <label for="about" class="form-label">About Me</label>
                                        <textarea class="form-control" id="about" rows="3">Business professional looking for meeting spaces in the downtown area. I organize team meetings and client presentations regularly.</textarea>
                                    </div>
                                    <div class="mb-4">
                                        <label for="profilePicture" class="form-label">Profile Picture</label>
                                        <input class="form-control" type="file" id="profilePicture">
                                    </div>
                                    <button type="button" class="btn btn-primary" id="saveProfileBtn">Save Changes</button>
                                </form>
                            </div>

                            <!-- Booking History Tab -->
                            <div class="tab-pane fade" id="booking-history" role="tabpanel">
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <h4>Booking History</h4>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-outline-secondary active">All</button>
                                        <button type="button" class="btn btn-outline-secondary">Upcoming</button>
                                        <button type="button" class="btn btn-outline-secondary">Past</button>
                                    </div>
                                </div>

                                <div class="list-group mb-4">
                                    <!-- Upcoming Booking -->
                                    <div class="list-group-item list-group-item-action p-4">
                                        <div class="row align-items-center">
                                            <div class="col-md-2 mb-3 mb-md-0">
                                                <img src="../assets/images/100x80.svg" alt="Meeting Room" class="img-fluid rounded">
                                            </div>
                                            <div class="col-md-7 mb-3 mb-md-0">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h5 class="mb-1">Downtown Executive Suite</h5>
                                                    <span class="badge bg-primary">Upcoming</span>
                                                </div>
                                                <p class="mb-1 text-muted">
                                                    <i class="bi bi-calendar me-2"></i>Mar 15, 2025 (9:00 AM - 12:00 PM)
                                                </p>
                                                <p class="mb-1 text-muted">
                                                    <i class="bi bi-geo-alt me-2"></i>123 Business Ave, Suite 200
                                                </p>
                                                <p class="mb-0 text-muted">
                                                    <i class="bi bi-people me-2"></i>Capacity: 8 people
                                                </p>
                                            </div>
                                            <div class="col-md-3 text-md-end">
                                                <p class="fw-bold mb-2">$120.00</p>
                                                <div class="btn-group">
                                                    <button class="btn btn-sm btn-outline-primary">Details</button>
                                                    <button class="btn btn-sm btn-outline-danger">Cancel</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Past Booking -->
                                    <div class="list-group-item list-group-item-action p-4">
                                        <div class="row align-items-center">
                                            <div class="col-md-2 mb-3 mb-md-0">
                                                <img src="../assets/images/100x80.svg" alt="Meeting Room" class="img-fluid rounded">
                                            </div>
                                            <div class="col-md-7 mb-3 mb-md-0">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h5 class="mb-1">Creative Collaboration Space</h5>
                                                    <span class="badge bg-secondary">Completed</span>
                                                </div>
                                                <p class="mb-1 text-muted">
                                                    <i class="bi bi-calendar me-2"></i>Mar 5, 2025 (2:00 PM - 5:00 PM)
                                                </p>
                                                <p class="mb-1 text-muted">
                                                    <i class="bi bi-geo-alt me-2"></i>456 Innovation Blvd, Floor 3
                                                </p>
                                                <p class="mb-0 text-muted">
                                                    <i class="bi bi-people me-2"></i>Capacity: 12 people
                                                </p>
                                            </div>
                                            <div class="col-md-3 text-md-end">
                                                <p class="fw-bold mb-2">$180.00</p>
                                                <div class="btn-group">
                                                    <button class="btn btn-sm btn-outline-primary">Details</button>
                                                    <button class="btn btn-sm btn-outline-success">Write Review</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <nav aria-label="Booking history pagination">
                                    <ul class="pagination justify-content-center">
                                        <li class="page-item disabled">
                                            <a class="page-link" href="#" tabindex="-1">Previous</a>
                                        </li>
                                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item">
                                            <a class="page-link" href="#">Next</a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>

                            <!-- Reviews Tab -->
                            <div class="tab-pane fade" id="reviews" role="tabpanel">
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <h4>Reviews</h4>
                                    <ul class="nav nav-pills">
                                        <li class="nav-item">
                                            <button class="nav-link active" data-bs-toggle="pill" data-bs-target="#received-reviews">Received</button>
                                        </li>
                                        <li class="nav-item">
                                            <button class="nav-link" data-bs-toggle="pill" data-bs-target="#given-reviews">Given</button>
                                        </li>
                                    </ul>
                                </div>

                                <div class="tab-content">
                                    <!-- Received Reviews -->
                                    <div class="tab-pane fade show active" id="received-reviews">
                                        <div class="card bg-light mb-4">
                                            <div class="card-body">
                                                <div class="d-flex mb-3">
                                                    <img src="../assets/images/40x40.svg" alt="Reviewer" class="review-avatar rounded-circle me-3">
                                                    <div>
                                                        <h5 class="card-title mb-1">Sarah Johnson</h5>
                                                        <p class="text-muted small mb-0">February 28, 2025</p>
                                                    </div>
                                                    <div class="ms-auto">
                                                        <div class="text-warning">
                                                            <i class="bi bi-star-fill"></i>
                                                            <i class="bi bi-star-fill"></i>
                                                            <i class="bi bi-star-fill"></i>
                                                            <i class="bi bi-star-fill"></i>
                                                            <i class="bi bi-star-fill"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <p class="mb-0">John was a fantastic guest! He left the space in perfect condition and communicated clearly throughout the booking process. I would happily host him again anytime.</p>
                                            </div>
                                        </div>

                                        <div class="card bg-light">
                                            <div class="card-body">
                                                <div class="d-flex mb-3">
                                                    <img src="../assets/images/40x40.svg" alt="Reviewer" class="review-avatar rounded-circle me-3">
                                                    <div>
                                                        <h5 class="card-title mb-1">Michael Chen</h5>
                                                        <p class="text-muted small mb-0">January 15, 2025</p>
                                                    </div>
                                                    <div class="ms-auto">
                                                        <div class="text-warning">
                                                            <i class="bi bi-star-fill"></i>
                                                            <i class="bi bi-star-fill"></i>
                                                            <i class="bi bi-star-fill"></i>
                                                            <i class="bi bi-star-fill"></i>
                                                            <i class="bi bi-star"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <p class="mb-0">Great renter - punctual, respectful, and left everything in order. Would definitely rent to John again!</p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Given Reviews -->
                                    <div class="tab-pane fade" id="given-reviews">
                                        <div class="card bg-light mb-4">
                                            <div class="card-body">
                                                <div class="d-flex mb-3">
                                                    <img src="/api/placeholder/40/40" alt="Reviewer" class="review-avatar rounded-circle me-3">
                                                    <div>
                                                        <h5 class="card-title mb-1">Downtown Executive Suite</h5>
                                                        <p class="text-muted small mb-0">March 6, 2025</p>
                                                    </div>
                                                    <div class="ms-auto">
                                                        <div class="text-warning">
                                                            <i class="bi bi-star-fill"></i>
                                                            <i class="bi bi-star-fill"></i>
                                                            <i class="bi bi-star-fill"></i>
                                                            <i class="bi bi-star-fill"></i>
                                                            <i class="bi bi-star-half"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <p class="mb-0">Perfect space for our client meeting. Clean, professional, and well-equipped with all the technology we needed. The host was responsive and helpful throughout the process.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Verification Tab -->
                            <div class="tab-pane fade" id="verification" role="tabpanel">
                                <h4 class="mb-4">Verification</h4>
                                <p class="text-muted mb-4">Verify your identity to build trust with hosts and access more listings. Verified users receive priority booking options.</p>

                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <h5><i class="bi bi-envelope me-2 text-primary"></i>Email Verification</h5>
                                                <p class="text-muted mb-0">Your email has been verified: john.doe@example.com</p>
                                            </div>
                                            <span class="badge bg-success">Verified</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <h5><i class="bi bi-phone me-2 text-primary"></i>Phone Verification</h5>
                                                <p class="text-muted mb-0">Your phone number has been verified: +1 (555) 123-4567</p>
                                            </div>
                                            <span class="badge bg-success">Verified</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <div>
                                                <h5><i class="bi bi-person-badge me-2 text-primary"></i>ID Verification</h5>
                                                <p class="text-muted mb-0">Upload a government-issued ID to verify your identity.</p>
                                            </div>
                                            <span class="badge bg-success">Verified</span>
                                        </div>
                                        <div class="collapse" id="idVerificationCollapse">
                                            <div class="card bg-light">
                                                <div class="card-body">
                                                    <form id="idVerificationForm">
                                                        <div class="mb-3">
                                                            <label for="idType" class="form-label">ID Type</label>
                                                            <select class="form-select" id="idType">
                                                                <option>Driver's License</option>
                                                                <option>Passport</option>
                                                                <option>National ID Card</option>
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="idFront" class="form-label">Front of ID</label>
                                                            <input class="form-control" type="file" id="idFront">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="idBack" class="form-label">Back of ID (if applicable)</label>
                                                            <input class="form-control" type="file" id="idBack">
                                                        </div>
                                                        <button type="button" class="btn btn-primary">Submit for Verification</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <div>
                                                <h5><i class="bi bi-building me-2 text-primary"></i>Business Verification</h5>
                                                <p class="text-muted mb-0">Verify your business to access exclusive corporate rates.</p>
                                            </div>
                                            <button class="btn btn-outline-primary" type="button" data-bs-toggle="collapse" data-bs-target="#businessVerificationCollapse">
                                                Verify Now
                                            </button>
                                        </div>
                                        <div class="collapse" id="businessVerificationCollapse">
                                            <div class="card bg-light">
                                                <div class="card-body">
                                                    <form id="businessVerificationForm">
                                                        <div class="mb-3">
                                                            <label for="companyName" class="form-label">Company Name</label>
                                                            <input type="text" class="form-control" id="companyName">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="businessEmail" class="form-label">Business Email</label>
                                                            <input type="email" class="form-control" id="businessEmail">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="businessDocument" class="form-label">Business Registration Document</label>
                                                            <input class="form-control" type="file" id="businessDocument">
                                                        </div>
                                                        <button type="button" class="btn btn-primary">Submit for Verification</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Listings Tab -->
                            <div class="tab-pane fade" id="listings" role="tabpanel">
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <h4>My Listings</h4>
                                    <button class="btn btn-primary">
                                        <i class="bi bi-plus-lg me-1"></i>Add New Space
                                    </button>
                                </div>

                                <div class="card mb-4">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-4 mb-3 mb-md-0">
                                                <img src="../assets/images/300x200.svg" class="img-fluid rounded" alt="Meeting Room">
                                            </div>
                                            <div class="col-md-8">
                                                <div class="d-flex justify-content-between align-items-start">
                                                    <h5 class="card-title">Modern Boardroom with City Views</h5>
                                                    <span class="badge bg-success">Active</span>
                                                </div>
                                                <p class="text-muted mb-2">
                                                    <i class="bi bi-geo-alt me-1"></i>789 Skyline Tower, 15th Floor
                                                </p>
                                                <p class="text-muted mb-2">
                                                    <i class="bi bi-people me-1"></i>Capacity: 10 people
                                                </p>
                                                <p class="mb-3">Elegant boardroom with floor-to-ceiling windows, videoconferencing equipment, and catering options available.</p>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <p class="fw-bold mb-0">$75 / hour</p>
                                                    <div class="btn-group">
                                                        <button class="btn btn-sm btn-outline-primary">Edit</button>
                                                        <button class="btn btn-sm btn-outline-secondary">Manage Calendar</button>
                                                        <button class="btn btn-sm btn-outline-danger">Deactivate</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-4 mb-3 mb-md-0">
                                                <img src="../assets/images/300x200.svg" class="img-fluid rounded" alt="Meeting Room">
                                            </div>
                                            <div class="col-md-8">
                                                <div class="d-flex justify-content-between align-items-start">
                                                    <h5 class="card-title">Creative Collaboration Space</h5>
                                                    <span class="badge bg-warning text-dark">Pending Review</span>
                                                </div>
                                                <p class="text-muted mb-2">
                                                    <i class="bi bi-geo-alt me-1"></i>101 Innovation Hub, Suite 3B
                                                </p>
                                                <p class="text-muted mb-2">
                                                    <i class="bi bi-people me-1"></i>Capacity: 15 people
                                                </p>
                                                <p class="mb-3">Open-concept space with whiteboard walls, flexible furniture arrangements, and high-speed Wi-Fi.</p>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <p class="fw-bold mb-0">$60 / hour</p>
                                                    <div class="btn-group">
                                                        <button class="btn btn-sm btn-outline-primary">Edit</button>
                                                        <button class="btn btn-sm btn-outline-secondary" disabled>Manage Calendar</button>
                                                        <button class="btn btn-sm btn-outline-danger">Delete</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Settings Tab -->
                            <div class="tab-pane fade" id="settings" role="tabpanel">
                                <h4 class="mb-4">Account Settings</h4>

                                <!-- Change Password Section -->
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <h5 class="mb-0">Change Password</h5>
                                    </div>
                                    <div class="card-body">
                                        <form id="passwordForm">
                                            <div class="mb-3">
                                                <label for="currentPassword" class="form-label">Current Password</label>
                                                <input type="password" class="form-control" id="currentPassword">
                                            </div>
                                            <div class="mb-3">
                                                <label for="newPassword" class="form-label">New Password</label>
                                                <input type="password" class="form-control" id="newPassword">
                                            </div>
                                            <div class="mb-3">
                                                <label for="confirmPassword" class="form-label">Confirm New Password</label>
                                                <input type="password" class="form-control" id="confirmPassword">
                                            </div>
                                            <button type="button" class="btn btn-primary">Update Password</button>
                                        </form>
                                    </div>
                                </div>

                                <!-- Notification Settings Section -->
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <h5 class="mb-0">Notification Settings</h5>
                                    </div>
                                    <div class="card-body">
                                        <form id="notificationForm">
                                            <div class="form-check form-switch mb-3">
                                                <input class="form-check-input" type="checkbox" id="emailNotifications" checked>
                                                <label class="form-check-label" for="emailNotifications">Email Notifications</label>
                                                <div class="text-muted small">Receive booking confirmations, reminders, and updates</div>
                                            </div>
                                            <div class="form-check form-switch mb-3">
                                                <input class="form-check-input" type="checkbox" id="smsNotifications" checked>
                                                <label class="form-check-label" for="smsNotifications">SMS Notifications</label>
                                                <div class="text-muted small">Receive text message alerts for important updates</div>
                                            </div>
                                            <div class="form-check form-switch mb-3">
                                                <input class="form-check-input" type="checkbox" id="marketingEmails">
                                                <label class="form-check-label" for="marketingEmails">Marketing Emails</label>
                                                <div class="text-muted small">Receive promotional offers and newsletter</div>
                                            </div>
                                            <button type="button" class="btn btn-primary">Save Preferences</button>
                                        </form>
                                    </div>
                                </div>

                                <!-- Payment Methods Section -->
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <h5 class="mb-0">Payment Methods</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <div class="d-flex align-items-center">
                                                <i class="bi bi-credit-card fs-4 me-3"></i>
                                                <div>
                                                    <p class="mb-0 fw-medium">Visa ending in 4567</p>
                                                    <p class="text-muted mb-0 small">Expires 12/27</p>
                                                </div>
                                            </div>
                                            <div>
                                                <span class="badge bg-success me-2">Default</span>
                                                <button class="btn btn-sm btn-outline-danger">Remove</button>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-flex align-items-center">
                                                <i class="bi bi-credit-card fs-4 me-3"></i>
                                                <div>
                                                    <p class="mb-0 fw-medium">Mastercard ending in 8901</p>
                                                    <p class="text-muted mb-0 small">Expires 03/26</p>
                                                </div>
                                            </div>
                                            <div>
                                                <button class="btn btn-sm btn-outline-secondary me-2">Make Default</button>
                                                <button class="btn btn-sm btn-outline-danger">Remove</button>
                                            </div>
                                        </div>
                                        <hr>
                                        <button type="button" class="btn btn-outline-primary">
                                            <i class="bi bi-plus-lg me-2"></i>Add Payment Method
                                        </button>
                                    </div>
                                </div>

                                <!-- Account Deletion Section -->
                                <div class="card">
                                    <div class="card-header bg-danger bg-opacity-10">
                                        <h5 class="mb-0 text-danger">Delete Account</h5>
                                    </div>
                                    <div class="card-body">
                                        <p class="text-muted mb-3">Permanently delete your account and all associated data. This action cannot be undone.</p>
                                        <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteAccountModal">
                                            Delete My Account
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php require_once "../components/footer.php" ?>

    <!-- Delete Account Modal -->
    <div class="modal fade" id="deleteAccountModal" tabindex="-1" aria-labelledby="deleteAccountModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteAccountModalLabel">Confirm Account Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        This action is permanent and cannot be undone.
                    </div>
                    <p>Please type <strong>DELETE</strong> to confirm that you wish to permanently delete your account:</p>
                    <div class="mb-3">
                        <input type="text" class="form-control" id="deleteConfirmation" placeholder="Type DELETE here">
                    </div>
                    <div class="mb-3">
                        <label for="deletionReason" class="form-label">Please tell us why you're leaving (optional):</label>
                        <select class="form-select" id="deletionReason">
                            <option value="" selected>Choose a reason...</option>
                            <option value="found_alternative">Found a better alternative</option>
                            <option value="price">Too expensive</option>
                            <option value="no_use">Don't use the service anymore</option>
                            <option value="technical">Technical issues</option>
                            <option value="other">Other reason</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="deletionFeedback" class="form-label">Additional feedback (optional):</label>
                        <textarea class="form-control" id="deletionFeedback" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteBtn" disabled>Delete Account</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap and custom JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Enable delete confirmation button only when "DELETE" is typed
        document.getElementById('deleteConfirmation').addEventListener('input', function() {
            const confirmButton = document.getElementById('confirmDeleteBtn');
            confirmButton.disabled = this.value !== 'DELETE';
        });

        // Sample toast notification for profile save
        document.getElementById('saveProfileBtn').addEventListener('click', function() {
            // In a real app, you would save the profile data to the server here
            // Then show a success message
            alert('Profile changes saved successfully!');
        });

        // Logout functionality
        document.getElementById('logoutBtn').addEventListener('click', function(e) {
            e.preventDefault();
            // In a real app, you would invalidate the session here
            // Then redirect to login page
            alert('You have been logged out successfully!');
            // window.location.href = 'login.html';
        });
    </script>
</body>
</html>