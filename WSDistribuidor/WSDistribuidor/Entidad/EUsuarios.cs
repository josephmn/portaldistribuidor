using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;

namespace WSDistribuidor.Entity
{
    public class EUsuarios
    {
        public Int32 v_codigo { get; set; }
        public string v_nombres { get; set; }
        public string v_apellidos { get; set; }
        public string v_correo { get; set; }
        public Int32 i_estado { get; set; }
        public string v_estado { get; set; }
        public string v_color_estado { get; set; }
        public Int32 i_perfil { get; set; }
        public string v_perfil { get; set; }
        public Int32 i_confirmar { get; set; }
        public string v_confirmar_estado { get; set; }
        public string v_color_confirmar_estado { get; set; }
        public Int32 i_clave_confirmacion { get; set; }
        public string v_reset_clave { get; set; }
        public string v_foto { get; set; }
        public string v_selected { get; set; }

    }
}