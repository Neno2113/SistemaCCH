<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    protected $table = 'empleado';

    protected $fillable = [
        'id', 'user_id', 'nombre', 'apellido', 'calle', 'sector', 'provincia', 'sitios_cercanos', 'telefono_1',
        'celular', 'email', 'cedula', 'departamento', 'casado', 'cargo' 
       // 'fecha_contratacion',
      //  'fecha_termino_contrato', 'tipo_contrato', 'forma_pago', 'sueldo', 'valor_hora', 'banco_tarjeta_cobro',
     //   'no_cuenta','estado_civil', 'referencia','fecha_ingreso','condicion_medica','nombre_esposa','telefono_esposa',
     //   'esposa_asegurada_si','esposa_asegurada_no', 'cantidad_dependientes','nombre_dependiente_0',
     //   'parentesco_dependiente_0','edad_dependiente_0','nombre_dependiente_1'
    ];

    
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
    
}

/*
            'estado_civil', 'referencia','fecha_ingreso','condicion_medica','nombre_esposa','telefono_esposa','esposa_asegurada_si','esposa_asegurada_no',
            'cantidad_dependientes','nombre_dependiente_0','parentesco_dependiente_0','edad_dependiente_0','nombre_dependiente_1',
            parentesco_dependiente_1: $("#parentesco_dependiente_1").val(),
            edad_dependiente_1: $("#edad_dependiente_1").val(),
            nombre_dependiente_2: $("#nombre_dependiente_2").val(),
            parentesco_dependiente_2: $("#parentesco_dependiente_2").val(),
            edad_dependiente_2: $("#edad_dependiente_2").val(),
            nombre_dependiente_3: $("#nombre_dependiente_3").val(),
            parentesco_dependiente_3: $("#parentesco_dependiente_3").val(),
            edad_dependiente_3: $("#edad_dependiente_3").val(),
            nombre_dependiente_4: $("#nombre_dependiente_4").val(),
            parentesco_dependiente_4: $("#parentesco_dependiente_4").val(),
            edad_dependiente_4: $("#edad_dependiente_4").val(),
            nombre_dependiente_5: $("#nombre_dependiente_5").val(),
            parentesco_dependiente_5: $("#parentesco_dependiente_5").val(),
            edad_dependiente_5: $("#edad_dependiente_5").val(),
            nombre_dependiente_6: $("#nombre_dependiente_6").val(),
            parentesco_dependiente_6: $("#parentesco_dependiente_6").val(),
            edad_dependiente_6: $("#edad_dependiente_6").val(),
            nombre_ref1: $("#nombre_ref1").val(),
            parentesco_ref1: $("#parentesco_ref1").val(),
            telefono_ref1: $("#telefono_ref1").val(),
            nombre_ref2: $("#nombre_ref2").val(),
            parentesco_ref2: $("#parentesco_ref2").val(),
            telefono_ref2: $("#telefono_ref2").val(),
            primaria: $("#primaria").val(),
            bachiller: $("#bachiller").val(),
            nivel_superior: $("#nivel-superior").val(),
            grado_titulo: $("#grado-titulo").val(),
            especialidad: $("#especialidad").val(),
            fecha_exp: $("#fecha-exp").val(),
            cargo_experiencia_1: $("#cargo_experiencia_1").val(),
            cargo_experiencia_2: $("#cargo_experiencia_2").val(),
            tiempo_experiencia_1: $("#tiempo_experiencia_1").val(),
            tiempo_experiencia_2: $("#tiempo_experiencia_2").val(),
            empresa_experiencia_1: $("#empresa_experiencia_1").val(),
            empresa_experiencia_2: $("#empresa_experiencia_2").val(),
            supervisor_experiencia_1: $("#supervisor_experiencia_1").val(),
            supervisor_experiencia_2: $("#supervisor_experiencia_2").val(),
            telefono_experiencia_1: $("#telefono_experiencia_1").val(),
            telefono_experiencia_2: $("#telefono_experiencia_2").val(),
            codigo: $("#codigo").val(),
            departamento: $("#departamento").val(),
            cargo: $("#cargo").val(),
            tipo_contrato: $("#tipo_contrato").val(),
            forma_pago: $("#forma_pago").val(),
            sueldo: $("#sueldo").val(),
            valor_hora: $("#valor_hora").val(),
            banco_tarjeta_cobro: $("#banco_tarjeta_cobro").val(),
            no_cuenta: $("#no_cuenta").val(),
            nss: $("#nss").val()
            
*/