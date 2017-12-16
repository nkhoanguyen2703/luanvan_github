@extends('layouts.layoutSV')


@section('content')

<div class="panel panel-default">
    <div class="panel-body">

          <div style="padding-left: 35px;">
          <h2>Đề xuất đề tài luận văn</h2>
          <h6>Lưu ý: Sinh viên xem kỹ ngày ra đề tài và tên kế hoạch thuộc bộ môn của mình</h6>
          </div>
          <hr>
      <br>
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

      <form class="form-horizontal" method="POST" action="{{ route('dexuat') }}">
        {{ csrf_field() }}



        <div class="form-group">
        <div class="row">
        	  <label class="control-label col-sm-2"  >Kế hoạch:</label>
        	  <div class="col-sm-9">
            	  <select class="form-control " name='slKehoach'>
                  <option value='xxxxx123123'>Chọn kế hoạch luận văn</option>
                  @foreach ($kehoach as $kh)
                    <option value='{{ $kh->kh_id }}'>
                    {{ $kh->kh_ten }}
                    <i>{{date('d/m/y',strtotime($kh->kh_ngayrade))}} - {{date('d/m/y',strtotime($kh->kh_hanrade))}}</i>
                    </option>
                  @endforeach  
              	</select>
          	</div>
        </div>
    	  </div>



        <div class="form-group">
        <div class="row">
          <label class="control-label col-sm-2" >Tên đề tài:</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" placeholder="" required name="txtTendetai">
          </div>
        </div>
        </div>

        <div class="form-group">
        <div class="row">
      	  <label class="control-label col-sm-2" for="comment">Nội dung:</label>
          <div class="col-sm-9">
      	  <textarea name='txtNoidung' class="form-control" rows="5" id="comment" required placeholder="Đề nghị sinh viên trình bày cụ thể nội dung sẽ thực hiện trong đề tài được đề xuất."></textarea>
          </div>
        </div>
    	  </div>

        
        
        <div class="form-group">        
          <div class="col-sm-12" style="text-align:center;">
            <button type="submit" style="width:300px;" class="btn btn-default">Đề xuất đề tài </button>
          </div>
        </div>
      </form>

    </div>

</div>

@endsection