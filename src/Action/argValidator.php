<?php
namespace App\Action;

final class argValidator
{
    private argValidator $argValidator;

    private JsonRenderer $renderer;

   public function whereGenerate($params,$table_name){
        $where = [];
        $fecha = null;

        foreach ($params as $filas => $value) {

            switch ($filas) {

                case 'format_appointment':
                    $filas = 'format_appointment.format_appointment';
                    $value = strtoupper($value);
                    $where = [...$where,$filas => "$value"];   
                    break;
                
                case 'nombre':
                    $filas = 'usuarios.nombre';
                    $value = strtoupper($value);
                    $where = [...$where,$filas => "$value"];   
                    break;
                
                case 'surname':
                    $filas = 'users.surname';
                    $value = strtoupper($value);
                    $where = [...$where,$filas => "$value"];
                    break;
                
                case 'estado':
                    $filas = 'estados.estado';
                    $value = strtoupper($value);
                    $where = [...$where,$filas => "$value"];
                    break;

                case 'id_usuario':
                    $filas = 'requerimientos.id_usuario';
                    $value = strtoupper($value);
                    $where = [...$where,$filas => "$value"];
                    break;

                case 'fecha_inicial':
                    $filas = "'".$table_name.'.created';
                    $value = strtoupper($value);
                    $where = [...$where,$filas => "$value"];;
                    break;

                default:
                    break;
            }
           
            
        }

        return $where;
    }        
}
