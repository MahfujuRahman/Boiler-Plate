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
<section class="my-2">
    <div class="container">

        {{-- @dd($quiz_submissions, $quiz) --}}
        @if (isset($quiz))
        <ul>
            <input type="hidden" value="{{ $quiz->id }}" name="quiz_id">
            @foreach ($quiz->questions as $question)
                <li>{{ $question->title }}</li>
                <li>
                    <ol style="list-style-type: lower-alpha;">
                        @foreach ($question->options as $option)
                            {{-- @dd($option, $question->user_submissions) --}}
                            <li class="quiz-submission-list my-1 {{ in_array($option->id, $question->user_submissions) ? 'list-user-sumssion-your-bg':'' }} ">
                                @if ($option->is_correct == 1)
                                    <i class="fa fa-check"></i>
                                @endif
                                <span>{{ $option->title }}</span>
                            </li>
                        @endforeach
                    </ol>
                </li>
                <li class="mb-4" style="list-style-type: none; margin-bottom: 40px;"></li>
            @endforeach
    
        </ul>   
        @endif 

    </div>
</section>


@endsection

<script type="text/javascript">

    $(function() {
        window.onbeforeunload = function() {
            return "Dude, are you sure you want to leave?";
        }
    });
    
</script>
