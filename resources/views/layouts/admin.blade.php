@extends('layouts.basic')

@section('header')
<x-headers.user></x-headers.user>
@endsection

@section('sidebar')
<x-sidebars.admin></x-sidebars.admin>
@endsection


@section('body')

<div class="responsive-body">
    @yield('page-content')
</div>

<script type="module">
    $('#menu').click(function() {
        $("aside").toggleClass('shown');
    });

    $('.responsive-body').click(function(event) {
        var box = $('#sidebar');
        if (!box.is(event.target) && box.has(event.target).length === 0) {
            box.removeClass('shown');
        }
    })
</script>
@endsection