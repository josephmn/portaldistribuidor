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
    public class CMantVentas
    {
        public List<EMantenimiento> MantVentas(SqlConnection con, Int32 post, String ruc, String razon, String fecha, String iproducto, String vproducto, String icliente, String vcliente, 
            String tipocliente, String departamento, String provincia, String distrito, String venta, String kilos, String cantidad, String archivo, String registro, String user)
        {
            List<EMantenimiento> lEMantenimiento = null;
            SqlCommand cmd = new SqlCommand("ASP_MANT_VENTAS", con);
            cmd.CommandType = CommandType.StoredProcedure;

            cmd.Parameters.AddWithValue("@post", SqlDbType.Int).Value = post;
            cmd.Parameters.AddWithValue("@ruc", SqlDbType.VarChar).Value = ruc;
            cmd.Parameters.AddWithValue("@razon", SqlDbType.VarChar).Value = razon;
            cmd.Parameters.AddWithValue("@fecha", SqlDbType.VarChar).Value = fecha;
            cmd.Parameters.AddWithValue("@iproducto", SqlDbType.VarChar).Value = iproducto;
            cmd.Parameters.AddWithValue("@vproducto", SqlDbType.VarChar).Value = vproducto;
            cmd.Parameters.AddWithValue("@icliente", SqlDbType.VarChar).Value = icliente;
            cmd.Parameters.AddWithValue("@vcliente", SqlDbType.VarChar).Value = vcliente;
            cmd.Parameters.AddWithValue("@tipocliente", SqlDbType.VarChar).Value = tipocliente;
            cmd.Parameters.AddWithValue("@departamento", SqlDbType.VarChar).Value = departamento;
            cmd.Parameters.AddWithValue("@provincia", SqlDbType.VarChar).Value = provincia;
            cmd.Parameters.AddWithValue("@distrito", SqlDbType.VarChar).Value = distrito;
            cmd.Parameters.AddWithValue("@venta", SqlDbType.VarChar).Value = venta;
            cmd.Parameters.AddWithValue("@kilos", SqlDbType.VarChar).Value = kilos;
            cmd.Parameters.AddWithValue("@cantidad", SqlDbType.VarChar).Value = cantidad;
            cmd.Parameters.AddWithValue("@archivo", SqlDbType.VarChar).Value = archivo;
            cmd.Parameters.AddWithValue("@fregistro", SqlDbType.VarChar).Value = registro;
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