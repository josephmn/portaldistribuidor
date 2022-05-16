<?php

class conperfilesController extends Controller
{

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		if (isset($_SESSION['usuario'])) {

			$this->_view->setCss_Specific(
				array(
					'dist/css/fontawesome/css/all',
					'dist/css/vendors.min',
					// 'dist/css/extensions/toastr.min',
					// 'dist/css/forms/bs-stepper.min',
					'plugins/vendors/css/extensions/sweetalert2.min',
					'dist/css/bootstrap',
					'dist/css/bootstrap-extended',
					'dist/css/colors',
					'dist/css/components',
					'dist/css/core/menu/menu-types/vertical-menu',
					'dist/css/plugins/forms/form-validation',
					// 'dist/css/plugins/extensions/ext-component-toastr',
					'dist/css/custom',
					'dist/css/style',
					'plugins/vendors/css/extensions/ext-component-sweet-alerts',
					// 'plugins/vendors/css/pickers/flatpickr/flatpickr.min',
					//data tables
					'plugins/datatables-net/css/jquery.dataTables.min',
					//'plugins/datatables-net/css/searchPanes.dataTables.min',
					//'plugins/datatables-net/select.dataTables.min',
					'plugins/datatables-net/css/buttons.dataTables.min',
					'plugins/datatables-net/css/responsive.dataTables.min',
				)
			);

			$this->_view->setJs_Specific(
				array(
					'plugins/vendors/js/vendors.min',
					'plugins/vendors/js/extensions/toastr.min',
					'plugins/vendors/js/forms/select/select2.full.min',
					'plugins/vendors/js/forms/validation/jquery.validate.min',
					'dist/js/core/app-menu',
					'dist/js/core/app',
					'dist/js/scripts/forms/form-wizard',
					//data tables
					'plugins/datatables-net/js/jquery.dataTables.min',
					'plugins/datatables-net/js/dataTables.select.min',
					'plugins/datatables-net/js/dataTables.buttons.min',
					'plugins/datatables-net/js/buttons.flash.min',
					'plugins/datatables-net/js/jszip.min',
					'plugins/datatables-net/js/vfs_fonts',
					'plugins/datatables-net/js/buttons.html5.min',
					'plugins/datatables-net/js/buttons.print.min',
					'plugins/datatables-net/js/dataTables.responsive.min',
					'plugins/vendors/js/extensions/sweetalert2.all.min',

					'plugins/vendors/js/pickers/flatpickr/flatpickr.min',
					// 'dist/js/scripts/pages/app-calendar-events',
					// 'dist/js/scripts/pages/app-calendar',
				)
			);

			$wsdl = 'http://localhost:81/VDWEB/WSDistribuidor.asmx?WSDL';

			$options = array(
				"uri" => $wsdl,
				"style" => SOAP_RPC,
				"use" => SOAP_ENCODED,
				"soap_version" => SOAP_1_1,
				"connection_timeout" => 60,
				"trace" => false,
				"encoding" => "UTF-8",
				"exceptions" => false,
			);
			$soap = new SoapClient($wsdl, $options);

			$param = array(
				"post" => 1, //lista los perfiles
				"perfil" => 0, //no se usa
			);

			$result = $soap->ConPerfiles($param);
			$perfiles = json_decode($result->ConPerfilesResult, true);

			$this->_view->perfiles = $perfiles;

			$this->_view->setJs(array('index'));
			$this->_view->renderizar('index');
		} else {
			$this->redireccionar('index/logout');
		}
	}

	public function configuracionperfil()
	{
		if (isset($_SESSION['usuario'])) {

			$this->_view->setCss_Specific(
				array(
					'dist/css/fontawesome/css/all',
					'dist/css/vendors.min',
					//
					'plugins/vendors/css/pickers/pickadate/pickadate',
					// 'plugins/vendors/css/pickers/flatpickr/flatpickr.min',
					'plugins/vendors/css/pickers/flatpickr/material_green',

					'dist/css/calendars/main',
					'dist/css/calendars/theme-chooser',
					'dist/css/pages/app-calendar',
					// 'dist/css/extensions/toastr.min',
					// 'dist/css/forms/bs-stepper.min',
					'plugins/vendors/css/extensions/sweetalert2.min',
					'dist/css/forms/select/select2.min',
					'dist/css/bootstrap',
					'dist/css/bootstrap-extended',
					'dist/css/colors',
					'dist/css/components',
					'dist/css/core/menu/menu-types/vertical-menu',
					'dist/css/plugins/forms/form-validation',
					'dist/css/plugins/forms/form-wizard',
					// 'dist/css/plugins/extensions/ext-component-toastr',
					'dist/css/custom',
					'dist/css/style',
					'plugins/vendors/css/extensions/ext-component-sweet-alerts',
					//data tables
					'plugins/datatables-net/css/jquery.dataTables.min',
					//'plugins/datatables-net/css/searchPanes.dataTables.min',
					//'plugins/datatables-net/select.dataTables.min',
					'plugins/datatables-net/css/buttons.dataTables.min',
					'plugins/datatables-net/css/responsive.dataTables.min',
					'plugins/datatables-net/css/dataTables.checkboxes',
					//
					'plugins/vendors/css/pickers/form-flat-pickr',
					'plugins/vendors/css/pickers/form-pickadate',
				)
			);

			$this->_view->setJs_Specific(
				array(
					'plugins/vendors/js/vendors.min',
					'plugins/vendors/js/calendar/main',
					'plugins/vendors/js/calendar/locales-all',
					'plugins/vendors/js/extensions/toastr.min',
					// 'plugins/vendors/js/forms/wizard/bs-stepper.min',
					'plugins/vendors/js/forms/select/select2.full.min',
					'plugins/vendors/js/forms/validation/jquery.validate.min',
					'dist/js/core/app-menu',
					'dist/js/core/app',
					'dist/js/scripts/forms/form-wizard',
					//data tables
					'plugins/datatables-net/js/jquery.dataTables.min',
					'plugins/datatables-net/js/dataTables.select.min',
					'plugins/datatables-net/js/dataTables.buttons.min',
					'plugins/datatables-net/js/buttons.flash.min',
					'plugins/datatables-net/js/jszip.min',
					'plugins/datatables-net/js/vfs_fonts',
					'plugins/datatables-net/js/buttons.html5.min',
					'plugins/datatables-net/js/buttons.print.min',
					'plugins/datatables-net/js/dataTables.responsive.min',
					'plugins/vendors/js/extensions/sweetalert2.all.min',
					//
					'plugins/vendors/js/pickers/pickadate/picker',
					'plugins/vendors/js/pickers/pickadate/picker.date',
					'plugins/vendors/js/pickers/pickadate/picker.time',
					'plugins/vendors/js/pickers/pickadate/legacy',
					'plugins/vendors/js/pickers/flatpickr/flatpickr.min',
					// 'plugins/vendors/js/pickers/flatpickr/main',
					'dist/js/scripts/forms/pickers/form-pickers',
					
					// imput mask
					'dist/js/scripts/forms/form-input-mask',
					'plugins/vendors/js/forms/cleave/cleave.min',
					// 'dist/js/scripts/pages/app-calendar-events',
					// 'dist/js/scripts/pages/app-calendar',
					// 'dist/js/scripts/components/components-popovers',
				)
			);

			$perfil = $_GET["perfil"];
			$nombreperfil = $_GET["nombreperfil"];

			$wsdl = 'http://localhost:81/VDWEB/WSDistribuidor.asmx?WSDL';

			$options = array(
				"uri" => $wsdl,
				"style" => SOAP_RPC,
				"use" => SOAP_ENCODED,
				"soap_version" => SOAP_1_1,
				"connection_timeout" => 60,
				"trace" => false,
				"encoding" => "UTF-8",
				"exceptions" => false,
			);
			$soap = new SoapClient($wsdl, $options);

			$param1 = array(
				"post" => 0,
				"perfil" => $perfil,
				"menu" => 0, //no se usa para este caso
			);

			$result = $soap->ConPerfilesAccesos($param1);
			$menu = json_decode($result->ConPerfilesAccesosResult, true);

			$param2 = array(
				"post" => 1,
				"perfil" => $perfil,
				"menu" => 0, //no se usa para este caso
			);

			$result = $soap->ConPerfilesAccesos($param2);
			$submenu = json_decode($result->ConPerfilesAccesosResult, true);

			$this->_view->perfil = $perfil;
			$this->_view->nombreperfil = $nombreperfil;
			$this->_view->menu = $menu;
			$this->_view->submenu = $submenu;

			$this->_view->setJs(array('configuracionperfil'));
			$this->_view->renderizar('configuracionperfil');
		} else {
			$this->redireccionar('index/logout');
		}
	}

	public function combomenu()
	{
		if (isset($_SESSION['usuario'])) {

			putenv("NLS_LANG=SPANISH_SPAIN.AL32UTF8");
			putenv("NLS_CHARACTERSET=AL32UTF8");
			$this->getLibrary('json_php/JSON');
			$json = new Services_JSON();

			$perfil = $_POST["perfil"];

			$wsdl = 'http://localhost:81/VDWEB/WSDistribuidor.asmx?WSDL';

			$options = array(
				"uri" => $wsdl,
				"style" => SOAP_RPC,
				"use" => SOAP_ENCODED,
				"soap_version" => SOAP_1_1,
				"connection_timeout" => 60,
				"trace" => false,
				"encoding" => "UTF-8",
				"exceptions" => false,
			);
			$soap = new SoapClient($wsdl, $options);

			$param = array(
				"post" => 2,
				"perfil" => $perfil,
				"menu" => 0, //no se usa para este caso
			);

			$result = $soap->ConPerfilesAccesos($param);
			$combomenu = json_decode($result->ConPerfilesAccesosResult, true);

			$filas="";
			foreach($combomenu as $dv){
				$filas.="<option ".$dv['v_default']." value=".$dv['i_submenu'].">".$dv['v_menu']."</option>";
			};
			
			header('Content-type: application/json; charset=utf-8');
			echo $json->encode(
				array(
					"data" => $filas,
				)
			);

		} else {
			$this->redireccionar('index/logout');
		}
	}

	public function combosubmenu()
	{
		if (isset($_SESSION['usuario'])) {

			putenv("NLS_LANG=SPANISH_SPAIN.AL32UTF8");
			putenv("NLS_CHARACTERSET=AL32UTF8");
			$this->getLibrary('json_php/JSON');
			$json = new Services_JSON();

			$perfil = $_POST["codperfil"];
			$menu = $_POST["menu"];

			$wsdl = 'http://localhost:81/VDWEB/WSDistribuidor.asmx?WSDL';

			$options = array(
				"uri" => $wsdl,
				"style" => SOAP_RPC,
				"use" => SOAP_ENCODED,
				"soap_version" => SOAP_1_1,
				"connection_timeout" => 60,
				"trace" => false,
				"encoding" => "UTF-8",
				"exceptions" => false,
			);
			$soap = new SoapClient($wsdl, $options);

			$param = array(
				"post" => 3,
				"perfil" => $perfil,
				"menu" => $menu, //se trae el id del menu para cargar los submenu asociados
			);

			$result = $soap->ConPerfilesAccesos($param);
			$combomenu = json_decode($result->ConPerfilesAccesosResult, true);

			$filas="";
			foreach($combomenu as $dv){
				$filas.="<option ".$dv['v_default']." value=".$dv['i_submenu'].">".$dv['v_submenu']."</option>";
			};
			
			header('Content-type: application/json; charset=utf-8');
			echo $json->encode(
				array(
					"data" => $filas,
				)
			);

		} else {
			$this->redireccionar('index/logout');
		}
	}

	public function mantenimiento_accesos()
	{
		if (isset($_SESSION['usuario'])) {

			putenv("NLS_LANG=SPANISH_SPAIN.AL32UTF8");
			putenv("NLS_CHARACTERSET=AL32UTF8");
			$this->getLibrary('json_php/JSON');
			$json = new Services_JSON();

			$post = $_POST["post"];
			$menu = $_POST["menu"];
			$submenu = $_POST["submenu"];
			$perfil = $_POST["perfil"];
			$tipo = $_POST["tipo"];

			$wsdl = 'http://localhost:81/VDWEB/WSDistribuidor.asmx?WSDL';

			$options = array(
				"uri" => $wsdl,
				"style" => SOAP_RPC,
				"use" => SOAP_ENCODED,
				"soap_version" => SOAP_1_1,
				"connection_timeout" => 60,
				"trace" => false,
				"encoding" => "UTF-8",
				"exceptions" => false,
			);
			$soap = new SoapClient($wsdl, $options);

			$param = array(
				"post" => $post,
				"menu" => $menu,
				"submenu" => $submenu,
				"perfil" => $perfil,
				"tipo" => $tipo,
				"user" => $_SESSION['id'],
			);

			$result = $soap->MantPerfilesAccesos($param);
			$mantperfiles = json_decode($result->MantPerfilesAccesosResult, true);

			header('Content-type: application/json; charset=utf-8');
			echo $json->encode(
				array(
					"vicon" 		=> $mantperfiles[0]['v_icon'],
					"vtitle" 		=> $mantperfiles[0]['v_title'],
					"vtext" 		=> $mantperfiles[0]['v_text'],
					"itimer" 		=> intval($mantperfiles[0]['i_timer']),
					"icase" 		=> intval($mantperfiles[0]['i_case']),
					"vprogressbar" 	=> $mantperfiles[0]['v_progressbar'],
				)
			);

		} else {
			$this->redireccionar('index/logout');
		}
	}

	public function mantenimiento_perfil()
	{
		if (isset($_SESSION['usuario'])) {

			putenv("NLS_LANG=SPANISH_SPAIN.AL32UTF8");
			putenv("NLS_CHARACTERSET=AL32UTF8");
			$this->getLibrary('json_php/JSON');
			$json = new Services_JSON();

			$post = $_POST["post"];
			$nombre = $_POST["nombre"];
			$estado = $_POST["estado"];
			$perfil = $_POST["perfil"];

			$wsdl = 'http://localhost:81/VDWEB/WSDistribuidor.asmx?WSDL';

			$options = array(
				"uri" => $wsdl,
				"style" => SOAP_RPC,
				"use" => SOAP_ENCODED,
				"soap_version" => SOAP_1_1,
				"connection_timeout" => 60,
				"trace" => false,
				"encoding" => "UTF-8",
				"exceptions" => false,
			);
			$soap = new SoapClient($wsdl, $options);

			$param = array(
				"post" => $post,
				"nombre" => $nombre,
				"estado" => $estado,
				"perfil" => $perfil,
				"user" => intval($_SESSION['id']),
			);

			$result = $soap->MantPerfiles($param);
			$mantperfiles = json_decode($result->MantPerfilesResult, true);

			header('Content-type: application/json; charset=utf-8');
			echo $json->encode(
				array(
					"vicon" 		=> $mantperfiles[0]['v_icon'],
					"vtitle" 		=> $mantperfiles[0]['v_title'],
					"vtext" 		=> $mantperfiles[0]['v_text'],
					"itimer" 		=> intval($mantperfiles[0]['i_timer']),
					"icase" 		=> intval($mantperfiles[0]['i_case']),
					"vprogressbar" 	=> $mantperfiles[0]['v_progressbar'],
				)
			);

		} else {
			$this->redireccionar('index/logout');
		}
	}

}
?>