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
    public class CLogin
    {
        public List<ELogin> Login(SqlConnection con, String correo, String clave)
        {
            List<ELogin> lELogin = null;
            SqlCommand cmd = new SqlCommand("ASP_LOGIN", con);
            cmd.CommandType = CommandType.StoredProcedure;

            SqlParameter par1 = cmd.Parameters.Add("@correo", SqlDbType.VarChar);
            par1.Direction = ParameterDirection.Input;
            par1.Value = correo;

            SqlParameter par2 = cmd.Parameters.Add("@clave", SqlDbType.VarChar);
            par2.Direction = ParameterDirection.Input;
            par2.Value = clave;

            SqlDataReader drd = cmd.ExecuteReader(CommandBehavior.SingleResult);

            if (drd != null)
            {
                lELogin = new List<ELogin>();

                ELogin obELogin = null;
                while (drd.Read())
                {
                    obELogin = new ELogin();
                    obELogin.i_id = drd["i_id"].ToString();
                    obELogin.v_nombres = drd["v_nombres"].ToString();
                    obELogin.v_apellidos = drd["v_apellidos"].ToString();
                    obELogin.v_correo = drd["v_correo"].ToString();
                    obELogin.v_estado = drd["v_estado"].ToString();
                    obELogin.v_ruc = drd["v_ruc"].ToString();
                    obELogin.i_perfil = drd["i_perfil"].ToString();
                    obELogin.v_perfil = drd["v_perfil"].ToString();
                    obELogin.v_existe = drd["v_existe"].ToString();
                    obELogin.v_foto = drd["v_foto"].ToString();
                    lELogin.Add(obELogin);
                }
                drd.Close();
            }

            return (lELogin);
        }
    }
}