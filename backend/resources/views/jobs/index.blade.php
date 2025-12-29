@extends('layouts.app')
@section('head')
    <title>Find the Best Jobs in Singapore | Singapore Jobs in AddressGuru</title>
    <meta name="description" content="Looking for jobs in Singapore? Explore top opportunities, high-paying roles & career growth options. Apply now and land your dream job today">
    <meta name="keywords" content="">
    <link rel="canonical" href="">
    <style>
        .fixed.busy {
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: 1050;
            display: flex;
            position: fixed;
            background: rgba(0, 0, 0, 0.25);
            align-items: center;
            justify-content: center;
        }
        .container-fluid {
            margin-top: 100px ! important;
        }
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
                    font-size:19px
                    ;
                }
                h3{
                    font-size:16px;
                }
                .shadow-sm{
                    box-shadow:none !important;
                }
                .bottom-slide-modal {
                position: fixed;
                bottom: -100%;
                z-index:9;
                left: 0;
                width: 100%;
                height: 80%;
                background: white;
                transition: bottom 0.3s ease-in-out;
                box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.2);
                border-top-left-radius: 15px;
                border-top-right-radius: 15px;
            }
        .bottom-slide-modal.show {
            bottom: 0;
        }
        .modal-content {
            display: flex;
            flex-direction: column;
            height: 100%;
        }
        .modal-body {
            flex-grow: 1;
            overflow-y: auto;
            padding: 15px;
        }
        .modal-footer {
            display: flex;
            justify-content: space-between;
            /* padding: px; */
            border-top: 1px solid #ccc;
        }
        .desktop-search{
            display:block;
        }
        .mobile-searchs{
            display:none;
        }
        @media only screen and (max-width: 768px) {
            .desktop-search{
                display:none;
            }
            .mobile-searchs{
                display:block;
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
                    font-size:1.2rem;
                }
                h3{
                    font-size:1rem;
                }
        }
        /* Desktop: Full Search Bar */
        .filter-box {
            background: #fff;
            border-radius: 50px;
            padding: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            gap: 10px;
            max-width: 50%;
            margin: auto;
            flex-wrap: wrap;
        }
        .filter-box select, .filter-box input {
            border: none;
            outline: none;
            background: transparent;
            padding: 10px;
            flex: 1;
            min-width: 150px;
        }
        .filter-box button {
            background: #fe6600;
            color: white;
            border-radius: 30px;
            padding: 8px 20px;
            border: none;
            display: flex;
            align-items: center;
            gap: 5px;
        }
        #filter-icon{
            color: #fe6600;
            font-size: 20px;
        }
        /* Mobile: Show "Search..." with Icon */
        .mobile-search {
            display: flex;
            align-items: center;
            background: #fff;
            padding: 10px;
            border-radius: 50px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            /* max-width: 300px; */
            margin: auto;
            cursor: pointer;
            justify-content: space-between;
            width: 100%;
        }
        .mobile-search i {
            color: #fe6600;
            font-size: 20px;
        }
        .mobile-search span {
            color: #999;
            font-size: 16px;
            margin-left: 10px;
        }
        /* Modal Design */
        .modal-content {
            border-radius: 0;
            /* padding: 20px; */
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.2);
        }
        .modal-header {
            border-bottom: none;
            text-align: center;
        }
        .modal-title {
            font-weight: bold;
            color: #333;
        }
        .modal-body input, .modal-body select {
            border-radius: 10px;
            padding: 12px;
            font-size: 16px;
            border: 1px solid #ccc;
        }
        .modal-footer button {   
            width: 100%;
            background: #fe6600;
            color: white;
            font-size: 16px;
            /* padding: 12px; */
            border-radius: 10px;
            border: none;
        }
        .modal-footer button:hover {
            background: #e65a00;
        }
        /* Responsive Design */
        @media (max-width: 768px) {
            .filter-box {
                display: none; /* Hide full search bar */
            }
            .select2-container {
                width: 100% !important;
                border-radius: 10px;
                padding: 12px;
                font-size: 16px;
                border: 1px solid #ccc;
            }
            .select2-dropdown .select2-dropdown--below {
                width: 450px !important;
                z-index: 99999 !important;
            }     
             h2{
                font-size:18px !important;
             } 
             p,span,div{
                font-size:14px !important; 
             }
        }
        @media (min-width: 769px) {
            .mobile-search {
                display: none; /* Hide mobile search */
            }
        }
        .btn-custom {
            background: linear-gradient(135deg, #ff6a00, #ee0979);
            color: white;
            font-weight: bold;
            border: none;
            padding: 12px 20px;
            border-radius: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            cursor: pointer;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease-in-out;
        }
        .btn-custom:hover {
            background: linear-gradient(135deg, #ee0979, #ff6a00);
            transform: scale(1.05);
            box-shadow: 0px 6px 15px rgba(0, 0, 0, 0.3);
        }
        .btn-custom:active {
            transform: scale(0.95);
        }
        .btn-custom {
            background: #fe6600;
            color: white;
            font-weight: bold;
            border: none;
            padding: 12px 20px;
            border-radius: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            cursor: pointer;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease-in-out;
        }
        .btn-custom:hover {
            background: linear-gradient(135deg, #ee0979, #ff6a00);
            transform: scale(1.05);
            box-shadow: 0px 6px 15px rgba(0, 0, 0, 0.3);
        }
        .btn-custom:active {
            transform: scale(0.95);
        }
      /* Custom Select2 to Match Filter Box */
      .select2-container--default .select2-selection--single {
        background: transparent !important;
        border: none !important;
        border-radius: 50px !important;
        /* height: 40px !important; */
        /* display: flex;
        align-items: center; */
        padding:0 10px;
        }
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: #555 !important;
            font-size: 16px !important;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            top: 50% !important;
            transform: translateY(-50%);
            right: 10px;
        }
        /* Dropdown Styling */
        .select2-dropdown {
            border-radius: 10px !important;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1) !important;
        }
        .fw-bold{
            font-weight: 600 !important;
        }
        .skill-span {
            display: inline-block;
            max-width: 100%; /* Ensures it doesn't exceed the container */
            word-wrap: break-word; /* Breaks long words */
            white-space: normal; /* Allows text wrapping */
        }
        .skill-span {
            overflow-wrap: break-word;
            word-break: break-word;
        }
        /* Bottom Modal (Initially Hidden) */
        .sidebar-modal {
            position: fixed;
            left: 0;
            bottom: -100%; /* Start hidden below the screen */
            width: 100%;
            height: 60vh; /* Adjust the height as needed */
            background: white;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.2);
            transition: bottom 0.4s ease-in-out;
            z-index: 1050;
            display: flex;
            flex-direction: column;
            border-radius: 15px 15px 0 0; /* Rounded top corners */
        }
        /* Show the Modal */
        .sidebar-modal.show {
            bottom: 0;
        }
        /* Modal Overlay */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1040;
            display: none;
        }
        /* Modal Content */
        .sidebar-modal .modal-content {
            display: flex;
            flex-direction: column;
            height: 100%;
        }
        /* Modal Body */
        .sidebar-modal .modal-body {
            flex-grow: 1;
            overflow-y: auto;
            display: flex;
            padding: 5px;
        }
        /* Sidebar Tabs */
        .filter-tabs {
            width: 42%;
            border-right: 1px solid #ddd;
            padding-right: 6px;
        }
        .filter-tabs .nav-link {
            padding: 10px;
            color: #333;
        }
        .filter-tabs .nav-link.active {
            background-color: #007bff;
            color: white;
        }
        /* Footer Buttons */
        .sidebar-modal .modal-footer {
            padding: 10px;
            display: flex;
            justify-content: space-between;
            border-top: 1px solid #ddd;
        }
        .sidebar-modal .modal-footer button {   
            width: 47%;
            background: #fe6600;
            color: white;
            font-size: 16px;
            /* padding: 12px; */
            border-radius: 10px;
            border: none;
        }
        label span {
            color: #444242;
        }
    </style>
@endsection
@section('content')
    <!-- Desktop Search (Hidden on Mobile) -->
    <div class="col-12 col-lg-12 col-md-12 mb-4 desktop-search">
        <form class="jobDeskFilterForm">
            <div class="filter-box">
                <!--<select name="job_type">-->
                <!--    <option value="">All Types</option>-->
                <!--    <option value="Internship">Internship</option>-->
                <!--    <option value="Part Time">Part-Time</option>-->
                <!--    <option value="Full Time">Full-Time</option>-->
                <!--</select>-->
                <input type="text" placeholder="Job Title (e.g. Digital Marketing Jobs)" name="title">
                <!--<select  class="select2 citySelect" name="city">-->
                <!--    <option value="">Choose City..</option>-->
                <!--</select>-->
                <button type="submit"  class="btn"><i class="fas fa-search"></i> Search</button>
                <button type="reset"  class="btn" style=" background:#5a6268"><a href="{{url('/jobs')}}" style="color: #fff;text-decoration: none;><i class="fa-solid fa-arrows-rotate"></i> Refresh</a></button>
            </div>
        </form>
    </div>
     <!-- Mobile Search (Hidden on Desktop) -->
    <div class="container my-2 text-center mobile-searchs">
        <div class="row align-items-center">
            <div class="col-2">
                <i class="bi bi-funnel fs-1" id="filter-icon" style="cursor: pointer;"></i>
            </div>
            <div class="col-10">
                <div class="mobile-search" data-bs-toggle="modal" data-bs-target="#searchModal">
                    <span>Search...</span>
                    <i class="fas fa-search"></i>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Overlay -->
    <div class="modal-overlay" id="modal-overlay"></div>
    <!-- Sliding Sidebar Modal -->
    <div class="sidebar-modal" id="filter-modal">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-between align-items-center">
                <h2><b>All Filters</b></h2>
                <!-- <i class="bi bi-x-circle fs-4" id="close-filter" style="cursor: pointer;"></i>   -->
            </div>
            <form  class="mobileFilterForm">
                <div class="modal-body d-flex">
                    <div class="filter-tabs">
                        <ul class="nav flex-column nav-pills" id="filterTabs">
                            @if(isset($filters))
                                @foreach($filters as $filter) 
                                    <li class="nav-item">
                                        <a class="nav-link {{ $loop->first ? 'active' : '' }}" data-bs-toggle="pill" href="#filter-{{ $filter->id }}">{{ $filter->name }}</a>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                    <div class="tab-content flex-grow-1">
                        @if(isset($filters))
                            @foreach($filters as $filter)
                                <div id="filter-{{ $filter->id }}" class="tab-pane fade {{ $loop->first ? 'show active' : '' }}">
                                    @foreach($filter->value as $value)
                                        <label class="form-check mb-2">
                                            <input class="form-check-input mx-2" type="checkbox" name="{{$filter->name}}[]" value="{{$value->name}}">
                                            <span class="form-check-label">{{ $value->name }}</span>
                                        </label>
                                    @endforeach
                                    <hr>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" id="clear-filters">Clear</button>
                    <button class="btn btn-primary" type="submit">Apply</button>
                </div>
            </form>
        </div>
    </div>
     <!-- Mobile Search Modal -->
    <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <form class="jobFilterForm">
                <div class="modal-header">
                    <h5 class="modal-title">Search Filters</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="text" placeholder="Job Title (e.g. Digital Marketing Jobs)" name="title" class="form-control mb-2">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn" style="height:45px;">
                        <i class="fas fa-search"></i> Search
                    </button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- jOB dATA  -->
    <aside>
        <scetion>
            <div class="job-container py-4">
                <div class="row">
                    <div class="col-3 filter-section">
                        <div class="card">
                            <article class="card-group-item">
                                <header class="card-header">
									<h2><b>All Filters</b></h2>
                                </header>
                                <center>
                                    <form class="deskFilterForm">
                                        <div class="my-2 rounded">
                                            <div class="filter-content">
                                                <div class="card-body text-start">
                                                    <h2 class="title">Work Mode</h2>
                                                    <label class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="Work Mode[]" value="Work from home">
                                                        <span class="form-check-label">Work from home</span>
                                                    </label> 
                                                    <label class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="Work Mode[]" value="Work from Office">
                                                        <span class="form-check-label">Work from Office</span>
                                                    </label> 
                                                    <label class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="Work Mode[]" value="Hybrid">
                                                        <span class="form-check-label">Hybrid</span>
                                                    </label> 
                                                    <label class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="Work Mode[]" value="Remote">
                                                        <span class="form-check-label">Remote</span>
                                                    </label> 
                                                    <button class="btn mt-2 px-4 text-light" type="reset" style="background:#5a6268">Clear</button>   
                                                    <button class="btn mt-2 px-4 text-light" type="submit" style="background:rgb(252, 102, 1)">Apply</button>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="my-2 rounded">
                                            <div class="filter-content">
                                                <div class="card-body text-start">
                                                    <h2 class="title">Salary Range</h2>
                                                    <label class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="Salary Range[]" value="Under 3,00,000">
                                                        <span class="form-check-label">Under 3,00,000</span>
                                                    </label> 
                                                                                                                    <label class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="Salary Range[]" value="3,00,000 to 6,00,000">
                                                        <span class="form-check-label">3,00,000 to 6,00,000</span>
                                                    </label> 
                                                                                                                    <label class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="Salary Range[]" value="6,00,000 to 8,00,000">
                                                        <span class="form-check-label">6,00,000 to 8,00,000</span>
                                                    </label> 
                                                                                                                    <label class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="Salary Range[]" value="8,00,000 to 10,00,000">
                                                        <span class="form-check-label">8,00,000 to 10,00,000</span>
                                                    </label> 
                                                                                                                    <label class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="Salary Range[]" value="10,00,000 to 15,00,000">
                                                        <span class="form-check-label">10,00,000 to 15,00,000</span>
                                                    </label> 
                                                                                                                    <label class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="Salary Range[]" value="Above 15,00,000">
                                                        <span class="form-check-label">Above 15,00,000</span>
                                                    </label> 
                                                    <button class="btn mt-2 px-4 text-light" type="reset" style="background:#5a6268">Clear</button>   
                                                    <button class="btn mt-2 px-4 text-light" type="submit" style="background:rgb(252, 102, 1)">Apply</button>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="my-2 rounded">
                                            <div class="filter-content">
                                                <div class="card-body text-start">
                                                    <h2 class="title">Experience</h2>
                                                    <label class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="Experience[]" value="1 year">
                                                        <span class="form-check-label">1 year</span>
                                                    </label> 
                                                    <label class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="Experience[]" value="2 year">
                                                        <span class="form-check-label">2 year</span>
                                                    </label> 
                                                    <label class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="Experience[]" value="3 yaer">
                                                        <span class="form-check-label">3 yaer</span>
                                                    </label> 
                                                    <label class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="Experience[]" value="4 year">
                                                        <span class="form-check-label">4 year</span>
                                                    </label> 
                                                    <label class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="Experience[]" value="5 year">
                                                        <span class="form-check-label">5 year</span>
                                                    </label> 
                                                    <label class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="Experience[]" value="Above 5 year">
                                                        <span class="form-check-label">Above 5 year</span>
                                                    </label> 
                                                    <button class="btn mt-2 px-4 text-light" type="reset" style="background:#5a6268">Clear</button>   
                                                    <button class="btn mt-2 px-4 text-light" type="submit" style="background:rgb(252, 102, 1)">Apply</button>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="my-2 rounded">
                                            <div class="filter-content">
                                                <div class="card-body text-start">
                                                    <h4 class="title">State</h4>
                                                    <label class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="state[]" value="39">
                                                        <span class="form-check-label">Uttarakhand</span>
                                                    </label> 
                                                    <button class="btn mt-2 px-4 text-light" type="reset" style="background:#5a6268">Clear</button>   
                                                    <button class="btn mt-2 px-4 text-light" type="submit" style="background:rgb(252, 102, 1)">Apply</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </center>
                            </article>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="my-1 px-4">
                            {{-- <span id="job-count">{{$jobcount ?? 0 }}</span> jobs Found  --}}
                        </div>
                        <div id="job-list">
                           @if(isset($jobPostDatas))
                            @forelse($jobPostDatas as $jobPostData)
                            <div class="job-item">
                                @php 
                                    $createdAt = strtotime($jobPostData->created_at);
                                    $today = time(); // Current timestamp
                                    $diffInSeconds = $today - $createdAt; // Difference in seconds
                                    $diffInDays = floor($diffInSeconds / (60 * 60 * 24)); // Convert seconds to days
                                @endphp
                                <div class="card mb-4">
                                    <a href="{{ url('jobs', $jobPostData->slug) }}" style="color: #000000;text-decoration: none;">
                                        <article class="card-group-item">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-9">
                                                    <h2 class="mb-1 fw-bold">{{ ucfirst($jobPostData->title) ?? '' }}</h2>
                                                    <h3 class=""> {{ ucfirst($jobPostData->company_name) ?? '' }}</h3>
                                                    </div>
                                                    <div class="col-3 text-end">
                                                    <img class="img-thumbnail rounded float-left" src="{{$jobPostData->image ?? 'default.jpg' }}" alt="{{ $jobPostData->title }}" >
                                                    </div>
                                                </div>
                                                <div class="desk-span">
                                                    <span><i class="bi bi-bag-dash"></i> Experince :{{$jobPostData->experience}}
                                                    </span>|
                                                    <span ><i class="bi bi-geo-alt"></i> location : {{ isset($jobPostData->locality) ? $jobPostData->city : '' }}</span>|
                                                    <span><i class="bi bi-currency-rupee"></i> Salary: {{ $jobPostData->salary_from . '-' . $jobPostData->salary_to ?? '--' }} Month</span></p>
                                                </div>
                                                <div class="row mobile-span">
                                                    <div class="col-12 col-lg-4"><i class="bi bi-bag-dash"></i> Experince: @if(isset($jobPostData->experience))
                                                            @if(ctype_alpha($jobPostData->experience))
                                                                {{ $jobPostData->experience ?? '--' }}  
                                                            @elseif(is_numeric($jobPostData->experience))
                                                                {{ $jobPostData->experience . ' Year' ?? '--' }}
                                                            @endif
                                                        @else @endif</div>
                                                    <div class="col-12 col-lg-4"><i class="bi bi-geo-alt"></i> location : {{ isset($jobPostData->cityname) ? $jobPostData->cityname->name : '' }}</div>
                                                    <div class="col-12 col-lg-4"><i class="bi bi-currency-rupee"></i> Salary: {{ $jobPostData->salary_from . '-' . $jobPostData->salary_to ?? '--' }} Month</div>
                                                </div>
                                                <p class="mt-1 px-1">Job Type: {{ $jobPostData->job_type ?? '' }}</p>
                                                <p class="mt-2">Skills:
                                                @if($jobPostData->skills)
                                                    @foreach(json_decode($jobPostData->skills, true) as $skill)
                                                        <span class="skill-span">{{ $skill ?? '' }}</span>  
                                                    @endforeach
                                                @endif
                                                <div class="d-flex justify-content-between align-items-center mt-2">
                                                    <span>
                                                            <i class="bi bi-calendar-week"></i> 
                                                            {{ $diffInDays < 1 ? 'few hrs ago' : abs($diffInDays) . ' day' . (abs($diffInDays) > 1 ? 's' : '') . ' ago' }} 
                                                        </span>
                                                        <span>
                                                            <i class="bi bi-people"></i> 
                                                            @if($jobPostData->jobUser)
                                                            {{$jobPostData->jobUser->count()}}
                                                            @endif
                                                            Applicants
                                                        </span>
                                                </div>
                                            </div>
                                    </article>
                                    </a>
                                    </div>
                                    </div>
                                @empty
                                <center>
                                    <img src="{{ asset('images/listing.png') }}" width="70%" class="nojobs mt-5">
                                </center>
                                @endforelse
                            @endif 
                        </div>
                       @if($jobPostDatas->count() ?? 0>= 10)
                        <center>
                            <button id="load-more" data-offset="10" class="btn-custom w-50 mb-4 btn-lg">
                                <span>View More</span> <i class="fas fa-chevron-down"></i>
                            </button>
                        </center>
                        @endif  
                    </div>
                    <div class="col-3 banner-section">
                        <!-- <div class="swiper mySwiper mb-4">
                            <div class="swiper-wrapper">
                            <div class="swiper-slide"><a href="{{ asset('images/Banners/digital-marketing-course.jpg') }}"><img class="img-fluid rounded" src="post-free-job.gif" style="height:220px;"></a></div>
                            </div>
                        </div> -->
                        <img class="img-fluid rounded" src="https://www.addressguru.in/Banners/digital-marketing-course.jpg">
                    </div>
                </div>
            </div>
        </scetion>
    </aside>
@endsection
@section('footer')
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
            // Initialize Select2
            $('.citySelect').select2({
                placeholder: "Choose City...",
                allowClear: true
            });
            // Open filter modal
            $("#filter-icon").click(function () {
                $("#filter-modal").addClass("show");
                $("#modal-overlay").fadeIn();
            });
            // Close filter modal
            $("#close-filter, #clear-filters, #modal-overlay").click(function () {
                $("#filter-modal").removeClass("show");
                $("#modal-overlay").fadeOut();
            });
            let offset = 10;
            let limit = 10; // Number of jobs per load
            function fetchJobs(clearResults = false, formClass = ".jobFilterForm", loadMore = false) {
                if (clearResults) {
                    offset = 0;
                }
                let formData = $(formClass).serialize();
                formData += `&offset=${offset}&limit=${limit}`;
                $.ajax({
                    url: "/jobs/load-more",
                    type: "GET",
                    data: formData,
                    beforeSend: function () {
                        if (loadMore) {
                            $("#load-more").text("Loading...").prop("disabled", true);
                        }
                    },
                    success: function (response) {
                        if (clearResults) {
                            $("#job-list").html("");
                        }
                        if (response.data.length > 0) {
                            $.each(response.data, function (index, job) {
                                if ($(`#job-${job.id}`).length === 0) {
                                    let expireDate = new Date(job.created_at).getTime();
                                    let today = new Date().getTime();
                                    let diffInDays = Math.floor((today - expireDate) / (1000 * 60 * 60 * 24));
                                    let jobHtml = `
                                    <div class="job-item" id="job-${job.id}">
                                        <div class="card mb-4">
                                            <a href="/jobs/${job.slug}" style="color: #000000;text-decoration: none;">
                                                <article class="card-group-item">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-9">
                                                                <h2 class="mb-1"><b>${job.title.charAt(0).toUpperCase() + job.title.slice(1)}</b></h2>
                                                                <h3>${job.user.name.charAt(0).toUpperCase() + job.user.name.slice(1)}</h3>
                                                            </div>
                                                            <div class="col-3 text-end">
                                                                <img class="img-thumbnail rounded float-left" src="${job.user.photo ? job.user.photo : 'default.jpg'}" alt="${job.title}">
                                                            </div>
                                                        </div>
                                                        <div class="desk-span">
                                                            <span><i class="bi bi-bag-dash"></i> Experience: ${job.experience ? (isNaN(job.experience) ? job.experience : job.experience + ' Year') : '--'}</span> |
                                                            <span><i class="bi bi-geo-alt"></i> Location: ${job.cityname ? job.cityname.name : ''}</span> |
                                                            <span><i class="bi bi-currency-rupee"></i> Salary: ${job.salary_from ?? '--'} - ${job.salary_to ?? '--'} Month</span>
                                                        </div>
                                                        <div class="row mobile-span">
                                                            <div class="col-12 col-lg-4"><i class="bi bi-bag-dash"></i> Experience: ${job.experience ? (isNaN(job.experience) ? job.experience : job.experience + ' Year') : '--'}</div>
                                                            <div class="col-12 col-lg-4"><i class="bi bi-geo-alt"></i> Location: ${job.cityname ? job.cityname.name : ''}</div>
                                                            <div class="col-12 col-lg-4"><i class="bi bi-currency-rupee"></i> Salary: ${job.salary_from ?? '--'} - ${job.salary_to ?? '--'} Month</div>
                                                        </div>
                                                        <p class="mt-1 px-1">Job Type: ${job.type ?? ''}</p>
                                                        <p class="mt-2">Skills: <span class="skill-span">Html</span> <span class="skill-span">Css</span></p>
                                                        <div class="d-flex justify-content-between align-items-center mt-2">
                                                            <span>
                                                                <i class="bi bi-calendar-week"></i> 
                                                                ${diffInDays < 0 ? Math.abs(diffInDays) + ' days ago' : diffInDays + ' days ago'}
                                                            </span>
                                                            <span>
                                                                <i class="bi bi-people"></i> 10 Applicants
                                                            </span>
                                                        </div>
                                                    </div>
                                                </article>
                                            </a>
                                        </div>
                                    </div>`;
                                    $("#job-list").append(jobHtml);
                                }
                            });
                            offset += limit;
                            if (response.count !== undefined) {
                                $('#job-count').text(response.count);
                            }
                            $("#load-more").data("offset", offset).show();
                        } else {
                            if (clearResults) {
                                $("#job-list").html('<center><img src="/nojobs.png" width="70%"></center>');
                            }
                            $("#load-more").hide();
                        }
                        $("#load-more").text("View More").prop("disabled", false);
                    }
                });
            }
            // Common Function to Handle Filter Form Submission
            function handleFilterSubmission(formClass) {
                $(formClass).submit(function (e) {
                    e.preventDefault();
                    let hasFilters = $(this).find("input:checked, select").length > 0;
                    fetchJobs(true, formClass);
                    $("#filter-modal").removeClass("show"); // Close modal after applying filters
                    $("#modal-overlay").fadeOut(); // Hide overlay
                });
            }
            // Apply filter form submission for all filter sections
            handleFilterSubmission(".jobFilterForm");
            handleFilterSubmission(".jobDeskFilterForm");
            handleFilterSubmission(".deskFilterForm");
            handleFilterSubmission(".mobileFilterForm");
            // Open modal when a filter button is clicked
            $("#filter-icon").click(function () {
                $("#filter-modal").addClass("show");
                $("#modal-overlay").fadeIn();
            });
            // Close modal when clicking on the close button or outside the modal
            $("#close-filter, #clear-filters, #modal-overlay").click(function () {
                $("#filter-modal").removeClass("show");
                $("#modal-overlay").fadeOut();
            });
            // Clear Button Functionality for Filters
            $(".deskFilterForm button[type='refresh']").click(function (e) {
                e.preventDefault();
                $(".deskFilterForm")[0].reset(); // Reset form fields
                fetchJobs(true, ".deskFilterForm"); // Reload jobs without filters
            });
            // Load More Button Click Event
            $("#load-more").on("click", function () {
                fetchJobs(false, ".jobFilterForm", true);
            });
        });
    </script>
    <script>    
        document.getElementById("close-filter").addEventListener("click", function() {
            document.getElementById("filter-modal").style.display = "none";
        });
    </script>
@endsection