<?php
session_start();
if (!isset($_SESSION['code'])) {
    $signInButtonStyle = '';
    $signUpButtonStyle = '';
    $logoutButtonStyle = 'display:none';
} else {
    $signInButtonStyle = 'display:none';
    $signUpButtonStyle = 'display:none';
    $logoutButtonStyle = '';
}
?>

<?php

// Check if the function renderCategories does not exist before declaring it
if (!function_exists('renderCategories')) {
    function renderCategories($categories, $level = 0, $isLast = false)
    {
        $indent = str_repeat('&nbsp;', $level * 10);

        foreach ($categories as $category) {
            echo '<li class="">';
            echo '<a href="#" class="toggle-category" data-parent="' . $category['parent_id'] . '">';
            if ($category->is_leaf == 0) {
                echo '<span class="head main-category">' . $indent . $category['name'] . '</span>';
            } else {
                if (!$category->children()->exists()) {
                    echo '<span class="head sub-category" onclick="location.href=\'' . route('displayMedia', ['id' => $category['id']]) . '\'">' . $indent . $category['name'] . '</span>';
                } else {
                    echo '<span class="head sub-category">' . $indent . $category['name'] . '</span>';
                }
            }
            if ($category->children()->exists()) {
                echo '<i class="fas fa-chevron-left arrow"></i>'; // أيقونة السهم
            } elseif (!$category->children()->exists()) {
                // لا تقم بإظهار السهم إذا كان العنصر الفرعي فردياً بلا عناصر فرعية داخله
                echo '';
            }
            echo '</a>';
            if (!empty($category->children)) {
                echo '<ul class="submenu" style="display:none;">';
                renderCategories($category->children, $level + 1, $isLast);
                echo '</ul>';
            } else {
                // إذا كان التفرع الحالي هو التفرع الأخير، قم بتعيين المتغير $isLast إلى true
                $isLast = true;
                echo '<span class="toggle-category">';
                echo '<span class="head sub-category"></span>';
                echo '</span>';
            }
            echo '</li>';
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>بطولاتي</title>
    <!-- <link rel="stylesheet" href="css/style.css"> -->
     <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css.map') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</head>


<body>
    <header>
        <nav class="navbar navbar-expand-lg px-md-5 d-flex m-0">
            <div class="container-fluid header">
                {{-- <a class="navbar-brand logo" href="{{ route('home') }}">
                    <img src="{{ asset('IMG-20240314-WA0217-removebg-preview.png') }}"
                        style="width: 130px; height: 130px; margin:-37px 0 -50px 0" alt="MCQ Lab Logo">
                </a> --}}
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent" style="display: flex; justify-content : center">
                    <ul class="navbar-nav mb-2 mb-lg-0 ">
                        {{-- <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ route('home') }}">الصفحه الرئيسيه</a>
                        </li> --}}
                        @auth
                        @if (auth()->user()->status == 'admin')
                        <li class="nav-item">
                            <a class=" login stting" href="{{ route('dashboard.index') }}">الاعدادات</a>
                        </li>
                        @endif
                        @endauth
                        {{-- @auth
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="btn logout btn-outline-primary">تسجيل الخروج</button>
                        </form>
                        @endauth --}}
                    </ul>
                {{-- </div>
            </div> --}}
            <div class="" style="display: flex; align-items:center ; justify-content:center">
                @guest
                    <a href="{{ route('login') }}" class="login"
                        style="{{ $signInButtonStyle }}">تسجيل الدخول كمشرف</a>
                @endguest
                @auth
                    @if (auth()->user()->status == 'admin')
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="login">تسجيل الخروج</button>
                        </form>
                    @endif
                @endauth
                @guest
                <a href="{{ route('show_updates') }}" class="login"
                    style="{{ $signInButtonStyle }}">اخر التحديثات</a>
            @endguest
            </div>
        </nav>
    </header>


    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            list-style: none;
            text-decoration: none;
            outline: 0;
            border: 0;
            scroll-behavior: smooth !important;
            direction: rtl;
        }

        body {
            width: 100%;
            min-height: 100vh;
            background-position: left;
            background-repeat: no-repeat;
            background-size:cover;
             background-image: url('{{ asset('large.jpg') }}');
             background-attachment: fixed !important;

        }

        .login{
            padding: 10px !important;
            border-radius: 8px;
            border: 0;
            padding: 0;
            background-color: #000000;
            /* background-color: rgb(9, 92, 140); */
            color: white;
            margin-bottom: 10px;
            letter-spacing: 1px;
            font-size: 18px;
            margin-top: -10px !important;
            margin-right: 20px;
        }
        .login:hover{
            /* background-color: rgba(9, 86, 131, 0.852); */
            background-color: #000000d1;
        }

        #menu {
            padding: 20px;
            padding-top: 70px;
            background-color: #ffffff7e;
            height: 100vh;
            display: inline-block;
            min-width: 250px;
            direction: rtl;
        }

        #menu li {
            padding: 3px 0;
            text-decoration: none;
            direction: rtl;
        }

        .nav-item{
            display: flex;
            justify-content: center;
            align-items: center;
            /* float: left; */

        }
        .head {
            color: #000;
        }
        /* .stting{s
            ;
        } */
        /* nav{
            display: flex;
            justify-content: space-evenly;
            flex-direction: row;
            align-items: center
        } */
        /* .navbar-nav {
    margin-left: auto !important;
  } */
  /* .nav-item a {
    text-decoration: none;
    color: #464545 !important;
    font-size: 1.2em;
    font-weight: 600;
    letter-spacing: 1px;
    padding: 10px;
    margin-top: -3px;
    margin-left: 60px !important;
  } */
  header {
    position: fixed;
    z-index: 999;
    top: 0;
    left: 0;
    width: 100%;
    background-color: #ffffff7e;
  }
  .navbar {
    /* background-color: rgb(211, 211, 211) !important; */
    background-color: transparent;;
  }

        .arrow {
            color: #000;
            font-size: 14px !important;
        }

        .main-category+.arrow {
            margin-right: 20px;
        }

        .sub-category+.arrow {
            margin-right: 10px;
        }

        .main-category {
            font-size: 25px;
            /* letter-spacing: 1px; */
            display: inline-block;
            margin: 13px 0 !important;
            font-weight: 700;
        }

        .sub-category {
            font-size: 20px;
            padding: 0 !important;
            margin-right: -35px !important;
            color: rgb(22, 22, 22);
            font-weight: 600;
        }

        .sub-category:hover,
        .main-category:hover {
            color: #073b77;
        }

        @media (max-width: 505px) {
            #menu {
                width: 100%;
            }
        }
    </style>

    <div class="">
        <div class="">
            <div class="">
                <div
                    class="">
                    <ul class=""
                        id="menu">
                        <?php renderCategories($categories); ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const toggleCategoryLinks = document.querySelectorAll('.toggle-category');
            toggleCategoryLinks.forEach(function (toggleLink) {
                toggleLink.addEventListener('click', function (event) {
                    event.preventDefault();
                    const arrowIcon = this.querySelector('.arrow');
                    const submenu = this.nextElementSibling;

                    if (this.querySelector('.sub-category')) {
                        arrowIcon.classList.toggle('fa-chevron-left');
                        arrowIcon.classList.toggle('fa-chevron-down');

                        // Toggle submenu display
                        submenu.style.display = (submenu.style.display === 'block') ? 'none' : 'block';
                    } else {
                        // Close all open submenus
                        const openSubmenus = document.querySelectorAll('.submenu');
                        openSubmenus.forEach(function (menu) {
                            if (menu !== submenu && menu.style.display === 'block') {
                                menu.style.display = 'none';
                                // Toggle arrow icon class for closed submenu
                                menu.previousElementSibling.querySelector('.arrow').classList.remove('fa-chevron-down');
                                menu.previousElementSibling.querySelector('.arrow').classList.add('fa-chevron-left');
                            }
                        });

                        // Toggle arrow icon class between right and down
                        arrowIcon.classList.toggle('fa-chevron-left');
                        arrowIcon.classList.toggle('fa-chevron-down');

                        // Toggle submenu display
                        submenu.style.display = (submenu.style.display === 'block') ? 'none' : 'block';
                    }
                });
            });
        });
    </script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/all.min.js') }}"></script>


</body>

</html>
