using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;

namespace WSDistribuidor.Entity
{
    public class EConsultarEquivalencias
    {
        public Int32 i_id { get; set; }
        public string v_ruc { get; set; }
        public string v_razon { get; set; }
        public string v_sku { get; set; }
        public string v_equ { get; set; }
        public string v_producto { get; set; }
        public Int32 i_estado { get; set; }
        public string v_estado { get; set; }
        public string v_color_estado { get; set; }
        public string f_min { get; set; }
        public string f_max { get; set; }
    }
}