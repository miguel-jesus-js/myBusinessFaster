<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
Use App\Models\Producto;

class ProductosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'marca_id'          => 5,
                'almacene_id'       => 1,
                'unidad_medida_id'  => 5,
                'proveedore_id'     => 3,
                'materiale_id'      => 1,
                'cod_barra'         => '1234567890123',
                'cod_sat'           => '12345678',
                'producto'          => 'Takis fuego',
                'stock_min'         => 5,
                'img1'              => '20220719051821-img1.png',
                'img2'              => '20220719051821-img2.png',
                'img3'              => '20220719051821-img3.png',
                'caducidad'         => '2023-03-20',
                'color'             => 1,
                'talla'             => 1,
                'modelo'            => 1,
                'meses_garantia'    => 1,
                'peso_kg'           => 1,
                'desc_detallada'    => 1,
                'es_produccion'     => 0,
                'afecta_ventas'     => 1,
            ],
            [
                'marca_id'          => 5,
                'almacene_id'       => 1,
                'unidad_medida_id'  => 5,
                'proveedore_id'     => 3,
                'materiale_id'      => 1,
                'cod_barra'         => '1234567890124',
                'cod_sat'           => '12345679',
                'producto'          => 'Chips adobadas',
                'stock_min'         => 5,
                'img1'              => '00075752804420L.jpg',
                'img2'              => '5454345654.png',
                'img3'              => '7657657.png',
                'caducidad'         => '2023-03-20',
                'color'             => 1,
                'talla'             => 1,
                'modelo'            => 1,
                'meses_garantia'    => 1,
                'peso_kg'           => 1,
                'desc_detallada'    => 1,
                'es_produccion'     => 0,
                'afecta_ventas'     => 1,
            ],
            [
                'marca_id'          => 5,
                'almacene_id'       => 1,
                'unidad_medida_id'  => 5,
                'proveedore_id'     => 3,
                'materiale_id'      => 1,
                'cod_barra'         => '1234567890125',
                'cod_sat'           => '12345670',
                'producto'          => 'Runers',
                'stock_min'         => 5,
                'img1'              => '754745.png',
                'img2'              => '7346435567.png',
                'img3'              => '757528039318_1200x1200.png',
                'caducidad'         => '2023-03-20',
                'color'             => 1,
                'talla'             => 1,
                'modelo'            => 1,
                'meses_garantia'    => 1,
                'peso_kg'           => 1,
                'desc_detallada'    => 1,
                'es_produccion'     => 0,
                'afecta_ventas'     => 1,
            ],
            [
                'marca_id'          => 5,
                'almacene_id'       => 1,
                'unidad_medida_id'  => 5,
                'proveedore_id'     => 3,
                'materiale_id'      => 1,
                'cod_barra'         => '1234567890126',
                'cod_sat'           => '12345671',
                'producto'          => 'Tostachos',
                'stock_min'         => 5,
                'img1'              => '854ad6603cc8.png',
                'img2'              => '566365.png',
                'img3'              => '00075752802209L.jpg',
                'caducidad'         => '2023-03-20',
                'color'             => 1,
                'talla'             => 1,
                'modelo'            => 1,
                'meses_garantia'    => 1,
                'peso_kg'           => 1,
                'desc_detallada'    => 1,
                'es_produccion'     => 0,
                'afecta_ventas'     => 1,
            ],
            [
                'marca_id'          => 5,
                'almacene_id'       => 1,
                'unidad_medida_id'  => 5,
                'proveedore_id'     => 3,
                'materiale_id'      => 1,
                'cod_barra'         => '1234567890127',
                'cod_sat'           => '12345672',
                'producto'          => 'Chipotles',
                'stock_min'         => 5,
                'img1'              => '34tt34.jpg',
                'img2'              => '854ad6603cc8.png',
                'img3'              => '566365.png',
                'caducidad'         => '2023-03-20',
                'color'             => 1,
                'talla'             => 1,
                'modelo'            => 1,
                'meses_garantia'    => 1,
                'peso_kg'           => 1,
                'desc_detallada'    => 1,
                'es_produccion'     => 0,
                'afecta_ventas'     => 1,
            ],
            [
                'marca_id'          => 1,
                'almacene_id'       => 1,
                'unidad_medida_id'  => 2,
                'proveedore_id'     => 4,
                'materiale_id'      => 3,
                'cod_barra'         => '1234567890111',
                'cod_sat'           => '12345611',
                'producto'          => 'Tenis nike casual',
                'stock_min'         => 5,
                'img1'              => '68678654.jpg',
                'img2'              => '654856656.jpg',
                'img3'              => '1117876115.png',
                'caducidad'         => '2023-03-20',
                'color'             => 'Blanco',
                'talla'             => 'Mediana',
                'modelo'            => 'Casual',
                'meses_garantia'    => 1,
                'peso_kg'           => 1,
                'desc_detallada'    => 1,
                'es_produccion'     => 0,
                'afecta_ventas'     => 1,
            ],
            [
                'marca_id'          => 1,
                'almacene_id'       => 1,
                'unidad_medida_id'  => 2,
                'proveedore_id'     => 4,
                'materiale_id'      => 3,
                'cod_barra'         => '1234567890112',
                'cod_sat'           => '12345612',
                'producto'          => 'Tenis nike casual deportivo',
                'stock_min'         => 5,
                'img1'              => '365464.jpg',
                'img2'              => '65465765.png',
                'img3'              => '687986541.png',
                'caducidad'         => '2023-03-20',
                'color'             => 'Negro',
                'talla'             => 'Mediana',
                'modelo'            => 'Casual',
                'meses_garantia'    => 1,
                'peso_kg'           => 1,
                'desc_detallada'    => 1,
                'es_produccion'     => 0,
                'afecta_ventas'     => 1,
            ],
            [
                'marca_id'          => 1,
                'almacene_id'       => 1,
                'unidad_medida_id'  => 2,
                'proveedore_id'     => 4,
                'materiale_id'      => 3,
                'cod_barra'         => '1234567890113',
                'cod_sat'           => '12345613',
                'producto'          => 'Tenis nike tacos',
                'stock_min'         => 5,
                'img1'              => '75675456.png',
                'img2'              => '634665856.jpg',
                'img3'              => '0988664654.png',
                'caducidad'         => '2023-03-20',
                'color'             => 'Negro',
                'talla'             => 'Mediana',
                'modelo'            => 'Casual',
                'meses_garantia'    => 1,
                'peso_kg'           => 1,
                'desc_detallada'    => 1,
                'es_produccion'     => 0,
                'afecta_ventas'     => 1,
            ],
            [
                'marca_id'          => 1,
                'almacene_id'       => 1,
                'unidad_medida_id'  => 2,
                'proveedore_id'     => 4,
                'materiale_id'      => 3,
                'cod_barra'         => '1234567890114',
                'cod_sat'           => '12345614',
                'producto'          => 'Tenis nike bicho',
                'stock_min'         => 5,
                'img1'              => '8768567567.jpg',
                'img2'              => '97668769769.jpg',
                'img3'              => '976547547567.jpg',
                'caducidad'         => '2023-03-20',
                'color'             => 'Blanco',
                'talla'             => 'Mediana',
                'modelo'            => 'Casual bicho',
                'meses_garantia'    => 1,
                'peso_kg'           => 1,
                'desc_detallada'    => 1,
                'es_produccion'     => 0,
                'afecta_ventas'     => 1,
            ],
            [
                'marca_id'          => 1,
                'almacene_id'       => 1,
                'unidad_medida_id'  => 2,
                'proveedore_id'     => 4,
                'materiale_id'      => 3,
                'cod_barra'         => '1234567890115',
                'cod_sat'           => '12345615',
                'producto'          => 'Tenis nike jogger',
                'stock_min'         => 5,
                'img1'              => '7675u68675.jpg',
                'img2'              => '436457657.jpg',
                'img3'              => '765768568.jpg',
                'caducidad'         => '2023-03-20',
                'color'             => 'jogger',
                'talla'             => 'Mediana',
                'modelo'            => 'Casual bicho',
                'meses_garantia'    => 1,
                'peso_kg'           => 1,
                'desc_detallada'    => 1,
                'es_produccion'     => 0,
                'afecta_ventas'     => 1,
            ],
            [
                'marca_id'          => 1,
                'almacene_id'       => 1,
                'unidad_medida_id'  => 2,
                'proveedore_id'     => 4,
                'materiale_id'      => 3,
                'cod_barra'         => '1234567890121',
                'cod_sat'           => '12345621',
                'producto'          => 'Vino black label',
                'stock_min'         => 5,
                'img1'              => '8575765.jpg',
                'img2'              => '654634654754.jpg',
                'img3'              => '5000267024004.jpg',
                'caducidad'         => '2025-03-20',
                'color'             => 'jogger',
                'talla'             => 'Mediana',
                'modelo'            => 'Casual bicho',
                'meses_garantia'    => 1,
                'peso_kg'           => 1,
                'desc_detallada'    => 1,
                'es_produccion'     => 0,
                'afecta_ventas'     => 1,
            ],
            [
                'marca_id'          => 1,
                'almacene_id'       => 1,
                'unidad_medida_id'  => 2,
                'proveedore_id'     => 4,
                'materiale_id'      => 3,
                'cod_barra'         => '1234567890122',
                'cod_sat'           => '12345622',
                'producto'          => 'Vino red label',
                'stock_min'         => 5,
                'img1'              => '74365756.jpg',
                'img2'              => '654768658.jpg',
                'img3'              => '978768768.jpg',
                'caducidad'         => '2025-03-20',
                'color'             => 'jogger',
                'talla'             => 'Mediana',
                'modelo'            => 'Casual bicho',
                'meses_garantia'    => 1,
                'peso_kg'           => 1,
                'desc_detallada'    => 1,
                'es_produccion'     => 0,
                'afecta_ventas'     => 1,
            ],
            [
                'marca_id'          => 1,
                'almacene_id'       => 1,
                'unidad_medida_id'  => 2,
                'proveedore_id'     => 4,
                'materiale_id'      => 3,
                'cod_barra'         => '1234567890129',
                'cod_sat'           => '12345623',
                'producto'          => 'tequila Don ramon',
                'stock_min'         => 5,
                'img1'              => '7534231.jpg',
                'img2'              => '77568658.jpg',
                'img3'              => '86345332.jpg',
                'caducidad'         => '2025-03-20',
                'color'             => 'jogger',
                'talla'             => 'Mediana',
                'modelo'            => 'Casual bicho',
                'meses_garantia'    => 1,
                'peso_kg'           => 1,
                'desc_detallada'    => 1,
                'es_produccion'     => 0,
                'afecta_ventas'     => 1,
            ],
            [
                'marca_id'          => 1,
                'almacene_id'       => 1,
                'unidad_medida_id'  => 2,
                'proveedore_id'     => 4,
                'materiale_id'      => 3,
                'cod_barra'         => '1238567890120',
                'cod_sat'           => '12345624',
                'producto'          => 'Bucana',
                'stock_min'         => 5,
                'img1'              => '00000005019638l.jpg',
                'img2'              => '8574575475.jpg',
                'img3'              => '8754768568.jpg',
                'caducidad'         => '2025-03-20',
                'color'             => 'jogger',
                'talla'             => 'Mediana',
                'modelo'            => 'Casual bicho',
                'meses_garantia'    => 1,
                'peso_kg'           => 1,
                'desc_detallada'    => 1,
                'es_produccion'     => 0,
                'afecta_ventas'     => 1,
            ],
            [
                'marca_id'          => 1,
                'almacene_id'       => 1,
                'unidad_medida_id'  => 2,
                'proveedore_id'     => 4,
                'materiale_id'      => 3,
                'cod_barra'         => '1234567890120',
                'cod_sat'           => '12345625',
                'producto'          => 'Black white',
                'stock_min'         => 5,
                'img1'              => '00000005019613L2.jpg',
                'img2'              => '764366757.jpg',
                'img3'              => '86586586658.png',
                'caducidad'         => '2025-03-20',
                'color'             => 'jogger',
                'talla'             => 'Mediana',
                'modelo'            => 'Casual bicho',
                'meses_garantia'    => 1,
                'peso_kg'           => 1,
                'desc_detallada'    => 1,
                'es_produccion'     => 0,
                'afecta_ventas'     => 1,
            ],
            [
                'marca_id'          => 1,
                'almacene_id'       => 1,
                'unidad_medida_id'  => 2,
                'proveedore_id'     => 4,
                'materiale_id'      => 3,
                'cod_barra'         => '1234567890131',
                'cod_sat'           => '12345631',
                'producto'          => 'Iphone 12',
                'stock_min'         => 5,
                'img1'              => 'i95465775.jpg',
                'img2'              => '8658667.jpg',
                'img3'              => '65465756.png',
                'caducidad'         => '2025-03-20',
                'color'             => 'Purpura',
                'talla'             => 'Mediana',
                'modelo'            => '12 pro max',
                'meses_garantia'    => 12,
                'peso_kg'           => 1,
                'desc_detallada'    => 1,
                'es_produccion'     => 0,
                'afecta_ventas'     => 1,
            ],
            [
                'marca_id'          => 1,
                'almacene_id'       => 1,
                'unidad_medida_id'  => 2,
                'proveedore_id'     => 4,
                'materiale_id'      => 3,
                'cod_barra'         => '1234567890132',
                'cod_sat'           => '12345632',
                'producto'          => 'Samsung a22',
                'stock_min'         => 5,
                'img1'              => '45674574575.jpg',
                'img2'              => '66543643656.jpg',
                'img3'              => '7643563456346.jpg',
                'caducidad'         => '2025-03-20',
                'color'             => 'Purpura',
                'talla'             => 'Mediana',
                'modelo'            => 'a22 ultra',
                'meses_garantia'    => 12,
                'peso_kg'           => 1,
                'desc_detallada'    => 1,
                'es_produccion'     => 0,
                'afecta_ventas'     => 1,
            ],
            [
                'marca_id'          => 1,
                'almacene_id'       => 1,
                'unidad_medida_id'  => 2,
                'proveedore_id'     => 4,
                'materiale_id'      => 3,
                'cod_barra'         => '1234567890133',
                'cod_sat'           => '12345633',
                'producto'          => 'Playera ck',
                'stock_min'         => 5,
                'img1'              => '76576557.jpg',
                'img2'              => '85676568678.jpg',
                'img3'              => 'y54757r747.jpg',
                'caducidad'         => '2025-03-20',
                'color'             => 'Blanco',
                'talla'             => 'Mediana',
                'modelo'            => 'Sensual',
                'meses_garantia'    => 12,
                'peso_kg'           => 1,
                'desc_detallada'    => 1,
                'es_produccion'     => 0,
                'afecta_ventas'     => 1,
            ],
            [
                'marca_id'          => 1,
                'almacene_id'       => 1,
                'unidad_medida_id'  => 2,
                'proveedore_id'     => 4,
                'materiale_id'      => 3,
                'cod_barra'         => '1234567890134',
                'cod_sat'           => '12345634',
                'producto'          => 'Laptop HP',
                'stock_min'         => 5,
                'img1'              => '756867907.jpg',
                'img2'              => '96867978098.jpg',
                'img3'              => '8575676756567.png',
                'caducidad'         => '2025-03-20',
                'color'             => 'Plata',
                'talla'             => 'Mediana',
                'modelo'            => 'Pavilon',
                'meses_garantia'    => 12,
                'peso_kg'           => 1,
                'desc_detallada'    => 1,
                'es_produccion'     => 0,
                'afecta_ventas'     => 1,
            ],
            [
                'marca_id'          => 1,
                'almacene_id'       => 1,
                'unidad_medida_id'  => 2,
                'proveedore_id'     => 4,
                'materiale_id'      => 3,
                'cod_barra'         => '1234567890135',
                'cod_sat'           => '12345635',
                'producto'          => 'Paracetamol',
                'stock_min'         => 5,
                'img1'              => '75487568568.jpg',
                'img2'              => '798796798679.png',
                'img3'              => '8756765865856.png',
                'caducidad'         => '2025-03-20',
                'color'             => 'Plata',
                'talla'             => 'Mediana',
                'modelo'            => 'Pavilon',
                'meses_garantia'    => 12,
                'peso_kg'           => 1,
                'desc_detallada'    => 1,
                'es_produccion'     => 0,
                'afecta_ventas'     => 1,
            ],
        ];

        DB::table('productos')->insert($data);
    }
}
