@component('mail::message')
<h1>Tem uma nova notificação de MCSCR</h1>
{{$msg}}



@component('mail::button',['url'=>'https://cdm.inovatis.co.mz/login'])
    Ver a notificação
@endcomponent
@endcomponent


