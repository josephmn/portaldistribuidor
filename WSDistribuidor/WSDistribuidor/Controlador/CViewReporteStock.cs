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
    public class CViewReporteStock
    {
        public List<EViewReporteStock> ViewReporteStock(SqlConnection con, Int32 post, String fechainicio, String fechafin, String distribuidor)
        {
            List<EViewReporteStock> lEViewReporteStock = null;
            SqlCommand cmd = new SqlCommand("ASP_REPORTE_STOCK", con);
            cmd.CommandType = CommandType.StoredProcedure;

            cmd.Parameters.AddWithValue("@post", SqlDbType.Int).Value = post;
            cmd.Parameters.AddWithValue("@fechainicio", SqlDbType.VarChar).Value = fechainicio;
            cmd.Parameters.AddWithValue("@fechafin", SqlDbType.VarChar).Value = fechafin;
            cmd.Parameters.AddWithValue("@distribuidor", SqlDbType.VarChar).Value = distribuidor;

            SqlDataReader drd = cmd.ExecuteReader(CommandBehavior.SingleResult);

            if (drd != null)
            {
                lEViewReporteStock = new List<EViewReporteStock>();

                EViewReporteStock obEViewReporteStock = null;
                while (drd.Read())
                {
                    obEViewReporteStock = new EViewReporteStock();
                    obEViewReporteStock.i_id = drd["i_id"].ToString();
                    obEViewReporteStock.v_ruc = drd["v_ruc"].ToString();
                    obEViewReporteStock.v_razon = drd["v_razon"].ToString();
                    obEViewReporteStock.d_fecha = drd["d_fecha"].ToString();
                    obEViewReporteStock.i_producto = drd["i_producto"].ToString();
                    obEViewReporteStock.v_producto = drd["v_producto"].ToString();
                    obEViewReporteStock.f_kilos = drd["f_kilos"].ToString();
                    obEViewReporteStock.f_cantidad = drd["f_cantidad"].ToString();
                    lEViewReporteStock.Add(obEViewReporteStock);
                }
                drd.Close();
            }

            return (lEViewReporteStock);
        }
    }
}