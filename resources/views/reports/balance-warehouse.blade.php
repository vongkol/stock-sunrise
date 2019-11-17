@extends('layouts.master')
@section('header')
    <strong>Warehouse Balance Report</strong>
@endsection
@section('content')
    <div class="card card-gray">
       <div class="toolbox">
        <a href="{{url('report/balance/warehouse/print')}}" target="_blank"
            class="btn btn-primary btn-sm btn-oval">
            <i class="fa fa-print"></i> Print
        </a>
       </div>
        <div class="card-block">
            <table class="table table-sm table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Code</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Onhand</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($whs as $w)
                        <tr>
                            <td colspan='5'>
                                <h3>{{$w->name}}</h3>
                            </td>
                            <?php
                                $products = DB::table('products')
                                    ->join('product_warehouses', 'product_warehouses.product_id', 'products.id')
                                    ->join('units', 'products.unit_id', 'units.id')
                                    ->leftJoin('categories', 'products.category_id', 'categories.id')
                                    ->where('product_warehouses.warehouse_id', $w->id)
                                    ->select('products.*', 'product_warehouses.total', 'units.name as uname', 
                                        'categories.name as cname')
                                    ->get();
                            ?>
                            @php($i=1)
                            @foreach($products as $p)
                                
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$p->code}}</td>
                                    <td>{{$p->name}}</td>
                                    <td>{{$p->cname}}</td>
                                    <td>{{$p->onhand}} {{$p->uname}}</td>
                                </tr>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function(){
            $("#sidebar-menu").removeClass('active open');
            $('#sidebar-menu li ul li').removeClass('active');
            $("#menu_report").addClass('active open');
            $("#report_collapse").addClass('collapse in');
            $("#rp_blance_warehouse").addClass('active');

        });
    </script>
@endsection