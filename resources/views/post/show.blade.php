@extends('layouts.app')
@yield('title','{{$post->title}}')
@section('centont')
  <div class="row post_list">
        <div class="col-md-8 col-xs-12 cen mar-right">
            <h2>
                {{$post->title}}
            </h2>
            <p class="text-left">
                {!! $post->body !!}
            </p>
        </div>
        <div class="col-md-4 cen">

        </div>
    </div>
    
@endsection