<?php

namespace Urban;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
// use Nicolaslopezj\Searchable\SearchableTrait;

class Product extends Model {

    use SoftDeletes;
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

    public $with = [
        //
    ];

    protected $dates = [
        'deteled_at'
    ];

    protected $fillable = [
        'p_id',
        'status',
        'user_id',
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
        return $this->belongsToMany('Urban\Category');
    }

    public function tags() {
        return $this->belongsToMany('Urban\Stag');
    }

    public function adata() {
        return $this->belongsToMany('Urban\Adata');
    }

    public function attributes() {
        return $this->belongsToMany('Urban\Attribute');
    }

    public function reviews() {
        return $this->hasMany('Urban\Review');
    }

    public function user() {
        return $this->belongsTo('Urban\User');
    }

    public function brand() {
        return $this->belongsTo('Urban\Brand');
    }

    public function wishlists() {
        return $this->belongsToMany('Urban\Wishlist');
    }

    public function orders() {
        return $this->belongsToMany('Urban\Order');
    }

    public function medias() {
        return $this->belongsToMany('Urban\Media');
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
