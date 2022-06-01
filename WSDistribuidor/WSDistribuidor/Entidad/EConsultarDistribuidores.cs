using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;

namespace WSDistribuidor.Entity
{
    public class EConsultarDistribuidores
    {
        public Int32 i_id { get; set; }
        public String v_ruc { get; set; }
        public String v_razon { get; set; }
        public Int32 i_estado { get; set; }
        public String v_estado { get; set; }
        public String v_color_estado { get; set; }
        public Int32 v_total { get; set; }
    }
}