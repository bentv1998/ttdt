<div class="row">
    @foreach($fields as $field)
        <?php
        $class = isset($field['class']) ? ($field['class'] == 'title' ? 'font-weight-bolder' : $field['class']) : '';
        ?>
        <div class="col-{{ $field['col'] ?? '12' }} {{ $field['classCover'] ?? '' }}">
            @switch($field['type'])
                @case('title')
                    <h4>{{ $field['title'] ?? '' }}</h4>
                    <p>{{ $field['note'] ?? '' }}</p>
                    @break
                @case('textarea')
                    <div class="{{ $class }} font-weight-bolder">{{ $field['label'] ?? '' }}</div>
                    <div>{{ $field['value'] ?? $model->{$field['name']} ?? '' }}</div>
                    @break
                @case('select')
                    <div class="{{ $class }} font-weight-bolder">{{ $field['label'] ?? '' }}</div>
                    <div>{{ __($field['options'][$model->{$field['name']}]) }}</div>
                    @break
                @default
                    <span class="{{ $field['class'] ?? '' }}">{{ $field['label'] ?? '' }}</span>
                    {{ $field['value'] ?? $model->{$field['name']} ?? '' }}
            @endswitch
        </div>
    @endforeach

    {{ $slot ?? '' }}
</div>
<style>
    #pdf {
        padding-left: 3cm;
        padding-right: 3cm;
        width: 21cm;
        height: 29.7cm;
    }

    h6 {
        font-weight: bold;
    }

    .title h4 {
        text-transform: uppercase;
        margin-bottom: 20px !important;
        margin-top: 20px !important;
        font-weight: bolder;
    }

    .title {
        padding: 0;
        font-weight: bolder;
        display: block;
    }

    .svg-icon svg g [fill] {
        fill: #78bfd2
    }

    .page-break {
        page-break-before: always;
    }
</style>
