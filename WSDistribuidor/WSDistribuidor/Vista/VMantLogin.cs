using System;
using System.Collections.Generic;
using System.Data.SqlClient;
using System.Linq;
using System.Web;
using WSDistribuidor.Controller;
using WSDistribuidor.Entity;

namespace WSDistribuidor.view
{
    public class VMantLogin : BDconexion
    {
        public List<EMantenimiento> MantLogin(Int32 post, Int32 id, String nombres, String apellidos, String foto, Int32 user)
        {
            List<EMantenimiento> lCEMantenimiento = null;
            using (SqlConnection con = new SqlConnection(conexion))
            {
                try
                {
                    con.Open();
                    CMantLogin oVMantLogin = new CMantLogin();
                    lCEMantenimiento = oVMantLogin.MantLogin(con, post, id, nombres, apellidos, foto, user);
                }
                catch (SqlException)
                {
                    
                }
            }
                return (lCEMantenimiento);
        }
    }
}