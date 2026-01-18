# ✅ Lista de Verificación para GitHub Pages

## Antes de Subir a GitHub Pages

### 1. Generar datos estáticos
```bash
# Ejecutar localmente (asumiendo Solr corriendo)
http://localhost/yozaky.github.io/export-solr.php
```
✓ Esto crea/actualiza el archivo `data.json`

### 2. Archivos a subir a GitHub

Necesitas estos archivos en tu repositorio:
```
yozaky.github.io/
├── solr-search.html      ✓ Página principal
├── data.json             ✓ Datos estáticos (IMPORTANTE)
├── proxy-solr.php        ✗ No es necesario en GitHub Pages
├── export-solr.php       ✗ No es necesario en GitHub Pages
├── index.html
├── google-search.html
└── README.md
```

### 3. Después de Subir

Accede a:
```
https://yozaky.github.io/solr-search.html
```

✓ Las búsquedas funcionarán sobre `data.json`
✓ No necesita Solr corriendo en el servidor
✓ Funciona completamente estático

## 🔄 Actualizar Datos en GitHub Pages

Cuando quieras actualizar los datos:

1. Asegúrate de que **Solr esté corriendo** localmente
2. Ejecuta: `http://localhost/yozaky.github.io/export-solr.php`
3. Ejecuta:
   ```bash
   git add data.json
   git commit -m "Actualizar datos de Solr"
   git push
   ```

## 📱 Notas Importantes

### En Local (XAMPP)
- Usa `proxy-solr.php` para acceder a Solr
- Las búsquedas son en **tiempo real**
- Requiere que Solr esté corriendo

### En GitHub Pages
- Usa `data.json` (archivo estático)
- Las búsquedas se hacen en **JavaScript** (sin servidor)
- No requiere Solr corriendo en el servidor remoto
- El filtrado es **case-insensitive** (insensible a mayúsculas)

## 🧪 Pruebas Recomendadas

Antes de dejar en producción:

```bash
# 1. Verificar que data.json es válido
node -e "console.log(JSON.parse(require('fs').readFileSync('data.json')))"

# 2. Verificar en navegador (local)
http://localhost/yozaky.github.io/solr-search.html

# 3. Probar búsquedas comunes
- JavaScript
- Python
- React
- Docker
```

---

**Actualizado**: 17 de enero de 2026
