<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
        $list_menu = Menu::where('status', '!=', 0)->orderBy('created_at', 'desc')->get();
        return view('backend.menu.index', compact('list_menu'));
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
    public function store(MenuStoreRequest $request)
    {
        $menu = new Menu; //Tạo mới
        $menu->name = $request->name;
        $menu->slug = Str::slug($menu->name = $request->name, '-');
        $menu->metakey = $request->metakey;
        $menu->metadesc = $request->metadesc;
        $menu->parent_id = $request->parent_id;
        $menu->sort_order = $request->sort_order;
        $menu->status = $request->status;
        $menu->created_at = date('Y-m-d H:i:s');
        $menu->created_by = 1;
        //upload file 
        if ($request->has('image')) {
            $path_dir = "images/menu/";
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = $menu->slug . '.' . $extension;
            $file->move($path_dir, $filename);
            $menu->image = $filename;
        }

        //end upload
        if ($menu->save()) {
            $link = new Link();
            $link->slug = $menu->slug;
            $link->table_id = $menu->id;
            $link->type = 'menu';
            $link->save();
            return redirect()->route('menu.index')->with('message', ['type' => 'success', 'msg'
            => 'Thêm mẫu tin thành công!']);
        } else {
            return redirect()->route('menu.index')->with('message', ['type' => 'danger', 'msg'
            => 'Thêm không thành công!']);
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
            $html_parent_id .= '<option value="' . $item->id . '">' . $item->name . '</option>';
            $html_sort_order .= '<option value="' . $item->sort_order . '">Sau: ' . $item->name . '</option>';
        }
        return view('backend.menu.edit', compact('menu', 'html_parent_id', 'html_sort_order'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MenuUpdateRequest $request, string $id)
    {
        $menu = Menu::find($id); //Lấy mẫu tin
        $menu->name = $request->name;
        $menu->slug = Str::slug($menu->name = $request->name, '-');
        $menu->metakey = $request->metakey;
        $menu->metadesc = $request->metadesc;
        $menu->parent_id = $request->parent_id;
        $menu->sort_order = $request->sort_order;
        $menu->status = $request->status;
        $menu->updated_at = date('Y-m-d H:i:s');
        $menu->updated_by = 1;
        //upload file 
        if ($request->has('image')) {
            $path_dir = "images/menu/";
            if (File::Exists(public_path($path_dir . $menu->image))) {
                File::delete($path_dir . $menu->image);
            }
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = $menu->slug . '.' . $extension;
            $file->move($path_dir, $filename);
            $menu->image = $filename;
        }

        //end upload
        if ($menu->save()) {
            $link = Link::where([['type', '=', 'menu'], ['table_id', '=', $id]])->first();
            $link->slug = $menu->slug;
            $link->save();
            return redirect()->route('menu.index')->with('message', ['type' => 'success', 'msg'
            => 'Thêm mẫu tin thành công!']);
        }
        return redirect()->route('menu.index')->with('message', ['type' => 'danger', 'msg'
        => 'Thêm không thành công!']);
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
