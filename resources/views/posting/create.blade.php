@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>

                    <div class="panel-body">

                        <form action = "/post/posting" method = "post">
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
                                    <td><input type='text' name='Caption' /></td>
                                </tr>

                                <tr>
                                    <td colspan = '2'>
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
