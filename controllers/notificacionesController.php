<?php

class notificacionesController extends Controller
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
					'dist/css/forms/wizard/bs-stepper.min',
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
					'dist/css/plugins/forms/wizard/form-wizard',
					'plugins/vendors/css/extensions/ext-component-sweet-alerts',
					//data tables
					'plugins/datatables-net/css/jquery.dataTables.min',
					// 'plugins/datatables-net/css/searchPanes.dataTables.min',
					// 'plugins/datatables-net/select.dataTables.min',
					// 'plugins/datatables-net/css/buttons.dataTables.min',
					'plugins/datatables-net/css/responsive.dataTables.min',
					//
					'plugins/vendors/css/pickers/pickadate/pickadate',
					'plugins/vendors/css/pickers/flatpickr/flatpickr.min',
					'plugins/vendors/css/pickers/form-flat-pickr',
					'plugins/vendors/css/pickers/form-pickadate',
				)
			);
	
			$this->_view->setJs_Specific(
				array(
					'plugins/vendors/js/vendors.min',
					'plugins/vendors/js/extensions/toastr.min',
					'plugins/vendors/js/forms/wizard/bs-stepper.min',
					'plugins/vendors/js/forms/select/select2.full.min',
					'plugins/vendors/js/forms/validation/jquery.validate.min',
					'dist/js/core/app-menu',
					'dist/js/core/app',
					'dist/js/scripts/forms/form-wizard',
					//data tables
					'plugins/datatables-net/js/jquery.dataTables.min',
					// 'plugins/datatables-net/js/dataTables.searchPanes.min',
					// 'plugins/datatables-net/js/dataTables.select.min',
					// 'plugins/datatables-net/js/dataTables.buttons.min',
					// 'plugins/datatables-net/js/buttons.flash.min',
					// 'plugins/datatables-net/js/jszip.min',
					// 'plugins/datatables-net/js/pdfmake.min',
					// 'plugins/datatables-net/js/vfs_fonts',
					// 'plugins/datatables-net/js/buttons.html5.min',
					// 'plugins/datatables-net/js/buttons.print.min',
					'plugins/datatables-net/js/dataTables.responsive.min',
					//
					'plugins/vendors/js/extensions/sweetalert2.all.min',

					'plugins/vendors/js/pickers/pickadate/picker',
					'plugins/vendors/js/pickers/pickadate/picker.date',
					'plugins/vendors/js/pickers/pickadate/picker.time',
					'plugins/vendors/js/pickers/pickadate/legacy',
					'plugins/vendors/js/pickers/flatpickr/flatpickr.min',
					'dist/js/scripts/forms/pickers/form-pickers',
					// imput mask
					'dist/js/scripts/forms/form-input-mask',
					'plugins/vendors/js/forms/cleave/cleave.min'
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
				"post"      => 5,
				"codigo"    => 1,
			);

			$result = $soap->Usuarios($param);
			$combousuarios = json_decode($result->UsuariosResult, true);

			$combocc="";
			foreach($combousuarios as $dv){
				$combocc.="<option ".$dv['v_selected']." value=".$dv['v_codigo']." idcorreo=".$dv['v_correo'].">".$dv['v_nombres']."</option>";
			};

			$result = $soap->ConsultaCompania();
			$company = json_decode($result->ConsultaCompaniaResult, true);

			$result2 = $soap->ConfiguracionCorreo();
			$conficorreo = json_decode($result2->ConfiguracionCorreoResult, true);

			$this->_view->company = $company;
			$this->_view->combocc = $combocc;
			$this->_view->conficorreo = $conficorreo;

			$this->_view->setJs(array('index'));
			$this->_view->renderizar('index');

		} else {
			$this->redireccionar('index/logout');
		}
    }

    public function mantenimiento_compania() //mantenimiento de configuracion inicial
	{
		if (isset($_SESSION['usuario'])) {
			
			putenv("NLS_LANG=SPANISH_SPAIN.AL32UTF8");
			putenv("NLS_CHARACTERSET=AL32UTF8");
			$this->getLibrary('json_php/JSON');
			$json = new Services_JSON();

			$ruc = $_POST['ruc'];
			$razon = $_POST['razon'];
			$dominio = $_POST['dominio'];

			$wsdl = 'http://localhost:81/VDWEB/WSDistribuidor.asmx?WSDL';

			$options = array(
				'uri' => $wsdl,
				'style' => SOAP_RPC,
				'use' => SOAP_ENCODED,
				'soap_version' => SOAP_1_1,
				'connection_timeout' => 60,
				'trace' => false,
				'encoding' => 'UTF-8',
				'exceptions' => false,
			);

			$soap = new SoapClient($wsdl, $options);

			$params = array(
				'ruc' 		=> $ruc,
				"razon" 	=> $razon,
				"dominio"   => $dominio,
				"user" 		=> $_SESSION['id'],
			);

			$result = $soap->MantCompania($params);
			$compania = json_decode($result->MantCompaniaResult, true);

			header('Content-type: application/json; charset=utf-8');

			echo $json->encode(
				array(
					"vicon" 		=> $compania[0]['v_icon'],
					"vtitle" 		=> $compania[0]['v_title'],
					"vtext" 		=> $compania[0]['v_text'],
					"itimer" 		=> intval($compania[0]['i_timer']),
					"icase" 		=> intval($compania[0]['i_case']),
					"vprogressbar" 	=> $compania[0]['v_progressbar'],
				)
			);
			
		} else {
			$this->redireccionar('index/logout');
		}
	}

    public function mantenimiento_correo() //mantenimiento de envio de correo
	{
		if (isset($_SESSION['usuario'])) {
			
			putenv("NLS_LANG=SPANISH_SPAIN.AL32UTF8");
			putenv("NLS_CHARACTERSET=AL32UTF8");
			$this->getLibrary('json_php/JSON');
			$json = new Services_JSON();

			$correosalida = $_POST['correosalida'];
			$password = $_POST['password'];
			$nombresalida = $_POST['nombresalida'];
			$servidorentrante = $_POST['servidorentrante'];
			$puerto = $_POST['puerto'];

			$wsdl = 'http://localhost:81/VDWEB/WSDistribuidor.asmx?WSDL';

			$options = array(
				'uri' => $wsdl,
				'style' => SOAP_RPC,
				'use' => SOAP_ENCODED,
				'soap_version' => SOAP_1_1,
				'connection_timeout' => 60,
				'trace' => false,
				'encoding' => 'UTF-8',
				'exceptions' => false,
			);

			$soap = new SoapClient($wsdl, $options);

			$params = array(
				'correosalida' 		=> $correosalida,
				"password" 			=> $password,
				"nombresalida" 		=> $nombresalida,
				"servidorentrante"  => $servidorentrante,
				"puerto" 			=> $puerto,
				"user" 				=> $_SESSION['id'],
			);

			$result = $soap->MantConfiguracionCorreo($params);
			$correo = json_decode($result->MantConfiguracionCorreoResult, true);

			header('Content-type: application/json; charset=utf-8');

			echo $json->encode(
				array(
					"vicon" 		=> $correo[0]['v_icon'],
					"vtitle" 		=> $correo[0]['v_title'],
					"vtext" 		=> $correo[0]['v_text'],
					"itimer" 		=> intval($correo[0]['i_timer']),
					"icase" 		=> intval($correo[0]['i_case']),
					"vprogressbar" 	=> $correo[0]['v_progressbar'],
				)
			);
			
		} else {
			$this->redireccionar('index/logout');
		}
	}

	public function consulta_usuario()
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

			// para consultar y traer los cc de correos predeterminados
			$param1 = array(
				"post" 		=> 6, //correos de los selected
				"codigo" 	=> 1,
			);

			$result = $soap->Usuarios($param1);
			$cccorreos = json_decode($result->UsuariosResult, true);

			header('Content-type: application/json; charset=utf-8');
			echo $json->encode(
				array(
					"cccorreo"	=> $cccorreos,
				)
			);

		} else {
			$this->redireccionar('index/logout');
		}
	}
}
?>