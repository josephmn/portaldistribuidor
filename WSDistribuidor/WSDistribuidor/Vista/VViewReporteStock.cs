using System;
using System.Collections.Generic;
using System.Data.SqlClient;
using System.Linq;
using System.Web;
using WSDistribuidor.Controller;
using WSDistribuidor.Entity;

namespace WSDistribuidor.view
{
    public class VViewReporteStock : BDconexion
    {
        public List<EViewReporteStock> ViewReporteStock(Int32 post, String fechainicio, String fechafin, String distribuidor)
        {
            List<EViewReporteStock> lCViewReporteStock = null;
            using (SqlConnection con = new SqlConnection(conexion))
            {
                try
                {
                    con.Open();
                    CViewReporteStock oVViewReporteStock = new CViewReporteStock();
                    lCViewReporteStock = oVViewReporteStock.ViewReporteStock(con, post, fechainicio, fechafin, distribuidor);
                }
                catch (SqlException)
                {
                    
                }
            }
                return (lCViewReporteStock);
        }
    }
}