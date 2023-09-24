@extends("layouts.backend_master")

@section("title", "Admin Order Canceled ")
@section("breadcrumb_title", "Canceled Orders")
@section("breadcrumb_item", "Canceled Order List")

@section("content")
    <cancel-order admin_id="{{Auth::guard('admin')->user()->id}}" role="{{Auth::guard('admin')->user()->role}}"></cancel-order>
@endsection