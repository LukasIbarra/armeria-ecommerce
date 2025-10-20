# TODO - Actualización Página de Inicio

## ✅ Completado
- [x] Actualizar HomeController para obtener categorías y productos destacados
- [x] Modificar sección de categorías para mostrar datos dinámicos
- [x] Reemplazar productos hardcodeados con productos destacados usando componente product-card
- [x] Corregir ruta de categorías (web.category.show)

## 🔄 Próximos Pasos
- [ ] Probar la página de inicio para asegurar que se muestren los productos correctamente
- [ ] Limpiar secciones duplicadas en home.blade.php si es necesario
- [ ] Agregar imágenes de categorías si se desea mejorar el diseño
- [x] Crear rutas faltantes para productos (web.product.index) - ✅ Las rutas ya existen
- [x] Agregar secciones de productos por categorías (Vestuario, Caza, Camping) - ✅ Implementado

## 📝 Notas
- Se agregó $recentProducts al controlador pero no se está usando en la vista
- Las secciones de categorías ahora muestran un grid con card principal de categoría y productos relacionados
- Camping/Trekking tiene un layout especial con card grande (1 columna que ocupa 2 filas) y 6 productos en el lado derecho (1 columna cada uno)
