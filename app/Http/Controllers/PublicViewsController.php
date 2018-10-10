<?php

namespace Urban\Http\Controllers;

use Cart;

use Urban\Dsettings;
use Urban\Attribute;
use Urban\Post;
use Urban\User;
use Urban\Tag;
use Urban\Brand;
use Urban\Adata;
use Urban\Product;
use Urban\Category;
use Urban\Activity;
use Urban\Settings;
use Illuminate\Http\Request;
use Laravel\Scout\Searchable;
use Illuminate\Support\Facades\Auth;

use Illuminate\Database\Schema\Blueprint;

class PublicViewsController extends Controller {

    use Searchable;

    public function __construct() {
        //
    }

    public function index() {
        // Cart::clear();
        $products = new Product;
        return view('welcome')->with([
            'latest' => $products::where('popular', true)->latest()->take(7)->get()
        ]);
    }

    public function shop() {

        $pagination = 9;
        $products = Product::latest();

        if (request()->category) {
            $products = Product::with('categories')->whereHas('categories', function($query) {
                $query->where('belongs_to', 'product')->where('slug', request()->category);
            });
        } else {
            $products = $products;
        }

        if(request()->brand) {
            $products = Product::with('brand')->whereHas('brand', function($query) {
                $query->where('slug', request()->brand);
            });
        } else {
            $products = $products;
        }

        switch (request()->sort) {
            case 'newest':
                $products = $products->orderBy('created_at', 'DESC')->paginate($pagination);
                break;
            case 'low_high':
                $products = $products->orderBy('regular_price')->paginate($pagination);
                break;
            case 'high_low':
                $products = $products->orderBy('regular_price', 'DESC')->paginate($pagination);
                break;
            default:
                $products = $products->paginate($pagination);
                break;
        }

        return view('shop')->with([
            'products' => $products,
            'categories' => Category::where('belongs_to', 'product')
                                    ->where('parent_id', 0)
                                    ->get(),
            'brands' => Brand::all(),
            'tags', Tag::where('belongs_to', 'product')->get(),
            'colors' => Adata::where('attrb_id', Attribute::where('name', 'color')->first()->id)->get()
        ]);
    }

    public function checkWishlist($id) {
        $wishlist = app('wishlist')->session(Auth::id());
        if (!$wishlist->isEmpty()) {
            $items = $wishlist->getContent();
            foreach ($items as $item) {
                if ($item->p_id === $id) {
                    return true;
                } else {
                    return false;
                }
            }
        }
    }

    public function product($slug) {
        $product = Product::where('slug', $slug)->first();
        if ($this->checkWishlist($product->id)) {
            $wishlist = true;
        } else {
            $wishlist = false;
        }
        return view('product')->with([
            'product' => $product,
            'wishlist' => $wishlist
        ]);
    }

    public function about() {
        return view('about');
    }

    public function blog() {
        $posts = Post::latest();

        if (request()->category) {
            $posts = Post::with('categories')->whereHas('categories', function($query) {
                $query->where('belongs_to', 'post')->where('slug', request()->category);
            });
        } else {
            $posts = $posts;
        }

        if (request()->tag) {
            $posts = Post::with('tags')->whereHas('tags', function($query) {
                $query->where('belongs_to', 'post')->where('slug', request()->tag);
            });
        } else {
            $posts = $posts;
        }

        if (request()->author) {
            $user = User::where('slug', request()->author)->first()->id;
            $posts = Post::where('user_id', $user);
        } else {
            $posts = $posts;
        }

        return view('blog')->with([
            'posts' => $posts->where('status', 1)
                            ->where('visibility', 1)
                            ->get(),
            'categories' => Category::where('belongs_to', 'post')
                                    ->get(),
            'tags' => Tag::where('belongs_to', 'post')
                                    ->get()
        ]);
    }

    public function post($slug) {
        return view('post')->with([
            'post' => Post::where('slug', $slug)->first(),
            'dsettings' => Dsettings::first()
        ]);
    }

    public function contact() {
        return view('contact');
    }

    public function privacy() {
        return view('privacy');
    }

    public function terms() {
        return view('terms');
    }

    public function cart() {
        return view('cart');
    }

    public function checkout() {
        if (count(Cart::getContent()) != 0) {
            return view('checkout')->with([
                'bill' => Auth::user()->addresses->where('type', 'billing')->first(),
            ]);
        } else {
            return redirect(route('cart'))->with([
                'error' => 'Your shopping cart is empty'
            ]);
        }
    }

    public function thankyou(Request $request) {
        if ($request->confirmed) {
            Cart::clear();
            return view('thankyou');
        } else {
            return redirect(route('home'));
        }
    }
}
