<div class="tabs-upper" id="content">
    <a href="#" class="mx-1">
        <span class="badge" style="margin-left:0px;">All</span>
    </a>

    @foreach($subcategories->take(5) as $s)
        <a href="javascript:void(0)" class="mx-2 filter-badge" data-subcategory="{{ $s->id }}">
            <span class="badge {{ request()->get('subcategory') == $s->id ? 'active' : '' }}">{{ $s->name }}</span>
        </a>
    @endforeach

    @if($subcategories->count() > 5)
        <a href="javascript:void(0)" onclick="toggle_visibility('menu-drop')">
            <span class="badge">More <i class="fa fa-angle-down"></i></span>
        </a>
    @endif

    <div class="drop-box" id="menu-drop" style="display: none;">
        @foreach($subcategories->skip(5) as $s)
            <a href="javascript:void(0)" class="filter-badge" data-subcategory="{{ $s->id }}">
                <span class="badge {{ request()->get('subcategory') == $s->id ? 'active' : '' }}">{{ $s->name }}</span>
            </a>
        @endforeach

        <div class="clearfix mt-2"></div>
        <div class="alert alert-info text-center" style="margin-bottom:0px;">
            <strong>AD Banner</strong>
        </div>
    </div>
</div>
