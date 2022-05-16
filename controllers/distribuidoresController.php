<?php

class distribuidoresController extends Controller
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
					//'plugins/datatables-net/js/dataTables.searchPanes.min',
					'plugins/datatables-net/js/dataTables.select.min',
					'plugins/datatables-net/js/dataTables.buttons.min',
					'plugins/datatables-net/js/buttons.flash.min',
					'plugins/datatables-net/js/jszip.min',
					'plugins/datatables-net/js/pdfmake.min',
					'plugins/datatables-net/js/vfs_fonts',
					'plugins/datatables-net/js/buttons.html5.min',
					'plugins/datatables-net/js/buttons.print.min',
					'plugins/datatables-net/js/dataTables.responsive.min',
					'plugins/datatables-net/js/dataTables.checkboxes.min',
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
				"post" => 1, //lista los distribuidores
			);

			$result = $soap->ConsultarDistribuidores($param);
			$distribuidores = json_decode($result->ConsultarDistribuidoresResult, true);

			$this->_view->distribuidores = $distribuidores;

			$this->_view->setJs(array('index'));
			$this->_view->renderizar('index');
		} else {
			$this->redireccionar('index/logout');
		}
	}

	public function cuentasdistribuidor()
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
					'dist/css/forms/select/select2.min',
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
					//'plugins/datatables-net/js/dataTables.searchPanes.min',
					'plugins/datatables-net/js/dataTables.select.min',
					'plugins/datatables-net/js/dataTables.buttons.min',
					'plugins/datatables-net/js/buttons.flash.min',
					'plugins/datatables-net/js/jszip.min',
					'plugins/datatables-net/js/pdfmake.min',
					'plugins/datatables-net/js/vfs_fonts',
					'plugins/datatables-net/js/buttons.html5.min',
					'plugins/datatables-net/js/buttons.print.min',
					'plugins/datatables-net/js/dataTables.responsive.min',
					'plugins/datatables-net/js/dataTables.checkboxes.min',
					'plugins/vendors/js/extensions/sweetalert2.all.min',
					'plugins/vendors/js/forms/select/select2.full.min',
					'plugins/vendors/js/pickers/flatpickr/flatpickr.min',
					// 'dist/js/scripts/pages/app-calendar-events',
					// 'dist/js/scripts/pages/app-calendar',
				)
			);

			$ruc = $_GET['ruc'];
			$razon = $_GET['razon'];

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
				"ruc" => $ruc, //lista los usuarios asignados
			);

			$result = $soap->ConsultarUsuariosDistribuidores($param);
			$usuariosdis = json_decode($result->ConsultarUsuariosDistribuidoresResult, true);

			$this->_view->ruc = $ruc;
			$this->_view->razon = $razon;
			$this->_view->usuariosdis = $usuariosdis;

			$this->_view->setJs(array('cuentasdistribuidor'));
			$this->_view->renderizar('cuentasdistribuidor');
		} else {
			$this->redireccionar('index/logout');
		}
	}

	public function mantenimiento_distribuidor()
	{
		if (isset($_SESSION['usuario'])) {

			putenv("NLS_LANG=SPANISH_SPAIN.AL32UTF8");
			putenv("NLS_CHARACTERSET=AL32UTF8");
			$this->getLibrary('json_php/JSON');
			$json = new Services_JSON();

			$post = $_POST["post"];
			$ruc = $_POST["ruc"];
			$razon = $_POST["razon"];
			$estado = $_POST["estado"];

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
				"ruc" => $ruc,
				"razon" => $razon,
				"estado" => $estado,
				"user" => intval($_SESSION['id']),
			);

			$result = $soap->MantDistribuidores($param);
			$mantdistribuidor = json_decode($result->MantDistribuidoresResult, true);

			header('Content-type: application/json; charset=utf-8');
			echo $json->encode(
				array(
					"vicon" 		=> $mantdistribuidor[0]['v_icon'],
					"vtitle" 		=> $mantdistribuidor[0]['v_title'],
					"vtext" 		=> $mantdistribuidor[0]['v_text'],
					"itimer" 		=> intval($mantdistribuidor[0]['i_timer']),
					"icase" 		=> intval($mantdistribuidor[0]['i_case']),
					"vprogressbar" 	=> $mantdistribuidor[0]['v_progressbar'],
				)
			);

		} else {
			$this->redireccionar('index/logout');
		}
	}

	public function combousuarios()
	{
		if (isset($_SESSION['usuario'])) {

			putenv("NLS_LANG=SPANISH_SPAIN.AL32UTF8");
			putenv("NLS_CHARACTERSET=AL32UTF8");
			$this->getLibrary('json_php/JSON');
			$json = new Services_JSON();

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

			$result = $soap->ConsultarComboUsuarios();
			$combousuarios = json_decode($result->ConsultarComboUsuariosResult, true);

			$filas="";
			foreach($combousuarios as $dv){
				$filas.="<option value=".$dv['v_codigo'].">".$dv['v_nombres']."</option>";
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

	public function asignar_distribuidor()
	{
		if (isset($_SESSION['usuario'])) {

			putenv("NLS_LANG=SPANISH_SPAIN.AL32UTF8");
			putenv("NLS_CHARACTERSET=AL32UTF8");
			$this->getLibrary('json_php/JSON');
			$json = new Services_JSON();

			$post = $_POST["post"];
			$usuario = $_POST["usuario"];
			$ruc = $_POST["ruc"];

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

			if(is_array($usuario)){
				$i = 0;
				foreach ($usuario as $dp) {
					$params[$i] = array(
						'post'			=> $post,
						'ruc'			=> $ruc,
						'usuario'		=> intval($dp),
						'user' 			=> intval($_SESSION['id']),
					);
					$result = $soap->MantAsignarDistribuidores($params[$i]);
					$userdistribuidor = json_decode($result->MantAsignarDistribuidoresResult, true);
					$i++;
				}
			} else {
				$params = array(
					'post'			=> $post,
					'ruc'			=> $ruc,
					'usuario'		=> $usuario,
					'user' 			=> intval($_SESSION['id']),
				);
				$result = $soap->MantAsignarDistribuidores($params);
				$userdistribuidor = json_decode($result->MantAsignarDistribuidoresResult, true);
			}

			header('Content-type: application/json; charset=utf-8');
			echo $json->encode(
				array(
					"vicon" 		=> $userdistribuidor[0]['v_icon'],
					"vtitle" 		=> $userdistribuidor[0]['v_title'],
					"vtext" 		=> $userdistribuidor[0]['v_text'],
					"itimer" 		=> intval($userdistribuidor[0]['i_timer']),
					"icase" 		=> intval($userdistribuidor[0]['i_case']),
					"vprogressbar" 	=> $userdistribuidor[0]['v_progressbar'],
				)
			);

		} else {
			$this->redireccionar('index/logout');
		}
	}

}
?>