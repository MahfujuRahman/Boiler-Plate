<section class="course_item">
    <div class="container">
        <div class="course_item_content">
            @foreach ($categories as $key => $cat)
                <div class="course item_{{ $key + 1 }}">
                    <a href="#">
                        <img src="{{ asset($cat->image) }}" alt="">
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>
