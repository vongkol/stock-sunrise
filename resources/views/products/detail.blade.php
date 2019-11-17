@extends('layouts.master')
@section('header')
    <strong>Product Detail</strong>
@endsection
@section('content')
<form action="#" >
    <div class="card card-gray">
        <div class="toolbox">
            <a href="{{route('product.create')}}" class="btn btn-primary btn-sm btn-oval">
                <i class="fa fa-plus-circle"></i> Create
            </a>
            <a href="{{route('product.edit', $pro->id)}}" class="btn btn-info btn-sm btn-oval">
                <i class="fa fa-edit"></i> Edit
            </a>
            <a href="{{url('product')}}" class="btn btn-warning btn-sm btn-oval">
                <i class="fa fa-reply"></i> Back
            </a>
            <a href="{{url('product/delete/'.$pro->id)}}" class="btn btn-danger btn-sm btn-oval" 
                onclick="return confirm('You want to delete?')">
                <i class="fa fa-trash"></i> Delete
            </a>
        </div>
        <div class="card-block">
          
            <div class="row">
                <div class="col-sm-6">
                   <div class="form-group row">
                       <label for="code" class="col-sm-3">Code</label>
                       <div class="col-sm-9">
                           : {{$pro->code}}
                       </div>
                   </div>
                   <div class="form-group row">
                        <label for="name" class="col-sm-3">Name</label>
                        <div class="col-sm-9">
                           : {{$pro->name}}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="barcode" class="col-sm-3">Barcode</label>
                        <div class="col-sm-9">
                            : {{$pro->barcode}}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="brand" class="col-sm-3">Brand </label>
                        <div class="col-sm-9">
                            : {{$pro->brand}}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="category_id" class="col-sm-3">Category</label>
                        <div class="col-sm-9">
                           : {{$pro->cname}}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="price" class="col-sm-3">Price($) </label>
                        <div class="col-sm-9">
                            : {{$pro->price}} $
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cost" class="col-sm-3">Cost($) </label>
                        <div class="col-sm-9">
                            : {{$pro->cost}} $
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3">Onhand </label>
                        <div class="col-sm-9">
                            : {{$pro->onhand}} {{$pro->uname}}
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group row">
                        <label for="photo" class="col-sm-3">Photo </label>
                        <div class="col-sm-9">
                           <img src="{{asset($pro->photo)}}" alt="" width="200">
                        </div>
                    </div>
                    <div class="form-group row">
                        : {{$pro->description}}
                    </div>
                    <div class="form-group row">
                        <img src="{{asset($pro->qrcode)}}" alt="" width="300">
                    </div>
                    <?php
                        $whs = DB::table('product_warehouses')
                            ->join('warehouses', 'product_warehouses.warehouse_id', 'warehouses.id')
                            ->where('product_warehouses.product_id', $pro->id)
                            ->select('product_warehouses.*', 'warehouses.name')
                            ->get();
                    ?>
                    <table class="table table-sm table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Warehouse</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($i=1)
                            @foreach($whs as $w)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$w->name}}</td>
                                    <td>{{$w->total}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            
        </div>
    </div>
</form>
@endsection
@section('js')
    <script>
        $(document).ready(function(){
            $("#sidebar-menu").removeClass('active open');
            $('#sidebar-menu li ul li').removeClass('active');
           
            $("#menu_product").addClass('active');

        });
       
    </script>
@endsection