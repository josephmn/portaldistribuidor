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
    public class CConsultarDepartamentoReporte
    {
        public List<EConsultarDepartamentoReporte> ConsultarDepartamentoReporte(SqlConnection con, String fechainicio, String fechafin)
        {
            List<EConsultarDepartamentoReporte> lEConsultarDepartamentoReporte = null;
            SqlCommand cmd = new SqlCommand("ASP_REPORTE_VENTAS_DEPARTAMENTO", con);
            cmd.CommandType = CommandType.StoredProcedure;

            cmd.Parameters.AddWithValue("@fechainicio", SqlDbType.VarChar).Value = fechainicio;
            cmd.Parameters.AddWithValue("@fechafin", SqlDbType.VarChar).Value = fechafin;

            SqlDataReader drd = cmd.ExecuteReader(CommandBehavior.SingleResult);

            if (drd != null)
            {
                lEConsultarDepartamentoReporte = new List<EConsultarDepartamentoReporte>();

                EConsultarDepartamentoReporte obEConsultarDepartamentoReporte = null;
                while (drd.Read())
                {
                    obEConsultarDepartamentoReporte = new EConsultarDepartamentoReporte();
                    obEConsultarDepartamentoReporte.v_departamento = drd["v_departamento"].ToString();
                    lEConsultarDepartamentoReporte.Add(obEConsultarDepartamentoReporte);
                }
                drd.Close();
            }

            return (lEConsultarDepartamentoReporte);
        }
    }
}