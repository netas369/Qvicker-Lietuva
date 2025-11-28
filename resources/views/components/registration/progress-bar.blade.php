@props(['currentStep', 'totalSteps'])

<div class="flex justify-between mb-8 relative">
    <!-- Progress Line -->
    <div class="absolute left-0 right-0 top-1/2 transform -translate-y-1/2 h-1 bg-gray-200">
        <div class="h-1 bg-primary-light transition-all duration-300"
             style="width: {{ ($currentStep - 0.65) / ($totalSteps - 1) * 100 }}%"></div>
    </div>

    @php
        $steps = [
            1 => 'Asmeninė info',
            2 => 'Įgūdžiai',
            3 => 'Verifikacija'
        ];
    @endphp

    @for($step = 1; $step <= $totalSteps; $step++)
        <div class="w-1/3 relative z-10">
            <!-- Step Bubble -->
            <div class="relative mb-2">
                <div class="w-10 h-10 mx-auto rounded-full text-lg flex items-center justify-center
                    {{ $currentStep >= $step ? 'bg-primary text-white' : 'bg-gray-200' }}">
                    {{ $step }}
                </div>
            </div>
            <!-- Step Label -->
            <div class="text-xs text-center {{ $currentStep >= $step ? 'text-primary font-bold' : 'text-gray-400' }}">
                {{ $steps[$step] }}
            </div>
        </div>
    @endfor
</div>
