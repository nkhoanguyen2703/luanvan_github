@extends('layouts.layoutGV')


@section('content')

<div class="panel panel-default">
<div class="panel-body">

        <h2>Ra kế hoạch luận văn</h2>
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

      <form class="form-horizontal" method="POST" action="{{ route('raKHLV') }}">
        {{ csrf_field() }}
        <div class="form-group">
          <label class="control-label col-sm-2" for="email">Tên kế hoạch:</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" placeholder="" name="txtTenkehoach">
          </div>
        </div>


        <div class="form-group">
        	
    			<label class="control-label col-sm-2">Năm học:</label>
    			<div class="col-sm-10" style="width:200px;">
    			  <select class="form-control" id="sel1" name="txtNamhoc">
              <option>2016-2017</option>
    			    <option>2017-2018</option>
    			    <option>2018-2019</option>
    			    <option>2019-2020</option>
    			  </select>
    	    	</div>
    	</div>

    	<div class="form-group">
        	
    			<label class="control-label col-sm-2">Học kỳ:</label>
    			<div class="col-sm-10" style="width:200px;">
    			  <select class="form-control" id="sel1" name="txtHocky">
    			    <option>1</option>
    			    <option>2</option>
    			     <option>3</option>
    			  </select>
    	    	</div>
    	</div>

        <div class="form-group">
          <label class="control-label col-sm-2">Ngày ra đề:</label>
          <div class="col-sm-10" style="width:200px">          
            <input type="date" class="form-control"  name="txtNgayrade">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-2">Hạn ra đề:</label>
          <div class="col-sm-10" style="width:200px">          
            <input type="date" class="form-control"   name="txtHanrade">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-2" >Ngày đăng ký:</label>
          <div class="col-sm-10" style="width:200px;">          
            <input type="date" class="form-control"   name="txtNgaydangky">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-2" >Hạn đăng ký</label>
          <div class="col-sm-10" style="width:200px;">          
            <input type="date" class="form-control"  name="txtHandangky">
          </div>
        </div>
        
        <div class="form-group">        
          <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">Thêm kế hoạch</button>
          </div>
        </div>
      </form>

</div>
</div>

@endsection