@extends("layouts.backend_master")

@section("title", "Admin Order")
@section("breadcrumb_title", "Pending Orders")
@section("breadcrumb_item", "Pending Order List")

@section("content")
    <Orderlist></Orderlist>
@endsection