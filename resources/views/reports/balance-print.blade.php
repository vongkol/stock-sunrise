<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Stock Balance Report</title>
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