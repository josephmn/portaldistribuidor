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
    public class CListaControlDistribuidor
    {
        public List<EListaControlDistribuidor> ListaControlDistribuidor(SqlConnection con)
        {
            List<EListaControlDistribuidor> lEListaControlDistribuidor = null;
            SqlCommand cmd = new SqlCommand("ASP_CORREO_CONTROL", con);
            cmd.CommandType = CommandType.StoredProcedure;

            //cmd.Parameters.AddWithValue("@post", SqlDbType.Int).Value = post;
            //cmd.Parameters.AddWithValue("@ruc", SqlDbType.VarChar).Value = ruc;

            SqlDataReader drd = cmd.ExecuteReader(CommandBehavior.SingleResult);

            if (drd != null)
            {
                lEListaControlDistribuidor = new List<EListaControlDistribuidor>();

                EListaControlDistribuidor obEListaControlDistribuidor = null;
                while (drd.Read())
                {
                    obEListaControlDistribuidor = new EListaControlDistribuidor();
                    obEListaControlDistribuidor.i_id = Convert.ToInt32(drd["i_id"].ToString());
                    obEListaControlDistribuidor.v_ruc = drd["v_ruc"].ToString();
                    obEListaControlDistribuidor.v_razon = drd["v_razon"].ToString();
                    obEListaControlDistribuidor.v_archivo = drd["v_archivo"].ToString();
                    obEListaControlDistribuidor.i_row_success = Convert.ToInt32(drd["i_row_success"].ToString());
                    obEListaControlDistribuidor.i_row_error = Convert.ToInt32(drd["i_row_error"].ToString());
                    obEListaControlDistribuidor.i_cantidad = Convert.ToDouble(drd["i_cantidad"].ToString());
                    obEListaControlDistribuidor.i_venta = Convert.ToDouble(drd["i_venta"].ToString());
                    obEListaControlDistribuidor.d_fecha = Convert.ToDateTime(drd["d_fecha"].ToString());
                    lEListaControlDistribuidor.Add(obEListaControlDistribuidor);
                }
                drd.Close();
            }

            return (lEListaControlDistribuidor);
        }
    }
}