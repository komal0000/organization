@extends('back.layout')
@section('head-title')
    <a href="#">Settings</a>
    <a href="#">Contact</a>
@endsection
@section('content')
<div class="admin-card">
    <div class="admin-card-header">
        <i class="fas fa-map-marker-alt me-2"></i>Contact Location Settings
    </div>
    <div class="admin-card-body">
        <div class="mb-3">
            <label for="map" class="admin-form-label">
                <i class="fas fa-search-location me-1"></i>Location Search
            </label>
            <input class="form-control admin-form-control" type="text" id="map" value="{{$data->map??""}}" required placeholder="Enter location and press enter to set map" onchange="setMap(this.value);">
        </div>

        <div class="mb-3">
            <label class="admin-form-label">
                <i class="fas fa-map me-1"></i>Map Preview
            </label>
            <div style="overflow:hidden;resize:none;width:100%;height:300px;border:1px solid var(--org-border-light);border-radius:5px;">
                <div id="embed-map-display" style="height:100%; width:100%;max-width:100%;">
                    <iframe id="mapiframe"
                        style="height:100%;width:100%;border:0;" frameborder="0"
                        src="">
                    </iframe>
                </div>
                <style>
                    #embed-map-display img {
                        max-height: none;
                        max-width: none !important;
                        background: none !important;
                    }
                </style>
            </div>
        </div>

        <div class="d-flex gap-2">
            <button class="btn btn-admin-primary" onclick="save()">
                <i class="fas fa-save me-2"></i>Save Location
            </button>
        </div>
    </div>
</div>
        {{-- <hr>
        <h5>
            Contact Personals
        </h5>
        <div id="othercontact">
            <div class="row">
                <div class="col-md-3">
                    <label for="name">Name</label>
                    <input type="text"  id="name" id="name" class="form-control">
                </div>
                <div class="col-md-3">
                    <label for="designation">Designation</label>
                    <input type="text"  id="designation" id="designation" class="form-control">
                </div>
                <div class="col-md-3">
                    <label for="phone">Phone</label>
                    <input type="text"  id="phone" id="phone" class="form-control">
                </div>
                <div class="col-md-3">
                    <label for="email">Email</label>
                    <input type="text"  id="email" id="email" class="form-control">
                </div>
            </div>
        </div> --}}
    </div>
@endsection
@section('js')

    <script>
        var map= "{{$data->map??""}}";
        var otherContacts={!! json_encode( $data->otherCOntacts??[]) !!};
        function  setMap(name) {
            $('#mapiframe').attr('src',`https://maps.google.com/maps?q=${name}&t=&z=13&ie=UTF8&iwloc=&output=embed`)
        }

        $(document).ready(function () {
            if(map!=""){
                setMap(map);
            }
            initOtherContact();
        });

        function save(){
            const map=$('#map').val();
            if(map.length==0){
                alert('Please enter location');
                return;
            }

            axios.post("{{route('admin.setting.contact')}}",{map})
            .then((res)=>{
                alert('Map added successfully');
            })

        }



        var maxID=0;
        function initOtherContact(){
            otherContacts.forEach(otherContact => {
                if(otherContact.id>maxID){
                    maxID=otherContact.id;
                }
            });
            maxID+=1;


        }
    </script>
@endsection
