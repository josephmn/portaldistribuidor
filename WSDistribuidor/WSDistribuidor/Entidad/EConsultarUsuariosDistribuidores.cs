using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;

namespace WSDistribuidor.Entity
{
    public class EConsultarUsuariosDistribuidores
    {
        public Int32 i_id { get; set; }
        public String v_nombres { get; set; }
        public String v_correo { get; set; }
        public Int32 i_estado { get; set; }
        public String v_estado { get; set; }
        public String v_color_estado { get; set; }
        public String v_ruc { get; set; }
        public String v_razon { get; set; }
    }
}