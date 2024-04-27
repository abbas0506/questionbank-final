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
            <a href="/">Home</a>
            <i class="bx bx-chevron-right"></i>
            <a href="{{route('admin.data.index')}}">Data</a>
            <i class="bx bx-chevron-right"></i>
            <a href="{{route('admin.book.chapters.index', $book)}}">Chapters</a>
            <i class="bx bx-chevron-right"></i>
            <div>Edit</div>
        </div>

        @if($errors->any())
        <x-message :errors='$errors'></x-message>
        @else
        <x-message></x-message>
        @endif

        <div class="container-light">
            <div class="flex items-center">
                <h3 class="text-green-600 bg-green-100 px-3 py-1 rounded-full">Edit Chapter <i class="bx bx-pencil"></i></h3>
            </div>
            <div class="flex justify-center items-center mt-12">
                <!-- page message -->
                <form action="{{route('operator.book.chapters.update', [$book, $chapter])}}" method='post' class="md:w-2/3">
                    @csrf
                    @method('PATCH')
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="md:col-span-2">
                            <h2>{{ $chapter->book->name }}</h2>
                        </div>
                        <div class="md:col-span-2">
                            <label>Chapter Title</label>
                            <input type="text" name='name' class="custom-input-borderless" placeholder="Enter chapter title" value="{{ $chapter->name }}" required>
                        </div>
                        <div>
                            <label>Chapter No.</label>
                            <input type="number" name="chapter_no" value="{{ $chapter->chapter_no }}" class="custom-input-borderless" min=1>
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