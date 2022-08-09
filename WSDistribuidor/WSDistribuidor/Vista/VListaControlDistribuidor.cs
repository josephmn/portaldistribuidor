using System;
using System.Collections.Generic;
using System.Data.SqlClient;
using System.Linq;
using System.Web;
using WSDistribuidor.Controller;
using WSDistribuidor.Entity;

namespace WSDistribuidor.view
{
    public class VListaControlDistribuidor : BDconexion
    {
        public List<EListaControlDistribuidor> ListaControlDistribuidor()
        {
            List<EListaControlDistribuidor> lCListaControlDistribuidor = null;
            using (SqlConnection con = new SqlConnection(conexion))
            {
                try
                {
                    con.Open();
                    CListaControlDistribuidor oVListaControlDistribuidor = new CListaControlDistribuidor();
                    lCListaControlDistribuidor = oVListaControlDistribuidor.ListaControlDistribuidor(con);
                }
                catch (SqlException)
                {
                    
                }
            }
                return (lCListaControlDistribuidor);
        }
    }
}