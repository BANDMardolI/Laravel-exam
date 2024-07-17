<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Larabook</title>
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>  
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
        <link href="{{asset('css/style.css')}}" rel="stylesheet">
        <!-- Latest compiled and minified JavaScript-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <script  src="https://code.jquery.com/jquery-3.7.1.min.js"  integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <style>
            .form-group{
                padding: 15px;
            }

        </style>
    </head><!-- /head -->
    <body>
    @section('menu')
    <div class="mainmenu1 col-sm-12 col-md-12 col-lg-12">
        <ul class="nav nav-pills nav-justified">
        <li role="presentation" {{$page =='Main page' ? 'class=active' : ''}}>
            <a href="{{url('/')}}">Main Page</a></li>
        <li role="presentation" {{$page == 'Add New' ? 'class=active' : ''}}>
            <a href="{{url('addnew')}}">Add New</a></li>

        @if (!Auth::check())
            <li role="presentation" {{$page == 'Login' ? 'class=active' : ''}}>
                <a href="{{url('login')}}">Login</a></li>

            <li role="presentation" {{$page == 'Registration' ? 'class=active' : ''}}>
                <a href="{{url('registration')}}">Registration</a></li>
            </ul>
        @else
            <li role="presentation" class="active" >
                <p>{{ Auth::user()->name }}</p></li>

            <li role="presentation"  class="active">
                <a href="{{url('logout')}}">Logout</a></li>
            </ul>
        @endif
    </div>
    @show
    <div class="container col-sm-12 col-md-12 col-lg-12">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session('message'))
            <div class="alert alert-success">
                {{session('message')}}
            </div>
        @endif
        @yield('content')
    </div>
    </body>
</html>
