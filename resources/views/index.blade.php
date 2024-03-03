@extends('layouts.default')

@section('head')
<link rel="stylesheet" href="./css/index.css">
<script src="./js/index.js"></script>
<title>DropX – file transfer in few clicks</title>
@endsection

@section('h1', 'Send files')

@section('main')
<article id="upload">
    <form action="/upload" method="POST" id="upload-form" autocomplete="off" enctype="multipart/form-data">
        @csrf
        <div id="file">
            <div id="file-manual-select">
                <label for="file-input"><i class="fa-solid fa-file-circle-plus"></i>&nbsp;Select files</label>
                <input type="file" name="files[]" id="file-input" required multiple>
            </div>
            <p id="file-drop-message">or drag them on the screen</p>
            <div id="file-drop">
                <span>Drop the files here</span>
            </div>
        </div>
        <div id="file-list">
            <h3>Files to send</h3>
            <table id="file-list-table">
                <tbody></tbody>
            </table>
            <button type="button" id="clear-file-list-button"><i class="fa-solid fa-xmark"></i>&nbsp;Clear
                list</button>
        </div>
        <div id="device">
            <h3>Choose a device</h3>
            @if(count(auth()->user()->devices()) > 0)
            <select name="device" id="device-select">
                @foreach (auth()->user()->devices() as $connectedDevice)
                <option value="{{$connectedDevice->id}}">&nbsp;{{$connectedDevice->name}}</option>
                @endforeach
                <option id="add-device-option">Add a new device</option>
            </select>
            @else
            <button type="button" id="add-device-button"><i class="fa-solid fa-plus"></i>&nbsp;Add new device</button>
            @endif
        </div>
        <button type="submit"><i class="fa-solid fa-paper-plane"></i>&nbsp;Send</button>
        
    </form>

</article>
@endsection