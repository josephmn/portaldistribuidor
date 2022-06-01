using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;

namespace WSDistribuidor.Entity
{
    public class EConsultarArchivosVentasRuc
    {
        public string d_fecha { get; set; }
        public string v_ruc { get; set; }
        public string v_razon { get; set; }        
        public string i_producto { get; set; }        
        public string v_producto { get; set; }
        public string i_cliente { get; set; }
        public string v_cliente { get; set; }
        public string v_tipo_cliente { get; set; }
        public string v_departamento { get; set; }
        public string v_provincia { get; set; }
        public string v_distrito { get; set; }
        public string f_venta { get; set; }
        public string f_kilos { get; set; }
        public string f_cantidad { get; set; }
    }
}