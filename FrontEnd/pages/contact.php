<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - MeetSpaces</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="../assets/css/contact.css" rel="stylesheet">
</head>
<body>
    <!-- Navbar -->
    <?php require_once "../components/navbar.php" ?>

    <!-- Hero Section -->
    <div class="hero-section">
        <div class="container text-center">
            <h1 class="display-4 fw-bold">Contact Us</h1>
            <p class="lead">Have questions about MeetSpaces? We're here to help.</p>
        </div>
    </div>

    <!-- Contact Info Section -->
    <section class="py-5">
        <div class="container">
            <div class="row g-4 justify-content-center">
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm text-center p-4">
                        <div class="card-body">
                            <i class="bi bi-envelope contact-icon"></i>
                            <h4>Email Us</h4>
                            <p class="text-muted">Our team typically responds within 24 hours</p>
                            <a href="mailto:support@meetspaces.com" class="text-decoration-none">support@meetspaces.com</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm text-center p-4">
                        <div class="card-body">
                            <i class="bi bi-telephone contact-icon"></i>
                            <h4>Call Us</h4>
                            <p class="text-muted">Available Monday to Friday, 9am - 5pm</p>
                            <a href="tel:+18001234567" class="text-decoration-none">+1 (800) 123-4567</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm text-center p-4">
                        <div class="card-body">
                            <i class="bi bi-chat-dots contact-icon"></i>
                            <h4>Live Chat</h4>
                            <p class="text-muted">Get instant help from our support team</p>
                            <button class="btn btn-outline-primary">Start Chat</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Form Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card border-0 shadow">
                        <div class="card-body p-4 p-md-5">
                            <h2 class="text-center mb-4">Send Us a Message</h2>
                            <form>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="firstName" class="form-label">First Name</label>
                                        <input type="text" class="form-control" id="firstName" placeholder="John" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="lastName" class="form-label">Last Name</label>
                                        <input type="text" class="form-control" id="lastName" placeholder="Doe" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" placeholder="john@example.com" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="phone" class="form-label">Phone (optional)</label>
                                        <input type="tel" class="form-control" id="phone" placeholder="+1 (123) 456-7890">
                                    </div>
                                    <div class="col-12">
                                        <label for="subject" class="form-label">Subject</label>
                                        <select class="form-select" id="subject" required>
                                            <option value="" selected disabled>Select a subject</option>
                                            <option value="general">General Inquiry</option>
                                            <option value="booking">Booking Issues</option>
                                            <option value="listing">Listing my Space</option>
                                            <option value="payment">Payment Questions</option>
                                            <option value="report">Report a Problem</option>
                                            <option value="other">Other</option>
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <label for="message" class="form-label">Your Message</label>
                                        <textarea class="form-control" id="message" rows="5" placeholder="How can we help you?" required></textarea>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="newsletter">
                                            <label class="form-check-label" for="newsletter">
                                                Subscribe to our newsletter for updates and offers
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-12 text-center">
                                        <button type="submit" class="btn btn-primary btn-lg px-5">Send Message</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center mb-5">Frequently Asked Questions</h2>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="accordion" id="contactFaq">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="faqOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    How do I list my meeting room on MeetSpaces?
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="faqOne" data-bs-parent="#contactFaq">
                                <div class="accordion-body">
                                    Listing your meeting room is easy! Simply create an account, click on "List Your Space" in the navigation menu, and follow the step-by-step instructions. You'll need to provide details about your space, upload high-quality photos, set your availability, and establish your pricing.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="faqTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    What are the fees for using MeetSpaces?
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="faqTwo" data-bs-parent="#contactFaq">
                                <div class="accordion-body">
                                    For hosts, we charge a 10% service fee on each booking. For guests, there's a 5% booking fee. These fees help us maintain the platform, provide customer support, and ensure a secure payment system for all users.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="faqThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    How do I cancel a booking?
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="faqThree" data-bs-parent="#contactFaq">
                                <div class="accordion-body">
                                    You can cancel a booking by going to "My Bookings" in your account dashboard and selecting the booking you wish to cancel. Please note that cancellation policies vary by host, and refunds are processed according to these policies.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="faqFour">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                    Is my payment information secure?
                                </button>
                            </h2>
                            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="faqFour" data-bs-parent="#contactFaq">
                                <div class="accordion-body">
                                    Yes, we use industry-standard encryption and secure payment processors to ensure your financial information is protected. We never store your complete credit card details on our servers.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center mt-4">
                <p>Still have questions? <a href="#" class="text-decoration-none">Check our full FAQ page</a></p>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php require_once "../components/footer.php" ?>

    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>