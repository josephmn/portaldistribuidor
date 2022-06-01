using System;
using System.Collections.Generic;
using System.Data.SqlClient;
using System.Linq;
using System.Web;
using WSDistribuidor.Controller;
using WSDistribuidor.Entity;

namespace WSDistribuidor.view
{
    public class VMantConfiguracionCorreo : BDconexion
    {
        public List<EMantenimiento> MantConfiguracionCorreo(String correosalida, String password, String nombresalida, String servidorentrante, Int32 puerto, Int32 user)
        {
            List<EMantenimiento> lCEMantenimiento = null;
            using (SqlConnection con = new SqlConnection(conexion))
            {
                try
                {
                    con.Open();
                    CMantConfiguracionCorreo oVMantConfiguracionCorreo = new CMantConfiguracionCorreo();
                    lCEMantenimiento = oVMantConfiguracionCorreo.MantConfiguracionCorreo(con, correosalida, password, nombresalida, servidorentrante, puerto, user);
                }
                catch (SqlException)
                {
                    
                }
            }
                return (lCEMantenimiento);
        }
    }
}