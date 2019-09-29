<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

function obtener_botones($id,$formulario)
{
    $ci = & get_instance();

    $html = '<div class="btn-group">';
    $html .= '<a href="'.base_url().$formulario.'/detalles/'.$id.'" class="btn btn-primary">Ver Detalles</a>';
    $html .= '<button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown">';
    $html .= '<span class="caret"></span>';
    $html .= '</button>';
    $html .= '<ul class="dropdown-menu" role="menu">';
    $html .= '<li><a href="'.base_url().$formulario.'/exportar/'.$id.'"><span class="fa fa-print"></span> Exportar</a></li>';
    $html .= '<li><a href="'.base_url().$formulario.'/editar/'.$id.'"><span class="fa fa-edit"></span> Editar</a></li>';
    $html .= '<li><a href="'.base_url().$formulario.'/eliminar_persona/'.$id.'" id_registro='.$id.' class="accion_eliminar"><span class="fa fa-trash-o"></span> Eliminar</a></li>';
    $html .= '</ul>';
    $html .= '</div>';

    return $html;
}


function obtener_botones_nom($id,$nomenclador)
{
    $ci = & get_instance();

    $html = '<div class="btn-group">';
    $html .= '<a href="'.base_url().$nomenclador.'/editar/'.$id.'" class="btn btn-primary">Editar</a>';
    $html .= '<button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown">';
    $html .= '<span class="caret"></span>';
    $html .= '</button>';
    $html .= '<ul class="dropdown-menu" role="menu">';
    $html .= '<li><a href="'.base_url().$nomenclador.'/eliminar/'.$id.'" id_registro='.$id.' class="accion_eliminar"><span class="fa fa-trash-o"></span> Eliminar</a></li>';
    $html .= '</ul>';
    $html .= '</div>';

    return $html;
}


function obtener_radio($id)
{
    $html = '<input type="radio" class="radio_tupla" name="radio" id="'. $id.'">';
    return $html;
}