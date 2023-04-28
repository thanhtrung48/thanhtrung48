<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Topic;
use App\Models\Post;
use App\Models\Menu;
use App\Models\Link;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use App\Http\Requests\MenuStoreRequest;
use App\Http\Requests\MenuUpdateRequest;
use Illuminate\Validation\Rules\Exists;

class MenuController extends Controller
{

    public function index()
    {
        $list_category = Category::where('status', '!=', 0)->orderBy('created_at', 'desc')->get();
        $list_brand = Brand::where('status', '!=', 0)->orderBy('created_at', 'desc')->get();
        $list_topic = Topic::where('status', '!=', 0)->orderBy('created_at', 'desc')->get();
        $list_page = Post::where([['status', '!=', 0], ['type', '=', 'page']])->orderBy('created_at', 'desc')->get();
        $list_menu = Menu::where('status', '!=', 0)->orderBy('created_at', 'desc')->get();
        return view('backend.menu.index', compact('list_category', 'list_brand', 'list_topic', 'list_page', 'list_menu'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $list_menu = Menu::where('status', '!=', 0)->get();
        $html_parent_id = '';
        $html_sort_order = '';
        foreach ($list_menu as $item) {
            $html_parent_id .= '<option value="' . $item->id . '">' . $item->name . '</option>';
            $html_sort_order .= '<option value="' . $item->sort_order . '">Sau: ' . $item->name . '</option>';
        }
        return view('backend.menu.create', compact('html_parent_id', 'html_sort_order'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (isset($request->ADDCATEGORY)) {
            $list_id = $request->checkIdCategory;
            foreach ($list_id as $id) {
                $category = Category::find($id);
                $menu = new Menu();
                $menu->name = $category->name;
                $menu->link = $category->slug;
                $menu->table_id = $id;
                $menu->parent_id = 0;
                $menu->sort_order = 1;
                $menu->type = 'category';
                $menu->position = $request->position;
                $menu->status = 2;
                $menu->created_at = date('Y-m-d H:i:s');
                $menu->created_by = 1;
                $menu->save();
            }
            return redirect()->route('menu.index')->with('message', ['type' => 'success', 'msg'
            => 'Thêm menu thành công!']);
        }
        //add brand
        if (isset($request->ADDBRAND)) {
            $list_id = $request->checkIdBrand;
            foreach ($list_id as $id) {
                $brand = Brand::find($id);
                $menu = new Menu();
                $menu->name = $brand->name;
                $menu->link = $brand->slug;
                $menu->table_id = $id;
                $menu->parent_id = 0;
                $menu->sort_order = 1;
                $menu->type = 'brand';
                $menu->position = $request->position;
                $menu->status = 2;
                $menu->created_at = date('Y-m-d H:i:s');
                $menu->created_by = 1;
                $menu->save();
            }
            return redirect()->route('menu.index')->with('message', ['type' => 'success', 'msg'
            => 'Thêm thương hiệu thành công!']);
        }
        // add topic
        if (isset($request->ADDTOPIC)) {
            $list_id = $request->checkIdTopic;
            foreach ($list_id as $id) {
                $topic = Topic::find($id);
                $menu = new Menu();
                $menu->name = $topic->name;
                $menu->link = $topic->slug;
                $menu->table_id = $id;
                $menu->parent_id = 0;
                $menu->sort_order = 1;
                $menu->type = 'topic';
                $menu->position = $request->position;
                $menu->status = 2;
                $menu->created_at = date('Y-m-d H:i:s');
                $menu->created_by = 1;
                $menu->save();
            }
            return redirect()->route('menu.index')->with('message', ['type' => 'success', 'msg'
            => 'Thêm chủ đề thành công!']);
        }
        // add page
        if (isset($request->ADDPAGE)) {
            $list_id = $request->checkIdPage;
            foreach ($list_id as $id) {
                $page = Post::find($id);
                $menu = new Menu();
                $menu->name = $page->name;
                $menu->link = $page->slug;
                $menu->table_id = $id;
                $menu->parent_id = 0;
                $menu->sort_order = 1;
                $menu->type = 'page';
                $menu->position = $request->position;
                $menu->status = 2;
                $menu->created_at = date('Y-m-d H:i:s');
                $menu->created_by = 1;
                $menu->save();
            }
            return redirect()->route('menu.index')->with('message', ['type' => 'success', 'msg'
            => 'Thêm trang thành công!']);
        }
        //custom
        if (isset($request->ADDCUSTOM)) {
            $menu = new Menu();
            $menu->name = $request->name;
            $menu->link = $request->link;
            $menu->parent_id = 0;
            $menu->sort_order = 1;
            $menu->type = 'custom';
            $menu->position = $request->position;
            $menu->status = 2;
            $menu->created_at = date('Y-m-d H:i:s');
            $menu->created_by = 1;
            $menu->save();
            return redirect()->route('menu.index')->with('message', ['type' => 'success', 'msg'
            => 'Thêm liên kết thành công!']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $menu = Menu::find($id);
        if ($menu == null) {
            return redirect()->route('menu.index')->with('message', ['type' => 'denger', 'msg'
            => 'Mẫu tin không tông tại!']);
        } else {
            return view('backend.menu.show', compact('menu'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $menu = Menu::find($id);
        $list_menu = Menu::where('status', '!=', 0)->get();
        $html_parent_id = '';
        $html_sort_order = '';
        foreach ($list_menu as $item) {
            if ($menu->parent_id == $item->id) {
                $html_parent_id .= '<option selected value="' . $item->id . '">' . $item->name . '</option>';
            } else {
                $html_parent_id .= '<option value="' . $item->id . '">' . $item->name . '</option>';
            }
            if ($menu->sort_order == $item->sort_order) {
                $html_sort_order .= '<option selected value="' . $item->sort_order . '">Sau: ' . $item->name . '</option>';
            } else {
                $html_sort_order .= '<option value="' . $item->sort_order . '">Sau: ' . $item->name . '</option>';
            }
        }
        return view('backend.menu.edit', compact('menu', 'html_parent_id', 'html_sort_order'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $menu = Menu::find($id);
        $menu->name = $request->name;
        $menu->link = $request->link;
        $menu->parent_id = $request->parent_id;
        $menu->sort_order = $request->sort_order +1;
        //$menu->position = $request->position;
        $menu->status =  $request->status;
        $menu->updated_at = date('Y-m-d H:i:s');
        $menu->updated_by = 1;
        $menu->save();
        return redirect()->route('menu.index')->with('message', ['type' => 'success', 'msg'
        => 'Thêm liên kết thành công!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $menu = Menu::find($id);
        // lấy ra thông tin hình cần xóa
        $path_dir = "images/menu/";
        $path_image_delete = public_path($path_dir . $menu->image);
        //
        if ($menu == null) {
            return redirect()->route('menu.trash')->with('message', ['type' => 'denger', 'msg'
            => 'Mẫu tin không tông tại!']);
        }
        if ($menu->delete()) {
            if (File::exists($path_image_delete)) {
                File::delete($path_image_delete);
            }
            $link = Link::where([['type', '=', 'menu'], ['table_id', '=', $id]])->first();
            $link->delete();
            return redirect()->route('menu.trash')->with('message', ['type' => 'success', 'msg'
            => 'Thêm mẫu tin thành công!']);
        }
        return redirect()->route('menu.trash')->with('message', ['type' => 'danger', 'msg'
        => 'Thêm không thành công!']);
    }
    ///Status///
    public function status(string $id)
    {
        $menu = Menu::find($id);
        if ($menu == null) {
            return redirect()->route('menu.index')->with('message', ['type' => 'denger', 'msg'
            => 'Mẫu tin không tông tại!']);
        }
        $menu->status = ($menu->status == 1) ? 2 : 1;
        $menu->updated_at = date('Y-m-d H:i:s');
        $menu->updated_by = 1;
        $menu->save();
        return redirect()->route('menu.index')->with('message', ['type' => 'success', 'msg'
        => 'Thay đổi trạng thái thành công!']);
    }
    ///DELETE///
    public function delete(string $id)
    {
        $menu = Menu::find($id);
        if ($menu == null) {
            return redirect()->route('menu.index')->with('message', ['type' => 'denger', 'msg'
            => 'Mẫu tin không tông tại!']);
        }
        $menu->status = 0;
        $menu->updated_at = date('Y-m-d H:i:s');
        $menu->updated_by = 1;
        $menu->save();
        return redirect()->route('menu.index')->with('message', ['type' => 'success', 'msg'
        => 'Đã xoá thành công!']);
    }
    ///TRASH///
    public function trash()
    {
        $list_menu = Menu::where('status', '=', 0)->orderBy('created_at', 'desc')->get();
        return view('backend.menu.trash', compact('list_menu'));
    }
    ///RESTORE///
    public function restore(string $id)
    {
        $menu = Menu::find($id);
        if ($menu == null) {
            return redirect()->route('menu.trash')->with('message', ['type' => 'denger', 'msg'
            => 'Mẫu tin không tông tại!']);
        }
        $menu->status = 2;
        $menu->updated_at = date('Y-m-d H:i:s');
        $menu->updated_by = 1;
        $menu->save();
        return redirect()->route('menu.trash')->with('message', ['type' => 'success', 'msg'
        => 'Thay đổi trạng thái thành công!']);
    }
}
