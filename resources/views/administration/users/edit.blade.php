@extends('layouts.admin')
@section('page-content')
<div class="custom-container">
    <h2>Edit User Profile</h2>
    <div class="bread-crumb">
        <a href="{{url('admin')}}">Home</a>
        <div>/</div>
        <a href="{{route('admin.users.index')}}">Users</a>
        <div>/</div>
        <div>Edit</div>
    </div>

    <!-- page message -->
    @if($errors->any())
    <x-message :errors='$errors'></x-message>
    @else
    <x-message></x-message>
    @endif
    <div class="content-section p-5 md:p-16">
        <form action="{{route('admin.users.update',$user)}}" method='post' class="md:w-2/3 mx-auto">
            @csrf
            @method('PATCH')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <h2 class="md:col-span-2">Profile</h2>
                <div class="md:col-span-2">
                    <label for="">User Name</label>
                    <input type="text" id='' name='name' class="custom-input-borderless" placeholder="User name" value="{{$user->name}}">
                </div>

                <div>
                    <label for="">Email</label>
                    <input type="text" id='' name='email' class="custom-input-borderless" placeholder="User email" value="{{$user->email}}">
                </div>
                <div>
                    <label for="">Status</label>
                    <select name="is_active" id="" class="custom-input-borderless py-1">
                        <option value="1" @selected($user->is_active) >Enabled</option>
                        <option value="0" @selected(!$user->is_active)>Disabled</option>
                    </select>
                </div>

                <h2 class="md:col-span-2">Role(s)</h2>
                <div class="grid gap-2">
                    @foreach($roles as $role)
                    <div class="checkable-row">
                        <label for="role{{$role->id}}" class="text-base hover:cursor-pointer text-slate-800 text-left py-1 flex-1">{{ ucfirst($role->name) }}</label>
                        <input type="checkbox" id='role{{$role->id}}' name='role_names_array[]' class="custom-input w-4 h-4 rounded" value="{{ $role->name }}" @checked($user->hasRole($role->name))>
                        <i class="bx bx-check"></i>
                    </div>
                    @endforeach
                </div>

                <div class="md:col-span-2 text-right">
                    <button type="submit" class="btn-blue rounded">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection