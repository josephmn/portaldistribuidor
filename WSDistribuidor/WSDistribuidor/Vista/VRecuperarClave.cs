using System;
using System.Collections.Generic;
using System.Data.SqlClient;
using System.Linq;
using System.Web;
using WSDistribuidor.Controller;
using WSDistribuidor.Entity;

namespace WSDistribuidor.view
{
    public class VRecuperarClave : BDconexion
    {
        public List<ERecuperarClave> RecuperarClave(Int32 post, String correo)
        {
            List<ERecuperarClave> lCRecuperarClave = null;
            using (SqlConnection con = new SqlConnection(conexion))
            {
                try
                {
                    con.Open();
                    CRecuperarClave oVRecuperarClave = new CRecuperarClave();
                    lCRecuperarClave = oVRecuperarClave.RecuperarClave(con, post, correo);
                }
                catch (SqlException)
                {
                    
                }
            }
                return (lCRecuperarClave);
        }
    }
}