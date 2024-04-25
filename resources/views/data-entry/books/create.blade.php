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
            <a href="{{route('operator.grade.books.index', $grade)}}">Grade {{ $grade->grade_no }}</a>
            <i class="bx bx-chevron-right"></i>
            <div>New Book</div>
        </div>

        @if($errors->any())
        <x-message :errors='$errors'></x-message>
        @else
        <x-message></x-message>
        @endif
        <div class="container-light">
            <div class="flex items-center">
                <h3 class="text-green-600 bg-green-100 px-3 py-1 rounded-full">New Book <i class="bx bx-book"></i></h3>
            </div>
            <div class="flex justify-center items-center mt-16">
                <form action="{{route('operator.grade.books.store', $grade)}}" method='post' class="w-full md:w-2/3">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <label>Grade</label>
                            <div>Grade {{ $grade->grade_no }}</div>
                        </div>
                        <div class="md:col-span-2">
                            <label>Book Name</label>
                            <input type="text" name='name' class="custom-input-borderless" placeholder="Enter book name" value="" required>
                        </div>

                        <div>
                            <label>Subject</label>
                            <select name="subject_id" class="custom-input-borderless" required>
                                <option value="">...</option>
                                @foreach($subjects as $subject)
                                <option value="{{ $subject->id }}">{{ $subject->name_en }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-span-full">
                            <button type="submit" class="btn-green rounded mt-6">Create</button>
                        </div>

                    </div>
                </form>

            </div>

        </div>
    </div>
</div>
@endsection