<aside aria-label="Sidebar" id='sidebar'>
    <div class="flex items-center justify-center w-full mt-16">
        <a href="{{url('/')}}" class="">
            <img alt="logo" src="{{asset('images/logo/app_logo.png')}}" class="w-8 h-8">
        </a>
    </div>
    <div class="mt-8 font-bold text-center text-orange-300 uppercase tracking-wide">Exampixel</div>
    <div class="text-xs text-center text-green-600">admin panel</div>
    <div class="mt-12">
        <ul class="space-y-2">
            <li>
                <a href="{{url('admin')}}" class="flex items-center p-2">
                    <i class="bi-house @if($page=='home') current-page @endif"></i>
                    <span class="ml-3">Home</span>
                </a>
            </li>
            <li>
                <a href="" class="flex items-center p-2">
                    <i class="bi bi-box @if($page=='packages') current-page @endif"></i>
                    <span class="ml-3">Packages</span>
                </a>
            </li>

            <li>
                <a href="{{route('admin.users.index')}}" class="flex items-center p-2">
                    <i class="bi bi-person-gear @if($page=='users') current-page @endif"></i>
                    <span class="ml-3">Users</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.grades.index') }}" class="flex items-center p-2">
                    <i class="bi bi-database-gear @if($page=='qbank') current-page @endif"></i>
                    <span class="ml-3">Q.Bank</span>
                </a>
            </li>
        </ul>
    </div>
</aside>