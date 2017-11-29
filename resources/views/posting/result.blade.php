@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            @foreach ($posting as $post)
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading">Post</div>
                        <div class="panel-body">
                            <tr>
                                <td>{{ $post->id_posting }}</td>
                                <td>{{ $post->judul_posting }}</td>
                                <td><a href = '{{ route('viewPost',['post_id' => $post->id_posting ]) }}'>Link</a></td>
                            </tr>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
@endsection
