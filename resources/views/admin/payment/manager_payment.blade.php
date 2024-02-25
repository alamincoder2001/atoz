@extends("layouts.backend_master")

@section("title")
Manager Payment
@endsection
@section("breadcrumb_title", "Manager Payment")
@section("breadcrumb_item", "Manager Payment")

@section("content")
<manager-payment admin_id="{{Auth::guard('admin')->user()->id}}" role="{{Auth::guard('admin')->user()->role}}">
</manager-payment>
@endsection