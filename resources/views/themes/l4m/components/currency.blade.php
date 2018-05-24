@if(\Session::get('currency')->code == 'RSD')
    {{ number_format($price / \Session::get('currency')->exchange_rate, 2, ',', '.') }} {{ \Session::get('currency')->symbol }}
@else
    {{ number_format($price / \Session::get('currency')->exchange_rate, 0, ',', '.') }} {{ \Session::get('currency')->symbol }}
@endif