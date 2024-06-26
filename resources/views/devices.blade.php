@extends('layouts.default')

@section('head')
<link rel="stylesheet" href="./css/devices.css">
<script src="./js/devices.js"></script>
<title>My devices – DropX</title>
@endsection

@section('h1', 'Device management')

@section('main')
<article id="devices">
    <section id="add-device">

        @foreach (auth()->user()->getConnections('to', 'pending') as $pendingDevice)
        <div class="pending-request">
            <span class="request-content">Device "{{$pendingDevice->name}}" wants to connect to this device</span>
            <div class="action-buttons">
                <form action="/accept-connection/{{$pendingDevice->id}}" method="post">
                    @csrf
                    @method('put')
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
        @if($errors->any())
        <span class="error-message">{{$errors->first()}}</span>
        @endif
        @if(session('success'))
        <span class="success-message">{{session('success')}}</span>
        @endif
        <h2>Add a device</h2>
        <form action="/add-device" method="POST" id="add-device-form" autocomplete="off">
            @csrf
            <span>Code of this device:</span>
            <span id="this-device-code">{{auth()->user()->code}}</span>
            <input type="text" inputmode="numeric" name="code" placeholder="Code" id="device-code-input" pattern="[0-9]{6}" required>
            <button type="submit" id="add-device-button">Connect devices</button>
        </form>
    </section>

    <section id="connected-devices">
        <h2>Connected devices</h2>
        @if(auth()->user()->devices()->count() > 0)
        <table id="device-table">
            @foreach (auth()->user()->devices() as $connectedDevice)
            <tr>
                <td><i class="fa-solid {{$connectedDevice->typeIcon()}}"></i>&nbsp;{{$connectedDevice->name}}</td>
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

        @if(auth()->user()->getConnections('to', 'cancelled')->count() > 0)
        <section id="cancelled-requests">
            <h3>Cancelled requests</h3>
            <button id="show-cancelled-requests-button">
                <i class="fa-solid fa-eye"></i>
                <span>Show {{auth()->user()->getConnections('to', 'cancelled')->count()}} cancelled requests</span>
            </button>
            <table id="cancelled-requests-table">
                @foreach (auth()->user()->getConnections('to', 'cancelled') as $request)
                <td>From {{$request->name}}</td>
                <td>
                    <form action="/accept-connection/{{$request->id}}" method="post">
                        @csrf
                        @method('put')
                        <button class="accept-request"><i class="fa-solid fa-check"></i>&nbsp;Accept</button>
                    </form>
                </td>
                @endforeach
            </table>
        </section>
        @endif
        @if(auth()->user()->getConnections('from', 'pending')->count() > 0)
        <section id="outcoming-requests">
            <h3>Outcoming requests</h3>
            <table id="outcoming-requests-table">
                @foreach (auth()->user()->getConnections('from', 'pending') as $request)
                <td>To  {{$request->name}}</td>
                <td>
                    <form action="/cancel-connection/{{$request->id}}" method="post">
                        @csrf
                        @method('delete')
                        <button class="decline-request"><i class="fa-solid fa-xmark"></i>&nbsp;Cancel</button>
                    </form>
                </td>
                @endforeach
            </table>
        </section>
        @endif

        <section id="delete-device">
            <h3>Delete device</h3>
            <form action="/delete-device" method="post" id="delete-device-form">
                @csrf
                @method('delete')
                <button type="submit" id="delete-device-button"><i class="fa-solid fa-trash-can"></i>&nbsp;Delete this
                    device</button>
            </form>
        </section>
    </section>
</article>
@endsection