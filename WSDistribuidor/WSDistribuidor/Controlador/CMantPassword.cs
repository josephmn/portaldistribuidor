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
    public class CMantPassword
    {
        public List<EMantenimiento> MantPassword(SqlConnection con, Int32 id, String clave, Int32 user)
        {
            List<EMantenimiento> lEMantenimiento = null;
            SqlCommand cmd = new SqlCommand("ASP_MANT_PASSWORD", con);
            cmd.CommandType = CommandType.StoredProcedure;

            SqlParameter par1 = cmd.Parameters.Add("@id", SqlDbType.Int);
            par1.Direction = ParameterDirection.Input;
            par1.Value = id;
            SqlParameter par2 = cmd.Parameters.Add("@clave", SqlDbType.VarChar);
            par2.Direction = ParameterDirection.Input;
            par2.Value = clave;
            SqlParameter par3 = cmd.Parameters.Add("@user", SqlDbType.Int);
            par3.Direction = ParameterDirection.Input;
            par3.Value = user;

            SqlDataReader drd = cmd.ExecuteReader(CommandBehavior.SingleResult);

            if (drd != null)
            {
                lEMantenimiento = new List<EMantenimiento>();

                EMantenimiento obEMantenimiento = null;
                while (drd.Read())
                {
                    obEMantenimiento = new EMantenimiento();
                    obEMantenimiento.v_icon = drd["v_icon"].ToString();
                    obEMantenimiento.v_title = drd["v_title"].ToString();
                    obEMantenimiento.v_text = drd["v_text"].ToString();
                    obEMantenimiento.i_timer = Convert.ToInt32(drd["i_timer"].ToString());
                    obEMantenimiento.i_case = Convert.ToInt32(drd["i_case"].ToString());
                    obEMantenimiento.v_progressbar = Convert.ToBoolean(drd["v_progressbar"].ToString());
                    lEMantenimiento.Add(obEMantenimiento);
                }
                drd.Close();
            }

            return (lEMantenimiento);
        }
    }
}