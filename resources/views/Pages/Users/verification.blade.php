@extends('layouts.home.layout')
@section('content')
<div class="max-w-4xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="bg-blue-600 px-6 py-4">
            <h2 class="text-xl font-bold text-white">Host Verification</h2>
        </div>
        
        <div class="px-6 py-8">
            <div class="text-center mb-8">
                <h3 class="text-lg font-medium text-gray-900">We need to verify your identity</h3>
                <p class="mt-2 text-sm text-gray-500">Please upload a valid government-issued ID to complete your host verification.</p>
            </div>

            @if (session('success'))
                <div class="mb-6 bg-green-50 border-l-4 border-green-500 p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-green-700">
                                {{ session('success') }}
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            @if (session('error'))
                <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-red-700">
                                {{ session('error') }}
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            <form action="{{ route('verification.submit') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="mb-6">
                    <label for="id_document" class="block text-sm font-medium text-gray-700">Upload ID Document</label>
                    <div class="mt-1 flex items-center">
                        <label class="w-full flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md cursor-pointer hover:bg-gray-50 @error('id_document') border-red-500 @enderror">
                            <div class="space-y-1 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <svg class="mx-auto h-12 w-12 text-blue-400 transition-all duration-300 group-hover:text-blue-500" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <div class="mt-4 flex flex-col items-center text-sm text-gray-600">
                                        <span class="mb-2 font-medium text-blue-600 hover:text-blue-700 transition-colors">
                                            Select a document to upload
                                        </span>
                                        <input id="id_document" name="id_document" type="file" class="hidden" accept="image/jpeg,image/png,image/jpg,application/pdf" @if(Auth::user()->id_document_path) disabled @endif required>
                                        <p class="text-xs text-gray-500">
                                            JPG, PNG, PDF up to 5MB
                                        </p>
                                    </div>
                                    <div id="file-selected" class="mt-3 hidden">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            <svg class="mr-1.5 h-3 w-3" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                            </svg>
                                            <span id="file-name">No file selected</span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </label>
                    </div>
                    @error('id_document')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-8">
                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input id="consent" name="consent" type="checkbox" class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded @error('consent') border-red-500 @enderror" required>
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="consent" class="font-medium text-gray-700">I confirm that the information provided is accurate and I consent to the processing of my personal data for verification purposes.</label>
                            @error('consent')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div>
                    <button type="submit" class="cursor-pointer w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500" @if(Auth::user()->id_document_path) disabled @endif>
                        Submit Verification
                    </button>
                </div>
            </form>
        </div>
        
        <div class="bg-gray-50 px-6 py-4 flex items-center">
            <svg class="h-5 w-5 text-blue-500 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
            </svg>
            <span class="text-xs text-gray-500">Your personal information is securely encrypted and protected.</span>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const fileInput = document.getElementById('id_document');
        const fileSelected = document.getElementById('file-selected');
        const fileName = document.getElementById('file-name');
        
        fileInput.addEventListener('change', function() {
            if (this.files.length > 0) {
                fileSelected.classList.remove('hidden');
                fileName.textContent = this.files[0].name;
            } else {
                fileSelected.classList.add('hidden');
                fileName.textContent = 'No file selected';
            }
        });
        
        // Make the entire upload area clickable
        document.querySelector('label[for="id_document"]').addEventListener('click', function() {
            if (!fileInput.disabled) {
                fileInput.click();
            }
        });
    });
    </script>
@endsection