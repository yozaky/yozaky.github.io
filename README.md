# 🔍 TechBlog - Búsqueda con Apache Solr

## 📋 Descripción
Aplicación web de búsqueda impulsada por **Apache Solr**, con soporte tanto para **XAMPP local** como para **GitHub Pages**.

## 🚀 Cómo Usar

### En Local (XAMPP)
1. Asegúrate de que **Solr esté corriendo** en `http://localhost:8983`
2. Accede a: `http://localhost/yozaky.github.io/solr-search.html`
3. La búsqueda funcionará en **tiempo real** contra Solr

### En GitHub Pages
1. Primero ejecuta el exportador: `http://localhost/yozaky.github.io/export-solr.php`
   - Esto crea `data.json` con todos los documentos indexados
2. Sube `solr-search.html` y `data.json` a GitHub Pages
3. Las búsquedas se harán sobre el archivo `data.json` estático

## 📁 Archivos

| Archivo | Descripción |
|---------|------------|
| `solr-search.html` | Página principal con interfaz de búsqueda |
| `proxy-solr.php` | Proxy PHP para acceder a Solr desde XAMPP (evita CORS) |
| `export-solr.php` | Exporta datos de Solr a `data.json` para GitHub Pages |
| `data.json` | Archivo JSON estático con todos los documentos (para GitHub Pages) |

## 🔧 Cómo Funciona

### Detección Automática
El código JavaScript detecta automáticamente si está ejecutándose en:
- **Local**: `localhost` o `127.0.0.1` → Usa Solr en tiempo real
- **GitHub Pages**: URL remota → Usa `data.json` estático

### Búsquedas en Local
```javascript
// URL de búsqueda: proxy-solr.php
http://localhost/yozaky.github.io/proxy-solr.php?q=title:javascript...
```

### Búsquedas en GitHub Pages
```javascript
// Carga data.json y filtra en JavaScript
const filteredDocs = fullData.response.docs.filter(doc => {
  return doc.content.toLowerCase().includes(query.toLowerCase());
});
```

## 📝 Para Actualizar Datos en GitHub Pages

Cada vez que cambies los índices en Solr:
1. Ejecuta: `http://localhost/yozaky.github.io/export-solr.php`
2. Sube el nuevo `data.json` a GitHub Pages

## ⚙️ Configuración

### Solr
- **Host**: `localhost`
- **Puerto**: `8983`
- **Core**: `techblog`
- **URL Base**: `http://localhost:8983/solr/techblog`

### Campos Indexados
- `title`: Título del artículo
- `content`: Contenido principal
- `keywords`: Palabras clave
- `category`: Categoría del artículo

## 🐛 Solución de Problemas

### Error: "No se pudo conectar con Solr" (Local)
- ✓ Verifica que Solr esté corriendo en `http://localhost:8983`
- ✓ Verifica que el core `techblog` exista

### Error: "JSON.parse: unexpected character..." (GitHub Pages)
- ✓ Asegúrate de ejecutar `export-solr.php` para generar `data.json`
- ✓ Verifica que `data.json` esté en la raíz del repositorio

### Las búsquedas no retornan resultados
- ✓ En local: verifica que los documentos estén indexados en Solr
- ✓ En GitHub Pages: ejecuta `export-solr.php` para actualizar `data.json`

## 🌐 Búsquedas Disponibles

Prueba con estos términos:
- `JavaScript`
- `Python`
- `React`
- `Docker`
- `seguridad`
- `API`
- `Git`

## 📦 Tecnologías

- **Frontend**: HTML5, CSS3, JavaScript (Fetch API)
- **Backend**: Apache Solr 8.x+
- **Proxy**: PHP 7.4+
- **Hosting**: XAMPP / GitHub Pages

---

**Última actualización**: 17 de enero de 2026
