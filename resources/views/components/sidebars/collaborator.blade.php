<aside aria-label="Sidebar" id='sidebar'>
    <div class="flex items-center justify-center w-full mt-16">
        <a href="{{url('/')}}" class="">
            <img alt="logo" src="{{asset('images/logo/app_logo.png')}}" class="w-8 h-8">
        </a>
    </div>
    <div class="mt-8 font-bold text-center text-slate-800 uppercase tracking-wide">Exampixel</div>
    <div class="text-xs text-center text-green-600">Collaborator Panel</div>
    <div class="mt-12">
        <ul class="space-y-2">
            <li>
                <a href="{{url('collaborator')}}" class="flex items-center p-2">
                    <i class="bi-house @if($page=='home') current-page @endif"></i>
                    <span class="ml-3">Home</span>
                </a>
            </li>
            <li>
                <a href="{{ route('collaborator.book.approvables.index',0) }}" class="flex items-center p-2">
                    <i class="bi-bookmark-check @if($page=='approval') current-page @endif"></i>
                    <span class="ml-3">Approvable Qs.</span>
                </a>
            </li>
            <li>
                <a href="{{ route('collaborator.papers.index') }}" class="flex items-center p-2">
                    <i class="bi bi-files"></i>
                    <span class="ml-3">Create Paper</span>
                </a>
            </li>
            <li>
                <a href="" class="flex items-center p-2">
                    <i class="bi bi-laptop"></i>
                    <span class="ml-3">Generate Quiz</span>
                </a>
            </li>
            <li>
                <a href="" class="flex items-center p-2">
                    <i class="bi-file-medical"></i>
                    <span class="ml-3">Feed Result</span>
                </a>
            </li>
            <li>
                <a href="" class="flex items-center p-2">
                    <i class="bi bi-graph-up"></i>
                    <span class="ml-3">Progress Analysis</span>
                </a>
            </li>
        </ul>
    </div>
</aside>