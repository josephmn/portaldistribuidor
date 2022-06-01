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
    public class CConsultarDistribuidores
    {
        public List<EConsultarDistribuidores> ConsultarDistribuidores(SqlConnection con, Int32 post)
        {
            List<EConsultarDistribuidores> lEConsultarDistribuidores = null;
            SqlCommand cmd = new SqlCommand("ASP_CONSULTAR_DISTRIBUIDORES", con);
            cmd.CommandType = CommandType.StoredProcedure;

            cmd.Parameters.AddWithValue("@post", SqlDbType.Int).Value = post;

            SqlDataReader drd = cmd.ExecuteReader(CommandBehavior.SingleResult);

            if (drd != null)
            {
                lEConsultarDistribuidores = new List<EConsultarDistribuidores>();

                EConsultarDistribuidores obEConsultarDistribuidores = null;
                while (drd.Read())
                {
                    obEConsultarDistribuidores = new EConsultarDistribuidores();
                    obEConsultarDistribuidores.i_id = Convert.ToInt32(drd["i_id"].ToString());
                    obEConsultarDistribuidores.v_ruc = drd["v_ruc"].ToString();
                    obEConsultarDistribuidores.v_razon = drd["v_razon"].ToString();
                    obEConsultarDistribuidores.i_estado = Convert.ToInt32(drd["i_estado"].ToString());
                    obEConsultarDistribuidores.v_estado = drd["v_estado"].ToString();
                    obEConsultarDistribuidores.v_color_estado = drd["v_color_estado"].ToString();
                    obEConsultarDistribuidores.v_total = Convert.ToInt32(drd["v_total"].ToString());
                    lEConsultarDistribuidores.Add(obEConsultarDistribuidores);
                }
                drd.Close();
            }

            return (lEConsultarDistribuidores);
        }
    }
}