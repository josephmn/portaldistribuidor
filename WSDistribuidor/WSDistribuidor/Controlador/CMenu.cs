using System;
using System.Collections.Generic;
using System.Collections.ObjectModel;
using System.Collections.Specialized;
using System.Linq;
using System.Web;
using System.Data;
using System.Data.SqlClient;
using WSDistribuidor.Entity;

namespace WSDistribuidor.Controller
{
    public class CMenu
    {
        public List<EMenu> Menu(SqlConnection con, Int32 perfil)
        {
            List<EMenu> lEMenu = null;
            SqlCommand cmd = new SqlCommand("ASP_MENU", con);
            cmd.CommandType = CommandType.StoredProcedure;

            SqlParameter par1 = cmd.Parameters.Add("@perfil", SqlDbType.Int);
            par1.Direction = ParameterDirection.Input;
            par1.Value = perfil;

            SqlDataReader drd = cmd.ExecuteReader(CommandBehavior.SingleResult);

            if (drd != null)
            {
                lEMenu = new List<EMenu>();

                EMenu obEMenu = null;
                while (drd.Read())
                {
                    obEMenu = new EMenu();
                    obEMenu.i_id = drd["i_id"].ToString();
                    obEMenu.v_nombre = drd["v_nombre"].ToString();
                    obEMenu.v_descripcion = drd["v_descripcion"].ToString();
                    obEMenu.v_link = drd["v_link"].ToString();
                    obEMenu.i_submenu = drd["i_submenu"].ToString();
                    obEMenu.v_icono = drd["v_icono"].ToString();
                    obEMenu.v_perfil = drd["v_perfil"].ToString();
                    lEMenu.Add(obEMenu);
                }
                drd.Close();
            }

            return (lEMenu);
        }
    }
}