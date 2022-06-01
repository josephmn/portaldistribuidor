using System;
using System.Collections.Generic;
using System.Data.SqlClient;
using System.Linq;
using System.Web;
using WSDistribuidor.Controller;
using WSDistribuidor.Entity;

namespace WSDistribuidor.view
{
    public class VConsultarArchivosStockRuc : BDconexion
    {
        public List<EConsultarArchivosStockRuc> ConsultarArchivosStockRuc(String archivo)
        {
            List<EConsultarArchivosStockRuc> lCConsultarArchivosStockRuc = null;
            using (SqlConnection con = new SqlConnection(conexion))
            {
                try
                {
                    con.Open();
                    CConsultarArchivosStockRuc oVConsultarArchivosStockRuc = new CConsultarArchivosStockRuc();
                    lCConsultarArchivosStockRuc = oVConsultarArchivosStockRuc.ConsultarArchivosStockRuc(con, archivo);
                }
                catch (SqlException)
                {
                    
                }
            }
                return (lCConsultarArchivosStockRuc);
        }
    }
}