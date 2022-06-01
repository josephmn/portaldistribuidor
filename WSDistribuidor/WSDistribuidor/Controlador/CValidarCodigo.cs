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
    public class CValidarCodigo
    {
        public List<EValidarCodigo> ValidarCodigo(SqlConnection con, Int32 codigo, String correo)
        {
            List<EValidarCodigo> lEValidarCodigo = null;
            SqlCommand cmd = new SqlCommand("ASP_VALIDAR_CODIGO", con);
            cmd.CommandType = CommandType.StoredProcedure;

            SqlParameter par1 = cmd.Parameters.Add("@codigo", SqlDbType.Int);
            par1.Direction = ParameterDirection.Input;
            par1.Value = codigo;
            SqlParameter par3 = cmd.Parameters.Add("@correo", SqlDbType.VarChar);
            par3.Direction = ParameterDirection.Input;
            par3.Value = correo;

            SqlDataReader drd = cmd.ExecuteReader(CommandBehavior.SingleResult);

            if (drd != null)
            {
                lEValidarCodigo = new List<EValidarCodigo>();

                EValidarCodigo obEValidarCodigo = null;
                while (drd.Read())
                {
                    obEValidarCodigo = new EValidarCodigo();
                    obEValidarCodigo.v_respuesta = drd["v_respuesta"].ToString();
                    lEValidarCodigo.Add(obEValidarCodigo);
                }
                drd.Close();
            }

            return (lEValidarCodigo);
        }
    }
}