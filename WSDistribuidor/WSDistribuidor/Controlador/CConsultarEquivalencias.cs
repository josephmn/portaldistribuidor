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
    public class CConsultarEquivalencias
    {
        public List<EConsultarEquivalencias> ConsultarEquivalencias(SqlConnection con)
        {
            List<EConsultarEquivalencias> lEConsultarEquivalencias = null;
            SqlCommand cmd = new SqlCommand("ASP_LISTAR_EQUIVALENCIAS", con);
            cmd.CommandType = CommandType.StoredProcedure;

            SqlDataReader drd = cmd.ExecuteReader(CommandBehavior.SingleResult);

            if (drd != null)
            {
                lEConsultarEquivalencias = new List<EConsultarEquivalencias>();

                EConsultarEquivalencias obEConsultarEquivalencias = null;
                while (drd.Read())
                {
                    obEConsultarEquivalencias = new EConsultarEquivalencias();
                    obEConsultarEquivalencias.i_id = Convert.ToInt32(drd["i_id"].ToString());
                    obEConsultarEquivalencias.v_ruc = drd["v_ruc"].ToString();
                    obEConsultarEquivalencias.v_razon = drd["v_razon"].ToString();
                    obEConsultarEquivalencias.v_sku = drd["v_sku"].ToString();
                    obEConsultarEquivalencias.v_equ = drd["v_equ"].ToString();
                    obEConsultarEquivalencias.v_producto = drd["v_producto"].ToString();
                    obEConsultarEquivalencias.i_estado = Convert.ToInt32(drd["i_estado"].ToString());
                    obEConsultarEquivalencias.v_estado = drd["v_estado"].ToString();
                    obEConsultarEquivalencias.v_color_estado = drd["v_color_estado"].ToString();
                    obEConsultarEquivalencias.f_min = drd["f_min"].ToString();
                    obEConsultarEquivalencias.f_max = drd["f_max"].ToString();
                    lEConsultarEquivalencias.Add(obEConsultarEquivalencias);
                }
                drd.Close();
            }

            return (lEConsultarEquivalencias);
        }
    }
}