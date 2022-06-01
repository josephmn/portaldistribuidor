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
    public class CConsultarUsuariosDistribuidores
    {
        public List<EConsultarUsuariosDistribuidores> ConsultarUsuariosDistribuidores(SqlConnection con, String ruc)
        {
            List<EConsultarUsuariosDistribuidores> lEConsultarUsuariosDistribuidores = null;
            SqlCommand cmd = new SqlCommand("ASP_CONSULTAR_USUARIOS_DISTRIBUIDORES", con);
            cmd.CommandType = CommandType.StoredProcedure;

            cmd.Parameters.AddWithValue("@ruc", SqlDbType.Int).Value = ruc;

            SqlDataReader drd = cmd.ExecuteReader(CommandBehavior.SingleResult);

            if (drd != null)
            {
                lEConsultarUsuariosDistribuidores = new List<EConsultarUsuariosDistribuidores>();

                EConsultarUsuariosDistribuidores obEConsultarUsuariosDistribuidores = null;
                while (drd.Read())
                {
                    obEConsultarUsuariosDistribuidores = new EConsultarUsuariosDistribuidores();
                    obEConsultarUsuariosDistribuidores.i_id = Convert.ToInt32(drd["i_id"].ToString());
                    obEConsultarUsuariosDistribuidores.v_nombres = drd["v_nombres"].ToString();
                    obEConsultarUsuariosDistribuidores.v_correo = drd["v_correo"].ToString();
                    obEConsultarUsuariosDistribuidores.i_estado = Convert.ToInt32(drd["i_estado"].ToString());
                    obEConsultarUsuariosDistribuidores.v_estado = drd["v_estado"].ToString();
                    obEConsultarUsuariosDistribuidores.v_color_estado = drd["v_color_estado"].ToString();
                    obEConsultarUsuariosDistribuidores.v_ruc = drd["v_ruc"].ToString();
                    obEConsultarUsuariosDistribuidores.v_razon = drd["v_razon"].ToString();
                    lEConsultarUsuariosDistribuidores.Add(obEConsultarUsuariosDistribuidores);
                }
                drd.Close();
            }

            return (lEConsultarUsuariosDistribuidores);
        }
    }
}