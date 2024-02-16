@extends('layouts.default')

@section('head')
<link rel="stylesheet" href="./css/log.css">
<script src="./js/log.js"></script>
<title>File log – DropX</title>
@endsection

@section('h1', 'File log')

@section('main')
<article id="log">
    <p>There are all sent and incoming files for this device on this page.</p>
    <section id="file-log">
        @foreach (auth()->user()->fileTransfers as $filetransfer)
        <div class="file-transfer">
            <div class="file-transfer-head">
                @if($filetransfer->fromDevice->name == $device->name)
                <h4>
                    {{$filetransfer->files->count()}} files sent to {{$filetransfer->toDevice->name}}
                </h4>
                @else
                <h4>
                    {{$filetransfer->files->count()}} files recieved from {{$filetransfer->fromDevice->name}}
                </h4>
                @endif
                <span>{{$filetransfer->created_at->format('d.m.Y h:i')}}</span>
            </div>
            <div class="transfered-files-list">
                @foreach ($filetransfer->files as $file)
                <div class="transfered-file">
                    <span class="file-icon"></span><span class="file-name">{{$file->name}}</span>
                </div>
                @endforeach
            </div>
        </div>
        @endforeach
    </section>
</article>
@endsection