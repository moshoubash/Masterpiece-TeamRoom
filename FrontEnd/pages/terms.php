<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terms of Service - Meeting Room Marketplace</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            line-height: 1.8;
        }
        .content-section {
            padding: 60px 0;
        }
        .contact-icon {
            font-size: 2rem;
            color: #0d6efd;
            margin-bottom: 1rem;
        }
        .hero-section {
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url("/api/placeholder/1200/400") center/cover no-repeat;
            color: white;
            padding: 4rem 0;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <?php require_once "../components/navbar.php" ?>
    <div class="hero-section">
        <div class="container text-center">
            <h1 class="display-4 fw-bold">Terms of Service</h1>
            <p class="lead">Last Updated: March 12, 2025</p>
        </div>
    </div>
    <!-- Terms of Service Content -->
    <section class="content-section">
        <div class="container">
            <h3>1. Acceptance of Terms</h3>
            <p>By accessing or using the Meeting Room Marketplace ("Service"), you agree to be bound by these Terms of Service ("Terms"). If you do not agree, please do not use the Service.</p>
            
            <h3>2. Use of the Service</h3>
            <p>You may use the Service to browse, list, or book meeting rooms. You agree to provide accurate information and comply with all applicable laws.</p>
            
            <h3>3. User Responsibilities</h3>
            <ul>
                <li>Hosts must maintain their spaces as described in listings.</li>
                <li>Renters must respect the space and follow host rules.</li>
                <li>All users must avoid illegal or harmful activities.</li>
            </ul>
            
            <h3>4. Payments and Fees</h3>
            <p>Renters pay hosts via the Service. We charge a service fee, detailed at checkout. All transactions are final unless otherwise stated.</p>
            
            <h3>5. Termination</h3>
            <p>We may suspend or terminate your account for violating these Terms, with or without notice.</p>
            
            <h3>6. Limitation of Liability</h3>
            <p>The Service is provided "as is." We are not liable for damages arising from your use of the platform.</p>
            
            <h3>7. Contact Us</h3>
            <p>For questions, email us at <a href="mailto:support@meetingroommarketplace.com">support@meetingroommarketplace.com</a>.</p>
        </div>
    </section>

    <?php require_once "../components/footer.php" ?>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>