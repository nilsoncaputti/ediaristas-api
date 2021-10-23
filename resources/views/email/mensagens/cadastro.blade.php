@extends('email.layout')

@section('titulo', 'Seja bem vindo(a) ao E-Diaristas')

@section('conteudo')
    <p style="margin: 0 0 16px">
        Olá {{$usuario->nome_completo}}, seja bem vindo(a) ao E-Diaristas
    </p>

    @if($usuario->tipo_usuario == 1)
        <p style="margin: 0 0 16px">
            Seja bem vindo(a) como cliente do E-Diaristas.
        </p>

        <p style="margin: 0 0 16px">
            Aqui você poderá encontrar os melhores e as melhores profissionais do mercado!!!
        </p>
    @else
        <p style="margin: 0 0 16px">
            Fique ligado, assim que tivermos uma diária na sua região te avisaremos!
        </p>

        <p style="margin: 0 0 16px">
            Você poderá escolher e se candidatar a quantas diárias achar necessário.
        </p>
    @endif
@endsection