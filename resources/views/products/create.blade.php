@extends('layouts.master')
@section('header')
    <strong>Create Product</strong>
@endsection
@section('content')
<form action="{{route('product.store')}}" method="POST" enctype="multipart/form-data">
    <div class="card card-gray">
        <div class="toolbox">
            <button class="btn btn-primary btn-sm btn-oval">
                <i class="fa fa-save"></i> Save
            </button>
            <a href="{{url('product')}}" class="btn btn-warning btn-sm btn-oval">
                <i class="fa fa-reply"></i> Back
            </a>
        </div>
        <div class="card-block">
            @if(Session::has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <p>
                        {{session('success')}}
                    </p>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if(Session::has('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <p>
                        {{session('error')}}
                    </p>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                   <ul>
                       @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                       @endforeach
                   </ul>
                </div>
            @endif
            {{csrf_field()}}
            <div class="row">
                <div class="col-sm-6">
                   <div class="form-group row">
                       <label for="code" class="col-sm-3">Code <span class="text-danger">*</span></label>
                       <div class="col-sm-9">
                           <input type="text" class="form-control" id="code" name='code' 
                            required autofocus value="{{old('code')}}">
                       </div>
                   </div>
                   <div class="form-group row">
                        <label for="name" class="col-sm-3">Name <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="name" name='name' 
                            required value="{{old('name')}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="barcode" class="col-sm-3">Barcode</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="barcode" name='barcode' 
                              value="{{old('barcode')}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="brand" class="col-sm-3">Brand </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="brand" name='brand' 
                              value="{{old('brand')}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="category_id" class="col-sm-3">Category <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <div class="row">
                                <div class="col-sm-10">
                                    <select name="category_id" id="category_id" class="form-control" required>
                                        <option value=""></option>
                                        @foreach($cats as $cat)
                                            <option value="{{$cat->id}}">{{$cat->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-2" style="padding-left: 0">
                                    <button class="btn btn-primary btn-sm btn-oval" 
                                        type="button" data-toggle="modal" data-target="#addCategory">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="unit_id" class="col-sm-3">Unit <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <div class="row">
                                <div class="col-sm-10">
                                    <select name="unit_id" id="unit_id" class="form-control" required>
                                        <option value=""></option>
                                        @foreach($units as $unit)
                                            <option value="{{$unit->id}}">{{$unit->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-2" style="padding-left: 0">
                                    <button class="btn btn-primary btn-sm btn-oval" 
                                        type="button" data-toggle="modal" data-target="#addUnit">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                           
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="price" class="col-sm-3">Price($) </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="price" name='price' 
                              value="{{old('price')}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cost" class="col-sm-3">Cost($) </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="cost" name='cost' 
                              value="{{old('cost')}}">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group row">
                        <label for="photo" class="col-sm-3">Photo </label>
                        <div class="col-sm-9">
                            <input type="file" class="form-control" id="photo" 
                                name='photo' onchange="load(event)">
                            <p style="margin-top:9px">
                                <img src="" alt="" id='img' width="150">
                            </p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <textarea name="description" id="description" cols="30" 
                        rows="4" class="form-control"></textarea>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</form>
{{-- modal for add category --}}
<div class="modal fade" id="addCategory" tabindex="-1" role="dialog" aria-labelledby="addCategory" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="#">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    
                    <div class="form-group row">
                        <label for="m_name" class="col-sm-3">Name<span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="m_name">
                        </div>
                    </div>
                    
                    
                </div>
                <div class="modal-footer">
                    <div style='padding: 5px'>
                        <button type="button" class="btn btn-primary btn-sm btn-oval" 
                        id="btn" onclick="saveCategory()">Save</button>
                        <button type="button" class="btn btn-danger btn-sm btn-oval" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div> 
<div class="modal fade" id="addUnit" tabindex="-1" role="dialog" aria-labelledby="addUnit" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="#">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">New Unit</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        
                        <div class="form-group row">
                            <label for="u_name" class="col-sm-3">Name<span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="u_name">
                            </div>
                        </div>
                        
                        
                    </div>
                    <div class="modal-footer">
                        <div style='padding: 5px'>
                            <button type="button" class="btn btn-primary btn-sm btn-oval" 
                            id="btn" onclick="saveUnit()">Save</button>
                            <button type="button" class="btn btn-danger btn-sm btn-oval" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('js')
    <script>
        var url = "{{url('/')}}";
        $(document).ready(function(){
            $("#sidebar-menu").removeClass('active open');
            $('#sidebar-menu li ul li').removeClass('active');
           
            $("#menu_product").addClass('active');

        });
        function load(evt)
        {
            var img = document.getElementById('img');
            img.src = URL.createObjectURL(evt.target.files[0]);
        }
        function saveCategory()
        {
            let data = {
                name: $("#m_name").val()
            };
            let token = $("input[name='_token']").val();
            $.ajax({
                type: "POST",
                url: url + "/product/category/save",
                data: data,
                beforeSend: function (request) {
                    return request.setRequestHeader('X-CSRF-Token', token);
                },
                success: function (sms) {
                    let data = JSON.parse(sms);
                    if(data!=null)
                    {
                        let opt = "<option value='" + data.id +"'>" + data.name + "</option>";
                        $("#category_id option:last-child").after(opt);
                        $('#category_id').val(data.id);
                        $('#addCategory').modal('hide');
                        $("#m_name").val("");
                    }
                }
            });
        }
        function saveUnit()
        {
            let data = {
                name: $("#u_name").val()
            };
            let token = $("input[name='_token']").val();
            $.ajax({
                type: "POST",
                url: url + "/product/unit/save",
                data: data,
                beforeSend: function (request) {
                    return request.setRequestHeader('X-CSRF-Token', token);
                },
                success: function (sms) {
                    let data = JSON.parse(sms);
                    if(data!=null)
                    {
                        let opt = "<option value='" + data.id +"'>" + data.name + "</option>";
                        $("#unit_id option:last-child").after(opt);
                        $('#unit_id').val(data.id);
                        $('#addUnit').modal('hide');
                        $("#u_name").val("");
                    }
                }
            });
        }
    </script>
@endsection