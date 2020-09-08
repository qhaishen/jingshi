@extends('admin.base')

@section('content')
    <div class="layui-card">
        <div class="layui-card-header layuiadmin-card-header-auto">
            <h2>添加成员</h2>
        </div>
        <div class="layui-card-body">
            <form class="layui-form" action="{{route('admin.test.store')}}" method="post" style="width:50%;">
                @include('admin.test._form')
            </form>
        </div>
    </div>
@endsection

@section('script')
    @include('admin.test._js')
@endsection
