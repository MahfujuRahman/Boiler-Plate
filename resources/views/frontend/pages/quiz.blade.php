@php
    $meta = [
        // "meta" => [],
        'seo' => [
            'title' => 'Quiz',
            'image' => asset('seo.jpg'),
        ],
    ];
@endphp
@extends('frontend.layouts.layout', $meta)
@section('contents')

<div class="course_quize_and_module_part" id="course_section">
    <div class="container">
        <div class="">
            <h3 class="mb-2">Quiz: </h3>
            <div class="row">
                <div class="col-md-5">
                    <h5 class="mb-3"><b> </b></h5>
                    {{-- <form action="{{ route('quiz_submit') }}" method="POST">
                        @csrf
                        <ul>
                            <input type="hidden" value="{{ $quiz->id }}" name="quiz_id">
                            @foreach ($quiz->questions as $question)
                                <li>{{ $question->title }}</li>
                                <li>
                                    <ul>
                                        @foreach ($question->options as $option)
                                            <li>
                                                <label for="option{{ $option->id }}">
                                                    {{ $option->id }}.
                                                    <input type="checkbox" id="option{{ $option->id }}"
                                                        name="submission[{{ $question->id }}][]" value="{{ $option->id }}">
                                                    {{ $option->title }}
                                                </label>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                                <li class="mb-4" style="list-style-type: none; margin-bottom: 40px;"></li>
                            @endforeach
                        </ul>
                        <button class="btn btn-success">Submit</button>
                    </form> --}}
                </div>

                <div class="class="col-md-5">

                    <table class="table table-bordered table-hover text-center">
                        <thead>
                            <tr>
                                <td>#</td>
                                <td>Title</td>
                                <td>Status</td>
                                <td>Mark</td>
                                <td>Actions</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($quizes as $key=>$quiz)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $quiz->title }}</td>
                                <td> Status</td>
                                <td>Mark</td>
                                <td>
                                    <a href="{{ route('website.quiz_attend', $quiz->id) }}" class="btn btn-outline-secondary">
                                        <i class="fa text-warning fa-pencil mr-2"></i>
                                        <span>Attend Quiz</span>
                                    </a>
                                    <a href="{{ route('website.quizes.details', $quiz->id) }}" class="btn btn-outline-primary">
                                        <i class="fa text-info fa-eye mr-2"></i>
                                        <span>Details</span>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>



                </div>

                {{-- <div class="col-md-7">
                    <div class="course_lession_video_btn">
                        <div class="course_lession_video">
                            <div class="course_lession_video_thum">
                                <iframe id="class_video_link" width="100%" height="450"
                                    src="https://www.youtube.com/embed/oakcMR7BzTk?si=tjMD3j4srWgDXMVE"
                                    title="YouTube video player" frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture;"
                                    allowfullscreen>
                                </iframe>
                            </div>
                        </div>

                        <div class="course_lession_video_next_btn">
                            <div class="next_btn">
                                নেক্সট লেসন <i class="fa-solid fa-angle-right"></i>
                            </div>
                        </div>
                    </div>
                </div> --}}

            </div>
        </div>
    </div>
</div>

<script>
    [...document.querySelectorAll(".class_module_acordion_icon")].forEach(
        (el) => {
            el.onclick = function(e) {
                e.currentTarget.parentNode.parentNode.classList.toggle("active");
                console.log(e.currentTarget);
            };
        }
    );
    function getClassVideolink(link) {
        console.log(link);
        document.getElementById('class_video_link').src = link;
        document.getElementById("course_section").scrollIntoView();
    }
</script>
@endsection
