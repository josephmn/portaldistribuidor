using System;
using System.Collections.Generic;
using System.Data.SqlClient;
using System.Linq;
using System.Web;
using WSDistribuidor.Controller;
using WSDistribuidor.Entity;

namespace WSDistribuidor.view
{
    public class VViewReporteEquivalencia : BDconexion
    {
        public List<EViewReporteEquivalencia> ViewReporteEquivalencia(Int32 post, String ruc)
        {
            List<EViewReporteEquivalencia> lCViewReporteEquivalencia = null;
            using (SqlConnection con = new SqlConnection(conexion))
            {
                try
                {
                    con.Open();
                    CViewReporteEquivalencia oVViewReporteEquivalencia = new CViewReporteEquivalencia();
                    lCViewReporteEquivalencia = oVViewReporteEquivalencia.ViewReporteEquivalencia(con, post, ruc);
                }
                catch (SqlException)
                {
                    
                }
            }
                return (lCViewReporteEquivalencia);
        }
    }
}