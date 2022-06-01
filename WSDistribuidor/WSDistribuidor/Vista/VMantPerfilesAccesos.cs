﻿using System;
using System.Collections.Generic;
using System.Data.SqlClient;
using System.Linq;
using System.Web;
using WSDistribuidor.Controller;
using WSDistribuidor.Entity;

namespace WSDistribuidor.view
{
    public class VMantPerfilesAccesos : BDconexion
    {
        public List<EMantenimiento> MantPerfilesAccesos(Int32 post, Int32 menu, Int32 submenu, Int32 perfil, Int32 tipo, Int32 user)
        {
            List<EMantenimiento> lCEMantenimiento = null;
            using (SqlConnection con = new SqlConnection(conexion))
            {
                try
                {
                    con.Open();
                    CMantPerfilesAccesos oVMantPerfilesAccesos = new CMantPerfilesAccesos();
                    lCEMantenimiento = oVMantPerfilesAccesos.MantPerfilesAccesos(con, post, menu, submenu, perfil, tipo, user);
                }
                catch (SqlException)
                {
                    
                }
            }
                return (lCEMantenimiento);
        }
    }
}