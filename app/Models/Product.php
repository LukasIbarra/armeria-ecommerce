<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'sku',
        'name',
        'slug',
        'description',
        'price',
        'stock',
        'status',
        'is_featured'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'stock' => 'integer',
        'is_featured' => 'boolean',
    ];

    /**
     * Boot method para generar slug automáticamente
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            if (empty($product->slug)) {
                $product->slug = Str::slug($product->name);
            }
        });

        static::updating(function ($product) {
            if ($product->isDirty('name') && empty($product->slug)) {
                $product->slug = Str::slug($product->name);
            }
        });
    }

    /**
     * Relación con categoría
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Relación con variantes del producto
     */
    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }

    /**
     * Relación con imágenes del producto
     */
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    /**
     * Obtener la imagen principal del producto
     */
    public function mainImage()
    {
        return $this->hasOne(ProductImage::class)->where('is_main', true);
    }

    /**
     * Scope para productos activos
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope para productos destacados
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope para productos en stock
     */
    public function scopeInStock($query)
    {
        return $query->where('stock', '>', 0);
    }

    /**
     * Obtener la ruta del producto
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Formatear precio en pesos chilenos
     */
    public function getFormattedPriceAttribute()
    {
        return '$' . number_format($this->price, 0, ',', '.') . ' CLP';
    }
}
