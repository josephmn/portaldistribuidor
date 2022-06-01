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
    public class CConsultarArchivosStockRuc
    {
        public List<EConsultarArchivosStockRuc> ConsultarArchivosStockRuc(SqlConnection con, String archivo)
        {
            List<EConsultarArchivosStockRuc> lEConsultarArchivosStockRuc = null;
            SqlCommand cmd = new SqlCommand("ASP_DESCARGAR_ARCHIVO_STOCK_RUC", con);
            cmd.CommandType = CommandType.StoredProcedure;

            cmd.Parameters.AddWithValue("@archivo", SqlDbType.VarChar).Value = archivo;

            SqlDataReader drd = cmd.ExecuteReader(CommandBehavior.SingleResult);

            if (drd != null)
            {
                lEConsultarArchivosStockRuc = new List<EConsultarArchivosStockRuc>();

                EConsultarArchivosStockRuc obEConsultarArchivosStockRuc = null;
                while (drd.Read())
                {
                    obEConsultarArchivosStockRuc = new EConsultarArchivosStockRuc();
                    obEConsultarArchivosStockRuc.d_fecha = drd["d_fecha"].ToString();
                    obEConsultarArchivosStockRuc.v_ruc = drd["v_ruc"].ToString();
                    obEConsultarArchivosStockRuc.v_razon = drd["v_razon"].ToString();
                    obEConsultarArchivosStockRuc.i_producto = drd["i_producto"].ToString();
                    obEConsultarArchivosStockRuc.v_producto = drd["v_producto"].ToString();
                    obEConsultarArchivosStockRuc.f_kilos = drd["f_kilos"].ToString();
                    obEConsultarArchivosStockRuc.f_cantidad = drd["f_cantidad"].ToString();
                    lEConsultarArchivosStockRuc.Add(obEConsultarArchivosStockRuc);
                }
                drd.Close();
            }

            return (lEConsultarArchivosStockRuc);
        }
    }
}