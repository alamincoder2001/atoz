@extends('layouts.backend_master')

@section('title', 'Create User')
@section('breadcrumb_title', 'Create User')
@section('breadcrumb_item', 'Create User')

@section('content')
<create-user admin_id="{{Auth::guard('admin')->user()->id}}"></create-user>
@endsection

@push("js")

<script>
    @if(Session::has('success'))
    toastr.success("{{Session::get('success')}}")
    @endif
    @if(Session::has('error'))
    toastr.error("{{Session::get('error')}}")
    @endif
</script>

@endpush