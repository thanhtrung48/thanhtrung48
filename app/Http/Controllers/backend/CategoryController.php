<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Link;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use Illuminate\Validation\Rules\Exists;

class CategoryController extends Controller
{

    public function index()
    {
        $list_category = Category::where('status', '!=', 0)->orderBy('created_at', 'desc')->get();
        return view('backend.category.index', compact('list_category'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $list_category = Category::where('status', '!=', 0)->get();
        $html_parent_id = '';
        $html_sort_order = '';
        foreach ($list_category as $item) {
            $html_parent_id .= '<option value="' . $item->id . '">' . $item->name . '</option>';
            $html_sort_order .= '<option value="' . $item->sort_order . '">Sau: ' . $item->name . '</option>';
        }
        return view('backend.category.create', compact('html_parent_id', 'html_sort_order'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryStoreRequest $request)
    {
        $category = new Category; //Tạo mới
        $category->name = $request->name;
        $category->slug = Str::slug($category->name = $request->name, '-');
        $category->metakey = $request->metakey;
        $category->metadesc = $request->metadesc;
        $category->parent_id = $request->parent_id;
        $category->sort_order = $request->sort_order;
        $category->status = $request->status;
        $category->created_at = date('Y-m-d H:i:s');
        $category->created_by = 1;
        //upload file 
        if ($request->has('image')) {
            $path_dir = "images/category/";
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = $category->slug . '.' . $extension;
            $file->move($path_dir,$filename);
            $category->image = $filename;
        }

        //end upload
        if ($category->save()) {
            $link = new Link();
            $link->slug = $category->slug;
            $link->table_id = $category->id;
            $link->type = 'category';
            $link->save();
            return redirect()->route('category.index')->with('message', ['type' => 'success', 'msg'
            => 'Thêm mẫu tin thành công!']);
        } else {
            return redirect()->route('category.index')->with('message', ['type' => 'danger', 'msg'
            => 'Thêm không thành công!']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::find($id);
        if ($category == null) {
            return redirect()->route('category.index')->with('message', ['type' => 'denger', 'msg'
            => 'Mẫu tin không tông tại!']);
        } else {
            return view('backend.category.show', compact('category'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::find($id);
        $list_category = Category::where('status', '!=', 0)->get();
        $html_parent_id = '';
        $html_sort_order = '';
        foreach ($list_category as $item) {
            $html_parent_id .= '<option value="' . $item->id . '">' . $item->name . '</option>';
            $html_sort_order .= '<option value="' . $item->sort_order . '">Sau: ' . $item->name . '</option>';
        }
        return view('backend.category.edit', compact('category', 'html_parent_id', 'html_sort_order'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryUpdateRequest $request, string $id)
    {
        $category = Category::find($id); //Lấy mẫu tin
        $category->name = $request->name;
        $category->slug = Str::slug($category->name = $request->name, '-');
        $category->metakey = $request->metakey;
        $category->metadesc = $request->metadesc;
        $category->parent_id = $request->parent_id;
        $category->sort_order = $request->sort_order;
        $category->status = $request->status;
        $category->updated_at = date('Y-m-d H:i:s');
        $category->updated_by = 1;
        //upload file 
        if ($request->has('image')) {
            $path_dir = "images/category/";
            if(File::Exists(public_path($path_dir . $category->image)))
            {
                File::delete($path_dir . $category->image);
            }
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = $category->slug . '.' . $extension;
            $file->move($path_dir, $filename);
            $category->image = $filename;
        }

        //end upload
        if ($category->save()) {
            $link = Link::where([['type', '=', 'category'], ['table_id', '=', $id]])->first();
            $link->slug = $category->slug;
            $link->save();
            return redirect()->route('category.index')->with('message', ['type' => 'success', 'msg'
            => 'Thêm mẫu tin thành công!']);
        }
        return redirect()->route('category.index')->with('message', ['type' => 'danger', 'msg'
        => 'Thêm không thành công!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);
        // lấy ra thông tin hình cần xóa
        $path_dir = "images/category/";
        $path_image_delete= public_path($path_dir . $category->image);
        //
        if ($category == null) {
            return redirect()->route('category.trash')->with('message', ['type' => 'denger', 'msg'
            => 'Mẫu tin không tông tại!']);
        }
        if ($category->delete()) {
            if(File::exists($path_image_delete))
            {
                File::delete($path_image_delete);
            }
            $link = Link::where([['type', '=', 'category'], ['table_id', '=', $id]])->first();
            $link->delete();
            return redirect()->route('category.trash')->with('message', ['type' => 'success', 'msg'
            => 'Thêm mẫu tin thành công!']);
        }
        return redirect()->route('category.trash')->with('message', ['type' => 'danger', 'msg'
        => 'Thêm không thành công!']);
    }
    ///Status///
    public function status(string $id)
    {
        $category = Category::find($id);
        if ($category == null) {
            return redirect()->route('category.index')->with('message', ['type' => 'denger', 'msg'
            => 'Mẫu tin không tông tại!']);
        }
        $category->status = ($category->status == 1) ? 2 : 1;
        $category->updated_at = date('Y-m-d H:i:s');
        $category->updated_by = 1;
        $category->save();
        return redirect()->route('category.index')->with('message', ['type' => 'success', 'msg'
        => 'Thay đổi trạng thái thành công!']);
    }
    ///DELETE///
    public function delete(string $id)
    {
        $category = Category::find($id);
        if ($category == null) {
            return redirect()->route('category.index')->with('message', ['type' => 'denger', 'msg'
            => 'Mẫu tin không tông tại!']);
        }
        $category->status = 0;
        $category->updated_at = date('Y-m-d H:i:s');
        $category->updated_by = 1;
        $category->save();
        return redirect()->route('category.index')->with('message', ['type' => 'success', 'msg'
        => 'Đã xoá thành công!']);
    }
    ///TRASH///
    public function trash()
    {
        $list_category = Category::where('status', '=', 0)->orderBy('created_at', 'desc')->get();
        return view('backend.category.trash', compact('list_category'));
    }
    ///RESTORE///
    public function restore(string $id)
    {
        $category = Category::find($id);
        if ($category == null) {
            return redirect()->route('category.trash')->with('message', ['type' => 'denger', 'msg'
            => 'Mẫu tin không tông tại!']);
        }
        $category->status = 2;
        $category->updated_at = date('Y-m-d H:i:s');
        $category->updated_by = 1;
        $category->save();
        return redirect()->route('category.trash')->with('message', ['type' => 'success', 'msg'
        => 'Thay đổi trạng thái thành công!']);
    }
}
