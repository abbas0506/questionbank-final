<header>
    <div class="flex flex-wrap w-full h-16 items-center justify-between px-4 md:px-12 border-b">

        <div class="flex items-center">
            <a href="{{url('/')}}">
                <img alt="logo" src="{{asset('images/logo/app_logo.png')}}" class="w-10 h-10">
            </a>
            <div class="text-base md:text-xl font-semibold ml-2">Exam System</div>
        </div>
        <!-- right sided current user info -->
        <div id="current-user-area" class="flex space-x-3 items-center justify-center relative">
            <label for="toggle-current-user-dropdown" class="hidden md:flex items-center">
                <div class="">{{Auth::user()->name}}</div>
            </label>
            <a href="{{url('signout')}}" class="flex items-center justify-center w-8 h-8 rounded-full"><i class="bi bi-power"></i></a>
            <div id='menu' class="flex md:hidden">
                <i class="bi bi-list"></i>
            </div>
        </div>
    </div>

</header>