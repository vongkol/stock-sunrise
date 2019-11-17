@extends('layouts.master')
@section('header')
    <strong>Stock Out</strong>
@endsection
@section('content')
    <div class="card card-gray">
        <div class="toolbox">
            <a href="{{url('stockout/create')}}" class="btn btn-primary btn-sm btn-oval">
                <i class="fa fa-plus-circle"></i> Create
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
            <table class="table table-sm table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Date Out</th>
                        <th>Reference</th>
                        <th>Request Code</th>
                        <th>Warehouse</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $page = @$_GET['page'];
                        if(!$page)
                        {
                            $page = 1;
                        }
                        $i = config('app.row') * ($page -1) + 1;
                    ?>
                    @foreach($outs as $out)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>
                                <a href="{{url('stockout/detail/'.$out->id)}}">{{$out->out_date}}</a>
                            </td>
                            <td>{{$out->reference}}</td>
                            <td>{{$out->request_code}}</td>
                            <td>{{$out->name}}</td>
                          
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{$outs->links()}}
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function(){
            $("#sidebar-menu").removeClass('active open');
            $('#sidebar-menu li ul li').removeClass('active');
          
            $("#menu_out").addClass('active');

        });
    </script>
@endsection