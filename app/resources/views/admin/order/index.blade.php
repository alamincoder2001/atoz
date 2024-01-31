@extends("layouts.backend_master")

@section("title", "Admin Order List")
@section("breadcrumb_title", "Orders List")
@section("breadcrumb_item", "Order List")

@section("content")
    <Orderlist admin_id="{{Auth::guard('admin')->user()->id}}" role="{{Auth::guard('admin')->user()->role}}"></Orderlist>
@endsection

