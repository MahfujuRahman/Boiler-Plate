@php
    $meta = [
        'seo' => [
            'title' => 'courses',
            'image' => asset('seo.jpg'),
        ],
    ];
@endphp
@extends('frontend.layouts.layout', $meta)
@section('contents')
    <section class="our_course_area">
        <div class="container">
            <div class="our_course_area_content" id="our_course_types">

                <!-- our_course_area_title start -->
                <div class="our_course_area_title">
                    <h2 class="area_title">
                        আমাদের কোর্সসমূহ
                    </h2>
                </div>
                <!-- our_course_area_title end -->

                <!-- course_schedule_name start-->
                <div class="course_schedule_name">
                    <ul>
                        <li class="course_type_active">
                            <a href="{{ route('courses') }}">সকল কোর্স</a>
                        </li>
                        <li class="course_type_active">
                            @foreach ($course_types as $index => $item)
                                <a href="{{ route('courses', ['slug' => $item->id]) }}"
                                    @if ($index > 0) class="ms-5" @endif>
                                    {{ $item->title }}
                                </a>
                            @endforeach
                        </li>
                    </ul>
                </div>
                <!-- course_schedule_name end-->

                <div class="our_course_all_card">

                    @foreach ($courses as $course)
                        <div class="c_card graphic_designer">
                            <!-- card_img start -->
                            <a href="{{ route('course_details', $course->slug) }}" class="card_img_area">
                                <div class="card_img">
                                    <img src="{{ $course->image }}" alt="graphic_designer, tech park it" />
                                </div>
                            </a>
                            <!-- card_img end -->

                            <!-- card_title_area start -->
                            <div class="card_title_area">
                                <!-- card_title start -->
                                <a href="{{ route('course_details', $course->slug) }}" class="card_title">
                                    <p class="title_text">{{ $course->title }}</p>
                                </a>
                                <!-- card_title end -->

                                <div>
                                    <!-- day_and_boking_area start -->
                                    <div class="day_and_boking_area">
                                        <div class="day_area">
                                            <span class="day_icon">
                                                <img src="{{ asset('frontend') }}/assets/images/home_page_image/our_course_area/clock.png"
                                                    alt="clock, tech park it" />
                                            </span>
                                            @php
                                                $courseBatch = $courseBatches->where('course_id', $course->id)->first();
                                                $admissionEndDate = $courseBatch->admission_end_date ?? null;
                                            @endphp

                                            <span class="day_tex">
                                                @if ($admissionEndDate)
                                                    @php
                                                        $admissionEndDate = Carbon\Carbon::parse($admissionEndDate);
                                                        $now = Carbon\Carbon::now();

                                                        if ($now->greaterThanOrEqualTo($admissionEndDate)) {
                                                            $remainingTime =
                                                                App\Helpers\ConvertHelper::convertToBanglaNumbers(0) .
                                                                ' দিন';
                                                        } else {
                                                            $diffInDays = $admissionEndDate->diffInDays($now);
                                                            $diffInHours = $admissionEndDate->diffInHours($now) % 24;
                                                            $diffInMinutes =
                                                                $admissionEndDate->diffInMinutes($now) % 60;

                                                            if ($diffInDays > 0) {
                                                                $remainingTime =
                                                                    App\Helpers\ConvertHelper::convertToBanglaNumbers(
                                                                        $diffInDays,
                                                                    ) . ' দিন';
                                                            } elseif ($diffInHours > 0) {
                                                                $remainingTime =
                                                                    App\Helpers\ConvertHelper::convertToBanglaNumbers(
                                                                        $diffInHours,
                                                                    ) . ' ঘণ্টা';
                                                            } else {
                                                                $remainingTime =
                                                                    App\Helpers\ConvertHelper::convertToBanglaNumbers(
                                                                        $diffInMinutes,
                                                                    ) . ' মিনিট';
                                                            }
                                                        }
                                                    @endphp
                                                    {{ $remainingTime }} বাকী
                                                @else
                                                    {{ App\Helpers\ConvertHelper::convertToBanglaNumbers(0) }} দিন বাকী
                                                @endif
                                            </span>


                                        </div>
                                        <div class="boking_area">
                                            <span class="boking_text">
                                                {{ App\Helpers\ConvertHelper::convertToBanglaNumbers($courseBatch->booked_percent ?? 0) }}
                                                %
                                            </span>
                                            <span class="boking_text">
                                                বুকড
                                            </span>
                                        </div>
                                    </div>
                                    <!-- day_and_boking_area end -->

                                    <!-- amount_and_button_area start -->
                                    <div class="amount_and_button_area">
                                        <!-- all_amount area start -->
                                        <div class="all_amount">
                                            <div class="previous_amount_area">
                                                <p class="previous_amount">
                                                    <span class="taka"> ৳ </span>
                                                    <span class="taka">
                                                        {{ App\Helpers\ConvertHelper::convertToBanglaNumbers(number_format($courseBatch->course_price ?? 0, 0, '.', ',')) }}
                                                    </span>
                                                </p>
                                            </div>
                                            <div class="current_amount_area">
                                                <p class="current_amount">
                                                    <span class="taka"> ৳ </span>
                                                    <span class="taka">
                                                        {{ App\Helpers\ConvertHelper::convertToBanglaNumbers(number_format($courseBatch->after_discount_price ?? 0, 0, '.', ',')) }}
                                                    </span>
                                                </p>
                                            </div>
                                        </div>
                                        <!-- all_amount area end -->

                                        <!-- button_area start -->
                                        <a href="{{ route('course_details', $course->slug) }}" class="button_all">
                                            <span class="btn-text">কোর্সটি দেখি</span>
                                            <span class="btn_icon">
                                                <i class="fa-solid fa-arrow-right"></i>
                                            </span>
                                        </a>
                                        <!-- button_area end-->
                                    </div>
                                    <!-- amount_and_button_area end -->
                                </div>
                            </div>
                            <!-- card_title_area end -->
                        </div>
                    @endforeach

                </div>


                <div class="course_paginate_btns">
                    {{ $courses->links() }}
                </div>

            </div>

        </div>
    </section>
@endsection
