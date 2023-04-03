<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\category;

class CategoryController extends Controller
{

    public function index()
    {
        $list_category = Category::where('status','!=',0)->get();
        return view('backend.category.index',compact('list_category'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::find($id);
        if ($category == null) {
            return redirect()->route('category.index')->with('message',['type'=>'danger','msg' 
            =>'Mẫu tin không tồn tại!']);
        }else{
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
    //GET:admin/category/status/1
    public function status($id)
    {
        $category = Category::find($id);
         if ($category == null) {
            return redirect()->route('category.index')->with('message',['type'=>'danger','msg' 
            =>'Mẫu tin không tồn tại!']);
        }else{
            $category->status = ($category->status ==  1) ? 2 : 1;
            $category->updated_by = date('y-m-d H:i:s');
            $category->updated_by = 1;
            $category->save();
            return redirect()->route('category.index')->with('message',['type'=>'success','msg' 
            =>'Thay đổi trang thái thành công!']);
        }
     }
       //GET:admin/category/delete/1
    public function delete($id)
    {
        $category = Category::find($id);
         if ($category == null) {
            return redirect()->route('category.index')->with('message',['type'=>'danger','msg' 
            =>'Mẫu tin không tồn tại!']);
        }else{
            $category->status = 0;
            $category->updated_by = date('y-m-d H:i:s');
            $category->updated_by = 1;
            $category->save();
            return redirect()->route('category.index')->with('message',['type'=>'success','msg' 
            =>'Xóa vào thùng rác thành công!']);
        }
     }
}
