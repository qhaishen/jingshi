@extends('admin.base')

@section('content')
    <div class="layui-card">
        <div class="layui-card-header layuiadmin-card-header-auto">
            <h2>添加候选人</h2>
        </div>
        <div class="layui-card-body">
            <form class="layui-form" action="{{route('admin.resume.store')}}" method="post" style="width:50%;">
                @include('admin.resume._form')
            </form>
        </div>
    </div>
@endsection

