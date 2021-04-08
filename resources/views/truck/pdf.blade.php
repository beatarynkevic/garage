<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>{{$truck->maker}}</title>
    <style>
        @font-face {
            font-family: 'Roboto';
            font-style: normal;
            font-weight: 400;
            src: url({{asset('fonts/Roboto-Regular.ttf')}}
        );
        }

        @font-face {
            font-family: 'Roboto';
            font-style: normal;
            font-weight: bold;
            src: url({{asset('fonts/Roboto-Bold.ttf')}}
        );
        }
        
        body {
            font-family: 'Roboto';
        }

    </style>
</head>
<body>
    <h1>{{$truck->maker}}</h1>
    <h3>{{$truck->truckMechanic->name}} {{$truck->truckMechanic->surname}}</h3>
    <div>{!!$truck->mechanic_notices!!}</div>
</body>
</html>
