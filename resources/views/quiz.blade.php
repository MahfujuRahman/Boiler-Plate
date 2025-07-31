<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <form action="qsubmit" method="POST">
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
        <button>submit</button>
    </form>
</body>

</html>
