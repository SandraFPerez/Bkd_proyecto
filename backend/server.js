const cors = require('cors');
const express = require('express');
const path = require('path');
const oracledb = require('oracledb'); // Si usas Oracle
const app = express();

const PORT = 8700;

// Configurar CORS
app.use(cors({
  origin: '*', // Permitir todos los orígenes
  methods: ['GET', 'POST', 'PUT', 'DELETE'], // Métodos permitidos
  allowedHeaders: ['Content-Type', 'Authorization'] // Encabezados permitidos
}));

// Servir archivos estáticos del directorio frontend
app.use(express.static(path.join(__dirname, '../frontend')));

// Configurar la conexión a la base de datos Oracle
const dbConfig = {
  user: 'SYSTEM',           // Usuario de la base de datos
  password: '123456',       // Contraseña del usuario
  connectString: 'localhost:1522/XE' // Conexión de Oracle (HOST:PUERTO/SID o SERVICIO)
};

// Probar la conexión a la base de datos
async function testDbConnection() {
  try {
    const connection = await oracledb.getConnection(dbConfig);
    console.log('Conexión exitosa a la base de datos Oracle');
    await connection.close(); // Cerrar la conexión después de probarla
  } catch (error) {
    console.error('Error al conectar con la base de datos Oracle: ', error);
  }
}

// Probar la conexión a la base de datos al arrancar el servidor
testDbConnection();

// Ruta principal
app.get('/', (req, res) => {
  res.sendFile(path.join(__dirname, '../frontend/index.html'));
});

// Levantar el servidor
app.listen(PORT, () => {
  console.log(`Servidor corriendo en http://localhost:${PORT}`);
});
