@php
$meta = [
    "seo" => [
        "title" => "blog",
        "image" => asset('seo.jpg'),
    ]
];
@endphp

@extends('frontend.layouts.layout',$meta)
@section('contents')
 <!-- blog area start -->
 <div class="science_and_technology">
    <div class="container">

        <!-- science_and_technology_content start -->
        <div class="science_and_technology_content">
            <div class="science_and_technology_text_area">
                <div class="title">
                    <p class="text">{{ $blog_single->category->title ?? '' }}</p>
                </div>
                <div class="content_text">
                    {{-- 
                        <h2 class="text">টেকটক: ২০২৩ সালে প্রযুক্তির সাম্প্রতিক ট্রেন্ডস এবং উন্নয়নগুলি</h2> 
                    --}}
                    <h2 class="text">{{ $blog_single->title }}</h2>
                </div>
                <div class="sub_content_text_and_button">
                    <div class="sub_content_text">
                        {{-- 
                            <p class="text">প্রযুক্তির জগতে স্বাগতম! আজকের দ্রুত-গতির বিশ্বে, প্রযুক্তি দ্রুত গতিতে
                            বিকশিত
                            হচ্ছে, এবং সর্বশেষ প্রবণতা এবং অগ্রগতি সম্পর্কে আপডেট থাকা অপরিহার্য। এই ব্লগে,
                            আমরা প্রযুক্তির বিশ্বের সর্বশেষ উন্নয়ন এবং প্রবণতাগুলি অন্বেষণ করব।</p> 
                        --}}
                        <p class="text">{{ $blog_single->short_description }}</p>
                    </div>
                    <a href="{{ route('blog_details', $blog_single->slug) }}" class="button_all">
                        আরো পড়ুন
                    </a>
                </div>
            </div>
            <div class="science_and_technology_img_area">
                {{-- <img class="blog_img" src="{{ asset('frontend') }}/assets/images/blog_page_image/blog.png" alt="tech park it"> --}}
                <img class="blog_img" src="/{{ $blog_single->image }}">

                <img class="color_image_left" src="{{ asset('frontend') }}/assets/images/blog_page_image/color1.png" alt="tech park it">

                <img class="color_image_right" src="{{ asset('frontend') }}/assets/images/blog_page_image/color2.png" alt="tech park it">
            </div>
        </div>
        <!-- science_and_technology_content end -->

        <!-- blog nav bar area start -->
        <div class="blog_nav">
            <ul>
                <li>
                    <a href="{{ route('blog') }}">সব</a>
                </li>
                @foreach ($blog_categories as $category)    
                    <li>
                        <a href="{{ route('blog') }}">{{ $category->title }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
        <!-- blog nav bar area end -->

        <!-- blog list area start -->
        <div class="blog_list">

            <!-- blog start -->
            @foreach ($blogs as $blog)
                <div class="blog">

                    <div class="blog_image_and_image_button_area">
                        <div class="blog_image">
                            <img src="/{{ $blog->image }}" alt="tech_park_it">
                        </div>
                        {{-- 
                            <div class="img_button">
                                <a href="#">{{ $blog->category[0]->title }}</a>
                            </div> 
                        --}}
                    </div>

                    {{-- 
                        <div class="extra_rite_area">
                            <img src="{{ asset('frontend') }}/assets/images/blog_page_image/bg.png" alt="tech park it">
                        </div> 
                    --}}

                    <div class="blog_text_content">
                        <div class="day_and_time">
                            <span class="day_text">{{ $blog->created_at->diffForHumans() }} | </span>
                           
                            <span class="min_text">{{ rand(6, 15) }} min. to read </span>
                        </div>
                        <div class="text_title">
                            <a href="{{ route('blog_details', $blog->slug) }}">
                                <h2 class="title">{{ $blog->title }}</h2>
                            </a>
                        </div>
                        <div class="text_sub_title">
                            <p class="sub_title">
                                {{-- 
                                    {{ \Str::limit($blog->short_description, 100) }}
                                    
                                    প্রযুক্তির জগতে স্বাগতম! আজকের দ্রুত-গতির বিশ্বে, প্রযুক্তি দ্রুত গতিতে
                                    বিকশিত হচ্ছে, এবং সর্বশেষ প্রবণতা [...] 
                                --}}
                            </p>
                        </div>
                    </div>

                </div>
            @endforeach
            <!-- blog end -->

        </div>
        <!-- blog list area end -->

        <!-- next_page_button_area start -->
        <div class="next_page_button_area">
            {{ $blogs->links() }}
        </div>
        <!-- next_page_button_area end -->

        <!-- subscribe_area_start -->
        <section class="subscribe_area">
            <div class="subscribe_area_title">
                <h2 class="title">ব্লগ আপডেট পেতে সাবস্ক্রাইব করুন</h2>
            </div>
            <div class="subscribe_area_sub_title">
                <p class="sub_title">আপনার নতুন ব্লগ সম্পর্কে নিয়মিত আপডেট পেতে আমাদের নিউজলেটারে সাবস্ক্রাইব করুন</p>
            </div>
            <!-- subscribe_form_area start -->
            <form action="#">
                <div class="subscribe_form_area">
                    <input type="text" placeholder="mail@yourmail.com">
                    <button type="button" class="subscribe_button">Subscribe Us</button>
                </div>
            </form>
              <!-- subscribe_form_area end -->

        </section>
        <!-- subscribe_area_end -->

    </div>
</div>
<!-- blog area end -->
@endsection

