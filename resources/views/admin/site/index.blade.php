@extends('admin.base')

@section('content')
    <div class="layui-card">
        <div class="layui-card-header layuiadmin-card-header-auto">
            <h2>基本信息</h2>
        </div>
        <div class="layui-card-body">
            <form class="layui-form" action="{{route('admin.site.update')}}" method="post" style="width:60%">
                {{csrf_field()}}
                {{method_field('put')}}
                 <div class="layui-form-item">
                    <label for="" class="layui-form-label">公司名称</label>
                    <div class="layui-input-block">
                        <input type="text" name="company" value="{{ $config['company']??'' }}" lay-verify="required" placeholder="请输入企业名称" class="layui-input" >
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="" class="layui-form-label">宣传照片</label>
                    <div class="layui-input-block">
                        <div class="layui-upload">
                            <button type="button" class="layui-btn" id="uploadPic"><i class="layui-icon">&#xe67c;</i>图片上传</button>
                            <div class="layui-upload-list" >
                                <ul id="layui-upload-box" class="layui-clear">
                                    @if(isset($config['avatar']))
                                        <li><img src="{{ $config['avatar'] }}" /><p>上传成功</p></li>
                                    @endif
                                </ul>
                                <input type="hidden" name="avatar" id="thumb" value="{{ $config['avatar']??'' }}">
                            </div>
                        </div>
                    </div>
                </div>
                
                @include('UEditor::head');
                <div class="layui-form-item">
                    <label for="" class="layui-form-label">团队介绍</label>
                    <div class="layui-input-block">
                        <script id="container" name="description" style="min-height:300px;" type="text/plain">
                            {!! $config['description']??'' !!}
                        </script>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="" class="layui-form-label">视频上传</label>
                    <div class="layui-input-block">
                        <div class="layui-upload">
                            <button type="button" class="layui-btn" id="uploadMp4"><i class="layui-icon">&#xe67c;</i>视频上传</button>
                            <div class="layui-upload-list" >
                                <ul id="layui-upload-boxTwo" class="layui-clear">
                                    @if(isset($config['video']))
                                        <li ><video style="width:200px;height:150px;" src="{{ $config['video']??'' }}" controls="controls">
                                            </video></li>
                                    @endif
                                </ul>
                                <input type="hidden" name="video" id="thumbTwo" value="{{ $config['video']??'' }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="" class="layui-form-label">视频介绍</label>
                    <div class="layui-input-block">
                        <textarea class="layui-textarea" name="videoDesc" cols="30" rows="10">{{ $config['videoDesc']??'' }}</textarea>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="" class="layui-form-label">公司地址</label>
                    <div class="layui-input-block">
                        <input type="text" name="address" value="{{ $config['address']??'' }}" lay-verify="required" placeholder="请输入公司地址" class="layui-input" >
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="" class="layui-form-label">400电话</label>
                    <div class="layui-input-block">
                        <input type="text" name="phone" value="{{ $config['phone']??'' }}" lay-verify="required" placeholder="请输入电话" class="layui-input" >
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="" class="layui-form-label">客服链接</label>
                    <div class="layui-input-block">
                        <input type="text" name="link" value="{{ $config['link']??'' }}" lay-verify="required" placeholder="请输入第三方客服电话" class="layui-input" >
                    </div>
                </div>
                <div class="layui-form-item">
                    <div class="layui-input-block">
                        <button type="submit" class="layui-btn" lay-submit="" lay-filter="formDemo">确 认</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    @include('admin.team._js')
@endsection