@isset($buttons)
    @foreach($buttons as $btn)
        <a href="{{ url($btn['action']) }}" class="btn btn-sm btn-icon btn-primary btn-round waves-effect waves-classic" data-toggle="tooltip" data-original-title="{{ $btn['title'] }}">
            <i class="{{ $btn['icon'] }}" aria-hidden="true"></i>
        </a>
    @endforeach
@endisset