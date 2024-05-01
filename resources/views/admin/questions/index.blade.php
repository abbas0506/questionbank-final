@extends('layouts.basic')
@section('header')
<x-headers.user page="Q. Bank" icon="<i class='bi bi-database-gear'></i>"></x-headers.user>
@endsection

@section('sidebar')
<x-sidebars.admin page='qbank'></x-sidebars.admin>
@endsection

@php
$colors=config('globals.colors');
$i=0;
$activeChapter=$chapter;
@endphp

@section('body')
<div class="responsive-container">
    <div class="container">
        <div class="bread-crumb">
            <a href="{{url('admin')}}">Home</a>
            <i class="bx bx-chevron-right"></i>
            <a href="{{route('admin.grade.books.index', $book->grade)}}">{{ $chapter->book->grade->name }}</a>
            <i class="bx bx-chevron-right"></i>
            <a href="{{route('admin.book.chapters.index', $book)}}">{{ $book->name }}</a>
            <i class="bx bx-chevron-right"></i>
            <div>Ch.{{ $chapter->chapter_no }}</div>
        </div>


        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
            <!-- mid panel  -->
            <div class="md:col-span-2 lg:col-span-3">
                <div class="flex flex-wrap items-center justify-between p-4 border rounded-lg bg-green-100 border-green-200">
                    <h2>{{ $book->name }} <i class="bx bx-chevron-right"></i> Chapter {{$chapter->chapter_no}}</h2>

                    <div class="flex items-center flex-wrap justify-between gap-x-6">
                        <!-- search -->
                        <div class="flex-1 relative">
                            <input type="text" id='searchby' placeholder="Search ..." class="custom-search w-full" oninput="search(event)">
                            <i class="bx bx-search absolute top-2 right-2"></i>
                        </div>
                        <a href="{{route('admin.chapter.questions.create',$chapter)}}" class="btn-green rounded">New Q.</a>
                    </div>
                </div>

                <!-- page message -->
                @if($errors->any())
                <x-message :errors='$errors'></x-message>
                @else
                <x-message></x-message>
                @endif

                @php $sr=1; @endphp

                <div class="overflow-x-auto">
                    <table class="table-fixed borderless w-full mt-3">
                        <thead>
                            <tr class="tr">
                                <th class="w-8">Sr</th>
                                <th class="w-48">Question</th>
                                <th class="w-20">Type</th>
                                <th class="w-12">View</th>
                                <th class="w-12">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach($questions->sortByDesc('updated_at') as $question)
                            <tr class="tr">
                                <td>{{$sr++}}</td>
                                <td class="text-left">{{ $question->statement }}</td>
                                <td>{{ $question->type->name }}</td>
                                <td>
                                    <a href="{{ route('admin.chapter.questions.show',[$chapter,$question]) }}">
                                        <i class="bx bx-show-alt"></i>
                                    </a>
                                </td>
                                <td>
                                    <div class="flex justify-center items-center space-x-2">
                                        <a href="{{route('admin.chapter.questions.edit', [$chapter, $question])}}">
                                            <i class="bx bx-pencil text-green-600"></i>
                                        </a>
                                        <form action="{{route('admin.chapter.questions.destroy', [$chapter->id, $question])}}" method="POST" onsubmit="return confirmDel(event)">
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
            <div class="">
                <div class="p-4 border rounded-lg">
                    <div class="flex items-center justify-between">
                        <h2 class="text-sm">Chapters <i class="bi-layers"></i></h2>
                        <div class="flex items-center justify-center rounded-full px-2 bg-green-200  text-xs font-semibold"> {{ $book->chapters->count() }}</i></div>
                    </div>
                    <div class="grid divide-y mt-3">
                        @foreach($book->chapters->sortBy('chapter_no') as $chapter)
                        <a href="{{ route('admin.chapter.questions.index', $chapter) }}" class="flex flex-row items-center py-3">
                            <div class="flex justify-center items-center w-10 h-10 bg-{{ $colors[$i % 5] }}-100 text-{{ $colors[$i % 5] }}-600 rounded-lg">
                                <!-- <i class="bi-layers"></i> -->
                                {{ $chapter->chapter_no }}
                            </div>
                            <div class="flex flex-1 items-center justify-between pl-3">
                                <div>
                                    <div class="text-xs font-semibold">{{ $chapter->name }}</div>
                                    <div class="text-xs text-slate-600">{{ $book->questions()->where('chapter_no', $chapter->chapter_no)->count() }} questions</div>
                                </div>
                                @if($activeChapter->id==$chapter->id)
                                <div class="w-2 h-2 bg-red-600 rounded-full">
                                </div>
                                @endif
                            </div>
                        </a>
                        @php
                        $i++;
                        @endphp
                        @endforeach
                    </div>
                </div>
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