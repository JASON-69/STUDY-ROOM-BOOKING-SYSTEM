@extends('layouts.card')

@section('card-name')
    {{ __('Calendar') }}
@endsection

@section('card-content')
<div class="row">
    <div id="calendar"></div>
</div>
@endsection

@section('scripts')
    <script type="module">
        var $el = $('#calendar');
        $(document).ready(function() {
            $el.zabuto_calendar({
                classname: 'table table-bordered clickable',
            });
        });
        $el.on('zabuto:calendar:day', function(e) {
            var now = new Date();
            if (e.today) {
                $(e.element).css('color', 'blue');
            } else if (e.date.getTime() < now.getTime()) {
                $(e.element).css('color', 'red');
            } else {
                $(e.element).css('color', 'green');
            }
            console.log('zabuto:calendar:day' + ' date=' + e.date.toDateString() + ' value=' + e.value +
                ' today=' + e.today);
            location.href = '/application/' + e.date.toDateString();
        });
    </script>
@endsection