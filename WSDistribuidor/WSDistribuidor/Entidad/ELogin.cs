using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;

namespace WSDistribuidor.Entity
{
    public class ELogin
    {
        public string i_id { get; set; }
        public string v_nombres { get; set; }
        public string v_apellidos { get; set; }
        public string v_correo { get; set; }
        public string v_estado { get; set; }
        public string v_ruc { get; set; }
        public string i_perfil { get; set; }
        public string v_perfil { get; set; }
        public string v_existe { get; set; }
        public string v_foto { get; set; }
    }
}