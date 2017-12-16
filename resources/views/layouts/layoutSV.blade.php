
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
    <link href="{{ asset('css/sinhvien.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!--     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 -->  
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    
    <style> 
        
            
            /*src: url(../SanFranciscoFont-master/SanFranciscoText-Light.otf);*/
        @font-face {
           font-family: SF Pro Display;
        }
        *{
           font-family: SF Pro Display;
           font-weight: 200;
        }
        body{
          
        }
    </style>
</head>
<style>.nav li a:hover{background-color: black;}</style>
<body>
    <nav class="navbar navbar-fixed-top" 
    style="color:white; background: linear-gradient(#26537a, #191919); box-shadow: 0px 1px 5px #888888;">
            <div class="container">
                <div class="navbar-header">


                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" style="padding-top: 0px; line-height:40px; ">
                    <img class="img-responsive"  width='40px' src="{{ asset('css/ctulogo.png') }}">
                    </a>  
                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}" style="color:white;">
                        <!-- {{ config('app.name', 'Laravel') }} -->
                        Hệ thống quản lý luận văn 
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                            <li><a href="{{ route('login') }}">Login</a></li>
                        @else

                        

                          <form method="GET" action="{{ route('search','noidungsearch') }}" class="navbar-form navbar-left">
                            <div class="input-group">
                              <input type="text" name='noidungsearch' class="form-control" placeholder="Tìm thông tin luận văn">
                              <div class="input-group-btn">
                                <button class="btn btn-default" type="submit">
                                  <i class="glyphicon glyphicon-search"></i>
                                </button>
                              </div>
                            </div>
                          </form>


                            <li >
                                <a style="color:white;" >
                                  <span class="glyphicon glyphicon-user"></span>
                                    {{ Auth::user()->get_tenSV()}}    
                                </a>
                            </li>
                            <li>
                            <a style="color:white;" href="{{ route('logout') }}"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                            
                        @endguest
                    </ul>

                </div>
                

            </div>
        </nav>
    

    <div class="container" style="margin-top: 70px;">
        <div id="app">
            
            <div class="row">

              <div class="col-sm-3" >
                    <div class="panel panel-default" style="border:none;">
                      <a href="{{ route('home') }}"><div class="panel-body" style="font-size:16px;background-color: #26537A;color:white;border-radius:3px;">Trang chủ</div></a>
                    </div>
                    
                            <ul class="list-group" style="font-size:16px;">
                              <a href="{{ route('dkdetai') }}" class="list-group-item">
                                <span class="glyphicon glyphicon-pencil"></span>&nbsp&nbsp
                              Đăng ký đề tài</a>
                              <a href="{{ route('dexuat') }}" class="list-group-item">
                              <span class="glyphicon glyphicon-share-alt"></span>&nbsp&nbsp
                              Đề xuất đề tài</a>
                              <a href="{{ route('xemdiem') }}" class="list-group-item">
                                <span class="glyphicon glyphicon-eye-open"></span>&nbsp&nbsp
                              Kết quả luận văn</a>

                                                       
                              <a href="#" class="list-group-item" data-toggle="modal" data-target="#myModal">
                              <span class="glyphicon glyphicon-upload"></span>&nbsp&nbsp
                              Nộp luận văn</a><br>

                              

                              @if (session('alert_ok_lv'))           
                                <div class="alert alert-success alert-dismissable">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                {{ session('alert_ok_lv') }}
                                </div> 
                                <span style="color:#87c932;"></span>
                              @endif
                              @if (session('alert_not_lv'))
                                <div class="alert alert-danger alert-dismissable">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                <strong>Thất bại ! </strong>{{ session('alert_not_lv') }}
                                </div> 
                                
                              @endif
                              </ul>
                              
                              
                            </ul>
                      
                    
              </div>

              <div class="col-sm-9">
                    @yield('content')
              </div>

            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-default" style="border:none;">
                      <div class="panel-body" style="font-size:13px;background-color: #26537A;color:white;border-radius:3px; ">
                        <span style="font-size:20px;">Khoa Công nghệ Thông tin & Truyền thông - Trường Đại học Cần Thơ</span>
                        
<br>Khu 2, đường 3/2, Phường Xuân Khánh, Q. Ninh Kiều, TP. Cần Thơ, Việt Nam;
<br><i>Nguyễn Thái Ngọc Khoa, Điện thoại: 0939 094 490, Email: khoab1400878@student.ctu.edu.vn</i>
                      </div>
                    </div>
                </div>
            </div>
            <!-- @yield('content') -->
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>


<!--phan tai len luan van -->
<div class="modal fade" id="myModal" role="dialog" >
    <div class="modal-dialog" >
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Tải lên luận văn</h4>
        </div>
        <div class="modal-body">
          <p>Lưu ý: Sinh viên chỉ được nộp luận văn bằng tệp .PDF</p>
            <form action="{{ url('file') }}" enctype="multipart/form-data" method="POST">
                {{ csrf_field() }}
                <input class="btn btn-default" type="file" name="filesTest" required="true">
                <br/>
                <input class="btn btn-default" type="submit" value="upload">
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
