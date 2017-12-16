@extends('layouts.layoutGV')


@section('content')


<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<h2>Danh sách đề tài chủ nhiệm</h2>
	

	@foreach ($listDT as $key)
	
	
		<div class="panel panel-default">
		  <div class="panel-heading">{{$key->dt_ten}}</div>
		  <div class="panel-body">
		  	{{$key->dt_noidung}}
		  </div>
		</div>
         
    
    
    @endforeach
    
</div>


@endsection