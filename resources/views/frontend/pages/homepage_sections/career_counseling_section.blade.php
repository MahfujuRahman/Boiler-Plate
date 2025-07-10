<section class="job_career_area">
    <div class="container">
        <div class="job_career_area_content">
            <div class="row">
                <!-- left_area start -->
                <div class="col-xs-12 col-md-6">
                    <div class="left_area">
                        <!--job_career_area title start -->
                        <div class="job_career_area_title">
                            <h2 class="area_title">
                                আপনার জব ক্যারিয়ার নিয়ে চিন্তিত?
                            </h2>
                        </div>
                        <!-- job_career_area title end -->
                        <!-- job_career_image start -->
                        <div class="job_career_image">
                            <img 
                                src="{{ asset('frontend') }}/assets/images/home_page_image/job_career_area/img.png" alt="job_career tech park it">
                        </div>
                        <!-- job_career_image end -->
                    </div>
                </div>
                <!-- left_area end -->

                <!-- right_area start -->
                <div class="col-xs-12 col-md-6" id="counseling">
                    <div class="right_area">
                        <!-- form_area start -->
                        <div class="form_area">
                            <!-- form_area_sub_title start -->
                            <div class="form_area_sub_title">
                                <p class="sub_title">
                                    আমাদের সাথে এপয়েন্টমেন্ট বুক করুন, আমরা আপনাকে ক্যারিয়ার সংক্রান্ত পরামর্শ দিব
                                </p>
                            </div>
                            <!-- form_area_sub_title end -->

                            <!-- form stat -->
                            <form action="{{ route('career.counseling') }}" method="POST" id="career_counsel">
                                @csrf
                                <input type="text" name="name" id="name" placeholder="আপনার নাম *">
                                <div class="error-message" id="nameError"></div>

                                <input type="email" name="email" id="email" placeholder="আপনার ইমেইল *">
                                <div class="error-message" id="emailError"></div>

                                <input type="tel" name="phone" id="phone" placeholder="আপনার ফোন নাম্বার">
                                <div class="error-message" id="phoneError"></div>

                                <textarea name="description" id="description" cols="20" rows="10" placeholder="বিস্তারিত লিখুন"></textarea>
                                <div class="error-message" id="descriptionError"></div>

                                <select class="form-select m-bottom" name="category" id="category">
                                    <option value="ielts">IELTS</option>
                                    <option value="spoken english">Spoken English</option>
                                    <option value="higher study">Higher Study</option>
                                </select>
                                <div class="error-message" id="categoryError"></div>

                                <button type="submit" class="button_all">
                                    <i class="fa-solid fa-arrow-up-right-from-square"></i>
                                    <span> সাবমিট করুন</span>
                                </button>
                            </form>
                            <!-- form end -->
                        </div>
                        <!-- form_area end -->
                    </div>
                </div>
                <!-- right_area  -->

            </div>
        </div>
    </div>
</section>

<script>
$(function () {

    $('#career_counsel').submit(function (e) {

        e.preventDefault();
        var formdata = new FormData(this);
        // console.log(formdata);
        var target = event.target;

        fetch(event.target.action, {
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: new FormData(event.target)
        })
        // .then(res => res.json())
        .then(response => {
            if (!response.ok) {
                return response.json().then(errorData => {
                    throw errorData;
                });
            }
            return response.json();
        })
        .then(data => {
            // Handle success
            console.log('Success:', data);
            // document.querySelector('#successMessage').textContent = data.message;
            target.reset();
            Swal.fire({
                position: "top-end",
                // position: "center",
                icon: "success",
                title: "Successful!",
                text: "Successfully Done!",
                showConfirmButton: false,
                timer: 2000
            });
        })
        .catch(error => {
            if (error.errors) {
                // Handle validation errors
                displayValidationErrors(error.errors);
            } else {
                // Handle other errors
                console.error('Error:', error);
            }
        });

    });

});

function displayValidationErrors(errors) {
    // Clear previous errors
    document.querySelectorAll('.error-message').forEach(el => el.textContent = '');

    // Display new errors
    for (const [key, messages] of Object.entries(errors)) {
        const errorElement = document.querySelector(`#${key}Error`);
        if (errorElement) {
            errorElement.textContent = messages.join(', ');
        }
    }
}
</script>