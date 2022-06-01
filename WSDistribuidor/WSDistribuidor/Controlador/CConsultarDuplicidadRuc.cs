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
    public class CConsultarDuplicidadRuc
    {
        public List<EConsultarDuplicidadRuc> ConsultarDuplicidadRuc(SqlConnection con, String ruc)
        {
            List<EConsultarDuplicidadRuc> lEConsultarDuplicidadRuc = null;
            SqlCommand cmd = new SqlCommand("ASP_LISTAR_DUPLICADOS_RUC", con);
            cmd.CommandType = CommandType.StoredProcedure;

            cmd.Parameters.AddWithValue("@ruc", SqlDbType.VarChar).Value = ruc;

            SqlDataReader drd = cmd.ExecuteReader(CommandBehavior.SingleResult);

            if (drd != null)
            {
                lEConsultarDuplicidadRuc = new List<EConsultarDuplicidadRuc>();

                EConsultarDuplicidadRuc obEConsultarDuplicidadRuc = null;
                while (drd.Read())
                {
                    obEConsultarDuplicidadRuc = new EConsultarDuplicidadRuc();
                    obEConsultarDuplicidadRuc.i_id = drd["i_id"].ToString();
                    obEConsultarDuplicidadRuc.v_orden = drd["v_orden"].ToString();
                    obEConsultarDuplicidadRuc.v_duplicado = drd["v_duplicado"].ToString();
                    obEConsultarDuplicidadRuc.v_color_duplicado = drd["v_color_duplicado"].ToString();
                    obEConsultarDuplicidadRuc.v_ver_duplicado = drd["v_ver_duplicado"].ToString();
                    obEConsultarDuplicidadRuc.v_ruc = drd["v_ruc"].ToString();
                    obEConsultarDuplicidadRuc.v_razon = drd["v_razon"].ToString();
                    obEConsultarDuplicidadRuc.d_fecha = drd["d_fecha"].ToString();
                    obEConsultarDuplicidadRuc.i_producto = drd["i_producto"].ToString();
                    obEConsultarDuplicidadRuc.v_producto = drd["v_producto"].ToString();
                    obEConsultarDuplicidadRuc.i_cliente = drd["i_cliente"].ToString();
                    obEConsultarDuplicidadRuc.v_cliente = drd["v_cliente"].ToString();
                    obEConsultarDuplicidadRuc.v_tipo_cliente = drd["v_tipo_cliente"].ToString();
                    obEConsultarDuplicidadRuc.v_departamento = drd["v_departamento"].ToString();
                    obEConsultarDuplicidadRuc.v_provincia = drd["v_provincia"].ToString();
                    obEConsultarDuplicidadRuc.v_distrito = drd["v_distrito"].ToString();
                    obEConsultarDuplicidadRuc.f_venta = drd["f_venta"].ToString();
                    obEConsultarDuplicidadRuc.f_kilos = drd["f_kilos"].ToString();
                    obEConsultarDuplicidadRuc.f_cantidad = drd["f_cantidad"].ToString();
                    lEConsultarDuplicidadRuc.Add(obEConsultarDuplicidadRuc);
                }
                drd.Close();
            }

            return (lEConsultarDuplicidadRuc);
        }
    }
}