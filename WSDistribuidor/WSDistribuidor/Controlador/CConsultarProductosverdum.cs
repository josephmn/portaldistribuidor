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
    public class CConsultarProductosverdum
    {
        public List<EConsultarProductosverdum> ConsultarProductosverdum(SqlConnection con)
        {
            List<EConsultarProductosverdum> lEConsultarProductosverdum = null;
            SqlCommand cmd = new SqlCommand("ASP_LISTAR_PRODUCTOS_VERDUM", con);
            cmd.CommandType = CommandType.StoredProcedure;

            SqlDataReader drd = cmd.ExecuteReader(CommandBehavior.SingleResult);

            if (drd != null)
            {
                lEConsultarProductosverdum = new List<EConsultarProductosverdum>();

                EConsultarProductosverdum obEConsultarProductosverdum = null;
                while (drd.Read())
                {
                    obEConsultarProductosverdum = new EConsultarProductosverdum();
                    obEConsultarProductosverdum.i_producto = drd["i_producto"].ToString();
                    obEConsultarProductosverdum.v_producto = drd["v_producto"].ToString();
                    lEConsultarProductosverdum.Add(obEConsultarProductosverdum);
                }
                drd.Close();
            }

            return (lEConsultarProductosverdum);
        }
    }
}