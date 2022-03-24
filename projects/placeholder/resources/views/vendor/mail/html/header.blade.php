<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="{{ asset(config('app.logo')) }}" class="logo" alt="{{config('app.site_name')}} Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
