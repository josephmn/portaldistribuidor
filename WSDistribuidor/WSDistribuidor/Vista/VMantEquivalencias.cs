using System;
using System.Collections.Generic;
using System.Data.SqlClient;
using System.Linq;
using System.Web;
using WSDistribuidor.Controller;
using WSDistribuidor.Entity;

namespace WSDistribuidor.view
{
    public class VMantEquivalencias : BDconexion
    {
        public List<EMantenimiento> MantEquivalencias(Int32 post, Int32 id, String ruc, String sku, String equ, Int32 estado, String min, String max, String user)
        {
            List<EMantenimiento> lCEMantenimiento = null;
            using (SqlConnection con = new SqlConnection(conexion))
            {
                try
                {
                    con.Open();
                    CMantEquivalencias oVMantEquivalencias = new CMantEquivalencias();
                    lCEMantenimiento = oVMantEquivalencias.MantEquivalencias(con, post, id, ruc, sku, equ, estado, min, max, user);
                }
                catch (SqlException)
                {
                    
                }
            }
                return (lCEMantenimiento);
        }
    }
}