<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <title>اضافه فرع رئيسي</title>
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


    <!-- Create New Category Form -->
    <div class="admin_child2 col-lg-9 col-12">
        <!-- Create New Category Form -->
        <form action="{{ route('storeCategory') }}" method="POST" class="create_year">
            @csrf
            <div class="add_user_input col-11 mb-3" id="add_user">
                <input type="text" name="name" class="user_input col-11 col-md-5 col-lg-6 mt-5" placeholder="اضف عنصر رئيسي" />
                <button type="submit" class="add_button mt-md-5 me-md-3 mt-0">اضافه</button>
            </div>
        </form>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    <!-- Category Table -->
    <div class="admin_child2 mt-5">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr class="text-center">
                        {{-- <td><input type="checkbox" id="checkbox_parent2" /></td> --}}
                        <th>العنوان الرئيسي</th>
                        <th>الفعل</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($categories as $category)
                    <tr>
                        {{-- <td><input type="checkbox" id="check2" class="table_checkbox2 responsive_checkbox_edit" /></td> --}}
                        <td class="responsive_edit">{{ $category->name }}</td>
                        <td class="table_button_parent col-5">
                            <form action="{{ route('deleteCategory', $category->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete_button mb-md-0 mb-2 me-md-4">حذف</button>
                            </form>
                            <button type="button" class="update_button update_button2">تعديل</button>
                            <form action="{{ route('updateCategory', $category->id) }}" method="POST" class="update-form" style="display: none;">
                                    @csrf
                                    @method('PUT')
                                <input type="text" name="name" class="updated-year-input">
                                <button type="submit" class="submit-update-button">تأكيد</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="text-center">القسم</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{-- <form method="POST" action="{{ route('delete.all.categories') }}" id="delete_all_form">
            @csrf
            <button type="submit" id="delete_all" class="delete_button">Supprimer tout</button>
        </form> --}}
    </div>

    <!-- Update Category Data -->
    {{-- <div id="Update_dev2">
        <div class="Update_dev1 d-flex justify-content-center col-lg-5 col-md-7 col-sm-8 col-10">
            <h2 class="update_h2">Mettre à jour les données</h2>
            <form class="text-center update-form" style="display: none;">
                @csrf
                @method('PUT')
                <input type="text" name="name" class="user_input col-9 mb-4" placeholder="Update Category Name" />
                <button type="submit" class="add_button col-6 mb-5">Soumettre</button>
            </form>
        </div>
    </div> --}}
</div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    var updateButtons = document.querySelectorAll(".update_button");
    var updateForms = document.querySelectorAll(".update-form");

    updateButtons.forEach(function (updateButton) {
        updateButton.addEventListener("click", function () {
            var updateForm = this.nextElementSibling;
            toggleUpdateForm(updateForm);
        });
    });

    function toggleUpdateForm(updateForm) {
        updateForms.forEach(function (form) {
            if (form !== updateForm) {
                form.style.display = "none";
            }
        });
        if (updateForm.style.display === "none") {
            updateForm.style.display = "block";
        } else {
            updateForm.style.display = "none";
        }
    }
});
</script>
</body>
</html>
