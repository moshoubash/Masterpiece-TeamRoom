@extends('layouts.home.layout')

@section('content')
<div class="max-w-5xl mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-2">List Your Space</h1>
    <p class="text-gray-600 mb-8">Share your meeting room, conference space, or workspace with others.</p>
    
    <!-- Progress Bar -->
    <div class="mb-8">
        <div class="flex justify-between mb-2">
            <p class="text-sm">Step <span id="current-step">1</span> of 4</p>
            <p class="text-sm"><span id="completion-percentage">25</span>% Complete</p>
        </div>
        <div class="h-2 w-full bg-gray-200 rounded-full">
            <div id="progress-bar" class="h-2 bg-indigo-700 rounded-full" style="width: 25%"></div>
        </div>
    </div>
    
    <form id="listing-form">
        <!-- Step 1: Basic Information -->
        <div id="step-1" class="step-content bg-white rounded-lg shadow-sm p-8 mb-8">
            <h2 class="text-xl font-bold mb-6">Basic Information</h2>
            
            <div class="mb-6">
                <label for="space_name" class="block text-sm font-medium mb-2">Space Name<span class="text-red-500">*</span></label>
                <input type="text" id="space_name" name="space_name" placeholder="e.g., Executive Meeting Room" class="w-full px-3 py-2 border border-gray-300 rounded-md" required>
            </div>
            
            <div class="mb-6">
                <label for="description" class="block text-sm font-medium mb-2">Description<span class="text-red-500">*</span></label>
                <textarea id="description" name="description" rows="5" placeholder="Describe your space in detail. What makes it special? What amenities does it offer?" class="w-full px-3 py-2 border border-gray-300 rounded-md" required></textarea>
            </div>
            
            <div class="mb-6">
                <label for="location" class="block text-sm font-medium mb-2">Location<span class="text-red-500">*</span></label>
                <input type="text" id="location" name="location" placeholder="Full address of your space" class="w-full px-3 py-2 border border-gray-300 rounded-md" required>
            </div>
            
            <div class="mb-6">
                <label for="room_type" class="block text-sm font-medium mb-2">Room Type<span class="text-red-500">*</span></label>
                <select id="room_type" name="room_type" class="w-full px-3 py-2 border border-gray-300 rounded-md" required>
                    <option value="meeting_room">Meeting Room</option>
                    <option value="conference_room">Conference Room</option>
                    <option value="workspace">Workspace</option>
                    <option value="event_space">Event Space</option>
                </select>
            </div>
            
            <div class="flex justify-end">
                <button type="button" class="bg-indigo-700 text-white px-6 py-2 rounded-md hover:bg-indigo-800 next-step">Continue</button>
            </div>
        </div>

        <!-- Step 2: Placeholder for step 2 (not shown in images) -->
        <div id="step-2" class="step-content bg-white rounded-lg shadow-sm p-8 mb-8 hidden">
            <h2 class="text-xl font-bold mb-6">Availability & Pricing</h2>
            <!-- Add Step 2 form fields here -->
            
            <div class="flex justify-between">
                <button type="button" class="border border-gray-300 text-gray-700 px-6 py-2 rounded-md hover:bg-gray-50 prev-step">Back</button>
                <button type="button" class="bg-indigo-700 text-white px-6 py-2 rounded-md hover:bg-indigo-800 next-step">Continue</button>
            </div>
        </div>
        
        <!-- Step 3: Amenities -->
        <div id="step-3" class="step-content bg-white rounded-lg shadow-sm p-8 mb-8 hidden">
            <h2 class="text-xl font-bold mb-6">Amenities</h2>
            <p class="text-gray-600 mb-6">Select all amenities available in your space.</p>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
                <div class="flex items-center">
                    <input type="checkbox" id="wifi" name="amenities[]" value="wifi" class="h-4 w-4 text-indigo-600">
                    <label for="wifi" class="ml-2 flex items-center">
                        <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071c3.904-3.905 10.236-3.905 14.141 0M1.394 9.393c5.857-5.857 15.355-5.857 21.213 0" />
                        </svg>
                        High-speed Wi-Fi
                    </label>
                </div>
                
                <div class="flex items-center">
                    <input type="checkbox" id="tv" name="amenities[]" value="tv" class="h-4 w-4 text-indigo-600">
                    <label for="tv" class="ml-2 flex items-center">
                        <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        4K Display/TV
                    </label>
                </div>
                
                <!-- Other amenities checkboxes omitted for brevity -->
                <!-- Copy the checkboxes from the previous example -->
            </div>
            
            <div class="flex justify-between">
                <button type="button" class="border border-gray-300 text-gray-700 px-6 py-2 rounded-md hover:bg-gray-50 prev-step">Back</button>
                <button type="button" class="bg-indigo-700 text-white px-6 py-2 rounded-md hover:bg-indigo-800 next-step">Continue</button>
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
                        <svg class="h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                        </svg>
                    </div>
                    <p class="text-sm font-medium">Click to upload or drag and drop</p>
                    <p class="text-xs text-gray-500 mt-1">PNG, JPG, GIF up to 10MB</p>
                </div>
            </div>
            
            <div class="flex justify-between">
                <button type="button" class="border border-gray-300 text-gray-700 px-6 py-2 rounded-md hover:bg-gray-50 prev-step">Back</button>
                <button type="button" class="bg-indigo-700 text-white px-6 py-2 rounded-md hover:bg-indigo-800" id="submit-listing">List My Space</button>
            </div>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Set initial state
        let currentStep = 1;
        const totalSteps = 4;
        
        // Get DOM elements
        const stepElements = document.querySelectorAll('.step-content');
        const nextButtons = document.querySelectorAll('.next-step');
        const prevButtons = document.querySelectorAll('.prev-step');
        const submitButton = document.getElementById('submit-listing');
        const progressBar = document.getElementById('progress-bar');
        const currentStepElement = document.getElementById('current-step');
        const completionPercentageElement = document.getElementById('completion-percentage');
        
        // Add event listeners for next buttons
        nextButtons.forEach(button => {
            button.addEventListener('click', () => {
                // Hide current step
                document.getElementById(`step-${currentStep}`).classList.add('hidden');
                
                // Move to next step
                currentStep++;
                
                // Show new step
                document.getElementById(`step-${currentStep}`).classList.remove('hidden');
                
                // Update progress indicators
                updateProgress();
            });
        });
        
        // Add event listeners for previous buttons
        prevButtons.forEach(button => {
            button.addEventListener('click', () => {
                // Hide current step
                document.getElementById(`step-${currentStep}`).classList.add('hidden');
                
                // Move to previous step
                currentStep--;
                
                // Show new step
                document.getElementById(`step-${currentStep}`).classList.remove('hidden');
                
                // Update progress indicators
                updateProgress();
            });
        });
        
        // Add event listener for submit button
        if (submitButton) {
            submitButton.addEventListener('click', () => {
                // Handle form submission
                document.getElementById('listing-form').submit();
            });
        }
        
        // Function to update progress indicators
        function updateProgress() {
            const completionPercentage = (currentStep / totalSteps) * 100;
            
            // Update displayed step number
            currentStepElement.textContent = currentStep;
            
            // Update percentage text
            completionPercentageElement.textContent = completionPercentage;
            
            // Update progress bar width
            progressBar.style.width = `${completionPercentage}%`;
        }
    });
</script>
@endsection