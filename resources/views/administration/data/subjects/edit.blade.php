@extends('layouts.admin')
@section('page-content')
<div class="custom-container">
    <h2>Edit Subjects</h2>
    <div class="bread-crumb">
        <a href="/">Home</a>
        <div>/</div>
        <a href="{{route('admin.data.index')}}">Data</a>
        <div>/</div>
        <a href="{{route('admin.subjects.index')}}">Subjects</a>
        <div>/</div>
        <div>Edit</div>
    </div>

    @if($errors->any())
    <x-message :errors='$errors'></x-message>
    @else
    <x-message></x-message>
    @endif

    <div class="content-section md:p-16">
        <div class="flex h-64 justify-center items-center w-full md:w-2/3 mx-auto">
            <!-- page message -->
            <form action="{{route('admin.subjects.update',$subject)}}" method='post' class="grid md:grid-cols-2 gap-x-12 gap-y-8 w-full" onsubmit="return validate(event)">
                @csrf
                @method('PATCH')
                <div class="md:col-span-full">
                    <label>Subject Name (english)</label>
                    <input type="text" name='name_en' class="custom-input-borderless" placeholder="Subject name" value="{{ $subject->name_en }}" required>
                </div>
                <div class="md:col-span-full">
                    <label>Subject Name (urdu)</label>
                    <input type="text" name='name_ur' class="custom-input-borderless" placeholder="Subject name" value="{{ $subject->name_ur }}" required>
                </div>
                <div>
                    <label>Display Order</label>
                    <input type="number" name='display_order' class="custom-input-borderless" placeholder="Enter display order" value="{{ $subject->display_order}}" min=0 required>
                </div>
                <div class="md:col-span-full">
                    <button type="submit" class="btn-teal rounded mt-6">Update</button>
                </div>
            </form>

        </div>

    </div>
</div>
@endsection