@if(!session('user') && !session('admin'))
    @include('components.lead-modal', ['closable' => true])
@endif
</body> 