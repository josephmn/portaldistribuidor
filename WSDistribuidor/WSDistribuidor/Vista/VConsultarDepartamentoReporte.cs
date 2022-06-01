using System;
using System.Collections.Generic;
using System.Data.SqlClient;
using System.Linq;
using System.Web;
using WSDistribuidor.Controller;
using WSDistribuidor.Entity;

namespace WSDistribuidor.view
{
    public class VConsultarDepartamentoReporte : BDconexion
    {
        public List<EConsultarDepartamentoReporte> ConsultarDepartamentoReporte(String fechainicio, String fechafin)
        {
            List<EConsultarDepartamentoReporte> lCConsultarDepartamentoReporte = null;
            using (SqlConnection con = new SqlConnection(conexion))
            {
                try
                {
                    con.Open();
                    CConsultarDepartamentoReporte oVConsultarDepartamentoReporte = new CConsultarDepartamentoReporte();
                    lCConsultarDepartamentoReporte = oVConsultarDepartamentoReporte.ConsultarDepartamentoReporte(con, fechainicio, fechafin);
                }
                catch (SqlException)
                {
                    
                }
            }
                return (lCConsultarDepartamentoReporte);
        }
    }
}