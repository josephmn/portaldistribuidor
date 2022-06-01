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
    public class CConsultaTipoArchivo
    {
        public List<EConsultaTipoArchivo> ConsultaTipoArchivo(SqlConnection con, String modulo, String mime, String type)
        {
            List<EConsultaTipoArchivo> lEConsultaTipoArchivo = null;
            SqlCommand cmd = new SqlCommand("ASP_CONSULTAR_TIPO_ARCHIVO", con);
            cmd.CommandType = CommandType.StoredProcedure;

            cmd.Parameters.AddWithValue("@modulo", SqlDbType.VarChar).Value = modulo;
            cmd.Parameters.AddWithValue("@mime", SqlDbType.VarChar).Value = mime;
            cmd.Parameters.AddWithValue("@type", SqlDbType.VarChar).Value = type;

            SqlDataReader drd = cmd.ExecuteReader(CommandBehavior.SingleResult);

            if (drd != null)
            {
                lEConsultaTipoArchivo = new List<EConsultaTipoArchivo>();

                EConsultaTipoArchivo obEConsultaTipoArchivo = null;
                while (drd.Read())
                {
                    obEConsultaTipoArchivo = new EConsultaTipoArchivo();
                    obEConsultaTipoArchivo.v_archivo = drd["v_archivo"].ToString();
                    obEConsultaTipoArchivo.v_mime = drd["v_mime"].ToString();
                    obEConsultaTipoArchivo.v_type = drd["v_type"].ToString();
                    obEConsultaTipoArchivo.v_size = drd["v_size"].ToString();
                    lEConsultaTipoArchivo.Add(obEConsultaTipoArchivo);
                }
                drd.Close();
            }

            return (lEConsultaTipoArchivo);
        }
    }
}