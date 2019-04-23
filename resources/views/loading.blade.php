@extends('layouts.app')

@section('content')

<link href="{{ asset('css/please-wait.css') }}" rel="stylesheet">


@endsection


@section('javascripts')

<script src="js/please-wait.js"></script>
<script>
    var loading_screen = pleaseWait({
        logo: "assets/images/pathgather.png",
        backgroundColor: '#f46d3b',
        loadingHtml: "<div class='sk-spinner sk-spinner-wave'><div class='sk-rect1'></div><div class='sk-rect2'></div><div class='sk-rect3'></div><div class='sk-rect4'></div><div class='sk-rect5'></div></div>"
    });
</script>


@endsection