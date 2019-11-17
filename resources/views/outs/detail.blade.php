@extends('layouts.master')
@section('header')
    <strong>Stock Out Detail</strong>
@endsection
@section('content')
<form>
    @csrf
    <input type="hidden" id="id" value="{{$out->id}}">
    <div class="card card-gray">
        <div class="toolbox">
            <a href="{{url('stockout/create')}}" class="btn btn-primary btn-sm btn-oval">
                <i class="fa fa-plus-circle"></i> Create
            </a>
            <a href="{{url('stockout')}}" class="btn btn-warning btn-sm btn-oval">
                <i class="fa fa-reply"></i> Back
            </a>
            <a href="{{url('stockout/delete/'.$out->id)}}" class="btn btn-danger btn-sm btn-oval" 
                onclick="return confirm('You want to delete?')">
                <i class="fa fa-trash"></i> Delete
            </a>
            <a href="{{url('stock-in/print/'.$out->id)}}" class="btn btn-primary btn-sm btn-oval" 
                target="_blank">
                <i class="fa fa-print"></i> Print
            </a>
        </div>
        <div class="card-block">
            <div class="row">
               <div class="col-sm-6">
                    <div class="form-group row">
                        <label for="out_date" class="col-sm-3">Out Date</label>
                        <div class="col-sm-9">
                            
                            <span id="lb_out_date">: {{$out->out_date}}</span>
                            <input type="date" class="form-control hide" id="out_date" 
                                value="{{$out->out_date}}">
                        </div>
                    </div>
               </div>
               <div class="col-sm-6">
                    <div class="form-group row">
                        <label for="warehouse" class="col-sm-3">Warehouse</label>
                        <div class="col-sm-9">
                            <span id="lb_warehouse">: {{$out->name}}</span>
                            <select id="warehouse" class="form-control hide">
                                <option value=""></option>
                                @foreach($warehouses as $w)
                                    <option value="{{$w->id}}" {{$out->warehouse_id==$w->id?'selected':''}}>{{$w->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div> 
            </div>
           
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group row">
                        <label for="request_code" class="col-sm-3">Request Code</label>
                        <div class="col-sm-9">
                            <span id="lb_rcode">: {{$out->request_code}}</span>
                            <input type="text" class="form-control hide" id="rcode" 
                                value="{{$out->request_code}}">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group row">
                        <label for="reference" class="col-sm-3">Reference</label>
                        <div class="col-sm-9">
                            <span id="lb_reference">: {{$out->reference}}</span>
                            <input type="text" class="form-control hide" id="reference" 
                                value="{{$out->reference}}">
                        </div>
                    </div>
                </div> 
            </div>
            <div class="row">
                <div class="col-sm-6">
                   
                </div>
                <div class="col-sm-6">
                    <button class="btn btn-primary btn-sm btn-oval" type="button" 
                        id='btnEdit' onclick="editMaster()">
                        <i class="fa fa-edit"></i> Edit
                    </button>
                    <button class="btn btn-primary btn-sm btn-oval hide" type="button" 
                        id='btnSave' onclick="saveMaster()">
                        <i class="fa fa-save"></i> Save
                    </button>
                    <button class="btn btn-danger btn-sm btn-oval hide" type="button" 
                        id='btnCancel' onclick="cancelEdit()">
                        <i class="fa fa-times"></i> Cancel
                    </button>
                </div> 
            </div>
            <div class="row">
                <div class="col-sm-2">
                    <h5>Items</h5>
                </div>
                <div class="col-sm-2">
                    <button class="btn btn-sm btn-primary btn-oval" type="button" 
                        data-toggle="modal" data-target="#addItem">
                        <i class="fa fa-plus"></i> Add
                    </button>
                </div>
            </div>

            <div class="row">
               <div class="col-sm-12">
                   <p></p>
                    <table class="table table-sm table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Code</th>
                                <th>Name</th>
                                <th>Quantity</th>
                                <th>Unit</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="data">
                            @php($i=1)
                            @foreach($items as $item)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$item->code}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->quantity}}</td>
                                    <td>{{$item->uname}}</td>
                                    <td>
                                        <a href="#" class="btn btn-danger btn-sm btn-oval" 
                                            onclick="removeItem(event, this, {{$item->id}})">
                                            Delete
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
               </div>
            </div>
        </div>
    </div>
</form>
<div class="modal fade" id="addItem" tabindex="-1" role="dialog" aria-labelledby="addItem" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form action="{{url('stockout/item/save')}}" method="POST">
            @csrf
            <input type="hidden" name="id" value="{{$out->id}}">
            <input type="hidden" name="warehouse_id" value="{{$out->warehouse_id}}">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New Item</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    
                    <div class="form-group row">
                        <label for="item" class="col-sm-3">Product<span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            
                            <select name="item" class="form-control chosen-select" id="item" required>
                                <option value="">-- Select --</option>
                                @foreach($products as $p)
                                    <option value="{{$p->id}}">{{$p->code}} - {{$p->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="qty1" class="col-sm-3">Quantity</label>
                        <div class="col-sm-8">
                            <input type="number" step="0.1" min="0" class="form-control" 
                                name="quantity" id="qty1" value="1">
                        </div>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <div style='padding: 5px'>
                        <button class="btn btn-primary btn-sm btn-oval">Save</button>
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
         
            $("#menu_out").addClass('active');

        });
        function editMaster()
        {
            $("#lb_out_date, #lb_warehouse, #lb_rcode, #lb_reference").addClass('hide');
            $('#out_date, #warehouse, #rcode, #reference').removeClass('hide');
            // hide button
            $("#btnEdit").addClass('hide');
            $("#btnSave, #btnCancel").removeClass('hide');
        }
        function cancelEdit()
        {
            $("#lb_out_date, #lb_warehouse, #lb_rcode, #lb_reference").removeClass('hide');
            $('#out_date, #warehouse, #rcode, #reference').addClass('hide');
            // hide button
            $("#btnEdit").removeClass('hide');
            $("#btnSave, #btnCancel").addClass('hide');
        }
        function saveMaster()
        {
            let token = $("input[name='_token']").val();
            let data = {
                id: $("#id").val(),
                out_date: $("#out_date").val(),
                warehouse_id: $("#warehouse").val(),
                rcode: $("#rcode").val(),
                reference: $("#reference").val()
            };
            let con = confirm('You want to save?');
            if(con)
            {
                $.ajax({
                    type: "POST",
                    url: url + "/stockout/master/save",
                    data: data,
                    beforeSend: function (request) {
                        return request.setRequestHeader('X-CSRF-Token', token);
                    },
                    success: function (sms) {

                        if(sms>0)
                        {
                            location.href = url + "/stockout/detail/" + sms;
                        }
                        else{
                            alert("Fail to save stock, please check again!");
                        }
                        console.log(sms);
                    }
                });
            }
           
        }
        function removeItem(evt,obj, id)
        {
            evt.preventDefault();
            let con = confirm('You want to delete?');
            if(con)
            {
                $.ajax({
                    type: 'GET',
                    url: url + "/stockout/item/delete/" + id,
                    success: function(sms)
                    {
                        if(sms)
                        {
                            $(obj).parent().parent().remove();
                        }
                    }
                });
            }
        }
    </script>
@endsection