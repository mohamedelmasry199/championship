<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <title>اضافه ملف</title>
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



        <form action="{{ route('storeImage') }}" method="POST" enctype="multipart/form-data" class="admin_child2 col-lg-9 col-12">
            @csrf
            <div class="create_subject">
                <div class="add_user_input col-11" id="add_user">
                    <select name="parent_id" class="form-select user_input col-11 col-md-5 col-lg-5 mx-md-2 mb-4 mt-5" aria-label="اختر عنصر">
                        <option value="">اختر عنصر</option>
                        @foreach($subCategories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    <input type="text" name="name" class="form-control user_input col-11 col-md-5 col-lg-5 mb-4 mt-2 mt-md-5" placeholder="اضف اسم الصورة">
                    <input type="file" name="image" class="form-control user_input col-11 col-md-5 col-lg-5 mb-4 mt-2 mt-md-5" placeholder="اضف صورة">
                    <button type="submit" class="btn btn-primary add_button col-md-3 col-6 mb-3">اضافة</button>
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
    <!-- Subject Table -->
    <div class="admin_child2 mt-5">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr class="text-center">
                        <th>العنصر</th>
                        <th>اسم الملف</th>
                        <th class="col-lg-3 col-4">الفعل</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($subCategories as $category)
                        @foreach($category->images as $image)
                            <tr>
                                <td class="responsive_edit">{{ $category->name }}</td>
                                <td class="responsive_edit">
                                    @if($image->name)
                                        {{ $image->name }}
                                    @else
                                    ملف {{ $category->name }}
                                    @endif
                                </td>
                                                                <td class="table_button_parent col-lg-3 col-4">
                                    <form action="{{ route('deleteImage', $image->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="delete_button mb-md-0 mb-2 me-md-4">حذف</button>
                                    </form>
                                    <button type="button" class="update_button update_button3" data-image-id="{{ $image->id }}">تعديل</button>
                                    <form action="{{ route('updateImage', $image->id) }}" method="POST" enctype="multipart/form-data" class="update-form" style="display: none;">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group">
                                            <input type="file" name="image" class="updated-image-input" accept="image/*,video/*" placeholder="ادخل صورة أو فيديو">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="name" class="form-control" placeholder="اسم الملف" value="{{ $image->name }}">
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="submit-update-button btn btn-primary">تأكيد</button>
                                        </div>
                                    </form>

                                </td>
                            </tr>
                        @endforeach
                    @empty
                        <tr>
                            <td colspan="3" class="text-center">لا يوجد ملفات</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

        {{-- <form method="POST" action="{{ route('delete.all.subjects') }}" id="delete_all_form">
            @csrf
            <button type="submit" id="delete_all" class="delete_button">Supprimer tout</button>
        </form> --}}

        <!-- Update Subject Data -->
        {{-- <div id="Update_dev3">
            <div class="Update_dev1 d-flex justify-content-center col-lg-5 col-md-7 col-sm-8 col-10">
                <h2 class="update_h2">تحديث القسم الفرعي</h2>
                <div class="text-center">
                    <input type="text" class="user_input col-9 mb-4" placeholder="تحديث العنصر الفرعي" />
                    <button type="submit" class="add_button col-6 mb-5">تأكيد</button>
                </div>
            </div>
        </div> --}}
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        var updateButtons = document.querySelectorAll(".update_button3");
        var updateForms = document.querySelectorAll(".update-form");

        updateButtons.forEach(function (updateButton) {
            updateButton.addEventListener("click", function () {
                var updateForm = this.nextElementSibling;
                var subjectId = this.dataset.subjectId; // Get the subject ID
                toggleUpdateForm(updateForm);
                populateUpdateFormFields(subjectId); // Populate update form fields with subject data
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

        function populateUpdateFormFields(subjectId) {
            // Assuming you have fetched subject data from the server, populate the form fields accordingly
            var updatedSubjectInput = document.querySelector(".updated-subject-input");
            updatedSubjectInput.value = ""; // Populate with subject data
        }
    });
</script>

</body>
</html>
