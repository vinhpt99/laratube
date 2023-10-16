@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $video->title }}</div>
                <div class="card-body">
                    <video-player :video-source='@json(asset(Storage::url("videos/{$video->id}/{$video->id}.m3u8")))' />
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('styles')
<link href="https://vjs.zencdn.net/8.6.0/video-js.css" rel="stylesheet" />
@endsection

