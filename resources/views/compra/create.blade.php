@extends('layouts.form')
@section('title', 'Crear compra')

@section('form')
    <h2>Crear compra</h2>
    <div class="shadow p-4 mb-5 bg-body-tertiary rounded">
        <form action="{{ route('compras.store') }}" method="POST" id="frm-compra">
            @csrf
            <div class="mb-4 fs-5">
                <label for="cliente_id" class="form-label">Cliente</label>
                <div class="d-flex gap-2">
                    <select name="cliente_id" class="form-select" id="cliente_id">
                        <option value="">Selecciona un cliente</option>
                        @foreach ($clientes as $cliente)
                            <option value="{{ $cliente->id }}" {{ old('cliente_id') == $cliente->id ? 'selected' : '' }}>{{ $cliente->nombre }} {{ $cliente->apellidoP }} {{ $cliente->apellidoM }}</option>
                        @endforeach
                    </select>
                    <button type="button" class="btn btn-outline-success text-nowrap" data-bs-toggle="modal" data-bs-target="#modalNuevoCliente">+ Cliente</button>
                </div>
                @error('cliente_id')
                    <p class="text-danger small mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4 fs-5">
                <label for="estado" class="form-label">Estado</label>
                <select name="estado" class="form-select" id="estado">
                    @foreach (['pendiente', 'pagada', 'cancelada', 'entregada'] as $estadoOpcion)
                        <option value="{{ $estadoOpcion }}" {{ old('estado', 'pendiente') == $estadoOpcion ? 'selected' : '' }}>{{ ucfirst($estadoOpcion) }}</option>
                    @endforeach
                </select>
                @error('estado')
                    <p class="text-danger small mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4 fs-5">
                <label for="metodoPago" class="form-label">Método de pago</label>
                <input name="metodoPago" type="text" class="form-control" id="metodoPago" placeholder="Efectivo, tarjeta, transferencia..." value="{{ old('metodoPago') }}">
                @error('metodoPago')
                    <p class="text-danger small mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4 fs-5">
                <label class="form-label">Productos</label>
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th style="width: 120px;">Cantidad</th>
                            <th>Precio unitario</th>
                            <th>Subtotal</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="filas-productos"></tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" class="text-end">Total</td>
                            <td id="total-compra">$0.00</td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
                <button type="button" id="btn-agregar-producto" class="btn btn-outline-primary btn-sm">+ Agregar producto</button>
                @error('productos')
                    <p class="text-danger small mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Crear</button>
        </form>
    </div>

    <template id="fila-producto-template">
        <tr>
            <td>
                <select name="productos[__INDEX__][producto_id]" class="form-select select-producto">
                    <option value="">Selecciona un producto</option>
                    @foreach ($productos as $producto)
                        <option value="{{ $producto->id }}" data-precio="{{ $producto->precio }}">{{ $producto->nombreProducto }} (${{ number_format($producto->precio, 2) }})</option>
                    @endforeach
                </select>
            </td>
            <td><input type="number" name="productos[__INDEX__][cantidad]" class="form-control input-cantidad" min="1" value="1"></td>
            <td class="precio-unitario">$0.00</td>
            <td class="subtotal-fila">$0.00</td>
            <td><button type="button" class="btn btn-danger btn-sm btn-quitar-fila">Quitar</button></td>
        </tr>
    </template>

    <div class="modal fade" id="modalNuevoCliente" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Nuevo cliente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="frm-nuevo-cliente">
                        <div class="mb-3">
                            <label class="form-label">Nombre</label>
                            <input name="nombre" type="text" class="form-control">
                            <p class="text-danger small mt-1 error-nombre"></p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Apellido Paterno</label>
                            <input name="apellidoP" type="text" class="form-control">
                            <p class="text-danger small mt-1 error-apellidoP"></p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Apellido Materno</label>
                            <input name="apellidoM" type="text" class="form-control">
                            <p class="text-danger small mt-1 error-apellidoM"></p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Teléfono</label>
                            <input name="telefono" type="number" class="form-control">
                            <p class="text-danger small mt-1 error-telefono"></p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input name="correo" type="email" class="form-control">
                            <p class="text-danger small mt-1 error-correo"></p>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" id="btn-guardar-cliente" class="btn btn-success">Guardar cliente</button>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script type="module">
        $(document).ready(function () {
            let filaIndex = 0;
            const oldProductos = @json(old('productos', []));

            function recalcularTotal() {
                let total = 0;
                $('.subtotal-fila').each(function () {
                    total += parseFloat($(this).data('valor')) || 0;
                });
                $('#total-compra').text('$' + total.toFixed(2));
            }

            function actualizarFila(fila) {
                const precio = parseFloat(fila.find('.select-producto option:selected').data('precio')) || 0;
                const cantidad = parseInt(fila.find('.input-cantidad').val()) || 0;
                const subtotal = precio * cantidad;
                fila.find('.precio-unitario').text('$' + precio.toFixed(2));
                fila.find('.subtotal-fila').text('$' + subtotal.toFixed(2)).data('valor', subtotal);
                recalcularTotal();
            }

            function agregarFila(productoId, cantidad) {
                const template = document.getElementById('fila-producto-template');
                const clone = document.importNode(template.content, true);
                clone.querySelectorAll('[name]').forEach(function (el) {
                    el.name = el.name.replace('__INDEX__', filaIndex);
                });
                const $fila = $(clone.querySelector('tr'));
                if (productoId) {
                    $fila.find('.select-producto').val(productoId);
                }
                if (cantidad) {
                    $fila.find('.input-cantidad').val(cantidad);
                }
                $('#filas-productos').append($fila);
                actualizarFila($fila);
                filaIndex++;
            }

            $('#btn-agregar-producto').on('click', function () {
                agregarFila();
            });

            $('#filas-productos').on('change', '.select-producto, .input-cantidad', function () {
                actualizarFila($(this).closest('tr'));
            });

            $('#filas-productos').on('click', '.btn-quitar-fila', function () {
                if ($('#filas-productos tr').length > 1) {
                    $(this).closest('tr').remove();
                    recalcularTotal();
                }
            });

            if (oldProductos.length > 0) {
                oldProductos.forEach(function (item) {
                    agregarFila(item.producto_id, item.cantidad);
                });
            } else {
                agregarFila();
            }

            $('#btn-guardar-cliente').on('click', function () {
                const btn = $(this);
                btn.prop('disabled', true);
                $('#frm-nuevo-cliente .text-danger').text('');

                axios.post('{{ route('clientes.store') }}', {
                    nombre: $('#frm-nuevo-cliente input[name=nombre]').val(),
                    apellidoP: $('#frm-nuevo-cliente input[name=apellidoP]').val(),
                    apellidoM: $('#frm-nuevo-cliente input[name=apellidoM]').val(),
                    telefono: $('#frm-nuevo-cliente input[name=telefono]').val(),
                    correo: $('#frm-nuevo-cliente input[name=correo]').val(),
                }).then(function (response) {
                    const cliente = response.data.cliente;
                    const nombreCompleto = cliente.nombre + ' ' + cliente.apellidoP + ' ' + cliente.apellidoM;
                    $('#cliente_id').append(new Option(nombreCompleto, cliente.id, true, true));
                    document.getElementById('frm-nuevo-cliente').reset();
                    bootstrap.Modal.getInstance(document.getElementById('modalNuevoCliente')).hide();
                    Swal.fire({
                        icon: 'success',
                        title: 'Cliente añadido',
                        text: nombreCompleto
                    });
                }).catch(function (error) {
                    if (error.response && error.response.status === 422) {
                        const errors = error.response.data.errors;
                        Object.keys(errors).forEach(function (field) {
                            $('#frm-nuevo-cliente .error-' + field).text(errors[field][0]);
                        });
                    }
                }).finally(function () {
                    btn.prop('disabled', false);
                });
            });
        });
    </script>
    @endpush
@endsection
