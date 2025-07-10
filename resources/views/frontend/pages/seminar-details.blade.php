@php
    $meta = [
        'seo' => [
            'title' => 'seminar-details',
            'image' => asset('seo.jpg'),
        ],
    ];
@endphp
@extends('frontend.layouts.layout', $meta)
@section('contents')
    <section class="science_and_technology_area">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="science_and_technology_content">
                        <!-- title_area start -->
                        <div class="title_area">
                            <div class="title">
                                {{-- <p class="text">{{ strtoupper($blog->category[0]->title) ?? 0 }}</p> --}}
                                {{-- <p class="text">{{ $blog->category[0]->title ?? 0 }}</p> --}}
                            </div>
                            <div class="content_text">
                                <p class="text">{{ Str::title($seminar_detail->title) ?? '' }}</p>
                                {{-- <h2 class="text">{{ $blog->title }}</h2> --}}
                                
                            </div>
                        </div>
                        <!-- title_area end -->
        
                        <!-- title_image start -->
                        <div class="title_image">
                            <img src="/{{ $seminar_detail->poster }}" alt="tech park it">
                        </div>
        
                        <div class="timer seminar-time" style="margin-top: 20px;">
                            {{-- <h2>{{ Carbon\Carbon::parse($seminar_detail->date_time) }}</h2> --}}
                            {{-- <h2>{{ Carbon\Carbon::parse($seminar_detail->date_time)->diffForHumans() }}</h2> --}}
                            <h3>
                                <strong>
                                    <li class="d-none">
                                        <div class="amount" data-years></div>
                                        <div class="title">Years</div>
                                    </li>
                                    <li>
                                        <div class="amount" data-days></div>
                                        <div class="title" >days</div>
                                    </li>
                                    <li>
                                        <div class="amount" data-hours></div>
                                        <div class="title">hrs</div>
                                    </li>
                                    <li>
                                        <div class="amount" data-minutes></div>
                                        <div class="title">mins</div>
                                    </li>
                                    <li>
                                        <div class="amount" data-seconds></div>
                                        <div class="title" >secs</div>
                                    </li>
                                </strong>
                            </h3>
                            
        
                        </div>
        
                        <div class="" style="margin-top: 20px;">
                            {!! $seminar_detail->details  !!}
        
                        </div>
        
                        
                        <!--advantages_of_technology section_area end -->
                    </div>
                </div>
                {{-- <div class="col-lg-4">
                    <h3>Upcoming Seminars</h3>
                    @foreach ($seminars as $item)
                    <div class="date_line_area date_line_area_copy">

                        <div class="row">
                            <div class="col-lg-4">
                                <div class="join_button d-flex gap-3 my-2">
                                        <div class="promo-iframe">
                                            <img src="/{{ $item->poster }}" alt="">
                                        </div>
                                    </button>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                @php
                                    $date1 = \Carbon\Carbon::now(); 
                                    $date2 = \Carbon\Carbon::parse($item->date_time);
                                    $diff = $date1->diffInDays($date2);
                                @endphp

                                <div>
                                    <h4>{{ $item->title }}</h4>
                                </div>
    
                                <div class="date date_copy">
                                    <span class="date_number date_number_copy">{{$diff}}</span>
                                    <span class="date_text">দিন বাকী</span>
                                </div>
                            </div>
                        </div>

                    </div>
                    @endforeach 
                </div> --}}
            </div>
            
        </div>
    </section>

    <script src="/js/plugins/countdown.js"></script>
    <script>
        setTimeout(function(){
            timezz(document.querySelector('.timer'), {
                //'Dec 01, 2024 20:00:00' 
                date:`{{ Carbon\Carbon::parse($seminar_detail->date_time)->format('M d, Y h:i:s') }}`,
                pause: false,
                stopOnZero: true,
                beforeCreate() { },
                beforeUpdate() { },
                update(event) {},
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
        },300)
        
    </script>

@endsection
