<nav class="navm nav-desk d-flex aic jcsb">
    <div class="row">
        <div class="col-1">
            <a class="btn-snav" href="#" style="margin-right: 5px;">
                <i class="fa fa-bars" style="font-size: 28px;"></i>
            </a>
        </div>
        <div class="col-2">
            <a href="https://www.addressguru.in" class="navbar-brand" style="padding: 8px 10px;">
                <img src="https://www.addressguru.in/images/logopng.png" id="logo" alt="Address Guru" width="150" class="img-responsive" />
            </a>
        </div>
        <div class="col-4">
            <form style="width: calc(100% - 160px);display: flex;">
                <div>
                    <select class="form-control ctydd" data-live-search="true">
                        <option>Choose City</option>
                        @foreach($cities as $city)
                            @if($city != null)
                            <option value="{{ $city }}">{{ $city }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="input-group">
                    <input class="form-control" type="text" />
                    <span class="input-group-btn">
                        <button class="btn btn-default">
                            <i class="fa fa-search" aria-hidden="true"></i>
                        </button>
                    </span>
                </div>
            </form>
        </div>
        <div class="col-5">
            <ul class="list-inline">
                <li style="width:11%;">
                    <a href="https://www.addressguru.in/marketplace-category/Properties/ToLet">
                    <span class="btn btn-link btn-md" style="text-decoration: none;">
                        <i class="fa fa-home" style="font-size: 20px;padding-top: 6px;"></i>
                        <br>
                        <span style="font-size:11px;text-decoration: none;letter-spacing: 2px;"> To Let</span>
                    </span>
                    </a>
                </li>
                <li style="width:10%;">
                    <a href="https://www.addressguru.in/jobs/Dehradun ">
                    <span class="btn btn-link btn-md" style="text-decoration: none;">
                        <i class="fa fa-briefcase" style="font-size: 18px;padding-top: 6px;"></i>
                        <br>
                        <span style="font-size:11px;text-decoration: none;letter-spacing: 2px;"> Jobs</span>
                    </span>
                    </a>
                </li>
                <li>
                    <a href="#" style="display: inline-block;">
                        <span class="btn btn-link btn-md icon" style="text-decoration: none;text-align: center;border-right: 1px solid lightgray;margin-bottom: -3px;">
                            <i class="fa fa-shopping-cart" style="font-size: 20px;"></i>
                            <br />
                            <span style="font-size:11px;text-decoration: none;letter-spacing: 2px;">Marketplace</span>
                        </span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('marketplace-post') }}" class="btn btn-warning btn-pfad">
                        <span>Post Free Ad</span>
                        <i class="fa fa-plus fa-fw"></i>
                    </a>
                </li>
                @auth
                <li>
                    <a href="{{ url('/admin') }}" class="btn btn-primary">
                        <i class="fa fa-sign-out"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                @else
                <li>
                    <a href="{{ url('/login') }}" class="btn btn-primary">
                        <i class="fa fa-sign-in"></i>
                        <span>Login</span>
                    </a>
                </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>