    {{-- <div class="course_card_area">
        @foreach ($course_speciality as $course_item)
            <div class="c_card card_1">
                <div class="card_img_area">
                    <img src="{{ asset($course_item->image) }}" alt="card tech park it">
                </div>
            </div>
        @endforeach
    </div> --}}

    {{-- <div class="course_carousel_wrapper">
        <button class="prev-btn">&lt;</button>
        <div class="scrolling-wrapper">
            <div class="scrolling-content">
                @foreach ($course_speciality as $course_item)
                    <div class="scroll-item">
                        <div class="card_img_area">
                            <img src="{{ asset($course_item->image) }}" alt="Course Image">
                        </div>
                    </div>
                @endforeach
                @foreach ($course_speciality as $course_item)
                    <div class="scroll-item">
                        <div class="card_img_area">
                            <img src="{{ asset($course_item->image) }}" alt="Course Image">
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <button class="next-btn">&gt;</button>
    </div>

    <style>
        .course_carousel_wrapper {
            position: relative;
            width: 100%;
            overflow: hidden;
            padding: 10px 0;
            display: flex;
            align-items: center;
        }

        .scrolling-wrapper {
            width: 100%;
            overflow-x: auto;
            display: flex;
            justify-content: center;
            scroll-behavior: smooth;
            scrollbar-width: none;
            -ms-overflow-style: none;
        }

        .scrolling-wrapper::-webkit-scrollbar {
            display: none;
        }

        .scrolling-content {
            display: flex;
            gap: 15px;
            width: max-content;
            transition: transform 0.3s ease-in-out;
        }

        .scroll-item {
            flex: 0 0 auto;
            width: 80%;
            max-width: 250px;
            scroll-snap-align: center;
        }

        .scroll-item img {
            width: 100%;
            height: auto;
            border-radius: 10px;
        }

        .prev-btn,
        .next-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background-color: rgba(0, 0, 0, 0.5);
            color: white;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            font-size: 18px;
            border-radius: 50%;
            z-index: 10;
            display: none;
        }

        .prev-btn {
            left: 10px;
        }

        .next-btn {
            right: 10px;
        }


        @media (min-width: 768px) {
            .scroll-item {
                width: calc(33.33% - 15px);
            }

            .prev-btn,
            .next-btn {
                display: block;
            }
        }
    </style>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const scrollingWrapper = document.querySelector(".scrolling-wrapper");
            const scrollingContent = document.querySelector(".scrolling-content");
            const prevBtn = document.querySelector(".prev-btn");
            const nextBtn = document.querySelector(".next-btn");

            let scrollAmount = scrollingContent.children[0].offsetWidth + 15;

            // Scroll on button click
            prevBtn.addEventListener("click", () => {
                scrollingWrapper.scrollBy({
                    left: -scrollAmount,
                    behavior: "smooth"
                });
            });

            nextBtn.addEventListener("click", () => {
                scrollingWrapper.scrollBy({
                    left: scrollAmount,
                    behavior: "smooth"
                });
            });

            // Mobile swipe gesture
            let isDown = false;
            let startX, scrollLeft;

            scrollingWrapper.addEventListener("mousedown", (e) => {
                isDown = true;
                startX = e.pageX - scrollingWrapper.offsetLeft;
                scrollLeft = scrollingWrapper.scrollLeft;
            });

            scrollingWrapper.addEventListener("mouseleave", () => {
                isDown = false;
            });
            scrollingWrapper.addEventListener("mouseup", () => {
                isDown = false;
            });
            scrollingWrapper.addEventListener("mousemove", (e) => {
                if (!isDown) return;
                e.preventDefault();
                const x = e.pageX - scrollingWrapper.offsetLeft;
                const walk = (x - startX) * 2;
                scrollingWrapper.scrollLeft = scrollLeft - walk;
            });

            scrollingWrapper.addEventListener("touchstart", (e) => {
                startX = e.touches[0].clientX;
                scrollLeft = scrollingWrapper.scrollLeft;
            });

            scrollingWrapper.addEventListener("touchmove", (e) => {
                const x = e.touches[0].clientX;
                const walk = (x - startX) * 2;
                scrollingWrapper.scrollLeft = scrollLeft - walk;
            });
        });
    </script> --}}


    <div class="owl-carousel course_speciality">
        @foreach ($course_speciality as $course_item)
            <div class="c_card">
                <div class="card_img_area">
                    <img src="{{ asset($course_item->image) }}" alt="card tech park it">
                </div>
            </div>
        @endforeach
    </div>

    <script>
        $('.owl-carousel.course_speciality').owlCarousel({
            loop: true,
            margin: 10,
            nav: true,
            autoplay: true,
            autoplayTimeout: 2000, // 1 second
            responsive: {
                0: {
                    items: 1
                },
                800: {
                    items: 2
                },
                1000: {
                    items: 3
                }
            }
        });
    </script>
