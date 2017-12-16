
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>

    <!-- PrintPreview -->
    <link rel="stylesheet" href="{{asset('css/print-preview.css')}}" type="text/css" media="screen">
    <script src="http://cdn.jquerytools.org/1.2.5/full/jquery.tools.min.js"></script>
    <script src=" {{asset('js/jquery.print-preview.js')}}" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript">
        $(function() {
            
            // Add link for print preview and intialise
            
            $('a.print-preview').printPreview();
            
            
        });
    </script>
    <!-- End PrintPreview -->
    <style> 
        
            
            /*src: url(../SanFranciscoFont-master/SanFranciscoText-Light.otf);*/
        
        *{
           font-family: SF Pro Display;
           font-weight: 200;
        }
    </style>
</head>
<body style="background: url('{{ asset('css/des.jpg') }}') no-repeat center center fixed;">
    
    <nav class="navbar navbar-fixed-top" style="background: linear-gradient(#26537a, #191919);box-shadow: 0px 1px 5px #888888;">
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
                        {{ config('app.name', 'Laravel') }}

                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                          <!-- <li><a href="{{ route('raKHLV') }}">Ra KHLV</a></li>
                          <li><a href="{{ route('raDetai') }}">Ra đề tài</a></li>
                          <li><a href="#">Duyệt đề tài được SV đề xuất</a></li>
                          <li><a href="{{ route('quanlySV') }}">Quản lý sinh viên</a></li>
                          <li><a href="{{ route('chamdiem') }}">Chấm điểm</a></li> -->
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        <?php
                        if (Auth::guard('giangvien')->check()){
                           
                        ?>
                        
                            
                        
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" style="color:white;">
                                

                                     {{ Auth::guard('giangvien')->user()->gv_ten}}   
                                
                                    <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('logoutGV') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logoutGV') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        <?php
                        }else{ 
                        ?>

                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>
    </nav>

    <div class="container" style="margin-top: 70px;">
        <div id="app">
            
            <div class="row">

              <div class="col-sm-3" >
                    <div class="panel panel-default" style="border:none;">
                      <a href="{{route('quanlySV')}}"><div class="panel-body" style="font-size:16px;background-color:#26537A;color:white;border-radius:3px;">Trang chủ</div></a>
                    </div>
                    
                            <ul class="list-group" style="font-size:16px;">
                              <a href="{{route('raKHLV')}}" class="list-group-item">
                                <span class="glyphicon glyphicon-pencil"></span>&nbsp&nbsp
                              Ra kế hoạch luận văn</a>
                              <a href="{{ route('raDetai') }}" class="list-group-item">
                              <span class="glyphicon glyphicon-share-alt"></span>&nbsp&nbsp
                              Ra đề tài</a>
                              <a href="{{route('quanlySV')}}" class="list-group-item">
                                <span class="glyphicon glyphicon-eye-open"></span>&nbsp&nbsp
                              Quản lý sinh viên</a>

                              <a href="{{route('ds_detai')}}" class="list-group-item">
                                <span class="glyphicon glyphicon-list-alt"></span>&nbsp&nbsp
                              Danh sách đề tài chủ nhiệm</a>

                              <a href="{{ route('chamdiem') }}" class="list-group-item">
                                <span class="glyphicon glyphicon-pencil"></span>&nbsp&nbsp
                              Chấm điểm</a>
                              <a  onclick="printExternal('http://localhost/luanvan/public/giangvien/printPreview')"  id="aside" class="list-group-item print-preview">
                                <span class="glyphicon glyphicon-print"></span>&nbsp&nbsp
                              In danh sách sinh viên</a>                 
                                
                              </ul>
                              
                              
                            </ul>
                      
                    
              </div>

              <div class="col-sm-9">
                    @yield('content')
              </div>

            </div>



<script>
function myFunction() {
    window.print();
}
function printExternal(url) {
    var printWindow = window.open( url, 'Print', 'left=200, top=200, width=950, height=500, toolbar=0, resizable=0');
    printWindow.addEventListener('load', function(){
        printWindow.print();
        printWindow.close();
    }, true);
}
</script>


            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-default" style="border:none;">
                      <div class="panel-body" style="font-size:13px;background-color: #26537A;color:white;border-radius:3px; ">
                        <span style="font-size:20px;">
                        
                        Khoa Công nghệ Thông tin & Truyền thông - Trường Đại học Cần Thơ</span>
<br>Khu 2, đường 3/2, Phường Xuân Khánh, Q. Ninh Kiều, TP. Cần Thơ, Việt Nam;
<br><i>Nguyễn Thái Ngọc Khoa, Điện thoại: 0939 094 490, Email: khoab1400878@student.ctu.edu.vn</i>
                      </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
