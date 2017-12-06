@extends('layouts.app')

<title>Wancuk - Home</title>

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel-default">{{ $posting->links() }}</div>
            @foreach ($posting as $post)
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading"><a href = '{{ route('viewPost',['post_id' => $post->id_posting ]) }}'>{{ $post->judul_posting }}</a></div>
                        <div class="panel-body">
                            @if($post->tipe_posting=="jpeg" || $post->tipe_posting=="jpg" || $post->tipe_posting=="png")
                                <img style="max-width: 200px" src="{{ URL::to('storage/' . $post->media_path) }}">
                            @elseif($post->tipe_posting=="mpga")
                                <audio src="{{ URL::to('storage/' . $post->media_path) }} " controls>
                                    Sorry, your browser doesn't support HTML5 audio
                                </audio>
                            @endif
                            <tr>
                                <h3><td>{{ $post->caption }}</td><br></h3>
                                <h6><td>View : {{$post->view_count}} Like : {{$post->like_count}}</td><br></h6>
                            </tr>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
