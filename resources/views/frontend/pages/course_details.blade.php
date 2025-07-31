@php
    $meta = [
        // "meta" => [],
        'seo' => [
            'title' => $data->title,
            'image' => asset($data->image),
        ],
    ];
@endphp
@extends('frontend.layouts.layout', $meta)
@section('contents')
    <section class="course_details_area" id="course_details">
        <div class="container">
            <div class="course_details_part">
                <div class="course_details">
                    <div class="course_title">
                        <h2 class="course_title_text">
                            {{ $data->title }}
                        </h2>
                    </div>
                    <!-- what is course start -->
                    <div class="what_is_course">
                        <h2 class="what_is_course_title">{{ $data->title }} কী?</h2>
                        <p class="what_is_course_details">
                            {!! $data->what_is_this_course !!}
                        </p>
                    </div>
                    <!-- /what is course end -->

                    <!-- why learn this course start -->
                    <div class="why_learn_this_course">
                        <h2 class="why_learn_this_course_title">
                            এই Course টি আপনাকে কিভাবে সাহায্য করবে
                            {{-- এই কোর্স কেনো করবেন? --}}
                        </h2>
                        <div class="why_learn_this_course_details">
                            <style>
                                .why_learn_this_course_details>ul {
                                    padding-left: 30px;

                                    li {
                                        list-style-type: disc;
                                    }
                                }
                            </style>
                            {!! $data->why_is_this_course !!}
                        </div>
                    </div>
                    <!-- /why learn this course end -->

                    <!-- job possition and frelancing part start -->
                    <div class="job_possition_and_freelancing" id="course_feature">

                        <div class="job_possition">
                            <h2 class="job_possition_title">
                                {{-- আপনি যেসব পজিশনে জব করতে পারবেন --}}
                                কোর্সটি যেভাবে সাজানো হয়েছে
                            </h2>
                            <div class="job_categories">
                                @foreach ($data->course_job_position()->get() as $item)
                                    <div class="job_categorie">
                                        <div class="job_categorie_icon">
                                            <i class="fa-regular fa-circle-check"></i>
                                        </div>
                                        <div class="job_categorie_title">
                                            {{ $item->title }}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <!-- / job possintion and freelanching part end -->

                    <!-- course feature start -->
                    <div class="course_feature_part">
                        <ul class="course_features">
                            <li class="">
                                <div class="feature_title">
                                    <div class="feature_name">
                                        এই কোর্সে যা যা শিখবেন
                                    </div>
                                    <div class="feature_acordion_icon">
                                        <i class="fa-solid fa-chevron-down"></i>
                                    </div>
                                </div>
                                <div class="feature_content">
                                    <ul style="column-count: unset;width:unset;">
                                        @foreach ($data->course_you_will_learns()->get() as $item)
                                            <li>
                                                <div class="cheak_icon">
                                                    <i class="fa-regular fa-circle-check"></i>
                                                </div>
                                                <div class="feature_content_text">
                                                    {{ $item->title }}
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </li>
                            <li class="">
                                <div class="feature_title">
                                    <div class="feature_name">এই কোর্সটি যাদের জন্য</div>
                                    <div class="feature_acordion_icon">
                                        <i class="fa-solid fa-chevron-down"></i>
                                    </div>
                                </div>
                                <div class="feature_content">
                                    <ul style="column-count: unset;width:unset;">
                                        @foreach ($data->course_for_whomes()->get() as $item)
                                            <li>
                                                <div class="cheak_icon">
                                                    <i class="fa-regular fa-circle-check"></i>
                                                </div>
                                                <div class="feature_content_text">
                                                    {{ $item->title }}
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </li>
                            <li class="">
                                <div class="feature_title">
                                    <div class="feature_name">
                                        {{-- আপনি কেন আমাদের কাছ থেকে শিখবেন? --}}
                                        কোর্সের এক্সক্লুসিভ ফিচার
                                    </div>
                                    <div class="feature_acordion_icon">
                                        <i class="fa-solid fa-chevron-down"></i>
                                    </div>
                                </div>
                                <div class="feature_content">
                                    <ul style="column-count: unset;width:unset;">
                                        @foreach ($data->course_you_will_learn_for_us()->get() as $item)
                                            <li>
                                                <div class="cheak_icon">
                                                    <i class="fa-regular fa-circle-check"></i>
                                                </div>
                                                <div class="feature_content_text">
                                                    {{ $item->title }}
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </li>
                            <li class="">
                                <div class="feature_title">
                                    <div class="feature_name">
                                        এই কোর্সে আপনি যা যা পাচ্ছেন?
                                    </div>
                                    <div class="feature_acordion_icon">
                                        <i class="fa-solid fa-chevron-down"></i>
                                    </div>
                                </div>
                                <div class="feature_content">
                                    <ul style="column-count: unset;width:unset;">
                                        @foreach ($data->course_what_you_will_get()->get() as $item)
                                            <li class="">
                                                <div class="cheak_icon">
                                                    <i class="fa-regular fa-circle-check"></i>
                                                </div>
                                                <div class="feature_content_text">
                                                    {{ $item->title }}
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <script>
                        [...document.querySelectorAll(".feature_acordion_icon")].forEach(
                            (el) => {
                                el.onclick = function(e) {
                                    e.currentTarget.parentNode.parentNode.classList.toggle(
                                        "active"
                                    );
                                    // console.log(e.currentTarget);
                                };
                            }
                        );
                    </script>
                    <!-- / course feature end -->


                    <!-- class module start -->
                    <div class="class_module">
                        <div class="class_module_head">
                            <div class="class_module_title">ক্লাস মডিউল</div>
                            <ul class="class_module_content">
                                @foreach ($data->course_module_at_a_glance()->get() as $key => $item)
                                    <li>{{ $item->title }}</li>
                                    @if ($key < $data->course_module_at_a_glance()->count() - 1)
                                        ।
                                    @endif
                                @endforeach
                            </ul>
                        </div>

                        <div class="class_module_details">

                            @foreach ($data->course_modules()->orderBy('module_no', 'asc')->get() as $item)
                                <ul class="class_module_features">
                                    <li class="active">
                                        <div class="class_module_title">
                                            <div class="class_module_title_and_number">
                                                <div class="class_module_number">
                                                    মডিউল <span class="number"> {{ $item->module_no }} </span>
                                                </div>
                                                <div class="class_module_title_details">
                                                    <div class="title">{{ $item->title }}</div>
                                                    <ul class="details">
                                                        <li>
                                                            {{ $item->classes()->where('type', 'live')->count() }}
                                                            টি লাইভ ক্লাস
                                                        </li>

                                                        <li>
                                                            {{ $item->classes()->where('type', 'recorded')->count() }}
                                                            টি রেকর্ডেড ক্লাস
                                                        </li>
                                                        ।
                                                        <li>
                                                            {{ $item->quizes()->count() }}
                                                            টি কুইজ
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="class_module_acordion_icon">
                                                <i class="fa-solid fa-chevron-down"></i>
                                            </div>
                                        </div>
                                        <div class="class_module_feature_content">
                                            <ul>
                                                @foreach ($item->classes as $class)
                                                    {{-- @dd($class)     --}}
                                                    <li>
                                                        <div class="class_module_class_no">ক্লাস {{ $class->class_no }}
                                                        </div>
                                                        <div class="live_class_and_topic">
                                                            <div class="live_class_icon">
                                                                <img src="/assets/images/about_page_image/class_module/podcasts.png"
                                                                    alt="" />
                                                            </div>
                                                            <div class="class_module_live_class">
                                                                @if ($class->type == 'live')
                                                                    লাইভ ক্লাসঃ
                                                                @else
                                                                    রেকর্ডেড ক্লাসঃ
                                                                @endif
                                                            </div>
                                                            <div class="class_module_topic">{{ $class->title }}</div>
                                                        </div>
                                                        @if ($class->class_quiz && $class->class_quiz->quiz)
                                                            <div class="quiz_and_mcq">
                                                                <div class="quiz_icon">
                                                                    <i class="fa-solid fa-file-lines"></i>
                                                                </div>
                                                                <div class="quiz">কুইজঃ</div>
                                                                <div class="mcq">
                                                                    {{ $class->class_quiz->quiz->title ?? '' }}
                                                                    {{-- MCQ Question about basics of Bootstrap --}}
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </li>
                                </ul>
                            @endforeach

                        </div>
                    </div>
                    <script>
                        [
                            ...document.querySelectorAll(".class_module_acordion_icon"),
                        ].forEach((el) => {
                            el.onclick = function(e) {
                                e.currentTarget.parentNode.parentNode.classList.toggle(
                                    "active"
                                );
                                console.log(e.currentTarget);
                            };
                        });
                    </script>
                    <!-- /class module end -->
                    <!-- course trainer start-->
                    @if ($data->course_instructor != null && count($data->course_instructor) > 0)
                        {{-- @dump($data->course_instructor)    --}}
                        <section class="course_trainers_area">
                            <div class="container">
                                <div class="trainers_description">
                                    <div class="trainers_title">
                                        <h2 class="trainers_title_bangla">কোর্স প্রশিক্ষক</h2>
                                    </div>
                                    <div class="d-flex flex-wrap gap-3">
                                        @foreach ($data->course_instructor as $teacher)
                                            <div class="trainers_details mb-4">
                                                <div class="trainer_details">
                                                    <div class="trainer_images">
                                                        <div class="image">
                                                            <img src="{{ asset($teacher->cover_photo) }}"
                                                                alt="" />
                                                        </div>
                                                        <div class="trainer_info">
                                                            <div class="trainer_name">{{ $teacher->full_name }}</div>
                                                            <p>{{ $teacher->designation }}</p>
                                                            @if ($teacher->social_links)
                                                                <div class="trainer_link">
                                                                    @foreach ($teacher->social_links as $link)
                                                                        @if ($link->media_name == 'twitter')
                                                                            <a target="_blank"
                                                                                href="{{ $link->link ?: '#' }}"><i
                                                                                    class="fa-brands tw fa-square-twitter"></i></a>
                                                                        @endif
                                                                        @if ($link->media_name == 'facebook')
                                                                            <a target="_blank"
                                                                                href="{{ $link->link ?: '#' }}"><i
                                                                                    class="fa-brands fb fa-square-facebook"></i></a>
                                                                        @endif
                                                                        @if ($link->media_name == 'linkedin')
                                                                            <a target="_blank"
                                                                                href="{{ $link->link ?: '#' }}"><i
                                                                                    class="fa-brands ld fa-linkedin"></i></a>
                                                                        @endif
                                                                        @if ($link->media_name == 'instagram')
                                                                            <a target="_blank"
                                                                                href="{{ $link->link ?: '#' }}"><i
                                                                                    class="fa-brands in fa-square-instagram"></i></a>
                                                                        @endif
                                                                    @endforeach
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="trainer_descrip">
                                                        <p>
                                                            {{ $teacher->short_description }}
                                                        </p>
                                                        {{--
                                                            <p>
                                                            তিনি ৫০০+ স্টুডেন্টকে ট্রেনিং করিয়েছেন, যারা বর্তমানে
                                                            বাংলাদেশের বিভিন্ন স্বনামধন্য প্রতিষ্ঠানে কর্মরত আছেন।
                                                        </p> --}}
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                            </div>
                        </section>
                    @endif
                    <!-- /course trainer end -->
                </div>
                <div class="course_info">
                    @php
                        $batch_info = $data->course_batch()->first();
                    @endphp
                    <div class="course_info_div">
                        {{-- <div onclick="showCourseVideo(`{{ $data->intro_video }}`)" --}}
                        <div class="course_info_thubnail_and_icon my-0">
                            <div class="course_info_thubnail">
                                <img class="img-fluid course_main_img" src="{{ asset($data->image) }}" alt="">
                            </div>
                            <div class="course_info_icon">
                                <img src="{{ asset('frontend/') }}/assets/images/course_details_image/course_info_icon.png"
                                    alt="">
                            </div>
                        </div>
                        <div class="course_info_time">
                            <div class="time_have">
                                <div class="time_have_title">সময় বাকী আছে</div>
                                <ul class="timer">
                                    @php
                                        use Carbon\Carbon;

                                        $admissionEndDate = optional($batch_details)->admission_end_date;
                                        $formattedDate = $admissionEndDate
                                            ? Carbon::parse($admissionEndDate)->format('Y-m-d H:i:s')
                                            : null;
                                    @endphp

                                    <li class="d-none">
                                        <div class="amount" data-years></div>
                                        <div class="title">Years</div>
                                    </li>
                                    <li>
                                        <div class="amount" data-days></div>
                                        <div class="title">দিন</div>
                                    </li>|
                                    <li>
                                        <div class="amount" data-hours></div>
                                        <div class="title">ঘণ্টা</div>
                                    </li>|
                                    <li>
                                        <div class="amount" data-minutes></div>
                                        <div class="title">মিনিট</div>
                                    </li>|
                                    <li>
                                        <div class="amount" data-seconds></div>
                                        <div class="title">সেকেন্ড</div>
                                    </li>
                                </ul>
                            </div>
                            <div class="course_booked">
                                <div>
                                    {{ App\Helpers\ConvertHelper::convertToBanglaNumbers($batch_info->booked_percent ?? '০') }}%
                                </div>
                                <div>বুকড</div>
                            </div>
                        </div>
                        <div class="course_fee">

                            @if ($batch_info)
                                <del class="twenty_thousand">৳
                                    {{ App\Helpers\ConvertHelper::convertToBanglaNumbers(number_format($batch_info->course_price ?? '০', 0, '.', ',')) }}
                                </del>
                                <div class="ten_thousand">৳
                                    {{ App\Helpers\ConvertHelper::convertToBanglaNumbers(number_format($batch_info->after_discount_price ?? '০', 0, '.', ',')) }}
                                </div>
                            @else
                                <div class="ten_thousand">৳
                                    {{ App\Helpers\ConvertHelper::convertToBanglaNumbers(number_format($batch_info->course_price ?? '০', 0, '.', ',')) }}
                                </div>
                            @endif
                        </div>
                        <div class="admit_course">
                            @if ($check_enrolled)
                                <a href="{{ url('my-course', $data->slug) }}" class="admit_course_title_and_icon">
                                    <div class="admit_course_title">কোর্স দেখুন</div>
                                    <div class="admit_course_icon"><i class="fa-solid fa-angle-right"></i></div>
                                </a>
                            @else
                                <a href="{{ route('course_enroll', $data->slug) }}" class="admit_course_title_and_icon">
                                    <div class="admit_course_title">কোর্সে ভর্তি হোন</div>
                                    <div class="admit_course_icon"><i class="fa-solid fa-angle-right"></i></div>
                                </a>
                            @endif
                            <div class="admit_course_batch">
                                <div class="admit_course_batch_title">ব্যাচ <span>{{ $batch_info->batch_name }}</span>
                                </div>
                                <div class="admit_course_start_and_deadline">
                                    <div class="admit_course_start">
                                        <div class="admit_course_start_title"><span><i
                                                    class="fa-regular fa-calendar-days"></i></span><span>ভর্তী শুরুঃ</span>
                                        </div>
                                        <div class="admit_course_start_date">
                                            {{ \Carbon\Carbon::parse($batch_info->admission_start_date)->format('d M Y') }}
                                        </div>
                                    </div>
                                    <div class="admit_course_line"></div>
                                    <div class="admit_course_deadline">
                                        <div class="admit_course_deadline_title"><span><i
                                                    class="fa-regular fa-calendar-xmark"></i></span><span>ভর্তী শেষঃ</span>
                                        </div>
                                        <div class="admit_course_deadline_date">
                                            {{ \Carbon\Carbon::parse($batch_info->admission_end_date)->format('d M Y') }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="admit_course_batch_details">
                                <div class="admit_course_orientation">
                                    <span>
                                        <i class="fa-regular fa-calendar-days"></i>
                                    </span>
                                    <span>
                                        ওরিয়েন্টেশন ও প্রথম ক্লাসঃ
                                        {{ \Carbon\Carbon::parse($batch_info->admission_end_date)->format('d M l') }}
                                    </span>
                                </div>
                                <div class="admit_course_class_date">
                                    <span><i class="fa-regular fa-calendar-days"></i></span>
                                    <span>ক্লাসের দিনঃ {{ $batch_info->class_days }}</span>
                                </div>
                                <div class="admit_course_class_time"><span>
                                        <i class="fa-regular fa-calendar-days"></i></span>
                                    <span>ক্লাসের সময়ঃ
                                        {{ \Carbon\Carbon::parse($batch_info->class_start_time)->format('g:i A') }} -
                                        {{ \Carbon\Carbon::parse($batch_info->class_end_time)->format('g:i A') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="course_needed">
                        <div class="course_needed_title">কোর্সটি করার জন্য যা যা লাগবে</div>
                        @if ($data->course_essentials)
                            @foreach ($data->course_essentials as $course_essential)
                                <div class="course_needed_internet">
                                    <i class="fa-regular fa-circle-dot"></i>
                                    {{ $course_essential->title }}
                                </div>
                            @endforeach
                        @endif
                        <div class="course_hotline_and_schedule">
                            <div class="course_hotline" style="display: unset; padding: 20px;">
                                <div class="course_hotline_title">
                                    যেকোনো প্রয়োজনে কল করুনঃ
                                </div>
                                @foreach (setting('phone_numbers', true) as $item)
                                    <div class="d-flex mt-2 gap-2 align-items-center justify-content-center">
                                        <i class="fa-solid fa-phone"></i>
                                        <div class="course_hotline_number"> {{ $item->value }} </div>
                                    </div>
                                @endforeach

                            </div>
                            <div class="course_schedule">(সকাল ১০ টা থেকে রাত ৮ টা)</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- trainers area starts -->
    <section class="trainers_area mt-4">
        <div class="container">
            <div class="trainers_description">
                <div class="trainers_title">
                    {{-- <h2 class="trainers_title_bangla">{{ $website_about->our_trainers_heading }}</h2> --}}
                    <h2 class="trainers_title_bangla">ট্রেইনারস</h2>
                </div>
                <div class="trainers_details">
                    @foreach ($instructors as $teacher)
                        <div class="trainer_details">
                            <div class="trainer_images">
                                <div class="image">
                                    <img src="/{{ $teacher->instructor->photo }}" alt="">
                                </div>
                                <div class="trainer_info">
                                    <div class="trainer_name">{{ $teacher->full_name }}</div>
                                    <p>{{ $teacher->designation }}</p>
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
                                    {{ $teacher->short_description }}
                                </p>
                            </div>
                            <div class="profational_trainer_button_area mt-4">
                                <a href="{{ route('teacher.details', ['teacher_name' => str_replace(' ', '-', $teacher->full_name), 'slug' => $teacher->slug]) }}"
                                    class="button_all">
                                    <span class="btn_text">বিস্তারিত দেখুন</span>
                                    <span class="btn_icon"><i class="fa-solid fa-arrow-right"></i></span>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </section>
    <!-- /trainers area ends -->


    <!-- general question area start-->
    @if (count($data->course_faqs) > 0)
        <div class="general_question_part">
            <div class="container">
                <div class="general_questions">
                    <div class="general_question_details">
                        <div class="general_question_head">
                            <div class="general_question_heading_title">সাধারণ জিজ্ঞাসা</div>
                            <div class="general_question_heading_brief">
                                আপনার কোন জিজ্ঞাসা থাকলে এখান থেকে খুঁজে দেখতে পারেন
                            </div>
                        </div>
                        <ul class="general_question_all" style="width: 600px;">
                            @foreach ($data->course_faqs as $faq)
                                <div class="general_question">
                                    <li class="">
                                        <div class="general_question_title_and_icon">
                                            <div class="general_question_title">
                                                {{ $faq->title }}
                                            </div>
                                            <div class="general_question_acordion_icon">
                                                <i class="fa-solid fa-chevron-down"></i>
                                            </div>
                                        </div>
                                        <div class="general_question_content">
                                            {{ $faq->description }}
                                        </div>
                                    </li>
                                </div>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <div id="story_modal" class="modal fade modal-xl" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        {{-- <div class="modal-header">
                        <h5 class="modal-title">
                            GeeksforGeeks
                        </h5>
                    </div> --}}
                        <div class="modal-body">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <script src="/js/plugins/countdown.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const timerElement = document.querySelector('.timer');

            // Function to convert numbers to Bengali numerals
            function convertToBangla(number) {
                const banglaDigits = ['০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯'];
                return number.toString().split('').map(digit => banglaDigits[digit] || digit).join('');
            }

            @if ($formattedDate)
                timezz(timerElement, {
                    date: "{{ $formattedDate }}",
                    pause: false,
                    stopOnZero: true,
                    update(event) {
                        if (event.total <= 0) {
                            document.querySelector("[data-days]").innerText = "০";
                            document.querySelector("[data-hours]").innerText = "০";
                            document.querySelector("[data-minutes]").innerText = "০";
                            document.querySelector("[data-seconds]").innerText = "০";
                        } else {
                            const daysElement = document.querySelector("[data-days]");
                            const hoursElement = document.querySelector("[data-hours]");
                            const minutesElement = document.querySelector("[data-minutes]");
                            const secondsElement = document.querySelector("[data-seconds]");

                            if (daysElement) daysElement.innerText = convertToBangla(event.days);
                            if (hoursElement) hoursElement.innerText = convertToBangla(event.hours);
                            if (minutesElement) minutesElement.innerText = convertToBangla(event.minutes);
                            if (secondsElement) secondsElement.innerText = convertToBangla(event.seconds);
                        }
                    },
                });
            @endif
        });

        [
            ...document.querySelectorAll(".general_question_acordion_icon"),
        ].forEach((element) => {
            element.onclick = function(e) {
                e.currentTarget.parentNode.parentNode.classList.toggle(
                    "active"
                );
                // console.log(e.currentTarget.parentNode.classList);
            };
        });
    </script>
@endsection
