<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Marca;
use App\Models\Materiale;
use App\Models\UnidadMedida;
use App\Models\DetalleCat;

class Producto extends Model
{
    use HasFactory, softDeletes;
    protected $fillable = [
        'materiale_id',
        'unidad_medida_id',
        'marca_id',
        'cod_barra',
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
        'desc_detallada',
        'es_produccion',
        'afecta_venta',
    ];
    public function marcas()
    {
        return $this->belongsTo(Marca::class, 'marca_id', 'id');
    }
    public function materiales()
    {
        return $this->belongsTo(Materiale::class, 'materiale_id', 'id');
    }
    public function unidadMedidas()
    {
        return $this->belongsTo(UnidadMedida::class, 'unidad_medida_id', 'id');
    }
    public function categorias()
    {
        return $this->belongsToMany(Categoria::class, 'detalle_cat', 'producto_id', 'categoria_id');
    }
}
