<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <title>التحديثات</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="stylesheet" href="{{ asset('css/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/css/bootstrap.min.css.map') }}" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg px-md-5 d-flex m-0 justify-content-evenly">
            <h3 class="py-1 text-dark"><a class="home-link" href="{{ route('home') }}" style="color: #0a0a0a !important; text-decoration:none">الصفحة الرئيسية</a></h3>
        </nav>
    </header>

<div class="admin_child2 col-11 m-auto" style="padding-top: 150px !important;">
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="thead">
                <tr class="text-center">
                    <th style="border-left: 1px solid #0a0a0a;">الفرع</th>
                    <th style="border-left: 1px solid #0a0a0a;">التعديل</th>
                    <th>وقت التحديث</th>
                </tr>
            </thead>
            <tbody>
                @foreach($updates as $update)
                <tr>
                    <td>{{ $update->parent_name }}</td>
                    <td>{{ $update->name }}</td>
                    <td>{{ $update->updated_at }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<style>
    body {
            width: 100%;
            min-height: 100vh;
            background-position: left;
            background-repeat: no-repeat;
            background-size:cover;
            background-image: url('{{ asset('large.jpg') }}');
            background-attachment: fixed !important;

        }
        header {
    position: fixed;
    z-index: 999;
    top: 0;
    left: 0;
    width: 100%;
    background-color: #ffffff7e !important;
  }
  .navbar {
    background-color: transparent !important;
  }
 </style>
</body>
</html>
