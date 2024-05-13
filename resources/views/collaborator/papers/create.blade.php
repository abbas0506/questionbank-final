@extends('layouts.basic')
@section('header')
<x-headers.user page="Paper Creation" icon="<i class='bi bi-files'></i>"></x-headers.user>
@endsection

@section('sidebar')
<x-sidebars.collaborator page='paper'></x-sidebars.collaborator>
@endsection

@php
$colors=config('globals.colors');
$i=0;
$activeBook=$book;
@endphp

@section('body')
<div class="responsive-container">
    <div class="container">
        <div class="bread-crumb">
            <a href="{{url('/')}}">Home</a>
            <i class="bx bx-chevron-right"></i>
            <div>Papers</div>
        </div>


        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
            <!-- mid panel  -->
            <div class="md:col-span-2 lg:col-span-3">
                <form id='start-test-form' action="{{route('collaborator.papers.store')}}" method='post' onsubmit="return validate(event)">
                    @csrf
                    <input type="hidden" name="book_id" value="{{ $book->id }}">
                    <div class="p-4 border rounded-lg bg-green-100 border-green-200">
                        <div class="flex flex-wrap gap-4 justify-between items-cente">
                            <h2>{{ $book->name }} <i class="bx bx-chevron-right"></i> Chapters &nbsp<i class="bi-layers"></i></h2>
                        </div>

                    </div>

                    <div class="flex justify-between gap-4 p-4 mt-6 border border-dashed rounded-lg">
                        <div class="flex-1">
                            <label for="">Paper Title *</label>
                            <input type="text" name="title" value='' placeholder="Enter paper title" class="custom-input-borderless" required>
                        </div>

                        <div>
                            <label for="">Paper Date</label>
                            <input type="date" id='paper_date' name="paper_date" class="custom-input-borderless" value="{{ date('Y-m-d') }}">
                        </div>
                    </div>

                    <!-- page message -->
                    @if($errors->any())
                    <x-message :errors='$errors'></x-message>
                    @else
                    <x-message></x-message>
                    @endif

                    <div class="flex items-center justify-between px-4 mt-6">
                        <div class="text-red-600">Please select chapter(s) for the paper</div>
                        <div class="flex items-center space-x-2">
                            <label for="check_all">Check All</label>
                            <input type="checkbox" id='check_all' class="custom-input w-4 h-4 rounded">
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="grid text-sm">
                            @foreach($book->chapters->sortBy('chapter_no') as $chapter)
                            <div class="flex items-center odd:bg-slate-100 space-x-3 checkable-row">
                                <div class="flex flex-1 items-center justify-between space-x-2 px-3">
                                    <label for='chapter{{$chapter->id}}' class="flex-1 text-sm text-slate-800 py-3 hover:cursor-pointer">{{ $chapter->chapter_no}}. &nbsp {{ $chapter->name }} </label>
                                    <div class="text-base font-extrabold">
                                        <input type="checkbox" id='chapter{{$chapter->id}}' name='chapter_ids_array[]' class="custom-input w-4 h-4 rounded hidden" value="{{ $chapter->id }}">
                                        <i class="bx bx-check"></i>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="flex justify-center items-center my-8">
                            <button type="submit" class="btn-green flex justify-center items-center" @disabled($book->chapters->count()==0)> Go Next & Add Questions</button>
                        </div>

                    </div>
                </form>
            </div>
            <!-- right panel -->
            <div class="">
                <div class="p-4 border rounded-lg">
                    <div class="flex items-center justify-between">
                        <h2 class="text-sm">Grades <i class="bi-mortarboard-fill"></i></h2>
                    </div>

                    <div class="flex items-center space-x-3 mt-3">
                        @foreach($grades as $grade)
                        @if($grade->id==$book->grade_id)
                        <a href="#" class="flex items-center justify-center text-xs py-3 w-8 h-8 space-x-3 rounded-full bg-green-800 text-slate-50">
                            {{ $grade->grade_no }}
                        </a>
                        @else
                        <a href="{{route('collaborator.grade.book.chapters.index',[$grade, 0])}}" class="flex items-center justify-center text-xs py-3 w-8 h-8 space-x-3 rounded-full bg-slate-100 text-slate-600">
                            {{ $grade->grade_no }}
                        </a>
                        @endif
                        @php $i++; @endphp
                        @endforeach
                    </div>
                </div>

                <div class="p-4 border rounded-lg mt-3">
                    <div class="flex items-center justify-between">
                        <h2 class="text-sm">Books <i class="bx bx-book"></i></h2>
                        <div class="flex items-center justify-center rounded-full px-2 bg-green-200  text-xs font-semibold"> {{ $activeBook->grade->books->count() }}</i></div>
                    </div>
                    <div class="grid divide-y mt-3">
                        @foreach($activeBook->grade->books->sortBy(' display_order') as $book)
                        <a href="{{route('collaborator.grade.book.chapters.index',[$grade, $book])}}" class="flex items-center text-xs py-3">
                            <div class="flex justify-center items-center w-8 h-8 rounded bg-{{ $colors[$i % 5] }}-100 text-{{ $colors[$i % 5] }}-600"><i class="bx bx-book text-sm"></i></div>
                            <div class="flex justify-between items-center flex-1 pl-3 gap-y-1">
                                <div>
                                    <div class="font-semibold">{{ $book->name }}</div>
                                    <div class="flex space-x-5 text-slate-600 text-[10px]">

                                    </div>
                                </div>
                                @if($activeBook->id==$book->id)
                                <div class="w-2 h-2  bg-red-600 rounded-full"></div>
                                @endif
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
@endsection

@section('script')
<script type="module">
    $('.checkable-row input').change(function() {
        if ($(this).prop('checked'))
            $(this).parents('.checkable-row').addClass('active')
        else
            $(this).parents('.checkable-row').removeClass('active')
    })

    $('#check_all').change(function() {
        if ($(this).prop('checked')) {
            $('.checkable-row input').each(function() {
                $(this).prop('checked', true)
                $(this).parents('.checkable-row').addClass('active')
            })
        } else {
            $('.checkable-row input').each(function() {
                $(this).prop('checked', false)
                $(this).parents('.checkable-row').removeClass('active')
            })
        }
    })
</script>
@endsection