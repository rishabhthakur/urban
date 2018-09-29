<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\SKUGenerator;
// use Nicolaslopezj\Searchable\SearchableTrait;

class Product extends Model {

    use SoftDeletes;
    use SKUGenerator;
    // use SearchableTrait;

    // protected $searchable = [
    //     /**
    //     * Columns and their priority in search results.
    //     * Columns with higher values are more important.
    //     * Columns with equal values have equal importance.
    //     *
    //     * @var array
    //     */
    //     'columns' => [
    //         'products.name' => 10,
    //         'products.description' => 2,
    //         'products.regular_price' => 5,
    //         'products.sale_price' => 2
    //     ],
    //         'joins' => [
    //         'brands' => ['products.brand_id','brands.id'],
    //     ],
    // ];

    protected $dates = [
        'deteled_at'
    ];

    protected $fillable = [
        'name',
        'regular_price',
        'sale_price',
        'short_description',
        'description',
        'sku',
        'slug',
        'brand_id',
        'quantity',
        'stock_status',
        'weight',
        'length',
        'width',
        'height',
        'purchase_note',
        'reviews'
    ];

    public function categories() {
        return $this->belongsToMany('App\Scategory');
    }

    public function tags() {
        return $this->belongsToMany('App\Stag');
    }

    public function reviews() {
        return $this->hasMany('App\Review');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function brand() {
        return $this->belongsTo('App\Brand');
    }

    public function sizes() {
        return $this->belongsToMany('App\Size');
    }

    public function colors() {
        return $this->belongsToMany('App\Color');
    }

    public function wishlists() {
        return $this->belongsToMany('App\Wishlist');
    }

    public function orders() {
        return $this->belongsToMany('App\Order');
    }

    public function medias() {
        return $this->belongsToMany('App\Media');
    }

    public function getLowStock() {
        foreach ($this->all() as $product) {
            if($product->quantity < 2) {
                return $lowStock = [
                    'name' => $product->name
                ];
            }
        }
    }

    public function getOutOfStock() {
        foreach ($this->all() as $product) {
            if($product->quantity == 0) {
                return $outStock = [
                    'name' => $product->name
                ];
            }
        }
    }
}
