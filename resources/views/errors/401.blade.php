@extends('errors::minimal')

@section('title', __('No autorizado'))
@section('code', '401')
@section('message', __('No tienes los permisos para ver esta pagina, contacta al area de soporte tecnico.'))
