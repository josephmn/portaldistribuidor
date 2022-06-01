using System;
using System.Collections.Generic;
using System.Data.SqlClient;
using System.Linq;
using System.Web;
using WSDistribuidor.Controller;
using WSDistribuidor.Entity;

namespace WSDistribuidor.view
{
    public class VUsuarios : BDconexion
    {
        public List<EUsuarios> Usuarios(Int32 post, Int32 codigo)
        {
            List<EUsuarios> lCUsuarios = null;
            using (SqlConnection con = new SqlConnection(conexion))
            {
                try
                {
                    con.Open();
                    CUsuarios oVUsuarios = new CUsuarios();
                    lCUsuarios = oVUsuarios.Usuarios(con, post, codigo);
                }
                catch (SqlException)
                {
                    
                }
            }
                return (lCUsuarios);
        }
    }
}