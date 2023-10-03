@extends('layouts.app')

@section('content')
<div class="container">
   
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                  {{$channel->name}}
                  <a href="{{route('channel.upload', $channel->id)}}">Upload Video </a>
                </div>

                <div class="card-body">
                    @if ($channel->editable())
                    <form  id="update-channel-form" action="{{route('channels.update', $channel->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        
                    @endif
                   
                        <div class="form-group row justify-content-center">
                            <div class="channel-avatar">
                                @if($channel->editable())
                                    <div onclick="document.getElementById('image').click()" class="channel-avatar-orverlay">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-camera" viewBox="0 0 16 16"> <path d="M15 12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1h1.172a3 3 0 0 0 2.12-.879l.83-.828A1 1 0 0 1 6.827 3h2.344a1 1 0 0 1 .707.293l.828.828A3 3 0 0 0 12.828 5H14a1 1 0 0 1 1 1v6zM2 4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-1.172a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 9.172 2H6.828a2 2 0 0 0-1.414.586l-.828.828A2 2 0 0 1 3.172 4H2z"/> 
                                            <path d="M8 11a2.5 2.5 0 1 1 0-5 2.5 2.5 0 0 1 0 5zm0 1a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7zM3 6.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0z"/> </svg>
                                    </div>
                                @endif
                                <img src="{{asset($channel->image())}}" alt=""> 
                            </div>
                        </div>
                        <div class="form-group" style="margin-top: 10px">
                            <h4 class="text-center">
                                {{$channel->name}}
                            </h4>
                            <p class="text-center">
                                {{$channel->description}}
                            </p>
                           
                            <div class="text-center">
                                <subscribe-button 
                                     :chanel='@json($channel)'
                                     :initial-subscriptions='@json($channel->subscriptions)'/>
                            </div>
                           
                        </div>
                       @if ($channel->editable())
                       <input onchange="document.getElementById('update-channel-form').submit()" style="display: none;"  id="image" type="file" name="image">
                       <div class="form-group">
                           <label for="name" class="form-control-label">
                               Name
                           </label>
                           <input id="name" name="name" value="{{ $channel->name }}" type="text" class="form-control">
                       </div>

                       <div class="form-group">
                           <label for="description" class="form-control-label">
                               Description
                           </label>
                           <textarea name="description" id="description" rows="3" class="form-control">{{ $channel->description }}</textarea>
                       </div>
                       @if ($errors->any())
                       <ul class="list-group" style="margin-top: 10px;">
                           @foreach ($errors->all() as $error)
                             <li class="text-danger list-group-item">
                                 {{$error}}
                             </li>
                           @endforeach
                       </ul>
                    @endif
                    <button type="submit" class="btn btn-info" style="margin-top: 10px;">
                        Update Channel
                    </button>
                    @endif
                       
                    @if ($channel->editable())   
                    </form>
                    @endif
                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
