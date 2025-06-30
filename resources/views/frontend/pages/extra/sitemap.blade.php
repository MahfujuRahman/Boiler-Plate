@php
    $meta = [
        // "meta" => [],
        'seo' => [
            'title' => 'Sitemap',
            'image' => asset('seo.jpg'),
        ],
    ];
@endphp
@extends('frontend.layouts.layout', $meta)
@section('contents')
    <style>
        .divider:after,
        .divider:before {
            content: "";
            flex: 1;
            height: 1px;
            background: #eee;
        }
    </style>
    <section class="py-5 my-5">
        <div class="container h-custom">
            <div class="content">
                <h2>Sitemap</h2>

                <div class="mt-1">

                    <!-- site map area start -->
                    <div class="sitemap_area">
                        <div class="container">
                            <div class="sitemap_heading">Sitemap</div>
                            <div class="sitemap_details">
                                <div>
                                    <div class="sitemap_info">
                                        <h2 class="info_title">হোম</h2>
                                        <ul>
                                            <li><a href="/">হেডলাইন</a></li>
                                            <li><a href="{{ route('courses') }}">কোর্স লিস্ট</a></li>
                                            <li><a href="/course/ielts-daycare#course_feature">কোর্স ফিচার</a></li>
                                            {{-- <li><a href="#">আর্নিং স্টেপস</a></li> --}}
                                            <li><a href="{{ route('stories') }}">সাকসেস স্টোরি</a></li>
                                            <li><a href="{{ route('trainer.details') }}">ট্রেইনারস</a></li>
                                            <li><a href="/#counseling">কাউনসিলিং</a></li>
                                            <li><a href="{{ route('seminar') }}">ফ্রি সেমিনার</a></li>
                                            {{-- <li><a href="#">আইটি সার্ভিসগুলো</a></li> --}}
                                            <li><a href="/#brands">আমরা যাদের সাথে কাজ করেছি</a></li>
                                        </ul>
                                    </div>
                                    <div class="sitemap_info">
                                        <h2 class="info_title">ব্লগ</h2>
                                        <ul>
                                            <li><a href="#">ব্লগ লিস্ট</a></li>
                                            <li><a href="#">ব্লগ ক্যাটাগরি</a></li>
                                        </ul>
                                    </div>
                                    <div class="sitemap_info">
                                        <h2 class="info_title">ব্লগ ডিটেইলস</h2>
                                        <ul>

                                        </ul>
                                    </div>
                                    <div class="sitemap_info">
                                        <h2 class="info_title">ফ্রি সেমিনার</h2>
                                        <ul>
                                            <li><a href="{{ route('seminar') }}">সেমিনার লিস্ট</a></li>
                                            <li><a href="{{ route('trainer.details') }}">কোর্স লিস্ট</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div>
                                    <div class="sitemap_info">
                                        <h2 class="info_title">আমাদের সম্পর্কে</h2>
                                        <ul>
                                            <li><a href="{{ route('about') }}">আমাদের সম্পর্কে</a></li>
                                            <li><a href="/#brands">আমরা যাদের সাথে কাজ করেছি</a></li>
                                            <li><a href="/about#our_moto">আমাদের মটো</a></li>
                                            <li><a href="/about#our_mission">আমাদের মিশন</a></li>
                                            <li><a href="/about#our_vision">আমাদের ভিশন</a></li>
                                            <li><a href="{{ route('courses') }}">কোর্স লিস্ট</a></li>
                                            <li><a href="{{ route('trainer.details') }}">আমাদের টিম</a></li>
                                            <li><a href="{{ route('trainer.details') }}">ট্রেইনারস</a></li>
                                        </ul>
                                    </div>
                                    <div class="sitemap_info">
                                        <h2 class="info_title">
                                            এফিলিয়েশন
                                        </h2>
                                        <ul>
                                            <li><a href="{{ route('affiliation.policy') }}">এফিলিয়েশন</a></li>
                                        </ul>
                                    </div>
                                    <div class="sitemap_info">
                                        <h2 class="info_title">যোগাযোগ</h2>
                                        <ul>
                                            <li><a href="/contact#jojajog_number">যোগাযোগ নাম্বার</a></li>
                                            <li><a href="/contact#submit_message">সাবমিট মেসেজ</a></li>
                                            <li><a href="/contact#our_location">অফিস লোকেশন</a></li>
                                            <li><a href="/contact#general_questions">সাধারণ জিজ্ঞাসা</a></li>
                                        </ul>
                                    </div>
                                    <div class="sitemap_info">
                                        <h2 class="info_title">টার্মস এন্ড কন্ডিশন</h2>
                                        <ul>
                                            <li><a href="{{ route('terms.policy') }}">টার্মস এন্ড কন্ডিশন</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div>
                                    <div class="sitemap_info">
                                        <h2 class="info_title">কোর্স লিস্ট</h2>
                                        <ul>
                                            <li><a href="{{ route('courses') }}">সকল কোর্স</a></li>
                                            <li><a href="#">গ্রাফিক্স ডিজাইন</a></li>
                                            <li><a href="#">ওয়েব ডেভোলাপমেন্ট</a></li>
                                            <li><a href="#">ডিজিটাল মার্কেটিং</a></li>
                                        </ul>
                                    </div>
                                    <div class="sitemap_info">
                                        <h2 class="info_title">কোর্স ডিটেইলস</h2>
                                        <ul>
                                            <li><a href="/course/ielts-daycare#course_details">কোর্স ডিটেইলস</a></li>
                                            <li><a href="#">কোর্স এনরোলমেন্ট</a></li>
                                            <li><a href="#">কোর্স মডিউল</a></li>
                                            <li><a href="#">কোর্স প্রশিক্ষক</a></li>
                                            <li><a href="#">সাধারণ জিজ্ঞাসা</a></li>
                                        </ul>
                                    </div>
                                    <div class="sitemap_info">
                                        <h2 class="info_title">রিফান্ড পলিসি</h2>
                                        <ul>
                                            <li>
                                                <a href="{{ route('refund.policy') }}">রিফান্ড পলিসি</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="sitemap_info">
                                        <h2 class="info_title">প্রাইভেসি পলিসি</h2>
                                        <ul>
                                            <li>
                                                <a href="{{ route('privacy.policy') }}">প্রাইভেসি পলিসি</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div>
                                    <div class="sitemap_info">
                                        <h2 class="info_title">গ্যালারি</h2>
                                        <ul>
                                            <li><a href="{{ route('trainer.details') }}">আমাদের টিম</a></li>
                                            <li><a href="#">ওরিয়েন্টেশন ক্লাস</a></li>
                                            <li><a href="#">ফেয়ারওয়েল ও সার্টিফিকেট প্রদান</a></li>
                                        </ul>
                                    </div>
                                    {{-- <div class="sitemap_info">
                                        <h2 class="info_title">আইটি সার্ভিস</h2>
                                        <ul>
                                            <li><a href="#">সার্ভিস লিস্ট</a></li>
                                            <li><a href="#">ক্লায়েন্ট রেটিং</a></li>
                                            <li><a href="#">আমরা যাদের সাথে কাজ করেছি</a></li>
                                            <li><a href="#">ক্লায়েন্ট প্রজেক্ট </a></li>
                                            <li><a href="#">Hire Us</a></li>
                                        </ul>
                                    </div> --}}
                                    {{-- <div class="sitemap_info">
                                        <h2 class="info_title">আইটি সার্ভিস ডিটেইলস</h2>
                                        <ul>
                                            <li><a href="#">সার্ভিস ডিটেইলস</a></li>
                                            <li><a href="#">প্রাইসিং প্ল্যানিং</a></li>
                                            <li><a href="#">ক্লায়েন্ট প্রজেক্ট </a></li>
                                            <li><a href="#">Hire Us</a></li>
                                        </ul>
                                    </div> --}}
                                    <div class="sitemap_info">
                                        <h2 class="info_title">কুকিস পলিসি</h2>
                                        <ul>'
                                            <li>
                                                <a href="{{ route('cookies.policy') }}">কুকিস পলিসি</a>
                                            </li>
                                        </ul>
                                    </div>
                                    {{-- <div class="sitemap_info">
                                        <h2 class="info_title">সার্টিফিকেট ভেরিফাই</h2>
                                        <ul></ul>
                                    </div> --}}
                                </div>
                            </div>
                            <div class="student_panel">
                                <div class="student_panel_heading">
                                    <h2 class="student_panel_title">স্টুডেন্ট প্যানেল</h2>
                                    <div class="student_panel_border"></div>
                                </div>
                                <div class="sitemap_details">
                                    <div>
                                        <div class="sitemap_info">
                                            <h2 class="info_title">হোম</h2>
                                            <ul>
                                                <li><a href="#">চলমান কোর্স</a></li>
                                                <li><a href="#">কমপ্লিট কোর্স</a></li>
                                                <li><a href="#">অসম্পন্ন কোর্স</a></li>
                                            </ul>
                                        </div>
                                        <div class="sitemap_info">
                                            <h2 class="continue_info_title">চলমান কোর্স</h2>
                                            <ul>
                                                <li><a href="#">কোর্সের অগ্রগতি</a></li>
                                                <li><a href="#">ক্লাস রুটিন</a></li>
                                                <li><a href="#">কোর্স মডিউল</a></li>
                                            </ul>
                                        </div>

                                    </div>
                                    <div>
                                        <div class="sitemap_info">
                                            <h2 class="info_title">প্রোফাইল সেটিংস</h2>
                                            <ul>

                                            </ul>
                                        </div>

                                    </div>
                                    <div>
                                        <div class="sitemap_info">
                                            <h2 class="info_title">পাসওয়ার্ড পরিবর্তন</h2>
                                            <ul>
                                            </ul>
                                        </div>

                                    </div>
                                    <div>
                                        <div class="sitemap_info">
                                            <h2 class="info_title">লগ আউট</h2>
                                            <ul>
                                            </ul>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /site map area end -->

                </div>

            </div>
        </div>

    </section>
@endsection
