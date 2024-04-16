<aside aria-label="Sidebar" id='sidebar'>
    <div class="mt-8 font-bold text-center text-orange-300 uppercase tracking-wider">GHSS</div>
    <div class="text-xs text-center">Chak Bedi, Pakpattan</div>
    <div class="mt-12">
        <ul class="space-y-2">
            <li>
                <a href="{{url('operator')}}" class="flex items-center p-2">
                    <i class="bi-house"></i>
                    <span class="ml-3">Home</span>
                </a>
            </li>
            <!-- <li>
                <a href="" class="flex items-center p-2">
                    <i class="bi-book"></i>
                    <span class="ml-3">Subjects</span>
                </a>
            </li> -->
            <li>
                <a href="{{route('teacher.qbank.index')}}" class="flex items-center p-2">
                    <i class="bi-question-circle"></i>
                    <span class="ml-3">Q. Bank</span>
                </a>
            </li>
            <li>
                <a href="{{route('teacher.tests.create')}}" class="flex items-center p-2">
                    <i class="bi-file-text"></i>
                    <span class="ml-3">Create Test</span>
                </a>
            </li>

        </ul>
    </div>
</aside>