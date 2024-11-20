@php
$alerts = [
    'success' => [
        'bg' => 'bg-green-100',
        'border' => 'border-green-400',
        'text' => 'text-green-700',
        'icon' => 'text-green-700 hover:text-green-900',
        'message' => session('success') ?? '',
    ],
    'error' => [
        'bg' => 'bg-red-100',
        'border' => 'border-red-400',
        'text' => 'text-red-700',
        'icon' => 'text-red-700 hover:text-red-900',
        'message' => session('error') ?? '',
    ],
];
@endphp

@foreach ($alerts as $type => $alert)
    @if (!empty($alert['message']))
        <div class="{{ $alert['bg'] }} {{ $alert['border'] }} {{ $alert['text'] }} px-4 py-1 rounded relative my-2 transition duration-200 ease-in-out" role="alert">
            <button type="button" class="absolute top-0 right-0 mr-2 {{ $alert['icon'] }}" aria-label="Close alert" onclick="this.parentElement.style.display='none';">
                <i class="fa fa-times font-extrabold text-xl mx-2"></i>
            </button>
            {{ $alert['message'] }}
        </div>
    @endif
@endforeach
