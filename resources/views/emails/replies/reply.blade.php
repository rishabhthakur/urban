@component('mail::message')

Hi {{ $to }},

{{ $message }}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
