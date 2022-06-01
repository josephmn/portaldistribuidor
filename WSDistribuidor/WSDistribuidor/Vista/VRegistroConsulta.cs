using System;
using System.Collections.Generic;
using System.Data.SqlClient;
using System.Linq;
using System.Web;
using WSDistribuidor.Controller;
using WSDistribuidor.Entity;

namespace WSDistribuidor.view
{
    public class VRegistroConsulta : BDconexion
    {
        public List<ERegistroConsulta> RegistroConsulta(Int32 post, String correo)
        {
            List<ERegistroConsulta> lCRegistroConsulta = null;
            using (SqlConnection con = new SqlConnection(conexion))
            {
                try
                {
                    con.Open();
                    CRegistroConsulta oVRegistroConsulta = new CRegistroConsulta();
                    lCRegistroConsulta = oVRegistroConsulta.RegistroConsulta(con, post, correo);
                }
                catch (SqlException)
                {
                    
                }
            }
                return (lCRegistroConsulta);
        }
    }
}