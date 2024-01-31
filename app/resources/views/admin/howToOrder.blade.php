@extends("layouts.backend_master")

@section("title", "Admin How To Order Page")
@section("breadcrumb_title", "How To Order")
@section("breadcrumb_item", "Admin How To Order Page")

@section("content")
<!-- Column -->
<div class="col-md-1 col-lg-1"></div>
    <div class="col-md-10 col-lg-10">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="">
                    @csrf
                    <div class="row">
                        <div class="col-lg-12">
                            <h3 class="text-center m-0">How To Order</h3>
                        </div>
                        <div class="col-lg-6 col-md-6" style="border-right: 1px dashed #80808075;">
                            <div class="form-group">
                                <p style="margin: 0;">Name</p>
                                <div class="d-flex align-items-center gap-2" style="margin-bottom: 10px;">
                                    <input type="text" name="name" class="form-control shadow-none" value="{{ $howToOrder->name }}">
                                </div>
                                <span class="text-danger error error-navicon"></span>
                            </div>

                            <input type="hidden" name="id" value="{{ $howToOrder->id }}">
                            <div class="form-group">
                                <p style="margin: 0;">Video Background Thumbnail</p>
                                <div class="d-flex align-items-center gap-2" style="margin-bottom: 10px;">
                                    <img src="{{asset($howToOrder->thumbnail != null ? $howToOrder->thumbnail : 'noImage.jpg')}}" class="videoThumbnail" style="width: 60%;height: 40px;border: 1px solid #c1c1c1;margin-top: 5px;">
                                    <input type="file" name="thumbnail" autocomplete="off" class="form-control shadow-none" onchange="logoUpdate(event)">
                                </div>
                                <span class="text-danger error error-logo"></span>
                            </div>
                            <div class="form-group">
                                <p style="margin: 0;">Video Link</p>
                                <div class="d-flex align-items-center gap-2" style="margin-bottom: 10px;">
                                    <input type="text" name="video_link" class="form-control shadow-none" value="{{ $howToOrder->video_link }}">
                                </div>
                                <span class="text-danger error error-navicon"></span>
                            </div>

                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" name="title" id="title" value="{{$howToOrder->title}}" autocomplete="off" class="form-control shadow-none">
                                <span class="text-danger error error-company_name"></span>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="address">Short Description</label>
                                <textarea name="description" rows="3" class="form-control">{{$howToOrder->description}}</textarea>
                                <span class="text-danger error error-address"></span>
                            </div>

                            <div class="form-group">
                                <label for="title">Title Two</label>
                                <input type="text" name="title_two" id="title" value="{{$howToOrder->title_two}}" autocomplete="off" class="form-control shadow-none">
                                <span class="text-danger error error-company_name"></span>
                            </div>

                            <div class="form-group">
                                <label for="address">Short Description Two</label>
                                <textarea name="description_two" rows="3" class="form-control">{{$howToOrder->description_two}}</textarea>
                                <span class="text-danger error error-address"></span>
                            </div>

                            <div class="form-group">
                                <label for="title">Title Three</label>
                                <input type="text" name="title_three" id="title" value="{{$howToOrder->title_three}}" autocomplete="off" class="form-control shadow-none">
                                <span class="text-danger error error-company_name"></span>
                            </div>

                            <div class="form-group">
                                <label for="address">Short Description Three</label>
                                <textarea name="description_three" rows="3" class="form-control">{{$howToOrder->description_three}}</textarea>
                                <span class="text-danger error error-address"></span>
                            </div>

                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-primary btn-sm px-3 shadow-none">Update</button>
                            </div>

                        </div>

                    </div>
                </form>
        </div>
    </div>
<div class="col-md-1 col-lg-1"></div>
@endsection

@push('js')
<script>

</script>
@endpush
