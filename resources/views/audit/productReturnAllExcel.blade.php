{{--<!doctype html>--}}
{{--<html lang="en">--}}
{{--<head>--}}
{{--<meta charset="UTF-8">--}}
{{--<meta name="viewport"--}}
{{--content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">--}}
{{--<meta http-equiv="X-UA-Compatible" content="ie=edge">--}}
{{--<link rel="stylesheet" href="{{ asset('assets/bower_components/bootstrap/dist/css/bootstrap.min.css ')}}">--}}
{{--<!-- Font Awesome -->--}}
{{--<link rel="stylesheet" href="{{ asset('assets/bower_components/font-awesome/css/font-awesome.min.css')}} ">--}}
{{--<!-- Ionicons -->--}}
{{--<link rel="stylesheet" href="{{ asset('assets/bower_components/Ionicons/css/ionicons.min.css')}} ">--}}

{{--<title>Product Masuk Exports All PDF</title>--}}
{{--</head>--}}
{{--<body>--}}
<style>
    #product-masuk {
        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    #product-masuk td, #product-masuk th {
        border: 1px solid #ddd;
        padding: 8px;
    }

    #product-masuk tr:nth-child(even){background-color: #f2f2f2;}

    #product-masuk tr:hover {background-color: #ddd;}

    #product-masuk th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #4CAF50;
        color: white;
    }
</style>

<table id="product" width="100%">
    <thead>
    <tr>
        <th>ID</th>
        <th>Username</th>
        <th>IP Address</th>
        <th>Location</th>
        <th>Access From</th>
        <th>Activity</th>
        <th>Activity Date</th>
    </tr>
    </thead>
    @foreach($product_return as $p)
        <tbody>
        <tr>
            <td>{{ $p->id }}</td>
            <td>{{ $p->username }}</td>
            <td>{{ $p->ip_address }}</td>
            <td>{{ $p->location }}</td>
            <td>{{ $p->access_from }}</td>
            <td>{{ $p->activity }}</td>
            <td>{{ $p->created_at }}</td>
        </tr>
        </tbody>
    @endforeach

</table>


{{--<!-- jQuery 3 -->--}}
{{--<script src="{{  asset('assets/bower_components/jquery/dist/jquery.min.js') }} "></script>--}}
{{--<!-- Bootstrap 3.3.7 -->--}}
{{--<script src="{{  asset('assets/bower_components/bootstrap/dist/js/bootstrap.min.js') }} "></script>--}}
{{--<!-- AdminLTE App -->--}}
{{--<script src="{{  asset('assets/dist/js/adminlte.min.js') }}"></script>--}}
{{--</body>--}}
{{--</html>--}}


