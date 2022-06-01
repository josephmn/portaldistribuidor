using System;
using System.Collections.Generic;
using System.Data.SqlClient;
using System.Linq;
using System.Web;
using WSDistribuidor.Controller;
using WSDistribuidor.Entity;

namespace WSDistribuidor.view
{
    public class VRegistroLogin : BDconexion
    {
        public List<ERegistroLogin> RegistroLogin(String nombres, String apellidos, String correo, String clave, String perfil)
        {
            List<ERegistroLogin> lCRegistroLogin = null;
            using (SqlConnection con = new SqlConnection(conexion))
            {
                try
                {
                    con.Open();
                    CRegistroLogin oVRegistroLogin = new CRegistroLogin();
                    lCRegistroLogin = oVRegistroLogin.RegistroLogin(con, nombres, apellidos, correo, clave, perfil);
                }
                catch (SqlException)
                {
                    
                }
            }
                return (lCRegistroLogin);
        }
    }
}