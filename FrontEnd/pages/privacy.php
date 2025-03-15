<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Privacy Policy - Meeting Room Marketplace</title>
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
    <?php require_once "../components/navbar.php" ?>
    <div class="hero-section">
        <div class="container text-center">
            <h1 class="display-4 fw-bold">Privacy Policy</h1>
            <p class="lead">Last Updated: March 12, 2025</p>
        </div>
    </div>
    <!-- Privacy Policy Content -->
    <section class="content-section">
        <div class="container">
            <h3>1. Introduction</h3>
            <p>We value your privacy. This Privacy Policy explains how Meeting Room Marketplace ("we," "us") collects, uses, and protects your information.</p>
            
            <h3>2. Information We Collect</h3>
            <p>We collect:</p>
            <ul>
                <li>Personal data (e.g., name, email, payment info) when you register or book.</li>
                <li>Listing data (e.g., location, photos) from hosts.</li>
                <li>Usage data (e.g., pages visited) via cookies.</li>
            </ul>
            
            <h3>3. How We Use Your Information</h3>
            <p>We use your data to:</p>
            <ul>
                <li>Facilitate bookings and payments.</li>
                <li>Improve our Service.</li>
                <li>Send updates or promotions (with your consent).</li>
            </ul>
            
            <h3>4. Sharing Your Information</h3>
            <p>We share data with:</p>
            <ul>
                <li>Hosts/renters to complete bookings.</li>
                <li>Payment processors (e.g., Stripe).</li>
                <li>Legal authorities if required.</li>
            </ul>
            
            <h3>5. Security</h3>
            <p>We use encryption and other measures to protect your data, but no system is 100% secure.</p>
            
            <h3>6. Your Rights</h3>
            <p>You may access, update, or delete your data by contacting us. You can also opt out of marketing emails.</p>
            
            <h3>7. Contact Us</h3>
            <p>Email us at <a href="mailto:support@meetingroommarketplace.com">support@meetingroommarketplace.com</a> with privacy questions.</p>
        </div>
    </section>

    <!-- Footer -->
    <?php require_once "../components/footer.php" ?>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>