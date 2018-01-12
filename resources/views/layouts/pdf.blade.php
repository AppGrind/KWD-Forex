<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <style type="text/css">
        a {
            color: #AD855D;
            text-decoration: underline;
        }
        body {
            position: relative;
            width: 18cm;
            height: 29.7cm;
            margin: 0 auto !important;
            color: #001028;
            background: #FFFFFF;
            font-size: 13px !important;
            font-family: Arial;
        }
        header {
            padding: 0 0 10px 0;
            margin-bottom: 100px;
            background-color: #AD855D;
        }
        header p, header h1, header h2,header h2 small{
            color: #fff;
        }
        #logo {
            text-align: center;
            padding: 10px 0;
            background-color: #fff;
        }
        #logo img {
            width: 200px;
        }
        h1 {
            border-bottom: 1px solid  #D2AC67;
            font-size: 2.4em;
            line-height: 1.4em;
            font-weight: lighter;
            text-align: center;
            margin: 0 0 20px 0;
        }
        footer {
            color: #D2AC67;
            width: 100%;
            height: 30px;
            position: absolute;
            bottom: 0;
            border-top: 1px solid #D2AC67;
            padding: 8px 0;
            text-align: center;
        }
    </style>
    @yield('styles')
</head>
<body>

@yield('content')

</body>
</html>
