using System;
using System.Collections.Generic;
using System.Data.SqlClient;
using System.Linq;
using System.Web;
using WSDistribuidor.Controller;
using WSDistribuidor.Entity;

namespace WSDistribuidor.view
{
    public class VMantAsignarDistribuidores : BDconexion
    {
        public List<EMantenimiento> MantAsignarDistribuidores(Int32 post, String ruc, Int32 usuario, Int32 user)
        {
            List<EMantenimiento> lCEMantenimiento = null;
            using (SqlConnection con = new SqlConnection(conexion))
            {
                try
                {
                    con.Open();
                    CMantAsignarDistribuidores oVMantAsignarDistribuidores = new CMantAsignarDistribuidores();
                    lCEMantenimiento = oVMantAsignarDistribuidores.MantAsignarDistribuidores(con, post, ruc, usuario, user);
                }
                catch (SqlException)
                {

                }
            }
            return (lCEMantenimiento);
        }
    }
}