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

        <div class="container-light">
            <h2>Search Questions</h2>
            <!-- search -->
            <div class="flex relative w-full md:w-1/3 mx-auto mt-12">
                <input type="text" id='searchby' placeholder="Search questions here..." class="custom-search w-full" oninput="search(event)">
                <i class="bx bx-search absolute top-2 right-2"></i>
            </div>
        </div>

        <div class="container-light">
            <h2 class="text-center">Search by Grade</h2>
            <div class="w-full md:w-2/3 mx-auto text-center mt-12">
                <div class="flex items-center justify-center gap-x-4 mt-5">
                    @foreach($grades as $grade)
                    <div data-bound='books-{{$grade->id}}' class="round-tab">{{ $grade->grade_no }}</div>
                    @endforeach
                </div>
                <div id='messageBeforeGradeSelection' class="flex justify-center items-center text-center text-teal-500 mt-8">
                    Please select a grade from the above
                </div>

                @foreach($grades as $grade)
                <div id="books-{{$grade->id}}" class="books hidden">
                    <div class="flex justify-center items-center text-center p-3 bg-teal-100 rounded-md mt-8 relative">
                        Choose a Subject
                        <div class="absolute w-4 h-4 transform rotate-45 -bottom-2 left-5 bg-teal-100"></div>
                    </div>
                    @foreach($grade->books as $book)
                    <a href="{{route('admin.question-search.show',$book)}}" class="flex p-3 border-b">{{$book->subject->name_en}}</a>
                    @endforeach
                </div>
                @endforeach

            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script type="module">
    $('.round-tab').click(function() {
        $('.round-tab').removeClass('active')
        $(this).addClass('active');
        $('#messageBeforeGradeSelection').hide();
        $('.books').hide();
        $('#' + $(this).attr('data-bound')).show()

    })
</script>
@endsection