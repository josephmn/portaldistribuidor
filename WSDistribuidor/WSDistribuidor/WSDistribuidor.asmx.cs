using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.Services;
using Newtonsoft.Json.Serialization;
using Newtonsoft.Json;
using WSDistribuidor.Entity;
using WSDistribuidor.view;

namespace WSDistribuidor
{
    /// <summary>
    /// Descripción breve de WSDistribuidor
    /// </summary>
    [WebService(Namespace = "http://www.mundoaltomayo.com/")]
    [WebServiceBinding(ConformsTo = WsiProfiles.BasicProfile1_1)]
    [System.ComponentModel.ToolboxItem(false)]
    // Para permitir que se llame a este servicio web desde un script, usando ASP.NET AJAX, quite la marca de comentario de la línea siguiente. 
    // [System.Web.Script.Services.ScriptService]
    public class WSDistribuidor : System.Web.Services.WebService
    {

        public VLogin obELogin = new VLogin();
        public VConsultaLogin obEConsultaLogin = new VConsultaLogin();
        public VMantLogin obEMantLogin = new VMantLogin();
        public VMantPassword obEMantPassword = new VMantPassword();

        public VConPerfiles obEConPerfiles = new VConPerfiles();
        public VConPerfilesAccesos obEConPerfilesAccesos = new VConPerfilesAccesos();

        public VMenu obEMenu = new VMenu();
        public VSubMenu obESubMenu = new VSubMenu();

        public VUsuarios obEUsuarios = new VUsuarios();
        public VMantUsuarios obEMantUsuarios = new VMantUsuarios();

        public VMantPerfilesAccesos obEMantPerfilesAccesos = new VMantPerfilesAccesos();
        public VMantPerfiles obEMantPerfiles = new VMantPerfiles();

        public VRecuperarClave obERecuperarClave = new VRecuperarClave();
        public VRegistroConsulta obERegistroConsulta = new VRegistroConsulta();
        public VRegistroLogin obERegistroLogin = new VRegistroLogin();
        public VValidarCodigo obEValidarCodigo = new VValidarCodigo();

        public VConsultaCompania obEConsultaCompania = new VConsultaCompania();
        public VConfiguracionCorreo obEConfiguracionCorreo = new VConfiguracionCorreo();

        public VMantCompania obEMantCompania = new VMantCompania();
        public VMantConfiguracionCorreo obEMantConfiguracionCorreo = new VMantConfiguracionCorreo();

        public VConsultarDistribuidores obEConsultarDistribuidores = new VConsultarDistribuidores();
        public VMantDistribuidores obEMantDistribuidores = new VMantDistribuidores();

        public VConsultarUsuariosDistribuidores obEConsultarUsuariosDistribuidores = new VConsultarUsuariosDistribuidores();
        public VConsultarComboUsuarios obEConsultarComboUsuarios = new VConsultarComboUsuarios();

        public VMantAsignarDistribuidores obEMantAsignarDistribuidores = new VMantAsignarDistribuidores();

        public VConsultaTipoArchivo obEConsultaTipoArchivo = new VConsultaTipoArchivo();
        
        public VMantVentas obEMantVentas = new VMantVentas();
        public VMantVentasDuplicadas obEMantVentasDuplicadas = new VMantVentasDuplicadas();
        public VConsultarVentasRuc obEConsultarVentasRuc = new VConsultarVentasRuc(); //Consulta de ventas_distribuidores_hist, ya que se necesita que el cliente vea lo que cargo
        public VConsultarDuplicidadRuc obEConsultarDuplicidadRuc = new VConsultarDuplicidadRuc();

        public VMantStock obEMantStock = new VMantStock();
        public VConsultarStockRuc obEConsultarStockRuc = new VConsultarStockRuc();

        public VConsultarArchivosVentasRuc obEConsultarArchivosVentasRuc = new VConsultarArchivosVentasRuc();
        public VConsultarArchivosStockRuc obEConsultarArchivosStockRuc = new VConsultarArchivosStockRuc();

        public VConsultarDepartamentoReporte obEConsultarDepartamentoReporte = new VConsultarDepartamentoReporte();
        public VConsultarDistritoReporte obEConsultarDistritoReporte = new VConsultarDistritoReporte();

        public VViewReporteVentas obEViewReporteVentas = new VViewReporteVentas();
        public VViewReporteStock obEViewReporteStock = new VViewReporteStock();

        // equivalencias
        public VConsultarRucproductos obEConsultarRucproductos = new VConsultarRucproductos();
        public VConsultarProductosverdum obEConsultarProductosverdum = new VConsultarProductosverdum();
        public VMantEquivalencias obEMantEquivalencias = new VMantEquivalencias();
        public VConsultarEquivalencias obEConsultarEquivalencias = new VConsultarEquivalencias();
        public VViewReporteEquivalencia obEViewReporteEquivalencia = new VViewReporteEquivalencia();

        [WebMethod]
        public string RegistroLogin(String nombres, String apellidos, String correo, String clave, String perfil)
        {
            List<ERegistroLogin> lista = new List<ERegistroLogin>();
            lista = obERegistroLogin.RegistroLogin(nombres, apellidos, correo, clave, perfil);
            string json = JsonConvert.SerializeObject(lista);
            return json;
        }

        [WebMethod]
        public string RecuperarClave(Int32 post, String correo)
        {
            List<ERecuperarClave> lista = new List<ERecuperarClave>();
            lista = obERecuperarClave.RecuperarClave(post, correo);
            string json = JsonConvert.SerializeObject(lista);
            return json;
        }

        [WebMethod]
        public string RegistroConsulta(Int32 post, String correo)
        {
            List<ERegistroConsulta> lista = new List<ERegistroConsulta>();
            lista = obERegistroConsulta.RegistroConsulta(post, correo);
            string json = JsonConvert.SerializeObject(lista);
            return json;
        }

        [WebMethod]
        public string ValidarCodigo(Int32 codigo, String correo)
        {
            List<EValidarCodigo> lista = new List<EValidarCodigo>();
            lista = obEValidarCodigo.ValidarCodigo(codigo, correo);
            string json = JsonConvert.SerializeObject(lista);
            return json;
        }

        [WebMethod]
        public string ConfiguracionCorreo()
        {
            List<EConfiguracionCorreo> lista = new List<EConfiguracionCorreo>();
            lista = obEConfiguracionCorreo.ConfiguracionCorreo();
            string json = JsonConvert.SerializeObject(lista);
            return json;
        }

        [WebMethod]
        public string MantConfiguracionCorreo(String correosalida, String password, String nombresalida, String servidorentrante, Int32 puerto, Int32 user)
        {
            List<EMantenimiento> lista = new List<EMantenimiento>();
            lista = obEMantConfiguracionCorreo.MantConfiguracionCorreo(correosalida, password, nombresalida, servidorentrante, puerto, user);
            string json = JsonConvert.SerializeObject(lista);
            return json;
        }

        [WebMethod]
        public string ConsultaCompania()
        {
            List<EConsultaCompania> lista = new List<EConsultaCompania>();
            lista = obEConsultaCompania.ConsultaCompania();
            string json = JsonConvert.SerializeObject(lista);
            return json;
        }

        [WebMethod]
        public string MantCompania(String ruc, String razon, String dominio, Int32 user)
        {
            List<EMantenimiento> lista = new List<EMantenimiento>();
            lista = obEMantCompania.MantCompania(ruc, razon, dominio, user);
            string json = JsonConvert.SerializeObject(lista);
            return json;
        }

        [WebMethod]
        public string Menu(Int32 perfil)
        {
            List<EMenu> lista = new List<EMenu>();
            lista = obEMenu.Menu(perfil);
            string json = JsonConvert.SerializeObject(lista);
            return json;
        }

        [WebMethod]
        public string SubMenu(Int32 perfil)
        {
            List<ESubMenu> lista = new List<ESubMenu>();
            lista = obESubMenu.SubMenu(perfil);
            string json = JsonConvert.SerializeObject(lista);
            return json;
        }

        [WebMethod]
        public string Login(String correo, String clave)
        {
            List<ELogin> lista = new List<ELogin>();
            lista = obELogin.Login(correo, clave);
            string json = JsonConvert.SerializeObject(lista);
            return json;
        }

        [WebMethod]
        public string ConsultaLogin(Int32 id)
        {
            List<EConsultaLogin> lista = new List<EConsultaLogin>();
            lista = obEConsultaLogin.ConsultaLogin(id);
            string json = JsonConvert.SerializeObject(lista);
            return json;
        }

        [WebMethod]
        public string MantLogin(Int32 post, Int32 id, String nombres, String apellidos, String foto, Int32 user)
        {
            List<EMantenimiento> lista = new List<EMantenimiento>();
            lista = obEMantLogin.MantLogin(post, id, nombres, apellidos, foto, user);
            string json = JsonConvert.SerializeObject(lista);
            return json;
        }

        [WebMethod]
        public string MantPassword(Int32 id, String clave, Int32 user)
        {
            List<EMantenimiento> lista = new List<EMantenimiento>();
            lista = obEMantPassword.MantPassword(id, clave, user);
            string json = JsonConvert.SerializeObject(lista);
            return json;
        }

        [WebMethod]
        public string ConPerfiles(Int32 post, Int32 perfil)
        {
            List<EConPerfiles> lista = new List<EConPerfiles>();
            lista = obEConPerfiles.ConPerfiles(post, perfil);
            string json = JsonConvert.SerializeObject(lista);
            return json;
        }

        [WebMethod]
        public string ConPerfilesAccesos(Int32 post, Int32 perfil, Int32 menu)
        {
            List<EConPerfilesAccesos> lista = new List<EConPerfilesAccesos>();
            lista = obEConPerfilesAccesos.ConPerfilesAccesos(post, perfil, menu);
            string json = JsonConvert.SerializeObject(lista);
            return json;
        }

        [WebMethod]
        public string Usuarios(Int32 post, Int32 codigo)
        {
            List<EUsuarios> lista = new List<EUsuarios>();
            lista = obEUsuarios.Usuarios(post, codigo);
            string json = JsonConvert.SerializeObject(lista);
            return json;
        }

        [WebMethod]
        public string MantUsuarios(Int32 post, Int32 codigo, String nombres, String apellidos, String correo, String password, Int32 estado, Int32 perfil, Int32 confirmar, Int32 user)
        {
            List<EMantenimiento> lista = new List<EMantenimiento>();
            lista = obEMantUsuarios.MantUsuarios(post, codigo, nombres, apellidos, correo, password, estado, perfil, confirmar, user);
            string json = JsonConvert.SerializeObject(lista);
            return json;
        }

        [WebMethod]
        public string MantPerfilesAccesos(Int32 post, Int32 menu, Int32 submenu, Int32 perfil, Int32 tipo, Int32 user)
        {
            List<EMantenimiento> lista = new List<EMantenimiento>();
            lista = obEMantPerfilesAccesos.MantPerfilesAccesos(post, menu, submenu, perfil, tipo, user);
            string json = JsonConvert.SerializeObject(lista);
            return json;
        }

        [WebMethod]
        public string MantPerfiles(Int32 post, String nombre, Int32 estado, Int32 perfil, Int32 user)
        {
            List<EMantenimiento> lista = new List<EMantenimiento>();
            lista = obEMantPerfiles.MantPerfiles(post, nombre, estado, perfil, user);
            string json = JsonConvert.SerializeObject(lista);
            return json;
        }

        [WebMethod]
        public string ConsultarDistribuidores(Int32 post)
        {
            List<EConsultarDistribuidores> lista = new List<EConsultarDistribuidores>();
            lista = obEConsultarDistribuidores.ConsultarDistribuidores(post);
            string json = JsonConvert.SerializeObject(lista);
            return json;
        }

        [WebMethod]
        public string MantDistribuidores(Int32 post, String ruc, String razon, Int32 estado, Int32 user)
        {
            List<EMantenimiento> lista = new List<EMantenimiento>();
            lista = obEMantDistribuidores.MantDistribuidores(post, ruc, razon, estado, user);
            string json = JsonConvert.SerializeObject(lista);
            return json;
        }

        [WebMethod]
        public string ConsultarUsuariosDistribuidores(String ruc)
        {
            List<EConsultarUsuariosDistribuidores> lista = new List<EConsultarUsuariosDistribuidores>();
            lista = obEConsultarUsuariosDistribuidores.ConsultarUsuariosDistribuidores(ruc);
            string json = JsonConvert.SerializeObject(lista);
            return json;
        }

        [WebMethod]
        public string ConsultarComboUsuarios()
        {
            List<EConsultarComboUsuarios> lista = new List<EConsultarComboUsuarios>();
            lista = obEConsultarComboUsuarios.ConsultarComboUsuarios();
            string json = JsonConvert.SerializeObject(lista);
            return json;
        }

        [WebMethod]
        public string MantAsignarDistribuidores(Int32 post, String ruc, Int32 usuario, Int32 user)
        {
            List<EMantenimiento> lista = new List<EMantenimiento>();
            lista = obEMantAsignarDistribuidores.MantAsignarDistribuidores(post, ruc, usuario, user);
            string json = JsonConvert.SerializeObject(lista);
            return json;
        }

        [WebMethod]
        public string ConsultaTipoArchivo(String modulo, String mime, String type)
        {
            List<EConsultaTipoArchivo> lista = new List<EConsultaTipoArchivo>();
            lista = obEConsultaTipoArchivo.ConsultaTipoArchivo(modulo, mime, type);
            string json = JsonConvert.SerializeObject(lista);
            return json;
        }

        [WebMethod]
        public string MantenimientoVentas(Int32 post, String ruc, String razon, String fecha, String iproducto, String vproducto, String icliente, String vcliente, String tipocliente, 
            String departamento, String provincia, String distrito, String venta, String kilos, String cantidad, String archivo, String registro, String user)
        {
            List<EMantenimiento> lista = new List<EMantenimiento>();
            lista = obEMantVentas.MantVentas(post, ruc, razon, fecha, iproducto, vproducto, icliente, vcliente, tipocliente, departamento, provincia, distrito, venta, kilos, cantidad, archivo, registro, user);
            string json = JsonConvert.SerializeObject(lista);
            return json;
        }

        [WebMethod]
        public string ConsultarVentasRuc(String ruc, Int32 user)
        {
            List<EConsultarVentasRuc> lista = new List<EConsultarVentasRuc>();
            lista = obEConsultarVentasRuc.ConsultarVentasRuc(ruc, user);
            string json = JsonConvert.SerializeObject(lista);
            return json;
        }

        [WebMethod]
        public string ConsultarDuplicidadRuc(String ruc)
        {
            List<EConsultarDuplicidadRuc> lista = new List<EConsultarDuplicidadRuc>();
            lista = obEConsultarDuplicidadRuc.ConsultarDuplicidadRuc(ruc);
            string json = JsonConvert.SerializeObject(lista);
            return json;
        }

        [WebMethod]
        public string MantenimientoVentasDuplicadas(Int32 post, Int32 id, String ruc, String user)
        {
            List<EMantenimiento> lista = new List<EMantenimiento>();
            lista = obEMantVentasDuplicadas.MantVentasDuplicadas(post, id, ruc, user);
            string json = JsonConvert.SerializeObject(lista);
            return json;
        }

        [WebMethod]
        public string MantenimientoStock(Int32 post, String ruc, String razon, String fecha, String iproducto, String vproducto, String kilos, String cantidad, String archivo, String registro, String user)
        {
            List<EMantenimiento> lista = new List<EMantenimiento>();
            lista = obEMantStock.MantStock(post, ruc, razon, fecha, iproducto, vproducto, kilos, cantidad, archivo, registro, user);
            string json = JsonConvert.SerializeObject(lista);
            return json;
        }

        [WebMethod]
        public string ConsultarStockRuc(String ruc, Int32 user)
        {
            List<EConsultarStockRuc> lista = new List<EConsultarStockRuc>();
            lista = obEConsultarStockRuc.ConsultarStockRuc(ruc, user);
            string json = JsonConvert.SerializeObject(lista);
            return json;
        }

        [WebMethod]
        public string ConsultarArchivosVentasRuc(String archivo)
        {
            List<EConsultarArchivosVentasRuc> lista = new List<EConsultarArchivosVentasRuc>();
            lista = obEConsultarArchivosVentasRuc.ConsultarArchivosVentasRuc(archivo);
            string json = JsonConvert.SerializeObject(lista);
            return json;
        }

        [WebMethod]
        public string ConsultarArchivosStockRuc(String archivo)
        {
            List<EConsultarArchivosStockRuc> lista = new List<EConsultarArchivosStockRuc>();
            lista = obEConsultarArchivosStockRuc.ConsultarArchivosStockRuc(archivo);
            string json = JsonConvert.SerializeObject(lista);
            return json;
        }

        [WebMethod]
        public string ConsultarDepartamentoReporte(String fechainicio, String fechafin)
        {
            List<EConsultarDepartamentoReporte> lista = new List<EConsultarDepartamentoReporte>();
            lista = obEConsultarDepartamentoReporte.ConsultarDepartamentoReporte(fechainicio, fechafin);
            string json = JsonConvert.SerializeObject(lista);
            return json;
        }

        [WebMethod]
        public string ConsultarDistritoReporte(String fechainicio, String fechafin)
        {
            List<EConsultarDistritoReporte> lista = new List<EConsultarDistritoReporte>();
            lista = obEConsultarDistritoReporte.ConsultarDistritoReporte(fechainicio, fechafin);
            string json = JsonConvert.SerializeObject(lista);
            return json;
        }

        [WebMethod]
        public string ViewReporteVentas(Int32 post, String fechainicio, String fechafin, String departamento, String distrito, String distribuidor)
        {
            List<EViewReporteVentas> lista = new List<EViewReporteVentas>();
            lista = obEViewReporteVentas.ViewReporteVentas(post, fechainicio, fechafin, departamento, distrito, distribuidor);
            string json = JsonConvert.SerializeObject(lista);
            return json;
        }

        [WebMethod]
        public string ViewReporteStock(Int32 post, String fechainicio, String fechafin, String distribuidor)
        {
            List<EViewReporteStock> lista = new List<EViewReporteStock>();
            lista = obEViewReporteStock.ViewReporteStock(post, fechainicio, fechafin, distribuidor);
            string json = JsonConvert.SerializeObject(lista);
            return json;
        }

        [WebMethod]
        public string ConsultarRucproductos(String ruc)
        {
            List<EConsultarRucproductos> lista = new List<EConsultarRucproductos>();
            lista = obEConsultarRucproductos.ConsultarRucproductos(ruc);
            string json = JsonConvert.SerializeObject(lista);
            return json;
        }

        [WebMethod]
        public string ConsultarProductosverdum()
        {
            List<EConsultarProductosverdum> lista = new List<EConsultarProductosverdum>();
            lista = obEConsultarProductosverdum.ConsultarProductosverdum();
            string json = JsonConvert.SerializeObject(lista);
            return json;
        }

        [WebMethod]
        public string MantEquivalencias(Int32 post, Int32 id, String ruc, String sku, String equ, Int32 estado, String min, String max, String user)
        {
            List<EMantenimiento> lista = new List<EMantenimiento>();
            lista = obEMantEquivalencias.MantEquivalencias(post, id, ruc, sku, equ, estado, min, max, user);
            string json = JsonConvert.SerializeObject(lista);
            return json;
        }

        [WebMethod]
        public string ConsultarEquivalencias()
        {
            List<EConsultarEquivalencias> lista = new List<EConsultarEquivalencias>();
            lista = obEConsultarEquivalencias.ConsultarEquivalencias();
            string json = JsonConvert.SerializeObject(lista);
            return json;
        }

        [WebMethod]
        public string ViewReporteEquivalencia(Int32 post, String ruc)
        {
            List<EViewReporteEquivalencia> lista = new List<EViewReporteEquivalencia>();
            lista = obEViewReporteEquivalencia.ViewReporteEquivalencia(post, ruc);
            string json = JsonConvert.SerializeObject(lista);
            return json;
        }
    }
}
