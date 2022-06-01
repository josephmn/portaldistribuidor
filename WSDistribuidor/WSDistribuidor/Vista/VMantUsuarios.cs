using System;
using System.Collections.Generic;
using System.Data.SqlClient;
using System.Linq;
using System.Web;
using WSDistribuidor.Controller;
using WSDistribuidor.Entity;

namespace WSDistribuidor.view
{
    public class VMantUsuarios : BDconexion
    {
        public List<EMantenimiento> MantUsuarios(Int32 post, Int32 codigo, String nombres, String apellidos, String correo, String password, Int32 estado, Int32 perfil, Int32 confirmar, Int32 user)
        {
            List<EMantenimiento> lCEMantenimiento = null;
            using (SqlConnection con = new SqlConnection(conexion))
            {
                try
                {
                    con.Open();
                    CMantUsuarios oVMantUsuarios = new CMantUsuarios();
                    lCEMantenimiento = oVMantUsuarios.MantUsuarios(con, post, codigo, nombres, apellidos, correo, password, estado, perfil, confirmar, user);
                }
                catch (SqlException)
                {
                    
                }
            }
                return (lCEMantenimiento);
        }
    }
}