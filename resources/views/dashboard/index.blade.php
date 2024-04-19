<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <title>بطولاتي</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="stylesheet" href="{{ asset('css/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/css/bootstrap.min.css.map') }}" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  </head>
  <body>
    <div class="admin_parent row m-0 d-flex justify-content-between">
      <!-- ///////////// Dashboard  /////////////// -->
      <div class="admin_child1 d-flex bg-dark col-lg-3 col-12">
        <div class="arrow_parent mt-3 mb-4 d-flex">
            <i class="fas fa-users add_icon mt-2 me-3 mb-4"></i>
            <a href="{{ route('addUser') }}"><h2 class="add_users"> اضف مستخدم</h2></a>
          </div>

        <div class="arrow_parent mt-3 mb-4 d-flex">
            <i class="fas fa-chalkboard-teacher add_icon mt-2 me-3 mb-4"></i>
            <a href="{{ route('addCategory') }}"><h2 class="add_year">اضف عنصر رئيسي</h2></a>
          </div>

          <div class="arrow_parent mt-3 mb-4 d-flex">
            <i class="fas fa-layer-group add_icon mt-2 me-3 mb-4"></i>
            <a href="{{ route('addSubCategory') }}"><h2 class="add_year">اضف عنصر فرعي</h2></a>
          </div>


          <div class="arrow_parent mt-3 mb-4 d-flex">
            <i class="fas fa-layer-group add_icon mt-2 me-3 mb-4"></i>
            <a href="{{ route('createImage')}}"><h2 class="add_chapter">اضف صوره</h2></a>
        </div>


        <div class="arrow_parent mt-3 mb-4 d-flex">
            <i class="fas fa-book-open add_icon mt-2 me-3 mb-4"></i>
            <a href="{{ route('home') }}"><h2 class="add_data">الصفحه الرئيسيه</h2></a>
        </div>
      </div>

    <script src="js/all.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/bootstrap.bundle.min.js.map"></script>
  </body>
</html>
