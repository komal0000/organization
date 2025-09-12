@php
    $generalSetting = getSetting('general');
    $contactSetting = getSetting('contact');
@endphp

<div id="contact-page" class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="map shadow">
                    <iframe id="mapiframe"
                    style="height:100%;width:100%;border:0;" frameborder="0"
                    src="https://maps.google.com/maps?q={{$contactSetting->map??""}}&t=&z=13&ie=UTF8&iwloc=&output=embed">
                </iframe>
                </div>

            </div>
            <div class="col-md-6">
                <div class="shadow info">
                    @if (isset($generalSetting->phone))
                    <a href="tel:{{ $generalSetting->phone }}" class="top-link">
                        <div>
                            <span class=" top-icon material-symbols-outlined">wifi_calling_3</span>
                        </div>
                        <div>
                            <div class="top-title">Call Us</div>
                            <div class="top-info">
                                {{ $generalSetting->phone }}
                            </div>
                        </div>
                    </a>
                    <a href="mailto:{{ $generalSetting->email }}" class="top-link">
                        <div>
                            <span class=" top-icon material-symbols-outlined">mail</span>
                        </div>
                        <div>
                            <div class="top-title">Send Mail</div>
                            <div class="top-info">
                                {{ $generalSetting->email }}
                            </div>
                        </div>
                    </a>

                    <a class="top-link">
                        <div>
                            <span class=" top-icon material-symbols-outlined">location_on</span>
                        </div>
                        <div>
                            <div class="top-title">{{$generalSetting->address}}</div>
                            <div class="top-info">
                                {{$generalSetting->district}} , {{$generalSetting->state}}, {{$generalSetting->country}}
                            </div>
                        </div>
                    </a>
                @endif
                </div>
            </div>
        </div>
    </div>
</div>
