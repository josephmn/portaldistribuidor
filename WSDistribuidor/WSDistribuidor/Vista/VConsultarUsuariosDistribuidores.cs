using System;
using System.Collections.Generic;
using System.Data.SqlClient;
using System.Linq;
using System.Web;
using WSDistribuidor.Controller;
using WSDistribuidor.Entity;

namespace WSDistribuidor.view
{
    public class VConsultarUsuariosDistribuidores : BDconexion
    {
        public List<EConsultarUsuariosDistribuidores> ConsultarUsuariosDistribuidores(String ruc)
        {
            List<EConsultarUsuariosDistribuidores> lCConsultarUsuariosDistribuidores = null;
            using (SqlConnection con = new SqlConnection(conexion))
            {
                try
                {
                    con.Open();
                    CConsultarUsuariosDistribuidores oVConsultarUsuariosDistribuidores = new CConsultarUsuariosDistribuidores();
                    lCConsultarUsuariosDistribuidores = oVConsultarUsuariosDistribuidores.ConsultarUsuariosDistribuidores(con, ruc);
                }
                catch (SqlException)
                {
                    
                }
            }
                return (lCConsultarUsuariosDistribuidores);
        }
    }
}