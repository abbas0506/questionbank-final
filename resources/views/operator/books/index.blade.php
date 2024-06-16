@extends('layouts.basic')
@section('header')
<x-headers.user page="Questions" icon="<i class='bi bi-database-gear'></i>"></x-headers.user>
@endsection

@section('sidebar')
<x-sidebars.operator page='questions'></x-sidebars.operator>
@endsection

@section('body')
<style>
    .green-1 {
        background: url("{{asset('/images/bg/green-1.png')}}") no-repeat center center/cover;
        background-size: cover;
    }
</style>
@php
$colors=config('globals.colors');
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
            <div class="md:col-span-2 lg:col-span-4">
                <div class="p-4 border rounded-lg green-1 border-green-200 ">
                    <!-- <div class=" flex flex-wrap gap-4 justify-between items-center ">
                        <h2 class="">{{ $grade->name }} <i class=" bx bx-chevron-right"></i> Books &nbsp<i class="bx bx-book"></i></h2>
                </div> -->

                    <div class="flex items-center justify-between">
                        <h2 class="">Grades <i class="bi-mortarboard-fill"></i></h2>
                    </div>
                    @php
                    $activeGrade=$grade;
                    @endphp
                    <div class="flex items-center space-x-3 mt-3">
                        @foreach($grades as $grade)
                        @if($activeGrade->id==$grade->id)
                        <a href="#" class="flex items-center justify-center w-8 h-8 space-x-3 rounded-full border border-slate-100 bg-slate-100 text-teal-600">
                            {{ $grade->grade_no }}
                        </a>
                        @else
                        <a href="{{route('operator.grade.books.index',$grade)}}" class="flex items-center justify-center w-8 h-8 space-x-3 border border-teal-400 rounded-full hover:border-slate-50 ">
                            {{ $grade->grade_no }}
                        </a>
                        @endif
                        @php $i++; @endphp
                        @endforeach
                    </div>
                </div>

                <div class="mt-4">
                    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4 text-sm">
                        @foreach($grade->books as $book)
                        <a href="{{ route('operator.book.chapters.index', $book) }}" class="border rounded-lg overflow-hidden">
                            <div class="flex justify-center items-center h-32 bg-slate-100">
                                <div class="flex w-16 h-16 justify-center items-center rounded-full bg-{{ $colors[$i%4] }}-100 text-{{ $colors[$i%4] }}-600 text-2xl"><i class="bx bx-book"></i></div>

                            </div>
                            <div class="p-4">
                                <h3>{{ $book->name }}</h3>
                                <div class="text-slate-400 text-xs">{{ $book->questions()->objective()->count()}} objective, {{ $book->questions()->subjective()->count()}} subjective</div>
                                <div class="flex items-center space-x-5 text-slate-600 text-xs mt-5">
                                    <div><i class="bi-question-circle"></i> <span class="font-medium"> {{ $book->questions()->count() }}</span></div>
                                    <div><i class="bi-book"></i> <span class="font-medium">{{ $book->chapters->count() }} chapters</span></div>
                                    @if($book->questions()->today()->count())
                                    <div><i class="bi-arrow-up"></i>{{ $book->questions()->today()->count() }}</div>
                                    @endif
                                </div>
                            </div>
                        </a>
                        @php $i++; @endphp
                        @endforeach
                    </div>
                </div>
            </div>
            <!-- right panel -->
            <!-- <div class="">
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
                        <a href="#" class="flex items-center justify-center text-xs py-3 w-8 h-8 space-x-3 rounded-full bg-green-800 text-slate-50">
                            {{ $grade->grade_no }}
                        </a>
                        @else
                        <a href="{{route('operator.grade.books.index',$grade)}}" class="flex items-center justify-center text-xs py-3 w-8 h-8 space-x-3 rounded-full bg-slate-100 text-slate-600">
                            {{ $grade->grade_no }}
                        </a>
                        @endif
                        @php $i++; @endphp
                        @endforeach
                    </div>
                </div>
            </div> -->
        </div>
    </div>

</div>
@endsection