<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use App\Activity;
use App\FileSystem;
use App\MediaProduct;
use App\Scategory;
use App\Attribute;
use App\Stag;
use App\Brand;
use App\Media;

class ProductController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.products.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('admin.products.create')->with([
            'categories' => Scategory::all(),
            'tags' => Stag::all(),
            'brands' => Brand::all(),
            'attributes' => Attribute::where('parent_id', null)->get()
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
            'name' => 'required',
            'description' => 'required',
            'regular_price' => 'required',
            'brand' => 'required',
            'categories' => 'required',
            'tags' => 'required',
            'quantity' => 'required'
        ]);

        // Check for Slug
        if(isset($request->slug)) {
            $slug = $request->slug;
        } else {
            $slug = str_slug($request->name);
        }

        // Check for Gender
        if(isset($request->genders)) {
            $genders = $request->genders;
        } else {
            $genders = 3;
        }

        // Set Stock Status
        if($request->quantity == 0) {
            $stock_status = false;
        } else {
            $stock_status = true;
        }

        $product = Product::create([
            'name' => $request->name,
            'regular_price' => $request->regular_price,
            'sale_price' => $request->sale_price,
            'short_description' => $request->short_description,
            'description' => $request->description,
            'slug' => $slug,
            'brand_id' => $request->brand,
            'quantity' => $request->quantity,
            'stock_status' => $stock_status,
            'weight' => $request->weight,
            'length' => $request->length,
            'width' => $request->width,
            'height' => $request->height
        ]);

        // Add media function
        $this->addMedia($request->images, $products->id);

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
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    private function addMedia($media_input, $product_id) {
        if(isset($media_input)) {
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
        } else {
            $medias = $media_input;
            foreach ($medias as $media) {
                // Enter Data into MediaProduct Pivot Table
                MediaProduct::create([
                    'media_id' => $media,
                    'product_id' => $product_id,
                ]);
            }
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
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
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
