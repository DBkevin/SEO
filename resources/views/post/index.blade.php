@extends('layouts.app')
@yield('title','')
@section('centont')
    <div class="row post_list">
        <div class="col-md-8 col-xs-12 cen mar-right">
            <ul class="mar-top list-unstyled">
                @foreach ($posts as $post)
                    <li>
                        
                        <h2><a href="{{route('posts.show',$post->id)}}">{{$post->title}}</a></h2>
                        <p class="text-justify">
                            {{ $post->body }}
                        </p>
                    </li>
                @endforeach
            </ul>
           {{$posts->links()}}
        </div>
        <div class="col-md-4 cen">

        </div>
    </div>

@endsection
