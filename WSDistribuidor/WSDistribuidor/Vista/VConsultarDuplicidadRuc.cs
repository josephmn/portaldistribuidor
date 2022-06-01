using System;
using System.Collections.Generic;
using System.Data.SqlClient;
using System.Linq;
using System.Web;
using WSDistribuidor.Controller;
using WSDistribuidor.Entity;

namespace WSDistribuidor.view
{
    public class VConsultarDuplicidadRuc : BDconexion
    {
        public List<EConsultarDuplicidadRuc> ConsultarDuplicidadRuc(String ruc)
        {
            List<EConsultarDuplicidadRuc> lCConsultarDuplicidadRuc = null;
            using (SqlConnection con = new SqlConnection(conexion))
            {
                try
                {
                    con.Open();
                    CConsultarDuplicidadRuc oVConsultarDuplicidadRuc = new CConsultarDuplicidadRuc();
                    lCConsultarDuplicidadRuc = oVConsultarDuplicidadRuc.ConsultarDuplicidadRuc(con, ruc);
                }
                catch (SqlException)
                {
                    
                }
            }
                return (lCConsultarDuplicidadRuc);
        }
    }
}