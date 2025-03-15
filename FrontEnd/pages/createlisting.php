<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Your Meeting Room | MeetSpace</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="../assets/css/create.css" rel="stylesheet">
</head>
<body>
    <?php require_once "../components/navbar.php" ?>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h1 class="display-6 mb-4">List Your Meeting Room</h1>
                <p class="text-muted mb-4">Complete the steps below to create your listing and start earning.</p>
                
                <div id="progress-bar">
                    <div id="progress-bar-fill" style="width: 20%;"></div>
                </div>
                
                <div class="d-flex justify-content-between mb-4 step-indicators">
                    <div class="step-indicator active" data-step="1">
                        <i class="bi bi-geo-alt-fill"></i> Location
                    </div>
                    <div class="step-indicator" data-step="2">
                        <i class="bi bi-card-text"></i> Details
                    </div>
                    <div class="step-indicator" data-step="3">
                        <i class="bi bi-images"></i> Photos
                    </div>
                    <div class="step-indicator" data-step="4">
                        <i class="bi bi-calendar-check"></i> Availability
                    </div>
                    <div class="step-indicator" data-step="5">
                        <i class="bi bi-eye"></i> Preview
                    </div>
                </div>
                
                <form id="listing-form" class="needs-validation" novalidate>
                    <!-- Step 1: Location -->
                    <div class="form-step active" data-step="1">
                        <div class="card shadow-sm border-0 mb-4">
                            <div class="card-body p-4">
                                <h3 class="card-title h5 mb-3">Where is your meeting room located?</h3>
                                
                                <div class="mb-3">
                                    <label for="address" class="form-label">Street Address</label>
                                    <input type="text" class="form-control" id="address" required>
                                    <div class="invalid-feedback">
                                        Please provide a street address.
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="city" class="form-label">City</label>
                                        <input type="text" class="form-control" id="city" required>
                                        <div class="invalid-feedback">
                                            Please provide a city.
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="state" class="form-label">State/Province</label>
                                        <input type="text" class="form-control" id="state" required>
                                        <div class="invalid-feedback">
                                            Please provide a state or province.
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="postal-code" class="form-label">Postal Code</label>
                                        <input type="text" class="form-control" id="postal-code" required>
                                        <div class="invalid-feedback">
                                            Please provide a postal code.
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="country" class="form-label">Country</label>
                                        <select class="form-select" id="country" required>
                                            <option value="" selected disabled>Select a country</option>
                                            <option value="US">United States</option>
                                            <option value="CA">Canada</option>
                                            <option value="UK">United Kingdom</option>
                                            <option value="AU">Australia</option>
                                            <option value="Other">Other</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Please select a country.
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label">Access Information</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="accessType" id="accessPublic" value="public" checked>
                                        <label class="form-check-label" for="accessPublic">
                                            Public building with reception desk
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="accessType" id="accessKeypad" value="keypad">
                                        <label class="form-check-label" for="accessKeypad">
                                            Keypad/code access
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="accessType" id="accessHost" value="host">
                                        <label class="form-check-label" for="accessHost">
                                            Host will provide access
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-primary px-4 next-step" data-nextstep="2">Continue</button>
                        </div>
                    </div>
                    
                    <!-- Step 2: Details -->
                    <div class="form-step" data-step="2">
                        <div class="card shadow-sm border-0 mb-4">
                            <div class="card-body p-4">
                                <h3 class="card-title h5 mb-3">Tell us about your meeting room</h3>
                                
                                <div class="mb-3">
                                    <label for="title" class="form-label">Listing Title</label>
                                    <input type="text" class="form-control" id="title" placeholder="e.g., Modern Downtown Boardroom" required>
                                    <div class="invalid-feedback">
                                        Please provide a title for your listing.
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control" id="description" rows="4" placeholder="Describe your space, ambiance, and what makes it special..." required></textarea>
                                    <div class="invalid-feedback">
                                        Please provide a description.
                                    </div>
                                    <div class="form-text">
                                        Minimum 100 characters. Be specific about the space, nearby amenities, and any unique features.
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="room-type" class="form-label">Room Type</label>
                                        <select class="form-select" id="room-type" required>
                                            <option value="" selected disabled>Select room type</option>
                                            <option value="boardroom">Boardroom</option>
                                            <option value="conference">Conference Room</option>
                                            <option value="classroom">Classroom</option>
                                            <option value="openspace">Open Space</option>
                                            <option value="lounge">Lounge Area</option>
                                            <option value="private">Private Office</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Please select a room type.
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label for="capacity" class="form-label">Maximum Capacity</label>
                                        <div class="input-group">
                                            <input type="number" class="form-control" id="capacity" min="1" required>
                                            <span class="input-group-text">people</span>
                                            <div class="invalid-feedback">
                                                Please specify the maximum capacity.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label">Amenities</label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="checkbox" id="amenity-wifi">
                                                <label class="form-check-label" for="amenity-wifi">
                                                    <i class="bi bi-wifi me-1"></i> Wi-Fi
                                                </label>
                                            </div>
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="checkbox" id="amenity-projector">
                                                <label class="form-check-label" for="amenity-projector">
                                                    <i class="bi bi-projector me-1"></i> Projector
                                                </label>
                                            </div>
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="checkbox" id="amenity-tv">
                                                <label class="form-check-label" for="amenity-tv">
                                                    <i class="bi bi-tv me-1"></i> TV/Monitor
                                                </label>
                                            </div>
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="checkbox" id="amenity-whiteboard">
                                                <label class="form-check-label" for="amenity-whiteboard">
                                                    <i class="bi bi-easel me-1"></i> Whiteboard
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="checkbox" id="amenity-videoconf">
                                                <label class="form-check-label" for="amenity-videoconf">
                                                    <i class="bi bi-camera-video me-1"></i> Video Conference
                                                </label>
                                            </div>
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="checkbox" id="amenity-catering">
                                                <label class="form-check-label" for="amenity-catering">
                                                    <i class="bi bi-cup-hot me-1"></i> Catering Available
                                                </label>
                                            </div>
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="checkbox" id="amenity-accessible">
                                                <label class="form-check-label" for="amenity-accessible">
                                                    <i class="bi bi-universal-access me-1"></i> Wheelchair Accessible
                                                </label>
                                            </div>
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="checkbox" id="amenity-parking">
                                                <label class="form-check-label" for="amenity-parking">
                                                    <i class="bi bi-p-square me-1"></i> Parking Available
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-0">
                                    <label for="additional-amenities" class="form-label">Additional Amenities</label>
                                    <input type="text" class="form-control" id="additional-amenities" placeholder="e.g., Standing desk, video lights, soundproofing">
                                </div>
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-outline-secondary px-4 prev-step" data-prevstep="1">Back</button>
                            <button type="button" class="btn btn-primary px-4 next-step" data-nextstep="3">Continue</button>
                        </div>
                    </div>
                    
                    <!-- Step 3: Photos -->
                    <div class="form-step" data-step="3">
                        <div class="card shadow-sm border-0 mb-4">
                            <div class="card-body p-4">
                                <h3 class="card-title h5 mb-3">Upload Photos</h3>
                                <p class="text-muted mb-3">High-quality photos increase bookings significantly. Upload at least 3 photos.</p>
                                
                                <div class="mb-4">
                                    <label for="photo-upload" class="form-label">Upload Images</label>
                                    <input class="form-control" type="file" id="photo-upload" multiple accept="image/*" required>
                                    <div class="form-text">
                                        Requirements: JPEG or PNG, minimum 1000x600 pixels, maximum 10MB per file.
                                    </div>
                                    <div class="invalid-feedback">
                                        Please upload at least one photo.
                                    </div>
                                </div>
                                
                                <div id="preview-container" class="row g-3 mb-3">
                                    <!-- Image previews will be added here dynamically -->
                                </div>
                                
                                <div class="alert alert-info mb-0" role="alert">
                                    <i class="bi bi-info-circle me-2"></i>
                                    <strong>Tips:</strong> Include photos of the room from different angles, close-ups of amenities, and the entrance to your building. Make sure your space is tidy and well-lit.
                                </div>
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-outline-secondary px-4 prev-step" data-prevstep="2">Back</button>
                            <button type="button" class="btn btn-primary px-4 next-step" data-nextstep="4">Continue</button>
                        </div>
                    </div>
                    
                    <!-- Step 4: Availability & Pricing -->
                    <div class="form-step" data-step="4">
                        <div class="card shadow-sm border-0 mb-4">
                            <div class="card-body p-4">
                                <h3 class="card-title h5 mb-3">Availability & Pricing</h3>
                                
                                <div class="mb-3">
                                    <label for="base-price" class="form-label">Hourly Rate</label>
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>
                                        <input type="number" class="form-control" id="base-price" min="1" step="1" required>
                                        <span class="input-group-text">/hour</span>
                                    </div>
                                    <div class="invalid-feedback">
                                        Please specify an hourly rate.
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="min-hours" class="form-label">Minimum Booking Duration</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" id="min-hours" min="1" max="8" value="1" required>
                                        <span class="input-group-text">hour(s)</span>
                                    </div>
                                </div>
                                
                                <div class="mb-4">
                                    <label class="form-label">Standard Availability</label>
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Day</th>
                                                    <th>Available</th>
                                                    <th>From</th>
                                                    <th>To</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Monday</td>
                                                    <td>
                                                        <div class="form-check form-switch">
                                                            <input class="form-check-input day-available" type="checkbox" id="monday-available" checked>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <select class="form-select time-select" id="monday-from">
                                                            <option value="08:00">8:00 AM</option>
                                                            <option value="09:00" selected>9:00 AM</option>
                                                            <option value="10:00">10:00 AM</option>
                                                            <option value="11:00">11:00 AM</option>
                                                            <option value="12:00">12:00 PM</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select class="form-select time-select" id="monday-to">
                                                            <option value="16:00">4:00 PM</option>
                                                            <option value="17:00" selected>5:00 PM</option>
                                                            <option value="18:00">6:00 PM</option>
                                                            <option value="19:00">7:00 PM</option>
                                                            <option value="20:00">8:00 PM</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Tuesday</td>
                                                    <td>
                                                        <div class="form-check form-switch">
                                                            <input class="form-check-input day-available" type="checkbox" id="tuesday-available" checked>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <select class="form-select time-select" id="tuesday-from">
                                                            <option value="08:00">8:00 AM</option>
                                                            <option value="09:00" selected>9:00 AM</option>
                                                            <option value="10:00">10:00 AM</option>
                                                            <option value="11:00">11:00 AM</option>
                                                            <option value="12:00">12:00 PM</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select class="form-select time-select" id="tuesday-to">
                                                            <option value="16:00">4:00 PM</option>
                                                            <option value="17:00" selected>5:00 PM</option>
                                                            <option value="18:00">6:00 PM</option>
                                                            <option value="19:00">7:00 PM</option>
                                                            <option value="20:00">8:00 PM</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Wednesday</td>
                                                    <td>
                                                        <div class="form-check form-switch">
                                                            <input class="form-check-input day-available" type="checkbox" id="wednesday-available" checked>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <select class="form-select time-select" id="wednesday-from">
                                                            <option value="08:00">8:00 AM</option>
                                                            <option value="09:00" selected>9:00 AM</option>
                                                            <option value="10:00">10:00 AM</option>
                                                            <option value="11:00">11:00 AM</option>
                                                            <option value="12:00">12:00 PM</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select class="form-select time-select" id="wednesday-to">
                                                            <option value="16:00">4:00 PM</option>
                                                            <option value="17:00" selected>5:00 PM</option>
                                                            <option value="18:00">6:00 PM</option>
                                                            <option value="19:00">7:00 PM</option>
                                                            <option value="20:00">8:00 PM</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Thursday</td>
                                                    <td>
                                                        <div class="form-check form-switch">
                                                            <input class="form-check-input day-available" type="checkbox" id="thursday-available" checked>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <select class="form-select time-select" id="thursday-from">
                                                            <option value="08:00">8:00 AM</option>
                                                            <option value="09:00" selected>9:00 AM</option>
                                                            <option value="10:00">10:00 AM</option>
                                                            <option value="11:00">11:00 AM</option>
                                                            <option value="12:00">12:00 PM</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select class="form-select time-select" id="thursday-to">
                                                            <option value="16:00">4:00 PM</option>
                                                            <option value="17:00" selected>5:00 PM</option>
                                                            <option value="18:00">6:00 PM</option>
                                                            <option value="19:00">7:00 PM</option>
                                                            <option value="20:00">8:00 PM</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Friday</td>
                                                    <td>
                                                        <div class="form-check form-switch">
                                                            <input class="form-check-input day-available" type="checkbox" id="friday-available" checked>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <select class="form-select time-select" id="friday-from">
                                                            <option value="08:00">8:00 AM</option>
                                                            <option value="09:00" selected>9:00 AM</option>
                                                            <option value="10:00">10:00 AM</option>
                                                            <option value="11:00">11:00 AM</option>
                                                            <option value="12:00">12:00 PM</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select class="form-select time-select" id="friday-to">
                                                            <option value="16:00">4:00 PM</option>
                                                            <option value="17:00" selected>5:00 PM</option>
                                                            <option value="18:00">6:00 PM</option>
                                                            <option value="19:00">7:00 PM</option>
                                                            <option value="20:00">8:00 PM</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Saturday</td>
                                                    <td>
                                                        <div class="form-check form-switch">
                                                            <input class="form-check-input day-available" type="checkbox" id="saturday-available">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <select class="form-select time-select" id="saturday-from" disabled>
                                                            <option value="08:00">8:00 AM</option>
                                                            <option value="09:00">9:00 AM</option>
                                                            <option value="10:00" selected>10:00 AM</option>
                                                            <option value="11:00">11:00 AM</option>
                                                            <option value="12:00">12:00 PM</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select class="form-select time-select" id="saturday-to" disabled>
                                                            <option value="14:00">2:00 PM</option>
                                                            <option value="15:00" selected>3:00 PM</option>
                                                            <option value="16:00">4:00 PM</option>
                                                            <option value="17:00">5:00 PM</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Sunday</td>
                                                    <td>
                                                        <div class="form-check form-switch">
                                                            <input class="form-check-input day-available" type="checkbox" id="sunday-available">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <select class="form-select time-select" id="sunday-from" disabled>
                                                            <option value="08:00">8:00 AM</option>
                                                            <option value="09:00">9:00 AM</option>
                                                            <option value="10:00" selected>10:00 AM</option>
                                                            <option value="11:00">11:00 AM</option>
                                                            <option value="12:00">12:00 PM</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select class="form-select time-select" id="sunday-to" disabled>
                                                            <option value="14:00">2:00 PM</option>
                                                            <option value="15:00" selected>3:00 PM</option>
                                                            <option value="16:00">4:00 PM</option>
                                                            <option value="17:00">5:00 PM</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label">Advance Notice</label>
                                    <select class="form-select" id="advance-notice">
                                        <option value="0">No advance notice required</option>
                                        <option value="1" selected>1 hour before</option>
                                        <option value="3">3 hours before</option>
                                        <option value="24">24 hours before</option>
                                        <option value="48">48 hours before</option>
                                    </select>
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label">Cancellation Policy</label>
                                    <select class="form-select" id="cancellation-policy">
                                        <option value="flexible" selected>Flexible (Full refund 24 hours before)</option>
                                        <option value="moderate">Moderate (Full refund 3 days before)</option>
                                        <option value="strict">Strict (50% refund 5 days before)</option>
                                    </select>
                                </div>
                                
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" id="instant-book" checked>
                                    <label class="form-check-label" for="instant-book">
                                        Allow Instant Booking
                                    </label>
                                    <div class="form-text">
                                        Let guests book instantly without requiring your approval.
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-outline-secondary px-4 prev-step" data-prevstep="3">Back</button>
                            <button type="button" class="btn btn-primary px-4 next-step" data-nextstep="5">Continue</button>
                        </div>
                    </div>
                    
                    <!-- Step 5: Preview -->
                    <div class="form-step" data-step="5">
                        <div class="card shadow-sm border-0 mb-4">
                            <div class="card-body p-4">
                                <h3 class="card-title h5 mb-3">Review Your Listing</h3>
                                <p class="text-muted mb-4">Take a moment to review all the information about your space.</p>
                                
                                <div class="preview-container mb-4">
                                    <h4 class="h6 mb-3">Location Information</h4>
                                    <div class="row mb-3">
                                        <div class="col-md-4 text-muted">Address:</div>
                                        <div class="col-md-8" id="preview-address"></div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-4 text-muted">Access Type:</div>
                                        <div class="col-md-8" id="preview-access"></div>
                                    </div>
                                </div>
                                
                                <div class="preview-container mb-4">
                                    <h4 class="h6 mb-3">Room Details</h4>
                                    <div class="row mb-2">
                                        <div class="col-md-4 text-muted">Title:</div>
                                        <div class="col-md-8" id="preview-title"></div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-md-4 text-muted">Room Type:</div>
                                        <div class="col-md-8" id="preview-room-type"></div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-md-4 text-muted">Capacity:</div>
                                        <div class="col-md-8" id="preview-capacity"></div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-4 text-muted">Description:</div>
                                        <div class="col-md-8" id="preview-description"></div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-md-4 text-muted">Amenities:</div>
                                        <div class="col-md-8" id="preview-amenities"></div>
                                    </div>
                                </div>
                                
                                <div class="preview-container mb-4">
                                    <h4 class="h6 mb-3">Photo Gallery</h4>
                                    <div class="row g-3" id="preview-photos">
                                        <!-- Photos will be added here dynamically -->
                                    </div>
                                </div>
                                
                                <div class="preview-container mb-4">
                                    <h4 class="h6 mb-3">Availability & Pricing</h4>
                                    <div class="row mb-2">
                                        <div class="col-md-4 text-muted">Hourly Rate:</div>
                                        <div class="col-md-8" id="preview-price"></div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-md-4 text-muted">Minimum Duration:</div>
                                        <div class="col-md-8" id="preview-min-hours"></div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-md-4 text-muted">Available Days:</div>
                                        <div class="col-md-8" id="preview-available-days"></div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-md-4 text-muted">Cancellation Policy:</div>
                                        <div class="col-md-8" id="preview-cancellation"></div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-md-4 text-muted">Instant Booking:</div>
                                        <div class="col-md-8" id="preview-instant-book"></div>
                                    </div>
                                </div>
                                
                                <div class="alert alert-warning mb-3" role="alert">
                                    <div class="d-flex">
                                        <div class="me-3">
                                            <i class="bi bi-exclamation-triangle-fill fs-4"></i>
                                        </div>
                                        <div>
                                            <h5 class="alert-heading h6">Before You Submit</h5>
                                            <p class="mb-0">
                                                Ensure all information is accurate. After submission, your listing will be reviewed by our team and should go live within 24-48 hours if approved.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" id="terms-agreement" required>
                                    <label class="form-check-label" for="terms-agreement">
                                        I agree to MeetSpace's <a href="#" target="_blank">Terms of Service</a> and <a href="#" target="_blank">Host Agreement</a>
                                    </label>
                                    <div class="invalid-feedback">
                                        You must agree to the terms to continue.
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-outline-secondary px-4 prev-step" data-prevstep="4">Back</button>
                            <button type="submit" class="btn btn-success px-4">Submit Listing</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <?php require_once "../components/footer.php" ?>

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        // Form navigation
        document.querySelectorAll('.next-step').forEach(button => {
            button.addEventListener('click', function() {
                const currentStep = parseInt(this.closest('.form-step').dataset.step);
                const nextStep = parseInt(this.dataset.nextstep);
                
                // Validate current step
                if (validateStep(currentStep)) {
                    // Update progress bar
                    document.getElementById('progress-bar-fill').style.width = (nextStep * 20) + '%';
                    
                    // Hide current step
                    document.querySelector(`.form-step[data-step="${currentStep}"]`).classList.remove('active');
                    
                    // Show next step
                    document.querySelector(`.form-step[data-step="${nextStep}"]`).classList.add('active');
                    
                    // Update step indicators
                    document.querySelectorAll('.step-indicator').forEach(indicator => {
                        indicator.classList.remove('active');
                    });
                    document.querySelector(`.step-indicator[data-step="${nextStep}"]`).classList.add('active');
                    
                    // If last step, populate preview
                    if (nextStep === 5) {
                        populatePreview();
                    }
                    
                    // Scroll to top
                    window.scrollTo(0, 0);
                }
            });
        });
        
        document.querySelectorAll('.prev-step').forEach(button => {
            button.addEventListener('click', function() {
                const currentStep = parseInt(this.closest('.form-step').dataset.step);
                const prevStep = parseInt(this.dataset.prevstep);
                
                // Update progress bar
                document.getElementById('progress-bar-fill').style.width = (prevStep * 20) + '%';
                
                // Hide current step
                document.querySelector(`.form-step[data-step="${currentStep}"]`).classList.remove('active');
                
                // Show previous step
                document.querySelector(`.form-step[data-step="${prevStep}"]`).classList.add('active');
                
                // Update step indicators
                document.querySelectorAll('.step-indicator').forEach(indicator => {
                    indicator.classList.remove('active');
                });
                document.querySelector(`.step-indicator[data-step="${prevStep}"]`).classList.add('active');
                
                // Scroll to top
                window.scrollTo(0, 0);
            });
        });
        
        // Validate each step
        function validateStep(step) {
            let isValid = true;
            const form = document.getElementById('listing-form');
            
            // Get inputs in current step
            const currentStepEl = document.querySelector(`.form-step[data-step="${step}"]`);
            const inputs = currentStepEl.querySelectorAll('input[required], select[required], textarea[required]');
            
            inputs.forEach(input => {
                if (!input.value.trim()) {
                    input.classList.add('is-invalid');
                    isValid = false;
                } else {
                    input.classList.remove('is-invalid');
                }
            });
            
            // Specific validations for each step
            if (step === 1) {
                // Location validation (could add more specific validations here)
            } else if (step === 2) {
                // Details validation
                const description = document.getElementById('description');
                if (description.value.length < 100) {
                    description.classList.add('is-invalid');
                    isValid = false;
                }
            } else if (step === 3) {
                // Photos validation - check if at least one photo is uploaded
                // This is simplified, in production you would check actual files
                const photoUpload = document.getElementById('photo-upload');
                if (photoUpload.files.length === 0) {
                    photoUpload.classList.add('is-invalid');
                    isValid = false;
                }
            }
            
            return isValid;
        }
        
        // Day availability toggles
        document.querySelectorAll('.day-available').forEach(toggle => {
            toggle.addEventListener('change', function() {
                const day = this.id.split('-')[0];
                document.getElementById(`${day}-from`).disabled = !this.checked;
                document.getElementById(`${day}-to`).disabled = !this.checked;
            });
        });
        
        // Photo upload preview
        document.getElementById('photo-upload').addEventListener('change', function() {
            const previewContainer = document.getElementById('preview-container');
            previewContainer.innerHTML = '';
            
            if (this.files) {
                Array.from(this.files).forEach((file, index) => {
                    if (index < 6) { // Limit preview to 6 images
                        const reader = new FileReader();
                        
                        reader.onload = function(e) {
                            const col = document.createElement('div');
                            col.className = 'col-md-4 col-6';
                            
                            const img = document.createElement('img');
                            img.src = e.target.result;
                            img.className = 'preview-image img-fluid w-100';
                            img.alt = 'Room photo';
                            
                            const deleteBtn = document.createElement('button');
                            deleteBtn.className = 'btn btn-sm btn-danger position-absolute top-0 end-0 m-2';
                            deleteBtn.innerHTML = '<i class="bi bi-trash"></i>';
                            deleteBtn.type = 'button';
                            deleteBtn.addEventListener('click', function() {
                                col.remove();
                            });
                            
                            const wrapper = document.createElement('div');
                            wrapper.className = 'position-relative';
                            wrapper.appendChild(img);
                            wrapper.appendChild(deleteBtn);
                            
                            col.appendChild(wrapper);
                            previewContainer.appendChild(col);
                        };
                        
                        reader.readAsDataURL(file);
                    }
                });
            }
        });
        
        // Populate preview data
        function populatePreview() {
            // Location
            const address = `${document.getElementById('address').value}, ${document.getElementById('city').value}, ${document.getElementById('state').value} ${document.getElementById('postal-code').value}`;
            document.getElementById('preview-address').textContent = address;
            
            const accessType = document.querySelector('input[name="accessType"]:checked');
            let accessText = '';
            if (accessType.value === 'public') accessText = 'Public building with reception desk';
            else if (accessType.value === 'keypad') accessText = 'Keypad/code access';
            else if (accessType.value === 'host') accessText = 'Host will provide access';
            document.getElementById('preview-access').textContent = accessText;
            
            // Details
            document.getElementById('preview-title').textContent = document.getElementById('title').value;
            
            const roomTypeSelect = document.getElementById('room-type');
            const roomTypeOption = roomTypeSelect.options[roomTypeSelect.selectedIndex];
            document.getElementById('preview-room-type').textContent = roomTypeOption.text;
            
            document.getElementById('preview-capacity').textContent = document.getElementById('capacity').value + ' people';
            document.getElementById('preview-description').textContent = document.getElementById('description').value;
            
            // Amenities
            const amenities = [];
            document.querySelectorAll('input[id^="amenity-"]:checked').forEach(checkbox => {
                amenities.push(checkbox.nextElementSibling.textContent.trim());
            });
            document.getElementById('preview-amenities').textContent = amenities.join(', ') || 'None selected';
            
            // Photos - duplicate the current preview images
            const previewPhotos = document.getElementById('preview-photos');
            previewPhotos.innerHTML = '';
            document.querySelectorAll('#preview-container .preview-image').forEach(img => {
                const col = document.createElement('div');
                col.className = 'col-md-3 col-6';
                
                const newImg = document.createElement('img');
                newImg.src = img.src;
                newImg.className = 'preview-image img-fluid w-100';
                newImg.alt = 'Room photo';
                
                col.appendChild(newImg);
                previewPhotos.appendChild(col);
            });
            
            // Pricing & Availability
            document.getElementById('preview-price').textContent = `$${document.getElementById('base-price').value} per hour`;
            document.getElementById('preview-min-hours').textContent = `${document.getElementById('min-hours').value} hour(s)`;
            
            const availableDays = [];
            document.querySelectorAll('.day-available:checked').forEach(day => {
                const dayName = day.id.split('-')[0];
                availableDays.push(dayName.charAt(0).toUpperCase() + dayName.slice(1));
            });
            document.getElementById('preview-available-days').textContent = availableDays.join(', ') || 'None selected';
            
            const cancellationSelect = document.getElementById('cancellation-policy');
            const cancellationOption = cancellationSelect.options[cancellationSelect.selectedIndex];
            document.getElementById('preview-cancellation').textContent = cancellationOption.text;
            
            document.getElementById('preview-instant-book').textContent = document.getElementById('instant-book').checked ? 'Yes' : 'No';
        }
        
        // Form submission
        document.getElementById('listing-form').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Validate the final step
            if (validateStep(5)) {
                // In a real application, you would submit the form data here
                // For demo purposes, we'll just show a success message
                alert('Your listing has been submitted for review!');
                
                // Redirect to dashboard or another page
                // window.location.href = 'dashboard.html';
            }
        });
    </script>
</body>
</html>