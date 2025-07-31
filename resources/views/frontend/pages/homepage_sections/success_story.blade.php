<section class="student_success_history_area">
    <div class="container">
        <div class="student_success_history_content">

            <!--student_success_history_area_title start -->
            <div class="student_success_history_area_title">
                <h2 class="area_title">
                    {{-- শিক্ষার্থীদের সাকসেস স্টোরি --}}
                    শিক্ষার্থীদের স্টোরি
                </h2>
            </div>
            <!-- student_success_history_area_title end -->

            <!-- student_success_history_area_sub_title start -->
            <div class="student_success_history_area_sub_title">
                <span class="sub_title">
                    আমাদের শিক্ষার্থীদের পারফরমেন্স
                </span>
                {{-- <span class="sub_title">
                    আমাদের শিক্ষার্থীদের মুখ থেকেই শুনুন তাদের সফলতার গল্প
                </span> --}}
            </div>
            <!-- student_success_history_area_sub_title end -->

            <!-- student_success_video_area start -->
            <div class="student_success_video_area">
                @foreach ($success_stories as $story)
                    <button class="success_video_area" onclick="showVideo(`{{$story->video_link}}`)">
                        <div class="success_video_cover_photo">
                            <img class="img-fluid" src="{{ asset($story->thumbnail_image) }}"
                                alt="video_img tech park it">
                        </div>
                        <div class="video_button_icon">
                            <!-- <i class="fa-solid fa-circle-play"></i> -->
                            <i class="fa-solid fa-play"></i>
                        </div>
                    </button>
                @endforeach

            </div>
            <!-- student_success_video_area end -->

            <!-- student_success_history_area_button start-->
            <div class="success_history_button_area">
                <a href="{{ route('stories') }}" class="button_all">
                    <span class="btn_text">আরও দেখুন</span>
                    <span class="btn_icon"><i class="fa-solid fa-arrow-right"></i></span>
                </a>
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
            <!-- student_success_history_area_button end-->

        </div>
    </div>
</section>
