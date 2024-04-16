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
                    <label>Subject Name</label>
                    <input type="text" name='name' class="custom-input-borderless" placeholder="Enter subject name" value="{{ $subject->name }}" required>
                </div>
                <div>
                    <label>Is Language?</label>
                    <select name="is_language" id="" class="custom-input-borderless py-1">
                        <option value="0" @selected(!$subject->language_tag)>No</option>
                        <option value="1" @selected($subject->language_tag)>Yes</option>
                    </select>
                </div>
                <div>
                    <label>Display Order</label>
                    <input type="number" name='display_order' class="custom-input-borderless" placeholder="Enter display order" value="{{ $subject->display_order}}" min=0 required>
                </div>
                <div class="md:col-span-full">
                    <button type="submit" class="btn-teal rounded mt-6">Create</button>
                </div>
            </form>

        </div>

    </div>
</div>
@endsection