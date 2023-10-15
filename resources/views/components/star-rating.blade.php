@if ($rating)
    @for ($i = 1; $i < 6; $i++)
        {{$i < round($rating) ? '★' : '☆'}}
    @endfor
@else
    No rating yet
@endif