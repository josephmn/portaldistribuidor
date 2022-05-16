<?php

class conusuariosController extends Controller
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
				"post" => 1,
				"codigo" => 0, // no se usa al inciar
			);

			$result = $soap->Usuarios($param);
			$usuarios = json_decode($result->UsuariosResult, true);

			$this->_view->usuarios = $usuarios;

			$this->_view->setJs(array('index'));
			$this->_view->renderizar('index');
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

			$post = $_POST["post"];
			$id = $_POST["id"];

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
				"codigo" => $id,
			);

			$result = $soap->Usuarios($param);
			$usuarios = json_decode($result->UsuariosResult, true);

			header('Content-type: application/json; charset=utf-8');
			echo $json->encode(
				array(
					"icodigo" 				=> $usuarios[0]['v_codigo'],
					"vnombre" 				=> $usuarios[0]['v_nombres'],
					"vapellido" 			=> $usuarios[0]['v_apellidos'],
					"vcorreo" 				=> $usuarios[0]['v_correo'],
					"iestado" 				=> $usuarios[0]['i_estado'],
					"iperfil"				=> $usuarios[0]['i_perfil'],
					"iconfirmar"			=> $usuarios[0]['i_confirmar'],
					"iclaveconfirmacion"	=> $usuarios[0]['i_clave_confirmacion'],
					"vfoto"					=> BASE_URL.$usuarios[0]['v_foto'],
				)
			);

		} else {
			$this->redireccionar('index/logout');
		}
	}

	public function comboperfil()
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
				"post" => 2, //lista los perfiles para combo
				"perfil" => $perfil, //para seleccionar por default el perfil actual
			);

			$result = $soap->ConPerfiles($param);
			$comboperfil = json_decode($result->ConPerfilesResult, true);

			$filas="";
			foreach($comboperfil as $dv){
				$filas.="<option ".$dv['v_selected']." value=".$dv['i_id'].">".$dv['v_nombre']."</option>";
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

	public function combocorreos()
	{
		if (isset($_SESSION['usuario'])) {

			putenv("NLS_LANG=SPANISH_SPAIN.AL32UTF8");
			putenv("NLS_CHARACTERSET=AL32UTF8");
			$this->getLibrary('json_php/JSON');
			$json = new Services_JSON();

			$post = $_POST["post"];
			$id = $_POST["id"];

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
				"codigo" => $id,
			);

			$result = $soap->Usuarios($param);
			$combousuarios = json_decode($result->UsuariosResult, true);

			$filas="";
			foreach($combousuarios as $dv){
				$filas.="<option value=".$dv['v_codigo']." idcorreo=".$dv['v_correo'].">".$dv['v_nombres']."</option>";
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

	public function mantenimiento_usuarios()
	{
		if (isset($_SESSION['usuario'])) {

			putenv("NLS_LANG=SPANISH_SPAIN.AL32UTF8");
			putenv("NLS_CHARACTERSET=AL32UTF8");
			$this->getLibrary('json_php/JSON');
			$json = new Services_JSON();

			$post = $_POST["post"];
			$codigo = $_POST["codigo"];
			$nombres = $_POST["nombres"];
			$apellidos = $_POST["apellidos"];
			$correo = $_POST["correo"];
			$password = $_POST["password"];
			$estado = $_POST["estado"];
			$perfil = $_POST["perfil"];
			$confirmar = $_POST["confirmar"];

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
				"codigo" => $codigo,
				"nombres" => $nombres,
				"apellidos" => $apellidos,
				"correo" => $correo,
				"password" => $password,
				"estado" => $estado,
				"perfil" => $perfil,
				"confirmar" => $confirmar,
				"user" => $_SESSION['id'],
			);

			$result = $soap->MantUsuarios($param);
			$mantperfiles = json_decode($result->MantUsuariosResult, true);

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

	public function enviarcorreo()
	{

		putenv("NLS_LANG=SPANISH_SPAIN.AL32UTF8");
		putenv("NLS_CHARACTERSET=AL32UTF8");

		$this->getLibrary('json_php/JSON');
		$json = new Services_JSON();

		$cnombre = $_POST['cnombre'];
		$cpara = $_POST['cpara'];
		$ccopia = $_POST['ccopia'];
		$casunto = $_POST['casunto'];
		$cmensaje = $_POST['cmensaje'];

		// $cnombre = "JOSEPH MAGALLANES";
		// $cpara = "programador.app02@verdum.com";
		// $ccopia = ["3","4","5"];
		// $casunto = "PRUEBA";
		// $cmensaje = "CORREO DE PRUEBA";

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

		$result2 = $soap->ConfiguracionCorreo();
		$conficorreo = json_decode($result2->ConfiguracionCorreoResult, true);

		$output = 0;
		// envio de correo
		$this->getLibrary('phpmailer/PHPMailer');
		$this->getLibrary('phpmailer/SMTP');

		$mail = new PHPMailer;

		$mail->isSMTP();
		$mail->SMTPDebug = false;
		$mail->SMTPAuth = true; //Habilita uso de usuario y contraseña
		//$mail->SMTPSecure = 'tls'; //tls o ssl, configuracion de correo personalizado Ejem: gmail (ssl)
		$mail->Mailer = 'smtp';
		$mail->Host = $conficorreo[0]['v_servidor_entrante']; //mail.cafealtomayo.com.pe
		$mail->Username = $conficorreo[0]['v_correo_salida']; //reportes@cafealtomayo.com.pe
		$mail->Password = $conficorreo[0]['v_password']; //rpt4m2020
		$mail->Port = $conficorreo[0]['i_puerto']; //25

		// $mail->From = ('reportes@cafealtomayo.com.pe');
		$mail->From = ($conficorreo[0]['v_correo_salida']); //reportes@cafealtomayo.com.pe
		$mail->FromName = $conficorreo[0]['v_nombre_salida']; // VERDUM PERÚ SAC
		$mail->addAddress($cpara, $cnombre);
		// $mail->addReplyTo('reportes@cafealtomayo.com.pe', 'noreplay verdum');

		// concatenar los correos en copia
		$i = 0;
		$cccorreos = "";
		foreach ($ccopia as $di) {
			$params[$i] = array(
				"post" => 2,
				"codigo" => $di,
			);
			$result = $soap->Usuarios($params[$i]);
			$usuario = json_decode($result->UsuariosResult, true);
			$cccorreos = $usuario[0]['v_correo'];
			$mail->addCC($cccorreos);
			$i++;
		}
		// $mail->addBCC('bcc@example.com');

		$mail->isHTML(true);
		$mail->CharSet = "utf-8";
		$mail->Subject = $casunto;
		$mail->Body = "
		Hola <b>" . $cnombre . ",</b>
		<br>
		". $cmensaje ."
		<br>
		Saludo,<br>
		Verdum Perú S.A.C.";

		$output = 0;

		if (!$mail->send()) {
			$output = 0; //	ERROR AL ENVIAR CORREO
		} else {
			$output = 1; // SE ENVIO CORRECTAMENTE
		}

		header('Content-type: application/json; charset=utf-8');

		echo $json->encode(
			array(
				"correo" => $output,
			)
		);
	}

}
?>