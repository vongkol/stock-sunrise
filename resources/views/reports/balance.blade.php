@extends('layouts.master')
@section('header')
    <strong>Stock Balance Report</strong>
@endsection
@section('content')
    <div class="card card-gray">
        
        <div class="card-block">
            <form action="{{url('report/balance/search')}}">
                <select name="product">
                    <option value="all">-- All Products --</option>
                    @foreach($products as $p)
                        <option value="{{$p->id}}" {{$p->id==$pid?'selected':''}}>{{$p->code}} - {{$p->name}}</option>
                    @endforeach
                </select> 
                <button>View</button>
            </form> 
            @if($result)
                <p>
                    <a href="{{url('report/balance/print?pid='.$pid)}}" target="_blank"
                        class="btn btn-primary btn-sm btn-oval">
                        <i class="fa fa-print"></i> Print
                    </a>
                </p>
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
                        @php($i=1)
                        @foreach($result as $p)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$p->code}}</td>
                                <td>{{$p->name}}</td>
                                <td>{{$p->cname}}</td>
                                <td>{{$p->onhand}} {{$p->uname}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <hr>
                <p class="text-danger">No result found yet!</p>
            @endif
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
            $("#rp_blance").addClass('active');

        });
    </script>
@endsection