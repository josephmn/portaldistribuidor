<?php

class equivalenciasController extends Controller
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
					'dist/css/forms/select/select2.min',
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
					//sweetalert
					'plugins/vendors/js/extensions/sweetalert2.all.min',
					// 'dist/js/scripts/pages/app-calendar-events',
					// 'dist/js/scripts/pages/app-calendar',
					//picker
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

			$param1 = array(
				"post" => 3, //lista todos los distribuidores
			);

			$result1 = $soap->ConsultarDistribuidores($param1);
			$combodistribuidor = json_decode($result1->ConsultarDistribuidoresResult, true);

			$filasdis="";
			foreach($combodistribuidor as $dv){
				$filasdis.="<option value=".$dv['v_ruc'].">".$dv['v_razon']."</option>";
			};

			$result2 = $soap->ConsultarProductosverdum();
			$comboverdum = json_decode($result2->ConsultarProductosverdumResult, true);

			$filasver="";
			foreach($comboverdum as $cv){
				$filasver.="<option value=".$cv['i_producto'].">(".$cv['i_producto'].") ".$cv['v_producto']."</option>";
			};
			
			$result3 = $soap->ConsultarEquivalencias();
			$tbequivalencias = json_decode($result3->ConsultarEquivalenciasResult, true);

			$filas="";
			foreach($tbequivalencias as $tb){
				$filas.="
				<tr>
					<td class='text-center'>".$tb['i_id']."</td>
					<td class='text-center'>".$tb['v_ruc']."</td>
					<td class='text-center'>".$tb['v_razon']."</td>
					<td class='text-center'>".$tb['v_sku']."</td>
					<td class='text-center'>".$tb['v_equ']."</td>
					<td class='text-left'>".$tb['v_producto']."</td>
					<td class='text-center'>".$tb['f_min']."</td>
					<td class='text-center'>".$tb['f_max']."</td>
					<td class='text-center'>
						<a id='".$tb['i_id']."' class='btn btn-danger btn-sm text-white delete'><i class='fa fa-trash-alt'></i></a>
					</td>
				</tr>
				";
			};
			// <td class='text-center'><span class='badge bg-".$tb['v_color_estado']."'>".$tb['v_estado']."</span></td>

			$this->_view->filasdis = $filasdis;
			$this->_view->filasver = $filasver;
			$this->_view->filas = $filas;

			$this->_view->setJs(array('index'));
			$this->_view->renderizar('index');
		} else {
			$this->redireccionar('index/logout');
		}
	}

	public function combo_productos()
	{
		if (isset($_SESSION['usuario'])) {

			putenv("NLS_LANG=SPANISH_SPAIN.AL32UTF8");
			putenv("NLS_CHARACTERSET=AL32UTF8");

			$this->getLibrary('json_php/JSON');
			$json = new Services_JSON();

			$ruc = $_POST['ruc'];

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
				"ruc"	=> $ruc,
			);

			$result = $soap->ConsultarRucproductos($param1);
			$comboproduct = json_decode($result->ConsultarRucproductosResult, true);

			$cboproduct="<option value='00000' selected disabled>-- SELECCIONE --</option>";
			foreach($comboproduct as $dv){
				$cboproduct.="<option value=".$dv['i_producto'].">(".$dv['i_producto'].") ".$dv['v_producto']."</option>";
			};

			header('Content-type: application/json; charset=utf-8');
			echo $json->encode(
				array(
					"cboproduct"	=> $cboproduct,
				)
			);

		} else {
			$this->redireccionar('index/logout');
		}
	}

	public function mantenimiento_equivalencia()
	{
		if (isset($_SESSION['usuario'])) {

			putenv("NLS_LANG=SPANISH_SPAIN.AL32UTF8");
			putenv("NLS_CHARACTERSET=AL32UTF8");

			$this->getLibrary('json_php/JSON');
			$json = new Services_JSON();

			$post = $_POST['post'];
			$id = $_POST['id'];
			$ruc = $_POST['ruc'];
			$estado = $_POST['estado'];
			$producto = $_POST['producto'];
			$verdum = $_POST['verdum'];
			$min = $_POST['min'];
			$max = $_POST['max'];

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

			$params = array(
				'post' 		=> $post,
				'id' 		=> $id,
				'ruc' 		=> $ruc,
				'sku' 		=> $producto,
				'equ' 		=> $verdum,
				'estado' 	=> $estado,
				'min' 		=> $min,
				'max' 		=> $max,
				'user' 		=> intval($_SESSION['id']),
			);

			$soap = new SoapClient($wsdl, $options);
			$result = $soap->MantEquivalencias($params);
			$equivalencia = json_decode($result->MantEquivalenciasResult, true);

			header('Content-type: application/json; charset=utf-8');

			echo $json->encode(
				array(
					"vicon" 		=> $equivalencia[0]['v_icon'],
					"vtitle" 		=> $equivalencia[0]['v_title'],
					"vtext" 		=> $equivalencia[0]['v_text'],
					"itimer" 		=> $equivalencia[0]['i_timer'],
					"icase" 		=> $equivalencia[0]['i_case'],
					"vprogressbar" 	=> $equivalencia[0]['v_progressbar'],
				)
			);
		} else {
			$this->redireccionar('index/logout');
		}
	}
	
}
?>