<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meeting Room Listing | RoomShare</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="../assets/css/detail.css" rel="stylesheet">
</head>
<body>
    <!-- Header/Navbar -->
    <?php require_once "../components/navbar.php" ?>

    <!-- Main Content -->
    <div class="container my-4">
        <!-- Room Title and Quick Info -->
        <div class="row mb-4">
            <div class="col-12">
                <h1 class="mb-2">Modern Conference Room in Downtown</h1>
                <div class="d-flex flex-wrap align-items-center gap-3">
                    <span class="badge bg-success">Available Now</span>
                    <span><i class="bi bi-geo-alt"></i> Financial District, New York</span>
                    <span><i class="bi bi-star-fill text-warning"></i> 4.8 (42 reviews)</span>
                    <span><i class="bi bi-people-fill"></i> Capacity: 12 people</span>
                </div>
            </div>
        </div>

        <!-- Photo Gallery and Booking Details -->
        <div class="row mb-4">
            <!-- Photos -->
            <div class="col-lg-8 mb-4 mb-lg-0">
                <div id="roomCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#roomCarousel" data-bs-slide-to="0" class="active"></button>
                        <button type="button" data-bs-target="#roomCarousel" data-bs-slide-to="1"></button>
                        <button type="button" data-bs-target="#roomCarousel" data-bs-slide-to="2"></button>
                        <button type="button" data-bs-target="#roomCarousel" data-bs-slide-to="3"></button>
                    </div>
                    <div class="carousel-inner rounded">
                        <div class="carousel-item active">
                            <img src="../assets/images/meet1.jpg" class="d-block w-100" alt="Meeting Room Main View">
                        </div>
                        <div class="carousel-item">
                            <img src="../assets/images/meet2.jpg" class="d-block w-100" alt="Meeting Room Side View">
                        </div>
                        <div class="carousel-item">
                            <img src="../assets/images/meet3.jpg" class="d-block w-100" alt="Meeting Room Equipment">
                        </div>
                        <div class="carousel-item">
                            <img src="../assets/images/meet3.jpg" class="d-block w-100" alt="Meeting Room Window View">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#roomCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#roomCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>

            <!-- Booking Card -->
            <div class="col-lg-4">
                <div class="card shadow">
                    <div class="card-body">
                        <h3 class="card-title text-center mb-3">$75 <small class="text-muted">/ hour</small></h3>
                        
                        <!-- Date Picker -->
                        <div class="mb-3">
                            <label class="form-label">Date</label>
                            <input type="date" class="form-control" id="bookingDate" min="2025-03-12">
                        </div>
                        
                        <!-- Time Slots -->
                        <div class="mb-3">
                            <label class="form-label">Time Slots</label>
                            <div class="d-flex flex-wrap gap-2" id="timeSlots">
                                <button class="btn btn-outline-primary btn-sm">9:00 AM</button>
                                <button class="btn btn-outline-primary btn-sm">10:00 AM</button>
                                <button class="btn btn-outline-primary btn-sm">11:00 AM</button>
                                <button class="btn btn-outline-primary btn-sm disabled">12:00 PM</button>
                                <button class="btn btn-outline-primary btn-sm disabled">1:00 PM</button>
                                <button class="btn btn-outline-primary btn-sm">2:00 PM</button>
                                <button class="btn btn-outline-primary btn-sm">3:00 PM</button>
                                <button class="btn btn-outline-primary btn-sm">4:00 PM</button>
                                <button class="btn btn-outline-primary btn-sm">5:00 PM</button>
                            </div>
                        </div>
                        
                        <!-- Duration -->
                        <div class="mb-3">
                            <label class="form-label">Duration</label>
                            <select class="form-select">
                                <option>1 hour</option>
                                <option>2 hours</option>
                                <option>3 hours</option>
                                <option>4 hours</option>
                                <option>Full day (8 hours)</option>
                            </select>
                        </div>
                        
                        <!-- Pricing Summary -->
                        <div class="card bg-light mb-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-between mb-2">
                                    <span>$75 × 2 hours</span>
                                    <span>$150</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Cleaning fee</span>
                                    <span>$25</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Service fee</span>
                                    <span>$15</span>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-between fw-bold">
                                    <span>Total</span>
                                    <span>$190</span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Book Now Button -->
                        <button class="btn btn-primary w-100 btn-book-now" data-bs-toggle="modal" data-bs-target="#bookingConfirmModal">
                            Book Now
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Room Details and Host Info -->
        <div class="row">
            <!-- Room Description and Amenities -->
            <div class="col-lg-8">
                <div class="mb-4">
                    <h2 class="mb-3">About This Space</h2>
                    <p>This modern conference room located in the heart of the Financial District offers a professional and comfortable environment for your meetings, presentations, and brainstorming sessions. Recently renovated with state-of-the-art equipment and stylish furnishings.</p>
                    <p>The space features floor-to-ceiling windows with stunning city views, creating an inspiring atmosphere for your team or clients. Centrally located with easy access to public transportation, restaurants, and cafes.</p>
                </div>

                <!-- Amenities -->
                <div class="mb-4">
                    <h3 class="mb-3">Amenities</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><i class="bi bi-wifi me-2"></i> High-speed WiFi</li>
                                <li class="list-group-item"><i class="bi bi-projector me-2"></i> Projector & Screen</li>
                                <li class="list-group-item"><i class="bi bi-display me-2"></i> 4K Smart TV</li>
                                <li class="list-group-item"><i class="bi bi-mic me-2"></i> Video Conference System</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><i class="bi bi-cup-hot me-2"></i> Coffee & Tea</li>
                                <li class="list-group-item"><i class="bi bi-printer me-2"></i> Printer Access</li>
                                <li class="list-group-item"><i class="bi bi-snow2 me-2"></i> Air Conditioning</li>
                                <li class="list-group-item"><i class="bi bi-door-open me-2"></i> Wheelchair Accessible</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Location -->
                <div class="mb-4">
                    <h3 class="mb-3">Location</h3>
                    <div class="ratio ratio-16x9 mb-3">
                        <img src="../assets/images/600x300.svg" class="img-fluid rounded" alt="Map Location">
                    </div>
                    <p><i class="bi bi-geo-alt"></i> Financial District, New York, NY 10005</p>
                    <p>Located on the 18th floor of a premium office building. Steps away from Wall Street subway station. 24/7 security in the building.</p>
                </div>

                <!-- House Rules -->
                <div class="mb-4">
                    <h3 class="mb-3">House Rules</h3>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><i class="bi bi-check-circle me-2 text-success"></i> No food allowed in the meeting room</li>
                        <li class="list-group-item"><i class="bi bi-check-circle me-2 text-success"></i> Please leave the space as you found it</li>
                        <li class="list-group-item"><i class="bi bi-check-circle me-2 text-success"></i> Maximum capacity: 12 people</li>
                        <li class="list-group-item"><i class="bi bi-x-circle me-2 text-danger"></i> No smoking</li>
                    </ul>
                </div>

                <!-- Reviews Section -->
                <div class="mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h2><i class="bi bi-star-fill text-warning"></i> 4.8 · 42 reviews</h2>
                        <div class="dropdown">
                            <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="reviewSortDropdown" data-bs-toggle="dropdown">
                                Sort by
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="reviewSortDropdown">
                                <li><a class="dropdown-item" href="#">Most recent</a></li>
                                <li><a class="dropdown-item" href="#">Highest rated</a></li>
                                <li><a class="dropdown-item" href="#">Lowest rated</a></li>
                            </ul>
                        </div>
                    </div>

                    <!-- Review Categories -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="d-flex align-items-center mb-2">
                                <span class="me-2">Cleanliness</span>
                                <div class="progress flex-grow-1" style="height: 8px;">
                                    <div class="progress-bar bg-success" style="width: 95%"></div>
                                </div>
                                <span class="ms-2">4.9</span>
                            </div>
                            <div class="d-flex align-items-center mb-2">
                                <span class="me-2">Accuracy</span>
                                <div class="progress flex-grow-1" style="height: 8px;">
                                    <div class="progress-bar bg-success" style="width: 90%"></div>
                                </div>
                                <span class="ms-2">4.8</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-center mb-2">
                                <span class="me-2">Communication</span>
                                <div class="progress flex-grow-1" style="height: 8px;">
                                    <div class="progress-bar bg-success" style="width: 95%"></div>
                                </div>
                                <span class="ms-2">4.9</span>
                            </div>
                            <div class="d-flex align-items-center mb-2">
                                <span class="me-2">Value</span>
                                <div class="progress flex-grow-1" style="height: 8px;">
                                    <div class="progress-bar bg-success" style="width: 85%"></div>
                                </div>
                                <span class="ms-2">4.6</span>
                            </div>
                        </div>
                    </div>

                    <!-- Individual Reviews -->
                    <div class="mb-4">
                        <!-- Review 1 -->
                        <div class="border-bottom pb-3 mb-3">
                            <div class="d-flex mb-2">
                                <img src="../assets/images/40x40.svg" class="rounded-circle review-avatar me-2" alt="Reviewer">
                                <div>
                                    <h5 class="mb-0">Michael P.</h5>
                                    <p class="text-muted small mb-0">March 2025</p>
                                </div>
                            </div>
                            <div class="mb-2">
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                            </div>
                            <p>Perfect space for our client presentation. The room was immaculate, and all the technology worked flawlessly. Our clients were impressed with the views and professional setting. Would definitely book again!</p>
                        </div>

                        <!-- Review 2 -->
                        <div class="border-bottom pb-3 mb-3">
                            <div class="d-flex mb-2">
                                <img src="../assets/images/40x40.svg" class="rounded-circle review-avatar me-2" alt="Reviewer">
                                <div>
                                    <h5 class="mb-0">Sarah J.</h5>
                                    <p class="text-muted small mb-0">February 2025</p>
                                </div>
                            </div>
                            <div class="mb-2">
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star text-warning"></i>
                            </div>
                            <p>Great location and beautiful space. The host was very responsive and accommodating to our last-minute booking. Only reason for 4 stars is that the WiFi was a bit slow for our video conference needs.</p>
                        </div>

                        <!-- Review 3 -->
                        <div class="border-bottom pb-3 mb-3">
                            <div class="d-flex mb-2">
                                <img src="../assets/images/40x40.svg" class="rounded-circle review-avatar me-2" alt="Reviewer">
                                <div>
                                    <h5 class="mb-0">David R.</h5>
                                    <p class="text-muted small mb-0">February 2025</p>
                                </div>
                            </div>
                            <div class="mb-2">
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                            </div>
                            <p>We used this space for a full-day strategy session with our team. The environment was perfect for creative thinking, and having coffee/tea provided was a nice touch. Plenty of restaurants nearby for lunch break.</p>
                        </div>

                        <button class="btn btn-outline-primary">Show all 42 reviews</button>
                    </div>
                </div>
            </div>

            <!-- Host Profile -->
            <div class="col-lg-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <h3 class="card-title mb-3">Meet Your Host</h3>
                        <div class="d-flex align-items-center mb-3">
                            <img src="../assets/images/60x60.svg" class="rounded-circle host-img me-3" alt="Host">
                            <div>
                                <h4 class="mb-0">Jennifer H.</h4>
                                <p class="text-muted mb-0">Host since 2023</p>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="d-flex align-items-center mb-1">
                                <i class="bi bi-star-fill text-warning me-1"></i>
                                <span>4.9 · 87 reviews</span>
                            </div>
                            <div class="d-flex align-items-center mb-1">
                                <i class="bi bi-shield-check text-success me-1"></i>
                                <span>Identity verified</span>
                            </div>
                            <div class="d-flex align-items-center">
                                <i class="bi bi-clock text-primary me-1"></i>
                                <span>Response time: <strong>within 1 hour</strong></span>
                            </div>
                        </div>
                        <p>I manage several premium meeting spaces in Manhattan. As a former event coordinator, I understand the importance of professional, well-equipped spaces for business needs.</p>
                        <hr>
                        <h5>Languages</h5>
                        <p>English, Spanish, French</p>
                        <button class="btn btn-outline-primary w-100">Contact Host</button>
                    </div>
                </div>

                <!-- More Spaces from this Host -->
                <div class="card mb-4">
                    <div class="card-body">
                        <h3 class="card-title mb-3">More Spaces from Jennifer</h3>
                        
                        <!-- Space 1 -->
                        <div class="d-flex mb-3">
                            <img src="../assets/images/80x80.svg" class="rounded me-2" alt="Other Space">
                            <div>
                                <h6 class="mb-1">Cozy Meeting Room - Midtown</h6>
                                <div class="d-flex align-items-center small">
                                    <i class="bi bi-star-fill text-warning me-1"></i>
                                    <span>4.7 · 8 people</span>
                                </div>
                                <span class="text-primary">$60/hr</span>
                            </div>
                        </div>
                        
                        <!-- Space 2 -->
                        <div class="d-flex">
                            <img src="../assets/images/80x80.svg" class="rounded me-2" alt="Other Space">
                            <div>
                                <h6 class="mb-1">Executive Boardroom - SoHo</h6>
                                <div class="d-flex align-items-center small">
                                    <i class="bi bi-star-fill text-warning me-1"></i>
                                    <span>4.9 · 16 people</span>
                                </div>
                                <span class="text-primary">$120/hr</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Similar Spaces Nearby -->
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title mb-3">Similar Spaces Nearby</h3>
                        
                        <!-- Similar Space 1 -->
                        <div class="d-flex mb-3">
                            <img src="../assets/images/80x80.svg" class="rounded me-2" alt="Similar Space">
                            <div>
                                <h6 class="mb-1">Bright Meeting Room - Wall St</h6>
                                <div class="d-flex align-items-center small">
                                    <i class="bi bi-star-fill text-warning me-1"></i>
                                    <span>4.6 · 10 people</span>
                                </div>
                                <span class="text-primary">$80/hr</span>
                            </div>
                        </div>
                        
                        <!-- Similar Space 2 -->
                        <div class="d-flex">
                            <img src="../assets/images/80x80.svg" class="rounded me-2" alt="Similar Space">
                            <div>
                                <h6 class="mb-1">Modern Conference Room - Tribeca</h6>
                                <div class="d-flex align-items-center small">
                                    <i class="bi bi-star-fill text-warning me-1"></i>
                                    <span>4.8 · 14 people</span>
                                </div>
                                <span class="text-primary">$95/hr</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Booking Confirmation Modal -->
    <div class="modal fade" id="bookingConfirmModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm Your Booking</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <h6>Modern Conference Room in Downtown</h6>
                        <p class="mb-1"><i class="bi bi-calendar-check"></i> Wednesday, March 12, 2025</p>
                        <p class="mb-1"><i class="bi bi-clock"></i> 9:00 AM - 11:00 AM (2 hours)</p>
                        <p><i class="bi bi-people"></i> How many people will be attending?</p>
                        <select class="form-select mb-3">
                            <option>1-4 people</option>
                            <option>5-8 people</option>
                            <option>9-12 people</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Purpose of meeting</label>
                        <select class="form-select">
                            <option>Team meeting</option>
                            <option>Client presentation</option>
                            <option>Interview</option>
                            <option>Training session</option>
                            <option>Other</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Special requests (optional)</label>
                        <textarea class="form-control" rows="2" placeholder="Any specific setup needs or requirements?"></textarea>
                    </div>
                    <div class="card bg-light mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Payment Summary</h5>
                            <div class="d-flex justify-content-between mb-2">
                                <span>$75 × 2 hours</span>
                                <span>$150</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Cleaning fee</span>
                                <span>$25</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Service fee</span>
                                <span>$15</span>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between fw-bold">
                                <span>Total</span>
                                <span>$190</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" value="" id="termsCheck">
                        <label class="form-check-label" for="termsCheck">
                            I agree to the <a href="#">terms and conditions</a> and <a href="#">cancellation policy</a>
                        </label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary">Confirm & Pay $190</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php require_once "../components/footer.php" ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.min.js" integrity="sha512-ykZ1QQr0Jy/4ZkvKuqWn4iF3lqPZyij9iRv6sGqLRdTPkY69YX6+7wvVGmsdBbiIfN/8OdsI7HABjvEok6ZopQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</body>
</html>