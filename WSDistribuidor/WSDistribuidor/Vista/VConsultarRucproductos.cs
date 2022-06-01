using System;
using System.Collections.Generic;
using System.Data.SqlClient;
using System.Linq;
using System.Web;
using WSDistribuidor.Controller;
using WSDistribuidor.Entity;

namespace WSDistribuidor.view
{
    public class VConsultarRucproductos : BDconexion
    {
        public List<EConsultarRucproductos> ConsultarRucproductos(String ruc)
        {
            List<EConsultarRucproductos> lCConsultarRucproductos = null;
            using (SqlConnection con = new SqlConnection(conexion))
            {
                try
                {
                    con.Open();
                    CConsultarRucproductos oVConsultarRucproductos = new CConsultarRucproductos();
                    lCConsultarRucproductos = oVConsultarRucproductos.ConsultarRucproductos(con, ruc);
                }
                catch (SqlException)
                {
                    
                }
            }
                return (lCConsultarRucproductos);
        }
    }
}