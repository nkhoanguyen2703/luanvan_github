@extends('layouts.layoutGV')


@section('content')

<div class="panel panel-default">
<div class="panel-body">


        <h2>Ra đề tài luận văn</h2>
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

      <form class="form-horizontal" method="POST" action="{{ route('raDetai') }}">
        {{ csrf_field() }}

        <div class="form-group">
    	  <label class="control-label col-sm-2" >Kế hoạch LV:</label>
    	  <div class="col-sm-10">
    	  <select class="form-control" name='slKehoach'>
        <option value='xxx'>Chọn kế hoạch luận văn</option>
        

          @foreach ($kehoach as $kh)
            <option value='{{ $kh->kh_id }}'>
            {{ $kh->kh_ten }}
            <i><b>{{date('d/m/y',strtotime($kh->kh_ngayrade))}} - {{date('d/m/y',strtotime($kh->kh_hanrade))}}</b></i>
            </option>
          @endforeach

    	    
    	   
      	</select>
      	</div>
    	</div>

        <div class="form-group">
          <label class="control-label col-sm-2" >Tên đề tài:</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" placeholder="" name="txtTendetai">
          </div>
        </div>

        <div class="form-group">
    	   <label for="comment" class="control-label col-sm-2">Nội dung đề tài:</label>
          <div class="col-sm-10">
      	  <textarea name='txtNoidung' class="form-control"   rows="5" id="comment"></textarea>
          </div>
    	 </div>

        
        
        <div class="form-group">        
          <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">Thêm đề tài</button>
          </div>
        </div>
      </form>

</div>
</div>
@endsection