@extends('back.layout')
@section('head-title')
<a href="{{route('admin.notice.index',['type'=>4])}}">Teams</a>
<a href="#">{{$notice->title}}</a>
<a href="{{{route('admin.team.index',['notice'=>$notice->id])}}}">Members</a>
<a href="#">Add</a>

@endsection
@section('content')
    <div class="shadow mt-3 p-3">

        <form action="{{route('admin.team.add',['notice'=>$notice->id])}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">

                <div class="col-md-4 mb-2">
                    <label for="image">Mobile Image</label>
                    <input type="file" class="form-control dropify" name="image" id="image" required accept="image/*">
                </div>
                <div class="col-md-8 mb-2">
                    <div class="row">
                        <div class="mb-2 col-md-6">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-2 col-md-6">
                            <label for="desig">Designation</label>
                            <input type="text" class="form-control" id="desig" name="desig" required>
                        </div>
                        <div class="mb-2 col-md-6">
                            <label for="phone">Phone</label>
                            <input type="text" class="form-control" id="phone" name="phone" >
                        </div>
                        <div class="mb-2 col-md-6">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" id="email" name="email" >
                        </div>
                        <div class="mb-2 col-md-12">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" id="address" name="address" >
                        </div>

                        <div class="col-12 text-end">
                            <button class="btn btn-primary">
                                Save Member
                            </button>
                            <a href="{{route('admin.team.index',['notice'=>$notice->id])}}" class="btn btn-danger">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>


        </form>
    </div>
@endsection
