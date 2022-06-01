using System;
using System.Collections.Generic;
using System.Data.SqlClient;
using System.Linq;
using System.Web;
using WSDistribuidor.Controller;
using WSDistribuidor.Entity;

namespace WSDistribuidor.view
{
    public class VConsultarProductosverdum : BDconexion
    {
        public List<EConsultarProductosverdum> ConsultarProductosverdum()
        {
            List<EConsultarProductosverdum> lCConsultarProductosverdum = null;
            using (SqlConnection con = new SqlConnection(conexion))
            {
                try
                {
                    con.Open();
                    CConsultarProductosverdum oVConsultarProductosverdum = new CConsultarProductosverdum();
                    lCConsultarProductosverdum = oVConsultarProductosverdum.ConsultarProductosverdum(con);
                }
                catch (SqlException)
                {
                    
                }
            }
                return (lCConsultarProductosverdum);
        }
    }
}