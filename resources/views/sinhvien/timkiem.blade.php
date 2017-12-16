@extends('layouts.layoutSV')

@section('content')
<div class="panel panel-default">
    <div class="panel-body">

	<h2>Kết quả tìm kiếm</h2>
	   
	  <table class="table table-striped">
	    <thead>
	      <tr>
	        <th>Bộ môn</th>
	        <th>Tên đề tài</th>
	        <th>Chủ nhiệm</th>
	        <th>Sinh viên</th>
	        <th>Tệp</th>
	      </tr>
	    </thead>
	    <tbody>
	    	@foreach($ketqua as $key)
	      <tr>
	        <td>{{ $key->bm_ten }}</td>
	        <td>{{ $key->dt_ten }}</td>
	        <td>{{ $key->gv_ten }}</td>
	        <td>{{ $key->sv_ten }}</td>
	        <td>
	        <a data-toggle="modal" data-target="#{{ $key->sv_ma }}"  href="" target="_blank"><span class="glyphicon glyphicon-file"></span></a>
	        </td>
	      </tr>
	      @endforeach
	      
	    </tbody>
	  </table>

	
		<br>

@foreach($ketqua as $key)
	<!-- Modal for display PDF file-->
<div  class="modal fade" id="{{ $key->sv_ma }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="myModalLabel">Quyển luận văn:</h4> 
      </div>
      <div class="modal-body" >
        <div style="text-align: center;">
        <?php $tenfile='luanvan_uploaded/LV_'.$key->sv_ma.'.pdf';
         ?>
<iframe src="{{ asset($tenfile) }}" 
style="width:500px; height:500px;" frameborder="0"></iframe>
</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>
<!--End modal-->
@endforeach

	</div>
</div>


@endsection