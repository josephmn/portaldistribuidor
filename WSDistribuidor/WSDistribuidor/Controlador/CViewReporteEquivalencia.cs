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
    public class CViewReporteEquivalencia
    {
        public List<EViewReporteEquivalencia> ViewReporteEquivalencia(SqlConnection con, Int32 post, String ruc)
        {
            List<EViewReporteEquivalencia> lEViewReporteEquivalencia = null;
            SqlCommand cmd = new SqlCommand("ASP_REPORTE_EQUIVALENCIA", con);
            cmd.CommandType = CommandType.StoredProcedure;

            cmd.Parameters.AddWithValue("@post", SqlDbType.Int).Value = post;
            cmd.Parameters.AddWithValue("@ruc", SqlDbType.VarChar).Value = ruc;

            SqlDataReader drd = cmd.ExecuteReader(CommandBehavior.SingleResult);

            if (drd != null)
            {
                lEViewReporteEquivalencia = new List<EViewReporteEquivalencia>();

                EViewReporteEquivalencia obEViewReporteEquivalencia = null;
                while (drd.Read())
                {
                    obEViewReporteEquivalencia = new EViewReporteEquivalencia();
                    obEViewReporteEquivalencia.i_id = drd["i_id"].ToString();
                    obEViewReporteEquivalencia.v_ruc = drd["v_ruc"].ToString();
                    obEViewReporteEquivalencia.v_razon = drd["v_razon"].ToString();
                    obEViewReporteEquivalencia.i_producto = drd["i_producto"].ToString();
                    obEViewReporteEquivalencia.f_cantidad = drd["f_cantidad"].ToString();
                    obEViewReporteEquivalencia.d_fecha = drd["d_fecha"].ToString();
                    obEViewReporteEquivalencia.v_equ = drd["v_equ"].ToString();
                    obEViewReporteEquivalencia.v_producto = drd["v_producto"].ToString();
                    obEViewReporteEquivalencia.f_min = drd["f_min"].ToString();
                    obEViewReporteEquivalencia.v_min = drd["v_min"].ToString();
                    obEViewReporteEquivalencia.f_max = drd["f_max"].ToString();
                    obEViewReporteEquivalencia.v_max = drd["v_max"].ToString();
                    lEViewReporteEquivalencia.Add(obEViewReporteEquivalencia);
                }
                drd.Close();
            }

            return (lEViewReporteEquivalencia);
        }
    }
}