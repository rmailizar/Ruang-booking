<div>
    @props(['active'])

    @php
        $classes = ($active ?? false)
                    ? 'nav-link active text-primary fw-bold'
                    : 'nav-link';
        $iconClass = $active ? 'menu-icon text-primary' : 'menu-icon';
    @endphp

    <a {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </a>

</div>