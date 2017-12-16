<?php
    $path = public_path();
?>
@extends('layouts.layoutSV')

@section('content')
            
        
            <div class="panel panel-default">
                <div class="panel-body">
                
                <?php
                if(isset($thongtindetai_dexuat) && count($thongtindetai_dexuat) > 0){
                    ?>
                        <h2>Đề tài đề xuất</h2><hr>
                        <div class="well well-lg">
                        <b>Tên đề tài đề xuất:</b>
                        {{$thongtindetai_dexuat->dt_ten}}<br>
                        <b>Nội dung đề xuất:</b>
                        {{$thongtindetai_dexuat->dt_noidung}}<br>
                        
                        <b>Trạng thái đề xuất</b>
                            
                            <span style='color:#ed2f42';>Đang chờ duyệt</span>
                        
                        
                        </div>
                    <?php
                }else
                // if(isset($thongtindetai) && $thongtindetai!=null){
                if(count($thongtindetai) > 0){
                    ?>
                    <h2>Đề tài đang thực hiện</h2><hr>
                    <div class="well well-lg">
                    <b>Tên đề tài:</b>
                    {{$thongtindetai->dt_ten}}<br>
                    <b>Nội dung đề tài:</b>
                    {{$thongtindetai->dt_noidung}}<br>
                    <b>Chủ nhiệm đề tài:</b>
                    <i>{{$thongtindetai->gv_ten}}</i><br>
                    <b>Trạng thái đề tài:</b>
                    <?php
                    if($thongtindetai->kq==1){
                        echo "<span style='color:#6edb20';>Đã duyệt</span>";
                    }else{
                        echo "<span style='color:#ed2f42';>Đang chờ duyệt...</span>";
                    }
                    ?>
                    </div>
                    <?php
                }else{
                    echo "Chưa đăng ký đề tài";
                }
                ?>
                
                    
                </div>
            </div>
       

@endsection
