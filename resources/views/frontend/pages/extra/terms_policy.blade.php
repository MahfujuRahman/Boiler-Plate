@php
    $meta = [
        // "meta" => [],
        'seo' => [
            'title' => 'Terms & Conditions',
            'image' => asset('seo.jpg'),
        ],
    ];
@endphp
@extends('frontend.layouts.layout', $meta)
@section('contents')
    <style>
        .divider:after,
        .divider:before {
            content: "";
            flex: 1;
            height: 1px;
            background: #eee;
        }
    </style>
    <section class="py-5 my-5">
        <div class="container h-custom">
            <div class="content">
                <h2>Terms & Conditions</h2>

                <div class="mt-4">
                    {!! $website_about->terms_condition !!}
                </div>


                {{-- <div class="mt-4">
                    <strong>Terms & Conditions</strong>
                    <p><strong>Enrollment and Fees</strong></p>
                    <p>
                        Enrollment in any course or program at Techpark English requires the payment of all applicable fees
                        prior to the commencement of the course. Fees are non-refundable unless specified otherwise in the
                        cancellation policy.
                    </p>
                    <p><strong>Course Materials</strong></p>
                    <p>
                        All course materials provided by Techpark English are proprietary and for the enrolled student’s use
                        only. Distribution or reproduction of these materials without permission is prohibited.
                    </p>
                    <p><strong>Attendance and Participation</strong></p>
                    <p>
                        Regular attendance and active participation are mandatory for all courses. Students must attend at
                        least 80% of their classes to receive a certificate of completion.

                    </p>
                    <p><strong>Code of Conduct</strong></p>
                    <p>
                        Students are expected to maintain a respectful and professional demeanor at all times. Disruptive
                        behavior, harassment, or any form of misconduct will result in disciplinary action, which may
                        include expulsion from the program.

                    </p>
                    <p><strong>Cancellation and Refund Policy</strong></p>
                    <p>
                        Students may cancel their enrollment within 7 days prior to the start date of the course to receive
                        a full refund. Cancellations made less than 7 days before the course start date will incur a
                        cancellation fee of 25% of the course fee.
                    </p>
                    <p><strong>Intellectual Property</strong></p>
                    <p>
                        All content, including course materials, lectures, and digital resources, provided by Techpark
                        English, are protected by intellectual property laws. Unauthorized use or distribution of these
                        materials is strictly prohibited.
                    </p>
                    <p><strong>Limitation of Liability</strong></p>
                    <p>
                        Techpark English will not be held liable for any indirect, incidental, or consequential damages
                        arising from the use of its services. The company’s total liability shall not exceed the amount paid
                        by the student for the course.

                    </p>

                </div> --}}

            </div>
        </div>

    </section>
@endsection
