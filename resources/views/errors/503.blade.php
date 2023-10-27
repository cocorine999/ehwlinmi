@extends('errors::minimal')

@section('title', __('Maintenance en cours'))
@section('code', '503')
@section('message', __($exception->getMessage() ?: 'Tout va bien cher utilsateur. Donnez-nous quelques minutes. Nous effectuons une maintenance.'))
