using System;
using System.Collections.Generic;
using System.Data.SqlClient;
using System.Linq;
using System.Web;
using WSDistribuidor.Controller;
using WSDistribuidor.Entity;

namespace WSDistribuidor.view
{
    public class VConsultarVentasRuc : BDconexion
    {
        public List<EConsultarVentasRuc> ConsultarVentasRuc(String ruc, Int32 user)
        {
            List<EConsultarVentasRuc> lCConsultarVentasRuc = null;
            using (SqlConnection con = new SqlConnection(conexion))
            {
                try
                {
                    con.Open();
                    CConsultarVentasRuc oVConsultarVentasRuc = new CConsultarVentasRuc();
                    lCConsultarVentasRuc = oVConsultarVentasRuc.ConsultarVentasRuc(con, ruc, user);
                }
                catch (SqlException)
                {
                    
                }
            }
                return (lCConsultarVentasRuc);
        }
    }
}