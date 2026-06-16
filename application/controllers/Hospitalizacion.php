<?php
defined('BASEPATH') OR exit('No acceso al codigo');

class Hospitalizacion extends CI_Controller
{
    /** @var Hospitalizacion_model */
    public $Hospitalizacion_model;

    public function __construct()
    {
        parent::__construct();

        $this->load->helper(array('url','form'));        
        $this->load->model('Hospitalizacion_model');
        $this->load->library('form_validation');
    }

    public function dashboard()
    {
        $this->load->view('hospitalizacion/dashboard');
    }

    //read
    public function index()
    {
        $data['paciente'] = $this->Hospitalizacion_model->obtener_paciente();
        $data['tipos']    = $this->Hospitalizacion_model->obtener_tipos_diagnostico();
        $this->load->view('hospitalizacion/index', $data);
    }

    //CREATE - despliege de formulario
    public function crear (){
        //solo me permite ver la pagina de crear
        $this->load->view('hospitalizacion/form');
    }

    //CREATE - Guardar en bd
    public function guardar(){
        //validacion 
        // para numeros con decimales - required|numeric
        // para numeros sin decimales - required|integer
        $this->form_validation->set_rules('nombre','Nombre','required');
        $this->form_validation->set_rules('apellido','Apellido','required'); 
        $this->form_validation->set_rules('tipo_diagnostico_id', 'Tipo de Diagnostico', 'required');

        if($this->form_validation->run() == FALSE){
            $this->load->view('hospitalizacion/form');
        }
        else{
            $data = [
                'nombre' => $this->input->post('nombre'),
                'apellido' => $this->input->post('apellido'),
                'tipo_diagnostico_id' => $this->input->post('tipo_diagnostico_id'),
            ];
            $this->Hospitalizacion_model->crear($data);
            redirect('hospitalizacion');
        }
    }

    //UPDATE - MOSTRAR FORMULARIO
    public function editar($id){
        $data['paciente'] = $this->Hospitalizacion_model->get_by_id($id);
        $this->load->view('hospitalizacion/form', $data);
    }

    //UPDATE CN LA BD
    public function actualizar($id){
        $this->form_validation->set_rules('nombre','Nombre','required');
        $this->form_validation->set_rules('apellido','Apellido','required'); 
        $this->form_validation->set_rules('tipo_diagnostico_id', 'Tipo de Diagnostico', 'required');

        if($this->form_validation->run() == FALSE){
            $data['paciente'] = $this->Hospitalizacion_model->get_by_id($id);
            $this->load->view('hospitalizacion/form', $data);
        }
        else{
            $data = [
                'nombre' => $this->input->post('nombre'),
                'apellido' => $this->input->post('apellido'),
                'tipo_diagnostico_id' => $this->input->post('tipo_diagnostico_id'),
            ];
            $this->Hospitalizacion_model->actualizar($id,$data);
            redirect('hospitalizacion');
        }
    }

    //eliminar
    public function eliminar($id){
        $this->Hospitalizacion_model->eliminar($id);
        redirect('hospitalizacion');
    }

    //HOSPITALIZACIONES 
    
    public function lista_hospitalizaciones()
    {
        $data['hospitalizaciones'] = $this->Hospitalizacion_model->obtener_hospitalizaciones();
        $data['pacientes']         = $this->Hospitalizacion_model->obtener_paciente();
        $data['salas']             = $this->Hospitalizacion_model->obtener_salas();
        $this->load->view('hospitalizacion/lista_hospitalizaciones', $data);
    }
 
    public function guardar_hospitalizacion()
    {
        $this->form_validation->set_rules('paciente_id',   'Paciente',       'required');
        $this->form_validation->set_rules('fecha_ingreso', 'Fecha de ingreso','required');
        $this->form_validation->set_rules('sala_id',       'Sala',           'required');
 
        if ($this->form_validation->run() == FALSE) {
            $this->lista_hospitalizaciones();
        } else {
            $data = [
                'paciente_id'   => $this->input->post('paciente_id'),
                'fecha_ingreso' => $this->input->post('fecha_ingreso'),
                'fecha_alta'    => $this->input->post('fecha_alta') ?: NULL,
                'sala_id'       => $this->input->post('sala_id'),
            ];
            $this->Hospitalizacion_model->crear_hospitalizacion($data);
            redirect('hospitalizacion/lista_hospitalizaciones');
        }
    }
 
    public function actualizar_hospitalizacion($id)
    {
        $this->form_validation->set_rules('paciente_id',   'Paciente',        'required');
        $this->form_validation->set_rules('fecha_ingreso', 'Fecha de ingreso', 'required');
        $this->form_validation->set_rules('sala_id',       'Sala',            'required');
 
        if ($this->form_validation->run() == FALSE) {
            $this->lista_hospitalizaciones();
        } else {
            $data = [
                'paciente_id'   => $this->input->post('paciente_id'),
                'fecha_ingreso' => $this->input->post('fecha_ingreso'),
                'fecha_alta'    => $this->input->post('fecha_alta') ?: NULL,
                'sala_id'       => $this->input->post('sala_id'),
            ];
            $this->Hospitalizacion_model->actualizar_hospitalizacion($id, $data);
            redirect('hospitalizacion/lista_hospitalizaciones');
        }
    }
 
    public function eliminar_hospitalizacion($id)
    {
        $this->Hospitalizacion_model->eliminar_hospitalizacion($id);
        redirect('hospitalizacion/lista_hospitalizaciones');
    }

        // ══════════════════════════════════════════
    //  SALAS (paramétrica)
    // ══════════════════════════════════════════
 
    public function lista_salas()
    {
        $data['salas'] = $this->Hospitalizacion_model->obtener_salas();
        $this->load->view('hospitalizacion/lista_salas', $data);
    }
 
    public function guardar_sala()
    {
        $this->form_validation->set_rules('nombre',    'Nombre',    'required');
        $this->form_validation->set_rules('capacidad', 'Capacidad', 'required|integer');
 
        if ($this->form_validation->run() == FALSE) {
            $this->lista_salas();
        } else {
            $data = [
                'nombre'    => $this->input->post('nombre'),
                'capacidad' => $this->input->post('capacidad'),
            ];
            $this->Hospitalizacion_model->crear_sala($data);
            redirect('hospitalizacion/lista_salas');
        }
    }
 
    public function actualizar_sala($id)
    {
        $this->form_validation->set_rules('nombre',    'Nombre',    'required');
        $this->form_validation->set_rules('capacidad', 'Capacidad', 'required|integer');
 
        if ($this->form_validation->run() == FALSE) {
            $this->lista_salas();
        } else {
            $data = [
                'nombre'    => $this->input->post('nombre'),
                'capacidad' => $this->input->post('capacidad'),
            ];
            $this->Hospitalizacion_model->actualizar_sala($id, $data);
            redirect('hospitalizacion/lista_salas');
        }
    }
 
    public function eliminar_sala($id)
    {
        $this->Hospitalizacion_model->eliminar_sala($id);
        redirect('hospitalizacion/lista_salas');
    }
 
    // ══════════════════════════════════════════
    //  TIPOS DIAGNÓSTICO (paramétrica)
    // ══════════════════════════════════════════
 
    public function lista_tipos_diagnostico()
    {
        $data['tipos'] = $this->Hospitalizacion_model->obtener_tipos_diagnostico();
        $this->load->view('hospitalizacion/lista_tipos_diagnostico', $data);
    }
 
    public function guardar_tipo_diagnostico()
    {
        $this->form_validation->set_rules('nombre', 'Nombre', 'required');
 
        if ($this->form_validation->run() == FALSE) {
            $this->lista_tipos_diagnostico();
        } else {
            $data = ['nombre' => $this->input->post('nombre')];
            $this->Hospitalizacion_model->crear_tipo_diagnostico($data);
            redirect('hospitalizacion/lista_tipos_diagnostico');
        }
    }
 
    public function actualizar_tipo_diagnostico($id)
    {
        $this->form_validation->set_rules('nombre', 'Nombre', 'required');
 
        if ($this->form_validation->run() == FALSE) {
            $this->lista_tipos_diagnostico();
        } else {
            $data = ['nombre' => $this->input->post('nombre')];
            $this->Hospitalizacion_model->actualizar_tipo_diagnostico($id, $data);
            redirect('hospitalizacion/lista_tipos_diagnostico');
        }
    }
 
    public function eliminar_tipo_diagnostico($id)
    {
        $this->Hospitalizacion_model->eliminar_tipo_diagnostico($id);
        redirect('hospitalizacion/lista_tipos_diagnostico');
    }

    //  CONSULTAS
 
    public function consulta_hospitalizados()
    {
        $data['lista'] = $this->Hospitalizacion_model->pacientes_hospitalizados();
        $this->load->view('hospitalizacion/consultaHospitalizados', $data);
    }
 
    public function consulta_por_sala()
    {
        $data['lista'] = $this->Hospitalizacion_model->pacientes_por_sala();
        $this->load->view('hospitalizacion/consultaSala', $data);
    }
}
?>