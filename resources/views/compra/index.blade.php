@extends('layouts.app')
@section('title', 'Compras')
@section('content')


<div class="row">
    <div class="col-10">
        <br>
        <h1>Compras</h1>
    </div>

    @if (session('success'))
    @push('scripts')
    <script type="module">
        $(document).ready(function(){
            Swal.fire({
                icon: "success",
                title: "¡Listo!",
                text: "{{ session('success') }}"
            });
        });
    </script>
    @endpush
    @endif

    @push('scripts')
    <script type="module">
        $(document).ready(function(){
            $(".form-delete").submit(function(e){
                e.preventDefault();
                const form = this;
                Swal.fire({
                    title: "¿Estás seguro?",
                    text: "Esta acción no se puede deshacer.",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#6c757d",
                    confirmButtonText: "Sí, eliminar",
                    cancelButtonText: "Cancelar"
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
    @endpush
    <div class="col-2">
        <br><br><a class="btn btn-success" href="{{ route('compras.create') }}">Nueva compra</a>
    </div>
</div>
<div class="row">
    <div class="col">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Cliente</th>
                    <th>Total</th>
                    <th>Estado</th>
                    <th>Método de pago</th>
                    <th>Fecha</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($compras as $compra)
                    <tr>
                        <td>{{ $compra->id }}</td>
                        <td>{{ $compra->cliente->nombre }} {{ $compra->cliente->apellidoP }} {{ $compra->cliente->apellidoM }}</td>
                        <td>${{ number_format($compra->total, 2) }}</td>
                        <td>
                            @php
                                $badges = [
                                    'pendiente' => 'bg-warning text-dark',
                                    'pagada' => 'bg-success',
                                    'cancelada' => 'bg-danger',
                                    'entregada' => 'bg-primary',
                                ];
                            @endphp
                            <span class="badge {{ $badges[$compra->estado] ?? 'bg-secondary' }}">{{ ucfirst($compra->estado) }}</span>
                        </td>
                        <td>{{ $compra->metodoPago ?? '—' }}</td>
                        <td>{{ $compra->created_at->format('d/m/Y H:i') }}</td>
                        <td><a class="btn btn-primary"
                                href="{{ route('compras.edit', ['compra' => $compra->id]) }}">Actualizar</a></td>
                        <td>
                            <form action="{{ route('compras.destroy', ['compra' => $compra->id]) }}" method="POST" class="form-delete">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $compras->links() }}
    </div>
</div>
@endsection
