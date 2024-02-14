@extends('layouts.default')

@section('head')
<link rel="stylesheet" href="./css/devices.css">
<script src="./js/devices.js"></script>
<title>My devices – DropX</title>
@endsection

@section('h1', 'My devices')

@section('main')
<article id="devices">
    <p>Here is the list of all devices connected to this device.</p>
    <button id="add-device-button"><i class="fa-solid fa-plus"></i>&nbsp;Add new device</button>
    <table id="device-table">
        @foreach ($device->devices() as $connectedDevice)
        <tr>
            <td>{{$connectedDevice->name}}</td>
            <td><i class="fa-solid {{$connectedDevice->typeIcon()}}"></i>&nbsp;{{$connectedDevice->type}}</td>
            <td><button><i class="fa-solid fa-link-slash"></i>&nbsp;Disconnect</button></td>
        </tr>
        @endforeach
    </table>
</article>
@endsection