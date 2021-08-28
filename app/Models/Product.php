<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $appends = ['rating'];

    protected $fillable = ['name','sku', 'code', 'brand', 'description', 'product_category_id', 'price','original_price', 'unit_value', 'unit_type', 'ingredient', 'new', 'professional',
        'product_bl_category_id', 'product_range_id', 'product_type_id', 'no_of_identical_products', 'french_name', 'original_price', 'french_description',
        'upc_code', 'uom', 'how_to_use', 'who_can_use', 'whats_it_for',
    ];

    public function product_category()
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }

    public function productBlCategory()
    {
        return $this->belongsTo(ProductBlCategory::class, 'product_bl_category_id');
    }

    public function productRange()
    {
        return $this->belongsTo(ProductRange::class, 'product_range_id');
    }

    public function productType()
    {
        return $this->belongsTo(ProductType::class, 'product_type_id');
    }

    public function first_image()
    {
        return $this->hasOne(ProductImage::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    // We're using this relation to cart page
    public function product_images()
    {
        return $this->hasMany(ProductImage::class);
    }

    /**
     * Get all of the video's comments.
     */
    public function carts()
    {
        return $this->morphMany(Cart::class, 'cartable');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function product_reviews()
    {
        return $this->hasMany(ProductReview::class);
    }

    public function getRatingAttribute()
    {
        return $this->product_reviews()->avg('rating') ?: 0;
    }
}
