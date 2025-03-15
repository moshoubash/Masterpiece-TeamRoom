<section class="hero-section" id="hero">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 text-center">
                <h1 class="display-4 fw-bold mb-4">Find the Perfect Meeting Space</h1>
                <p class="lead mb-5">Book professional meeting rooms from local businesses and individuals at competitive rates</p>
                
                <!-- Search Form -->
                <div class="card p-3 shadow mb-5">
                    <form class="row g-3">
                        <div class="col-md-2">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="location" placeholder="Location">
                                <label for="location">Location</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-floating">
                                <input type="date" class="form-control" id="date">
                                <label for="date">Date</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-floating">
                                <input type="time" class="form-control" id="checkin-time">
                                <label for="checkin-time">Check-in Time</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-floating">
                                <input type="time" class="form-control" id="checkout-time">
                                <label for="checkout-time">Check-out Time</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-floating">
                                <select class="form-select" id="capacity">
                                    <option selected>Any</option>
                                    <option value="1-5">1-5 people</option>
                                    <option value="6-10">6-10 people</option>
                                    <option value="11-20">11-20 people</option>
                                    <option value="21+">21+ people</option>
                                </select>
                                <label for="capacity">Capacity</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary h-100 w-100">Search</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>