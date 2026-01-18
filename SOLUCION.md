# 🚀 Guía Rápida - Solución Implementada

## ❌ El Problema
```
Error: NetworkError when attempting to fetch resource
Error al cargar artículos: JSON.parse: unexpected character...
```

**Causa**: Los navegadores no pueden acceder a `localhost:8983` desde:
- XAMPP en `localhost` (CORS bloqueado)
- GitHub Pages (origen remoto completamente diferente)

---

## ✅ La Solución

Se implementaron **dos estrategias automáticas**:

### 🏠 En Local (XAMPP)
```
proxy-solr.php → HTTP Request → localhost:8983/solr/techblog
    ↓
Retorna JSON al navegador (sin CORS)
```

**Archivo**: `proxy-solr.php`  
**URL**: `http://localhost/yozaky.github.io/solr-search.html`  
**Ventaja**: Búsquedas en **tiempo real**

---

### 🌐 En GitHub Pages
```
data.json → JavaScript en el navegador → Filtra localmente
```

**Archivo**: `data.json` (estático)  
**URL**: `https://yozaky.github.io/solr-search.html`  
**Ventaja**: No requiere servidor ni Solr en producción

---

## 📝 Cómo Implementó la Solución

### 1. Proxy PHP (Para Local)
```php
// proxy-solr.php
header('Access-Control-Allow-Origin: *');
$response = file_get_contents('http://localhost:8983/solr/techblog/select?...');
echo $response;
```

### 2. Exportador de Datos (Para GitHub Pages)
```php
// export-solr.php
$data = file_get_contents('http://localhost:8983/solr/techblog/select?q=*:*...');
file_put_contents('data.json', json_encode($data));
```

### 3. Detección Automática (JavaScript)
```javascript
const isLocal = window.location.hostname === 'localhost';

if (isLocal) {
    // Usar proxy-solr.php
    const SOLR_URL = './proxy-solr.php';
} else {
    // Usar data.json
    const SOLR_URL = './data.json';
}
```

---

## 🔄 Flujo de Trabajo

### Desarrollo Local
```
1. Solr corriendo en localhost:8983 ✓
2. Abre http://localhost/yozaky.github.io/solr-search.html
3. Busca en tiempo real ✓
```

### Publicación en GitHub Pages
```
1. Ejecuta http://localhost/yozaky.github.io/export-solr.php
2. Sube solr-search.html + data.json
3. Accede a https://yozaky.github.io/solr-search.html
4. Busca en data.json (sin Solr) ✓
```

---

## 📊 Comparación

| Característica | Local | GitHub Pages |
|---------------|-------|--------------|
| **URL** | `localhost:80` | `github.io` |
| **Búsqueda** | Tiempo real | Estática |
| **Requiere Solr** | Sí (backend) | No |
| **Actualización de datos** | Automática | Manual (export) |
| **Latencia** | ~50ms | ~0ms (local) |
| **Proxy** | proxy-solr.php | ninguno |

---

## 🧬 Archivos Creados/Modificados

| Archivo | Propósito | ¿Necesario en GitHub? |
|---------|-----------|----------------------|
| `solr-search.html` | Página principal | ✓ SÍ |
| `proxy-solr.php` | Proxy CORS (local) | ✗ NO |
| `export-solr.php` | Exporta a JSON (local) | ✗ NO |
| `data.json` | Datos estáticos | ✓ SÍ |
| `README.md` | Documentación | ✓ SÍ |
| `DEPLOYMENT.md` | Guía de deploy | ✓ SÍ |

---

## 🎯 Próximos Pasos

### Para GitHub Pages:
```bash
cd yozaky.github.io
git add solr-search.html data.json README.md DEPLOYMENT.md
git commit -m "Agregar búsqueda con Solr (compatible con GitHub Pages)"
git push
```

### Para actualizar datos:
```bash
# Ejecutar localmente (si hay cambios en Solr)
http://localhost/yozaky.github.io/export-solr.php

# Luego subir
git add data.json
git commit -m "Actualizar datos"
git push
```

---

## ✨ Resultado Final

✓ **Local**: Búsquedas en tiempo real contra Solr  
✓ **GitHub Pages**: Búsquedas estáticas sin necesidad de servidor  
✓ **Sin errores CORS**: Detección automática de ambiente  
✓ **Fácil mantenimiento**: Solo actualizar data.json cuando sea necesario  

---

**Estado**: ✅ Completamente funcional  
**Última actualización**: 17 de enero de 2026
