@if (session('error'))
    <div class="alert alert-danger text-center top-alert" role="alert">{{ session('error') }}</div>
@endif

@if (session('success'))
    <div class="alert alert-primary text-center top-alert" role="alert">{{ session('success') }}</div>
@endif
