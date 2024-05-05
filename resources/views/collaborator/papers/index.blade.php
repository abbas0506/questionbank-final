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
@endphp

@section('body')
<div class="responsive-container">
    <div class="container">
        <div class="bread-crumb">
            <a href="{{url('/')}}">Home</a>
            <i class="bx bx-chevron-right"></i>
            <div>Papers</div>
        </div>
        <div class="w-full md:w-4/5 mx-auto text-center mt-8 px-5">

            <p class="text-slate-600 leading-relaxed">
                Welcome to highly customizeable and flexible paper generation module. Simply select grade, book and chapter(s); and system will generate the paper for you.
            </p>
            <div class="h-1 w-24 bg-teal-800 mx-auto mt-6"></div>

            <!-- page message -->
            @if($errors->any())
            <x-message :errors='$errors'></x-message>
            @else
            <x-message></x-message>
            @endif

            <h3 class="text-lg mt-8">Grades <i class="bi-mortarboard-fill"></i></h3>
            <div class="flex items-center justify-center gap-x-4 mt-5">
                @foreach($grades as $grade)
                <div id='{{ $grade->id }}' bound='tab{{ $grade->id }}' class="round-tab">{{ $grade->grade_no }}</div>
                @endforeach
            </div>

            @foreach($grades as $grade)
            <div id="tab{{$grade->id}}" class="subject-container hidden">
                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4 text-sm mt-8">
                    @foreach($grade->books as $book)
                    <a href="{{route('collaborator.grade.book.chapters.index',[$grade, $book])}}" class="flex flex-col border rounded-lg overflow-hidden">
                        <div class="flex justify-center items-center h-24 bg-slate-50">
                            <div class="flex w-16 h-16 justify-center items-center rounded-full bg-{{ $colors[$i%4] }}-100 text-{{ $colors[$i%4] }}-600 text-2xl"><i class="bx bx-book"></i></div>

                        </div>
                        <div class="p-4">
                            <h3>{{ $book->name }}</h3>
                        </div>
                    </a>
                    @php $i++; @endphp
                    @endforeach
                </div>
            </div>
            @endforeach

        </div>
        @endsection

        @section('script')
        <script type="module">
            $('.round-tab').click(function() {
                var obj = $(this);
                $('.round-tab').not(this).removeClass('active')

                // make grade tab active and show related subjects
                $(this).addClass('active');
                $('.subject-container').hide();
                $('#' + $(this).attr('bound')).show()
            })
        </script>
        @endsection