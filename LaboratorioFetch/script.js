const resultado = document.getElementById('resultado'); 
const registrar = document.getElementById('registrar');
const frm = document.getElementById('frm');
const idp = document.getElementById('idp');
const codigo = document.getElementById('codigo');
const producto = document.getElementById('producto');
const precio = document.getElementById('precio');
const cantidad = document.getElementById('cantidad');
const buscar = document.getElementById('buscar');

function ListarProductos(busqueda = "") {
    let formData = new FormData();
    let accion;

    switch (busqueda) {
        case "":
            accion = "listar";
            break;
        default:
            accion = "buscar";
            break;
    }

    formData.append("accion", accion);
    formData.append("valor", busqueda);

    fetch("registrar.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success === false) {
            resultado.innerHTML = `<tr><td colspan="5">${data.error}</td></tr>`;
            return;
        }
        if (!Array.isArray(data) || data.length === 0) {
            resultado.innerHTML = `<tr><td colspan="5">No hay productos para mostrar</td></tr>`;
            return;
        }

        let filas = "";
        data.forEach(item => {
            filas += `
            <tr>
                <td>${item.id}</td>
                <td>${item.producto}</td>
                <td>${item.precio}</td>
                <td>${item.cantidad}</td>
                <td>
                    <button type="button" class="btn btn-success" onclick="Editar(${item.id})">Editar</button>
                    <button type="button" class="btn btn-danger" onclick="Eliminar(${item.id})">Eliminar</button>
                </td>
            </tr>`;
        });
        resultado.innerHTML = filas;
    })
    .catch(error => {
        console.error('Error al listar productos:', error);
        resultado.innerHTML = `<tr><td colspan="5">Error al cargar los productos.</td></tr>`;
    });
}

registrar.addEventListener("click", () => {
    const datos = new FormData(frm);
    let accion;

    switch (registrar.value) {
        case "Registrar":
            accion = "registrar";
            break;
        case "Actualizar":
            accion = "modificar";
            break;
        default:
            accion = "registrar";
            break;
    }

    datos.append("accion", accion);

    fetch("registrar.php", {
        method: "POST",
        body: datos
    })
    .then(response => response.json())
    .then(res => {
        switch(res.success) {
            case true:
                Swal.fire({
                    icon: 'success',
                    title: res.message,
                    showConfirmButton: false,
                    timer: 1500
                });
                registrar.value = "Registrar";
                idp.value = "";
                frm.reset();
                ListarProductos();
                break;
            case false:
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: res.error
                });
                break;
            default:
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Respuesta inesperada del servidor.'
                });
                break;
        }
    })
    .catch(error => console.error('Error en registrar/modificar:', error));
});

function Eliminar(id) {
    Swal.fire({
        title: '¿Está seguro de eliminar?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí',
        cancelButtonText: 'No'
    }).then((result) => {
        switch(result.isConfirmed) {
            case true:
                let formData = new FormData();
                formData.append("id", id);
                formData.append("accion", "eliminar");

                fetch("registrar.php", {
                    method: "POST",
                    body: formData
                })
                .then(response => response.json())
                .then(res => {
                    switch (res.success) {
                        case true:
                            ListarProductos();
                            Swal.fire({
                                icon: 'success',
                                title: res.message,
                                showConfirmButton: false,
                                timer: 1500
                            });
                            break;
                        case false:
                            Swal.fire({
                                icon: 'error',
                                title: 'Error al eliminar',
                                text: res.error
                            });
                            break;
                        default:
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Respuesta inesperada del servidor.'
                            });
                            break;
                    }
                })
                .catch(error => console.error('Error al eliminar:', error));
                break;
            case false:
                
                break;
        }
    });
}

function Editar(id) {
    let formData = new FormData();
    formData.append("id", id);
    formData.append("accion", "obtenerPorId");

    fetch("registrar.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if(data.success === false){
            Swal.fire('Error', data.error, 'error');
            return;
        }
        idp.value = data.data.id;
        codigo.value = data.data.codigo;
        producto.value = data.data.producto;
        precio.value = data.data.precio;
        cantidad.value = data.data.cantidad;

        switch (registrar.value) {
            case "Registrar":
                registrar.value = "Actualizar";
                break;
            default:
                // deja el valor tal cual
                break;
        }
    })
    .catch(error => console.error('Error al cargar producto:', error));
}

buscar.addEventListener("keyup", () => {
    const valor = buscar.value.trim();

    switch (valor) {
        case "":
            ListarProductos();
            break;
        default:
            ListarProductos(valor);
            break;
    }
});

// Mostrar listado inicial al cargar la página
ListarProductos();
