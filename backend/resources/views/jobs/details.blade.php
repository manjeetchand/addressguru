@extends('layouts.app')
@section('head')
    @php 
        $createdAt = strtotime($job_detail->created_at);
        $today = time(); // Current timestamp
        $diffInSeconds = $today - $createdAt; // Difference in seconds
        $diffInDays = floor($diffInSeconds / (60 * 60 * 24)); // Convert seconds to days
    @endphp
    <title>{{ucfirst($job_detail->title)}} | Address Guru</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <link rel="canonical" href="">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <style>
        .container-fluid {
            margin-top: 100px ! important;
        }
        /* .job-container{
            background-color: #f2f2f2;
        } */
        .job-container> .row{
            padding: 0 200px;
        }
        .img-thumbnail {
            width:50%;
        }
        
        p,span{
            font-size: 16px;
            margin: 0;
        }
        .card{
            border: none;
            border-radius: 1rem;
            box-shadow: 0 6px 12px rgba(30, 10, 58, .04);
            transition: box-shadow .2s linear;
        }
        .page-title-content{
            position: relative;
            margin-top: -6px;
            text-align: center;
        }
        .page-title-content h2 {
            margin-bottom: 15px;
            font-size: 48px;
            color: #000;
        }
        .page-title-content ul {
            padding-left: 0;
            list-style-type: none;
            margin-top: 10px;
            margin-bottom: -5px;
        }
        .page-title-content ul li {
            display: inline-block;
            position: relative;
            font-size: 16px;
            padding-right: 15px;
            margin-left: 15px;
            color: #000;
        }
        .page-title-content ul li:first-child {
            margin-left: 0;
        }

        .page-title-area {
            padding-top: 100px;
            padding-bottom: 100px;
            position: relative;
            z-index: 1;
            background-image: url({{asset('lara-assets/images/page-title-bg/page-title-bg-1.jpg')}});
            background-position: center center;
            background-repeat: no-repeat;
            background-size: cover;
            height: 100%;
        }
        .skill-span{
            background: #f2f2f2;
            /* padding: 2px 23px; */
            border: 1px solid #eaeaea;
            padding: 0 7px;
            margin: 2px 10px 0 0;
            color: #111;
            min-height: 23px;
            height: 22px;
            border-radius: 6px;
            font-size: 14px;
        }
        .mobile-span,.mobile-filter{
            display:none;
        }

        .desk-span{
            display:flex;
            gap:4px;
        }

        .fw-bold{
            font-weight:500;
        }
        h2{
            font-size:18px
            ;
        }
        h3{
            font-size:16px;
        }

        .shadow-sm{
            box-shadow:none !important;
        }
        @media only screen and (max-width: 768px) {
            h1{
                font-size: 18px !important;
            }
            .job-container>.row{
                padding: 0;
            }

            .filter-section,.banner-section,.desk-span{
                display:none;
            }
            .mobile-span,.mobile-filter{
                display:block;
            }
            .img-thumbnail {
                width:100%;
            }
            .skill-span{
                background: #f2f2f2;
                /* padding: 2px 23px; */
                border: 1px solid #eaeaea;
                padding: 0 7px;
                margin: 2px 8px 0 0;
                color: #111;
                min-height: 23px;
                height: 22px;
                border-radius: 6px;
                font-size: 14px;
            }
            h2{
                font-size:16px !important;
            }
            h3,span,p,li{
                font-size:14px !important;
            }
            .fw-bold{
                font-weight: 700 !important;
            }
        }
        .swiper {
        width: 100%;
        height: 180px ;
        }
        .swiper-slide {
        display: flex;
        justify-content: center;
        align-items: center;
        background: #fff;
        border-radius: 10px;
        overflow: hidden;
        transition: transform 3s ease-in-out; /* Smooth transition */
        }
        .fw-bold{
            font-weight: 600 !important;
        }
        .img-thumbnail {
            width:40%;
        }
        .img-thumbnail-2{
            width:80%;
        }
        h1{
            font-size: 30px;
        }
        h3{
            font-size: 16px;
        }
        .about-title{
            font-weight:600;
        }
        .about-card{
            border-bottom:1px solid #cccccc5e;
            padding:10px; 
            margin-bottom:8px;
        }
        .apply-card{
            display:none;
        }

        @media only screen and (max-width: 768px) {
            .img-thumbnail {
                width:100%;
            }
            .apply-card{
                display:block;
                position: fixed;
                bottom: 0;
                padding: 10px;
                border-radius: 0;
                z-index: 1;
            }
        }
        .modal.fade .modal-dialog {
            transform: translateY(-50px);
            transition: transform 0.3s ease-out;
        }

        .modal.show .modal-dialog {
            transform: translateY(0);
        }
    </style>
@endsection
@section('content')
<div class="container-fluid job-container">
    <!-- <div class="row" style="padding:0 10px;">
        <ol class="breadcrumb" style="box-shadow:none; margin-bottom:0px; background:none; ">
            <li><a href="{{ url('/') }}">Home</a></li>
            <li><a href="{{ url('jobs') }}">Jobs</a></li>
            <li class="active">{{ $job_detail->title ?? '' }}</li>
        </ol>
    </div> -->

    <div class="row py-4">
        <div class="col-12 col-lg-8 ">  
            <div class="card mb-2">
                <article class="card-group-item">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-9">
                                <h1 class="mb-1 fw-bold">{{ $job_detail->title ?? '' }}</h1>
                                <h3 class="">{{ $job_detail->company_name ?? '' }}</h3>
                                </div>
                                <div class="col-3 text-end">
                                <img class="img-thumbnail rounded float-left" src="{{ $job_detail->iamge }}" alt="" >
                                </div>
                            </div>
                            <div class="desk-span">
                                <span><i class="bi bi-bag-dash"></i> Experince : {{$job_detail->experience ?? '-'}}</span>|
                                <span ><i class="bi bi-geo-alt"></i> location : {{ isset($job_detail->locality) ? $job_detail->locality : '' }}</span>|
                                <span><i class="bi bi-currency-rupee"></i> Salary: {{ $job_detail->salary_from . '-' . $job_detail->salary_to ?? '--' }} / Month</span></p>
                            </div>
                            <div class="row mobile-span">
                                <div class="col-12 col-lg-4">
                                    <span><i class="bi bi-bag-dash"></i> Experince:  {{$job_detail->experience ?? '-'}}</span> |
                                    <span><i class="bi bi-person"></i> Vaccancy: {{$job_detail->no_of_seat ?? ''}}</span>
                                </div>
                                <p class="col-12 col-lg-4"><i class="bi bi-geo-alt"></i> location : {{ isset($job_detail->locality) ? $job_detail->locality : '' }}</p>
                                <p class="col-12 col-lg-4"><i class="bi bi-currency-rupee"></i> Salary: {{ $job_detail->salary_from . '-' . $job_detail->salary_to ?? '--' }} /  Month</p>
                            </div>
                            <p class="mt-1 desk-span"><i class="bi bi-person"></i> Vaccancy: {{$job_detail->no_of_seat ?? ''}}</p>
                            <p class="mt-1 px-1">Job Type:  {{ $job_detail->job_type ?? '' }}</p>
                            <p class="mt-2">Skills:
                            @if($job_detail->skills)
                                @foreach(json_decode($job_detail->skills, true) as $skill)
                                    <span class="skill-span">{{ $skill ?? '' }}</span>  
                                @endforeach
                            @endif
                            </p>
                            <div class="d-flex justify-content-between align-items-center mt-2">
                                <P class="desk-span">
                                    <span>
                                        <i class="bi bi-calendar-week"></i>   {{ $diffInDays < 1 ? 'few hrs ago' : abs($diffInDays) . ' day' . (abs($diffInDays) > 1 ? 's' : '') . ' ago' }}
                                    </span>|
                                    <span>
                                        <i class="bi bi-people"></i> 
                                        @if($job_detail->jobUser)
                                        {{$job_detail->jobUser->count()}}
                                        @endif
                                        Applicants
                                    </span>
                                </P>
                                <a class="btn  desk-span px-4 text-light" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#flipFlop" style="background: #ff6e04;" >Apply Now <i class="bi bi-arrow-right-square"></i> </a>
                            </div>
                            <div class="mobile-span">
                                    <p class="d-flex justify-content-between"> 
                                    <span>
                                        <i class="bi bi-calendar-week"></i> 
                                        {{ $diffInDays < 1 ? 'few hrs ago' : abs($diffInDays) . ' day' . (abs($diffInDays) > 1 ? 's' : '') . ' ago' }}
                                    </span>
                                    <span>
                                        <i class="bi bi-people"></i>  
                                        @if($job_detail->jobUser)
                                        {{$job_detail->jobUser->count()}}
                                        @endif Applicants
                                    </span>
                                    </p>
                                </div>
                        </div>
                </article>
            </div>
            <div class="card p-2">
                <article class="blog-post">
                    <div class="about-card">
                        <h2 class="about-title">Job Details</h2>
                        <p  class="about-description">{{ $job_detail->description ?? '--' }}</p>
                    </div>
                    <div class="about-card">
                        <h2 class="about-title">Role</h2>
                        @if($job_detail->responsibility)
                            @foreach(json_decode($job_detail->responsibility, true) as $responsibility)
                            <li class="about-description"> {{ $responsibility ?? '--' }} </li>
                            @endforeach
                        @endif
                    </div>
                    <div class="about-card">
                        <h2 class="about-title">Qualification Required</h2>
                        @if($job_detail->qualification)
                            @foreach(json_decode($job_detail->qualification,  true) as $education)
                                <p class="about-description"> {{ $education ?? '--' }} </li>
                            @endforeach
                        @endif
                    </div>
                    <div class="about-card">
                        <h2 class="about-title">Key skills</h2>
                        @if($job_detail->skills)
                            @foreach(json_decode($job_detail->skills, true) as $skill)
                                <span class="skill-span">{{ $skill ?? '' }}</span>  
                            @endforeach
                        @endif
                    </div>
                    <div class="about-card">
                        <h2 class="about-title">About {{ $job_detail->company_name ?? '' }}</h2>
                        <p class="about-description">{{ $job_detail->description ?? '--' }}</p>
                    
                    </div>
                    <div style="padding:10px; margin-bottom:8px;">
                        <address>
                        <h2 class="about-title">Contact Details:</h2>
                        <p><strong>Address:</strong> {{$job_detail->locality ?? ''}}</p>
                        <p><strong>State:</strong>  {{$job_detail->state ?? ''}}</p>
                        <p><strong>City:</strong>  {{$job_detail->city ?? ''}}</p>    
                        </address>
                    </div>
                </article>
            </div>
        </div>
        <div class="col-lg-4 col-12 banner-section">
            <div class="card mb-4">
            <div class="row">
                <article class="card-group-item">
                    <header class="card-header">
                        <h2 class="m-0 fs-4"><b>Other Jobs Available</b></h2>
                    </header>
                        @php    
                            $jobPostDatas = \App\Job::with(['user'])->where('status', '1')->orderBy('id', 'desc')->get();
                        @endphp
                        @foreach($jobPostDatas as $jobPostData)
                        @php 
                        $createdAt = strtotime($jobPostData->created_at);
                        $today = time(); // Current timestamp
                        $diffInSeconds = $today - $createdAt; // Difference in seconds
                        $otherdiffInDays = floor($diffInSeconds / (60 * 60 * 24)); // Convert seconds to days
                        @endphp
                            <div class=" my-2 rounded px-3 py-2" style="border-bottom: 1px solid #ccc;">
                                <a href="{{ url('jobs',$jobPostData->slug)}}" style="color: #000000;text-decoration: none;">
                                    <div class="row " > 
                                        <div class="col-9">
                                            <h2 class="fw-bold">{{ $jobPostData->title ?? '' }}</h2>
                                            <h3 >{{ $jobPostData->company_name ?? '' }}</h3>
                                            <span><i class="bi bi-bag-dash"></i> Exp: 
                                                {{$job_detail->experience ?? '-'}}
                                            </span>|
                                            <span ><i class="bi bi-person-fill"></i>  Job Type: {{ $jobPostData->job_type ?? '' }}</span><br>
                                            <span><i class="bi bi-currency-rupee" ></i> Salary: 
                                                {{ $jobPostData->salary_from . '-' . $jobPostData->salary_to ?? '--' }} / Month
                                            </span><br>
                                        </div>
                                        <div class="col-3 text-end">
                                            <img src="{{ $jobPostData->image }}" class="img-thumbnail-2 rounded float-left" alt="image"><br>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                                <span><i class="bi bi-geo-alt"></i> location: 
                                                    {{ isset($job_detail->locality) ? $job_detail->locality : '' }}
                                                </span>
                                                <span>
                                                    {{ $otherdiffInDays < 1 ? 'few hrs ago' : abs($otherdiffInDays) . ' day' . (abs($otherdiffInDays) > 1 ? 's' : '') . ' ago' }}
                                                </span>

                                            </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                </article>
            </div>
            
            </div>
        </div>

        <div class="col-12 mt-4 mobile-span">
            <h2 class=" text-center mb-2"><b>Other Jobs</b></h2>
            <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    @php    
                        $jobPostDatas = \App\Job::with(['user'])->where('status', '1')->orderBy('id', 'desc')->get();
                    @endphp
                    @foreach($jobPostDatas as $jobPostData)
                        @php 
                        $createdAt = strtotime($jobPostData->created_at);
                        $today = time(); // Current timestamp
                        $diffInSeconds = $today - $createdAt; // Difference in seconds
                        $otherdiffInDays = floor($diffInSeconds / (60 * 60 * 24)); // Convert seconds to days
                        @endphp
                        <div class="swiper-slide">
                            <div class=" my-2 rounded px-3 py-2">
                                <a href="{{ url('jobs',$jobPostData->slug)}}" style="color: #000000;text-decoration: none;">
                                    <div class="row " > 
                                        <div class="col-9">
                                            <h2 class="fw-bold">{{ $jobPostData->title ?? '' }}</h2>
                                            <h3 >{{ $job_detail->company_name ?? '' }}</h3>
                                        </div>
                                        <div class="col-3 text-end">
                                            <img src="{{ $jobPostData->image }}" class="img-thumbnail rounded float-left" alt="image"><br>
                                        </div>
                                        <div class="col-12">
                                        <span><i class="bi bi-bag-dash"></i> Exp: 
                                            {{$jobPostData->experience ?? '-'}}
                                            </span>|
                                            <span ><i class="bi bi-person-fill"></i>  Job Type: {{ $jobPostData->job_type ?? '' }}</span><br>
                                            <span><i class="bi bi-currency-rupee" ></i> Salary: 
                                                {{ $jobPostData->salary_from . '-' . $jobPostData->salary_to ?? '--' }} / Month
                                            </span><br>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <span><i class="bi bi-geo-alt"></i> location: 
                                                {{ isset($job_detail->locality) ? $job_detail->locality : '' }}
                                            </span>
                                            <span>
                                                {{ $otherdiffInDays < 1 ? 'few hrs ago' : abs($otherdiffInDays) . ' day' . (abs($otherdiffInDays) > 1 ? 's' : '') . ' ago' }}
                                            </span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-12 card apply-card">
            <center>
            <a class="btn  w-100 px-2" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#flipFlop" >Apply Now <i class="bi bi-arrow-right-square"></i> </a>
            </center>
        </div>
    </div>
</div>

<!-- Apply modal -->
<div class="modal fade" id="flipFlop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">    
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title fs-5" id="staticBackdropLabel">Fill The Correct Detail's For This Job</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
                @csrf
                <div class="modal-body">
                    <div class="form-group mb-1">
                        <label for="exampleInputEmail1">Full Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Your Name" name="name" required>
                    </div>
                    <div class="form-group mb-1">
                        <label for="exampleInputEmail1">Email address <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter Your Email" name="email" required>
                    </div>
                    <div class="form-group mb-1">
                        <label for="exampleInputPassword1">Phone No. <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="exampleInputPassword1" placeholder="Enter Your Phone" name="phone">
                    </div>
                    <div class="form-group mb-1">
                        <label for="exampleInputPassword1">Experience (year) <span class="text-danger">*</span></label>
                        <select class="form-control" id="exampleInputPassword1" name="experience" required>
                            <option value="">Select Experience</option>
                            <option value="0">fresher</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>   
                            <option value="10+">10 +</option>   
                        </select>
                    </div>
                    <div class="form-group mb-1">
                        <label for="exampleInputPassword1">Date of Birth <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" id="exampleInputPassword1" placeholder="Enter Your Experience" name="date_of_birth" required>
                    </div>
                    <div class="form-group mb-1">
                        <label for="exampleInputPassword1">State <span class="text-danger">*</span></label>
                        <select class="form-control" id="exampleInputPassword1" name="state" required>
                            <option value="">Select State</option>
                                @if(isset($states))
                                    @forelse($states as $state)
                                    <option value="{{$state->id}}">{{$state->name}}</option>
                                    @empty
                                    <option value="">No State Found</option>
                                    @endforelse
                                @endif  
                        </select>
                        {{-- <input type="date" class="form-control" id="exampleInputPassword1" placeholder="Enter Your Experience" name="date_of_birth" required> --}}
                    </div>
                    {{-- <div class="form-group">
                        <label for="exampleInputFile">Attach Resume (File Size Max: 2 MB)</label>
                        <input type="file" id="exampleInputFile" class="form-control"  name="resume">
                    </div> --}}
                    <div class="form-group">
                        <label for="exampleInputFile">Skill (Ex: seo,smo)</label> 
                        <textarea  id="exampleInputFile" class="form-control"  name="skills" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('footer')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var swiper = new Swiper(".mySwiper", {
            slidesPerView: 1, // Show 1 card at a time
            spaceBetween: 20, // Space between slides
            loop: true, // Infinite Loop
            autoplay: {
            delay: 2000, // Auto-slide every 2 seconds
            disableOnInteraction: false, // Keeps autoplay active after interaction
            },
            speed: 1500, // Smooth transition speed (1s)
        });
    });
</script>
<script>
    $(document).ready(function () {
        $('#ajax-form').on('submit', function (e) {
            e.preventDefault(); 
            $('.is-invalid').removeClass('is-invalid');
            $('.invalid-feedback').remove();

            let form = $(this);
            let actionUrl = form.data('action');
            let method = form.data('method');
            let formData = new FormData(this);

            $.ajax({
                url: actionUrl,
                type: method,
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    if (response.status == 'success') {
                        toastr.success('Application submitted successfully!');
                        setTimeout(function () {
                            location.reload();
                        }, 3000); 
                    }else{
                        toastr.warning('An error occurred. Please try again later.');
                    }
                
                },
                error: function (xhr) {
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        for (let field in errors) {
                            let input = $(`[name="${field}"]`);
                            input.addClass('is-invalid');
                            input.after(`<div class="invalid-feedback">${errors[field][0]}</div>`);
                        }
                    } else {
                        toastr.error('An error occurred. Please try again later.');
                    }
                }
            });
        });
    });
</script>

<script>

    function checkAuth(){
        @if(Auth::check())
            var applyJobModal = new bootstrap.Modal(document.getElementById('apply-for-job'));
            applyJobModal.show();
        @else 
            alert("Please login in to apply for the job.")
        @endif
    }
    function validateAlphabeticalInput(input) {
        input.value = input.value.replace(/[^A-Z a-z]/g, '');
    }

    function validateNumericInput(input) {		
        input.value = input.value.replace(/[^0-9]/g, '');		
        input.value = input.value.slice(0, 10);
    }

</script>

@endsection