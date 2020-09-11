<?php
$content = str_replace('{name}', $name, $content);
?>
@component('mail::message')
{!! $content !!}
@endcomponent
