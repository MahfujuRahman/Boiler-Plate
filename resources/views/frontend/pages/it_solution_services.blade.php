@php
    $meta = [
        'seo' => [
            'title' => 'contact',
            'image' => asset('seo.jpg'),
        ],
    ];
@endphp
@extends('frontend.layouts.layout', $meta)
@section('contents')
    <!-- our_it_services_area start -->
    <section class="our_it_services_area d-block">
        <div class="container">
            <div class="my_it_service_area_content">
                <div class="our_it_services_heading_content">
                    <!--my_it_service_area_title start -->
                    <div class="my_it_service_area_title">
                        <h2 class="area_title">আমাদের আইটি সার্ভিসসমূহ</h2>
                    </div>
                    <!-- my_it_service_area end -->

                    <!-- my_it_service_area_sub_title start -->
                    <div class="my_it_service_area_sub_title">
                        <span class="sub_title">
                            আমাদের রয়েছেন দক্ষ ওয়েব ডেভোলাপার ও সাইভার সিকিউরিটি স্পেশালিস্ট
                            টিম আমরা ক্লায়েন্ট-কেন্দ্রিক ওয়েব ডিজাইন ও ডেভোলাপমেন্ট এবং
                            সাইভার সিকিউরিটি সার্ভিস প্রদান করি। আমরা নিন্মোক্ত সার্ভিসগুলো
                            প্রদান করি
                        </span>
                    </div>
                    <!-- my_it_service_area_sub_title end -->
                </div>

                <!-- service_area start -->
                <div class="service_area">
                    @include('frontend.pages.homepage_sections.it_services', [
                        'it_services' => $it_services,
                    ])
                </div>
                <!-- service_area end-->
            </div>
        </div>
    </section>
    <!-- our_it_services_area end-->

    <!-- our_services_achivement_area_start -->
    <div class="our_services_achivement_area">
        <div class="container">
            <div class="our_services_achivement_and_ratings">
                <div class="our_services_achivement">
                    <div class="achivement_title">
                        আমাদের প্রধাান লক্ষই থাকে ক্লায়েন্টের সন্তুষ্টি ফলে আমাদের
                        ক্লায়েন্টরা দীর্ঘ সময় ধরে আমাদের সাথে সংযুক্ত থাকেন এবং তাদের
                        প্রজেক্টের জন্য সবসময় আমাদের উপরে আস্থা রাখেন
                    </div>
                    <div class="client_project_ratings_achivement">
                        <div class="clients">
                            <span>120+ </span>
                            <p>ক্লায়েন্ট</p>
                        </div>
                        <div class="projects">
                            <span>৪৮০+ </span>
                            <p>প্রজেক্ট</p>
                        </div>
                        <div class="ratings">
                            <span>৯৬% </span>
                            <p>৫ স্টার রেটিং</p>
                        </div>
                    </div>
                </div>
                <div class="our_services_ratings">
                    <div class="rating_star">
                        <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                            class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                    </div>
                    <div class="rating_content">
                        <div class="rating_title">আফটার প্রজেক্ট সার্ভিস ভাল</div>
                        <div class="rating_info">
                            টেকপার্ক আইটি থেকে যতগুলো প্রজেক্ট করিয়েছি কখনো হতাশ হইনি, আফটার
                            সাপোর্ট খুব ভাল পেয়েছি
                        </div>
                    </div>
                    <div class="rating_client">
                        <div class="rating_client_name">সাকিবুর রহমান</div>
                        <div class="rating_client_company">
                            সিইউ, এবিসি কোম্পানি লিমিটেড
                        </div>
                    </div>
                </div>
            </div>
            <div class="aboutus_partner">
                <div class="container">
                    <div class="aboutus_partner_title">
                        <h3 class="aboutus_partner_title_text">
                            আমরা যাদের সাথে কাজ করেছি
                        </h3>
                    </div>
                    <div class="aboutus_partner_items_container">
                        <div class="items">
                            <div class="item">
                                <img src="{{ asset('frontend') }}/assets/images/about_page_image/partner_images/partner (6).png"
                                    alt="" />
                            </div>
                            <div class="item">
                                <img src="{{ asset('frontend') }}/assets/images/about_page_image/partner_images/partner (5).png"
                                    alt="" />
                            </div>
                            <div class="item">
                                <img src="{{ asset('frontend') }}/assets/images/about_page_image/partner_images/partner (4).png"
                                    alt="" />
                            </div>
                            <div class="item">
                                <img src="{{ asset('frontend') }}/assets/images/about_page_image/partner_images/partner (3).png"
                                    alt="" />
                            </div>
                            <div class="item">
                                <img src="{{ asset('frontend') }}/assets/images/about_page_image/partner_images/partner (2).png"
                                    alt="" />
                            </div>
                            <div class="item">
                                <img src="{{ asset('frontend') }}/assets/images/about_page_image/partner_images/partner (1).png"
                                    alt="" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /our_services_achivement_area_end -->

    <!-- our client project starts -->
    {{-- <div class="our_complete_client_projects">
    <div class="container">
        <div class="client_project_title">আমাদের করা কিছু ক্লায়েন্ট প্রজেক্ট</div>
        
        <div class="our_client_projects">
            @include('frontend.pages.homepage_sections.it_services', [
                'it_services' => $it_services,
            ])
        </div>
    </div>
</div> --}}
    <section class="my_it_service_area mt-0"
        style="background-image: url({{ asset('frontend') }}/assets/images/home_page_image/ti_service/bg_img.png);">
        <div class="container">
            <div class="my_it_service_area_content">

                <!--my_it_service_area_title start -->
                <div class="my_it_service_area_title mb-5">
                    <h2 class="area_title">
                        আমাদের করা কিছু ক্লায়েন্ট প্রজেক্ট
                    </h2>
                </div>
                <!-- my_it_service_area end -->
                <!-- my_it_service_area_sub_title end -->

                <!-- service_area start -->
                <div class="service_area">
                    @include('frontend.pages.homepage_sections.it_services', [
                        'it_services' => $it_services,
                    ])
                </div>
                <!-- service_area end-->
            </div>
        </div>
    </section>
    <!-- /our client project end -->

    <!-- hire section start -->
    <section class="hire_area">
        <div class="container">
            <div class="hire_details">
                <div class="hire_content_and_btn">
                    <div class="hire_title">
                        <h2 class="hire_title_bangla">
                            আপনার কোন প্রজেক্টের জন্য আমাদেরকে Hire করুন
                        </h2>
                        <p>
                            আপনার কোন প্রজেক্ট থাকলে আমাদেরকে হারার করতে পারেন, আমাদের রয়েছে
                            কমপ্লিট ফ্রন্টএন্ড ও ব্যাকএন্ড টিম ও এসইও স্পেসালিস্ট
                        </p>
                    </div>
                    <div class="hire_btn">Hire us</div>
                </div>
            </div>
        </div>
    </section>
    <!-- /hire section end -->
@endsection
