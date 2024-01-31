
@extends("layouts.backend_master")

@section("title", "Admin Order Delivered")
@section("breadcrumb_title", "Delivered Orders")
@section("breadcrumb_item", "Delivered Order List")

@section("content")
    <delivered-order admin_id="{{Auth::guard('admin')->user()->id}}" role="{{Auth::guard('admin')->user()->role}}"></delivered-order>
@endsection