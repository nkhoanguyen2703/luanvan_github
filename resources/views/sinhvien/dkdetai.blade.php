

@extends('layouts.layoutSV')

@section('content')

<div class="panel panel-default">
    <div class="panel-body">

	<h2>Đăng ký đề tài luận văn</h2>
	<?php 
	if(count($listDetai)>0){

	?>


	Thời gian đăng ký: 
	{{date('d/m/y',strtotime($listDetai[0]->kh_ngaydangky))}} - {{date('d/m/y',strtotime($listDetai[0]->kh_handangky))}}
	( theo {{ $listDetai[0]->kh_ten}})
	<hr>

    @if (session('alert_ok'))
    <div class="alert alert-success">
        {{ session('alert_ok') }}
    </div>
    @endif
    @if (session('alert_not'))
    <div class="alert alert-danger">
        {{ session('alert_not') }}
    </div>
    @endif 



    
  	<div class="row">
  	@foreach ($listDetai as $dt)
	  <div class="col-sm-6">
		  <div class="well" height='300px'><b>{{ $dt->dt_ten }}</b>
		  	<br><b>Nội dung:</b> {{ $dt->dt_noidung }}
		  	<br><i><b>Chủ nhiệm:</b> {{ $dt->gv_ten }}		</i>	  	
		  	<br><a href="{{ Route('dkdetailv',[ $dt->dt_ma ]) }}"><button class="btn btn-default btn-xs">Đăng ký</button></a>	  
		  </div>


	  </div>
	@endforeach  
	
	</div>
	
  	<?php
  	}else echo "Chưa có đề tài";
  	?>
  
</div>
</div>
@endsection
