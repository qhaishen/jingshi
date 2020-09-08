{{csrf_field()}}


<div class="layui-form-item">
    <label for="" class="layui-form-label">轮播图</label>
    <div class="layui-input-block">
        <div class="layui-upload">
            <button type="button" class="layui-btn" id="uploadPic"><i class="layui-icon">&#xe67c;</i>图片上传</button>
            <div class="layui-upload-list" >
                <ul id="layui-upload-box" class="layui-clear">
                    @if(isset($advert->thumb))
                        <li><img src="{{ $advert->thumb }}" /><p>上传成功</p></li>
                    @endif
                </ul>
                <input type="hidden" name="thumb" id="thumb" value="{{ $advert->thumb??'' }}">
            </div>
        </div>
    </div>
</div>
<div class="layui-form-item">
    <label for="" class="layui-form-label">排序</label>
    <div class="layui-input-inline">
        <input type="text" name="sort" value="{{ $advert->sort ?? 0 }}" lay-verify="required|number" placeholder="请输入数字" class="layui-input" >
    </div>
</div>

<div class="layui-form-item">
    <div class="layui-input-block">
        <button type="submit" class="layui-btn" lay-submit="" lay-filter="formDemo">确 认</button>
        <a  class="layui-btn" href="{{route('admin.advert')}}" >返 回</a>
    </div>
</div>