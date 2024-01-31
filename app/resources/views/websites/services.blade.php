@extends('layouts.fronted_master')
@section('title', ' - Services Page')

@push('front_style')
<style>
    #customScrol {
        zoom: 0.9;
        scroll-behavior: smooth;
    }

    .nav-pills .nav-link.active,
    .nav-pills .show>.nav-link {
        background-color: #ffffff;
        border-right: 5px solid #cf58f6;
        font-weight: 700;
    }

    /* service card */
    .single-listing-item .listing-image .listing-tag a {
        color: #b654f1;
    }

    .single-listing-item .listing-image .listing-tag:hover {
        background-color: #863ed2 !important;
    }

    .single-listing-item:hover .listing-image .listing-tag,
    .single-listing-item:focus .listing-image .listing-tag {
        background-color: #863ed2 !important;
    }
</style>
@endpush

@section('front_content')
<section class="listing-area pt-100">
    <div class="container">
        <div class="row">

            <div class="col-md-12" id="customScrol">

                <div data-bs-spy="scroll" data-bs-target="#service-all" data-bs-offset="50" tabindex="0">
                    @foreach ($categories as $cate)
                    @if(isset($cate->service) && count($cate->service) > 0)
                    <section class="listing-area" id="bestDeal">
                        <div class="container mt-5">
                            <div class="section-title mb-3" style="display: flex; justify-content: flex-start;">
                                <h3 style="font-weight: bold; color: #323334;">{{ $cate->name }}</h3>
                            </div>
                            <div class="row">

                                @foreach ($cate->service as $key => $service)
                                <div class="col-lg-4 col-sm-12 col-md-6">
                                    <div class="single-listing-item" style="box-shadow: 0 0 20px 1px #e760fb40;">

                                        <div class="listing-image">
                                            <a href="{{ url('service-single', $service->slug) }}" class="d-block">
                                                <img src="{{ asset($service->image) }}" style="width: 344px !important; height: 238px !important;" alt="image">
                                            </a>
                                            <div class="listing-tag">
                                                <a href="{{ url('service-single', $service->slug) }}" class="d-block">{{ $service->name }}</a>
                                            </div>
                                        </div>

                                        {{-- <span class="listing-discount">
                                                            <span>-15% OFF</span>
                                                        </span> --}}
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </section>
                    @endif
                    @endforeach


                    {{-- <section class="listing-area" id="acrepair">
                            <div class="container mt-5">
                                <div class="section-title mb-3" style="display: flex; justify-content: flex-start;">
                                    <h3 style="font-weight: bold; color: #323334;">AC Repair</h3>
                                </div>
                                <div class="row">
                                    @foreach ($services_trending as $key => $service)
                                        <div class="col-lg-4 col-sm-12 col-md-6">
                                            <div class="single-listing-item" style="box-shadow: 0 0 20px 1px #e760fb40;">

                                                <div class="listing-image">
                                                    <a href="{{ url('service-single', $service->slug) }}" class="d-block">
                    <img src="{{ asset($service->image) }}" style="width: 344px !important; height: 238px !important;" alt="image">
                    </a>
                    <div class="listing-tag">
                        <a href="{{ url('service-single', $service->slug) }}" class="d-block">{{ $service->name }}</a>
                    </div>
                </div> --}}

                {{-- <div class="listing-badge closed">Closed!</div> --}}
                {{-- <div class="listing-badge">Open!</div> --}}
                {{-- <span class="listing-discount">
                                                    <span>-15% OFF</span>
                                                </span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </section> --}}

                {{-- <section class="listing-area" id="applianceRepair">
                            <div class="container mt-5">
                                <div class="section-title mb-3" style="display: flex; justify-content: flex-start;">
                                    <h3 style="font-weight: bold; color: #323334;">Appliance Repair
                                    </h3>
                                </div>
                                <div class="row">
                                    @foreach ($services_trending as $key => $service)
                                        <div class="col-lg-4 col-sm-12 col-md-6">
                                            <div class="single-listing-item" style="box-shadow: 0 0 20px 1px #e760fb40;">

                                                <div class="listing-image">
                                                    <a href="{{ url('service-single', $service->slug) }}" class="d-block">
                <img src="{{ asset($service->image) }}" style="width: 344px !important; height: 238px !important;" alt="image">
                </a>
                <div class="listing-tag">
                    <a href="{{ url('service-single', $service->slug) }}" class="d-block">{{ $service->name }}</a>
                </div>
            </div> --}}

            {{-- <div class="listing-badge closed">Closed!</div> --}}
            {{-- <div class="listing-badge">Open!</div> --}}
            {{-- <span class="listing-discount">
                                                    <span>-15% OFF</span>
                                                </span> --}}
            {{-- </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </section> --}}

        </div>
    </div>
    </div>

    </div>
</section>
@endsection

@push('front_script')
<script>
    function serviceActive(data) {
        // $('.ser_faq_txt').removeClass('active');
        // $('.ser_review_txt').removeClass('active');
        // $('.ser_details_txt').removeClass('active');
        // $('.'+data).addClass('active');
    }
</script>
@endpush