using System;
using System.Collections.Generic;
using System.Data.SqlClient;
using System.Linq;
using System.Web;
using WSDistribuidor.Controller;
using WSDistribuidor.Entity;

namespace WSDistribuidor.view
{
    public class VMantDistribuidores : BDconexion
    {
        public List<EMantenimiento> MantDistribuidores(Int32 post, String ruc, String razon, Int32 estado, Int32 user)
        {
            List<EMantenimiento> lCEMantenimiento = null;
            using (SqlConnection con = new SqlConnection(conexion))
            {
                try
                {
                    con.Open();
                    CMantDistribuidores oVMantDistribuidores = new CMantDistribuidores();
                    lCEMantenimiento = oVMantDistribuidores.MantDistribuidores(con, post, ruc, razon, estado, user);
                }
                catch (SqlException)
                {

                }
            }
            return (lCEMantenimiento);
        }
    }
}