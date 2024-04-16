@extends('layouts.admin')
@section('page-content')
<div class="custom-container">
    <h2>Edit Subjects</h2>
    <div class="bread-crumb">
        <a href="/">Home</a>
        <div>/</div>
        <a href="{{route('admin.subjects.index')}}">subjects</a>
        <div>/</div>
        <div>New</div>
    </div>

    <div class="flex h-80 justify-center items-center w-full md:w-1/2 mx-auto">
        <!-- page message -->
        @if($errors->any())
        <x-message :errors='$errors'></x-message>
        @else
        <x-message></x-message>
        @endif
        <form action="{{route('admin.subjects.update',$subject)}}" method='post' class="w-full" onsubmit="return validate(event)">
            @csrf
            @method('PATCH')
            <div>
                <label>Full Name</label>
                <input type="text" name='name' class="custom-input" placeholder="Subject name" value="{{$subject->name}}">
            </div>

            <button type="submmit" class="btn-teal rounded p-2 w-32 mt-3">Create Now</button>
        </form>

    </div>
</div>
@endsection