@extends('layouts.admin')
@section('page-content')
<div class="custom-container">
    <h2>New Grade</h2>
    <div class="bread-crumb">
        <a href="/">Home</a>
        <a href="{{route('admin.data.index')}}">Data</a>
        <div>/</div>
        <a href="{{route('admin.grades.index')}}">Grades</a>
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
            <form action="{{route('admin.grades.store')}}" method='post' class="w-full">
                @csrf
                <div>
                    <label>Grade Name</label>
                    <input type="text" name='name' class="custom-input-borderless" placeholder="Enter grade name" value="" required>
                </div>

                <button type="submit" class="btn-teal rounded mt-6">Create</button>
            </form>

        </div>

    </div>
</div>
@endsection