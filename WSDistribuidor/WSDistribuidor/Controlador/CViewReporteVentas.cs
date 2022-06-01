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
    public class CViewReporteVentas
    {
        public List<EViewReporteVentas> ViewReporteVentas(SqlConnection con, Int32 post, String fechainicio, String fechafin, String departamento, String distrito, String distribuidor)
        {
            List<EViewReporteVentas> lEViewReporteVentas = null;
            SqlCommand cmd = new SqlCommand("ASP_REPORTE_VENTAS", con);
            cmd.CommandType = CommandType.StoredProcedure;

            cmd.Parameters.AddWithValue("@post", SqlDbType.Int).Value = post;
            cmd.Parameters.AddWithValue("@fechainicio", SqlDbType.VarChar).Value = fechainicio;
            cmd.Parameters.AddWithValue("@fechafin", SqlDbType.VarChar).Value = fechafin;
            cmd.Parameters.AddWithValue("@departamento", SqlDbType.VarChar).Value = departamento;
            cmd.Parameters.AddWithValue("@distrito", SqlDbType.VarChar).Value = distrito;
            cmd.Parameters.AddWithValue("@distribuidor", SqlDbType.VarChar).Value = distribuidor;

            SqlDataReader drd = cmd.ExecuteReader(CommandBehavior.SingleResult);

            if (drd != null)
            {
                lEViewReporteVentas = new List<EViewReporteVentas>();

                EViewReporteVentas obEViewReporteVentas = null;
                while (drd.Read())
                {
                    obEViewReporteVentas = new EViewReporteVentas();
                    obEViewReporteVentas.i_id = drd["i_id"].ToString();
                    obEViewReporteVentas.v_ruc = drd["v_ruc"].ToString();
                    obEViewReporteVentas.v_razon = drd["v_razon"].ToString();
                    obEViewReporteVentas.d_fecha = drd["d_fecha"].ToString();
                    obEViewReporteVentas.i_producto = drd["i_producto"].ToString();
                    obEViewReporteVentas.v_producto = drd["v_producto"].ToString();
                    obEViewReporteVentas.i_cliente = drd["i_cliente"].ToString();
                    obEViewReporteVentas.v_cliente = drd["v_cliente"].ToString();
                    obEViewReporteVentas.v_tipo_cliente = drd["v_tipo_cliente"].ToString();
                    obEViewReporteVentas.v_departamento = drd["v_departamento"].ToString();
                    obEViewReporteVentas.v_provincia = drd["v_provincia"].ToString();
                    obEViewReporteVentas.v_distrito = drd["v_distrito"].ToString();
                    obEViewReporteVentas.f_venta = drd["f_venta"].ToString();
                    obEViewReporteVentas.f_kilos = drd["f_kilos"].ToString();
                    obEViewReporteVentas.f_cantidad = drd["f_cantidad"].ToString();
                    lEViewReporteVentas.Add(obEViewReporteVentas);
                }
                drd.Close();
            }

            return (lEViewReporteVentas);
        }
    }
}