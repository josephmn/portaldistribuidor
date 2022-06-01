using System;
using System.Collections.Generic;
using System.Data.SqlClient;
using System.Linq;
using System.Web;
using WSDistribuidor.Controller;
using WSDistribuidor.Entity;

namespace WSDistribuidor.view
{
    public class VSubMenu : BDconexion
    {
        public List<ESubMenu> SubMenu(Int32 perfil)
        {
            List<ESubMenu> lCSubMenu = null;
            using (SqlConnection con = new SqlConnection(conexion))
            {
                try
                {
                    con.Open();
                    CSubMenu oVSubMenu = new CSubMenu();
                    lCSubMenu = oVSubMenu.SubMenu(con, perfil);
                }
                catch (SqlException)
                {
                    
                }
            }
                return (lCSubMenu);
        }
    }
}