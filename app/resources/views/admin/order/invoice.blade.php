@extends("layouts.backend_master")

@section("title", "Admin Order Invoice")
@section("breadcrumb_title", "Order Invoice")
@section("breadcrumb_item", "Order Invoice")

@section("content")
<div class="row">
    <div class="d-none header">
        <div class="col-2 d-flex align-items-center">
            <div style="border: 1px solid #80808026;padding: 17px 0;">
                <img src="{{asset($profile->logo)}}" alt="{{ $profile->company_name }}" />
            </div>
        </div>
        <div class="col-10 text-left">
            <div class="ms-3">
                <h3 class="m-0">{{ $profile->company_name }}</h3>
                <p class="m-0">{{ $profile->mobile }}</p>
                <p class="m-0">{{ $profile->address }}</p>
            </div>
        </div>
    </div>
    <div class="col-12 text-end mb-2">
        <button onclick="print()" class="btn btn-sm btn-warning shadow-none"><i class="fas fa-print"></i> Print</button>
    </div>
    <div class="col-12 invoice">
        <invoice title="Order Invoice" invoice-data="{{$data->id}}"></invoice>
    </div>
</div>
@endsection

@push("js")
<script>
    async function print() {
        let printWindow = window.open("", "", `width=${window.screen.width}, height=${window.screen.height}`)

        printWindow.document.write(`
                <!DOCTYPE html>
                <html>
                    <body>
                        <div class="container">
                            <table style="width:100%;">
                                <tr>
                                    <td>
                                        <div class="row">
                                            ${document.querySelector(".header").innerHTML}
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        ${document.querySelector(".invoice").innerHTML}
                                    </td>
                                </tr>
                            </table>
                            <div class="row" style="margin-top:50px;">
                                <div class="col-6">
                                    <span style="text-decoration:overline;">Received by</span>
                                </div>
                                <div class="col-6 text-end">
                                    <span style="text-decoration:overline;">Authorized Signature</span>                                    
                                </div>
                            </div>
                        </div>
                    </body>
                </html>
            `)
        printWindow.document.head.appendChild(document.head);
        printWindow.focus();
        await new Promise((resolve) => setTimeout(resolve, 1000));
        printWindow.print();
        printWindow.close();
        location.reload()
    }
</script>
@endpush