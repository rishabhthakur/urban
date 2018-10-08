<?php

namespace Urban\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Urban\AttributeAdataProduct;
use Illuminate\Http\Request;
use Urban\MediaProduct;
use Urban\AttributeProduct;
use Urban\Settings;
use Urban\FileSystem;
use Urban\Attribute;
use Urban\Category;
use Urban\Activity;
use Urban\Product;
use Urban\Review;
use Urban\Media;
use Urban\Adata;
use Urban\Brand;
use Urban\Tag;

class ProductController extends Controller {
    private $settings;

    public function __construct() {
        $this->settings = Settings::first();
    }

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
            'medias' => Media::where('dir_id', Settings::first()->product_dir)->get(),
            'categories' => Category::where('belongs_to', 'product')->get(),
            'tags' => Tag::where('belongs_to', 'product')->get(),
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
            'p_id' => str_random(4),
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

        // Product Categories
        $product->categories()->attach($request->categories);

        // Product Tags
        $product->tags()->attach($request->tags);

        // Product Attributes
        if (isset($request->attrbs)) {
            $product->attributes()->attach($request->attrbs);
            if(isset($request->data)) {
                $product->adata()->attach($request->data);
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
     * @param  \Urban\Product  $product
     * @return \Illuminate\Http\Response
     */
    private function addImages($media_input, $product_id) {
        $medias = $media_input;
        foreach ($medias as $media) {

            $dir = FileSystem::find($this->settings->product_dir);

            // Product Image Re-location and Re-naming
            $media_new_name = time().$media->getClientOriginalName();
            // Check for Uploads Directory and Make Products Directory
            if(!is_dir(public_path('uploads/'. $dir->name))) {
                mkdir(public_path('uploads/'. $dir->name));
            }
            $media->move('uploads/'. $dir->name, $media_new_name);
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
     * @param  \Urban\Product  $product
     * @return \Illuminate\Http\Response
     */
    private function logActivity($product_name) {
        $model = 'Urban\Product';
        $task = 'added new product ';
        $item = $product_name;
        $activity = new Activity;
        $activity->registerActivity($model, $task, $item);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Urban\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        return view('admin.products.edit')->with([
            'product' => Product::find($id),
            'medias' => Media::where('dir_id', Settings::first()->product_dir)->get(),
            'categories' => Category::where('belongs_to', 'product')->get(),
            'tags' => Tag::where('belongs_to', 'product')->get(),
            'brands' => Brand::all(),
            'attributes' => Attribute::all(),
            'edit' => true
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Urban\Product  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
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

        $product = Product::fins($id);
        $product->status = $status;
        $product->name = $request->name;
        $product->regular_price = $request->regular_price;
        $product->sale_price = $request->sale_price;
        $product->short_description = $request->short_description;
        $product->description = $request->description;
        $product->slug = str_slug($request->name . str_random(7));
        $product->brand_id = $request->brand;
        $product->quantity = $request->quantity;
        $product->stock_status = $stock_status;
        $product->weight = $request->weight;
        $product->length = $request->length;
        $product->width = $request->width;
        $product->height = $request->height;
        $product->purchase_note = $request->purchase_note;
        $product->reviews = $reviews;
        $product->save();

        // Add media function
        if (isset($request->medias)) {
            $this->addMedia($request->medias, $product->id);
        } elseif ($request->images) {
            $this->addImages($request->images, $product->id);
        }

        // Product Categories
        if (isset($request->categories)) {
            $product->categories()->attach($request->categories);
        }

        // Product Tags
        if (isset($request->tags)) {
            $product->tags()->attach($request->tags);
        }

        // Product Attributes
        if (isset($request->attrbs)) {
            $product->attributes()->attach($request->attrbs);
            if(isset($request->data)) {
                $product->adata()->attach($request->data);
            }
        }

        return redirect(route('admin.products'))->with([
            'success' => 'Produt details updated.'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Urban\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
