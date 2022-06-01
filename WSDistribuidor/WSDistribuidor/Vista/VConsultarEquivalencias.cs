using System;
using System.Collections.Generic;
using System.Data.SqlClient;
using System.Linq;
using System.Web;
using WSDistribuidor.Controller;
using WSDistribuidor.Entity;

namespace WSDistribuidor.view
{
    public class VConsultarEquivalencias : BDconexion
    {
        public List<EConsultarEquivalencias> ConsultarEquivalencias()
        {
            List<EConsultarEquivalencias> lCConsultarEquivalencias = null;
            using (SqlConnection con = new SqlConnection(conexion))
            {
                try
                {
                    con.Open();
                    CConsultarEquivalencias oVConsultarEquivalencias = new CConsultarEquivalencias();
                    lCConsultarEquivalencias = oVConsultarEquivalencias.ConsultarEquivalencias(con);
                }
                catch (SqlException)
                {
                    
                }
            }
                return (lCConsultarEquivalencias);
        }
    }
}