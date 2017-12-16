@extends('layouts.layoutGV')


@section('content')
<style>
	#topic_tb{
		font-weight: 200; 
		vertical-align: middle; 
		font-size:11px;
		color: red;
	}
</style>

	<div class="panel panel-default">
    <div class="panel-body">

			<h2>Quản lý sinh viên</h2>
			<small>Danh sách sinh viên đăng ký đề tài thuộc quyền chủ nhiệm</small>
			<hr>	
				
			@if (session('alert_ok'))
		    <div class="alert alert-success alert-dismissable fade in">
		    	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		        {{ session('alert_ok') }}
		    </div>
		    @endif
		    @if (session('alert_not'))
		    <div class="alert alert-danger alert-dismissable fade in">
		    	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		        {{ session('alert_not') }}
		    </div>
		    @endif	
			



			<?php
				$count='1';
			?>
			@foreach($listdetai as $tt)
			<span data-toggle="collapse" data-target="#{{$tt->dt_ma}}">
				<h4>
					<a><?=$count?>. {{ $tt->dt_ten }}</a>
					<span style="font-size:15px;"> 
					<?php 
						if( $tt->svdexuat  !=null){
							?>
							(Được đề xuất)
							<a href="" data-toggle="modal" data-target="#chitiet{{$tt->dt_ma}}"><i><small>Xem chi tiết đề xuất</small></i></a>


							<!-- Modal -->
							  <div class="modal fade" id="chitiet{{$tt->dt_ma}}" role="dialog">
							    <div class="modal-dialog">
							    
							      <!-- Modal content-->
							      <div class="modal-content">
							        <div class="modal-header">
							          <button type="button" class="close" data-dismiss="modal">&times;</button>
							          <h4 class="modal-title">Chi tiết đề tài</h4>
							        </div>
							        <div class="modal-body">
							          <p>{{ $tt->dt_noidung }}</p>
							        </div>
							        <div class="modal-footer">
							          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							        </div>
							      </div>
							      
							    </div>
							  </div>


							<?php
						}
					?>
					
					</span>
				</h4>
			</span>

			<?php 
				$tmp = $thongtindk->get_thongtin_dangky($tt->dt_ma); 
				$count=$count+1;

			?>
			

			<div id="{{$tt->dt_ma}}" class="collapse">
			    <div class="table-responsive">          
					  <table class="table table-hover">
					    <thead>
					      <tr>
					        <th>Mã số sinh viên</th>
					        <th>Họ và tên</th>
					        <th>Ngành</th>
					        <th>Khoá</th>
					        <th></th>
					      </tr>
					    </thead>
					    <tbody>
					    @foreach($tmp as $sv)
					      <tr class="active">
					        <td>{{ $sv->sv_ma }}</td>
					        <td>{{ $sv->sv_ten }}</td>
					        <td>{{ $sv->manganh }}</td>
					        <td>{{ $sv->sv_khoahoc }}</td>
					        <?php
					        	if($sv->kq==0 && $tt->svdexuat==null){
					        ?>
					        <td>
					        	<a href="{{ Route('duyetsv',[ $sv->sv_ma ]) }}">Duyệt</a>&nbsp;
					        	<a style="color:red;" href="{{ Route('tuchoi_sv',[ $sv->sv_ma ]) }}">Từ chối</a>
					        	<!--de tai binh thuong-->
					        </td>
					        <?php
					    	}else if($sv->kq==0 && $tt->svdexuat!=null){ // de xuat
					        ?>
					        <td>
					        <a href="{{ Route('duyetsv_dexuat',$bien=array('mssv'=>$sv->sv_ma,'madt'=>$tt->dt_ma)) }}">Duyệt</a>&nbsp;
					        <a style="color:red;" href="{{ Route('tuchoi_sv_dexuat',$bien=array('mssv'=>$sv->sv_ma,'madt'=>$tt->dt_ma)) }}">Từ chối</a>
					        </td>

					        <!--de tai do sinh vien de xuat-->
					        <?php
					    	}else{
					    	?>
					    		<td><span color='green '><i>Đã duyệt </i></span></td>
					    	<?php
					    	}
					        ?>
					      </tr>
					    @endforeach
					     
					      
					    </tbody>
					  </table>
				 </div>
			</div>

			@endforeach
			<!-------------------------------------------------------------------------------->
			<!--------------------------------2------------------------------------------------>
			<!-------------------------------------------------------------------------------->

			<?php
				//$count='1'; 

			?>
			@foreach($listdetaidx as $dx)
			<span data-toggle="collapse" data-target="#dx{{$dx->dt_ma}}">
				<h4>
					<a><?=$count?>. {{ $dx->dt_ten }}  </a>
					<span style="font-size:15px;"> 
					<?php 
						if( $dx->svdexuat  !=null){
							?>
							(Được đề xuất)
							<a href="" data-toggle="modal" data-target="#chitiet{{$tt->dt_ma}}"><i><small>Xem chi tiết đề xuất</small></i></a>


							<!-- Modal -->
							  <div class="modal fade" id="chitiet{{$tt->dt_ma}}" role="dialog">
							    <div class="modal-dialog">
							    
							      <!-- Modal content-->
							      <div class="modal-content">
							        <div class="modal-header">
							          <button type="button" class="close" data-dismiss="modal">&times;</button>
							          <h4 class="modal-title">Chi tiết đề tài</h4>
							        </div>
							        <div class="modal-body">
							          <p>{{ $dx->dt_noidung }}</p>
							        </div>
							        <div class="modal-footer">
							          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							        </div>
							      </div>
							      
							    </div>
							  </div>


							<?php
						}
					?>
					
					</span>
				</h4>
			</span>

			<?php 
				$tmp2 = $thongtindk->get_thongtin_dangky($dx->dt_ma); 
				$count=$count+1;
				
			?>
			

			<div id="dx{{$dx->dt_ma}}" class="collapse">
			    <div class="table-responsive">          
					  <table class="table table-hover">
					    <thead>
					      <tr>
					        <th>Mã số sinh viên</th>
					        <th>Họ và tên</th>
					        <th>Ngành</th>
					        <th>Khoá</th>
					        <th></th>
					      </tr>
					    </thead>
					    <tbody>
					    @foreach($tmp2 as $svdx)
					      <tr class="active">
					        <td>{{ $svdx->sv_ma }}</td>
					        <td>{{ $svdx->sv_ten }}</td>
					        <td>{{ $svdx->manganh }}</td>
					        <td>{{ $svdx->sv_khoahoc }}</td>
					        <?php
					    	if($svdx->kq==0){ // de xuat
					        ?>
					        <td>
					        <a href="{{ Route('duyetsv_dexuat',$bien=array('mssv'=>$svdx->sv_ma,'madt'=>$dx->dt_ma)) }}">Duyệt</a>&nbsp;
					        <a style="color:red;" href="{{ Route('tuchoi_sv_dexuat',$bien=array('mssv'=>$svdx->sv_ma,'madt'=>$dx->dt_ma)) }}">Từ chối</a>
					        </td>

					        <!--de tai do sinh vien de xuat-->
					        <?php
					    	}else{
					    	?>
					    		<td><span color='green '><i>Đã duyệt </i></span></td>
					    	<?php
					    	}
					        ?>
					      </tr>
					    @endforeach
					     
					      
					    </tbody>
					  </table>
				 </div>
			</div>

			@endforeach
			<!-------------------------------------------------------------------------------->
			<!-------------------------------------------------------------------------------->
	
	</div> 
	</div>		<!-- panel -->
	  
	 
	<!-- <div class="panel panel-default">
    <div class="panel-body">
    	<h2>Danh sách đề tài được đề xuất</h2>
			<small>Danh sách các đề tài thuộc quyền chủ nhiệm</small>
    </div>
    </div>   -->

@endsection