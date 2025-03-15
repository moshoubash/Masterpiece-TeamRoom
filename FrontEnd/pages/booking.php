<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Page</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h3 class="mb-0">Book Your Experience</h3>
                    </div>
                    <div class="card-body">
                        <form id="bookingForm">
                            <!-- Date and Time Selection -->
                            <div class="row mb-4">
                                <div class="col-md-6 mb-3 mb-md-0">
                                    <label for="bookingDate" class="form-label">Select Date</label>
                                    <input type="date" class="form-control" id="bookingDate" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="bookingTime" class="form-label">Select Time</label>
                                    <select class="form-select" id="bookingTime" required>
                                        <option value="" selected disabled>Choose a time</option>
                                        <option value="09:00">9:00 AM</option>
                                        <option value="10:00">10:00 AM</option>
                                        <option value="11:00">11:00 AM</option>
                                        <option value="13:00">1:00 PM</option>
                                        <option value="14:00">2:00 PM</option>
                                        <option value="15:00">3:00 PM</option>
                                        <option value="16:00">4:00 PM</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Number of Guests -->
                            <div class="mb-4">
                                <label for="guests" class="form-label">Number of Guests</label>
                                <select class="form-select" id="guests" required onchange="updateCost()">
                                    <option value="1">1 Guest</option>
                                    <option value="2" selected>2 Guests</option>
                                    <option value="3">3 Guests</option>
                                    <option value="4">4 Guests</option>
                                    <option value="5">5 Guests</option>
                                </select>
                            </div>

                            <!-- Message Host Option -->
                            <div class="mb-4">
                                <label for="hostMessage" class="form-label">Message to Host (Optional)</label>
                                <textarea class="form-control" id="hostMessage" rows="3" placeholder="Any special requests or questions?"></textarea>
                            </div>

                            <!-- Cost Breakdown -->
                            <div class="card mb-4 bg-light">
                                <div class="card-body">
                                    <h5 class="card-title">Cost Breakdown</h5>
                                    <div class="d-flex justify-content-between mb-2">
                                        <span>Base Price ($49 per guest)</span>
                                        <span id="basePrice">$98.00</span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-2">
                                        <span>Service Fee</span>
                                        <span id="serviceFee">$9.80</span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-2">
                                        <span>Tax</span>
                                        <span id="tax">$8.82</span>
                                    </div>
                                    <hr>
                                    <div class="d-flex justify-content-between fw-bold">
                                        <span>Total</span>
                                        <span id="totalPrice">$116.62</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Payment Information -->
                            <div class="mb-4">
                                <h5>Payment Information</h5>
                                <div class="mb-3">
                                    <label for="cardName" class="form-label">Name on Card</label>
                                    <input type="text" class="form-control" id="cardName" required>
                                </div>
                                <div class="mb-3">
                                    <label for="cardNumber" class="form-label">Card Number</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="cardNumber" placeholder="1234 5678 9012 3456" required>
                                        <span class="input-group-text">
                                            <i class="bi bi-credit-card"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="expiryDate" class="form-label">Expiry Date</label>
                                        <input type="text" class="form-control" id="expiryDate" placeholder="MM/YY" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="cvv" class="form-label">CVV</label>
                                        <input type="text" class="form-control" id="cvv" required>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="d-flex gap-2 align-items-start mt-3">
                                        <div class="mt-1">
                                            <img src="../assets/images/50x30.svg" alt="Visa" />
                                        </div>
                                        <div class="mt-1">
                                            <img src="../assets/images/50x30.svg" alt="Mastercard" />
                                        </div>
                                        <div class="mt-1">
                                            <img src="../assets/images/50x30.svg" alt="American Express" />
                                        </div>
                                        <div class="mt-1">
                                            <img src="../assets/images/50x30.svg" alt="PayPal" />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Terms and Cancellation Policy -->
                            <div class="mb-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="termsCheck" required>
                                    <label class="form-check-label" for="termsCheck">
                                        I agree to the <a href="#" data-bs-toggle="modal" data-bs-target="#termsModal">Terms and Conditions</a> and <a href="#" data-bs-toggle="modal" data-bs-target="#cancellationModal">Cancellation Policy</a>
                                    </label>
                                </div>
                            </div>

                            <!-- Book Now Button -->
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-lg">Book Now</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Terms Modal -->
    <div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="termsModalLabel">Terms and Conditions</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>By making a booking, you agree to the following terms:</p>
                    <ul>
                        <li>Full payment is required at the time of booking.</li>
                        <li>Valid identification must be presented upon arrival.</li>
                        <li>The host reserves the right to refuse service to anyone.</li>
                        <li>Guests are responsible for any damages caused during their experience.</li>
                        <li>Host is not liable for any personal injuries or loss of property.</li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Cancellation Modal -->
    <div class="modal fade" id="cancellationModal" tabindex="-1" aria-labelledby="cancellationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cancellationModalLabel">Cancellation Policy</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Our cancellation policy is as follows:</p>
                    <ul>
                        <li>Full refund if cancelled 7+ days before the scheduled date</li>
                        <li>50% refund if cancelled 3-6 days before the scheduled date</li>
                        <li>No refund if cancelled less than 72 hours before the scheduled date</li>
                        <li>Rescheduling is possible with at least 48 hours notice, subject to availability</li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Booking Confirmation Modal -->
    <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="confirmationModalLabel">Booking Confirmed!</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center mb-4">
                        <i class="bi bi-check-circle text-success" style="font-size: 3rem;"></i>
                    </div>
                    <h4 class="text-center mb-4">Thank you for your booking!</h4>
                    <div id="confirmationDetails">
                        <p><strong>Date:</strong> <span id="confirmDate"></span></p>
                        <p><strong>Time:</strong> <span id="confirmTime"></span></p>
                        <p><strong>Guests:</strong> <span id="confirmGuests"></span></p>
                        <p><strong>Total:</strong> <span id="confirmTotal"></span></p>
                    </div>
                    <p class="mt-4">A confirmation email has been sent to your email address with all the details.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

    <script>
        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            updateCost();
            
            // Set min date to today
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('bookingDate').min = today;
            
            // Form submission
            document.getElementById('bookingForm').addEventListener('submit', function(e) {
                e.preventDefault();
                
                // In a real application, here you would send the payment information to your backend
                // which would then communicate with the payment gateway (Stripe, PayPal, etc.)
                
                // For demo purposes, just show the confirmation modal
                document.getElementById('confirmDate').textContent = document.getElementById('bookingDate').value;
                document.getElementById('confirmTime').textContent = document.getElementById('bookingTime').value;
                document.getElementById('confirmGuests').textContent = document.getElementById('guests').value;
                document.getElementById('confirmTotal').textContent = document.getElementById('totalPrice').textContent;
                
                const confirmationModal = new bootstrap.Modal(document.getElementById('confirmationModal'));
                confirmationModal.show();
            });
        });
        
        // Update cost based on number of guests
        function updateCost() {
            const basePrice = 49;
            const guests = parseInt(document.getElementById('guests').value);
            
            const baseCost = basePrice * guests;
            const serviceFee = baseCost * 0.10;
            const tax = (baseCost + serviceFee) * 0.08;
            const total = baseCost + serviceFee + tax;
            
            document.getElementById('basePrice').textContent = '$' + baseCost.toFixed(2);
            document.getElementById('serviceFee').textContent = '$' + serviceFee.toFixed(2);
            document.getElementById('tax').textContent = '$' + tax.toFixed(2);
            document.getElementById('totalPrice').textContent = '$' + total.toFixed(2);
        }
    </script>
</body>
</html>