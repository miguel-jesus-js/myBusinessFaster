<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Producto extends Model
{
    use HasFactory, SoftDeletes;
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

    public function scopeWithOrOnlyTrashed($query, $tipo)
    {
        switch($tipo)
        {
            case 0:
                return $query->withTrashed();
                break;
            case 1:
                return $query->onlyTrashed();
        }
    }
    public function scopeMarca($query, $marca)
    {
        if($marca)
        {
            return $query->where('marca_id', $marca);
        }
    }
    public function scopeAlmacen($query, $almacen)
    {
        if($almacen)
        {
            return $query->where('almacene_id', $almacen);
        }
    }
    public function scopeUnidadMedida($query, $unidadMedida)
    {
        if($unidadMedida)
        {
            return $query->where('unidad_medida_id', $unidadMedida);
        }
    }
    public function scopeProveedor($query, $proveedor)
    {
        if($proveedor)
        {
            return $query->where('proveedore_id', $proveedor);
        }
    }
    public function scopeMaterial($query, $material)
    {
        if($material)
        {
            return $query->where('materiale_id', $material);
        }
    }
    public function scopeCodBarra($query, $codBarra)
    {
        if($codBarra)
        {
            return $query->where('cod_barra', $codBarra);
        }
    }
    public function scopeCodSat($query, $codSat)
    {
        if($codSat)
        {
            return $query->where('cod_sat', $codSat);
        }
    }
    public function scopeProducto($query, $producto)
    {
        if($producto)
        {
            return $query->where('producto', 'LIKE', '%'.$producto.'%');
        }
    }
    public function scopeStock($query, $stock)
    {
        if($stock)
        {
            return $query->where('stock', $stock);
        }
    }
    public function scopePrecioMin($query, $precioMin)
    {
        if($precioMin)
        {
            return $query->where('pre_venta', '>=', $precioMin);
        }
    }
    public function scopePrecioMax($query, $precioMax)
    {
        if($precioMax)
        {
            return $query->where('pre_venta', '<=', $precioMax);
        }
    }
    public function scopeAfectaVentas($query, $afectaVentas)
    {
        if($afectaVentas)
        {
            return $query->where('afecta_ventas', $afectaVentas);
        }
    }
    public function scopeEsProduccion($query, $esPorduccion)
    {
        if($esPorduccion)
        {
            return $query->where('es_produccion', $esPorduccion);
        }
    }

    public function marcas()
    {
        return $this->belongsTo(Marca::class, 'marca_id', 'id')->withTrashed();
    }
    public function almacenes()
    {
        return $this->belongsTo(Almacene::class, 'almacene_id', 'id')->withTrashed();
    }
    public function unidadMedidas()
    {
        return $this->belongsTo(UnidadMedida::class, 'unidad_medida_id', 'id')->withTrashed();
    }
    public function proveedores()
    {
        return $this->belongsTo(Proveedore::class, 'proveedore_id', 'id')->withTrashed();
    }
    public function materiales()
    {
        return $this->belongsTo(Materiale::class, 'materiale_id', 'id')->withTrashed();
    }
    public function categorias()
    {
        return $this->belongsToMany(Categoria::class, 'detalle_cat', 'producto_id', 'categoria_id')->withPivot('id');
    }
    public function caracteristicas()
    {
        return $this->hasMany(Caracteristica::class, 'producto_id', 'id');
    }
}
