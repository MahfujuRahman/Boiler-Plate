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
<div class="masterstudy-course-player-content__wrapper">
    <div class="masterstudy-course-player-content__header masterstudy-course-player-content__header_quiz">
        <span class="masterstudy-course-player-content__header-lesson-type"></span>
        <h1>Successfully Done!</h1>
    </div>

    @if (isset($quiz))
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
                                        name="submission[{{ $question->id }}][]" 
                                        value="{{ $option->id }}"
                                        {{ $option->is_correct == 1 ? 'checked': '' }}>
                                {{ $option->title }}
                            </label>
                        </li>
                    @endforeach
                </ul>
            </li>
            <li class="mb-4" style="list-style-type: none; margin-bottom: 40px;"></li>
        @endforeach

    </ul>    

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h3>
                    <p class="text-success text-center">
                        You got 
                        <span class="bg-green text-danger"> {{ $total }} </span> in this quiz out of 
                        <span class="text-danger"> {{ $quiz_counts }} </span>. 
                            Wish you good luck next time!.
                    </p>
                </h3>
            </div>
        </div>
    </div>

    @endif




    @if (isset($user))
        {{-- @dd($user->quizes) --}}
        @foreach ($user->quizes as $quiz)
            @foreach ($quiz->questions as $question)

                <li>{{ $question->title }}</li>
                <li style="list-style-type: none">
                    <ul>
                        @foreach ($question->options as $option)
                            <li>
                                <label for="option{{ $option->id }}">
                                    <input type="checkbox" id="option{{ $option->id }}" 
                                            {{ $option->is_correct == 1 ? 'checked': '' }}>
                                    {{ $option->title }}
                                </label>
                            </li>
                        @endforeach
                    </ul>
                </li>
                <li class="mb-4" style="list-style-type: none; margin-bottom: 40px;"></li>

            @endforeach
        @endforeach
    @endif

</div>

@endsection

<script type="text/javascript">

    $(function() {
        window.onbeforeunload = function() {
            return "Dude, are you sure you want to leave?";
        }
    });
    
</script>
