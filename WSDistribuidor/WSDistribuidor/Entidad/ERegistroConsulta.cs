using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;

namespace WSDistribuidor.Entity
{
    public class ERegistroConsulta
    {
        public string v_nombres { get; set; }
        public string v_apellidos { get; set; }
        public string v_correo { get; set; }
        public string i_clave_confirmacion { get; set; }
    }
}