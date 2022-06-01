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
    public class CConsultarDistritoReporte
    {
        public List<EConsultarDistritoReporte> ConsultarDistritoReporte(SqlConnection con, String fechainicio, String fechafin)
        {
            List<EConsultarDistritoReporte> lEConsultarDistritoReporte = null;
            SqlCommand cmd = new SqlCommand("ASP_REPORTE_VENTAS_DISTRITO", con);
            cmd.CommandType = CommandType.StoredProcedure;

            cmd.Parameters.AddWithValue("@fechainicio", SqlDbType.VarChar).Value = fechainicio;
            cmd.Parameters.AddWithValue("@fechafin", SqlDbType.VarChar).Value = fechafin;

            SqlDataReader drd = cmd.ExecuteReader(CommandBehavior.SingleResult);

            if (drd != null)
            {
                lEConsultarDistritoReporte = new List<EConsultarDistritoReporte>();

                EConsultarDistritoReporte obEConsultarDistritoReporte = null;
                while (drd.Read())
                {
                    obEConsultarDistritoReporte = new EConsultarDistritoReporte();
                    obEConsultarDistritoReporte.v_distrito = drd["v_distrito"].ToString();
                    lEConsultarDistritoReporte.Add(obEConsultarDistritoReporte);
                }
                drd.Close();
            }

            return (lEConsultarDistritoReporte);
        }
    }
}