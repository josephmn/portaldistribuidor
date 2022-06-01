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
    public class CRegistroConsulta
    {
        public List<ERegistroConsulta> RegistroConsulta(SqlConnection con, Int32 post, String correo)
        {
            List<ERegistroConsulta> lERegistroConsulta = null;
            SqlCommand cmd = new SqlCommand("ASP_CONSULTAR_REGISTRO", con);
            cmd.CommandType = CommandType.StoredProcedure;

            SqlParameter par1 = cmd.Parameters.Add("@post", SqlDbType.Int);
            par1.Direction = ParameterDirection.Input;
            par1.Value = post;

            SqlParameter par2 = cmd.Parameters.Add("@correo", SqlDbType.VarChar);
            par2.Direction = ParameterDirection.Input;
            par2.Value = correo;

            SqlDataReader drd = cmd.ExecuteReader(CommandBehavior.SingleResult);

            if (drd != null)
            {
                lERegistroConsulta = new List<ERegistroConsulta>();

                ERegistroConsulta obERegistroConsulta = null;
                while (drd.Read())
                {
                    obERegistroConsulta = new ERegistroConsulta();
                    obERegistroConsulta.v_nombres = drd["v_nombres"].ToString();
                    obERegistroConsulta.v_apellidos = drd["v_apellidos"].ToString();
                    obERegistroConsulta.v_correo = drd["v_correo"].ToString();
                    obERegistroConsulta.i_clave_confirmacion = drd["i_clave_confirmacion"].ToString();
                    lERegistroConsulta.Add(obERegistroConsulta);
                }
                drd.Close();
            }

            return (lERegistroConsulta);
        }
    }
}