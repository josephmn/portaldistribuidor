using System;
using System.Collections.Generic;
using System.Data.SqlClient;
using System.Linq;
using System.Web;
using WSDistribuidor.Controller;
using WSDistribuidor.Entity;

namespace WSDistribuidor.view
{
    public class VMantCompania : BDconexion
    {
        public List<EMantenimiento> MantCompania(String ruc, String razon, String dominio, Int32 user)
        {
            List<EMantenimiento> lCEMantenimiento = null;
            using (SqlConnection con = new SqlConnection(conexion))
            {
                try
                {
                    con.Open();
                    CMantCompania oVMantCompania = new CMantCompania();
                    lCEMantenimiento = oVMantCompania.MantCompania(con, ruc, razon, dominio, user);
                }
                catch (SqlException)
                {
                    
                }
            }
                return (lCEMantenimiento);
        }
    }
}