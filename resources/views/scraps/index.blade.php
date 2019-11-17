@extends('layouts.master')
@section('header')
    <strong>Scrap Product</strong>
@endsection
@section('content')
    <div class="card card-gray">
        <div class="toolbox">
            <a href="{{url('scrap/create')}}" class="btn btn-primary btn-sm btn-oval">
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
                        <th>Scrap Date</th>
                        <th>Reference</th>
                        <th>Warehouse</th>
                        <th>Description</th>
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
                    @foreach($scraps as $sc)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>
                                <a href="{{url('scrap/detail/'.$sc->id)}}">
                                    {{$sc->scrap_date}}</a>
                            </td>
                            <td>{{$sc->reference}}</td>
                            <td>{{$sc->name}}</td>
                            <th>{{$sc->description}}</th>
                          
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{$scraps->links()}}
        </div>
    </div>
    <?php
    echo '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG("4", "C39+") . '" alt="barcode"   />';
    ?>
@endsection
@section('js')
    <script>
        $(document).ready(function(){
            $("#sidebar-menu").removeClass('active open');
            $('#sidebar-menu li ul li').removeClass('active');
          
            $("#menu_scrap").addClass('active');

        });
    </script>
@endsection