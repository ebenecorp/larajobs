@extends('layouts')


@section('content')
    @include('partials._banner')
    @include('partials._search')
    <div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4">

        @unless(count($listings) == 0)
            @foreach ($listings as $listing)
                <x-listing-card :listing='$listing' />
            @endforeach
        @else
            <p> No Job Lisiting Found</p>
        @endunless
    </div>

@endsection
