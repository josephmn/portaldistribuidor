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
    public class CConsultarArchivosVentasRuc
    {
        public List<EConsultarArchivosVentasRuc> ConsultarArchivosVentasRuc(SqlConnection con, String archivo)
        {
            List<EConsultarArchivosVentasRuc> lEConsultarArchivosVentasRuc = null;
            SqlCommand cmd = new SqlCommand("ASP_DESCARGAR_ARCHIVO_VENTAS_RUC", con);
            cmd.CommandType = CommandType.StoredProcedure;

            cmd.Parameters.AddWithValue("@archivo", SqlDbType.VarChar).Value = archivo;

            SqlDataReader drd = cmd.ExecuteReader(CommandBehavior.SingleResult);

            if (drd != null)
            {
                lEConsultarArchivosVentasRuc = new List<EConsultarArchivosVentasRuc>();

                EConsultarArchivosVentasRuc obEConsultarArchivosVentasRuc = null;
                while (drd.Read())
                {
                    obEConsultarArchivosVentasRuc = new EConsultarArchivosVentasRuc();
                    obEConsultarArchivosVentasRuc.d_fecha = drd["d_fecha"].ToString();
                    obEConsultarArchivosVentasRuc.v_ruc = drd["v_ruc"].ToString();
                    obEConsultarArchivosVentasRuc.v_razon = drd["v_razon"].ToString();
                    obEConsultarArchivosVentasRuc.i_producto = drd["i_producto"].ToString();
                    obEConsultarArchivosVentasRuc.v_producto = drd["v_producto"].ToString();
                    obEConsultarArchivosVentasRuc.i_cliente = drd["i_cliente"].ToString();
                    obEConsultarArchivosVentasRuc.v_cliente = drd["v_cliente"].ToString();
                    obEConsultarArchivosVentasRuc.v_tipo_cliente = drd["v_tipo_cliente"].ToString();
                    obEConsultarArchivosVentasRuc.v_departamento = drd["v_departamento"].ToString();
                    obEConsultarArchivosVentasRuc.v_provincia = drd["v_provincia"].ToString();
                    obEConsultarArchivosVentasRuc.v_distrito = drd["v_distrito"].ToString();
                    obEConsultarArchivosVentasRuc.f_venta = drd["f_venta"].ToString();
                    obEConsultarArchivosVentasRuc.f_kilos = drd["f_kilos"].ToString();
                    obEConsultarArchivosVentasRuc.f_cantidad = drd["f_cantidad"].ToString();
                    lEConsultarArchivosVentasRuc.Add(obEConsultarArchivosVentasRuc);
                }
                drd.Close();
            }

            return (lEConsultarArchivosVentasRuc);
        }
    }
}