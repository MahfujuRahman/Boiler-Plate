@php
    $meta = [
        // "meta" => [],
        'seo' => [
            'title' => 'Professional Trainer Details',
            'image' => asset('seo.jpg'),
        ],
    ];
@endphp


@extends('frontend.layouts.layout', $meta)
@section('contents')
 <!-- trainers area starts -->
 <section class="trainers_area" style="margin-top: 60px;">
    <div class="container"> 
        <div class="trainers_description">
            <div class="trainers_title">
                <h2 class="trainers_title_bangla">{{ $website_about->our_trainers_heading }}</h2>
                {{-- <h2 class="trainers_title_bangla">{{ $website_about->our_trainers_heading }}</h2> --}}
            </div>
            <div class="trainers_details">
                @foreach ($trainers as $trainer)
                <div class="trainer_details">
                    <div class="trainer_images">
                        <div class="image">
                            <img src="{{ $trainer->instructor->photo }}"
                                alt="">
                        </div>
                        <div class="trainer_info">
                            <div class="trainer_name">{{ $trainer->full_name }}</div>
                            <p>{{ $trainer->designation }}</p>
                            <div class="trainer_link">
                                <i class="fa-brands tw fa-square-twitter"></i>
                                <i class="fa-brands fb fa-square-facebook"></i>
                                <i class="fa-brands ld fa-linkedin"></i>
                                <i class="fa-brands in fa-square-instagram"></i>
                            </div>
                        </div>
                    </div>
                    <div class="trainer_descrip">
                        <p>
                            {{ $trainer->short_description }}
                        </p>
                    </div>
                    <div class="profational_trainer_button_area mt-4">
                        <a href="{{ route('teacher.details', ['teacher_name' => str_replace(' ', '-', $trainer->full_name), 'slug' => $trainer->slug ]) }}" class="button_all">
                            <span class="btn_text">বিস্তারিত দেখুন</span>
                            <span class="btn_icon"><i class="fa-solid fa-arrow-right"></i></span>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="mr-paginate">
                {{ $trainers->links() }}
            </div>
        </div>
    </div>
</section>
<!-- /trainers area ends -->
@endsection
