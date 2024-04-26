<aside aria-label="Sidebar" id='sidebar'>
    <div class="flex items-center justify-center w-full mt-16">
        <a href="{{url('/')}}" class="">
            <img alt="logo" src="{{asset('images/logo/app_logo.png')}}" class="w-8 h-8">
        </a>
    </div>
    <div class="mt-8 font-bold text-center uppercase tracking-wide">Exampixel</div>
    <div class="text-xs text-center text-green-800">Data Entry</div>
    <div class="mt-12">
        <ul class="space-y-2">
            <li>
                <a href="{{url('/')}}" class="flex items-center p-2">
                    @if($page=='home')
                    <i class="bi-house current-page"></i>
                    @else
                    <i class="bi-house"></i>
                    @endif
                    <span class="ml-3">Home</span>
                </a>
            </li>
            <li>
                <a href="{{url('/')}}" class="flex items-center p-2">
                    <i class="bi bi-database-gear @if($page=='questions') current-page @endif"></i>
                    <span class="ml-3">Questions</span>
                </a>
            </li>

            <!-- <li>
                <a href="{{route('admin.users.index')}}" class="flex items-center p-2">
                    <i class="bi bi-person-gear @if($page=='users') current-page @endif"></i>
                    <span class="ml-3">Books</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.data.index') }}" class="flex items-center p-2">
                    <i class="bi bi-database-gear @if($page=='data') current-page @endif"></i>
                    <span class="ml-3">Chapters</span>
                </a>
            </li> -->
        </ul>
    </div>
</aside>