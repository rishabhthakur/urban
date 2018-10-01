<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Activity;
use App\Review;
use App\FileSystem;
use App\Media;
use App\MediaProduct;
use App\AttributeAdataProduct;
use App\Scategory;
use App\Attribute;
use App\Adata;
use App\Stag;
use App\Brand;

class ProductController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        // return Product::orderBy('created_at', 'DESC')->get();
        return view('admin.products.index')->with([
            'products' => Product::orderBy('created_at', 'DESC')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('admin.products.create')->with([
            'medias' => Media::all(),
            'categories' => Scategory::all(),
            'tags' => Stag::all(),
            'brands' => Brand::all(),
            'attributes' => Attribute::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $this->validate($request, [
            'name' => 'required|string',
            'description' => 'required',
            'regular_price' => 'required',
            'brand' => 'required',
            'categories' => 'required',
            'tags' => 'required'
        ]);

        if ($request->regular_price <= $request->sale_price) {
            return back()->with([
                'error' => 'Regular price must be less than sale price.'
            ]);
        }

        // Check for Slug
        // if(isset($request->slug)) {
        //     $slug = $request->slug;
        // } else {
        //     $slug = str_slug($request->name);
        // }

        // Set Stock Status
        if (isset($request->stock_status)) {
            $stock_status = true;
        } else {
            if($request->quantity == 0) {
                $stock_status = false;
            } else {
                $stock_status = true;
            }
        }

        if(isset($request->reviews)) {
            $reviews = 1;
        } else {
            $reviews = 0;
        }

        if (isset($request->status)) {
            $status = 1;
        } else {
            $status = 0;
        }

        $product = Product::create([
            'p_id' => str_random(7) . time(),
            'status' => $status,
            'user_id' => Auth::id(),
            'name' => $request->name,
            'regular_price' => $request->regular_price,
            'sale_price' => $request->sale_price,
            'short_description' => $request->short_description,
            'description' => $request->description,
            'slug' => str_slug($request->name . str_random(7)),
            'brand_id' => $request->brand,
            'quantity' => $request->quantity,
            'stock_status' => $stock_status,
            'weight' => $request->weight,
            'length' => $request->length,
            'width' => $request->width,
            'height' => $request->height,
            'purchase_note' => $request->purchase_note,
            'reviews' => $reviews
        ]);

        // Add media function
        if (isset($request->medias)) {
            $this->addMedia($request->medias, $product->id);
        } elseif ($request->images) {
            $this->addImages($request->images, $product->id);
        }


        // Product Tags, Categories and Sizes Register into Database
        $product->categories()->attach($request->categories);
        $product->tags()->attach($request->tags);

        // Product Attributes
        if(isset($request->data)) {
            foreach($request->data as $data) {
                $attrb_id = Adata::find($data)->attrb_id;
                $product->adata()->attach($data);
                $product->attributes()->attach($attrb_id);
            }
        }

        $this->logActivity($product->name);

        return redirect(route('admin.products'))->with([
            'success' => 'New product added.'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    private function addImages($media_input, $product_id) {
        $medias = $media_input;
        foreach ($medias as $media) {

            $dir = FileSystem::where('name', 'products')->first();

            // Product Image Re-location and Re-naming
            $media_new_name = time().$media->getClientOriginalName();
            $media->move('uploads/products', $media_new_name);
            $murl = 'uploads/'. $dir->name . '/' . $media_new_name;
            $mpath = public_path('uploads/'. $dir->name) . '/' . $media_new_name;

            // Enter Media Data to Database
            $prmedia = Media::create([
                'name' => $media_new_name,
                'user_id' => Auth::id(),
                'dir_id' => $dir->id,
                'name' => $media_new_name,
                'slug' => $murl,
                'url' => $murl,
                'size' => number_format(filesize($mpath) * .0009765625),
                'mime_type' => $media->getClientMimeType(),
                'dimensions' => getimagesize($murl)[0] . ' x ' . getimagesize($murl)[1],
            ]);

            // Enter Data into MediaProduct Pivot Table
            MediaProduct::create([
                'media_id' => $prmedia->id,
                'product_id' => $product_id,
            ]);
        }
    }

    private function addMedia($media_input, $product_id) {
        $medias = $media_input;
        foreach ($medias as $media) {
            // Enter Data into MediaProduct Pivot Table
            MediaProduct::create([
                'media_id' => $media,
                'product_id' => $product_id,
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    private function logActivity($product_name) {
        Activity::create([
            'user_id' => Auth::Id(),
            'model' => 'ProductModel',
            'task' => 'added new product ' . $product_name
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $slug
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug) {
        $this->validate($request, [
            'name' => 'required|string',
            'description' => 'required',
            'regular_price' => 'required',
            'brand' => 'required',
            'categories' => 'required',
            'tags' => 'required'
        ]);

        $product = Product::where('slug', $slug);

        // Check for Slug
        // if(isset($request->slug)) {
        //     $slug = $request->slug;
        // } else {
        //     $slug = str_slug($request->name);
        // }

        // Set Stock Status
        if (isset($request->stock_status)) {
            $stock_status = true;
        } else {
            if($request->quantity == 0) {
                $stock_status = false;
            } else {
                $stock_status = true;
            }
        }

        $product = Product::create([
            'name' => $request->name,
            'regular_price' => $request->regular_price,
            'sale_price' => $request->sale_price,
            'short_description' => $request->short_description,
            'description' => $request->description,
            'slug' => str_slug($request->name . str_random(7)),
            'brand_id' => $request->brand,
            'quantity' => $request->quantity,
            'stock_status' => $stock_status,
            'weight' => $request->weight,
            'length' => $request->length,
            'width' => $request->width,
            'height' => $request->height
        ]);

        // Add media function
        if (isset($request->medias)) {
            $this->addMedia($request->medias, $product->id);
        } elseif ($request->images) {
            $this->addImages($request->images, $product->id);
        }


        // Product Tags, Categories and Sizes Register into Database
        $product->categories()->attach($request->categories);
        $product->tags()->attach($request->tags);
        // $product->genders()->attach($genders);
        // if(isset($request->sizes)) {
        //     $product->sizes()->attach($request->sizes);
        // }

        $this->logActivity($product->name);

        return redirect(route('admin.products'))->with([
            'success' => 'New product added.'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
