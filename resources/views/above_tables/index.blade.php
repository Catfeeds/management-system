@extends('layouts.app')

@section('content')

<div class="page-content">
                <!-- Page Breadcrumb -->
                <div class="page-breadcrumbs">
                    <ul class="breadcrumb">
                                        <li>
                        <a href="{{route('index')}}">系统</a>
                    </li>
                                        <li class="active">上门登记</li>
                                        </ul>
                </div>
                <!-- /Page Breadcrumb -->

                <!-- Page Body -->
                <div class="page-body">
                    
{{-- <button type="button" tooltip="添加登记" class="btn btn-sm btn-azure btn-addon" onClick="javascript:window.location.href = '{{route('register_tables.create')}}'"> <i class="fa fa-plus"></i> 添加登记
</button> --}}
<button type="button" tooltip="数据筛选" class="btn btn-sm btn-azure btn-addon"  data-toggle="modal" data-target="#exampleModal"> <i class="fa fa-plus"></i> 数据筛选
</button>
<div class="row">
    <div class="col-lg-12 col-sm-12 col-xs-12">
        <div class="widget">
            <div class="widget-body">
                <div class="flip-scroll">
                    <table class="table table-bordered table-hover">
                        <thead class="">
                            <tr>
                                
                                <th class="text-center">编号</th>
                                <th class="text-center">姓名</th>
                                <th class="text-center">来电时间</th>
                                <th class="text-center">联系电话</th>
                                <th class="text-center">家庭住址</th>
                                <th class="text-center">是否完成</th>
                                <th class="text-center" width="15%">操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($above_tables as $above_table)
                            <tr>
                                <td align="center">{{$above_table->number}}</td>
                                <td align="center">{{$above_table->name}}</td>
                                <td align="center">{{$above_table->call_time}}</td>
                                <td align="center">{{$above_table->phone}}</td>
                                <td align="center">{{$above_table->address}}</td>
                                <td align="center">
                                    
                                        <label>
                                            <input class="checkbox-slider slider-icon colored-blue" type="checkbox" @if($above_table->is_finish==1)checked=""@endif onclick="is_finish('{{$above_table->id}}')" id="checkbox_{{$above_table->id}}">
                                            <span class="text"></span>
                                        </label>
                                   
                                </td>

                                <td align="center">
                                    <a class="btn btn-xs btn-primary" href="{{ route('above_tables.show', $above_table->id) }}">
                                        <i class="glyphicon glyphicon-eye-open"></i> 
                                    </a>
                                    
                                    <a class="btn btn-xs btn-warning" href="{{ route('above_tables.edit', $above_table->id) }}">
                                        <i class="glyphicon glyphicon-edit"></i> 
                                    </a>
                                    @can('del_info')
                                    <form action="{{ route('above_tables.destroy', $above_table->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('是否删除该数据?');">
                                        {{csrf_field()}}
                                        <input type="hidden" name="_method" value="DELETE">

                                        <button type="submit" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> </button>
                                    </form>
                                     @endcan
                                </td>
                                
                                
                                
                            </tr>
                            @endforeach           
                        </tbody>
                    </table>
                    <div style="margin-top: 20px;">
                        {!! $above_tables->appends($select)->render() !!}
                    </div>
                    
                </div>
                <div>
                                    </div>
            </div>
        </div>
    </div>
</div>

                </div>
                <!-- /Page Body -->
            </div>
@include('above_tables._select')
<!--Page Related Scripts-->
@endsection
@section('afterJavaScript')
    <script type="text/javascript">
    
        //完成访问登记
        function is_finish(id){
            var is_finish=0;
            if($('#checkbox_'+id).prop('checked')){
                is_finish=1;
            }
            console.log(is_finish);
            $.ajax({
                type:"PUT",
                url:"{{route('above_tables.finished')}}",
                headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data:{
                    id:id,
                    is_finish:is_finish
                },
                success:function(res){
                    if(res.status){
                        window.location.reload();
                    }
                }
            })
           
        }
    </script>
@endsection



