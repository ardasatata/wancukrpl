@extends('layouts.app')
<title>Wancuk - Create Post</title>
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>

                    <div class="panel-body">

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action = "/post/posting" method = "POST" enctype="multipart/form-data">
                            <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">

                            <table>
                                <tr>
                                    <td>Judul Posting</td>
                                    <td><input type='text' name='Judul' /></td>
                                </tr>
                                <br>

                                <tr>
                                    <td>Caption</td>
                                    <br>
                                    <td>       <input type='text' name='Caption' />
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
                            </table>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
