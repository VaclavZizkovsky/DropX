@extends('layouts.default')

@section('head')
<link rel="stylesheet" href="./css/devices.css">
<script src="./js/devices.js"></script>
<title>My devices – DropX</title>
@endsection

@section('h1', 'Device management')

@section('main')
<article id="devices">
    @foreach (auth()->user()->pendingConnections() as $pendingDevice)
    <div class="pending-request">
        <span class="request-content">Device "{{$pendingDevice->name}}" wants to connect to this device</span>
        <div class="action-buttons">
            <form action="/accept-connection/{{$pendingDevice->id}}" method="post">
                @csrf
                @method('PUT')
                <button class="accept-request"><i class="fa-solid fa-check"></i>&nbsp;Accept</button>
            </form>
            <form action="/decline-connection/{{$pendingDevice->id}}" method="post">
                @csrf
                @method('delete')
                <button class="decline-request"><i class="fa-solid fa-xmark"></i>&nbsp;Decline</button>
            </form>
        </div>
    </div>
    @endforeach
    <h2>Add a device</h2>
    <p>Enter the code of the device you want to connect and then click on the button</p>
    <form action="/add-device" method="POST" id="add-device-form" autocomplete="off">
        @csrf
        @if($errors->any())
        <span class="error-message">{{$errors->first()}}</span>
        @endif
        <span>Code of this device:</span>
        <span id="this-device-code">{{auth()->user()->code}}</span>
        <input type="text" name="code" placeholder="Code" id="device-code-input" pattern="[0-9]{6}" required>
        <button type="submit" id="add-device-button">Connect devices</button>
    </form>

    <h2>Connected devices</h2>
    <p>Here is the list of all devices connected to this device.</p>
    <button id="add-device-button"><i class="fa-solid fa-plus"></i>&nbsp;Add new device</button>
    @if(count(auth()->user()->devices()) > 0)
    <table id="device-table">
        @foreach (auth()->user()->devices() as $connectedDevice)
        <tr>
            <td>{{$connectedDevice->name}}</td>
            <td><i class="fa-solid {{$connectedDevice->typeIcon()}}"></i>&nbsp;{{$connectedDevice->type}}</td>
            <td>
                <form action="/delete-connection/{{$connectedDevice->id}}" method="post">
                    @csrf
                    @method('delete')
                    <button><i class="fa-solid fa-link-slash"></i>&nbsp;Disconnect</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    @else
    <p>No device connected. Connect any device to send files to them</p>
    @endif
</article>
@endsection