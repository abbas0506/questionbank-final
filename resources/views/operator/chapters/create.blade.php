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
            <a href="{{route('operator.grade.book.chapters.index', [$book->grade,$book])}}">{{ $book->name }}</a>
            <i class="bx bx-chevron-right"></i>
            <div>New Chapter</div>
        </div>


        @if($errors->any())
        <x-message :errors='$errors'></x-message>
        @else
        <x-message></x-message>
        @endif

        <div class="container-light bg-slate-100">
            <div class="flex items-center">
                <h3 class="bg-green-800 text-white px-3 py-1 rounded-full">New Chapter</h3>
            </div>
            <div class="flex justify-center items-center mt-12">
                <!-- page message -->
                <form action="{{route('operator.book.chapters.store', $book)}}" method='post' class="md:w-2/3">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="md:col-span-2">
                            <h2>{{ $book->name }}</h2>
                        </div>
                        <div class="md:col-span-2">
                            <label>Chapter Title</label>
                            <input type="text" name='name' class="custom-input-borderless" placeholder="Enter chapter title" value="" required>
                        </div>
                        <div>
                            <label>Chapter No.</label>
                            <input type="number" name="chapter_no" value="{{ $book->chapters->count() + 1 }}" class="custom-input-borderless" min=1>
                        </div>
                        <div class="md:col-span-2">
                            <button type="submit" class="btn-green rounded mt-6">Create</button>
                        </div>

                    </div>
                </form>

            </div>

        </div>
    </div>
</div>
@endsection