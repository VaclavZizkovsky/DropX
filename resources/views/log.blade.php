@extends('layouts.default')

@section('head')
<link rel="stylesheet" href="./css/log.css">
<script src="./js/log.js"></script>
<title>File log – DropX</title>
@endsection

@section('h1', 'Incoming files')

@section('main')
<article id="log">
    @if(auth()->user()->getTransfers('to', 'sent')->count() > 0)
    <section id="incoming-transfers">
        @foreach(auth()->user()->getTransfers('to', 'sent') as $filetransfer)
        <div class="incoming-files">
            <h4>{{$filetransfer->files->count()}} incoming files from {{$filetransfer->fromDevice->name}}</h4>
            @if($filetransfer->files->count() > 0)
            <div class="incoming-file-list">
                <div class="transfered-file">
                    <span class="file-name">
                    {{$filetransfer->files->first()->name}}
                    @if($filetransfer->files->count() > 1)
                    and {{$filetransfer->files->count() - 1}} other files
                    @endif         
                    </span>
                </div>
            </div>
            @endif
            <div class="incoming-files-buttons">
                <form action="/download/{{$filetransfer->id}}" method="post" target="_blank" class="download-files-form">
                    @csrf
                    <button class="download-files-button"><i class="fa-solid fa-download"></i>&nbsp;Download</button>
                </form>
                <form action="/decline-transfer/{{$filetransfer->id}}" method="post" class="delete-files-form">
                    @csrf
                    @method('delete')
                    <button class="delete-files-button"><i class="fa-solid fa-trash-can"></i>&nbsp;Delete</button>
                </form>
            </div>
        </div>
        @endforeach
    </section>
    @endif
    
    <section id="file-log">
        <h2>File log</h2>

        @if(auth()->user()->getTransfers('all', ['downloaded', 'sent'])->count() == 0)
        <p>You haven't sent or recieved any files from other devices. <a href="/">Send some files!</a></p>
        @endif

        <div id="pagination">
        </div>

        @foreach (auth()->user()->getTransfers('all', 'downloaded') as $filetransfer)
        <div class="file-transfer">
            <div class="file-transfer-head">
                @if($filetransfer->fromDevice->name == auth()->user()->name)
                <h4>
                    {{$filetransfer->files->count()}} files sent to {{$filetransfer->toDevice->name}}
                </h4>
                @else
                <h4>
                    {{$filetransfer->files->count()}} files recieved from {{$filetransfer->fromDevice->name}}
                </h4>
                @endif
                <span>{{$filetransfer->created_at->format('d.m.Y H:i')}}</span>
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