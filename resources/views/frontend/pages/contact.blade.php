@php
$meta = [
    "seo" => [
        "title" => "contact",
        "image" => asset('seo.jpg'),
    ]
];
@endphp
@extends('frontend.layouts.layout',$meta)
@section('contents')
<!-- contact area start -->
<section class="contact_area">
    <div class="container">
        <div class="contact_area_content">

            <!-- title start -->
            <div class="title">
                <!--contact_area title start -->
                <div class="contact_area_title">
                    <h2 class="area_title">
                        যোগাযোগ
                    </h2>
                </div>
                <!-- contact_area title end -->

                <!-- contact_area sub_title start -->
                <div class="contact_area_sub_title">
                    <span class="sub_title">
                        যে কোনো প্রয়োজনে যোগাযোগ করতে সরাসরি আমাদের অফিস ভিজিট করতে পারেন। তাছাড়া আমাদেরকে কল করে
                        জেনে নিতে পারেন
                        কোর্স সংক্রান্ত যেকোনো তথ্য। এছাড়াও উল্লেখিত মেইলে কিংবা ফেসবুক ম্যাসেঞ্জারেও নক দিতে
                        পারেন।
                    </span>
                </div>
                <!-- contact_area sub_title end -->
            </div>
            <!-- title end -->

            <!-- phone_number_and_form_area start -->
            <div class="phone_number_and_form_area">
                <div class="row">
                    <div class="col-xs-12 col-md-6">
                        <div class="left_area">
                            <!-- contact_title start -->
                            <div class="contact_title">
                                <h2 class="title_text">যোগাযোগ করুন</h2>
                            </div>
                            <!-- contact_title end -->

                            <!-- contact_number_and_email_area start -->
                            <ul class="contact_number_and_email_area" id="jojajog_number">
                                {{-- @dd(setting(key: 'phone_numbers', multiple: true)) --}}
                                @foreach (setting(key: 'phone_numbers', multiple: true) as $item)
                                <li>
                                    <a href="tel:{{ $item->value }}" class="contact">
                                        <div class="logo phone">
                                            <i class="fa-solid fa-phone"></i>
                                        </div>
                                        <div class="number">
                                            <p class="text"> {{ $item->value }} </p>
                                        </div>
                                    </a>
                                </li>    
                                @endforeach
                                
                                <li>
                                    <a href="https://wa.me/{{ setting(key: 'whatsapp') }}" target="_blank" class="contact">
                                        <div class="logo whatsapp">
                                            <i class="fa-brands fa-square-whatsapp"></i>
                                        </div>
                                        <div class="number">
                                            <p class="text"> {{ setting(key: 'whatsapp') }} </p>
                                        </div>
                                    </a>
                                </li>

                                <li>
                                    <a href="{{ setting(key: 'telegram') }}" target="_blank" class="contact">
                                        <div class="logo telegram">
                                            <i class="fa-brands fa-telegram"></i>
                                        </div>
                                        <div class="number">
                                            <p class="text"> Join Telegram </p>
                                        </div>
                                    </a>
                                </li>

                                @foreach (setting(key: 'emails', multiple: true) as $item)
                                <li>
                                    <a href="mailto:{{ $item->value }}" target="_blank" class="contact">
                                        <div class="logo email">
                                            <i class="fa-regular fa-envelope"></i>
                                        </div>
                                        <div class="number email_address">
                                            <p class="text"> {{ $item->value }} </p>
                                        </div>
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                            <!-- contact_number_and_email_area end -->

                            <!-- social_media_area start -->
                            <div class="social_media_area">
                                <div class="social_media_title">
                                    <h2 class="text">আমাদের সোসাল মিডিয়া লিংক</h2>
                                </div>

                                <div class="social_media">
                                    <ul>
                                        <li>
                                            <a href="{{ setting(key: 'facebook') }}" class="facebook">
                                                <i class="fa-brands fa-square-facebook"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ setting(key: 'instagram') }}" class="instagram">
                                                <i class="fa-brands fa-square-instagram"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ setting(key: 'youtube') }}" class="youtube">
                                                <i class="fa-brands fa-youtube"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ setting(key: 'linkedin') }}" class="linkedin-in">
                                                <i class="fa-brands fa-linkedin-in"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ setting(key: 'twitter') }}" class="twitter">
                                                <i class="fa-brands fa-twitter"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- social_media_area end -->
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-6" id="submit_message">
                        <div class="right_area">
                            <!-- contact_form_title start -->
                            <div class="contact_form_title">
                                <h2 class="title_text">আমাদেরকে ইনবক্স করুন</h2>
                            </div>
                            <!-- contact_form_title end -->
                            {{-- @dd(setting(key: 'facebook')) --}}
                            <!-- form_area start -->
                            <form action="{{ route('contact_submit') }}" method="POST">
                                @csrf
                                <input class="form_item" type="text" name="full_name" placeholder="আপনার নাম *">
                                <span class="help-block">
                                    <strong>{{ $errors->first('full_name') }}</strong>
                                </span>

                                <input class="form_item" type="email" name="email" placeholder="আপনার ইমেইল *">
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>

                                <input class="form_item" type="text" name="subject" placeholder="সাবজেক্ট *">
                                <span class="help-block">
                                    <strong>{{ $errors->first('subject') }}</strong>
                                </span>

                                <textarea class="form_item" name="message" id="#" placeholder="লিখুন"></textarea>
                                <span class="help-block">
                                    <strong>{{ $errors->first('message') }}</strong>
                                </span>

                                <button class="form_button">সাবমিট করুন</button>
                            </form>
                            <!-- form_area end -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- phone_number_and_form_area end -->

            <div id="our_location">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6273.359495691301!2d90.35832709340083!3d23.810338175583812!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c1670cdb1779%3A0x645bbf4f0aeb1d56!2sTech%20Park%20IT!5e0!3m2!1sen!2sbd!4v1689726025832!5m2!1sen!2sbd"
                    width="100%" height="500" style="border: 1px solid #D2D2D2; border-radius: 4px;" allowfullscreen=""
                    loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
            <!-- map start -->
            
            <!-- map end -->

            <!-- general question area start-->
            <section class="general_question_area" id="general_questions">
                <!-- title start -->
                <div class="question_title">
                    <div class="general_question_title">
                        <h2 class="text">সাধারণ জিজ্ঞাসা</h2>
                    </div>
                    <div class="general_question_sub_title">
                        <p class="sub_text">আপনার কোন জিজ্ঞাসা থাকলে এখান থেকে খুঁজে দেখতে পারেন</p>
                    </div>
                </div>
                <!-- title end -->

                <!-- question_and_ans area start -->
                <div class="question_and_ans_area">
                    <!-- question_area start -->
                    <div class="question_area">
                        <div class="question">
                            <p class="q_text">আপনাদের এখানে ইন্টার্নের সুজোগ আছে?</p>
                        </div>
                        <div class="question_icon">
                            <i class="fa-solid fa-angle-down"></i>
                        </div>
                    </div>
                    <!-- question_area end -->

                    <!-- ans_area start -->
                    <div class="ans_area">
                        <p class="a_text">আমরা সকল ক্লাসের রেকর্ডেড ভিডিও সরবরাহ করি, আপনি আপনার স্টুডেন্ট পোর্টাল
                            থেকে আপনার কোর্সের সকল ক্লাসের
                            রেকর্ডেড ভিডিও পাবেন।</p>
                    </div>
                    <!-- ans_area end -->
                </div>
                <!-- question_and_ans area end -->

                 <!-- question_and_ans area start -->
                 <div class="question_and_ans_area">
                    <!-- question_area start -->
                    <div class="question_area">
                        <div class="question">
                            <p class="q_text">আপনাদের এখানে ইন্টার্নের সুজোগ আছে?</p>
                        </div>
                        <div class="question_icon">
                            <i class="fa-solid fa-angle-down"></i>
                        </div>
                    </div>
                    <!-- question_area end -->

                    <!-- ans_area start -->
                    <div class="ans_area">
                        <p class="a_text">আমরা সকল ক্লাসের রেকর্ডেড ভিডিও সরবরাহ করি, আপনি আপনার স্টুডেন্ট পোর্টাল
                            থেকে আপনার কোর্সের সকল ক্লাসের
                            রেকর্ডেড ভিডিও পাবেন।</p>
                    </div>
                    <!-- ans_area end -->
                </div>
                <!-- question_and_ans area end -->

                 <!-- question_and_ans area start -->
                 <div class="question_and_ans_area">
                    <!-- question_area start -->
                    <div class="question_area">
                        <div class="question">
                            <p class="q_text">আপনাদের এখানে ইন্টার্নের সুজোগ আছে?</p>
                        </div>
                        <div class="question_icon">
                            <i class="fa-solid fa-angle-down"></i>
                        </div>
                    </div>
                    <!-- question_area end -->


                </div>
                <!-- question_and_ans area end -->

                 <!-- question_and_ans area start -->
                 <div class="question_and_ans_area">
                    <!-- question_area start -->
                    <div class="question_area">
                        <div class="question">
                            <p class="q_text">আপনাদের এখানে ইন্টার্নের সুজোগ আছে?</p>
                        </div>
                        <div class="question_icon">
                            <i class="fa-solid fa-angle-down"></i>
                        </div>
                    </div>
                    <!-- question_area end -->

                </div>
                <!-- question_and_ans area end -->

            </section>
            <!-- general question area end-->


        </div>
    </div>
</section>
<!-- contact area end -->
@endsection

