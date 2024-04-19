<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>بطولاتي</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{ asset('css/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/css/bootstrap.min.css.map') }}">
</head>

<body class="parents">
    <form method="POST" action="">
        <header>
            <nav class="navbar navbar-expand-lg px-md-5 d-flex m-0 justify-content-evenly">
                <h3 class="py-1 text-dark"><a class="home-link" href="{{ route('home') }}" style="color: #0a0a0a !important; text-decoration:none">الصفحة الرئيسية</a></h3>
            </nav>
        </header>


        <div class="parent">
            <h2 class="text-center head mb-5" style="margin-top: 120px; color:black">{{ $category->name }}</h2>
            <div class="child-img d-flex justify-content-evenly col-10 col-md-7 mb-4 mt-3">
                @if($category->images->isNotEmpty())
                    <div class="">
                        @foreach($category->images as $image)
                            @if(Str::endsWith($image->image, ['.jpg', '.jpeg', '.png', '.gif']))
                                <a class="col-10 col-md-5 mb-5 me-3" href="{{ asset('storage/'.$image->image) }}" target="_blank">
                                    <img class="col-12" src="{{ asset('storage/'.$image->image) }}" loading="lazy">
                                </a>
                            @elseif(Str::endsWith($image->image, ['.mp4', '.avi', '.mov', '.wmv']))
                                <video class="col-10 col-md-auto mb-5 me-3" controls>
                                    <source src="{{ asset('storage/'.$image->image) }}" type="video/mp4" loading="lazy">
                                    Your browser does not support the video tag.
                                </video>
                            @endif
                        @endforeach
                    </div>
                @else
                    <p>No images found for this category.</p>
                @endif
            </div>
        </div>

    </form>


    <style>     body {
        width: 100%;
        background-position:center;
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

    <script src="{{ asset('js/all.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js.map') }}" type="text/javascript"></script>
</body>
</html>
