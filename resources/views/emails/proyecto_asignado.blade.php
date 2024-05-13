@component('mail::message')
# Hola {{ $empleado->nombre }},

Has sido asignado a un nuevo proyecto: {{ $proyecto->nombre }}

Gracias,
{{ config('app.name') }}
@endcomponent
