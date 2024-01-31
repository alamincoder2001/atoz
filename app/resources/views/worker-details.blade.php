@extends("layouts.fronted_master")
@section("title", " - Worker Details")
@section("content")
<nav class="breadcrumb-section section-py bg-light2">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3 class="bread-crumb-title">Worker Details</h3>
            </div>
        </div>
    </div>
</nav>
<section class="bg-light" style="padding-bottom: 25px;">
    <div class="container">
        <div class="main-body">
            <hr style="margin:0px 0px 10px 0;">
            <div class="row gutters-sm">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-column align-items-center text-center">
                                <img src="{{asset($worker->image != null ? $worker->image: 'nouser.png')}}" alt="{{$worker->name}}" class="rounded-circle" style="width: 150px;height:130px;">
                                <div class="mt-3">
                                    <h4>{{$worker->name}}</h4>
                                    <p class="text-secondary mb-1">{{$worker->worker_code}}</p>
                                    <p class="font-size-sm">{{$worker->thana->name}}, {{$worker->thana->district->name}}</p>
                                    <!-- <button class="btn btn-primary">Follow</button>
                                    <button class="btn btn-outline-primary">Message</button> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card mb-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Full Name</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{$worker->name}}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Mobile</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{$worker->mobile}}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Address</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{$worker->address}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push("webjs")
<script>
    function Rating(event, id) {
        $.ajax({
            url: location.origin + "/customer-rating",
            method: 'POST',
            data: {
                id: id,
                rating: event.target.value
            },
            success: res => {
                if (res.error) {
                    $.notify(res.error, "error")
                    setTimeout(() => {
                        location.href = "/login"
                    }, 500)
                } else {
                    $.notify(res, "success")
                    setTimeout(() => {
                        location.reload()
                    }, 500)
                }
            }
        })
    }
</script>
@endpush