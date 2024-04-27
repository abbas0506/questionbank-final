<div>
    @if($errors!=null)
    @if ($errors->any())
    <div class="alert-danger my-4">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    @endif

    @if (session('success'))
    <div class="alert-success my-4">
        <i class="bi-emoji-smile text-[24px] mr-4"></i>
        {{ session('success') }}
    </div>
    @endif

    @if (session('warning'))
    <div class="alert-warning my-4">
        <i class="bi-emoji-neutral text-[24px] mr-4"></i>
        {{ session('warning') }}
    </div>
    @endif

</div>