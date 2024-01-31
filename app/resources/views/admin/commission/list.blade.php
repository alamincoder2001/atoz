@extends("layouts.backend_master")

@section("title")
Commission List 
@endsection
@section("breadcrumb_title", "Commission List")
@section("breadcrumb_item", "Commission List")

@section("content")
    <commission-list admin_id="{{Auth::guard('admin')->user()->id}}" role="{{Auth::guard('admin')->user()->role}}"></commission-list>
@endsection