using System;
using System.Collections.Generic;
using System.Data.SqlClient;
using System.Linq;
using System.Web;
using WSDistribuidor.Controller;
using WSDistribuidor.Entity;

namespace WSDistribuidor.view
{
    public class VConsultarDistribuidores : BDconexion
    {
        public List<EConsultarDistribuidores> ConsultarDistribuidores(Int32 post)
        {
            List<EConsultarDistribuidores> lCConsultarDistribuidores = null;
            using (SqlConnection con = new SqlConnection(conexion))
            {
                try
                {
                    con.Open();
                    CConsultarDistribuidores oVConsultarDistribuidores = new CConsultarDistribuidores();
                    lCConsultarDistribuidores = oVConsultarDistribuidores.ConsultarDistribuidores(con, post);
                }
                catch (SqlException)
                {
                    
                }
            }
                return (lCConsultarDistribuidores);
        }
    }
}