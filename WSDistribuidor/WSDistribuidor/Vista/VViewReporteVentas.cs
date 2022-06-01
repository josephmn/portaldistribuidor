using System;
using System.Collections.Generic;
using System.Data.SqlClient;
using System.Linq;
using System.Web;
using WSDistribuidor.Controller;
using WSDistribuidor.Entity;

namespace WSDistribuidor.view
{
    public class VViewReporteVentas : BDconexion
    {
        public List<EViewReporteVentas> ViewReporteVentas(Int32 post, String fechainicio, String fechafin, String departamento, String distrito, String distribuidor)
        {
            List<EViewReporteVentas> lCViewReporteVentas = null;
            using (SqlConnection con = new SqlConnection(conexion))
            {
                try
                {
                    con.Open();
                    CViewReporteVentas oVViewReporteVentas = new CViewReporteVentas();
                    lCViewReporteVentas = oVViewReporteVentas.ViewReporteVentas(con, post, fechainicio, fechafin, departamento, distrito, distribuidor);
                }
                catch (SqlException)
                {
                    
                }
            }
                return (lCViewReporteVentas);
        }
    }
}