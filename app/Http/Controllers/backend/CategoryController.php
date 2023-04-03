<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\category;

class CategoryController extends Controller
{

    public function index()
    {
        $list_category = Category::where('status', '!=', 0)->get();
        return view('backend.category.index',compact('list_category'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $list_category = Category::where('status', '!=', 0)->get();
        $html_parent_id = '';
        $html_sort_orders = '';
        foreach ($list_category as $item) {
            $html_parent_id .= '<option value="' . $item->id . '">' . $item->name . '</option>';
            $html_sort_orders .= '<option value="' . $item->sort_orders . '"> Sau ' . $item->name . '</option>';
        }
        return view('backend.category.create', compact('html_parent_id', 'html_sort_orders'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $category = new Category;
        $category->name = $request->name;
        $category->slug = Str::slug($category->name = $request->name, '-');
        $category->metakey = $request->metakey;
        $category->metadesc = $request->metadesc;
        $category->parent_id = $request->parent_id;
        $category->sort_orders = $request->sort_orders;
        $category->status = $request->status;
        $category->save();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::find($id);
        if ($category == null) {
            return Redirect()->route('category.index')->with('message', ['type' => 'danger', 'msg'
            => 'Mẫu tin không tồn tại']);
        } else{
            return view('backend.category.show',compact('category'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(string $id)
    {
        //
    }
    public function status($id)
    {
        $category = Category::find($id);
        if ($category == null) {
            return Redirect()->route('category.index')->with('message', ['type' => 'danger', 'msg'
            => 'Mẫu tin không tồn tại']);
        } else {
            $category->status = ($category->status == 1) ? 2 : 1;
            $category->updated_at = date('y-m-d H:i:s');
            $category->updated_by = 1;
            $category->save();
            return redirect()->route('category.index')->with('message', ['type' => 'success', 'msg'
            => 'Thay đổi trạng thái thành công!']);
        }
    }
    public function delete($id)
    {
        $category = Category::find($id);
        if ($category == null) {
            return Redirect()->route('category.index')->with('message', ['type' => 'danger', 'msg'
            => 'Mẫu tin không tồn tại']);
        } else {
            $category->status = 0;
            $category->updated_at = date('y-m-d H:i:s');
            $category->updated_by = 1;
            $category->save();
            return redirect()->route('category.index')->with('message', ['type' => 'success', 'msg'
            => 'Xóa vào thùng rác thành công!']);
        }
    }
}
