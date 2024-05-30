@extends('main')

@section('title', 'Tecmunity')

@section('contenido')
@if($perfil->privado == 1 && $perfil->id !== auth()->user()->id)
    <div class="right_row">
        <div class="row border-radius">
            <div class="feed">
                <div class="feed_title">
                    <span>Este perfil es privado.</span>
                </div>
            </div>
        </div>
@else
    <div class="right_row">
        <div class="row border-radius">
            <div class="feed">
                <div class="feed_title">
                    <span><a href="profile.html" id="select_profile_menu"><b>Profile</b></a> | <a href="about.html"><b>About</b></a> | <a href="photos.html"><b>Photos</b></a></span>
                </div>
            </div>
        </div>
    @if($perfil->id == auth()->user()->id)
        <div class="row">
            <div class="publish">
                <div class="row_title">
                    <span><i class="fa fa-newspaper-o" aria-hidden="true"></i> Status</span>
                </div>
                <form method="POST" action="{{ route('publicaciones.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="publish_textarea">
                        <img class="border-radius-image" src="{{ auth()->user()->avatar ? asset('storage/' . auth()->user()->avatar) : asset('img/default-avatar.png') }}" alt="" />
                        <textarea name="contenido" placeholder="¿Algo que decir, {{ auth()->user()->nombre }}?" style="resize: none;"></textarea>
                    </div>
                    <div class="publish_icons">
                        <ul>
                            <li>
                                <input type="file" name="media" accept="image/*,video/*" style="display: none;" id="input-media" onchange="previewMedia(event)">
                                <label for="input-media">
                                    <i class="fa fa-camera"></i>
                                </label>
                            </li>
                            <li>
                                <input type="url" name="video_url" placeholder="Video URL" style="display: none;" id="input-video-url" onchange="showVideoPreview(event)">
                                <label for="input-video-url">
                                    <i class="fa fa-video-camera"></i>
                                </label>
                            </li>
                        </ul>
                        <button type="submit">Publish</button>
                    </div>
                    <div id="media-preview" style="margin-top: 10px;"></div>
                </form>
            </div>
        </div>
    @endif
    @foreach($publicaciones as $publicacion)
        <div class="row border-radius"> 
            <div class="feed">
                <div class="feed_title">
                    <a href="{{ route('perfil.show', ['id' => $perfil->id]) }}">
                        <img src="{{ Storage::url($publicacion->usuario->avatar) }}" alt="" />
                    </a>
                    <span>
                        <a href="{{ route('perfil.show', ['id' => $publicacion->usuario->id]) }}"><b>{{ $publicacion->usuario->nombre }} {{ $publicacion->usuario->apellido }}</b></a> shared a 
                        @if($publicacion->url_media)
                            <a href="{{ route('perfil.show', ['id' => $publicacion->usuario->id]) }}">{{ $publicacion->isVideo() ? 'video' : 'photo' }}</a>
                        @else
                            <a href="{{ route('perfil.show', ['id' => $publicacion->usuario->id]) }}">post</a>
                        @endif
                        <br>
                        <p>{{ $publicacion->created_at->format('F d \a\t h:i A') }}</p>
                    </span>
                </div>
                <div class="feed_content">
                    @if($publicacion->url_media)
                        <div class="feed_content_image">
                            @if($publicacion->isVideo())
                                <video controls style="max-width: 500px; max-height: 500px;">
                                    <source src="{{ Storage::url($publicacion->url_media) }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            @else
                                <a href=""><img src="{{ Storage::url($publicacion->url_media) }}" alt="" /></a>
                            @endif
                        </div>
                    @endif
                    <div class="feed_content_image">
                        <p>{{ $publicacion->contenido }}</p>
                    </div>
                    @if($publicacion->video_url)
                        <div class="feed_content_video">
                            <a href="{{ $publicacion->video_url }}" target="_blank">{{ $publicacion->video_url }}</a>
                        </div>
                    @endif
                </div>
                <div class="feed_footer">
                    <ul class="feed_footer_left">
                        <li class="hover-orange selected-orange"><i class="fa fa-heart"></i> {{ $publicacion->nro_likes }}</li>
                        <li><span><b>{{ $publicacion->usuario->nombre }}</b> and others liked this</span></li>
                    </ul>
                    <ul class="feed_footer_right">
                        <li class="hover-orange selected-orange"><i class="fa fa-share"></i> 7k</li>
                        <a href="feed.html" style="color:#515365;">
                            <li class="hover-orange"><i class="fa fa-comments-o"></i> 74 comments</li>
                        </a>
                    </ul>
                </div>
            </div>
        </div>
    @endforeach
@endif
@endsection