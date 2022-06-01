using System;
using System.Collections.Generic;
using System.Data.SqlClient;
using System.Linq;
using System.Web;
using WSDistribuidor.Controller;
using WSDistribuidor.Entity;

namespace WSDistribuidor.view
{
    public class VMantPerfiles : BDconexion
    {
        public List<EMantenimiento> MantPerfiles(Int32 post, String nombre, Int32 estado, Int32 perfil, Int32 user)
        {
            List<EMantenimiento> lCEMantenimiento = null;
            using (SqlConnection con = new SqlConnection(conexion))
            {
                try
                {
                    con.Open();
                    CMantPerfiles oVMantPerfiles = new CMantPerfiles();
                    lCEMantenimiento = oVMantPerfiles.MantPerfiles(con, post, nombre, estado, perfil, user);
                }
                catch (SqlException)
                {

                }
            }
            return (lCEMantenimiento);
        }
    }
}