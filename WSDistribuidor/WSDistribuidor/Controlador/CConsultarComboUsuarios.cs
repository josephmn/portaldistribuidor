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
    public class CConsultarComboUsuarios
    {
        public List<EConsultarComboUsuarios> ConsultarComboUsuarios(SqlConnection con)
        {
            List<EConsultarComboUsuarios> lEConsultarComboUsuarios = null;
            SqlCommand cmd = new SqlCommand("ASP_CONSULTAR_COMBO_USUARIOS", con);
            cmd.CommandType = CommandType.StoredProcedure;

            SqlDataReader drd = cmd.ExecuteReader(CommandBehavior.SingleResult);

            if (drd != null)
            {
                lEConsultarComboUsuarios = new List<EConsultarComboUsuarios>();

                EConsultarComboUsuarios obEConsultarComboUsuarios = null;
                while (drd.Read())
                {
                    obEConsultarComboUsuarios = new EConsultarComboUsuarios();
                    obEConsultarComboUsuarios.v_codigo = Convert.ToInt32(drd["v_codigo"].ToString());
                    obEConsultarComboUsuarios.v_nombres = drd["v_nombres"].ToString();
                    obEConsultarComboUsuarios.v_selected = drd["v_selected"].ToString();
                    lEConsultarComboUsuarios.Add(obEConsultarComboUsuarios);
                }
                drd.Close();
            }

            return (lEConsultarComboUsuarios);
        }
    }
}