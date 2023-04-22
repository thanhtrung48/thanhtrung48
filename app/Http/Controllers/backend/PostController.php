<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Link;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use App\Http\Requests\PostStoreRequest;
use App\Http\Requests\PostUpdateRequest;
use Illuminate\Validation\Rules\Exists;

class PostController extends Controller
{

    public function index()
    {
        $list_post = Post::where('status', '!=', 0)->orderBy('created_at', 'desc')->get();
        return view('backend.post.index', compact('list_post'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $list_post = Post::where('status', '!=', 0)->get();
        $html_parent_id = '';
        $html_sort_order = '';
        foreach ($list_post as $item) {
            $html_parent_id .= '<option value="' . $item->id . '">' . $item->name . '</option>';
            $html_sort_order .= '<option value="' . $item->sort_order . '">Sau: ' . $item->name . '</option>';
        }
        return view('backend.post.create', compact('html_parent_id', 'html_sort_order'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(postStoreRequest $request)
    {
        $post = new Post; //Tạo mới
        $post->name = $request->name;
        $post->slug = Str::slug($post->name = $request->name, '-');
        $post->metakey = $request->metakey;
        $post->metadesc = $request->metadesc;
        $post->parent_id = $request->parent_id;
        $post->sort_order = $request->sort_order;
        $post->status = $request->status;
        $post->created_at = date('Y-m-d H:i:s');
        $post->created_by = 1;
        //upload file 
        if ($request->has('image')) {
            $path_dir = "images/post/";
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = $post->slug . '.' . $extension;
            $file->move($path_dir, $filename);
            $post->image = $filename;
        }

        //end upload
        if ($post->save()) {
            $link = new Link();
            $link->slug = $post->slug;
            $link->table_id = $post->id;
            $link->type = 'post';
            $link->save();
            return redirect()->route('post.index')->with('message', ['type' => 'success', 'msg'
            => 'Thêm mẫu tin thành công!']);
        } else {
            return redirect()->route('post.index')->with('message', ['type' => 'danger', 'msg'
            => 'Thêm không thành công!']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::find($id);
        if ($post == null) {
            return redirect()->route('post.index')->with('message', ['type' => 'denger', 'msg'
            => 'Mẫu tin không tông tại!']);
        } else {
            return view('backend.post.show', compact('post'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = Post::find($id);
        $list_post = Post::where('status', '!=', 0)->get();
        $html_parent_id = '';
        $html_sort_order = '';
        foreach ($list_post as $item) {
            $html_parent_id .= '<option value="' . $item->id . '">' . $item->name . '</option>';
            $html_sort_order .= '<option value="' . $item->sort_order . '">Sau: ' . $item->name . '</option>';
        }
        return view('backend.post.edit', compact('post', 'html_parent_id', 'html_sort_order'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostUpdateRequest $request, string $id)
    {
        $post = Post::find($id); //Lấy mẫu tin
        $post->name = $request->name;
        $post->slug = Str::slug($post->name = $request->name, '-');
        $post->metakey = $request->metakey;
        $post->metadesc = $request->metadesc;
        $post->parent_id = $request->parent_id;
        $post->sort_order = $request->sort_order;
        $post->status = $request->status;
        $post->updated_at = date('Y-m-d H:i:s');
        $post->updated_by = 1;
        //upload file 
        if ($request->has('image')) {
            $path_dir = "images/post/";
            if (File::Exists(public_path($path_dir . $post->image))) {
                File::delete($path_dir . $post->image);
            }
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = $post->slug . '.' . $extension;
            $file->move($path_dir, $filename);
            $post->image = $filename;
        }

        //end upload
        if ($post->save()) {
            $link = Link::where([['type', '=', 'post'], ['table_id', '=', $id]])->first();
            $link->slug = $post->slug;
            $link->save();
            return redirect()->route('post.index')->with('message', ['type' => 'success', 'msg'
            => 'Thêm mẫu tin thành công!']);
        }
        return redirect()->route('post.index')->with('message', ['type' => 'danger', 'msg'
        => 'Thêm không thành công!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::find($id);
        // lấy ra thông tin hình cần xóa
        $path_dir = "images/post/";
        $path_image_delete = public_path($path_dir . $post->image);
        //
        if ($post == null) {
            return redirect()->route('post.trash')->with('message', ['type' => 'denger', 'msg'
            => 'Mẫu tin không tông tại!']);
        }
        if ($post->delete()) {
            if (File::exists($path_image_delete)) {
                File::delete($path_image_delete);
            }
            $link = Link::where([['type', '=', 'post'], ['table_id', '=', $id]])->first();
            $link->delete();
            return redirect()->route('post.trash')->with('message', ['type' => 'success', 'msg'
            => 'Thêm mẫu tin thành công!']);
        }
        return redirect()->route('post.trash')->with('message', ['type' => 'danger', 'msg'
        => 'Thêm không thành công!']);
    }
    ///Status///
    public function status(string $id)
    {
        $post = Post::find($id);
        if ($post == null) {
            return redirect()->route('post.index')->with('message', ['type' => 'denger', 'msg'
            => 'Mẫu tin không tông tại!']);
        }
        $post->status = ($post->status == 1) ? 2 : 1;
        $post->updated_at = date('Y-m-d H:i:s');
        $post->updated_by = 1;
        $post->save();
        return redirect()->route('post.index')->with('message', ['type' => 'success', 'msg'
        => 'Thay đổi trạng thái thành công!']);
    }
    ///DELETE///
    public function delete(string $id)
    {
        $post = Post::find($id);
        if ($post == null) {
            return redirect()->route('post.index')->with('message', ['type' => 'denger', 'msg'
            => 'Mẫu tin không tông tại!']);
        }
        $post->status = 0;
        $post->updated_at = date('Y-m-d H:i:s');
        $post->updated_by = 1;
        $post->save();
        return redirect()->route('post.index')->with('message', ['type' => 'success', 'msg'
        => 'Đã xoá thành công!']);
    }
    ///TRASH///
    public function trash()
    {
        $list_post = Post::where('status', '=', 0)->orderBy('created_at', 'desc')->get();
        return view('backend.post.trash', compact('list_post'));
    }
    ///RESTORE///
    public function restore(string $id)
    {
        $post = Post::find($id);
        if ($post == null) {
            return redirect()->route('post.trash')->with('message', ['type' => 'denger', 'msg'
            => 'Mẫu tin không tông tại!']);
        }
        $post->status = 2;
        $post->updated_at = date('Y-m-d H:i:s');
        $post->updated_by = 1;
        $post->save();
        return redirect()->route('post.trash')->with('message', ['type' => 'success', 'msg'
        => 'Thay đổi trạng thái thành công!']);
    }
}
