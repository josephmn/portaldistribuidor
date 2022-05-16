<?php

class reportestockController extends Controller
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

			$result2 = $soap->ConsultarDistribuidores($param1);
			$combodistribuidor = json_decode($result2->ConsultarDistribuidoresResult, true);

			$filas="";
			foreach($combodistribuidor as $dv){
				$filas.="<option value=".$dv['v_ruc'].">".$dv['v_razon']."</option>";
			};

			$this->_view->filas = $filas;

			$this->_view->setJs(array('index'));
			$this->_view->renderizar('index');
		} else {
			$this->redireccionar('index/logout');
		}
	}

	public function filtro()
	{
		if (isset($_SESSION['usuario'])) {

			putenv("NLS_LANG=SPANISH_SPAIN.AL32UTF8");
			putenv("NLS_CHARACTERSET=AL32UTF8");

			$this->getLibrary('json_php/JSON');
			$json = new Services_JSON();

			$post = $_POST['post'];
			$finicio = $_POST['finicio'];
			$ffin = $_POST['ffin'];
			$ardistribuidor = $_POST['distribuidor'];

			// distribuidores
			$distribuidor = "";
			foreach ($ardistribuidor as $ds) {

				if ($distribuidor==""){
					$distribuidor = $ds;
				} else {
					$distribuidor = $distribuidor."/".$ds;
				}
			}

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
				"post"			=> $post,
				"fechainicio" 	=> $finicio,
				"fechafin" 		=> $ffin,
				"distribuidor" 	=> $distribuidor,
			);

			$result = $soap->ViewReporteStock($param1);
			$datatablestock = json_decode($result->ViewReporteStockResult, true);

			// obtenemos los datos y armamos la tabla para mostrarlo
			$tabla="";
			foreach($datatablestock as $dat){
				$tabla .= "<tr>
							<td class='text-center'>".$dat['i_id']."</td>
							<td class='text-center'>".$dat['v_ruc']."</td>
							<td class='text-left'>".$dat['v_razon']."</td>
							<td class='text-center'>".$dat['d_fecha']."</td>
							<td class='text-left'>".$dat['i_producto']."</td>
							<td class='text-left'>".$dat['v_producto']."</td>
							<td class='text-left'>".$dat['f_kilos']."</td>
							<td class='text-left'>".$dat['f_cantidad']."</td>
						</tr>"; 
			}

			header('Content-type: application/json; charset=utf-8');
			echo $json->encode(
				array(
					"datatable"	=> $tabla,
				)
			);

		} else {
			$this->redireccionar('index/logout');
		}
	}
	
}
?>