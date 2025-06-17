@if(!session('user'))
    @include('components.lead-modal', ['closable' => true])
@endif
</body> 