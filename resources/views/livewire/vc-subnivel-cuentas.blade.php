<tbody>
    @foreach($children as $detalle)
    <tr wire:key="tr-{{ $detalle['codigo'] }}-nivel-{{ $nivel }}-padre-{{ $parentCode }}" class="{{ $detalle['auxiliar'] == 0 ? 'fw-semibold' : '' }}">
        <td style="text-indent: {{ $nivel * 20 }}px;">
            @if($detalle['auxiliar'] == 0)
                @if(in_array($detalle['codigo'], $expanded))
                    <a href="javascript:void(0)" wire:click.prevent="toggleChildren('{{ $detalle['codigo'] }}')" class="me-2">
                        <i class="ri-indeterminate-circle-fill fs-16 text-warning"></i>
                    </a>
                @else
                    <a href="javascript:void(0)" wire:click.prevent="toggleChildren('{{ $detalle['codigo'] }}')" class="me-2">
                        <i class="ri-add-circle-fill fs-16 text-primary"></i>
                    </a>
                @endif
            @endif

            {{ $detalle['codigo'] }} {{ $detalle['nombre'] }}
        </td>
        <td class="text-end">{{ number_format($detalle['saldo'] ?? 0, 2) }}</td>
    </tr>

    {{-- Recursión: si está expandido, renderizamos otro subnivel (hijo del hijo) --}}
    @if($detalle['auxiliar'] == 0 && in_array($detalle['codigo'], $expanded))
        <livewire:vc-subnivel-cuentas
            :parentCode="$detalle['codigo']"
            :nivel="$nivel + 1"
            :allAccounts="$allAccounts"
            wire:key="subnivel-{{ $detalle['codigo'] }}-nivel-{{ $nivel }}-padre-{{ $parentCode }}" />
    @endif
@endforeach
</tbody>