@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                @if ($video->editable())
                    <form action="{{route('videos.update', $video->id)}}" method="POST">
                        @csrf
                        @method('PUT')
                @endif
                <div class="card-header">{{ $video->title }}</div>
                <div class="card-body">
                    <div>
                        <video-player :video-source='@json(asset(Storage::url("videos/{$video->id}/{$video->id}.m3u8")))' />
                    </div>
                    
                    <div>
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h4 class="mt-3">
                                    @if ($video->editable())
                                         <input type="text" class="form-control" value="{{$video->title}}" name="title"/>
                                    @else
                                         {{$video->title}}
                                    @endif
                                </h4>
                                {{ $video->views }} {{ Str::plural('view', $video->views) }}
                            </div>
        
                            <div>
                                    <vote   entity_owner="{{ $video->channel->user_id }}" 
                                            :base-url='@json(asset('/iconSvg/'))'
                                            :default_votes='{{ $video->votes }}' /> 
                            </div>
                        </div>
        
                        <hr>
                        <div>
                            @if ($video->editable())
                              <textarea name="description" cols="3" rows="3" class="form-control">{{$video->description}}</textarea>
                              <div class="text-right mt-4">
                                  <button class="btn btn-info btn-sm" type="submit">Update video details</button>
                              </div>
                            @else
                               {{$video->description}} 
                            @endif
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-5">
                            <div class="media">
                                <img class="rounded-circle" src="https://picsum.photos/id/42/200/200" width="50" height="50" class="mr-3" alt="...">
                                <div class="media-body ml-2">
                                    <h5 class="mt-0 mb-0">
                                        {{ $video->channel->name }}
                                    </h5>
                                    <span class="small">Published on {{ $video->created_at->toFormattedDateString() }}</span>
                                </div>
                            </div>
        
                            <subscribe-button 
                            :chanel='@json($video->channel)'
                            :initial-subscriptions='@json($video->channel->subscriptions)'/>
                        </div>
                    </div>
                    @if ($video->editable())
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('styles')
<link href="https://vjs.zencdn.net/8.6.0/video-js.css" rel="stylesheet" />
<style>
    .vjs-default-skin {
        width: 100%;
    } 
</style>
@endsection
@section('scripts')
<script>
window.CURRENT_VIDEO = '{{ $video->id }}'
</script>
@endsection

