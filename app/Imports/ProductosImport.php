<?php

namespace App\Imports;

use App\Models\Producto;
use App\Models\Marca;
use App\Models\Almacene;
use App\Models\UnidadMedida;
use App\Models\Proveedore;
use App\Models\Materiale;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class ProductosImport implements ToCollection, WithHeadingRow, WithChunkReading, WithBatchInserts
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        foreach($rows as $row)
        {
            $marca = Marca::where('marca', 'LIKE', '%'.$row['marca'].'%')->get();
            $almacen = Almacene::where('nombre', 'LIKE', '%'.$row['almacen'].'%')->get();
            $unidadMedida = UnidadMedida::where('unidad_medida', 'LIKE', '%'.$row['unidad_de_medida'].'%')->get();
            $proveedor = Proveedore::where('nombres', 'LIKE', '%'.$row['proveedor'].'%')->get();
            $material = Materiale::where('material', 'LIKE', '%'.$row['material'].'%')->get();
            Producto::create([
                'marca_id'          => sizeof($marca) > 0 ? $marca[0]['id'] : null,
                'alamcene_id'       => sizeof($almacen) > 0 ? $almacen[0]['id'] : null,
                'unidad_medida_id'  => sizeof($unidadMedida) > 0 ? $unidadMedida[0]['id'] : null,
                'proveedore_id'     => sizeof($proveedor) > 0 ? $proveedor[0]['id'] : null,
                'materiale_id'      => sizeof($material) > 0 ? $material[0]['id'] : null,
                'cod_barra'         => $row['codigo_de_barra'],
                'cod_sat'           => $row['codigo_del_sat'],
                'producto'          => $row['producto'],
                'pre_compra'        => $row['precio_de_compra'],
                'pre_venta'         => $row['precio_de_venta'],
                'pre_mayoreo'       => $row['precio_de_mayoreo'],
                'utilidad'          => floatval($row['precio_de_venta']) - floatval($row['precio_de_compra']),
                'stock_min'         => $row['stock_minimo'],
                'stock'             => $row['stock'],
            ]);
        }
    }
    public function batchSize(): int
    {
        return 3000;
    }
    public function chunkSize(): int
    {
        return 3000;
    }
}
