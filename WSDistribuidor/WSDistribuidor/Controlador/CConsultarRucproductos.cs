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
    public class CConsultarRucproductos
    {
        public List<EConsultarRucproductos> ConsultarRucproductos(SqlConnection con, String ruc)
        {
            List<EConsultarRucproductos> lEConsultarRucproductos = null;
            SqlCommand cmd = new SqlCommand("ASP_LISTAR_PRODUCTOS_EQUIVALENCIAS", con);
            cmd.CommandType = CommandType.StoredProcedure;

            cmd.Parameters.AddWithValue("@ruc", SqlDbType.VarChar).Value = ruc;

            SqlDataReader drd = cmd.ExecuteReader(CommandBehavior.SingleResult);

            if (drd != null)
            {
                lEConsultarRucproductos = new List<EConsultarRucproductos>();

                EConsultarRucproductos obEConsultarRucproductos = null;
                while (drd.Read())
                {
                    obEConsultarRucproductos = new EConsultarRucproductos();
                    obEConsultarRucproductos.v_ruc = drd["v_ruc"].ToString();
                    obEConsultarRucproductos.i_producto = Convert.ToInt32(drd["i_producto"].ToString());
                    obEConsultarRucproductos.v_producto = drd["v_producto"].ToString();
                    lEConsultarRucproductos.Add(obEConsultarRucproductos);
                }
                drd.Close();
            }

            return (lEConsultarRucproductos);
        }
    }
}