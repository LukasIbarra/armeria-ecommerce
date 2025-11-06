@props(['icon', 'label'])

<div class="flex items-center gap-3 px-3 py-2 rounded-md text-sm text-gray-500 cursor-not-allowed opacity-50">
  <i class="{{ $icon }} w-5 text-center"></i>
  {{ $label }}
</div>
