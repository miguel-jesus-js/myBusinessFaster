<?php

namespace App\Traits;
use File;

trait ImagesTrait {
    public function uploadImagen($imagen, $numImagen, $ruta)
    {
        if($imagen != null)
        {
            $nomImg = date('YmdHis'). '-'.$numImagen.'.' . $imagen->getClientOriginalExtension();//asignamos el nombre a la imagen
            $imagen->move($ruta, $nomImg);//hace la subida de la imagen al servidor
            return $nomImg;
        }
        return null;
    }
    public function deleteImagen($nameImagen, $path)
    {
        $path = public_path($path.$nameImagen);
        File::delete($path);
    }
}