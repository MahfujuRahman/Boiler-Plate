@php
    $meta = [
        'seo' => [
            'title' => 'gallery',
            'image' => asset('seo.jpg'),
        ],
    ];
@endphp
@extends('frontend.layouts.layout', $meta)
@section('contents')
    <!-- my_tema_area start -->
    <section>
        <div class="container">
            <div class="our_course_area pb-0 mt-4">
                <div class="our_course_area_content pb-0">
                    <div class="course_schedule_name">
                        <ul class="flex-wrap pt-4 gallery_nav">
                            <li>
                                <a href="?page=1"
                                    class="{{ !request()->has('gallery_category_id') ? ' active' : ' ' }}">
                                        সকল কোর্স
                                </a>
                            </li>
                            @php
                                $galleryCategories = \App\Models\GalleryCategory::where('status', 'active')->get();
                            @endphp
                            @foreach ($galleryCategories as $gcat)
                                <li>
                                    <a href="?gallery_category_id={{ $gcat->id }}&page=1"
                                        class="{{ request()->has('gallery_category_id') && request()->get('gallery_category_id') == $gcat->id ? ' active' : '' }}
                                            
                                        ">
                                        {{ $gcat->title }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="my_tema_area all_area mt-4">
        <div class="container">
            <div class="gallery_area">
                {{-- <div class="gallery_title">
                    <p class="title">আমাদের টিম</p>
                </div> --}}
                <div class="gallery_content">
                    @foreach ($galleryImages as $gmat)
                        {{-- <li><a href="">{{ $gmat->title }}</a></li>     --}}
                        <div class="gallery_content_img">
                            <img src="{{ $gmat->image }}" alt="{{ $gmat->title }}">
                        </div>
                    @endforeach

                </div>
            </div>
            <div class="mt-4">

                {!! $galleryImages->links() !!}
            </div>
    </section>
    <!-- my_tema_area end-->
@endsection
