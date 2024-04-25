@extends('layouts.basic')
@section('header')
<x-headers.user page="Data" icon="<i class='bi bi-database-gear'></i>"></x-headers.user>
@endsection

@section('sidebar')
<x-sidebars.admin page='data'></x-sidebars.admin>
@endsection

@section('body')
<div class="responsive-container">
    <div class="container">
        <div class="bread-crumb">
            <a href="{{url('admin')}}">Home</a>
            <i class="bx bx-chevron-right"></i>
            <a href="{{route('admin.data.index')}}">Data</a>
            <i class="bx bx-chevron-right"></i>
            <div>Search Qs.</div>
        </div>

        <!-- page message -->
        @if($errors->any())
        <x-message :errors='$errors'></x-message>
        @else
        <x-message></x-message>
        @endif

        <style>
            .hero {
                background-image: linear-gradient(rgba(0, 100, 100, 1.0),
                    rgba(128, 128, 128, 0)),
                url("{{asset('/images/bg/exams1-01.svg')}}");
                background-position: center;
                background-repeat: no-repeat;
                background-size: contain;
                background-clip: border-box;
                position: relative;
            }
        </style>

        <div class="container-light">
            <h2>Search result</h2>
            <div class="w-full md:w-2/3 mx-auto text-center mt-12">
                <h2 class="">{{ $book->name }}</h2>
                <p class="text-slate-600 leading-relaxed">Following chapters list has been found for the selected book.</p>
                <div class="h-1 w-24 bg-teal-800 mx-auto mt-6"></div>
                <!-- page message -->
                @if($errors->any())
                <x-message :errors='$errors'></x-message>
                @else
                <x-message></x-message>
                @endif

                <div class="flex justify-center items-center text-center p-3 bg-teal-100 rounded-md mt-8 relative">
                    Please click on a chapter
                    <div class="absolute w-4 h-4 transform rotate-45 -bottom-2 left-5 bg-teal-100"></div>
                </div>

                <div class="grid grid-cols-1 mt-3 text-slate-600">
                    @foreach($book->chapters->sortBy('chapter_no') as $chapter)
                    <a href="{{ route('admin.book.chapter.questions.index', [$book->id, $chapter->id]) }}" class="text-left border-b py-3">
                        {{$chapter->chapter_no}}. &nbsp {{$chapter->name}}
                    </a>
                    @endforeach
                </div>

            </div>
        </div>
        @endsection
        @section('footer')
        <x-footer></x-footer>
        @endsection
        @section('script')
        <script type="module">
            $('document').ready(function() {
                $('#start-test-form').submit(function(e) {
                    var anyChecked = 0
                    $('.custom-input').each(function() {
                        if ($(this).is(':checked'))
                            anyChecked++;
                    })
                    if (anyChecked == 0) {
                        event.preventDefault();
                        Swal.fire({
                            icon: 'warning',
                            title: 'Please select a chapter',
                            showConfirmButton: false,
                            timer: 1000,
                        })

                    }
                })
            })
        </script>
        @endsection