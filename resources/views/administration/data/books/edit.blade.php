@extends('layouts.admin')
@section('page-content')
<div class="custom-container">
    <h2>Edit Book</h2>
    <div class="bread-crumb">
        <a href="/">Home</a>
        <a href="{{route('admin.data.index')}}">Data</a>
        <div>/</div>
        <a href="{{route('admin.books.index')}}">Books</a>
        <div>/</div>
        <div>New</div>
    </div>

    @if($errors->any())
    <x-message :errors='$errors'></x-message>
    @else
    <x-message></x-message>
    @endif

    <div class="content-section md:p-16">
        <div class="flex h-64 justify-center items-center w-full md:w-2/3 mx-auto">
            <!-- page message -->
            <form action="{{route('admin.books.update', $book)}}" method='post' class="w-full">
                @csrf
                @method('PATCH')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="md:col-span-2">
                        <label>Book Name</label>
                        <input type="text" name='name' class="custom-input-borderless" placeholder="Enter book name" value="{{ $book->name }}" required>
                    </div>
                    <div>
                        <label>Grade</label>
                        <select name="grade_id" class="custom-input-borderless">
                            <option value="">...</option>
                            @foreach($grades as $grade)
                            <option value="{{ $grade->id }}" @selected($book->grade_id==$grade->id)>{{ $grade->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label>Subject</label>
                        <select name="subject_id" class="custom-input-borderless" required>
                            <option value="">...</option>
                            @foreach($subjects as $subject)
                            <option value="{{ $subject->id }}" @selected($book->subject_id==$subject->id)>{{ $subject->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <button type="submit" class="btn-teal rounded mt-6">Update</button>
                    </div>

                </div>
            </form>

        </div>

    </div>
</div>
@endsection