using System;
using System.Collections.Generic;
using System.Data.SqlClient;
using System.Linq;
using System.Web;
using WSDistribuidor.Controller;
using WSDistribuidor.Entity;

namespace WSDistribuidor.view
{
    public class VConsultarStockRuc : BDconexion
    {
        public List<EConsultarStockRuc> ConsultarStockRuc(String ruc, Int32 user)
        {
            List<EConsultarStockRuc> lCConsultarStockRuc = null;
            using (SqlConnection con = new SqlConnection(conexion))
            {
                try
                {
                    con.Open();
                    CConsultarStockRuc oVConsultarStockRuc = new CConsultarStockRuc();
                    lCConsultarStockRuc = oVConsultarStockRuc.ConsultarStockRuc(con, ruc, user);
                }
                catch (SqlException)
                {
                    
                }
            }
                return (lCConsultarStockRuc);
        }
    }
}