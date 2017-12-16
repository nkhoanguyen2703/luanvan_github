@extends('layouts.layoutSV')

@section('content')
<div class="panel panel-default">
    <div class="panel-body">

	<h2>Kết quả luận văn</h2>
	<h5>Lịch sử chấm điểm</h5>
	<div class='well'>
	<div class="table-responsive">          
	  <table class="table">
	    <thead>
	      <tr>
	        
	        <th>Tên giáo viên</th>
	        <th>Số điểm</th>
	        <th>Nhận xét</th>
	        <th>Thời gian</th>
	        
	      </tr>
	    </thead>
	    <tbody>
	    	@foreach($gv as $row)
	      <tr>
	        
	        <td>{{ $row->gv_ten }}</td>
	        <td>{{ $row->diem }}</td>
	        <td>{{ $row->nhanxet  }}</td>
	        <td>{{date('h:i A - d/m/y  ',strtotime($row->created_at))}}</td>
	        
	      </tr>
	      @endforeach
	    </tbody>
	  </table>
	 </div>
	 </div>

	 <h5>Kết quả cuối cùng <i>( kết quả lần chấm sau cùng của từng giảng viên )</i></h5>
	<div class='well'>
	<div class="table-responsive">          
	  <table class="table">
	    <thead>
	      <tr>
	        
	        <th>Tên giáo viên</th>
	        <th>Điểm</th>
	        <th>Nhận xét</th>
	        <th>Thời gian</th>
	        
	      </tr>
	    </thead>
	    <tbody>
	    	@foreach($diemcuoi as $ro)
	      <tr>
	        
	        <td>{{ $ro->gv_ten }}</td>
	        <td>{{ $ro->diem }}</td>
	        <td>{{ $ro->nhanxet }}</td>
	        <td>{{date('h:i A - d/m/y  ',strtotime($ro->created_at))}}</td>
	        
	      </tr>
	      @endforeach
	      
	      <tr>
	      	<td colspan='4'><b>Số điểm cuối cùng : {{ $tb }}</b></td>
	      </tr>
	      <tr>
	      	<td colspan='4'><b>Điểm chữ : {{ $diemchu }}</b></td>
	      </tr>
	    </tbody>
	  </table>
	 </div>
	 </div>
@endsection