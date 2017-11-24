@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">My Post</div>

                    <div class="panel-body">

                        <table border = 1>
                            <tr>
                                <td>ID Post</td>
                                <td>Judul Posting</td>
                                <td>Link</td>
                            </tr>
                            @foreach ($posting as $post)
                                <tr>
                                    <td>{{ $post->id_posting }}</td>
                                    <td>{{ $post->judul_posting }}</td>
                                    <td><a href = '{{ route('viewPost',['post_id' => $post->id_posting ]) }}'>Link</a></td>
                                </tr>
                            @endforeach
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
