@component('mail::message')
# Introduction

Mensaje de mailing.

{!! $data['content'] !!}

{{-- @component('mail::button', ['url' => ''])
Button Text
@endcomponent --}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
