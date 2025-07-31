@php
    $meta = [
        // "meta" => [],
        'seo' => [
            'title' => 'Affiliation',
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
                <h2>Affiliation</h2>

                <div class="mt-4">
                    {!! $website_about->affiliation !!}
                </div>


                {{-- <div class="mt-4">
                    <strong>Affiliation</strong>

                    <p><strong>Accreditation and Compliance</strong></p>
                    <p>
                        Affiliates of Techpark English must ensure that all courses and training programs adhere to the
                        company's high standards of educational quality and are compliant with relevant accreditation
                        requirements. This includes regular audits and updates to course materials to align with the latest
                        industry standards and best practices.
                    </p>

                    <p><strong>Brand Representation</strong></p>
                    <p>
                        Affiliates are required to maintain the integrity of the Techpark English brand. This includes using
                        approved branding materials, logos, and promotional content. Any deviations or misuse of the brand
                        without prior authorization can lead to termination of the affiliation agreement.
                    </p>
                    <p><strong>Instructor Qualifications</strong></p>
                    <p>
                        All instructors employed by affiliates must meet Techpark English's stringent qualifications
                        criteria. This includes holding relevant degrees or certifications in English language education,
                        demonstrating proficiency in the language, and undergoing periodic training provided by Techpark
                        English to stay updated with the latest teaching methodologies.
                    </p>
                    <p><strong>Performance Metrics</strong></p>
                    <p>
                        Affiliates must adhere to specific performance metrics set by Techpark English. This includes
                        achieving target student satisfaction scores, maintaining high course completion rates, and
                        demonstrating successful student outcomes. Affiliates are required to regularly report these metrics
                        to Techpark English for review.


                    </p>
                    <p><strong>Fee Structure and Revenue Sharing</strong></p>
                    <p>
                        The fee structure for courses and training programs offered by affiliates must align with the
                        guidelines set by Techpark English. Revenue sharing agreements will be clearly outlined in the
                        affiliation contract, specifying the percentage of fees that affiliates will remit to Techpark
                        English.
                    </p>
                    <p><strong>Ethical Standards and Conduct</strong></p>
                    <p>
                        Affiliates must uphold the highest ethical standards in their operations. This includes ensuring a
                        safe and respectful learning environment, protecting student privacy, and preventing any form of
                        discrimination or harassment. Affiliates are expected to handle complaints and grievances promptly
                        and transparently, in line with Techpark English's policies.
                    </p>

                </div> --}}

            </div>
        </div>

    </section>
@endsection
