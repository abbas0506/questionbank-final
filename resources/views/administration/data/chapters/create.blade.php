@extends('layouts.admin')
@section('page-content')
<div class="custom-container">
    <h2>New Chapter</h2>
    <div class="bread-crumb">
        <a href="/">Home</a>
        <a href="{{route('admin.data.index')}}">Data</a>
        <div>/</div>
        <a href="{{route('admin.book.chapters.index', $book)}}">Chapters</a>
        <div>/</div>
        <div>New</div>
    </div>

    @if($errors->any())
    <x-message :errors='$errors'></x-message>
    @else
    <x-message></x-message>
    @endif

    <div class="content-section md:p-16">
        <div class="flex md:h-64 justify-center items-center w-full md:w-2/3 mx-auto">
            <!-- page message -->
            <form action="{{route('admin.book.chapters.store', $book)}}" method='post' class="w-full">
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
                        <button type="submit" class="btn-teal rounded mt-6">Create</button>
                    </div>

                </div>
            </form>

        </div>

    </div>
</div>
@endsection