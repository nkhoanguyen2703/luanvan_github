


<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<div class="container">
<h2 style="text-align:center;">TRƯỜNG ĐẠI HỌC CẦN THƠ</h2><br>
<h3 style="text-align:center;">Danh sách sinh viên đăng ký thực hiện luận văn 

<?php if(!empty($listSV[0])){
	echo 'HK'.$listSV[0]->MaHocKy;
	echo '-'.$listSV[0]->MaNamHoc;
?>

<br><br>

<div style="text-align:left;margin-left: 30%;">
<h5>Kế hoạch: {{ $listSV[0]->kh_ten }}<br>
<h5>Tên giảng viên: {{ $listSV[0]->gv_ten }}<br>
<h5>Mã số giảng viên: {{ $listSV[0]->gv_ma }}<br>
</div><br>

<table class="table" style="margin-top: 70px;padding:10px; width:70%;margin:auto;">
	<tr>
		<td width="5%">STT</td>
		<td width="5%">Mssv</td>
		<td>Sinh viên</td>
		<td>Ngành</td>
		<td>Đề tài đăng ký</td>
	</tr>
	<?php $i=1; ?>
	@foreach($listSV as $sv)
	<tr>
		<td><?php echo $i; $i++; ?></td>
		<td>{{ $sv->getAuthIdentifier() }}</td>
		<td>{{ $sv->sv_ten }}</td>
		<td>{{ $sv->nganh_ten }}</td>
		<td>{{ $sv->dt_ten }}</td>

	</tr>
	@endforeach
</table>
        
<div style="text-align:right;margin-right: 30%;margin-top:50px;">
<h5>Giảng viên: {{ $listSV[0]->gv_ten }}<br>

</div><br>


<?php } ?>
</div>