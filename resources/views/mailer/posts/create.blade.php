@component('mail::message')
# Introduction
Post is created...
<h1>{{$post->title}}</h1>
<p>{{$post->content}}</p>

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
