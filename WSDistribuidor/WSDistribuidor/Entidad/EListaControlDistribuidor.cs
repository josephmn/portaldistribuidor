using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;

namespace WSDistribuidor.Entity
{
    public class EListaControlDistribuidor
    {
        public Int32 i_id { get; set; }
        public string v_ruc { get; set; }
        public string v_razon { get; set; }
        public string v_archivo { get; set; }
        public Int32 i_row_success { get; set; }
        public Int32 i_row_error { get; set; }
        public Double i_cantidad { get; set; }
        public Double i_venta { get; set; }
        public DateTime d_fecha { get; set; }
    }
}