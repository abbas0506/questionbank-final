@extends('layouts.basic')
@section('header')
<x-headers.user page="Questions" icon="<i class='bi bi-database-gear'></i>"></x-headers.user>
@endsection

@section('sidebar')
<x-sidebars.operator page='questions'></x-sidebars.operator>
@endsection

@section('body')

@php
$colors=config('globals.colors');
$size=count($colors);
$i=0;
@endphp

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

        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
            <!-- mid panel  -->
            <div class="md:col-span-2 lg:col-span-3">
                <div class="p-4 border rounded-lg bg-green-100 border-green-200">
                    <div class="flex flex-wrap gap-4 justify-between items-cente">
                        <h2>{{ $grade->books->first()->name }} <i class="bx bx-chevron-right"></i> Chapters &nbsp<i class="bi-layers"></i></h2>
                        <a href="{{ route('operator.grade.books.create', $grade) }}" class="btn-green rounded text-sm">Add Chapter</a>

                    </div>
                </div>
                <div class="mt-4">
                    <div class="grid text-sm">
                        @foreach($grade->books->first()->chapters as $chapter)
                        <a href="{{route('operator.book.chapter.questions.index', [$chapter->book_id, $chapter->chapter_no])}}" class="flex flex-row items-center text-slate-600 p-2 odd:bg-slate-100">
                            <div class="flex-1">{{ $chapter->chapter_no}}. &nbsp {{ $chapter->name }} </div>
                            <div class="text-xs mr-4">
                                @if($chapter->questions()->today()->count()>0)
                                {{ $chapter->questions()->today()->count() }}<i class="bi-arrow-up"></i>
                                @endif
                            </div>
                            <div class="flex items-center justify-center w-5 h-5 bg-orange-400 text-slate-50 text-xs rounded">
                                {{ $chapter->questions()->count()}}

                            </div>

                        </a>

                        @endforeach
                    </div>
                </div>


            </div>
            <!-- right panel -->
            <div class="">
                <div class="p-4 border rounded-lg">
                    <div class="flex items-center justify-between">
                        <h2 class="text-sm">Books <i class="bx bx-book"></i></h2>
                        <a href="" class="text-green-700 text-xs font-semibold">manage <i class="bi-gear"></i></a>
                    </div>
                    <div class="grid divide-y mt-3">
                        @foreach($grade->books->sortBy(' display_order') as $book)

                        <a href="{{route('operator.book.chapters.index',$book)}}" class="flex items-center text-xs py-3">
                            <div class="flex justify-center items-center w-8 h-8 rounded bg-{{ $colors[$i % 5] }}-100 text-{{ $colors[$i % 5] }}-600"><i class="bx bx-book text-sm"></i></div>
                            <div class="flex-1 pl-3 gap-y-1">
                                <div class="font-semibold">{{ $book->name }}</div>
                                <div class="flex space-x-5 text-slate-600 text-[10px]">
                                    <div> <i class="bi-question-circle"></i> {{ $book->questions->count() }}</div>
                                    <div> <i class="bi-layers"></i> {{ $book->chapters->count() }} chapters</div>
                                    <div class="">
                                        @if($book->questions()->today()->count()>0)
                                        {{ $book->questions()->today()->count() }}<i class="bi-arrow-up"></i>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </a>
                        @php $i++; @endphp
                        @endforeach
                    </div>
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