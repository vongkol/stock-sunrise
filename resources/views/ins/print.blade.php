<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Stock In</title>
</head>
<body>
    <h1 style="text-align:center">Company Name</h1>
    <p style="text-align:center">
        Date: {{date('Y-m-d')}}
    </p>
    <hr>
    <table border="0" width="100%">
        <tr>
            <td>In Date</td>
            <td>:</td>
            <td>{{$in->in_date}}</td>
            <td>Warehouse</td>
            <td>:</td>
            <td>{{$in->name}}</td>
        </tr>
        <tr>
            <td>PO No.</td>
            <td>:</td>
            <td>{{$in->po_no}}</td>
            <td>Reference</td>
            <td>:</td>
            <td>{{$in->reference}}</td>
        </tr>
        <tr>
            <td>Description</td>
            <td>:</td>
            <td>{{$in->description}}</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    </table>
    <h4>Items</h4>
    <table width="100%" border='1' cellspacing="0">
        <tr>
            <th>#</th>
            <th>Code</th>
            <th>Name</th>
            <th>Quantity</th>
            <th>Unit</th>
        </tr>
        @php($i=1)
        @foreach($items as $item)
            <tr>
                <td>{{$i++}}</td>
                <td>{{$item->code}}</td>
                <td>{{$item->name}}</td>
                <td>{{$item->quantity}}</td>
                <td>{{$item->uname}}</td>
            </tr>
        @endforeach
    </table>
    <script>
        window.onload = function(){
            print();
        }    
    </script>
</body>
</html>