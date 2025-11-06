@props(['icon', 'label', 'route'])

@php
  $active = request()->routeIs($route . '*');
@endphp

<a href="{{ route($route) }}"
   class="flex items-center gap-3 px-3 py-2 rounded-md text-sm font-medium transition
   {{ $active ? 'bg-emerald-700 text-white' : 'text-gray-300 hover:bg-[#254437] hover:text-white' }}">
   <i class="{{ $icon }} w-5 text-center"></i>
   {{ $label }}
</a>
