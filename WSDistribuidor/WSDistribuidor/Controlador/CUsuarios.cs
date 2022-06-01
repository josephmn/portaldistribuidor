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
    public class CUsuarios
    {
        public List<EUsuarios> Usuarios(SqlConnection con, Int32 post, Int32 codigo)
        {
            List<EUsuarios> lEUsuarios = null;
            SqlCommand cmd = new SqlCommand("ASP_CONSULTAR_USUARIOS", con);
            cmd.CommandType = CommandType.StoredProcedure;

            cmd.Parameters.AddWithValue("@post", SqlDbType.Int).Value = post;
            cmd.Parameters.AddWithValue("@codigo", SqlDbType.Int).Value = codigo;

            SqlDataReader drd = cmd.ExecuteReader(CommandBehavior.SingleResult);

            if (drd != null)
            {
                lEUsuarios = new List<EUsuarios>();

                EUsuarios obEUsuarios = null;
                while (drd.Read())
                {
                    obEUsuarios = new EUsuarios();
                    obEUsuarios.v_codigo = Convert.ToInt32(drd["v_codigo"].ToString());
                    obEUsuarios.v_nombres = drd["v_nombres"].ToString();
                    obEUsuarios.v_apellidos = drd["v_apellidos"].ToString();
                    obEUsuarios.v_correo = drd["v_correo"].ToString();
                    obEUsuarios.i_estado = Convert.ToInt32(drd["i_estado"].ToString());
                    obEUsuarios.v_estado = drd["v_estado"].ToString();
                    obEUsuarios.v_color_estado = drd["v_color_estado"].ToString();
                    obEUsuarios.i_perfil = Convert.ToInt32(drd["i_perfil"].ToString());
                    obEUsuarios.v_perfil = drd["v_perfil"].ToString();
                    obEUsuarios.i_confirmar = Convert.ToInt32(drd["i_confirmar"].ToString());
                    obEUsuarios.v_confirmar_estado = drd["v_confirmar_estado"].ToString();
                    obEUsuarios.v_color_confirmar_estado = drd["v_color_confirmar_estado"].ToString();
                    obEUsuarios.i_clave_confirmacion = Convert.ToInt32(drd["i_clave_confirmacion"].ToString());
                    obEUsuarios.v_reset_clave = drd["v_reset_clave"].ToString();
                    obEUsuarios.v_foto = drd["v_foto"].ToString();
                    obEUsuarios.v_selected = drd["v_selected"].ToString();
                    lEUsuarios.Add(obEUsuarios);
                }
                drd.Close();
            }

            return (lEUsuarios);
        }
    }
}