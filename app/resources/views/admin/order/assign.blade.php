@extends("layouts.backend_master")

@section("title")
Assign order 
@endsection
@section("breadcrumb_title", "Assign Order")
@section("breadcrumb_item", "Assign Order")

@section("content")
    <order-assign admin_id="{{Auth::guard('admin')->user()->id}}" role="{{Auth::guard('admin')->user()->role}}"></order-assign>
@endsection