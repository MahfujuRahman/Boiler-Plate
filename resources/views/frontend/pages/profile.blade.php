@php
    $meta = [
        'seo' => [
            'title' => 'Edit Profile',
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

        .card-custom {
            border: none;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .card-header-custom {
            background: #f8f9fa;
            font-size: 1.25rem;
            font-weight: bold;
            border-bottom: 1px solid #dee2e6;
        }
    </style>

    <section class="py-5 my-5">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-12 col-md-10 col-lg-8">
                    <div class="card card-custom">
                        <div class="card-header card-header-custom text-center">
                            Edit Profile
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('update_profile') }}" enctype="multipart/form-data">
                                @csrf
                                <!-- Row 1: First Name, Last Name, Father's Name -->
                                <div class="row">
                                    <div class="col-12 col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label" for="first_name">First Name <sup
                                                    class="text-danger">*</sup></label>
                                            <input type="text" name="first_name" id="first_name"
                                                value="{{ old('first_name', auth()->user()->first_name) }}"
                                                class="form-control" placeholder="First Name">
                                            @error('first_name')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label" for="last_name">Last Name</label>
                                            <input type="text" name="last_name" id="last_name"
                                                value="{{ old('last_name', auth()->user()->last_name) }}"
                                                class="form-control" placeholder="Last Name">
                                            @error('last_name')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label" for="father_name">Father's Name</label>
                                            <input type="text" name="father_name" id="father_name"
                                                value="{{ old('father_name', auth()->user()->father_name) }}"
                                                class="form-control" placeholder="Father's Name">
                                            @error('father_name')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Row 1.5: Gender and Profile Picture -->
                                <div class="row">
                                    <div class="col-12 col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label" for="gender">Gender</label>
                                            <select name="gender" id="gender" class="form-select">
                                                <option value="">Select Gender</option>
                                                <option value="Male"
                                                    {{ old('gender', auth()->user()->gender) == 'Male' ? 'selected' : '' }}>
                                                    Male</option>
                                                <option value="Female"
                                                    {{ old('gender', auth()->user()->gender) == 'Female' ? 'selected' : '' }}>
                                                    Female</option>
                                                <option value="Other"
                                                    {{ old('gender', auth()->user()->gender) == 'Other' ? 'selected' : '' }}>
                                                    Other</option>
                                            </select>
                                            @error('gender')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-8">
                                        <div class="row align-items-center">
                                            <div class="col-3">
                                                @if (auth()->user()->photo)
                                                    <div class="mb-2">
                                                        <img src="{{ asset(auth()->user()->photo) }}" alt="Profile Picture"
                                                            class="img-thumbnail" width="100">
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="col-9">
                                                <div class="mb-3">
                                                    <label class="form-label" for="photo">Profile Picture</label>
                                                    <input type="file" name="photo" id="photo"
                                                        class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Row 2: Mobile Number, WhatsApp Number, Guardian's Number -->
                                <div class="row">
                                    <div class="col-12 col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label" for="mobile_number">Mobile Number <sup
                                                    class="text-danger">*</sup></label>
                                            <input type="text" name="mobile_number" id="mobile_number"
                                                value="{{ old('mobile_number', auth()->user()->mobile_number) }}"
                                                class="form-control" placeholder="Mobile Number">
                                            @error('mobile_number')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label" for="whatsapp_number">WhatsApp Number</label>
                                            <input type="text" name="whatsapp_number" id="whatsapp_number"
                                                value="{{ old('whatsapp_number', auth()->user()->whatsapp_number) }}"
                                                class="form-control" placeholder="WhatsApp Number">
                                            @error('whatsapp_number')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label" for="guardian_number">Guardian's Number</label>
                                            <input type="text" name="guardian_number" id="guardian_number"
                                                value="{{ old('guardian_number', auth()->user()->guardian_number) }}"
                                                class="form-control" placeholder="Guardian's Number">
                                            @error('guardian_number')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Row 3: Address, Email, Blood Group -->
                                <div class="row">
                                    <div class="col-12 col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label" for="address">Address</label>
                                            <input type="text" name="address" id="address"
                                                value="{{ old('address', auth()->user()->address) }}"
                                                class="form-control" placeholder="Address">
                                            @error('address')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label" for="email">Email</label>
                                            <input type="email" name="email" id="email"
                                                value="{{ old('email', auth()->user()->email) }}" class="form-control"
                                                placeholder="Email" readonly>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label" for="blood_group">Blood Group</label>
                                            <select name="blood_group" id="blood_group" class="form-select">
                                                <option value="">Select Blood Group</option>
                                                <option value="A+"
                                                    {{ old('blood_group', auth()->user()->blood_group) == 'A+' ? 'selected' : '' }}>
                                                    A+</option>
                                                <option value="A-"
                                                    {{ old('blood_group', auth()->user()->blood_group) == 'A-' ? 'selected' : '' }}>
                                                    A-</option>
                                                <option value="B+"
                                                    {{ old('blood_group', auth()->user()->blood_group) == 'B+' ? 'selected' : '' }}>
                                                    B+</option>
                                                <option value="B-"
                                                    {{ old('blood_group', auth()->user()->blood_group) == 'B-' ? 'selected' : '' }}>
                                                    B-</option>
                                                <option value="AB+"
                                                    {{ old('blood_group', auth()->user()->blood_group) == 'AB+' ? 'selected' : '' }}>
                                                    AB+</option>
                                                <option value="AB-"
                                                    {{ old('blood_group', auth()->user()->blood_group) == 'AB-' ? 'selected' : '' }}>
                                                    AB-</option>
                                                <option value="O+"
                                                    {{ old('blood_group', auth()->user()->blood_group) == 'O+' ? 'selected' : '' }}>
                                                    O+</option>
                                                <option value="O-"
                                                    {{ old('blood_group', auth()->user()->blood_group) == 'O-' ? 'selected' : '' }}>
                                                    O-</option>
                                            </select>
                                            @error('blood_group')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Row 4: Occupation, Institution, Class/Designation -->
                                <div class="row">
                                    <div class="col-12 col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label" for="occupation">Occupation</label>
                                            <input type="text" name="occupation" id="occupation"
                                                value="{{ old('occupation', auth()->user()->occupation) }}"
                                                class="form-control" placeholder="Occupation">
                                            @error('occupation')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label" for="institution">Institution</label>
                                            <input type="text" name="institution" id="institution"
                                                value="{{ old('institution', auth()->user()->institution) }}"
                                                class="form-control" placeholder="Institution">
                                            @error('institution')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label" for="class_designation">Class/Designation</label>
                                            <input type="text" name="class_designation" id="class_designation"
                                                value="{{ old('class_designation', auth()->user()->class_designation) }}"
                                                class="form-control" placeholder="Class or Designation">
                                            @error('class_designation')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Row 5: Reference Source -->
                                <div class="row">
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <label class="form-label" for="reference_source">Reference Source</label>
                                            <select name="reference_source" id="reference_source" class="form-select">
                                                <option value="Facebook"
                                                    {{ old('reference_source', auth()->user()->reference_source) == 'Facebook' ? 'selected' : '' }}>
                                                    Facebook</option>
                                                <option value="Youtube"
                                                    {{ old('reference_source', auth()->user()->reference_source) == 'Youtube' ? 'selected' : '' }}>
                                                    Youtube</option>
                                                <option value="Organization"
                                                    {{ old('reference_source', auth()->user()->reference_source) == 'Organization' ? 'selected' : '' }}>
                                                    Organization</option>
                                                <option value="Ex-Student"
                                                    {{ old('reference_source', auth()->user()->reference_source) == 'Ex-Student' ? 'selected' : '' }}>
                                                    Ex-Student</option>
                                                <option value="Employee"
                                                    {{ old('reference_source', auth()->user()->reference_source) == 'Employee' ? 'selected' : '' }}>
                                                    Employee</option>
                                                <option value="Telesales"
                                                    {{ old('reference_source', auth()->user()->reference_source) == 'Telesales' ? 'selected' : '' }}>
                                                    Telesales</option>
                                                <option value="Offline Marketing"
                                                    {{ old('reference_source', auth()->user()->reference_source) == 'Offline Marketing' ? 'selected' : '' }}>
                                                    Offline Marketing</option>
                                                <option value="Other"
                                                    {{ old('reference_source', auth()->user()->reference_source) == 'Other' ? 'selected' : '' }}>
                                                    Other</option>
                                                <option value="Friend"
                                                    {{ old('reference_source', auth()->user()->reference_source) == 'Friend' ? 'selected' : '' }}>
                                                    Friend</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <!-- Row 6: Password and Confirm Password -->
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="password">Password</label>
                                            <input type="password" name="password" id="password" class="form-control"
                                                placeholder="Password">
                                            @error('password')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="password_confirmation">Confirm Password</label>
                                            <input type="password" name="password_confirmation"
                                                id="password_confirmation" class="form-control"
                                                placeholder="Confirm Password">
                                            @error('password_confirmation')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="text-center mt-4">
                                    <button type="submit" class="btn btn-primary rounded-pill px-4">Update
                                        Profile</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
