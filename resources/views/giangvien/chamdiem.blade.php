@extends('layouts.layoutGV')


@section('content')




        <h2>Chấm điểm luận văn</h2>
        
        

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




  
      <ul class="list-group"> 
            <li class="list-group-item">
             <div class="panel-group">
                  <div class="panel panel-default">

                  
                  @foreach($listbomon as $bm)
                    <div class="panel-heading" style="border-bottom: 1px solid #DDDDDD;">
                      <h4 class="panel-title">
                        <span data-target="#{{$bm->get_bm_ma()  }}" data-toggle="collapse">
                          <a>{{ $bm->bm_ten }}</a>
                        </span>
                      </h4>
                    </div>
                  
                    <?php 
                      $tmp = $listSV->list_sinhvien($bm->get_bm_ma()); 
                     $stt=1;  
                    ?>

                    <div id="{{$bm->get_bm_ma() }}" class="panel-collapse collapse">
                      <ul class="list-group">
                        <li class="list-group-item">
                          <div class="table-responsive">          
                                <table class="table">
                                  <thead>
                                    <tr>
                                      <th width='2%'><b>STT</b></th>
                                      <th width='10%'><b>Mã SV  </b></th>
                                      <th><b>Tên SV  </b></th>
                                      <th><b>Ngành </b></th>
                                      <th><b>Tên đề tài </b></th>
                                      <th><b>Chủ nhiệm </b></th>
                                      <th><b>Tệp </b></th>
                                      <th width='20%'><b>Điểm </b></th>
                                      
                                    </tr>
                                  </thead>
                                  <tbody>

                                  @foreach($tmp as $sv)
                                    <tr>
                                      <td>{{ $stt }}</td>
                                      <td>{{ $sv->getAuthIdentifier() }}</td>
                                      <td>{{ $sv->sv_ten }}</td>
                                      <td>{{$sv->nganh_ten}}</td>
                                      <td>{{ $sv->dt_ten }}</td>
                                      <td>{{ $sv->gv_ten }}</td>
                                      <td>
                                      <a data-toggle="modal" data-target="#{{ $sv->getAuthIdentifier() }}"  href="" target="_blank"><span class="glyphicon glyphicon-file"></span></a>
                                      </td>
                                      <td>
                                          <div class="input-group">

                                            <form method="POST" action="{{route('chamdiem')}}">
                                              <div class='input-group'>
                                              {{ csrf_field() }}

                                              <?php
                                              // $dc = $diemcu->laydiemcu( $sv->lv_ma );
                                              // if(empty($dc->diem)){
                                              //   $diemcu='';
                                              // }else{
                                              //   $diemcu=$dc->diem;
                                              // }
                                              ?>

                                             <input type="hidden" name="maluanvan" value="{{$sv->lv_ma}}"> 
                                              <input id="msg" type="number" max='10' min='0' class="form-control" name="diem" placeholder="">
                                              <div class="input-group-btn">
                                                <button class="btn btn-default" type="submit">
                                                   <i class="glyphicon glyphicon-upload"></i> 
                                                </button>
                                              </div>
                                              </div>
                                            </form>

                                          </div>
                                      </td>
                                      
                                    </tr>
                                    <?php $stt+=1; ?>  


                                    <!-- Modal for display PDF file-->
                                    <div  class="modal fade" id="{{ $sv->getAuthIdentifier() }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                      <div class="modal-dialog">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            <h4 class="modal-title" id="myModalLabel">Quyển luận văn: {{$sv->sv_ten}} - {{$sv->getAuthIdentifier()}}</h4> 
                                          </div>
                                          <div class="modal-body" >
                                            <div style="text-align: center;">
                                            <?php $tenfile='luanvan_uploaded/LV_'.$sv->getAuthIdentifier().'.pdf';
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

                                  </tbody>
                                </table>
                          </div>
                        </li>
                      </ul>
                    </div>

                  @endforeach
                    
                  

                   

                  </div>
            </div>
            </li>

      </ul>
    





@endsection