<aside aria-label="Sidebar" id='sidebar'>
    <div class="mt-8 font-bold text-center text-orange-300 uppercase tracking-wide">Administration</div>
    <div class="text-xs text-center">Exam System</div>
    <div class="mt-12">
        <ul class="space-y-2">
            <li>
                <a href="{{url('admin')}}" class="flex items-center p-2">
                    <i class="bi-house"></i>
                    <span class="ml-3">Home</span>
                </a>
            </li>
            <li>
                <a href="" class="flex items-center p-2">
                    <i class="bi bi-box"></i>
                    <span class="ml-3">Package Desc.</span>
                </a>
            </li>

            <li>
                <a href="{{route('admin.users.index')}}" class="flex items-center p-2">
                    <i class="bi bi-person-gear"></i>
                    <span class="ml-3">User Management</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.data.index') }}" class="flex items-center p-2">
                    <i class="bi bi-database-gear"></i>
                    <span class="ml-3">Data Management</span>
                </a>
            </li>
        </ul>
    </div>
</aside>