using System;
using System.Collections.Generic;
using System.Data.SqlClient;
using System.Linq;
using System.Web;
using WSDistribuidor.Controller;
using WSDistribuidor.Entity;

namespace WSDistribuidor.view
{
    public class VConsultarArchivosVentasRuc : BDconexion
    {
        public List<EConsultarArchivosVentasRuc> ConsultarArchivosVentasRuc(String archivo)
        {
            List<EConsultarArchivosVentasRuc> lCConsultarArchivosVentasRuc = null;
            using (SqlConnection con = new SqlConnection(conexion))
            {
                try
                {
                    con.Open();
                    CConsultarArchivosVentasRuc oVConsultarArchivosVentasRuc = new CConsultarArchivosVentasRuc();
                    lCConsultarArchivosVentasRuc = oVConsultarArchivosVentasRuc.ConsultarArchivosVentasRuc(con, archivo);
                }
                catch (SqlException)
                {
                    
                }
            }
                return (lCConsultarArchivosVentasRuc);
        }
    }
}