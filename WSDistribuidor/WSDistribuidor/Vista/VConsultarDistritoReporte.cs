using System;
using System.Collections.Generic;
using System.Data.SqlClient;
using System.Linq;
using System.Web;
using WSDistribuidor.Controller;
using WSDistribuidor.Entity;

namespace WSDistribuidor.view
{
    public class VConsultarDistritoReporte : BDconexion
    {
        public List<EConsultarDistritoReporte> ConsultarDistritoReporte(String fechainicio, String fechafin)
        {
            List<EConsultarDistritoReporte> lCConsultarDistritoReporte = null;
            using (SqlConnection con = new SqlConnection(conexion))
            {
                try
                {
                    con.Open();
                    CConsultarDistritoReporte oVConsultarDistritoReporte = new CConsultarDistritoReporte();
                    lCConsultarDistritoReporte = oVConsultarDistritoReporte.ConsultarDistritoReporte(con, fechainicio, fechafin);
                }
                catch (SqlException)
                {
                    
                }
            }
                return (lCConsultarDistritoReporte);
        }
    }
}