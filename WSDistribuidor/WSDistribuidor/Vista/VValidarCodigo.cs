using System;
using System.Collections.Generic;
using System.Data.SqlClient;
using System.Linq;
using System.Web;
using WSDistribuidor.Controller;
using WSDistribuidor.Entity;

namespace WSDistribuidor.view
{
    public class VValidarCodigo : BDconexion
    {
        public List<EValidarCodigo> ValidarCodigo(Int32 codigo, String correo)
        {
            List<EValidarCodigo> lCValidarCodigo = null;
            using (SqlConnection con = new SqlConnection(conexion))
            {
                try
                {
                    con.Open();
                    CValidarCodigo oVValidarCodigo = new CValidarCodigo();
                    lCValidarCodigo = oVValidarCodigo.ValidarCodigo(con, codigo, correo);
                }
                catch (SqlException)
                {
                    
                }
            }
                return (lCValidarCodigo);
        }
    }
}