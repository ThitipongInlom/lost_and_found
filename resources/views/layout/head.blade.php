@php
    use App\Http\Controllers\web_setting AS web_setting;
    $ver = web_setting::system_ver();
@endphp
<!-- Head -->
<nav class="navbar navbar-expand-md navbar-dark bg-navbarcolor">
    <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="{{ url('/') }}">
                    <img src="{{ url('img/web_setting/icon.gif') }}" width="100" height="30" alt="Logo Hotel">
                        <b>The Zgin Hotel</b>
                </a>
            </li>
        </ul>
    </div>
    <div class="mx-auto order-0">
        <a class="navbar-brand mx-auto" href="{{ url('/') }}">Lost And Found V {{ $ver }}</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".dual-collapse2">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
    <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <select class="form-control" id="lang_select" url_base="{{ url('/') }}">
                    <option value="th" data-image="{{ url('img/web_setting/th.png') }}" @if (app()->getLocale() == 'th') {{ 'selected' }} @endif>@lang('login.lang_thai')</option>
                    <option value="en" data-image="{{ url('img/web_setting/en.png') }}" @if (app()->getLocale() == 'en') {{ 'selected' }} @endif>@lang('login.lang_english')</option>
                </select>  
            </li>
            @if (Auth::User()->status == 'admin')
            <li class="nav-item dropdown active">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <b><i class="fas fa-cogs"></i> @lang('login.setting')</b>
                </a>
                <div class="dropdown-menu dropdown-menu-lg-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ url('/setting_user') }}"><i class="fas fa-user-cog"></i> @lang('login.manage_users')</a>
                    <a class="dropdown-item" href="{{ url('/setting_type') }}"><i class="fas fa-briefcase"></i> @lang('login.manage_type')</a>
                <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ url('/setting_web') }}"><i class="fas fa-sliders-h"></i> @lang('login.setting_system')</a>
                 </div>
            </li>
            @endif
            <li class="nav-item">
                <a class="nav-link active" href="{{ url('/logout') }}"><b><i class="fas fa-sign-out-alt"></i> @lang('login.sign_out')</b></a>
            </li>
        </ul>
    </div>
</nav>