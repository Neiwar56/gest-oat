@props([
    'backUrl' => null,
    'backText' => 'Retour',
    'actions' => []
])

<div class="flex items-center justify-between mb-6">
    {{-- Bouton retour --}}
    <div class="flex items-center">
        @if($backUrl)
            <a href="{{ $backUrl }}" 
               class="inline-flex items-center px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                <i data-feather="arrow-left" class="w-4 h-4 mr-2"></i>
                {{ $backText }}
            </a>
        @endif
    </div>

    {{-- Actions --}}
    @if(count($actions) > 0)
        <div class="flex items-center space-x-3">
            @foreach($actions as $action)
                @if(isset($action['url']) && isset($action['text']))
                    <a href="{{ $action['url'] }}" 
                       class="inline-flex items-center px-4 py-2 {{ $action['class'] ?? 'bg-blue-600 text-white hover:bg-blue-700' }} rounded-lg transition-colors">
                        @if(isset($action['icon']))
                            <i data-feather="{{ $action['icon'] }}" class="w-4 h-4 mr-2"></i>
                        @endif
                        {{ $action['text'] }}
                    </a>
                @endif
            @endforeach
        </div>
    @endif
</div>


