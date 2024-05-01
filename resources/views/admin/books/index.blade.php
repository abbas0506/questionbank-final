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
@endphp

@section('body')
<div class="responsive-container">
    <div class="container">
        <div class="bread-crumb">
            <a href="/">Home</a>
            <i class="bx bx-chevron-right"></i>
            <a href="{{route('admin.grades.index')}}">Grades</a>
            <i class="bx bx-chevron-right"></i>
            <div>{{ $grade->name }}</div>
            <i class="bx bx-chevron-right"></i>
            <div>Books</div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
            <!-- mid panel  -->
            <div class="md:col-span-2 lg:col-span-3">
                <div class="p-4 border rounded-lg bg-green-100 border-green-200 ">
                    <div class="flex flex-wrap gap-4 justify-between items-center ">
                        <h2 class="">{{ $grade->name }} <i class="bx bx-chevron-right"></i> Books &nbsp<i class="bx bx-book"></i></h2>
                        <a href="{{ route('admin.grade.books.create', $grade) }}" class="btn-green rounded text-sm">Add Book</a>

                    </div>
                </div>

                <!-- page message -->
                @if($errors->any())
                <x-message :errors='$errors'></x-message>
                @else
                <x-message></x-message>
                @endif

                <div class="mt-4">
                    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4 text-sm">
                        @foreach($grade->books as $book)
                        <div href="{{ route('admin.book.chapters.index', $book) }}" class="flex flex-col border rounded-lg overflow-hidden">
                            <div class="flex justify-center items-center h-24 bg-slate-50">
                                <div class="flex w-16 h-16 justify-center items-center rounded-full bg-{{ $colors[$i%4] }}-100 text-{{ $colors[$i%4] }}-600 text-2xl"><i class="bx bx-book"></i></div>

                            </div>
                            <div class="p-4">
                                <h3><a href="{{route('admin.book.chapters.index', $book)}}">{{ $book->name }}</a></h3>
                                <div class="text-slate-400 text-xs">{{ $book->questions()->objective()->count()}} objective, {{ $book->questions()->subjective()->count()}} subjective</div>
                                <div class="flex flex-row items-center space-x-5 text-slate-600 text-xs mt-5">
                                    <div><i class="bi-question-circle"></i> <span class="font-medium"> {{ $book->questions()->count() }}</span></div>
                                    <div class=""><i class="bi-book"></i> <span class="font-medium">{{ $book->chapters->count() }}</span></div>
                                    @if($book->questions()->today()->count())
                                    <div><i class="bi-arrow-up"></i>{{ $book->questions()->today()->count() }}</div>
                                    @endif

                                    <div class="flex justify-center items-center space-x-2">
                                        <a href="{{route('admin.grade.books.edit', [$grade,$book])}}">
                                            <i class="bx bx-pencil text-green-600"></i>
                                        </a>
                                        <form action="{{route('admin.grade.books.destroy',[$grade,$book])}}" method="POST" onsubmit="return confirmDel(event)">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-transparent p-0 border-0">
                                                <i class="bx bx-trash text-red-600"></i>
                                            </button>
                                        </form>
                                    </div>

                                </div>

                            </div>
                        </div>
                        @php $i++; @endphp
                        @endforeach
                    </div>
                </div>
            </div>
            <!-- right panel -->
            <div class="">
                <div class="p-4 border rounded-lg">
                    <div class="flex items-center justify-between">
                        <h2 class="text-sm">Grades <i class="bi-mortarboard-fill"></i></h2>
                    </div>
                    @php
                    $activeGrade=$grade;
                    @endphp
                    <div class="flex items-center space-x-3 mt-3">
                        @foreach($grades as $grade)
                        @if($activeGrade->id==$grade->id)
                        <a href="#" class="flex items-center justify-center text-xs w-8 h-8 space-x-3 rounded-full bg-green-800 text-slate-50">
                            {{ $grade->grade_no }}
                        </a>
                        @else
                        <a href="{{route('admin.grade.books.index',$grade)}}" class="flex items-center justify-center text-xs py-3 w-8 h-8 space-x-3 rounded-full bg-slate-100 text-slate-600">
                            {{ $grade->grade_no }}
                        </a>
                        @endif
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
</script>

@endsection