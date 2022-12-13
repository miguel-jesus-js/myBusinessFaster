<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Clientes Excel</title>
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
    <div class="container py-5">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>N°</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Teléfono</th>
                    <th>RFC</th>
                    <th>Empresa</th>
                    <th>Dirección</th>
                    <th>Límite de crédito</th>
                    <th>Dias de crédito</th>
                </tr>
            </thead>
            <tbody>
                @for ($i = 0; $i < sizeof($clientes); $i++)
                <tr>
                    <td>{{ $i+1 }}</td>
                    <td>{{ $clientes[$i]['nombres'].' '.$clientes[$i]['app'].' '.$clientes[$i]['apm'] }}</td>
                    <td>{{ $clientes[$i]['email'] }}</td>
                    <td>{{ $clientes[$i]['telefono'] }}</td>
                    <td>{{ $clientes[$i]['rfc'] }}</td>
                    <td>{{ $clientes[$i]['empresa'] }}</td>
                    <td>{{ $clientes[$i]['calle'].' '.($clientes[$i]['n_exterior'] == 0 ? '' : $clientes[$i]['n_exterior']).', '.$clientes[$i]['colonia'].', '.$clientes[$i]['cp'].', '.$clientes[$i]['municipio'].', '.$clientes[$i]['estado'].', '.$clientes[$i]['ciudad'] }}</td>
                    <td>${{ $clientes[$i]['limite_credito'] }}</td>
                    <td>{{ $clientes[$i]['dias_credito'] }}</td>
                </tr>

                @endfor
            </tbody>
        </table>
    </div>
    
</body>
</html>