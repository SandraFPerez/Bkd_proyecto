function registro_renta (){
    const url = 'http://localhost:8000/routes/index.php?endpoint=registrarRenta';
    fetch(url, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
            idVehiculo: 1,
            idCliente: 2,
            fechaInicio: '2024-11-22',
            fechaFin: '2024-11-30'
        })
    }).then(response => response.json())
      .then(data => console.log(data));
    
}

function generar_factura(){
    fetch('http://localhost:8000/routes/index.php?endpoint=generarFactura', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ idRenta: 1 })
    }).then(response => response.json())
      .then(data => console.log(data));
    
}

function obtener_auditoria(){
    fetch('http://localhost:8000/Bkd_proyecto/backend/routers/index.php?endpoint=obtenerAuditorias')
    .then(response => response.json())
    .then(data => console.log(data));
}

// Función genérica para manejar envíos
async function submitForm(formId, endpoint) {
    const form = document.getElementById(formId);
    const formData = new FormData(form);
    const data = Object.fromEntries(formData.entries());

    try {
        const response = await fetch(endpoint, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(data)
        });
        const result = await response.json();
        alert(result.message || "Operación realizada con éxito");
        form.reset();
        fetchAndRenderTable(endpoint, `${formId.split('-')[0]}-table`);
    } catch (error) {
        console.error(error);
        alert("Ocurrió un error al procesar la solicitud.");
    }
}

// Función genérica para obtener y renderizar datos en una tabla
async function fetchAndRenderTable(endpoint, tableId) {
    try {
        const response = await fetch(endpoint);
        const data = await response.json();
        const tableBody = document.querySelector(`#${tableId} tbody`);
        tableBody.innerHTML = '';

        data.forEach(row => {
            const tr = document.createElement('tr');
            Object.values(row).forEach(value => {
                const td = document.createElement('td');
                td.textContent = value;
                tr.appendChild(td);
            });
            tableBody.appendChild(tr);
        });
    } catch (error) {
        console.error(error);
        alert("Error al cargar los datos.");
    }
}

// Funciones específicas
function submitVehiculo() {
    submitForm('vehiculos-form', '/api/vehiculos');
}

function submitUsuario() {
    submitForm('usuarios-form', '/api/usuarios');
}

function submitEmpleado() {
    submitForm('empleados-form', '/api/empleados');
}

function submitCliente() {
    submitForm('clientes-form', '/api/clientes');
}

// Cargar tablas al inicio
document.addEventListener('DOMContentLoaded', () => {
    fetchAndRenderTable('/api/vehiculos', 'vehiculos-table');
    fetchAndRenderTable('/api/usuarios', 'usuarios-table');
    fetchAndRenderTable('/api/empleados', 'empleados-table');
    fetchAndRenderTable('/api/clientes', 'clientes-table');
});
