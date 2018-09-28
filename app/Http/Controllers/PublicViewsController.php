<?php

namespace App\Http\Controllers;

use Cart;
use App\Stag;
use App\Brand;
use App\Product;
use App\Scategory;
use App\Activity;
use App\Settings;
use Illuminate\Http\Request;
use Laravel\Scout\Searchable;
use Illuminate\Support\Facades\Auth;

class PublicViewsController extends Controller {

    use Searchable;

    public function __construct() {
        //
    }

    public function index() {
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
                $query->where('slug', request()->category);
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
                $products = $products->orderBy('regular_price', 'desc')->paginate($pagination);
                break;
            default:
                $products = $products->paginate($pagination);
                break;
        }

        return view('shop')->with([
            'products' => $products,
            'categories' => Scategory::where('parent_id', 0)->get(),
            'brands' => Brand::all(),
            'tags', Stag::all()
        ]);
    }

    public function product($slug) {
        return view('product')->with([
            'product' => Product::where('slug', $slug)->first()
        ]);
    }

    public function about() {
        return view('about');
    }

    public function blog() {
        return view('blog');
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
            return view('checkout');
        } else {
            return redirect(route('cart'))->with([
                'error' => 'Your shopping cart is empty'
            ]);
        }
    }
}
