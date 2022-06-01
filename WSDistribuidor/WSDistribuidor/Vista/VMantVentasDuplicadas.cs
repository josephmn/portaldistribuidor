using System;
using System.Collections.Generic;
using System.Data.SqlClient;
using System.Linq;
using System.Web;
using WSDistribuidor.Controller;
using WSDistribuidor.Entity;

namespace WSDistribuidor.view
{
    public class VMantVentasDuplicadas : BDconexion
    {
        public List<EMantenimiento> MantVentasDuplicadas(Int32 post, Int32 id, String ruc, String user)
        {
            List<EMantenimiento> lCEMantenimiento = null;
            using (SqlConnection con = new SqlConnection(conexion))
            {
                try
                {
                    con.Open();
                    CMantVentasDuplicadas oVMantVentasDuplicadas = new CMantVentasDuplicadas();
                    lCEMantenimiento = oVMantVentasDuplicadas.MantVentasDuplicadas(con, post, id, ruc, user);
                }
                catch (SqlException)
                {
                    
                }
            }
                return (lCEMantenimiento);
        }
    }
}