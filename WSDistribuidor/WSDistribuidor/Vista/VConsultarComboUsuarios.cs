using System;
using System.Collections.Generic;
using System.Data.SqlClient;
using System.Linq;
using System.Web;
using WSDistribuidor.Controller;
using WSDistribuidor.Entity;

namespace WSDistribuidor.view
{
    public class VConsultarComboUsuarios : BDconexion
    {
        public List<EConsultarComboUsuarios> ConsultarComboUsuarios()
        {
            List<EConsultarComboUsuarios> lCConsultarComboUsuarios = null;
            using (SqlConnection con = new SqlConnection(conexion))
            {
                try
                {
                    con.Open();
                    CConsultarComboUsuarios oVConsultarComboUsuarios = new CConsultarComboUsuarios();
                    lCConsultarComboUsuarios = oVConsultarComboUsuarios.ConsultarComboUsuarios(con);
                }
                catch (SqlException)
                {
                    
                }
            }
                return (lCConsultarComboUsuarios);
        }
    }
}