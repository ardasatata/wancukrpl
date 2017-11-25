@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>

                    <div class="panel-body">

                        <form action = "/post/{{$post->id_posting}}/edit" method = "POST" enctype="multipart/form-data">
                            <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">

                            <table>
                                <tr>
                                    <td>Judul Posting</td>
                                    <td><input type='text' name='Judul' value="{{$post->judul_posting}}"/></td>
                                </tr>
                                <br>

                                <tr>
                                    <td>Caption</td>
                                    <br>
                                    <td>       <input type='text' name='Caption' value="{{$post->caption}}"/>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        File : <input type="file" id="fileUpload" name="fileUpload"/>
                                    </td>

                                </tr>



                                <tr>
                                    <td colspan = '2'><br>
                                        <input type = 'submit' value = "Upload"/>
                                    </td>

                                </tr>

                                <tr><img style="max-width: 100%" src="{{ URL::to('storage/' . $post->media_path) }} "></tr>
                            </table>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
