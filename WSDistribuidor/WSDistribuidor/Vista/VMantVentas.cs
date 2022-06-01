using System;
using System.Collections.Generic;
using System.Data.SqlClient;
using System.Linq;
using System.Web;
using WSDistribuidor.Controller;
using WSDistribuidor.Entity;

namespace WSDistribuidor.view
{
    public class VMantVentas : BDconexion
    {
        public List<EMantenimiento> MantVentas(Int32 post, String ruc, String razon, String fecha, String iproducto, String vproducto, String icliente, String vcliente, 
            String tipocliente, String departamento, String provincia, String distrito, String venta, String kilos, String cantidad, String archivo, String registro, String user)
        {
            List<EMantenimiento> lCEMantenimiento = null;
            using (SqlConnection con = new SqlConnection(conexion))
            {
                try
                {
                    con.Open();
                    CMantVentas oVMantVentas = new CMantVentas();
                    lCEMantenimiento = oVMantVentas.MantVentas(con, post, ruc, razon, fecha, iproducto, vproducto, icliente, 
                        vcliente, tipocliente, departamento, provincia, distrito, venta, kilos, cantidad, archivo, registro, user);
                }
                catch (SqlException)
                {
                    
                }
            }
                return (lCEMantenimiento);
        }
    }
}