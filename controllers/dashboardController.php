<?php

class dashboardController extends Controller
{

	public function __construct()
	{
		parent::__construct();
	}

	public function cambiarsession()
	{
		if (isset($_SESSION['usuario'])) {

			$session = $_POST['string'];

			$_SESSION['selsubmenu'] = '';
			$_SESSION['selmenu'] = $session;

			$this->_view->setJs(array('index'));
			$this->_view->renderizar('index');

		} else {
			$this->redireccionar('index/logout');
		}
    }

	public function cambiarsessionsub()
	{
		if (isset($_SESSION['usuario'])) {

			$sessionsub = $_POST['string'];

			$_SESSION['selsubmenu'] = $sessionsub;

			$this->_view->setJs(array('index'));
			$this->_view->renderizar('index');

		} else {
			$this->redireccionar('index/logout');
		}
    }

	public function cambiaropen()
	{
		if (isset($_SESSION['usuario'])) {

			$sessionsub = $_POST['string'];

			$_SESSION['despliegue'] = $sessionsub;

			$this->_view->setJs(array('index'));
			$this->_view->renderizar('index');

		} else {
			$this->redireccionar('index/logout');
		}
    }

	public function index()
	{
		if (isset($_SESSION['usuario'])) {

			$this->_view->setCss_Specific(
				array(
					'dist/css/fontawesome/css/all',
					'dist/css/vendors.min',
					// 'dist/css/extensions/toastr.min',
					// 'dist/css/forms/select/select2.min',
					'plugins/vendors/css/extensions/sweetalert2.min',
					'dist/css/bootstrap',
					'dist/css/bootstrap-extended',
					'dist/css/colors',
					'dist/css/components',
					'dist/css/core/menu/menu-types/vertical-menu',
					'dist/css/plugins/forms/form-validation',
					'dist/css/plugins/extensions/ext-component-toastr',
					'dist/css/custom',
					'dist/css/style',
					//data tables
					'plugins/datatables-net/css/jquery.dataTables.min',
					// 'plugins/datatables-net/css/searchPanes.dataTables.min',
					// 'plugins/datatables-net/select.dataTables.min',
					// 'plugins/datatables-net/css/buttons.dataTables.min',
					'plugins/datatables-net/css/responsive.dataTables.min',
				)
			);
	
			$this->_view->setJs_Specific(
				array(
					'plugins/vendors/js/vendors.min',
					// 'plugins/vendors/js/extensions/toastr.min',
					// 'plugins/vendors/js/forms/select/select2.full.min',
					'plugins/vendors/js/forms/validation/jquery.validate.min',
					'dist/js/core/app-menu',
					'dist/js/core/app',
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
					'plugins/vendors/js/extensions/sweetalert2.all.min',
				)
			);

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

			$param = array(
				"user" => intval($_SESSION['id']),
			);

			$result = $soap->PublicacionCAB($param);
			$publicacioncab = json_decode($result->PublicacionCABResult, true);
			
			$this->_view->publicacioncab = $publicacioncab;

			$this->_view->setJs(array('index'));
			$this->_view->renderizar('index');

		} else {
			$this->redireccionar('index/logout');
		}
    }

	public function publicacion_detalle()
	{
		if (isset($_SESSION['usuario'])) {

			putenv("NLS_LANG=SPANISH_SPAIN.AL32UTF8");
			putenv("NLS_CHARACTERSET=AL32UTF8");
			$this->getLibrary('json_php/JSON');
			$json = new Services_JSON();

			$codigo = $_POST['codigo'];

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
				'codigo' => $codigo,
			);

			$result = $soap->Publicacion($params);
			$publicacion = json_decode($result->PublicacionResult, true);

			$result2 = $soap->PublicacionTarea($params);
			$ptarea = json_decode($result2->PublicacionTareaResult, true);

			$result3 = $soap->PublicacionPerfil($params);
			$pperfil = json_decode($result3->PublicacionPerfilResult, true);

			$arrptare = "";
			foreach($ptarea as $pt){
				$arrptare.='<li>'.$pt['v_tarea'].'</li>';
			}

			$arrpperfil = "";
			foreach($pperfil as $pp){
				$arrpperfil.='<li>'.$pp['v_perfil'].'</li>';
			}

			$div = '';

			$div.='
			<div class="card-header">
				<h4 class="card-title">VERDUM PERÚ S.A.C.</h4>
			</div>
			<div class="card-body">
				<p class="card-text mb-0"><i class="fas fa-clock"></i>&nbsp;&nbsp;'.$publicacion[0]['v_jornada'].'</p>
				<p class="card-text mb-1"><i class="fas fa-map-marker-alt"></i></i>&nbsp;&nbsp;'.$publicacion[0]['v_distrito'].', '.$publicacion[0]['v_provincia'].', '.$publicacion[0]['v_pais'].'</p>
				<div>
					<h4 class="card-title mb-1 text-success">'.$publicacion[0]['v_titulo'].' ('.$publicacion[0]['v_complemento'].')</h4>
				</div>
				<div class="media my-1 py-25">
					<div class="media-body">
						<small class="text font-weight-bolder">Reclutamiento Verdum</small>
						<span class="text ml-50 mr-25">|</span>
						<small class="text font-weight-bolder">'.$publicacion[0]['d_fecha'].'</small>
					</div>
				</div>
				<h4 class="mb-1">Descripcion:</h4>
				<p class="card-text mb-2" style="text-align: justify;">
					'.$publicacion[0]['v_descripcion_puesto'].'
				</p>
				<hr class="my-1" />
				<h4 class="mb-0">Principales tareas:</h4>
				<ul class="p-2 mb-0" style="text-align: justify;">
					'.$arrptare.'
				</ul>
				<hr class="my-1" />
				<h4 class="mb-0">Perfil buscado:</h4>
				<ul class="p-2 mb-0" style="text-align: justify;">
					'.$arrpperfil.'
					<li>Educación mínima: '.$publicacion[0]['v_estudios'].'.</li>
					<li>Nro de vacantes: '.$publicacion[0]['i_vacantes'].'.</li>
					<li>Experiencia mínima: '.$publicacion[0]['i_experiencia'].' año(s) en puestos similares.</li>
					<li>Disponibilidad para viajar: '.$publicacion[0]['v_viaje'].'</li>
					<li>Disponibilidad para cambiar de residencia: '.$publicacion[0]['v_residencia'].'</li>
					<li>Personas con discapacidad: '.$publicacion[0]['v_discapacidad'].'</li>
					<li>Edad: '.$publicacion[0]['v_edad'].'</li>

				</ul>
				<hr class="my-1" />
				<h4 class="mb-1">Qued ofrecemos:</h4>
				<p class="card-text mb-0"><i class="fas fa-chart-line"></i>&nbsp;&nbsp;Línea de carrera.</p>
				<p class="card-text mb-0"><i class="fas fa-money-bill-wave-alt"></i>&nbsp;&nbsp;Salario: '.$publicacion[0]['v_salario'].'</p>
				<hr class="my-1" />
				<div class="d-flex justify-content-end">
					<button onclick="clickpostularme(\''.$publicacion[0]['v_puesto'].'\')" type="button" class="btn btn-success">
						<i class="fas fa-angle-double-right"></i><span>&nbsp;&nbsp;Postularme&nbsp;&nbsp;</span><i class="fas fa-angle-double-left"></i>
					</button>
				</div>
			</div>
			';
			
			// var_dump($div);exit;

			header('Content-type: application/json; charset=utf-8');
			echo $json->encode(
				array(
					"data" => $div,
				)
			);

		} else {
			$this->redireccionar('index/logout');
		}

	}

	public function postulacion()
	{
		if (isset($_SESSION['usuario'])) {

			putenv("NLS_LANG=SPANISH_SPAIN.AL32UTF8");
			putenv("NLS_CHARACTERSET=AL32UTF8");
			$this->getLibrary('json_php/JSON');
			$json = new Services_JSON();

			$puesto = $_POST['puesto'];

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
				"puesto" => $puesto,
				"user" => intval($_SESSION['id']),
			);

			$result = $soap->MantPostulacion($param);
			$postulacion = json_decode($result->MantPostulacionResult, true);

			header('Content-type: application/json; charset=utf-8');

			echo $json->encode(
				array(
					"vicon" 		=> $postulacion[0]['v_icon'],
					"vtitle" 		=> $postulacion[0]['v_title'],
					"vtext" 		=> $postulacion[0]['v_text'],
					"itimer" 		=> intval($postulacion[0]['i_timer']),
					"icase" 		=> intval($postulacion[0]['i_case']),
					"vprogressbar" 	=> $postulacion[0]['v_progressbar'],
				)
			);

		} else {
			$this->redireccionar('index/logout');
		}
	}
}
?>