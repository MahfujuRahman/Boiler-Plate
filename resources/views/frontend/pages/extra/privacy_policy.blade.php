@php
    $meta = [
        // "meta" => [],
        'seo' => [
            'title' => 'Privacy Policy',
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
                <h2>Privacy Policy</h2>

                <div class="mt-4">
                    {!! $website_about->privacy_policy !!}
                </div>

                {{-- <div class="mt-4">
                    <strong>Privacy Policy</strong>
                    <p><strong>Information Collection and Use</strong></p>
                    <p>
                        Techpark English collects personal information such as names, email addresses, phone numbers, and
                        payment details during registration for courses or subscribing to newsletters. Additional
                        information like learning preferences and progress may be collected to enhance user experience.
                    </p>
                    <div>
                        <p>
                            The app does use third-party services that may collect
                            information used to identify you.
                        </p>
                        <p>
                            Link to the privacy policy of third-party service providers used
                            by the app
                        </p>
                    </div>
                    <p><strong>Cookies and Tracking Technologies</strong></p>
                    <p>
                        Our website uses cookies and similar tracking technologies to enhance user experience, analyze
                        website performance, and deliver targeted advertisements. Users can control cookie settings through
                        their browser preferences.
                    </p>
                    <p>
                        This Service does not use these “cookies” explicitly. However,
                        the app may use third-party code and libraries that use
                        “cookies” to collect information and improve their services.
                        You have the option to either accept or refuse these cookies
                        and know when a cookie is being sent to your device. If you
                        choose to refuse our cookies, you may not be able to use some
                        portions of this Service.
                    </p>
                    <p><strong>Use of Information</strong></p>
                    <p>
                        The collected information is used to provide, maintain, and improve our services, communicate with
                        users, process transactions, and personalize the learning experience. We may also use information
                        for research and analytics purposes.
                    </p>
                    <p><strong>Data Sharing</strong></p>
                    <p>
                        Techpark English does not sell, rent, or trade your personal information to third parties. We may
                        share information with trusted service providers who assist in operating our website, conducting our
                        business, or servicing you, under strict confidentiality agreements.
                    </p>
                    <p><strong>Data Security</strong></p>
                    <p>
                        We implement appropriate technical and organizational measures to protect personal data from
                        unauthorized access, alteration, disclosure, or destruction. This includes encryption, firewalls,
                        and secure server technologies.
                    </p>
                    <p><strong>User Rights</strong></p>
                    <p>
                        Users have the right to access, correct, delete, and restrict the processing of their personal
                        information. Requests can be made through our contact information provided in this policy. We will
                        respond to such requests in accordance with applicable laws.
                    </p>
                    <p><strong>Contact Information</strong></p>
                    <p>
                        For any questions or concerns regarding this privacy policy or data handling practices, users can
                        contact Techpark English at [insert contact details], and we will address your inquiries promptly.
                    </p>

                </div> --}}

            </div>
        </div>

    </section>
@endsection
