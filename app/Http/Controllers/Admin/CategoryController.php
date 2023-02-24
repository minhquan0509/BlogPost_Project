<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\CategoryFormRequest;
use App\Models\Category;
use COM;
use Illuminate\Support\Facades\File;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{

    public function index()
    {
        $category = Category::all();
        return view('admin.category.index', compact('category'));
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(CategoryFormRequest $request)
    {
        $data = $request->validated();
        $category = new Category();
        $category->name = $data['name'];
        $category->slug = Str::slug($data['slug']);
        $category->description = $data['description'];

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            Storage::disk('s3')->put('uploads/category/'.$filename, file_get_contents($file));
            $category->image = $filename;
        }
        $category->meta_title = $data['meta_title'];
        $category->meta_description = $data['meta_description'];
        $category->meta_keyword = $data['meta_keyword'];
        $category->navbar_status = $request->navbar_status == true ? '1' : '0';
        $category->status = $request->status == true ? '1' : '0';
        $category->created_by = Auth::user()->id;
        $category->save();
        return redirect('/admin/category')->with('message', 'Category Added Successfully');
    }

    public function edit($category_id)
    {
        $category = Category::find($category_id);
        return view('admin.category.edit', compact('category'));
    }

    public function update(CategoryFormRequest $request, $category_id)
    {
        //Validate data from the form
        $data = $request->validated();

        //If the data from form validated successfully
        //Find the category that has $category_id
        $category = Category::find($category_id);

        //Assign the attributes to new values
        $category->name = $data['name'];
        $category->slug = Str::slug($data['slug']);
        $category->description = $data['description'];
        //Check if has image
        if ($request->hasFile('image')) {

            if($category->image){
                Storage::disk('s3')->delete('uploads/category/'.$category->image);
            }
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            Storage::disk('s3')->put('uploads/category/'.$filename, file_get_contents($file));
            $category->image = $filename;
        }
        $category->meta_title = $data['meta_title'];
        $category->meta_description = $data['meta_description'];
        $category->meta_keyword = $data['meta_keyword'];
        $category->navbar_status = $request->navbar_status == true ? '1' : '0';
        $category->status = $request->status == true ? '1' : '0';
        $category->created_by = Auth::user()->id;

        //Update category
        $category->update();
        return redirect('/admin/category')->with('message', 'Category Updated Successfully');
    }

    public function destroy($category_id)
    {
        $category = Category::find($category_id);
        if ($category) {
            $destination = 'uploads/category/' . $category->image;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            //Trước khi xóa 1 category , thực hiện xóa tất cả các bài posts liên quan đến nó
            $category->posts()->delete();
            $category->questions()->delete();
            $category->delete();

            return redirect('admin/category')->with('message', 'Category is deleted Successfully');
        } else {
            return redirect('admin/category')->with('message', 'No category found');
        }
    }
}
