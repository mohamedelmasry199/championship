<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Category;
use App\Models\Image;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    // public function __construct()
    // {
    //     $this->middlware('admin');
    // }
    public function index(){
        return view('dashboard.index');
    }
    public function addCategory()
    {
        $categories = Category::where('parent_id',null)->get();
        return view('dashboard.category', compact('categories'));
    }

    public function storeCategory(Request $request)
    {
        $messages = [
            'required' => 'الحقل مطلوب',
            'string' => 'يجب أن يكون الحقل :attribute نصًا.',
            'unique' => ' موجود بالفعل.',
        ];

        $request->validate([
            'name' => 'required|string|unique:categories',
        ]);
        $data = $request->only('name');
        $data['parent_id'] = null;
        Category::create($data);

        return redirect()->back()->with('success', 'تم اضافه القسم بنجاح');
    }


    public function updateCategory(Request $request, $id)
    {
        $messages = [
            'required' => 'الحقل مطلوب',
            'string' => 'يجب أن يكون الحقل :attribute نصًا.',
            'unique' => ' موجود بالفعل.',
        ];

        $request->validate([
            'name' => ['required', 'string', Rule::unique('categories')->ignore($id)],
        ]);

        $category = Category::findOrFail($id);
        $category->update($request->only('name'));

        return redirect()->back()->with('success', 'تم تحديث القسم بنجاح');
    }

    public function deleteCategory($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->back()->with('success', 'تم مسح القسم بنجاح');
    }
    public function yearsDeleteAll()
    {
        try {
            Category::query()->delete();
            return redirect()->back()->with('success', 'All years have been deleted successfully.');
        } catch (\Exception $e) {
            \Log::error('Error occurred while deleting all years: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while deleting all years.');
        }
    }


    public function addSubCategory()
    {
        $subCategories = Category::whereNotNull('parent_id')->get();
        $mainCategories = Category::all();
        return view('dashboard.subCategory', compact('subCategories','mainCategories'));
    }

    public function storeSubCategory(Request $request)
    {
        $messages = [
            'required' => 'الحقل مطلوب',
            'string' => 'يجب أن يكون الحقل :attribute نصًا.',
            'unique' => ' موجود بالفعل.',
        ];
        $request->validate([
            'name' => 'required|string',
            'parent_id' => 'required|exists:categories,id',
        ]);
        $subCategory = Category::create([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'is_leaf'=>1
        ]);

        return redirect()->back()->with('success', 'Subcategory saved successfully.');
    }
    public function updateSubCategory(Request $request, $id)
    {
        $messages = [
            'required' => 'الحقل مطلوب',
            'string' => 'يجب أن يكون الحقل :attribute نصًا.',
            'unique' => ' موجود بالفعل.',
        ];
        $request->validate([
            'name' => ['required', 'string'],
        ]);

        $subCategory = Category::findOrFail($id);
        $subCategory->update([
            'name' => $request->name,
        ]);

        return redirect()->back()->with('success', 'تم تحديث العنصر بنجاح');
    }

    public function deleteSubCategory($id)
    {
        $subCategory = Category::findOrFail($id);
        $subCategory->delete();

        return redirect()->back()->with('success', 'تم مسح العنصر بنجاح');
    }

    public function addUser()
    {
        $users = User::all();
        return view('dashboard.userData', compact('users'));
    }

    public function storeUser(Request $request)
    {
        $messages = [
            'required' => 'الحقل مطلوب',
            'string' => 'يجب أن يكون الحقل :attribute نصًا.',
            'unique' => ' موجود بالفعل.',
        ];

        $validatedData = $request->validate([
            'code' => 'required|string|unique:users',
        ], $messages);

        $user = User::create($validatedData);
        return redirect()->back()->with('success', 'تمت إضافة المسئول بنجاح.');
    }

    public function updateUser(Request $request, $id)
    {
        $messages = [
            'required' => 'الحقل مطلوب',
            'string' => 'يجب أن يكون الحقل :attribute نصًا.',
            'unique' => ' موجود بالفعل.',
        ];
        $request->validate([
            'code' => 'required|string|unique:users,code,' . $id,
        ], $messages);
        $user=User::findOrFail($id);
        $user->update($request->only('code','status'));
        return redirect()->back()->with('success', 'تم تحديث المسئول بنجاح');
    }

    public function deleteUser($id)
    {
        $user=User::findOrFail($id);
        $user->delete();

        return redirect()->back()->with('success', 'تم مسح المسئول');
    }



    public function createImage(){

        $subCategories=Category::whereDoesntHave('children')->where('is_leaf',1)->get();
        return view('dashboard.createImage',compact('subCategories'));
    }

////////////////////////////////////////////////////
public function storeImage(Request $request)
{
    $messages = [
        'required' => 'الحقل مطلوب',
        'string' => 'يجب أن يكون الحقل  نصًا.',
        'unique' => 'موجود بالفعل.',
        'mimes' => 'يجب أن يكون الحقل من نوع jpeg أو png أو mp4.',
        'max' => 'يجب ألا يتجاوز حجم الحقل الحد الأقصى للحجم.',
        'exists'=>'الحقل الرئيسي غير موجود'
    ];
$validatedData = $request->validate([
    'parent_id' => 'required|exists:categories,id',
    'name'=>'nullable|string',
    'image' => 'required|file|mimes:jpeg,png,mp4|max:204800',
],$messages);
$id= $validatedData['parent_id'];
$category = Category::findOrFail($id);
$image =new Image();
if ($request->hasFile('image')) {
    $imagePath = $request->file('image')->store('uploads', 'public');
    $validatedData['image'] = $imagePath;
}
$image->name=$validatedData['name'];
$image->image = $validatedData['image'];
$image->category_id = $category->id;
$image->save();

    return redirect()->back()->with('success', 'تمت الاضافه بنجاح');
}

public function updateImage(Request $request, $id)
{
    $messages = [
        'required' => 'الحقل مطلوب',
        'string' => 'يجب أن يكون الحقل  نصًا.',
        'unique' => 'موجود بالفعل.',
        'mimes' => 'يجب أن يكون الحقل من نوع jpeg أو png أو mp4.',
        'max' => 'يجب ألا يتجاوز حجم الحقل الحد الأقصى للحجم.',
    ];

    $validatedData = $request->validate([
        'name' => 'nullable|string',
        'image' => 'nullable|file|mimes:jpeg,png,mp4|max:204800',
    ], $messages);

    $image = Image::findOrFail($id);

    // Check if a new image is uploaded
    if ($request->hasFile('image')) {
        // Delete the old image from storage
        Storage::disk('public')->delete($image->image);

        // Store the new image
        $imagePath = $request->file('image')->store('uploads', 'public');
        $image->image = $imagePath;
    }

    // Update the image name if provided
    if ($request->has('name')) {
        $image->name = $validatedData['name'];
    }

    $image->save();

    return redirect()->back()->with('success', 'تم التحديث بنجاح');
}

public function deleteImage($id)
{
    $image = Image::findOrFail($id);

    if ($image->image) {
        Storage::disk('public')->delete($image->image);
    }

    $image->delete();

    return redirect()->back()->with('success', 'تم الحذف بنجاح');
}




}
