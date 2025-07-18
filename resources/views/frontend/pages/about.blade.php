@php
    $meta = [
        // "meta" => [],
        'seo' => [
            'title' => 'about',
            'image' => asset('seo.jpg'),
        ],
    ];
@endphp


{{-- @dd($website_about) --}}
@extends('frontend.layouts.layout', $meta)
@section('contents')
    <!-- aboutus -->
    <section class="aboutus_part">
        <div class="container">
            <div class="aboutus_title">
                <h2 class="aboutus_title_bangla">
                    {{-- আমাদের সম্পর্কে --}}
                    {{ $website_about->aboutus_heading }}
                </h2>
            </div>
            <div class="aboutus_relation_description">
                <p class="aboutus_info">
                    {{ $website_about->aboutus_description }}
                </p>
                {{-- <p class="aboutus_info">
                    দেশের মানুষের বেকারত্বের সমাধান ও আইটি সেক্টরে দক্ষ জনবল তৈরি, মূলত
                    এই মৌলিক বিষয়কে ধারণ করেই টেক পার্ক আইটির যাত্রা শুরু। টেক পার্ক
                    আইটি এদেশের মানুষের মধ্যে আইসিটিতে দক্ষতার উন্নয়ন ঘটাতে চায়, যার
                    মাধ্যমে মানুষের কর্মসংস্থান তৈরির পাশাপাশি এদেশের অর্থনৈতিক উন্নয়নে
                    ভূমিকা পালন করা যাবে।
                </p>
                <p class="aboutus_info">
                    শিক্ষার্থীদের চাহিদার কথা বিবেচনায় রেখে কোর্স কারিকুলাম নিয়মিত আপডেট
                    করার কারণে আমরা শিক্ষার্থীদেরকে সর্বাধুনিক প্রশিক্ষণ দিতে পারছি বলে
                    আমরা আশাবাদী। নির্দিষ্ট সময়ে কোর্স করিয়ে দিয়েই দায়িত্ব পালন সম্পন্ন
                    হয়েছে মনে না করে, আমাদের সাথে সংযুক্ত হওয়া শিক্ষার্থীদেরকে 'টেক
                    পার্ক আইটি পরিবার'-এর সদস্য হিসেবে বিবেচনা করে তাদেরকে প্রফেশনাল
                    প্রতিষ্ঠানে জবের সুযোগ করে দেওয়া এবং প্রফেশনাল উন্নয়ন দেখে আনন্দিত
                    হওয়াটা আমাদের স্বপ্নের মতো। যে স্বপ্ন পূরণে আছে আত্মীক প্রশান্তি। এ
                    প্রশান্তির পথে আমরা এগিয়ে যেতে চাই বহু দূরের পথ।
                </p> --}}
            </div>
            @php
                $brands = \App\Models\WebsiteBrand::where('status', 1)->get();
            @endphp
            <div class="aboutus_partner">
                <div class="container">
                    <div class="aboutus_partner_title">
                        <h3 class="aboutus_partner_title_text">
                            {{-- আমরা যাদের সাথে কাজ করেছি --}}
                            {{ $website_about->our_brand_heading }}
                        </h3>
                    </div>
                    <div class="aboutus_partner_items_container">
                        <div class="items">
                            @foreach ($brands as $brand)
                                {{-- @dd($brand) --}}
                                <div class="item">
                                    <img src="/{{ $brand->image }}" alt="{{ $brand->title }}" />
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /aboutus -->

    <!-- motivation -->
    <section class="motivation_part" id="our_moto">
        <div class="container">
            <div class="motivation_title">
                {{-- <h2 class="motivation_title_bangla">আমাদের মটো</h2> --}}
                <h2 class="motivation_title_bangla">{{ $website_about->aboutus_moto_heading }}</h2>
                <p class="motivation_title_english">
                    {{-- “Empowering learners through technology” --}}
                    "{{ $website_about->aboutus_moto_description }}"
                </p>
            </div>
        </div>
    </section>
    <!-- /motivation -->
    <!-- mission -->
    <section class="mission_part" id="our_mission">
        <div class="container">
            <div class="mission_part_details">
                <div class="mission_part_image">
                    <img src="/{{ $website_about->aboutus_mission_image }}" alt="" />
                </div>
                <div class="mission_part_description">
                    <div class="mission_part_title">
                        {{-- <h2 class="mission_title_bangla">আমাদের মিশন</h2> --}}
                        <h2 class="mission_title_bangla">{{ $website_about->aboutus_mission_heading }}</h2>
                    </div>
                    <div class="mission_part_info">
                        {!! $website_about->aboutus_mission_description !!}
                        {{-- <p>
                            ৩ বছরেরও বেশি সময় ধরে ওয়েব ডিজাইন ও ডেভোলাপম্যান্ট ট্রেইনার
                            হিসেবে কর্মরত আছেন। এছাড়াও তিনি গত ৫ বছর ধরে Fiverr, Upwork ও
                            Freelancer.com এ সফলতার সাথে ফ্রিলান্সিং করে আসছেন, ও ৩০০+
                            প্রজেক্ট সম্পন্ন করেছেন
                        </p>
                        <p>
                            তিনি ৫০০+ স্টুডেন্টকে ট্রেনিং করিয়েছেন, যারা বর্তমানে বাংলাদেশের
                            বিভিন্ন স্বনামধন্য প্রতিষ্ঠানে কর্মরত আছেন।
                        </p> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /mission -->
    <!-- vision -->
    <section class="vision_part" id="our_vision">
        <div class="container">
            <div class="vision_part_details">
                <div class="vision_part_description">
                    <div class="vision_part_title">
                        {{-- <h2 class="vision_title_bangla">আমাদের ভিশন</h2> --}}
                        <h2 class="vision_title_bangla">{{ $website_about->aboutus_vision_heading }}</h2>
                    </div>
                    <div class="vision_part_info">
                        {!! $website_about->aboutus_vision_description !!}
                        {{-- <p>
                            আমাদের ভিশন ৩ বছরেরও বেশি সময় ধরে ওয়েব ডিজাইন ও ডেভোলাপম্যান্ট
                            ট্রেইনার হিসেবে কর্মরত আছেন। এছাড়াও তিনি গত ৫ বছর ধরে Fiverr,
                            Upwork ও Freelancer.com এ সফলতার সাথে ফ্রিলান্সিং করে আসছেন, ও
                            ৩০০+ প্রজেক্ট সম্পন্ন করেছেন
                        </p>
                        <p>
                            তিনি ৫০০+ স্টুডেন্টকে ট্রেনিং করিয়েছেন, যারা বর্তমানে বাংলাদেশের
                            বিভিন্ন স্বনামধন্য প্রতিষ্ঠানে কর্মরত আছেন।
                        </p> --}}
                    </div>
                </div>
                <div class="vision_part_image">
                    <img src="/{{ $website_about->aboutus_vision_image }}" alt="" />
                </div>
            </div>
        </div>
    </section>
    <!-- /vision -->


    <!-- training part start -->
    {{-- <section class="course_item">
        <div class="container">
            <div class="training_details">
                <div class="training_title">
                    <h2 class="training_title_bangla">আমাদের আইটি প্রশিক্ষণ</h2>
                    <p>
                        তরুণ প্রজন্মকে দক্ষ হিসাবে গড়ে তুলতে আমরা আইটি প্রশিক্ষণ দিয়ে
                        থাকি, আমাদের সাথে যুক্ত হয়ে আপনিও আইটি সেক্টরে দক্ষ হয়ে উঠুন
                    </p>
                </div>
            </div>
            <div class="course_item_content">
                <!-- course item_1 start -->
                <div class="course item_1">
                    <a href="#">
                        <div class="course_icon">
                            <svg width="106" height="106" viewBox="0 0 106 106" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path id="icon_course"
                                    d="M102.895 0H90.2656C88.5491 0 87.1602 1.38897 87.1602 3.10547V6.21094H61.7444C60.4581 2.60404 57.0433 0 53 0C48.9567 0 45.5419 2.60404 44.2556 6.21094H18.8398V3.10547C18.8398 1.38897 17.4509 0 15.7344 0H3.10547C1.38897 0 0 1.38897 0 3.10547V15.5273C0 17.2438 1.38897 18.6328 3.10547 18.6328H15.7344C17.4509 18.6328 18.8398 17.2438 18.8398 15.5273V12.3805H31.5938C20.8164 19.1133 13.71 30.9387 12.8606 44.1836C9.13443 45.4032 6.41797 48.8718 6.41797 53C6.41797 58.1373 10.5971 62.3164 15.7344 62.3164C20.8716 62.3164 25.0508 58.1373 25.0508 53C25.0508 49.0374 22.5538 45.6684 19.0593 44.3239C20.1189 29.5574 30.4224 17.1115 44.7546 13.5605C46.3046 16.5577 49.3991 18.6328 53 18.6328C56.6009 18.6328 59.6954 16.5577 61.2454 13.5605C75.5776 17.1113 85.8811 29.5572 86.9407 44.3237C83.4462 45.6684 80.9492 49.0374 80.9492 53C80.9492 58.1373 85.1283 62.3164 90.2656 62.3164C95.4029 62.3164 99.582 58.1373 99.582 53C99.582 48.8718 96.8656 45.4032 93.1394 44.1836C92.29 30.9387 85.1836 19.1547 74.4062 12.4219H87.1602V15.5273C87.1602 17.2438 88.5491 18.6328 90.2656 18.6328H102.895C104.611 18.6328 106 17.2438 106 15.5273V3.10547C106 1.38897 104.611 0 102.895 0ZM74.1275 102.148C72.5032 97.1776 67.8234 93.3711 62.3164 93.3711H43.6836C38.1766 93.3711 33.4968 97.1776 31.8725 102.148C31.2462 104.065 32.8766 106 34.893 106H71.1069C73.1232 106 74.7538 104.065 74.1275 102.148Z"
                                    fill="#EF4444" />
                                <path id="icon_course"
                                    d="M80.4275 63.6993L56.1055 27.2161V56.6774C59.7124 57.9637 62.3164 61.3785 62.3164 65.4218C62.3164 70.5591 58.1373 74.7382 53 74.7382C47.8628 74.7382 43.6836 70.5591 43.6836 65.4218C43.6836 61.3785 46.2877 57.9637 49.8946 56.6774V27.2161L25.5725 63.6993C24.7506 64.9305 24.9144 66.5713 25.9607 67.6176C31.6617 73.3186 35.3059 80.663 36.7123 88.5412C38.8695 87.6661 41.2158 87.1601 43.6836 87.1601H62.3164C64.7842 87.1601 67.1305 87.6659 69.2878 88.5408C70.6942 80.6622 74.3383 73.3186 80.0393 67.6176C81.0857 66.5713 81.2494 64.9305 80.4275 63.6993Z"
                                    fill="#EF4444" />
                                <path id="icon_course"
                                    d="M53 62.3164C51.2866 62.3164 49.8945 63.7085 49.8945 65.4219C49.8945 67.1353 51.2866 68.5273 53 68.5273C54.7134 68.5273 56.1055 67.1353 56.1055 65.4219C56.1055 63.7085 54.7134 62.3164 53 62.3164Z"
                                    fill="#EF4444" />
                            </svg>
                        </div>
                        <div class="course_text_area">
                            <span class="course_text">গ্রাফিক্স ডিজাইন</span>
                        </div>
                    </a>
                </div>
                <!-- course item_1 end -->

                <!-- course item_2 start -->
                <div class="course item_2">
                    <a href="#">
                        <div class="course_icon">
                            <svg width="106" height="106" viewBox="0 0 106 106" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path id="icon_course"
                                    d="M106 25.0508V9.52344C106 4.38637 101.821 0.207031 96.6836 0.207031H9.31641C4.17934 0.207031 0 4.38637 0 9.52344V25.0508H106ZM71.6328 12.6289H90.2656C91.9807 12.6289 93.3711 14.0193 93.3711 15.7344C93.3711 17.4494 91.9807 18.8398 90.2656 18.8398H71.6328C69.9178 18.8398 68.5273 17.4494 68.5273 15.7344C68.5273 14.0193 69.9178 12.6289 71.6328 12.6289ZM40.5781 12.6289C42.2932 12.6289 43.6836 14.0193 43.6836 15.7344C43.6836 17.4494 42.2932 18.8398 40.5781 18.8398C38.8631 18.8398 37.4727 17.4494 37.4727 15.7344C37.4727 14.0193 38.8631 12.6289 40.5781 12.6289ZM28.1562 12.6289C29.8713 12.6289 31.2617 14.0193 31.2617 15.7344C31.2617 17.4494 29.8713 18.8398 28.1562 18.8398C26.4412 18.8398 25.0508 17.4494 25.0508 15.7344C25.0508 14.0193 26.4412 12.6289 28.1562 12.6289ZM15.7344 12.6289C17.4494 12.6289 18.8398 14.0193 18.8398 15.7344C18.8398 17.4494 17.4494 18.8398 15.7344 18.8398C14.0193 18.8398 12.6289 17.4494 12.6289 15.7344C12.6289 14.0193 14.0193 12.6289 15.7344 12.6289ZM0 31.2617V96.4766C0 101.614 4.17934 105.793 9.31641 105.793H96.6836C101.821 105.793 106 101.614 106 96.4766V31.2617H0ZM36.3071 75.4188C37.6466 76.4902 37.8635 78.4443 36.7921 79.7836C35.721 81.1227 33.7664 81.3401 32.4273 80.2685L16.9 67.8466C15.3474 66.6051 15.3464 64.2393 16.9 62.9967L32.4273 50.5748C33.766 49.5034 35.7206 49.7204 36.7921 51.0597C37.8635 52.399 37.6466 54.3534 36.3071 55.4245L23.8111 65.4219L36.3071 75.4188ZM65.1707 44.9069L46.5379 88.3835C45.8624 89.9596 44.0372 90.6905 42.4602 90.0145C40.8839 89.339 40.1535 87.5131 40.8293 85.9368L59.4621 42.4602C60.1378 40.8839 61.9634 40.1537 63.5398 40.8293C65.1161 41.5048 65.8465 43.3304 65.1707 44.9069ZM89.1 67.8468L73.5727 80.2687C72.2357 81.3386 70.2809 81.125 69.2079 79.7838C68.1365 78.4446 68.3534 76.4902 69.6929 75.419L82.1889 65.4219L69.6929 55.425C68.3534 54.3536 68.1365 52.3994 69.2079 51.0601C70.279 49.7208 72.2334 49.5037 73.5727 50.5752L89.1 62.9971C90.6526 64.2387 90.6536 66.6042 89.1 67.8468Z"
                                    fill="white" />
                            </svg>

                            <!-- <svg width="106" height="106" viewBox="0 0 106 106" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M93.6334 3.8477C93.6334 2.61421 93.0069 1.49065 91.9577 0.842227C90.9082 0.193598 89.6232 0.13563 88.5197 0.687575L80.3832 4.75574V50.9223C80.3832 51.3908 80.1971 51.8401 79.8658 52.1714C79.5345 52.5027 79.0851 52.6889 78.6166 52.6889C78.1481 52.6889 77.6987 52.5027 77.3674 52.1714C77.0361 51.8401 76.85 51.3908 76.85 50.9223V6.52234L45.9334 21.9805V60.4304L88.5199 81.7235C89.6236 82.2753 90.9085 82.2173 91.9579 81.5689C93.0071 80.9205 93.6336 79.7969 93.6336 78.5634L93.6334 3.8477ZM9.7166 32.3723H8.8332C3.96258 32.3723 0 36.3348 0 41.2055C0 46.0761 3.96258 50.0389 8.8334 50.0389H9.7168L9.7166 32.3723ZM34.9875 103.195C35.4464 104.686 36.8035 105.689 38.3645 105.689H46.7075C47.8406 105.689 48.8764 105.166 49.5496 104.255C50.2227 103.343 50.4177 102.199 50.0844 101.117L38.4451 63.2889H22.7086L34.9875 103.195ZM20.3319 59.7555H42.4V22.6555H20.3168C16.4201 22.6555 13.25 25.8255 13.25 29.7223V52.6889C13.25 56.5846 16.4184 59.7538 20.3137 59.7555H20.3319ZM97.1666 27.2221V55.1888C102.173 54.3449 106 49.9817 106 44.7389V37.6723C106 32.4294 102.173 28.066 97.1666 27.2221Z"
                                    fill="#EF4444" />
                            </svg> -->
                        </div>
                        <div class="course_text_area">
                            <span class="course_text">ওয়েব ডেভোলাপমেন্ট</span>
                        </div>
                    </a>
                </div>
                <!-- course item_2 end -->

                <!-- course item_3 start -->
                <div class="course item_3">
                    <a href="#">
                        <div class="course_icon">
                            <svg width="106" height="106" viewBox="0 0 106 106" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path id="icon_course"
                                    d="M93.6334 3.8477C93.6334 2.61421 93.0069 1.49065 91.9577 0.842227C90.9082 0.193598 89.6232 0.13563 88.5197 0.687575L80.3832 4.75574V50.9223C80.3832 51.3908 80.1971 51.8401 79.8658 52.1714C79.5345 52.5027 79.0851 52.6889 78.6166 52.6889C78.1481 52.6889 77.6987 52.5027 77.3674 52.1714C77.0361 51.8401 76.85 51.3908 76.85 50.9223V6.52234L45.9334 21.9805V60.4304L88.5199 81.7235C89.6236 82.2753 90.9085 82.2173 91.9579 81.5689C93.0071 80.9205 93.6336 79.7969 93.6336 78.5634L93.6334 3.8477ZM9.7166 32.3723H8.8332C3.96258 32.3723 0 36.3348 0 41.2055C0 46.0761 3.96258 50.0389 8.8334 50.0389H9.7168L9.7166 32.3723ZM34.9875 103.195C35.4464 104.686 36.8035 105.689 38.3645 105.689H46.7075C47.8406 105.689 48.8764 105.166 49.5496 104.255C50.2227 103.343 50.4177 102.199 50.0844 101.117L38.4451 63.2889H22.7086L34.9875 103.195ZM20.3319 59.7555H42.4V22.6555H20.3168C16.4201 22.6555 13.25 25.8255 13.25 29.7223V52.6889C13.25 56.5846 16.4184 59.7538 20.3137 59.7555H20.3319ZM97.1666 27.2221V55.1888C102.173 54.3449 106 49.9817 106 44.7389V37.6723C106 32.4294 102.173 28.066 97.1666 27.2221Z"
                                    fill="#EF4444" />
                            </svg>
                        </div>
                        <div class="course_text_area">
                            <span class="course_text">ডিজিটাল মার্কেটিং</span>
                        </div>
                    </a>
                </div>
                <!-- course item_1 end -->
            </div>
        </div>
    </section> --}}
    <!-- /training part end -->



    <!-- our_course area start -->
    {{-- <section class="our_course_area">
        <div class="container">
            <div class="our_course_area_content">

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
                        <li>
                            <a href="#">সকল কোর্স</a>
                        </li>
                        <li>
                            <a href="#">অনলাইন কোর্স</a>
                        </li>
                        <li>
                            <a href="#">অফলাইন কোর্স</a>
                        </li>
                        <li>
                            <a href="#">ডে-কেয়ার কোর্স</a>
                        </li>
                    </ul>
                </div>
                <!-- course_schedule_name end-->

                <!-- our_course_all_card start -->
                <div class="our_course_all_card">
                    <!-- <div class="row"> -->
                    <!-- <div class="col-4"> -->
                    <!-- graphic_designer card area start-->
                    <div class="c_card graphic_designer">
                        <!-- card_img start -->
                        <a href="#" class="card_img_area">
                            <div class="card_img">
                                <img src="{{ asset('frontend') }}/assets/images/home_page_image/our_course_area/grafix.png"
                                    alt="graphic_designer, tech park it">
                            </div>
                        </a>
                        <!-- card_img end -->

                        <!-- card_title_area start -->
                        <div class="card_title_area">
                            <!-- card_title start -->
                            <a href="#" class="card_title">
                                <p class="title_text">প্রফেশনাল গ্রাফিক্স ডিজাইন</p>
                            </a>
                            <!-- card_title end -->

                            <!-- day_and_boking_area start -->
                            <div class="day_and_boking_area">
                                <div class="day_area">
                                    <span class="day_icon">
                                        <img src="{{ asset('frontend') }}/assets/images/home_page_image/our_course_area/clock.png" alt="clock, tech park it">
                                    </span>
                                    <span class="day_tex">
                                        ১৪ দিন বাকী
                                    </span>
                                </div>
                                <div class="boking_area">
                                    <span class="boking_text">
                                        ৬৮%
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
                                            <span class="taka">২০,০০০</span>
                                        </p>
                                    </div>
                                    <div class="current_amount_area">
                                        <p class="current_amount">
                                            <span class="taka"> ৳ </span>
                                            <span class="taka"> ১০,০০০</span>
                                        </p>
                                    </div>
                                </div>
                                <!-- all_amount area end -->

                                <!-- button_area start -->
                                <button class="button_all">
                                    <span class="btn-text">কোর্সটি দেখি</span>
                                    <span class="btn_icon">
                                        <i class="fa-solid fa-arrow-right"></i>
                                        <!-- <img src="{{ asset('frontend') }}/assets/images/home_page_image/our_course_area/arrow.png"
                                              alt="arrow, tech park it"> -->
                                    </span>
                                </button>
                                <!-- button_area end-->
                            </div>
                            <!-- amount_and_button_area end -->
                        </div>
                        <!-- card_title_area end -->
                    </div>
                    <!-- graphic_designer card area end-->
                    <!-- </div> -->
                    <!-- <div class="col-4"> -->
                    <!-- web card area start-->
                    <div class="c_card web">
                        <!-- card_img start -->
                        <a href="#" class="card_img_area">
                            <div class="card_img">
                                <img src="{{ asset('frontend') }}/assets/images/home_page_image/our_course_area/web.png"
                                    alt="graphic_designer, tech park it">
                            </div>
                        </a>
                        <!-- card_img end -->

                        <!-- card_title_area start -->
                        <div class="card_title_area">
                            <!-- card_title start -->
                            <a href="#" class="card_title">
                                <p class="title_text">Full Stack Web Development
                                    with MERN</p>
                            </a>
                            <!-- card_title end -->

                            <!-- day_and_boking_area start -->
                            <div class="day_and_boking_area">
                                <div class="day_area">
                                    <span class="day_icon">
                                        <img src="{{ asset('frontend') }}/assets/images/home_page_image/our_course_area/clock.png"
                                            alt="clock, tech park it">
                                    </span>
                                    <span class="day_tex">
                                        ১৪ দিন বাকী
                                    </span>
                                </div>
                                <div class="boking_area">
                                    <span class="boking_text">
                                        ৬৮%
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
                                            <span class="taka">২০,০০০</span>
                                        </p>
                                    </div>
                                    <div class="current_amount_area">
                                        <p class="current_amount">
                                            <span class="taka"> ৳ </span>
                                            <span class="taka"> ১০,০০০</span>
                                        </p>
                                    </div>
                                </div>
                                <!-- all_amount area end -->

                                <!-- button_area start -->
                                <button class="button_all">
                                    <span class="btn-text">কোর্সটি দেখি</span>
                                    <span class="btn_icon">
                                        <i class="fa-solid fa-arrow-right"></i>
                                        <!-- <img src="{{ asset('frontend') }}/assets/images/home_page_image/our_course_area/arrow.png"
                                              alt="arrow, tech park it"> -->
                                    </span>
                                </button>
                                <!-- button_area end-->
                            </div>
                            <!-- amount_and_button_area end -->
                        </div>
                        <!-- card_title_area end -->

                    </div>
                    <!-- web card area end-->
                    <!-- </div> -->
                    <!-- <div class="col-4"> -->
                    <!-- degital marketing card area start-->
                    <div class="c_card digital_marketing">
                        <!-- card_img start -->
                        <a href="#" class="card_img_area">
                            <div class="card_img">
                                <img src="{{ asset('frontend') }}/assets/images/home_page_image/our_course_area/desital_marketing.png"
                                    alt="graphic_designer, tech park it">
                            </div>
                        </a>
                        <!-- card_img end -->

                        <!-- card_title_area start -->
                        <div class="card_title_area">
                            <!-- card_title start -->
                            <a href="#" class="card_title">
                                <p class="title_text"> কমপ্লিট ডিজিটাল মার্কেটিং</p>
                            </a>
                            <!-- card_title end -->

                            <!-- day_and_boking_area start -->
                            <div class="day_and_boking_area">
                                <div class="day_area">
                                    <span class="day_icon">
                                        <img src="{{ asset('frontend') }}/assets/images/home_page_image/our_course_area/clock.png"
                                            alt="clock, tech park it">
                                    </span>
                                    <span class="day_tex">
                                        ১৪ দিন বাকী
                                    </span>
                                </div>
                                <div class="boking_area">
                                    <span class="boking_text">
                                        ৬৮%
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
                                            <span class="taka">২০,০০০</span>
                                        </p>
                                    </div>
                                    <div class="current_amount_area">
                                        <p class="current_amount">
                                            <span class="taka"> ৳ </span>
                                            <span class="taka"> ১০,০০০</span>
                                        </p>
                                    </div>
                                </div>
                                <!-- all_amount area end -->

                                <!-- button_area start -->
                                <button class="button_all">
                                    <span class="btn-text">কোর্সটি দেখি</span>
                                    <span class="btn_icon">
                                        <i class="fa-solid fa-arrow-right"></i>
                                        <!-- <img src="{{ asset('frontend') }}/assets/images/home_page_image/our_course_area/arrow.png"
                                              alt="arrow, tech park it"> -->
                                    </span>
                                </button>
                                <!-- button_area end-->
                            </div>
                            <!-- amount_and_button_area end -->
                        </div>
                        <!-- card_title_area end -->

                    </div>
                    <!-- degital marketing card area end-->
                    <!-- </div> -->
                </div>
            </div>
            <!-- our_course_all_card end -->
        </div>
        </div>
    </section> --}}
    <!-- our_course area end -->

    <!-- our_course area start -->
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
                            <a href="{{ route('about') }}">সকল কোর্স</a>
                        </li>
                        <li class="course_type_active">
                            @foreach ($course_types as $index => $item)
                                <a href="{{ route('about', ['slug' => $item->id]) }}"
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
                                                $admissionEndDate = isset($course->course_batch[0]->admission_end_date)
                                                    ? \Carbon\Carbon::parse(
                                                        $course->course_batch[0]->admission_end_date,
                                                    )
                                                    : null;
                                            @endphp
                                            <span class="day_tex">
                                                @if ($admissionEndDate && $admissionEndDate->isFuture())
                                                    @php
                                                        $now = \Carbon\Carbon::now();
                                                        $diff = $admissionEndDate->diff($now);
                                                    @endphp
                                                    {{ $diff->d }} দিন
                                                    {{ $diff->h }} ঘন্টা
                                                    {{ $diff->i }} মিনিট
                                                @else
                                                    0 দিন
                                                @endif
                                                বাকী
                                            </span>

                                        </div>
                                        <div class="boking_area">
                                            <span class="boking_text">
                                                {{ $course->course_batch[0]->booked_percent ?? 0 }}%
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
                                                        {{ $course->course_batch[0]->course_price ?? 0 }}</span>
                                                </p>
                                            </div>
                                            <div class="current_amount_area">
                                                <p class="current_amount">
                                                    <span class="taka"> ৳ </span>
                                                    <span class="taka">
                                                        {{ $course->course_batch[0]->after_discount_price ?? 0 }}</span>
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

    <!-- our_course area end -->

    <!-- my_it_service_area start -->
    {{-- <section class="my_it_service_area"
        style="background-image: url({{ asset('frontend') }}/assets/images/home_page_image/ti_service/bg_img.png);">
        <div class="container">
            <div class="my_it_service_area_content">

                <!--my_it_service_area_title start -->
                <div class="my_it_service_area_title">
                    <h2 class="area_title"> --}}
    {{-- আমাদের আইটি সার্ভিসগুলো --}}
    {{-- {{ $website_about->our_training_heading }} --}}
    {{-- </h2>
                </div> --}}
    <!-- my_it_service_area end -->

    <!-- my_it_service_area_sub_title start -->
    {{-- <div class="my_it_service_area_sub_title">
                    <span class="sub_title"> --}}
    {{-- আমরা ক্লায়েন্ট-কেন্দ্রিক ওয়েব ডিজাইন ও ডেভোলাপমেন্ট এবং সাইভার সিকিউরিটি সার্ভিস প্রদান করি --}}
    {{-- {{ $website_about->our_training_description }}
                    </span>

                </div> --}}
    <!-- my_it_service_area_sub_title end -->

    <!-- service_area start -->
    {{-- <div class="service_area">


                    <div class="service wordpress">
                        <div class="service_logo">
                            <img src="{{ asset('frontend') }}/assets/images/home_page_image/ti_service/wordpress.png"
                                alt="service techpark it">
                        </div>
                        <div class="service_title_and_description">
                            <div class="title">
                                <p class="title_text">
                                    ওয়ার্ডপ্রেস ডেভোলাপমেন্ট
                                </p>
                            </div>
                            <div class="description">
                                <p class="description_text">
                                    ওয়ার্ডপ্রেস ইন্সটলেশন, থিম কাস্টমাইজেশন,
                                    রেসপনসিভ ডিজাইন, ওয়ার্ডপ্রেস ডেভেলপমেন্ট,
                                    ওয়ার্ডপ্রেস প্লাগইন ইন্টিগ্রেশন এবং ওয়ার্ডপ্রেস এসইও।
                                </p>
                            </div>
                        </div>
                    </div>


                    <div class="service  react ">
                        <div class="service_logo">
                            <img src="{{ asset('frontend') }}/assets/images/home_page_image/ti_service/react.png"
                                alt="service techpark it">
                        </div>
                        <div class="service_title_and_description">
                            <div class="title">
                                <p class="title_text">
                                    React ডেভোলাপমেন্ট
                                </p>
                            </div>
                            <div class="description">
                                <p class="description_text">
                                    আমরা React ফ্রন্টএন্ড ডেভোলাপমেন্ট এবং

                                    আপনার সিঙ্গেল পেজ React ওয়েবসাইট (SPA) তৈরি করুন
                                </p>
                            </div>
                        </div>
                    </div>


                    <div class="service e_commers">
                        <div class="service_logo">
                            <img src="{{ asset('frontend') }}/assets/images/home_page_image/ti_service/e_comarce.png"
                                alt="service techpark it">
                        </div>
                        <div class="service_title_and_description">
                            <div class="title">
                                <p class="title_text">
                                    Laravel ই-কমার্স
                                </p>
                            </div>
                            <div class="description">
                                <p class="description_text">
                                    আমরা ফুলস্ট্যাক Laravel ই-কমার্স সাইট ডেভোলাপমেন্ট সার্ভিস প্রদান করি
                                </p>
                            </div>
                        </div>
                    </div>


                    <div class="service psd">
                        <div class="service_logo">
                            <img src="{{ asset('frontend') }}/assets/images/home_page_image/ti_service/phd.png"
                                alt="service techpark it">
                        </div>
                        <div class="service_title_and_description">
                            <div class="title">
                                <p class="title_text">
                                    PSD to HTML
                                </p>
                            </div>
                            <div class="description">
                                <p class="description_text">
                                    PSD/Figma/Adobe XD ডিজাইন HTML-এ কনভার্ট করি
                                </p>
                            </div>
                        </div>
                    </div>


                    <div class="service vue">
                        <div class="service_logo">
                            <img src="{{ asset('frontend') }}/assets/images/home_page_image/ti_service/vuejs-ar21 1.png"
                                alt="service techpark it">
                        </div>
                        <div class="service_title_and_description">
                            <div class="title">
                                <p class="title_text">
                                    Vue ডেভোলাপমেন্ট
                                </p>
                            </div>
                            <div class="description">
                                <p class="description_text">
                                    Laravel+VueJS এর মাধ্যমে আপনার ওয়েবসাইট তৈরি করুন আমাদের থেকে আপনি VueJS এর মাধ্যমে
                                    SPA Application বানাতে পারবেন
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="service server">
                        <div class="service_logo">
                            <img src="{{ asset('frontend') }}/assets/images/home_page_image/ti_service/server.png"
                                alt="service techpark it">
                        </div>
                        <div class="service_title_and_description">
                            <div class="title">
                                <p class="title_text">
                                    সাইভার সিকিউরিটি
                                </p>
                            </div>
                            <div class="description">
                                <p class="description_text">
                                    আমরা সকল ধরনের সাইবার সিকিউরিটি সার্ভিস প্রদান করি
                                </p>
                            </div>
                        </div>
                    </div>
                </div> --}}
    <!-- service_area end-->
    </div>
    </div>
    </section>
    <!-- my_it_service_area end-->

    <!-- team area start -->
    <section class="team_area">
        <div class="container">
            <div class="team_area_details">
                <div class="team_area_title">
                    {{-- <h2 class="team_area_title_bangla">আমাদের টিম</h2> --}}
                    <h2 class="team_area_title_bangla">
                        {{ $website_about->aboutus_team_heading }}
                    </h2>
                    <p>{!! $website_about->aboutus_team_description !!}</p>
                    {{-- <p>
                        আমরা এখানে আমাদের সহকর্মী হিসেবে এমন মানুষদেরকে পেয়েছি, যারা প্রতিষ্ঠানের মূল লক্ষ্যকে মনে প্রাণে
                        নিজেদের জন্যও ধারণ করেন এবং সে লক্ষ্যকে বাস্তবায়নের জন্য সর্বাত্মক প্রচেষ্টা চালিয়ে যাচ্ছেন। আর
                        যোগ্যতার প্রশ্নে টেক পার্ক আইটি প্রথম থেকেই আপোসহীন থেকে নিয়োগ কার্যক্রম সম্পাদন করে যাচ্ছে। ফলে
                        একদল আগ্রহী ও যোগ্যতাসম্পন্ন তরুণ কর্মীর সমাহার ঘটেছে এ প্রতিষ্ঠানে।
                    </p> --}}
                </div>
                <div class="team_area_carousel">
                    @if ($team_top_image)
                        <div class="carousel_image">
                            <img src="/{{ $team_top_image->image }}" alt="">
                        </div>
                    @endif
                    <div class="carousel_images">
                        @foreach ($team_related_image as $item)
                            <div class="single_image">
                                <img src="/{{ $item->image }}" alt="" style="max-width: 150px;">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /team area end -->

    <!-- trainers area starts -->
    <section class="trainers_area">
        <div class="container">
            <div class="trainers_description">
                <div class="trainers_title">
                    <h2 class="trainers_title_bangla">{{ $website_about->our_trainers_heading }}</h2>
                    {{-- <h2 class="trainers_title_bangla">{{ $website_about->our_trainers_heading }}</h2> --}}
                </div>
                <div class="trainers_details">
                    @foreach ($teachers as $teacher)
                        <div class="trainer_details">
                            <div class="trainer_images">
                                <div class="image">
                                    <img src="{{ $teacher->instructor->photo }}" alt="">
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

    <!-- hire section start -->
    <section class="hire_area">
        <div class="container">
            <div class="hire_details">
                <div class="hire_title">
                    <h2 class="hire_title_bangla">আপনার কোন প্রজেক্টের জন্য আমাদেরকে Hire করুন</h2>
                    <p>
                        আপনার কোন প্রজেক্ট থাকলে আমাদেরকে হারার করতে পারেন, আমাদের রয়েছে কমপ্লিট ফ্রন্টএন্ড ও ব্যাকএন্ড টিম
                        ও এসইও স্পেসালিস্ট
                    </p>
                </div>
                <div class="hire_btn">Hire us</div>
            </div>
        </div>
    </section>
    <!-- /hire section end -->
@endsection
