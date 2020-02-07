@component('mail::message')
# Introduction

<h1>{{$post->title}}</h1>

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
