<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tipo de gastos PDF</title>
    <style>
        table { 
            border-collapse: collapse; 
            font-size: 0.8em; 
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
    @if(!$esExcel)
    <div class="header">
        <img src="{{ public_path('img/logocolor.png') }}" alt="Logotipo" width="120">
        <div class="desc">
            <b>Teléfono: </b>919 151 34 20 <br>
            <b>Fecha: </b>21 de Agosto de 2022 <br>
            <b>Dirección: </b>Barrio Bonampack, Calle yachilan N° 18, CP: 29950
        </div>
    </div>
    <br><br>
    @endif
    <div class="container py-5">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>N°</th>
                    <th>Tipo de gasto</th>
                </tr>
            </thead>
            <tbody>
                @for ($i = 0; $i < sizeof($tipoGastos); $i++)
                <tr>
                    <td>{{ $i+1 }}</td>
                    <td>{{ $tipoGastos[$i]['tipo'] }}</td>
                </tr>

                @endfor
            </tbody>
        </table>
    </div>
    
</body>
</html>