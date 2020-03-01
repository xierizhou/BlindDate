@extends('admin.app')
@section('title', '应用列表')
@section('content')
    
    <body>
        {{--<div class="x-nav">
            <span class="layui-breadcrumb">
                <a href="">首页</a>
                <a><cite>应用列表</cite></a>
            </span>
            <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" onclick="location.reload()" title="刷新">
                <i class="layui-icon layui-icon-refresh" style="line-height:30px"></i>
            </a>
        </div>--}}
        <div class="layui-fluid">
            <div class="layui-row layui-col-space15">
                <div class="layui-col-md12">
                    <div class="layui-card">
                        <div class="layui-card-body ">
                            <form class="layui-form layui-col-space5">
                                {{--<div class="layui-input-inline layui-show-xs-block">
                                    <input class="layui-input" placeholder="开始日" name="start" id="start"></div>
                                <div class="layui-input-inline layui-show-xs-block">
                                    <input class="layui-input" placeholder="截止日" name="end" id="end"></div>

                                <div class="layui-input-inline layui-show-xs-block">
                                    <select name="contrller">
                                        <option value="">订单状态</option>
                                        <option value="0">待确认</option>
                                        <option value="1">已确认</option>
                                        <option value="2">已收货</option>
                                        <option value="3">已取消</option>
                                        <option value="4">已完成</option>
                                        <option value="5">已作废</option></select>
                                </div>--}}
                                {{--<div class="layui-input-inline layui-show-xs-block">
                                    <select name="state">
                                        <option value="">渠道状态</option>
                                        <option {{ request('state') == 1 ? "selected":"" }} value="1">正常</option>
                                        <option {{ request()->has('state')&&is_numeric(request('state'))&&request('state') == 0 ? "selected":"" }} value="0">禁用</option>
                                        <option {{ request('state') == 2 ? "selected":"" }} value="2">过期</option>
                                    </select>
                                </div>--}}
                                {{--<div class="layui-input-inline layui-show-xs-block">
                                    <input type="text" value="{{ request()->input('name') }}" name="name" placeholder="请输入应用名称名称" autocomplete="off" class="layui-input"></div>
                                <div class="layui-input-inline layui-show-xs-block">
                                    <button class="layui-btn" lay-submit="" lay-filter="sreach">
                                        <i class="layui-icon">&#xe615;</i></button>
                                </div>--}}
                            </form>
                        </div>
                        {{--<div class="layui-card-header">

                            <button class="layui-btn" onclick="xadmin.open('添加应用','{{ url('admin/app/create') }}',800,600)">
                                <i class="layui-icon"></i>添加</button>

                        </div>--}}
                        <div class="layui-card-body ">
                            <table class="layui-table layui-form">
                                <thead>
                                    <tr>
                                        <th>序号</th>
                                        <th>地区</th>
                                        <th>职业</th>
                                        <th>性别</th>
                                        <th>生日</th>
                                        <th>身高</th>
                                        <th>学历</th>
                                        <th>月收入</th>
                                        <th>有无婚史</th>
                                        <th>介绍</th>
                                        <th>理想中的Ta</th>
                                        <th>微信号</th>
                                        <th>提交时间</th>
                                        <th>操作</th></tr>
                                </thead>
                                <tbody>

                                @foreach($data as $kk=>$item)
                                    <tr>
                                        <td>{{ ++$kk }}</td>
                                        <td>{{ $item->province }}{{ $item->city }}{{ $item->area }}</td>
                                        <td>{{ $item->occupation }}</td>
                                        <td>{{ $item->sex==1?"男":"女" }}</td>
                                        <td>{{ $item->birthday }}</td>
                                        <td>{{ $item->height }}</td>
                                        <td>{{ $item->education }}</td>
                                        <td>{{ $item->monthly_income }}</td>
                                        <td>{{ $item->marriage_history==1?"有":"无" }}</td>
                                        <td>{{ $item->introduce }}</td>
                                        <td>{{ $item->ideal }}</td>
                                        <td>{{ $item->wechat }}</td>
                                        <td>{{ $item->created_at }}</td>
                                        <td class="td-manage">
                                            {{--<a title="下载" onclick="xadmin.open('编辑','{{ url('admin/channel/'.$item->id.'/edit') }}',800,600)" href="javascript:;"><i class="icon iconfont">&#xe714;</i></a>--}}
                                            <a title="查看" onclick="xadmin.open('编辑','{{ url('admin/channel/'.$item->id.'/edit') }}',800,600)" href="javascript:;"><i class="layui-icon">&#xe63c;</i></a>

                                            <a title="删除" onclick="member_del(this,'{{ $item->id }}')" href="javascript:;"><i class="layui-icon">&#xe640;</i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="layui-card-body ">
                            {{ $data->appends(['name'=>request('name'),'state'=>request('state')])->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script>layui.use(['laydate', 'form'],
        function() {
            var laydate = layui.laydate;

            //执行一个laydate实例
            laydate.render({
                elem: '#start' //指定元素
            });

            //执行一个laydate实例
            laydate.render({
                elem: '#end' //指定元素
            });
        });

        /*用户-停用*/
        function member_stop(obj, id) {
            layer.confirm('确认要停用吗？',
            function(index) {

                if ($(obj).attr('title') == '启用') {

                    //发异步把用户状态进行更改
                    $(obj).attr('title', '停用');
                    $(obj).find('i').html('&#xe62f;');

                    $(obj).parents("tr").find(".td-status").find('span').addClass('layui-btn-disabled').html('已停用');
                    layer.msg('已停用!', {
                        icon: 5,
                        time: 1000
                    });

                } else {
                    $(obj).attr('title', '启用');
                    $(obj).find('i').html('&#xe601;');

                    $(obj).parents("tr").find(".td-status").find('span').removeClass('layui-btn-disabled').html('已启用');
                    layer.msg('已启用!', {
                        icon: 5,
                        time: 1000
                    });
                }

            });
        }

        /*用户-删除*/
        function member_del(obj, id) {
            layer.confirm('确认要删除吗？',
            function(index) {
                //发异步删除数据
                $.ajax({
                    url:"{{ url('admin/channel') }}/"+id,
                    method:'post',
                    data:{"_method":"delete","_token":"{{ csrf_token() }}"},
                    dataType:'json',
                    success:function(data){
                        //$(obj).parents("tr").remove();
                        layer.msg(data.message, {
                            icon: 1,
                            time: 1000
                        });
                        location.reload();
                    },
                    error:function (data) {
                        layer.msg(data.message, {
                            icon: 5,
                            time: 1000
                        });

                    }
                })


            });
        }


    </script>
@endsection
