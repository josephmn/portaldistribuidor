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
    public class CMantConfiguracionCorreo
    {
        public List<EMantenimiento> MantConfiguracionCorreo(SqlConnection con, String correosalida, String password, String nombresalida, String servidorentrante, Int32 puerto, Int32 user)
        {
            List<EMantenimiento> lEMantenimiento = null;
            SqlCommand cmd = new SqlCommand("ASP_MANT_CORREO_CONFIGURACION", con);
            cmd.CommandType = CommandType.StoredProcedure;

            cmd.Parameters.AddWithValue("@correosalida", SqlDbType.VarChar).Value = correosalida;
            cmd.Parameters.AddWithValue("@password", SqlDbType.VarChar).Value = password;
            cmd.Parameters.AddWithValue("@nombresalida", SqlDbType.VarChar).Value = nombresalida;
            cmd.Parameters.AddWithValue("@servidorentrante", SqlDbType.VarChar).Value = servidorentrante;
            cmd.Parameters.AddWithValue("@puerto", SqlDbType.Int).Value = puerto;
            cmd.Parameters.AddWithValue("@user", SqlDbType.Int).Value = user;

            SqlDataReader drd = cmd.ExecuteReader(CommandBehavior.SingleResult);

            if (drd != null)
            {
                lEMantenimiento = new List<EMantenimiento>();

                EMantenimiento obEMantenimiento = null;
                while (drd.Read())
                {
                    obEMantenimiento = new EMantenimiento();
                    obEMantenimiento.v_icon = drd["v_icon"].ToString();
                    obEMantenimiento.v_title = drd["v_title"].ToString();
                    obEMantenimiento.v_text = drd["v_text"].ToString();
                    obEMantenimiento.i_timer = Convert.ToInt32(drd["i_timer"].ToString());
                    obEMantenimiento.i_case = Convert.ToInt32(drd["i_case"].ToString());
                    obEMantenimiento.v_progressbar = Convert.ToBoolean(drd["v_progressbar"].ToString());
                    lEMantenimiento.Add(obEMantenimiento);
                }
                drd.Close();
            }

            return (lEMantenimiento);
        }
    }
}