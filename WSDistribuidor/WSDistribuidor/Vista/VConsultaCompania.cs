using System;
using System.Collections.Generic;
using System.Data.SqlClient;
using System.Linq;
using System.Web;
using WSDistribuidor.Controller;
using WSDistribuidor.Entity;

namespace WSDistribuidor.view
{
    public class VConsultaCompania : BDconexion
    {
        public List<EConsultaCompania> ConsultaCompania()
        {
            List<EConsultaCompania> lCConsultaCompania = null;
            using (SqlConnection con = new SqlConnection(conexion))
            {
                try
                {
                    con.Open();
                    CConsultaCompania oVConsultaCompania = new CConsultaCompania();
                    lCConsultaCompania = oVConsultaCompania.ConsultaCompania(con);
                }
                catch (SqlException)
                {
                    
                }
            }
                return (lCConsultaCompania);
        }
    }
}