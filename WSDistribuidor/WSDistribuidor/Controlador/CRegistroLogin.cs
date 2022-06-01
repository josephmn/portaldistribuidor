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
    public class CRegistroLogin
    {
        public List<ERegistroLogin> RegistroLogin(SqlConnection con, String nombres, String apellidos, String correo, String clave, String perfil)
        {
            List<ERegistroLogin> lERegistroLogin = null;
            SqlCommand cmd = new SqlCommand("ASP_REGISTRO_LOGIN", con);
            cmd.CommandType = CommandType.StoredProcedure;

            SqlParameter par1 = cmd.Parameters.Add("@nombres", SqlDbType.VarChar);
            par1.Direction = ParameterDirection.Input;
            par1.Value = nombres;
            SqlParameter par2 = cmd.Parameters.Add("@apellidos", SqlDbType.VarChar);
            par2.Direction = ParameterDirection.Input;
            par2.Value = apellidos;
            SqlParameter par3 = cmd.Parameters.Add("@correo", SqlDbType.VarChar);
            par3.Direction = ParameterDirection.Input;
            par3.Value = correo;
            SqlParameter par4 = cmd.Parameters.Add("@clave", SqlDbType.VarChar);
            par4.Direction = ParameterDirection.Input;
            par4.Value = clave;
            SqlParameter par5 = cmd.Parameters.Add("@perfil", SqlDbType.Int);
            par5.Direction = ParameterDirection.Input;
            par5.Value = perfil;

            SqlDataReader drd = cmd.ExecuteReader(CommandBehavior.SingleResult);

            if (drd != null)
            {
                lERegistroLogin = new List<ERegistroLogin>();

                ERegistroLogin obERegistroLogin = null;
                while (drd.Read())
                {
                    obERegistroLogin = new ERegistroLogin();
                    obERegistroLogin.v_respuesta = drd["v_respuesta"].ToString();
                    lERegistroLogin.Add(obERegistroLogin);
                }
                drd.Close();
            }

            return (lERegistroLogin);
        }
    }
}