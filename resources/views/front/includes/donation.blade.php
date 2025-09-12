@php
    $donationSetting = getSetting('donation');
@endphp
@if (isset($donationSetting->title))
    <div class="modal fade" id="staticBackdrop" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="text-end d-block d-md-none" >
                            <div class="material-symbols-outlined"  data-bs-dismiss="modal" >
                                close
                            </div>
                        </div>
                        <div class="col-md-6 mb-3" >
                            <img  loading="lazy"  class="w-100" src="{{vasset($donationSetting->qr)}}" alt="">
                        </div>
                        <div class="col-md-6 mb-3 text-center" >
                            {!! $donationSetting->extra !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
