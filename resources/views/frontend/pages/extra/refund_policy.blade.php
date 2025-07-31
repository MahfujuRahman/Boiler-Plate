@php
    $meta = [
        // "meta" => [],
        'seo' => [
            'title' => 'Refund Policy',
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
                <h2>Refund Policy</h2>

                <div class="mt-4">
                    {!! $website_about->refund_policy !!}
                </div>

                {{-- <div class="mt-4">
                    <strong>Refund Policy</strong>
                    <p><strong>Full Refund Period</strong></p>
                    <p>
                        Techpark English offers a full refund if the cancellation is made within 7 days of the initial
                        purchase of any course or training program.
                    </p>
                    <p><strong>Pro-Rated Refunds</strong></p>
                    <p>
                        After the initial 7-day period, refunds are provided on a pro-rated basis based on the amount of
                        course content accessed and the time elapsed since the purchase.
                    </p>
                    <p><strong>Course Completion</strong></p>
                    <p>
                        No refunds are granted if the course is more than 50% completed or if more than 30 days have passed
                        since the purchase, whichever comes first.

                    </p>
                    <p><strong>Subscription Services</strong></p>
                    <p>
                        For subscription-based services, cancellations can be made at any time, but refunds will only apply
                        to future billing cycles. No partial month refunds are provided.
                    </p>
                    <p><strong>Special Promotions</strong></p>
                    <p>
                        Courses purchased during special promotions or discounts are not eligible for refunds unless
                        specified otherwise in the promotion’s terms and conditions.
                    </p>
                    <p><strong>Refund Request Process</strong></p>
                    <p>
                        To request a refund, customers must contact Techpark English’s customer support team via email or
                        the company’s website, providing proof of purchase and reason for the refund request.
                    </p>
                    <p><strong>Processing Time</strong></p>
                    <p>
                        Refund requests are processed within 14 business days after approval. Refunds are credited back to
                        the original payment method.
                    </p>

                </div> --}}

            </div>
        </div>

    </section>
@endsection
