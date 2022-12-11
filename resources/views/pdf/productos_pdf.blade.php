<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Productos PDF</title>
    <style>
        table { 
            border-collapse: collapse; 
            font-size: 0.7em; 
            font-family: sans-serif; 
            min-width: 100%; 
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.15); 
        }
        table thead tr { 
            background-color: #000; 
            color: #ffffff; 
        }
        table th, table td { 
            text-align: center;
            padding: 5px 0px; 
        }
        table tbody tr { 
            border-bottom: 1px solid #dddddd; 
        } 
        table tbody tr:nth-of-type(even) { 
            background-color: #f3f3f3; 
        }
        .desc{
            border-collapse: collapse; 
            font-size: .8em; 
            font-family: sans-serif; 
            width: 150;
            float: right;
            position: absolute;
            top: -20px;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ public_path('img/logocolor.png') }}" alt="Logotipo" width="120">
        <div class="desc">
            <b>Teléfono: </b>919 151 34 20 <br>
            <b>Fecha: </b>21 de Agosto de 2022 <br>
            <b>Dirección: </b>Barrio Bonampack, Calle yachilan N° 18, CP: 29950
        </div>
    </div>
    <br><br>
    <div class="container py-5">
        <table class="table table-bordered">
            <thead>
                <tr>
                    @foreach($campos as $campo)
                        <th>{{ $nombreCampos[$campo] }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>

                @foreach($productos as $producto)
                
                    <tr>
                        @foreach($campos as $campo)
                            @if($campo == 'marca_id')
                                <td>{{ $producto['marcas']['marca'] }}</td>
                            @elseif($campo == 'almacene_id')
                                <td>{{ $producto['almacenes']['nombre'] }}</td>
                            @elseif($campo == 'unidad_medida_id')
                                <td>{{ $producto['unidadMedidas']['unidad_medida'] }}</td>
                            @elseif($campo == 'proveedore_id')
                                <td>{{ $producto['proveedores']['nombres'].' '.$producto['proveedores']['app'].' '.$producto['proveedores']['apm'] }}</td>
                            @elseif($campo == 'materiale_id')
                                <td>{{ $producto['materiales'] == null ? '' : $producto['materiales']['material'] }}</td>
                            @elseif($campo == 'pre_compra')
                                <td>{{ '$'.number_format($producto['pre_compra'], 2) }}</td>
                            @elseif($campo == 'pre_venta')
                                <td>{{ '$'.number_format($producto['pre_venta'], 2) }}</td>
                            @elseif($campo == 'pre_mayoreo')
                            <td>{{ '$'.number_format($producto['pre_mayoreo'], 2) }}</td>
                            @elseif($campo == 'utilidad')
                            <td>{{ '$'.number_format($producto['utilidad'], 2) }}</td>
                            @else
                            <td>{{ $producto[$campo] }}</td>
                            @endif
                            
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
</body>
</html>