@php
    $meta = [
        'seo' => [
            'title' => 'blog-details',
            'image' => asset('seo.jpg'),
        ],
    ];
@endphp
@extends('frontend.layouts.layout', $meta)
@section('contents')
    <section class="science_and_technology_area">
        <div class="container">
            <div class="science_and_technology_content">
                <!-- title_area start -->
                <div class="title_area">
                    <div class="title">
                        <p class="text">{{ strtoupper($blog->category[0]->title) ?? 0 }}</p>
                        {{-- <p class="text">{{ $blog->category[0]->title ?? 0 }}</p> --}}
                    </div>
                    <div class="content_text">
                        <h2 class="text">{{ $blog->title }}</h2>
                    </div>
                </div>
                <!-- title_area end -->

                <!-- title_image start -->
                <div class="title_image">
                    <img src="/{{ $blog->image }}" alt="tech park it">
                </div>
                {{-- @dd($blog->writer()) --}}
                {{-- <div>
                    <p>Posted By: <P>{{ $blog->writer[0]->title }}</P> </p>
                </div> --}}
                <!-- title_image end -->

                <div>
                    {!! $blog->description  !!}

                </div>
                <!--advantages_of_technology section_area end -->
            </div>
        </div>
    </section>
@endsection
