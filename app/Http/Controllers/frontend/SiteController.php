<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Link;
use App\Models\Product;
use App\Models\Post;

class SiteController extends Controller
{
    public function index($slug = null)
    {
        if ($slug == null) {
            return $this->home();
        } else {
            $link = Link::where('slug', '=', $slug)->first();
            if ($link == null) {
                $product = Product::Where([['status', '=', '1'], ['slug', '=', $slug]])->first();
                if ($product != null) {
                    return $this->product_detail($product);
                } else {
                    $args = [
                        ['status', '=', '1'],
                        ['slug', '=', $slug],
                        ['type', '=', 'post']
                    ];
                    $post = Post::where($args)->first();
                    if ($post != null) {
                        return $this->post_detail($post);
                    }
                    else{
                        return $this->error_404($slug);
                    }
                }
            } else {
                $type = $link->type;
                switch ($type) {
                    case 'category': {
                            return $this->product_category($slug);
                        }
                    case 'brand': {
                            return $this->product_brand($slug);
                        }
                    case 'topic': {
                            return $this->post_topic($slug);
                        }
                    case 'page': {
                            return $this->post_page($slug);
                        }
                }
            }
        }
    }
    public function home()
    {
        return view('frontend.home');
    }
    public function product_category($slug)
    {
        return view('frontend.product-category');
    }
    public function product_brand($slug)
    {
        return view('frontend.product-brand');
    }
    public function post_topic($slug)
    {
        return view('frontend.post-topic');
    }
    public function post_page($slug)
    {
        return view('frontend.post-page');
    }
    public function product_detail($product)
    {
        return view('frontend.product-detail');
    }
    public function post_detail($post)
    {
        return view('frontend.post-detail');
    }
    public function error_404($slug)
    {
        return view('frontend.404');
    }
}
