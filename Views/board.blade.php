@extends('master')
@section('content')

<table>
    @for ($fila = 0; $fila < BOARD_SIZE; $fila++)
    <tr>
        @for ($columna = 0; $columna < BOARD_SIZE; $columna++)
            @if ($fila == $fInicUsuario && $columna == $cInicUsuario)
            <td data-x='{{$fila}}' data-y='{{$columna}}' id='{{$fila . $columna}}'>*</td>
            @elseif ($fila == $fInicCPU && $columna == $cInicCPU)
            <td data-x='{{$fila}}' data-y='{{$columna}}' id='{{$fila . $columna}}'>+</td>
            @else
            <td data-x='{{$fila}}' data-y='{{$columna}}' id='{{$fila . $columna}}'></td>
            @endif
        @endfor
    </tr>
    @endfor
</table>

@endsection
