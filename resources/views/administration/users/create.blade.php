@extends('layouts.admin')
@section('page-content')
<div class="custom-container">
    <h2>Create New User</h2>
    <div class="bread-crumb">
        <a href="{{url('admin')}}">Home</a>
        <div>/</div>
        <a href="{{route('admin.users.index')}}">Users</a>
        <div>/</div>
        <div>Create</div>
    </div>

    <!-- page message -->
    @if($errors->any())
    <x-message :errors='$errors'></x-message>
    @else
    <x-message></x-message>
    @endif
    <div class="content-section p-5 md:p-16">
        <form action="{{route('admin.users.store')}}" method='post' class="md:w-2/3 mx-auto">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <h2 class="md:col-span-2">Profile</h2>
                <div class="md:col-span-2">
                    <label for="">User Name</label>
                    <input type="text" id='' name='name' class="custom-input-borderless" placeholder="User name" value="">
                </div>

                <div>
                    <label for="">Email</label>
                    <input type="text" id='' name='email' class="custom-input-borderless" placeholder="User email" value="">
                </div>

                <h2 class="md:col-span-2">Role(s)</h2>
                <div class="grid gap-2">
                    @foreach($roles as $role)
                    <div class="checkable-row">
                        <label for="role{{$role->id}}" class="text-base hover:cursor-pointer text-slate-800 text-left py-1 flex-1">{{ ucfirst($role->name) }}</label>
                        <input type="checkbox" id='role{{$role->id}}' name='role_names_array[]' class="custom-input w-4 h-4 rounded" value="{{$role->name}}" @checked($loop->last)>
                        <i class="bx bx-check"></i>
                    </div>
                    @endforeach
                </div>

                <div class="md:col-span-2 text-right">
                    <button type="submit" class="btn-blue rounded">Create</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection