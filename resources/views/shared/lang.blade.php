@php $locale = session('locale'); @endphp

<div class="nav-item d-none d-md-flex">
    <a href="{{ route('lang', 'en') }}" class="btn btn-sm {{ $locale == 'en' ? 'btn-primary': 'btn-outline-primary' }}">EN</a>
</div>

<div class="nav-item d-none d-md-flex">
    <a href="{{ route('lang', 'id') }}" class="btn btn-sm {{ $locale == 'id' ? 'btn-primary': 'btn-outline-primary' }}">ID</a>
</div>
