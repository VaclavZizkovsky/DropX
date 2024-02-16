@extends('layouts.default')

@section ('head')
<link rel="stylesheet" href="{{url('css/add-device.css')}}">
<script src="{{url('/js/add-device.js')}}"></script>
<title>Add new device – DropX</title>
@endsection

@section('h1', 'Add new device')

@section('main')
<article>
    <p>Enter the code of the device you want to connect and then click on the button</p>
    <form action="/add-device" method="POST" id="add-device-form" autocomplete="off">
        @csrf
        <span>Code of this device:</span>
        <span id="this-device-code">{{auth()->user()->code}}</span>
        <input type="text" name="code" placeholder="Code" id="device-code-input" pattern="[0-9]{6}" required>
        <button type="submit" id="add-device-button">Connect devices</button>
    </form>
</article>
@endsection('main')