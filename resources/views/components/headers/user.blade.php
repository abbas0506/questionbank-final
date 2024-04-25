<header class="user-header">
    <div class="flex flex-wrap w-full h-16 items-center justify-between px-4 md:px-6 shadow-sm">

        <div class="flex items-center">
            <a href="{{url('/')}}" class="md:hidden flex justify-center">
                <img alt="logo" src="{{asset('images/logo/app_logo.png')}}" class="w-8 h-8">
            </a>
            <div class="text-base font-semibold ml-2"> {{ $page }} {!! $icon !!}</div>
        </div>
        <div id="current-user-area" class="flex space-x-3 items-center justify-center relative">
            <label for="toggle-current-user-dropdown" class="hidden md:flex items-center">
                <div class="">{{ Auth::user()->name }}</div>
            </label>
            <a href="{{url('signout')}}" class="flex items-center justify-center w-8 h-8 rounded-full"><i class="bi bi-power"></i></a>
            <div id='menu' class="flex md:hidden">
                <i class="bi bi-list"></i>
            </div>
        </div>
    </div>

</header>