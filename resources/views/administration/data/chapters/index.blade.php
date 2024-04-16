@extends('layouts.admin')
@section('page-content')

<div class="custom-container">
    <h1>Chapters Managment</h1>
    <div class="bread-crumb">
        <a href="{{url('admin')}}">Home</a>
        <div>/</div>
        <a href="{{route('admin.data.index')}}">Data</a>
        <div>/</div>
        <a href="{{route('admin.books.index')}}">Books</a>
        <div>/</div>
        <div>Chapters</div>
    </div>

    <!-- page message -->
    @if($errors->any())
    <x-message :errors='$errors'></x-message>
    @else
    <x-message></x-message>
    @endif

    <div class="content-section md:p-16">

        <h2>{{ $book->name }}</h2>
        <div class="flex items-center flex-wrap justify-between gap-3 mt-3">
            <!-- search -->
            <div class="flex relative w-full md:w-1/3">
                <input type="text" id='searchby' placeholder="Search ..." class="custom-search w-full" oninput="search(event)">
                <i class="bx bx-search absolute top-2 right-2"></i>
            </div>
            <a href="{{route('admin.book.chapters.create', $book)}}" class="btn-teal rounded">New</a>
        </div>


        @php $sr=1; @endphp
        <div class="overflow-x-auto">
            <table class="table-fixed w-full mt-3">
                <thead>
                    <tr class="border-b border-slate-200">
                        <th class="w-16">Sr</th>
                        <th class="w-48">Chapter Title</th>
                        <th class="w-24">Action</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($book->chapters->sortBy('chapter_no') as $chapter)
                    <tr class="tr">
                        <td>{{$chapter->chapter_no}}</td>
                        <td class="text-left">{{$chapter->name}}</td>
                        <td>
                            <div class="flex justify-center items-center space-x-3">
                                <a href="{{route('admin.book.chapters.edit', [$book,$chapter])}}">
                                    <i class="bx bx-pencil text-green-600"></i>
                                </a>
                                <span class="text-slate-400">|</span>
                                <form action="{{route('admin.book.chapters.destroy',[$book,$chapter])}}" method="POST" onsubmit="return confirmDel(event)">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-transparent p-0 border-0">
                                        <i class="bx bx-trash text-red-600"></i>
                                    </button>
                                </form>
                            </div>

                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>
<script type="text/javascript">
    function confirmDel(event) {
        event.preventDefault(); // prevent form submit
        var form = event.target; // storing the form

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                form.submit();
            }
        })
    }

    function search(event) {
        var searchtext = event.target.value.toLowerCase();
        var str = 0;
        $('.tr').each(function() {
            if (!(
                    $(this).children().eq(1).prop('outerText').toLowerCase().includes(searchtext)
                )) {
                $(this).addClass('hidden');
            } else {
                $(this).removeClass('hidden');
            }
        });
    }
</script>

@endsection