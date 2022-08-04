<x-forms::field-wrapper :id="$getId()" :label="$getLabel()" :label-sr-only="$isLabelHidden()" :helper-text="$getHelperText()" :hint="$getHint()" :hint-icon="$getHintIcon()" :required="$isRequired()" :state-path="$getStatePath()">
    <div x-data="{ state: $wire.entangle('{{ $getStatePath() }}') }">
        @if(!empty($getOptions()) && count($getOptions()) > 0)
        <div class="relative">
            @foreach($getOptions() as $group)
                <div x-data="{
                    show_services : false
                }">
                    <div 
                    @click="show_services = !show_services"
                    class="sticky flex cursor-pointer justify-between top-0 border-t border-b border-gray-200 bg-gray-50 dark:bg-gray-800 dark:text-gray-200 dark:border-gray-600 px-6 py-1 text-sm font-medium text-gray-500">
                        <h3>
                            {{ $group['name'] }}
                        </h3>
                        <div>
                            <div x-show="!show_services">
                                @svg('heroicon-o-chevron-down', 'w-5 h-5')
                            </div>
                            <div x-show="show_services" x-cloak>
                                @svg('heroicon-o-chevron-up', 'w-5 h-5')
                            </div>
                        </div>
                    </div>
                    <ul role="list" x-cloak x-show="show_services" class="relative z-0 divide-y divide-gray-200 dark:divide-gray-600">
                        @if(isset($group['items']) && count($group['items']) > 0)
                            @foreach($group['items'] as $item)
                                <button type="button" class="bg-white dark:bg-gray-700 text-left w-full block"
                                wire:loading.attr="disabled"
                                @click="state = '{{ $item['value'] }}'">
                                    <div 
                                    :class="(state != '{{ $item['value'] }}') ? 
                                    'relative px-6 py-5 flex items-center space-x-3 hover:bg-gray-100 dark:hover:bg-gray-800'
                                    :'relative px-6 py-5 flex items-center space-x-3 bg-gray-100 dark:bg-gray-800'">
                                        <div class="flex-shrink-0">
                                            @if(!isset($item['image_url']) && empty($item['image_url']))
                                                <div class="flex justify-center items-center p-1 rounded-full bg-white">
                                                    @if(!isset($item['icon']) && empty($item['icon']))
                                                        @svg('heroicon-o-hashtag', ' h-10 w-10')
                                                    @else
                                                        @svg($item['icon'], ' h-10 w-10')
                                                    @endif
                                                </div>
                                            @else
                                                <img class="h-10 w-10 rounded-full object-cover" src="{{ $item['image_url'] }}" alt="">
                                            @endif
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <!-- Extend touch target to entire panel -->
                                            <span class="absolute inset-0" aria-hidden="true"></span>
                                            <p class="text-sm font-medium text-gray-900 dark:text-gray-300">
                                                {{ $item['name'] }}
                                            </p>
                                            
                                            <p class="text-xs text-gray-400 font-semibold truncate">
                                                {!! $item['description'] ?? "" !!}
                                            </p>
                                        </div>
                                    </div>
                                </button>
                            @endforeach
                        @else
                            <h1 class="text-xs">
                                There is no items in this group.
                            </h1>
                        @endif
                    </ul>
                </div>
            @endforeach
        </div>
        @else
            <h1 class="text-xs">
                Group is not available.
            </h1>
        @endif
    </div>
</x-forms::field-wrapper>