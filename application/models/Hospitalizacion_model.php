<?php
defined('BASEPATH') OR exit('No acceso al codigo');

class Hospitalizacion_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function obtener_paciente()
    {
        $query = $this->db->get('paciente');
        return $query->result();
    }

    public function get_by_id($id){
        $query = $this->db
                      ->where('id', $id)
                      ->get('paciente');
        return $query->row_array();
    }

    public function crear($data){
        $query = $this->db->insert( 'paciente', $data );
        return $query;
    }

    public function actualizar ($id, $data){
        $this->db->where('id',$id);
        return $this->db->update('paciente',$data);
    }

    public function eliminar($id){
        $this->db->where('id',$id);
        return $this->db->delete('paciente');
    }

    //HOSPITALIZACIONES 
     public function obtener_hospitalizaciones()
    {
        // JOIN para mostrar nombre del paciente y sala en vez de solo IDs
        $this->db->select('h.id, h.paciente_id, h.sala_id, h.fecha_ingreso, h.fecha_alta,
                           p.nombre, p.apellido,
                           s.nombre AS sala');
        $this->db->from('hospitalizacion h');
        $this->db->join('paciente p', 'h.paciente_id = p.id');
        $this->db->join('sala s',    'h.sala_id = s.id');
        return $this->db->get()->result();
    }
 
    public function get_hospitalizacion_by_id($id)
    {
        $this->db->where('h.id', $id);
        $this->db->select('h.*, p.nombre, p.apellido, s.nombre AS nombre_sala');
        $this->db->from('hospitalizacion h');
        $this->db->join('paciente p', 'h.paciente_id = p.id');
        $this->db->join('sala s',    'h.sala_id = s.id');
        return $this->db->get()->row_array();
    }
 
    public function crear_hospitalizacion($data)
    {
        return $this->db->insert('hospitalizacion', $data);
    }
 
    public function actualizar_hospitalizacion($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('hospitalizacion', $data);
    }
 
    public function eliminar_hospitalizacion($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('hospitalizacion');
    }
 
    //  PARAMETRICAS (para los <select>)
    //  SALAS (paramétrica)
 
    public function obtener_salas()
    {
        return $this->db->get('sala')->result();
    }
 
    public function get_sala_by_id($id)
    {
        return $this->db->where('id', $id)->get('sala')->row_array();
    }
 
    public function crear_sala($data)
    {
        return $this->db->insert('sala', $data);
    }
 
    public function actualizar_sala($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('sala', $data);
    }
 
    public function eliminar_sala($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('sala');
    }
 
    //  TIPOS DIAGNÓSTICO (paramétrica)
 
    public function obtener_tipos_diagnostico()
    {
        return $this->db->get('tipo_diagnostico')->result();
    }
 
    public function get_tipo_diagnostico_by_id($id)
    {
        return $this->db->where('id', $id)->get('tipo_diagnostico')->row_array();
    }
 
    public function crear_tipo_diagnostico($data)
    {
        return $this->db->insert('tipo_diagnostico', $data);
    }
 
    public function actualizar_tipo_diagnostico($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('tipo_diagnostico', $data);
    }
 
    public function eliminar_tipo_diagnostico($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('tipo_diagnostico');
    }

    // CONSULTAS
    // ver los pacientes que esten en una sala X
    public function pacientes_por_sala()
    {
        $this->db->select('s.nombre AS sala, COUNT(h.id) AS total');
        $this->db->from('hospitalizacion h');
        $this->db->join('sala s', 'h.sala_id = s.id');
        $this->db->where('h.fecha_alta', NULL);
        $this->db->group_by('s.id');
        return $this->db->get()->result();
    }

    //mostrar a los pacientes que aun estan hospitalizados
    public function pacientes_hospitalizados()
    {
        $this->db->select('p.nombre, p.apellido, p.diagnostico, h.fecha_ingreso, s.nombre AS sala');
        $this->db->from('hospitalizacion h');
        $this->db->join('paciente p', 'h.paciente_id = p.id');
        $this->db->join('sala s', 'h.sala_id = s.id');
        $this->db->where('h.fecha_alta', NULL);
        return $this->db->get()->result();
    }
}
?>