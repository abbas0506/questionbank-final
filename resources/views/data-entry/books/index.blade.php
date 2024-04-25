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
            <div>Books</div>
        </div>

        <!-- page message -->
        @if($errors->any())
        <x-message :errors='$errors'></x-message>
        @else
        <x-message></x-message>
        @endif

        <div class="container-light">
            <div class="flex flex-wrap gap-4 justify-between items-center">
                <h2>Grade {{ $grade->grade_no }} <i class="bx bx-chevron-right"></i> Books <i class="bx bx-book"></i></h2>
                <a href="{{ route('operator.grade.books.create', $grade) }}" class="btn-green rounded">Add Book</a>

            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mt-4">
                @foreach($grade->books->sortBy('display_order') as $book)
                <a href="{{route('operator.book.chapters.index',$book)}}" class="pallet-box border">
                    <div class="ico bg-green-100 text-green-600 text-xl">{{ $grade->grade_no }}</div>
                    <div class="flex-1 pl-3">
                        <div class="h2">{{ $book->subject->name_en }}</div>
                        <div class="title">{{ $book->questions->count() }}</div>
                    </div>

                </a>
                @endforeach
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