@php
    $meta = [
        // "meta" => [],
        'seo' => [
            'title' => $teacher->full_name,
            'image' => asset('seo.jpg'),
        ],
    ];
@endphp


@extends('frontend.layouts.layout', $meta)
@section('contents')
    <section class="instructor_details">
        <div class="container">
            <div class="profile_image">
                <div class="profile_cover">
                    <img src="/{{ $teacher->cover_photo }}" alt="">
                </div>
                <div class="profile_bottom">
                    <div class="left">
                        <img src="/{{ $teacher->instructor->photo }}" alt="">
                    </div>
                    <div class="right">
                        <h2 class="teacher_name">{{ $teacher->full_name }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="mt-4">
        <div class="container">
            <div class="mwidth" style="">
                <div>
                    Designation: {{ $teacher->designation }}
                </div>

                <div>
                    Email: {{ $teacher->instructor->email ?? '' }}
                </div>

                <div>
                    Mobile Number: {{ $teacher->instructor->mobile_number ?? '' }}
                </div>

                <div class="details">
                    {!! $teacher->details !!}
                </div>


                <div class="" style="margin-top: 40px;">
                    <strong style="margin-bottom: 50px;">Courses: </strong>
                    <div class="d-flex flex-wrap gap-3">
                        @foreach ($teacher->courses as $course)
                            <div class="card mx-1" style="width: 18rem;">
                                <img class="card-img-top mt-2" height="150" src="/{{ $course->image }}"
                                    alt="card image" style="object-fit: cover;">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $course->title }}</h5>
                                    <p class="card-text">{{ $course->type }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>


            </div>
        </div>

    </section>
@endsection
