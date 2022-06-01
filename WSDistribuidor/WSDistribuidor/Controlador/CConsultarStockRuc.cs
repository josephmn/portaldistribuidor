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
    public class CConsultarStockRuc
    {
        public List<EConsultarStockRuc> ConsultarStockRuc(SqlConnection con, String ruc, Int32 user)
        {
            List<EConsultarStockRuc> lEConsultarStockRuc = null;
            SqlCommand cmd = new SqlCommand("ASP_CONSULTA_STOCK", con);
            cmd.CommandType = CommandType.StoredProcedure;

            cmd.Parameters.AddWithValue("@ruc", SqlDbType.VarChar).Value = ruc;
            cmd.Parameters.AddWithValue("@user", SqlDbType.Int).Value = user;

            SqlDataReader drd = cmd.ExecuteReader(CommandBehavior.SingleResult);

            if (drd != null)
            {
                lEConsultarStockRuc = new List<EConsultarStockRuc>();

                EConsultarStockRuc obEConsultarStockRuc = null;
                while (drd.Read())
                {
                    obEConsultarStockRuc = new EConsultarStockRuc();
                    obEConsultarStockRuc.i_id = drd["i_id"].ToString();
                    obEConsultarStockRuc.v_ruc = drd["v_ruc"].ToString();
                    obEConsultarStockRuc.v_razon = drd["v_razon"].ToString();
                    obEConsultarStockRuc.v_archivo = drd["v_archivo"].ToString();
                    obEConsultarStockRuc.v_fecha = drd["v_fecha"].ToString();
                    obEConsultarStockRuc.v_registros = drd["v_registros"].ToString();
                    obEConsultarStockRuc.v_nombres = drd["v_nombres"].ToString();
                    lEConsultarStockRuc.Add(obEConsultarStockRuc);
                }
                drd.Close();
            }

            return (lEConsultarStockRuc);
        }
    }
}