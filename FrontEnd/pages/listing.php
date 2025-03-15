<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MeetSpace - Find Your Perfect Meeting Room</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/listing.css">
</head>
<body>
    <!-- Navbar -->
    <?php require_once "../components/navbar.php" ?>

    <!-- Search Hero Section -->
    <div class="bg-light py-4">
        <div class="container">
            <h1 class="display-5 mb-4">Find the perfect meeting space</h1>
            
            <!-- Main Search Form -->
            <form id="search-form" class="row g-3 mb-3">
                <div class="col-md-4">
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-geo-alt"></i></span>
                        <input type="text" class="form-control" id="location" placeholder="Location">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-calendar"></i></span>
                        <input type="date" class="form-control" id="date">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-people"></i></span>
                        <select class="form-select" id="capacity">
                            <option value="">Capacity</option>
                            <option value="1-4">1-4 people</option>
                            <option value="5-10">5-10 people</option>
                            <option value="11-20">11-20 people</option>
                            <option value="21+">21+ people</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100"><i class="bi bi-search me-1"></i> Search</button>
                </div>
            </form>

            <!-- Mobile Filter Toggle -->
            <div class="d-md-none mb-3">
                <button class="btn btn-outline-secondary w-100" id="filter-toggle">
                    <i class="bi bi-funnel me-1"></i> Filters
                </button>
            </div>

            <!-- Advanced Filters Section -->
            <div class="filters-section d-md-block mb-3" id="filters-section">
                <div class="card">
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-3">
                                <label class="form-label">Price Range</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="number" class="form-control" placeholder="Min">
                                    <span class="input-group-text">-</span>
                                    <input type="number" class="form-control" placeholder="Max">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Distance</label>
                                <select class="form-select">
                                    <option value="">Any distance</option>
                                    <option value="1">Within 1 mile</option>
                                    <option value="5">Within 5 miles</option>
                                    <option value="10">Within 10 miles</option>
                                    <option value="25">Within 25 miles</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Rating</label>
                                <select class="form-select">
                                    <option value="">Any rating</option>
                                    <option value="4">4+ Stars</option>
                                    <option value="3">3+ Stars</option>
                                    <option value="2">2+ Stars</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Amenities</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="wifi">
                                    <label class="form-check-label" for="wifi">WiFi</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="projector">
                                    <label class="form-check-label" for="projector">Projector</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="whiteboard">
                                    <label class="form-check-label" for="whiteboard">Whiteboard</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Results Section -->
    <div class="container py-4">
        <!-- Results Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="h4 mb-0">24 meeting spaces found</h2>
                <p class="text-muted mb-0">in San Francisco, CA</p>
            </div>
            <div class="d-flex gap-2">
                <div class="dropdown">
                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="sortDropdown" data-bs-toggle="dropdown">
                        Sort by: Recommended
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="sortDropdown">
                        <li><a class="dropdown-item active" href="#">Recommended</a></li>
                        <li><a class="dropdown-item" href="#">Price: Low to High</a></li>
                        <li><a class="dropdown-item" href="#">Price: High to Low</a></li>
                        <li><a class="dropdown-item" href="#">Rating: High to Low</a></li>
                        <li><a class="dropdown-item" href="#">Distance: Closest</a></li>
                    </ul>
                </div>
                <div class="btn-group view-toggle" role="group">
                    <button type="button" class="btn btn-outline-secondary active" id="grid-view-btn">
                        <i class="bi bi-grid-3x3-gap"></i>
                    </button>
                    <button type="button" class="btn btn-outline-secondary" id="list-view-btn">
                        <i class="bi bi-list"></i>
                    </button>
                    <button type="button" class="btn btn-outline-secondary" id="map-view-btn">
                        <i class="bi bi-map"></i>
                    </button>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Results Column -->
            <div class="col-lg-7" id="listings-container">
                <div class="row row-cols-1 row-cols-md-2 g-4" id="results-grid">
                    <!-- Listing 1 -->
                    <div class="col">
                        <div class="card listing-card h-100">
                            <div class="position-relative">
                                <img src="../assets/images/400x250.svg" class="card-img-top" alt="Conference Room">
                            </div>
                            <div class="card-body">
                                <span class="capacity-badge"><i class="bi bi-people-fill me-1"></i>10</span>
                                <h5 class="card-title">Modern Conference Room</h5>
                                <p class="card-text text-muted"><i class="bi bi-geo-alt me-1"></i>Financial District, 0.5 miles away</p>
                                <div class="d-flex align-items-center mb-2">
                                    <div class="rating me-2">
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-half"></i>
                                    </div>
                                    <span>4.5 (23 reviews)</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="small text-muted">
                                        <i class="bi bi-wifi me-1"></i>
                                        <i class="bi bi-projector me-1"></i>
                                        <i class="bi bi-clipboard"></i>
                                    </div>
                                    <div class="fw-bold">$75/hour</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Listing 2 -->
                    <div class="col">
                        <div class="card listing-card h-100">
                            <div class="position-relative">
                                <img src="../assets/images/400x250.svg" class="card-img-top" alt="Board Room">
                            </div>
                            <div class="card-body">
                                <span class="capacity-badge"><i class="bi bi-people-fill me-1"></i>16</span>
                                <h5 class="card-title">Executive Board Room</h5>
                                <p class="card-text text-muted"><i class="bi bi-geo-alt me-1"></i>SOMA, 1.2 miles away</p>
                                <div class="d-flex align-items-center mb-2">
                                    <div class="rating me-2">
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star"></i>
                                    </div>
                                    <span>4.0 (17 reviews)</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="small text-muted">
                                        <i class="bi bi-wifi me-1"></i>
                                        <i class="bi bi-projector me-1"></i>
                                        <i class="bi bi-clipboard me-1"></i>
                                        <i class="bi bi-camera-video"></i>
                                    </div>
                                    <div class="fw-bold">$120/hour</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Listing 3 -->
                    <div class="col">
                        <div class="card listing-card h-100">
                            <div class="position-relative">
                                <img src="../assets/images/400x250.svg" class="card-img-top" alt="Creative Space">
                            </div>
                            <div class="card-body">
                                <span class="capacity-badge"><i class="bi bi-people-fill me-1"></i>8</span>
                                <h5 class="card-title">Creative Meeting Space</h5>
                                <p class="card-text text-muted"><i class="bi bi-geo-alt me-1"></i>Mission District, 2.4 miles away</p>
                                <div class="d-flex align-items-center mb-2">
                                    <div class="rating me-2">
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                    </div>
                                    <span>5.0 (9 reviews)</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="small text-muted">
                                        <i class="bi bi-wifi me-1"></i>
                                        <i class="bi bi-clipboard"></i>
                                    </div>
                                    <div class="fw-bold">$60/hour</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Listing 4 -->
                    <div class="col">
                        <div class="card listing-card h-100">
                            <div class="position-relative">
                                <img src="../assets/images/400x250.svg" class="card-img-top" alt="Coworking Space">
                            </div>
                            <div class="card-body">
                                <span class="capacity-badge"><i class="bi bi-people-fill me-1"></i>4</span>
                                <h5 class="card-title">Coworking Meeting Pod</h5>
                                <p class="card-text text-muted"><i class="bi bi-geo-alt me-1"></i>Embarcadero, 0.7 miles away</p>
                                <div class="d-flex align-items-center mb-2">
                                    <div class="rating me-2">
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star"></i>
                                        <i class="bi bi-star"></i>
                                    </div>
                                    <span>3.0 (12 reviews)</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="small text-muted">
                                        <i class="bi bi-wifi me-1"></i>
                                    </div>
                                    <div class="fw-bold">$35/hour</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Listing 5 -->
                    <div class="col">
                        <div class="card listing-card h-100">
                            <div class="position-relative">
                                <img src="../assets/images/400x250.svg" class="card-img-top" alt="Luxury Conference Room">
                            </div>
                            <div class="card-body">
                                <span class="capacity-badge"><i class="bi bi-people-fill me-1"></i>25</span>
                                <h5 class="card-title">Luxury Conference Center</h5>
                                <p class="card-text text-muted"><i class="bi bi-geo-alt me-1"></i>Nob Hill, 1.8 miles away</p>
                                <div class="d-flex align-items-center mb-2">
                                    <div class="rating me-2">
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-half"></i>
                                    </div>
                                    <span>4.7 (31 reviews)</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="small text-muted">
                                        <i class="bi bi-wifi me-1"></i>
                                        <i class="bi bi-projector me-1"></i>
                                        <i class="bi bi-clipboard me-1"></i>
                                        <i class="bi bi-camera-video"></i>
                                    </div>
                                    <div class="fw-bold">$250/hour</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Listing 6 -->
                    <div class="col">
                        <div class="card listing-card h-100">
                            <div class="position-relative">
                                <img src="../assets/images/400x250.svg" class="card-img-top" alt="Studio Space">
                            </div>
                            <div class="card-body">
                                <span class="capacity-badge"><i class="bi bi-people-fill me-1"></i>12</span>
                                <h5 class="card-title">Creative Studio Space</h5>
                                <p class="card-text text-muted"><i class="bi bi-geo-alt me-1"></i>Dogpatch, 3.1 miles away</p>
                                <div class="d-flex align-items-center mb-2">
                                    <div class="rating me-2">
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star"></i>
                                    </div>
                                    <span>4.2 (15 reviews)</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="small text-muted">
                                        <i class="bi bi-wifi me-1"></i>
                                        <i class="bi bi-clipboard"></i>
                                    </div>
                                    <div class="fw-bold">$95/hour</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Pagination -->
                <nav class="mt-4" aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
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
            
            <!-- Map Column -->
            <div class="col-lg-5 d-none d-lg-block" id="map-container">
                <div class="sticky-top pt-4" style="top: 1rem; z-index: 1000;">
                    <div class="card">
                        <div class="card-body p-0">
                            <div id="map">
                                <!-- Placeholder for the map -->
                                <img src="../assets/images/600x600.svg" class="img-fluid" alt="Map">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php require_once "../components/footer.php"?>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- JavaScript for the page functionality -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Filter toggle for mobile
            const filterToggle = document.getElementById('filter-toggle');
            const filtersSection = document.getElementById('filters-section');
            
            filterToggle.addEventListener('click', function() {
                filtersSection.classList.toggle('show');
            });
            
            // View toggle functionality
            const gridViewBtn = document.getElementById('grid-view-btn');
            const listViewBtn = document.getElementById('list-view-btn');
            const mapViewBtn = document.getElementById('map-view-btn');
            const resultsGrid = document.getElementById('results-grid');
            const listingsContainer = document.getElementById('listings-container');
            const mapContainer = document.getElementById('map-container');
            
            gridViewBtn.addEventListener('click', function() {
                gridViewBtn.classList.add('active');
                listViewBtn.classList.remove('active');
                mapViewBtn.classList.remove('active');
                
                resultsGrid.classList.remove('row-cols-1');
                resultsGrid.classList.add('row-cols-md-2');
                listingsContainer.classList.remove('col-lg-12');
                listingsContainer.classList.add('col-lg-7');
                mapContainer.classList.remove('d-none');
                mapContainer.classList.add('d-lg-block');
            });
            
            listViewBtn.addEventListener('click', function() {
                listViewBtn.classList.add('active');
                gridViewBtn.classList.remove('active');
                mapViewBtn.classList.remove('active');
                
                resultsGrid.classList.add('row-cols-1');
                resultsGrid.classList.remove('row-cols-md-2');
                listingsContainer.classList.remove('col-lg-12');
                listingsContainer.classList.add('col-lg-7');
                mapContainer.classList.remove('d-none');
                mapContainer.classList.add('d-lg-block');
            });
            
            mapViewBtn.addEventListener('click', function() {
                mapViewBtn.classList.add('active');
                gridViewBtn.classList.remove('active');
                listViewBtn.classList.remove('active');
                
                listingsContainer.classList.remove('col-lg-7');
                listingsContainer.classList.add('col-lg-12');
                mapContainer.classList.add('d-none');
                mapContainer.classList.remove('d-lg-block');
            });
        });
    </script>
</body>
</html>