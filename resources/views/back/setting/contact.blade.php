@extends('back.layout')
@section('head-title')
    <a href="#">Setting</a>
    <a href="#">contact</a>
@endsection
@section('content')
    <div class="mt-3 p-3 shadow">
        <input class="form-control" type="text" id="map" value="{{$data->map??""}}" required placeholder="Enter location and press enter" onchange="setMap(this.value);" >
        <hr>
        <div class="row">
            <div class="col-12">
                <div style="overflow:hidden;resize:none;width:100%;height:300px;">
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

            <div class="col-12 mt-2">
                <button class="btn btn-primary" onclick="save()"> Save Setting</button>
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
