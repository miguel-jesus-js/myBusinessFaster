<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
    protected $fillable = [
        'marca_id',
        'almacene_id',
        'unidad_medida_id',
        'proveedore_id',
        'materiale_id',
        'cod_barra',
        'cod_sat',
        'producto',
        'pre_compra',
        'pre_venta',
        'pre_mayoreo',
        'utilidad',
        'stock_min',
        'stock',
        'img1',
        'img2',
        'img3',
        'caducidad',
        'color',
        'talla',
        'modelo',
        'meses_garantia',
        'peso_kg',
        'desc_detallada',
        'es_produccion',
        'afecta_venta',
    ];

    public function scopeProducto($query, $producto)
    {
        if($producto)
        {
            return $query->where('producto', 'LIKE', '%'.$producto.'%');
        }
    }

    public function marcas()
    {
        return $this->belongsTo(Marca::class, 'marca_id', 'id');
    }
    public function almacenes()
    {
        return $this->belongsTo(Almacene::class, 'almacene_id', 'id');
    }
    public function unidadMedidas()
    {
        return $this->belongsTo(UnidadMedida::class, 'unidad_medida_id', 'id');
    }
    public function proveedores()
    {
        return $this->belongsTo(Proveedore::class, 'proveedore_id', 'id');
    }
    public function materiales()
    {
        return $this->belongsTo(Materiale::class, 'materiale_id', 'id');
    }
    public function categorias()
    {
        return $this->belongsToMany(Categoria::class, 'detalle_cat', 'producto_id', 'categoria_id');
    }
}
