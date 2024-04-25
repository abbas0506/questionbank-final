@extends('layouts.basic')

@section('header')
<x-headers.user page="Questions" icon="<i class='bi bi-database-gear'></i>"></x-headers.user>
@endsection

@section('sidebar')
<x-sidebars.operator page='questions'></x-sidebars.operator>
@endsection

@section('body')
<div class="responsive-container">
    <div class="container">
        <div class="bread-crumb">
            <a href="{{url('/')}}">Home</a>
            <i class="bx bx-chevron-right"></i>
            <a href="{{route('operator.book.chapters.index', $book)}}">{{ $book->name }}</a>
            <i class="bx bx-chevron-right"></i>
            <div>Chapters</div>
        </div>

        <!-- page message -->
        @if($errors->any())
        <x-message :errors='$errors'></x-message>
        @else
        <x-message></x-message>
        @endif

        <div class="container-light">

            <div class="flex flex-wrap gap-4 justify-between items-center">
                <h2>{{ $book->name }} <i class="bx bx-chevron-right"></i> Chapters </h2>
                <a href="{{ route('operator.book.chapters.create',$book) }}" class="btn-green rounded">Add Chapter</a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-4">

                @foreach($book->chapters->sortBy('display_order') as $chapter)
                <a href="{{ route('operator.book.chapter.questions.index', [$book, $chapter]) }}" class="pallet-box border">
                    <div class="ico bg-green-100 text-green-600 text-xl">{{ $chapter->chapter_no }}</div>
                    <div class="flex-1 pl-3">
                        <div class="text-xs">{{ $chapter->name }}</div>
                        <div class="title">{{ $book->questions->where('chapter_no', $chapter->chapter_no)->count() }}</div>
                    </div>

                </a>
                @endforeach
            </div>

        </div>
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