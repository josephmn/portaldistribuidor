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
    public class CConsultarVentasRuc
    {
        public List<EConsultarVentasRuc> ConsultarVentasRuc(SqlConnection con, String ruc, Int32 user)
        {
            List<EConsultarVentasRuc> lEConsultarVentasRuc = null;
            SqlCommand cmd = new SqlCommand("ASP_CONSULTA_VENTAS", con);
            cmd.CommandType = CommandType.StoredProcedure;

            cmd.Parameters.AddWithValue("@ruc", SqlDbType.VarChar).Value = ruc;
            cmd.Parameters.AddWithValue("@user", SqlDbType.Int).Value = user;

            SqlDataReader drd = cmd.ExecuteReader(CommandBehavior.SingleResult);

            if (drd != null)
            {
                lEConsultarVentasRuc = new List<EConsultarVentasRuc>();

                EConsultarVentasRuc obEConsultarVentasRuc = null;
                while (drd.Read())
                {
                    obEConsultarVentasRuc = new EConsultarVentasRuc();
                    obEConsultarVentasRuc.i_id = drd["i_id"].ToString();
                    obEConsultarVentasRuc.v_ruc = drd["v_ruc"].ToString();
                    obEConsultarVentasRuc.v_razon = drd["v_razon"].ToString();
                    obEConsultarVentasRuc.v_archivo = drd["v_archivo"].ToString();
                    obEConsultarVentasRuc.v_fecha = drd["v_fecha"].ToString();
                    obEConsultarVentasRuc.v_registros = drd["v_registros"].ToString();
                    obEConsultarVentasRuc.v_nombres = drd["v_nombres"].ToString();
                    lEConsultarVentasRuc.Add(obEConsultarVentasRuc);
                }
                drd.Close();
            }

            return (lEConsultarVentasRuc);
        }
    }
}