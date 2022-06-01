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
    public class CConsultaCompania
    {
        public List<EConsultaCompania> ConsultaCompania(SqlConnection con)
        {
            List<EConsultaCompania> lEConsultaCompania = null;
            SqlCommand cmd = new SqlCommand("ASP_CONSULTAR_COMPANIA", con);
            cmd.CommandType = CommandType.StoredProcedure;

            SqlDataReader drd = cmd.ExecuteReader(CommandBehavior.SingleResult);

            if (drd != null)
            {
                lEConsultaCompania = new List<EConsultaCompania>();

                EConsultaCompania obEConsultaCompania = null;
                while (drd.Read())
                {
                    obEConsultaCompania = new EConsultaCompania();
                    obEConsultaCompania.v_ruc = drd["v_ruc"].ToString();
                    obEConsultaCompania.v_razon = drd["v_razon"].ToString();
                    obEConsultaCompania.v_dominio = drd["v_dominio"].ToString();
                    lEConsultaCompania.Add(obEConsultaCompania);
                }
                drd.Close();
            }

            return (lEConsultaCompania);
        }
    }
}