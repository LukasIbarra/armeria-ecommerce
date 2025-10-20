# 📋 TODO - ARMERIA E-COMMERCE

## ✅ FASE 1: Página de Inicio Mejorada - COMPLETADA
- [x] Agregar campo 'is_featured' a tabla products
- [x] Modificar HomeController para pasar productos destacados
- [x] Agregar sección productos destacados con cards en home.blade.php
- [x] Agregar sección CTAs en home.blade.php
- [x] Agregar sección imágenes referenciales de la armería en home.blade.php
- [x] Agregar sección mapa en home.blade.php
- [x] Agregar sección contacto en home.blade.php

---

## 🔥 PRIORIDAD ALTA - HACER AHORA

### FASE 2A: Ajustes de Base de Datos (2-3 horas)
- [ ] Crear migración para eliminar campos `is_restricted` y `requires_license` de tabla products
- [ ] Crear migración para eliminar tabla `license_checks`
- [ ] Crear migración para agregar campo `slug` a tabla products
- [ ] Actualizar modelo Product.php (eliminar campos de licencia, agregar slug)
- [ ] Eliminar modelo LicenseCheck.php y su controlador
- [ ] Ejecutar migraciones: `php artisan migrate`

### FASE 2B: Gestión de Imágenes y Seeders (3-4 horas)
- [ ] Verificar/crear carpeta `storage/app/public/products/` con subcarpetas por categoría
- [ ] Crear CategorySeeder con categorías de airsoft/compresión
- [ ] Actualizar ProductSeeder para usar imágenes reales de la carpeta tienda
- [ ] Ejecutar seeders: `php artisan db:seed`
- [ ] Verificar datos en base de datos

### FASE 3: Vista de Productos con Filtros (6-8 horas)
- [ ] Implementar ProductController->index() con filtros y paginación
- [ ] Implementar ProductController->show() para detalle de producto
- [ ] Crear vista products/index.blade.php con:
  - [ ] Barra de búsqueda
  - [ ] Filtros laterales (categorías, precio, stock)
  - [ ] Grid de productos con cards profesionales
  - [ ] Paginación
- [ ] Crear vista products/show.blade.php con:
  - [ ] Galería de imágenes
  - [ ] Información detallada
  - [ ] Selector de cantidad
  - [ ] Botón agregar al carrito
  - [ ] Botón comprar ahora
  - [ ] Productos relacionados
- [ ] Crear componente product-card.blade.php reutilizable

### FASE 4: Sistema de Carrito Funcional (6-8 horas)
- [ ] Crear CartService para lógica de negocio
- [ ] Implementar CartController con métodos:
  - [ ] index() - Ver carrito
  - [ ] add() - Agregar producto
  - [ ] update() - Actualizar cantidad
  - [ ] remove() - Eliminar producto
  - [ ] clear() - Vaciar carrito
- [ ] Crear vista cart/index.blade.php con:
  - [ ] Lista de productos en carrito
  - [ ] Controles de cantidad (+/-)
  - [ ] Botón eliminar
  - [ ] Resumen de compra (subtotal, envío, total)
  - [ ] Botón proceder al pago
  - [ ] Estado de carrito vacío
- [ ] Agregar mini-carrito al header con badge de cantidad
- [ ] Implementar funcionalidad AJAX para agregar sin recargar página

---

## 📅 PRIORIDAD MEDIA - HACER DESPUÉS

### FASE 5: Mejoras de UI/UX (4-6 horas)
- [ ] Crear componentes reutilizables:
  - [ ] filter-sidebar.blade.php
  - [ ] cart-item.blade.php
  - [ ] price-display.blade.php
- [ ] Mejorar estilos CSS personalizados
- [ ] Agregar animaciones y transiciones suaves
- [ ] Implementar tema oscuro/claro
- [ ] Optimizar responsive design para móviles

### FASE 6: Checkout y Órdenes (8-10 horas)
- [ ] Crear CheckoutController
- [ ] Implementar proceso de checkout en 3 pasos:
  - [ ] Paso 1: Información de envío
  - [ ] Paso 2: Método de pago
  - [ ] Paso 3: Confirmación
- [ ] Crear vistas de checkout
- [ ] Implementar creación de órdenes
- [ ] Configurar envío de emails de confirmación
- [ ] Crear vista de historial de órdenes del usuario
- [ ] Integrar pasarela de pago (Flow o MercadoPago)

### FASE 7: Dashboard Administrativo (12-16 horas)
- [ ] Crear estructura de carpetas admin
- [ ] Implementar middleware AdminMiddleware
- [ ] Crear controladores admin:
  - [ ] DashboardController (estadísticas)
  - [ ] Admin/ProductController (CRUD completo)
  - [ ] Admin/CategoryController (CRUD)
  - [ ] Admin/OrderController (gestión de órdenes)
  - [ ] Admin/UserController (gestión de usuarios)
- [ ] Crear vistas del dashboard:
  - [ ] Layout admin con sidebar
  - [ ] Dashboard principal con gráficos
  - [ ] Gestión de productos (crear, editar, eliminar, stock)
  - [ ] Gestión de categorías
  - [ ] Gestión de órdenes (cambiar estados)
  - [ ] Reportes de ventas (local y web)

---

## 🎯 PRIORIDAD BAJA - MEJORAS FUTURAS

### FASE 8: Optimizaciones (4-6 horas)
- [ ] Implementar cache de consultas frecuentes
- [ ] Optimizar imágenes (WebP, lazy loading)
- [ ] Mejorar SEO (meta tags dinámicos, sitemap.xml)
- [ ] Agregar tests unitarios y de integración
- [ ] Implementar rate limiting para APIs

### Funcionalidades Adicionales Sugeridas
- [ ] Sistema de reseñas y calificaciones de productos
- [ ] Lista de deseos (wishlist)
- [ ] Comparador de productos (hasta 4 productos)
- [ ] Sistema de cupones y descuentos
- [ ] Programa de puntos/fidelidad
- [ ] Notificaciones (stock disponible, cambios de precio)
- [ ] Blog/Guías sobre airsoft y mantenimiento
- [ ] Chat en vivo o integración con WhatsApp Business
- [ ] Búsqueda avanzada con filtros múltiples
- [ ] Integración con redes sociales (login, compartir)
- [ ] Sistema de envíos (Chilexpress, Starken, etc)
- [ ] Múltiples pasarelas de pago (WebPay, Flow, MercadoPago)
- [ ] PWA (Progressive Web App) para experiencia móvil
- [ ] Analytics avanzado y heatmaps
- [ ] Sistema de recordatorio de carrito abandonado

---

## 📝 NOTAS IMPORTANTES

### Sobre el Sistema de Licencias:
❌ **ELIMINAR** - Las armas de airsoft y compresión NO requieren licencia en Chile, por lo tanto:
- Eliminar campos `is_restricted` y `requires_license` de productos
- Eliminar tabla `license_checks` completa
- Eliminar modelo y controlador relacionados

### Sobre las Imágenes:
📸 Las imágenes en la carpeta `tienda/` deben organizarse por categoría y usarse para poblar la base de datos con productos reales.

### Stack Tecnológico:
- **Backend**: Laravel 11
- **Frontend**: Blade + Tailwind CSS + Alpine.js
- **Base de Datos**: MySQL
- **Assets**: Vite

### Convenciones:
- Código en inglés
- Comentarios en español
- Commits descriptivos en español
- Seguir PSR-12 para PHP

---

## 📚 RECURSOS

- **Plan Completo**: Ver `PLAN_IMPLEMENTACION.md` para detalles exhaustivos
- **Cronograma**: 45-61 horas estimadas para implementación completa
- **Documentación Laravel**: https://laravel.com/docs/11.x

---

## 🎯 PRÓXIMOS PASOS INMEDIATOS

1. ✅ Revisar y aprobar el plan de implementación
2. 🔄 Comenzar con Fase 2A: Ajustes de Base de Datos
3. 🔄 Continuar con Fase 2B: Seeders e imágenes
4. 🔄 Implementar Fase 3: Vista de productos
5. 🔄 Implementar Fase 4: Carrito funcional

**¿Listo para comenzar? ¡Empecemos con la Fase 2A!** 🚀
