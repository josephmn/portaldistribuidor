<?php

class reportebiController extends Controller
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
					'plugins/vendors/css/extensions/sweetalert2.min',
					'dist/css/bootstrap',
					'dist/css/bootstrap-extended',
					'dist/css/colors',
					'dist/css/components',
					'dist/css/core/menu/menu-types/vertical-menu',
					'dist/css/plugins/forms/form-validation',
					'dist/css/custom',
					'dist/css/style',
				)
			);

			$this->_view->setJs_Specific(
				array(
					'plugins/vendors/js/vendors.min',
					'plugins/vendors/js/forms/validation/jquery.validate.min',
					'dist/js/core/app-menu',
					'dist/js/core/app',
					'plugins/vendors/js/extensions/sweetalert2.all.min',
				)
			);

			// $wsdl = 'http://localhost:81/VDWEB/WSDistribuidor.asmx?WSDL';

			// $options = array(
			// 	"uri" => $wsdl,
			// 	"style" => SOAP_RPC,
			// 	"use" => SOAP_ENCODED,
			// 	"soap_version" => SOAP_1_1,
			// 	"connection_timeout" => 60,
			// 	"trace" => false,
			// 	"encoding" => "UTF-8",
			// 	"exceptions" => false,
			// );
			// $soap = new SoapClient($wsdl, $options);

			// $param1 = array(
			// 	"post" => 3, //lista todos los distribuidores
			// );

			// $result2 = $soap->ConsultarDistribuidores($param1);
			// $combodistribuidor = json_decode($result2->ConsultarDistribuidoresResult, true);

			// $filas="";
			// foreach($combodistribuidor as $dv){
			// 	$filas.="<option value=".$dv['v_ruc'].">".$dv['v_razon']."</option>";
			// };

			// $this->_view->filas = $filas;

			$this->_view->setJs(array('index'));
			$this->_view->renderizar('index');
		} else {
			$this->redireccionar('index/logout');
		}
	}
	
}
?>