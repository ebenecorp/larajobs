@extends('layouts')

@section('content')
    <x-card class="p-10  max-w-lg mx-auto mt-24">
        <header class="text-center">
            <h2 class="text-2xl font-bold uppercase mb-1">

                {{ $listing ? 'Update Listing' : 'Create Listing' }}

            </h2>
            <p class="mb-4">Post a gig to find a developer</p>
        </header>

        <form method="POST" action="{{ $listing ? route('listing.update', $listing->id) : route('listing.store') }}"
            enctype="multipart/form-data">
            @csrf
            @if ($listing)
                @method('PUT')
            @endif


            <div class="mb-6">
                <label for="company" class="inline-block text-lg mb-2">Company Name</label>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="company"
                    value="{{ $listing ? $listing->company : old('company') }}" />
                @error('company')
                    <p class="text-red-500 text-ms mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="title" class="inline-block text-lg mb-2">Job Title</label>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="title"
                    placeholder="Example: Senior Laravel Developer" value="{{ $listing ? $listing->title : old('title') }}" />
                @error('title')
                    <p class="text-red-500 text-ms mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="location" class="inline-block text-lg mb-2">Job Location</label>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="location"
                    placeholder="Example: Remote, Boston MA, etc"
                    value="{{ $listing ? $listing->location : old('location') }}" />
                @error('location')
                    <p class="text-red-500 text-ms mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="email" class="inline-block text-lg mb-2">Contact Email</label>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="email"
                    value="{{ $listing ? $listing->email : old('email') }}" />
                @error('email')
                    <p class="text-red-500 text-ms mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="website" class="inline-block text-lg mb-2">
                    Website/Application URL
                </label>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="website"
                    value="{{ $listing ? $listing->website : old('website') }}" />
                @error('website')
                    <p class="text-red-500 text-ms mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="tags" class="inline-block text-lg mb-2">
                    Tags (Comma Separated)
                </label>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="tags"
                    placeholder="Example: Laravel, Backend, Postgres, etc"
                    value="{{ $listing ? $listing->tags : old('tags') }}" />
                @error('tags')
                    <p class="text-red-500 text-ms mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="logo" class="inline-block text-lg mb-2">
                    Company Logo
                </label>
                <input type="file" class="border border-gray-200 rounded p-2 w-full" name="logo" />

                @error('logo')
                    <p class="text-red-500 text-ms mt-1">{{ $message }}</p>
                @enderror
                @if ($listing)
                    <img class="w-48 mr-6 mb-6"
                        src="{{ $listing->path ? asset('storage/' . $listing->path) : asset('images/no-image.png') }}"
                        alt="" />
                @endif

            </div>

            <div class="mb-6">
                <label for="description" class="inline-block text-lg mb-2">
                    Job Description
                </label>
                <textarea class="border border-gray-200 rounded p-2 w-full" name="description" rows="10"
                    placeholder="Include tasks, requirements, salary, etc">
                    {{ $listing ? $listing->description : old('description') }}
                </textarea>
                @error('description')
                    <p class="text-red-500 text-ms mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <button class="bg-laravel text-white rounded py-2 px-4 hover:bg-black">
                    {{ $listing ? 'Update Job' : 'Create Listing' }}
                </button>
            </div>
        </form>
    </x-card>
@endsection
