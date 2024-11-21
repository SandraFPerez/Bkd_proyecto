const express = require('express');
const path = require('path');
const app = express();

// Configurar un puerto
const PORT = 8700;

// Servir archivos estáticos del directorio frontend
app.use(express.static(path.join(__dirname, '../frontend')));

// Ruta principal
app.get('/', (req, res) => {
  res.sendFile(path.join(__dirname, '../frontend/index.html'));
});

// Levantar el servidor
app.listen(PORT, () => {
  console.log(`Servidor corriendo en http://localhost:${PORT}`);
});
