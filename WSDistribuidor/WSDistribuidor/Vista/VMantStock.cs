using System;
using System.Collections.Generic;
using System.Data.SqlClient;
using System.Linq;
using System.Web;
using WSDistribuidor.Controller;
using WSDistribuidor.Entity;

namespace WSDistribuidor.view
{
    public class VMantStock : BDconexion
    {
        public List<EMantenimiento> MantStock(Int32 post, String ruc, String razon, String fecha, String iproducto, String vproducto, String kilos, String cantidad, String archivo, String registro, String user)
        {
            List<EMantenimiento> lCEMantenimiento = null;
            using (SqlConnection con = new SqlConnection(conexion))
            {
                try
                {
                    con.Open();
                    CMantStock oVMantStock = new CMantStock();
                    lCEMantenimiento = oVMantStock.MantStock(con, post, ruc, razon, fecha, iproducto, vproducto, kilos, cantidad, archivo, registro, user);
                }
                catch (SqlException)
                {
                    
                }
            }
                return (lCEMantenimiento);
        }
    }
}