@extends('layouts.home.layout')
@section('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/openlayers/openlayers.github.io@master/en/v6.15.1/css/ol.css">
    <script src="https://cdn.jsdelivr.net/gh/openlayers/openlayers.github.io@master/en/v6.15.1/build/ol.js"></script>
@endsection
@section('content')
    <div class="max-w-5xl mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-2">List Your Space</h1>
        <p class="text-gray-600 mb-8">Share your meeting room, conference space, or workspace with others.</p>

        <!-- Progress Bar -->
        <div class="mb-8">
            <div class="flex justify-between mb-2">
                <p class="text-sm">Step <span id="current-step">1</span> of 5</p>
                <p class="text-sm"><span id="completion-percentage">20</span>% Complete</p>
            </div>
            <div class="h-2 w-full bg-gray-200 rounded-full">
                <div id="progress-bar" class="h-2 bg-blue-500 rounded-full" style="width: 25%"></div>
            </div>
        </div>

        <form id="listing-form" action="{{ route('rooms.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('POST')

            <!-- Step 1: Basic Information -->
            <div id="step-1" class="step-content bg-white rounded-lg shadow-sm p-8 mb-8">
                <h2 class="text-xl font-bold mb-6">Basic Information</h2>

                <div class="mb-6">
                    <label for="title" class="block text-sm font-medium mb-2">Space Name<span
                            class="text-red-500">*</span></label>
                    <input type="text" id="title" name="title" placeholder="e.g., Executive Meeting Room"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md" required>
                </div>

                <div class="mb-6">
                    <label for="description" class="block text-sm font-medium mb-2">Description<span
                            class="text-red-500">*</span></label>
                    <textarea id="description" name="description" rows="5"
                        placeholder="Describe your space in detail. What makes it special? What amenities does it offer?"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md" required></textarea>
                </div>

                <div class="mb-6">
                    <label for="capacity" class="block text-sm font-medium mb-2">Capacity<span
                            class="text-red-500">*</span></label>
                    <input type="number" id="capacity" name="capacity" placeholder="e.g., 5"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md" min="1" max="100" required>
                </div>

                <div class="mb-6">
                    <label for="hourly_rate" class="block text-sm font-medium mb-2">$ Hourly Rate<span
                            class="text-red-500">*</span></label>
                    <input type="number" id="hourly_rate" name="hourly_rate" placeholder="e.g., 50"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md" min="0" max="100" required>
                </div>

                <div class="mb-6">
                    <label for="min_booking_duration" class="block text-sm font-medium mb-2">Minimum Booking Duration<span
                            class="text-red-500">*</span></label>
                    <input type="number" id="min_booking_duration" name="min_booking_duration" placeholder="e.g., 1 hour"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md">
                </div>

                <div class="mb-6">
                    <label for="max_booking_duration" class="block text-sm font-medium mb-2">Maximum Booking
                        Duration</label>
                    <input type="number" id="max_booking_duration" name="max_booking_duration" placeholder="e.g., 2 hours"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md">
                </div>

                <div class="flex justify-end">
                    <button type="button"
                        class="bg-blue-500 text-white px-6 py-2 rounded-md hover:bg-blue-800 next-step">Continue</button>
                </div>
            </div>

            <!-- Step 2: Placeholder for step 2 (not shown in images) -->
            <div id="step-2" class="step-content bg-white rounded-lg shadow-sm p-8 mb-8 hidden">
                <h2 class="text-xl font-bold mb-6">Availability</h2>
                <!-- Add Step 2 form fields here -->
                @foreach (['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $day)
                    <div class="mb-4">
                        <label class="block font-semibold">{{ $day }}</label>
                        <div class="flex items-center space-x-2 mt-2">
                            <input type="time" name="availability[{{ $day }}][start_time]"
                                class="border rounded p-1" placeholder="Start Time">
                            <input type="time" name="availability[{{ $day }}][end_time]"
                                class="border rounded p-1" placeholder="End Time">
                            <label class="flex items-center">
                                <input type="checkbox" name="availability[{{ $day }}][is_available]"
                                    class="mr-2">
                                Available
                            </label>
                        </div>
                    </div>
                @endforeach
                <div class="flex justify-between">
                    <button type="button"
                        class="border border-gray-300 text-gray-700 px-6 py-2 rounded-md hover:bg-gray-50 prev-step">Back</button>
                    <button type="button"
                        class="bg-blue-500 text-white px-6 py-2 rounded-md hover:bg-blue-800 next-step">Continue</button>
                </div>
            </div>

            <!-- Step 3: Amenities -->
            <div id="step-3" class="step-content bg-white rounded-lg shadow-sm p-8 mb-8 hidden">
                <h2 class="text-xl font-bold mb-6">Amenities</h2>
                <p class="text-gray-600 mb-6">Select all amenities available in your space.</p>

                <div class="grid grid-cols-2 md:grid-cols-2 gap-4 mb-8">
                    @foreach ($amenities as $amenity)
                        <div class="flex items-center">
                            <input type="checkbox" id="{{ $amenity->name }}" name="amenities[]"
                                value="{{ $amenity->id }}" class="h-4 w-4 text-blue-600">

                            <label for="{{ $amenity->name }}" class="ml-2 flex items-center">
                                <i class="h-5 w-5 mr-2 {{ $amenity->icon }}"></i>
                                {{ $amenity->name }}
                            </label>
                        </div>
                    @endforeach
                </div>

                <div class="flex justify-between">
                    <button type="button"
                        class="border border-gray-300 text-gray-700 px-6 py-2 rounded-md hover:bg-gray-50 prev-step">Back</button>
                    <button type="button"
                        class="bg-blue-500 text-white px-6 py-2 rounded-md hover:bg-blue-800 next-step">Continue</button>
                </div>
            </div>

            <!-- Step 4: Photos -->
            <div id="step-4" class="step-content bg-white rounded-lg shadow-sm p-8 mb-8 hidden">
                <h2 class="text-xl font-bold mb-6">Photos</h2>
                <p class="text-gray-600 mb-6">Add photos of your space. The first photo will be used as the main image.</p>

                <div class="mb-6">
                    <label class="block text-sm font-medium mb-2">Upload Photos</label>
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-12 text-center">
                        <div class="flex justify-center mb-4">
                            <svg class="h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                            </svg>
                        </div>
                        <p class="text-sm font-medium">Click to upload or drag and drop</p>
                        <p class="text-xs text-gray-500 mt-1">PNG, JPG, GIF up to 10MB</p>

                        <input type="file" name="images[]" multiple>
                    </div>
                </div>
                <div class="flex justify-between">
                    <button type="button"
                        class="border border-gray-300 text-gray-700 px-6 py-2 rounded-md hover:bg-gray-50 prev-step">Back</button>
                    <button type="button"
                        class="bg-blue-500 text-white px-6 py-2 rounded-md hover:bg-blue-800 next-step">Continue</button>
                </div>
            </div>

            <!-- Step 5 : Address form -->
            <div id="step-5" class="step-content bg-white rounded-lg shadow-sm p-8 mb-8 hidden">
                <h2 class="text-xl font-bold mb-6">Address</h2>
                <div class="mb-6">
                    <label for="country" class="block text-sm font-medium mb-2">Country</label>
                    <select id="country" name="country" class="w-full px-3 py-2 border border-gray-300 rounded-md">
                        <option value="United States" selected>Jordan</option>
                    </select>
                </div>
                <div class="mb-6">
                    <label for="city" class="block text-sm font-medium mb-2">City</label>
                    <input type="text" id="city" name="city"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md">
                </div>
                <div class="mb-6">
                    <label for="street_address" class="block text-sm font-medium mb-2">Street Address</label>
                    <input type="text" id="street_address" name="street_address"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md">
                </div>
                <div class="mb-6">
                    <label for="postal_code" class="block text-sm font-medium mb-2">Postal Code</label>
                    <input type="text" id="postal_code" name="postal_code"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md">
                </div>
                <label class="block text-sm font-medium mb-2">Pick Location on Map</label>
                <div id="map" class="w-full h-64 rounded-lg shadow-md mt-6"></div>
                <input type="hidden" id="latitude" name="latitude">
                <input type="hidden" id="longitude" name="longitude">

                <div class="flex justify-between">
                    <button type="button"
                        class="border border-gray-300 text-gray-700 px-6 py-2 rounded-md hover:bg-gray-50 prev-step">Back</button>
                    <button type="button" class="bg-blue-500 text-white px-6 py-2 rounded-md hover:bg-blue-800"
                        id="submit-listing">List My Space</button>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let currentStep = 1;
            const totalSteps = 5;

            const stepElements = document.querySelectorAll('.step-content');
            const nextButtons = document.querySelectorAll('.next-step');
            const prevButtons = document.querySelectorAll('.prev-step');
            const submitButton = document.getElementById('submit-listing');
            const progressBar = document.getElementById('progress-bar');
            const currentStepElement = document.getElementById('current-step');
            const completionPercentageElement = document.getElementById('completion-percentage');

            nextButtons.forEach(button => {
                button.addEventListener('click', () => {
                    document.getElementById(`step-${currentStep}`).classList.add('hidden');
                    currentStep++;
                    document.getElementById(`step-${currentStep}`).classList.remove('hidden');
                    updateProgress();
                });
            });

            prevButtons.forEach(button => {
                button.addEventListener('click', () => {
                    document.getElementById(`step-${currentStep}`).classList.add('hidden');
                    currentStep--;
                    document.getElementById(`step-${currentStep}`).classList.remove('hidden');
                    updateProgress();
                });
            });

            if (submitButton) {
                submitButton.addEventListener('click', () => {
                    document.getElementById('listing-form').submit();
                });
            }

            function updateProgress() {
                const completionPercentage = (currentStep / totalSteps) * 100;
                currentStepElement.textContent = currentStep;
                completionPercentageElement.textContent = completionPercentage;
                progressBar.style.width = `${completionPercentage}%`;
            }
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const jordanCenter = ol.proj.fromLonLat([35.9106, 31.9539]);

            const map = new ol.Map({
                target: 'map',
                layers: [
                    new ol.layer.Tile({
                        source: new ol.source.OSM()
                    })
                ],
                view: new ol.View({
                    center: jordanCenter,
                    zoom: 8
                }),
                controls: ol.control.defaults().extend([
                    new ol.control.FullScreen(),
                    new ol.control.ScaleLine(),
                    new ol.control.ZoomSlider()
                ])
            });

            const markerLayer = new ol.layer.Vector({
                source: new ol.source.Vector()
            });
            map.addLayer(markerLayer);

            let marker;
            map.on('click', function(e) {
                const coords = e.coordinate;
                const lonLat = ol.proj.toLonLat(coords);

                markerLayer.getSource().clear();

                marker = new ol.Feature({
                    geometry: new ol.geom.Point(coords)
                });

                marker.setStyle(new ol.style.Style({
                    image: new ol.style.Circle({
                        radius: 7,
                        fill: new ol.style.Fill({
                            color: '#3b82f6'
                        }),
                        stroke: new ol.style.Stroke({
                            color: '#ffffff',
                            width: 2
                        })
                    })
                }));

                markerLayer.getSource().addFeature(marker);

                document.getElementById('latitude').value = lonLat[1].toFixed(6);
                document.getElementById('longitude').value = lonLat[0].toFixed(6);

                if (document.getElementById('selected-lat')) {
                    document.getElementById('selected-lat').textContent =
                        `Latitude: ${lonLat[1].toFixed(6)}`;
                    document.getElementById('selected-lng').textContent =
                        `Longitude: ${lonLat[0].toFixed(6)}`;
                }
            });

            const updateMapSize = () => {
                setTimeout(() => {
                    map.updateSize();
                }, 100);
            };

            const steps = document.querySelectorAll('.step-content');
            if (steps) {
                steps.forEach(step => {
                    const observer = new MutationObserver((mutations) => {
                        mutations.forEach((mutation) => {
                            if (mutation.attributeName === 'class' &&
                                !step.classList.contains('hidden') &&
                                step.id === 'step-5') {
                                updateMapSize();
                            }
                        });
                    });

                    observer.observe(step, {
                        attributes: true
                    });
                });
            }
        });
    </script>
@endsection