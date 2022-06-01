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
    public class CRecuperarClave
    {
        public List<ERecuperarClave> RecuperarClave(SqlConnection con, Int32 post, String correo)
        {
            List<ERecuperarClave> lERecuperarClave = null;
            SqlCommand cmd = new SqlCommand("ASP_CONSULTA_CORREO", con);
            cmd.CommandType = CommandType.StoredProcedure;

            cmd.Parameters.AddWithValue("@post", SqlDbType.Int).Value = post;
            cmd.Parameters.AddWithValue("@correo", SqlDbType.VarChar).Value = correo;

            SqlDataReader drd = cmd.ExecuteReader(CommandBehavior.SingleResult);

            if (drd != null)
            {
                lERecuperarClave = new List<ERecuperarClave>();

                ERecuperarClave obERecuperarClave = null;
                while (drd.Read())
                {
                    obERecuperarClave = new ERecuperarClave();
                    obERecuperarClave.v_nombres = drd["v_nombres"].ToString();
                    obERecuperarClave.v_correo = drd["v_correo"].ToString();
                    obERecuperarClave.v_reset_clave = drd["v_reset_clave"].ToString();
                    lERecuperarClave.Add(obERecuperarClave);
                }
                drd.Close();
            }

            return (lERecuperarClave);
        }
    }
}