
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/login.css') }}" rel="stylesheet"> <!-- for login form -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style> 
        
            
            /*src: url(../SanFranciscoFont-master/SanFranciscoText-Light.otf);*/
        @font-face {
           font-family: SF Pro Display;
        }
        *{
           font-family: SF Pro Display;
           font-weight: 200;
        }
    </style>
</head>

<body>

<div class="setup_bg">
   
            
<div class="modal-dialog" style="width:400px;margin-top: 5%;">
    <div class="modal-content">
        <div class="modal-header" style="text-align:center">
            <img width="150px"  src="{{ asset('css/teacher_icon.svg') }}"></img>
          <h2 class="text-center">Hệ thống quản lý luận văn</h2>
          <h4 class="text-center">Phân hệ giáo viên</h4>
        </div>
         <div class="modal-body">
            <form method="POST" action="{{ route('loginGV') }}">
                {{ csrf_field() }}

                 <div class="form-group">
                     <input type="text" name="email" value="{{ old('email') }}" required autofocus class="form-control input-lg" placeholder="Tài khoản giảng viên"/>
                 </div>

                 <div class="form-group">
                     <input type="password" class="form-control input-lg" placeholder="Mật khẩu" name="password" required />
                 </div>

                 <div class="form-group">
                     <input type="submit" class="btn btn-block btn-lg btn-primary" value="Login"/>
                     
                 </div>

            </form>
         </div>
</div>

</div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>


