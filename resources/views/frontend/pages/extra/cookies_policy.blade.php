@php
    $meta = [
        // "meta" => [],
        'seo' => [
            'title' => 'Cookies Policy',
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
                <h2>Cookies Policy</h2>

                <div class="mt-4">
                    {!! $website_about->cookies_policy !!}
                </div>


                {{-- <div class="mt-4">
                    <strong>Cookies Policy</strong>
                    <p><strong>Introduction to Cookies</strong></p>
                    <p>
                        Techpark English uses cookies to enhance user experience on their website. Cookies are small text
                        files stored on your device when you visit our site.
                    </p>
                    <p><strong>Purpose of Cookies</strong></p>
                    <p>
                        The cookies we use help us to understand user behavior, track user preferences, and improve our
                        website’s functionality, ensuring a personalized and efficient experience for each visitor.
                    </p>
                    <p><strong>Consent</strong></p>
                    <p>
                        By continuing to use our website, you consent to our use of cookies. You will be prompted to accept
                        or manage your cookie preferences upon your first visit.

                    </p>
                    <p><strong>Managing Cookies</strong></p>
                    <p>
                        Users can manage their cookie preferences at any time by adjusting the settings in their web browser
                        or by accessing the cookie management tool provided on our website.
                    </p>
                    <p><strong>Third-Party Cookies</strong></p>
                    <p>
                        Techpark English may use third-party service providers to assist us in analyzing how our site is
                        used and to track user activity. These third parties may use cookies on our behalf.
                    </p>
                    <p><strong>Data Protection and Privacy</strong></p>
                    <p>
                        The data collected through cookies is anonymized and aggregated to protect user privacy. We do not
                        store personal information in the cookies we use.
                    </p>
                    <p><strong>Changes to Cookie Policy</strong></p>
                    <p>
                        Techpark English reserves the right to make changes to this cookie policy at any time. Any changes
                        will be posted on this page with an updated effective date.
                    </p>

                </div> --}}

            </div>
        </div>

    </section>
@endsection
