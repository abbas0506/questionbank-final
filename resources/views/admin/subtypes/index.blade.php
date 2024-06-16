@extends('layouts.basic')
@section('header')
<x-headers.user page="Sub Types" icon="<i class='bi bi-database-gear'></i>"></x-headers.user>
@endsection

@section('sidebar')
<x-sidebars.admin page='subtypes'></x-sidebars.admin>
@endsection

@php
$colors=config('globals.colors');
$i=0;
@endphp

@section('body')
<div class="responsive-container">
    <div class="container">
        <div class="bread-crumb">
            <a href="/">Home</a>
            <i class="bx bx-chevron-right"></i>
            <div>Subtypes</div>
        </div>

        <a href="{{route('admin.subtypes.create')}}" class="fixed bottom-6 right-6 btn-green w-14 h-14 flex justify-center items-center rounded-full text-sm">New</a>
        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
            <!-- mid panel  -->
            <div class="md:col-span-2 lg:col-span-3">
                <!-- page message -->
                @if($errors->any())
                <x-message :errors='$errors'></x-message>
                @else
                <x-message></x-message>
                @endif

                <div class="mt-4">
                    @php $sr=1; @endphp

                    <div class="overflow-x-auto">
                        <table class="table-fixed borderless w-full mt-3">
                            <thead>
                                <tr class="tr">
                                    <th class="w-8">Sr</th>
                                    <th class="w-48">Sub Type</th>
                                    <th class="w-12">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($subtypes->sortByDesc('updated_at') as $subtype)
                                <tr class="tr">
                                    <td>{{$sr++}}</td>
                                    <td class="text-left">{{ $subtype->name }}</td>
                                    <td>
                                        <div class="flex justify-center items-center space-x-2">
                                            <a href="{{route('admin.subtypes.edit', $subtype)}}">
                                                <i class="bx bx-pencil text-green-600"></i>
                                            </a>
                                            <form action="{{route('admin.subtypes.destroy', $subtype)}}" method="POST" onsubmit="return confirmDel(event)">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-transparent p-0 border-0">
                                                    <i class="bx bx-trash text-red-600"></i>
                                                </button>
                                            </form>
                                        </div>

                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
    @endsection
    @section('script')
    <script type="text/javascript">
        function confirmDel(event) {
            event.preventDefault(); // prevent form submit
            var form = event.target; // storing the form

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    form.submit();
                }
            })
        }
    </script>

    @endsection