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
    public class CConsultaLogin
    {
        public List<EConsultaLogin> ConsultaLogin(SqlConnection con, Int32 id)
        {
            List<EConsultaLogin> lEConsultaLogin = null;
            SqlCommand cmd = new SqlCommand("ASP_CONSULTAR_LOGIN", con);
            cmd.CommandType = CommandType.StoredProcedure;

            SqlParameter par1 = cmd.Parameters.Add("@id", SqlDbType.Int);
            par1.Direction = ParameterDirection.Input;
            par1.Value = id;

            SqlDataReader drd = cmd.ExecuteReader(CommandBehavior.SingleResult);

            if (drd != null)
            {
                lEConsultaLogin = new List<EConsultaLogin>();

                EConsultaLogin obEConsultaLogin = null;
                while (drd.Read())
                {
                    obEConsultaLogin = new EConsultaLogin();
                    obEConsultaLogin.v_nombres = drd["v_nombres"].ToString();
                    obEConsultaLogin.v_apellidos = drd["v_apellidos"].ToString();
                    obEConsultaLogin.v_correo = drd["v_correo"].ToString();
                    lEConsultaLogin.Add(obEConsultaLogin);
                }
                drd.Close();
            }

            return (lEConsultaLogin);
        }
    }
}