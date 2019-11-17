<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Warehouse Balance Report</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="text-center">
            <img src="{{asset($com->logo)}}" alt="" width="150">
        </div>
        <h2 class='text-center'>{{$com->kh_name}}</h2>
        <h4 class="text-center">{{$com->en_name}}</h4>
        <p class='text-center'>
            <strong>Stock Balance Report</strong>
            <br>
            Date: {{date('Y-m-d')}}
        </p>
        <hr>
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
        <table class="table table-sm table-borderless">
            <tr>
                <td class='text-center'>
                    Prepared By <br><br>
                    ________________
                </td>
                <td class='text-center'>
                    Checked By <br><br>
                    ________________
                </td>
                <td class='text-center'>
                    Approved By <br><br>
                    ________________
                </td>
            </tr>
        </table>
    </div>

    <script>
        window.onload = function(){
            print();
        }
    </script>
</body>
</html>