@extends('layouts.basic')

@section('body')
<style>
    .main {
        position: relative;
        overflow: hidden;
    }

    .main::before {
        background: #edf3fb;
        content: "";
        position: absolute;
        width: 30rem;
        height: 30rem;
        border-radius: 50%;
        align-items: center;
        display: flex;
        justify-content: center;
        transform: scale(120%);
        z-index: -1;
    }
</style>
<div class="main flex flex-col items-center justify-center w-screen h-screen px-5 text-black">
    <div class="flex flex-col justify-between items-center w-full  md:w-1/3 h-[80vh] px-8 py-3 rounded-lg backdrop-blur-2xl relative">
        <!-- authenticated -->
        <div class="text-center">
            <i class="bi bi-person-fill-check text-8xl text-teal-600"></i>
        </div>

        <div class="w-full">
            <!-- page message -->
            @if($errors->any())
            <x-message :errors='$errors'></x-message>
            @else
            <x-message></x-message>
            @endif

            <div class="border border-dotted border-slate-600 p-4">
                <h1 class="text-slate-600">Welcome {{Auth::user()->name}}</h1>
                <p class="text-slate-600 text-sm">Dear user! please select one of the following roles and click on proceed button. You may also cancel and go back to home page as well</p>
            </div>
            <form action="{{route('login.as')}}" method='post' class="w-full mt-8" onsubmit="return validate(event)">
                @csrf
                <select id="role" name="role" class="custom-input  px-4 w-full" onchange="loadDepartments()">
                    @foreach(Auth::user()->roles as $role)
                    <option value="{{$role->name}}" class="">{{ucfirst($role->name)}}</option>
                    @endforeach
                </select>
                <div class="flex items-center space-x-4 mt-3">
                    <button type="submit" class="flex flex-1 btn-indigo justify-center py-2">Proceed</button>
                </div>

            </form>


        </div>
        <div class="text-center text-xs">
            <a href="{{url('signout')}}">Cancel & Go Back</a>
        </div>

    </div>
    @endsection
    @section('script')
    <script>
        function showpw() {
            $('#password').prop({
                type: "text"
            });
            $('.eye-slash').hide()
            $('.eye').show();
        }

        function hidepw() {
            $('#password').prop({
                type: "password"
            });
            $('.eye-slash').show()
            $('.eye').hide();
        }

        function validate(event) {
            var validated = true;
            var role = $('#role').val()
            var department = $('#department_id').val()
            var semester = $('#semester_id').val()

            if (role == '') {
                validated = false;
                event.preventDefault();
                Swal.fire({
                    icon: 'warning',
                    title: 'Please select a role',
                    showConfirmButton: false,
                    timer: 1500,
                })

            } else if (role == 'hod' || role == 'teacher') {
                //semester required for both
                if (semester == '') {
                    validated = false;
                    event.preventDefault();
                    Swal.fire({
                        icon: 'warning',
                        title: 'Please select a semester',
                        showConfirmButton: false,
                        timer: 1500,
                    })
                }
                //department required for only hod
                if (role == 'hod' && department == '') {
                    validated = false;
                    event.preventDefault();
                    Swal.fire({
                        icon: 'warning',
                        title: 'Please select a department',
                        showConfirmButton: false,
                        timer: 1500,
                    })
                }

                return validated;
                // return false;

            }
        }
    </script>

    @endsection