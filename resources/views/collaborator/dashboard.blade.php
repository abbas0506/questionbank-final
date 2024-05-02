@extends('layouts.basic')
@section('header')
<x-headers.user page="Welcome back!" icon="<i class='bi bi-emoji-smile'></i>"></x-headers.user>
@endsection

@section('sidebar')
<x-sidebars.collaborator page='home'></x-sidebars.collaborator>
@endsection

@section('body')
<div class="responsive-container">
    <div class="container">
        <div class="flex flex-row justify-between items-center">
            <div class="bread-crumb">
                <div>Collabrator</div>
                <i class="bx bx-chevron-right"></i>
                <i class="bi-house"></i>
            </div>
            <div class="md:hidden text-slate-500">Welcome back!</div>
        </div>

        <!-- pallets -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mt-4">
            <a href="" class="pallet-box">
                <div class="flex-1">
                    <div class="title">Approved Questions</div>
                    <div class="flex items-center space-x-4">
                        <div class="h2">{{$questions->count()}}</div>
                        <div class="text-xs text-slate-600"><i class="bi-arrow-up"></i>{{$questions->where('is_approved', 1)->count()}} </div>
                    </div>
                </div>
                <div class="ico bg-green-100">
                    <i class="bi bi-question-circle text-green-600"></i>
                </div>
            </a>
            <a href="" class="pallet-box">
                <div class="flex-1">
                    <div class="title">Papers & Keys</div>
                    <div class="h2"> %</div>
                </div>
                <div class="ico bg-indigo-100">
                    <i class="bi bi-files text-indigo-600"></i>
                </div>
            </a>
            <a href="" class="pallet-box">
                <div class="flex-1">
                    <div class="title">Quizzes & Results</div>
                    <div class="h2"> %</div>
                </div>
                <div class="ico bg-sky-100">
                    <i class="bi bi-graph-up text-sky-600"></i>
                </div>
            </a>
            <a href="" class="pallet-box">
                <div class="flex-1 ">
                    <div class="title">Classes / Groups</div>
                    <div class="h2">%</div>
                </div>
                <div class="ico bg-teal-100">
                    <i class="bi bi-people text-teal-600"></i>
                </div>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 mt-8 gap-6 rounded">
            <!-- middle panel  -->
            <div class="md:col-span-2">
                <div class="p-4 bg-white">
                    <h2>Waiting for your approval</h2>
                    <div class="divider my-3 border-slate-200"></div>
                    <div class="overflow-x-auto mt-4">
                        <table class="table-fixed borderless w-full">
                            <thead>
                                <tr class="">
                                    <th class="w-8">Sr</th>
                                    <th class='w-60 text-left'>Question</th>
                                    <th class='w-6'>...</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $sr=1;
                                @endphp
                                @foreach($questions->where('is_approved', 0)->take(5) as $question) <tr class="tr">
                                    <td>{{$sr++}}</td>
                                    <td class=" text-left">{{ $question->statement }}</td>
                                    <td><a href="{{route('collaborator.approvals.edit',$question)}}" class="text-orange-600"><i class="bx bx-show-alt"></i></a></td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>

                </div>

            </div>
            <!-- middle panel end -->
            <!-- right side bar starts -->
            <div class="">
                <div class="bg-white p-4">
                    <h2>Profile</h2>
                    <div class="flex flex-col">
                        <div class="flex text-sm mt-4">
                            <div class="w-8"><i class="bi-person"></i></div>
                            <div>{{ Auth::user()->name }}</div>
                        </div>
                        <div class="flex text-sm mt-2">
                            <div class="w-8"><i class="bi-envelope-at"></i></div>
                            <div>{{ Auth::user()->email }}</div>
                        </div>
                        <div class="divider border-blue-200 mt-4"></div>
                        <div class="flex text-sm mt-4">
                            <div class="w-8"><i class="bi-key"></i></div>
                            <a href="{{route('passwords.edit', Auth::user()->id)}}" class="link">Change Password</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    @endsection