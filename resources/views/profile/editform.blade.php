@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>

                    <div class="panel-body">

                        <form action = "/edit" method = "POST" enctype="multipart/form-data">
                            <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">

                            <table>
                                <tr>
                                    <td>Nama </td>
                                    <td><input type='text' name='nama' value="{{$user->name}}"/></td>
                                </tr>
                                <br>

                                <tr>
                                    <td>Email </td>
                                    <br>
                                    <td>       <input type='text' name='email' value="{{$user->email}}"/>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        Foto : <input type="file" id="fotoProfil" name="fileUpload"/>
                                    </td>

                                </tr>

                                <tr>
                                    <td colspan = '2'><br>
                                        <input type = 'submit' value = "Upload"/>
                                    </td>

                                </tr>

                                <tr><img style="max-width: 100%" src=""></tr>
                            </table>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
