--
-- PostgreSQL database dump
--

\restrict V5NevU0EBVHxMwc8Gie6sxI6SNUjy50UZHb49fCN6zZwXSZW0RMbbgEd4tR1cgg

-- Dumped from database version 18.3 (Debian 18.3-1.pgdg13+1)
-- Dumped by pg_dump version 18.3 (Debian 18.3-1.pgdg12+1)

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET transaction_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

ALTER TABLE IF EXISTS ONLY public.usuario DROP CONSTRAINT IF EXISTS fk_usuario_seccion;
ALTER TABLE IF EXISTS ONLY public.usuario DROP CONSTRAINT IF EXISTS fk_usuario_rol;
ALTER TABLE IF EXISTS ONLY public.producto DROP CONSTRAINT IF EXISTS fk_producto_proveedor;
ALTER TABLE IF EXISTS ONLY public.producto DROP CONSTRAINT IF EXISTS fk_producto_categoria;
ALTER TABLE IF EXISTS ONLY public.factura DROP CONSTRAINT IF EXISTS fk_factura_usuario;
ALTER TABLE IF EXISTS ONLY public.factura DROP CONSTRAINT IF EXISTS fk_factura_seccion;
ALTER TABLE IF EXISTS ONLY public.factura DROP CONSTRAINT IF EXISTS fk_factura_cliente;
ALTER TABLE IF EXISTS ONLY public.detallefactura DROP CONSTRAINT IF EXISTS fk_detfac_producto;
ALTER TABLE IF EXISTS ONLY public.detallefactura DROP CONSTRAINT IF EXISTS fk_detfac_factura;
ALTER TABLE IF EXISTS ONLY public.detallecompra DROP CONSTRAINT IF EXISTS fk_detcom_producto;
ALTER TABLE IF EXISTS ONLY public.detallecompra DROP CONSTRAINT IF EXISTS fk_detcom_compra;
ALTER TABLE IF EXISTS ONLY public.compra DROP CONSTRAINT IF EXISTS fk_compra_usuario;
ALTER TABLE IF EXISTS ONLY public.compra DROP CONSTRAINT IF EXISTS fk_compra_proveedor;
ALTER TABLE IF EXISTS ONLY public.auditoria DROP CONSTRAINT IF EXISTS fk_auditoria_usuario;
ALTER TABLE IF EXISTS ONLY public.factura_estado_historial DROP CONSTRAINT IF EXISTS factura_estado_historial_id_factura_fkey;
DROP TRIGGER IF EXISTS trg_factura_estado_historial ON public.factura;
DROP TRIGGER IF EXISTS trg_auditar_delete_proveedor ON public.proveedor;
DROP TRIGGER IF EXISTS trg_auditar_delete_producto ON public.producto;
DROP TRIGGER IF EXISTS trg_auditar_delete_cliente ON public.cliente;
DROP TRIGGER IF EXISTS trg_auditar_delete_categoria ON public.categoria;
DROP INDEX IF EXISTS public.idx_factura_estado_historial_factura;
DROP INDEX IF EXISTS public.idx_auditoria_tabla_afectada;
DROP INDEX IF EXISTS public.idx_auditoria_registro_id;
DROP INDEX IF EXISTS public.idx_auditoria_datos_anteriores_gin;
DROP INDEX IF EXISTS public.idx_auditoria_accion_fecha;
ALTER TABLE IF EXISTS ONLY public.usuario DROP CONSTRAINT IF EXISTS usuario_pkey;
ALTER TABLE IF EXISTS ONLY public.usuario DROP CONSTRAINT IF EXISTS usuario_email_key;
ALTER TABLE IF EXISTS ONLY public.seccion DROP CONSTRAINT IF EXISTS seccion_pkey;
ALTER TABLE IF EXISTS ONLY public.seccion DROP CONSTRAINT IF EXISTS seccion_nombre_key;
ALTER TABLE IF EXISTS ONLY public.rol DROP CONSTRAINT IF EXISTS rol_pkey;
ALTER TABLE IF EXISTS ONLY public.rol DROP CONSTRAINT IF EXISTS rol_nombre_key;
ALTER TABLE IF EXISTS ONLY public.proveedor DROP CONSTRAINT IF EXISTS proveedor_pkey;
ALTER TABLE IF EXISTS ONLY public.producto DROP CONSTRAINT IF EXISTS producto_pkey;
ALTER TABLE IF EXISTS ONLY public.producto DROP CONSTRAINT IF EXISTS producto_codigo_key;
ALTER TABLE IF EXISTS ONLY public.factura DROP CONSTRAINT IF EXISTS factura_pkey;
ALTER TABLE IF EXISTS ONLY public.factura_estado_historial DROP CONSTRAINT IF EXISTS factura_estado_historial_pkey;
ALTER TABLE IF EXISTS ONLY public.detallefactura DROP CONSTRAINT IF EXISTS detallefactura_pkey;
ALTER TABLE IF EXISTS ONLY public.detallecompra DROP CONSTRAINT IF EXISTS detallecompra_pkey;
ALTER TABLE IF EXISTS ONLY public.compra DROP CONSTRAINT IF EXISTS compra_pkey;
ALTER TABLE IF EXISTS ONLY public.cliente DROP CONSTRAINT IF EXISTS cliente_pkey;
ALTER TABLE IF EXISTS ONLY public.categoria DROP CONSTRAINT IF EXISTS categoria_pkey;
ALTER TABLE IF EXISTS ONLY public.categoria DROP CONSTRAINT IF EXISTS categoria_nombre_key;
ALTER TABLE IF EXISTS ONLY public.auditoria DROP CONSTRAINT IF EXISTS auditoria_pkey;
ALTER TABLE IF EXISTS public.usuario ALTER COLUMN id_usuario DROP DEFAULT;
ALTER TABLE IF EXISTS public.seccion ALTER COLUMN id_seccion DROP DEFAULT;
ALTER TABLE IF EXISTS public.rol ALTER COLUMN id_rol DROP DEFAULT;
ALTER TABLE IF EXISTS public.proveedor ALTER COLUMN id_proveedor DROP DEFAULT;
ALTER TABLE IF EXISTS public.producto ALTER COLUMN id_producto DROP DEFAULT;
ALTER TABLE IF EXISTS public.factura_estado_historial ALTER COLUMN id_historial DROP DEFAULT;
ALTER TABLE IF EXISTS public.factura ALTER COLUMN id_factura DROP DEFAULT;
ALTER TABLE IF EXISTS public.detallefactura ALTER COLUMN id_detalle DROP DEFAULT;
ALTER TABLE IF EXISTS public.detallecompra ALTER COLUMN id_detalle DROP DEFAULT;
ALTER TABLE IF EXISTS public.compra ALTER COLUMN id_compra DROP DEFAULT;
ALTER TABLE IF EXISTS public.cliente ALTER COLUMN id_cliente DROP DEFAULT;
ALTER TABLE IF EXISTS public.categoria ALTER COLUMN id_categoria DROP DEFAULT;
ALTER TABLE IF EXISTS public.auditoria ALTER COLUMN id_auditoria DROP DEFAULT;
DROP SEQUENCE IF EXISTS public.usuario_id_usuario_seq;
DROP TABLE IF EXISTS public.usuario;
DROP SEQUENCE IF EXISTS public.seccion_id_seccion_seq;
DROP TABLE IF EXISTS public.seccion;
DROP SEQUENCE IF EXISTS public.rol_id_rol_seq;
DROP TABLE IF EXISTS public.rol;
DROP SEQUENCE IF EXISTS public.proveedor_id_proveedor_seq;
DROP TABLE IF EXISTS public.proveedor;
DROP SEQUENCE IF EXISTS public.producto_id_producto_seq;
DROP TABLE IF EXISTS public.producto;
DROP SEQUENCE IF EXISTS public.factura_id_factura_seq;
DROP SEQUENCE IF EXISTS public.factura_estado_historial_id_historial_seq;
DROP TABLE IF EXISTS public.factura_estado_historial;
DROP TABLE IF EXISTS public.factura;
DROP SEQUENCE IF EXISTS public.detallefactura_id_detalle_seq;
DROP TABLE IF EXISTS public.detallefactura;
DROP SEQUENCE IF EXISTS public.detallecompra_id_detalle_seq;
DROP TABLE IF EXISTS public.detallecompra;
DROP SEQUENCE IF EXISTS public.compra_id_compra_seq;
DROP TABLE IF EXISTS public.compra;
DROP SEQUENCE IF EXISTS public.cliente_id_cliente_seq;
DROP TABLE IF EXISTS public.cliente;
DROP SEQUENCE IF EXISTS public.categoria_id_categoria_seq;
DROP TABLE IF EXISTS public.categoria;
DROP SEQUENCE IF EXISTS public.auditoria_id_auditoria_seq;
DROP TABLE IF EXISTS public.auditoria;
DROP FUNCTION IF EXISTS public.validar_factura_existe(p_id_factura integer);
DROP FUNCTION IF EXISTS public.registrar_producto_formulario(p_codigo character varying, p_nombre character varying, p_descripcion text, p_imagen character varying, p_id_categoria integer, p_id_proveedor integer, p_precio_compra numeric, p_precio_venta numeric, p_stock integer);
DROP PROCEDURE IF EXISTS public.registrar_producto(IN p_codigo character varying, IN p_nombre character varying, IN p_descripcion text, IN p_imagen character varying, IN p_id_categoria integer, IN p_id_proveedor integer, IN p_precio_compra numeric, IN p_precio_venta numeric, IN p_stock integer);
DROP FUNCTION IF EXISTS public.registrar_historial_estado_factura();
DROP FUNCTION IF EXISTS public.registrar_factura_sistema(p_id_cliente integer, p_id_usuario integer, p_id_seccion integer, p_subtotal numeric, p_descuento numeric, p_impuesto numeric, p_total numeric, p_tipo_cliente_venta character varying, p_nombre_cliente_fugaz character varying, p_items jsonb);
DROP FUNCTION IF EXISTS public.registrar_cliente_sistema(p_nombres character varying, p_apellidos character varying, p_telefono character varying, p_direccion character varying, p_identificacion character varying, p_tipo_cliente character varying);
DROP PROCEDURE IF EXISTS public.registrar_cliente(IN p_nombres character varying, IN p_apellidos character varying, IN p_telefono character varying, IN p_direccion character varying, IN p_identificacion character varying, IN p_tipo_cliente character varying);
DROP FUNCTION IF EXISTS public.registrar_categoria(p_nombre character varying);
DROP PROCEDURE IF EXISTS public.registrar_auditoria(IN p_usuario character varying, IN p_accion character varying, IN p_tabla_afectada character varying, IN p_descripcion text);
DROP FUNCTION IF EXISTS public.obtener_ventas_por_dia_reportes(p_fecha_desde timestamp without time zone, p_fecha_hasta timestamp without time zone);
DROP FUNCTION IF EXISTS public.obtener_ventas_detalladas_reportes(p_fecha_desde timestamp without time zone, p_fecha_hasta timestamp without time zone);
DROP FUNCTION IF EXISTS public.obtener_ventas_dashboard(p_dias integer);
DROP FUNCTION IF EXISTS public.obtener_usuario_login(p_email character varying);
DROP FUNCTION IF EXISTS public.obtener_usuario_edicion_por_id(p_id_usuario integer);
DROP FUNCTION IF EXISTS public.obtener_usuario_configurar_cuenta(p_id_usuario integer);
DROP FUNCTION IF EXISTS public.obtener_ultimos_productos_vendidos_dashboard(p_limite integer);
DROP FUNCTION IF EXISTS public.obtener_ultimas_facturas_cliente(p_id_cliente integer, p_limite integer);
DROP FUNCTION IF EXISTS public.obtener_total_ventas_reportes(p_fecha_desde timestamp without time zone, p_fecha_hasta timestamp without time zone);
DROP FUNCTION IF EXISTS public.obtener_total_facturas_reportes(p_fecha_desde timestamp without time zone, p_fecha_hasta timestamp without time zone);
DROP FUNCTION IF EXISTS public.obtener_total_clientes_reportes();
DROP FUNCTION IF EXISTS public.obtener_stock_bajo_reportes();
DROP FUNCTION IF EXISTS public.obtener_seccion_por_nombre(p_nombre character varying);
DROP FUNCTION IF EXISTS public.obtener_seccion_por_id(p_id_seccion integer);
DROP FUNCTION IF EXISTS public.obtener_resumen_cliente(p_id_cliente integer);
DROP FUNCTION IF EXISTS public.obtener_proveedor_por_id(p_id_proveedor integer);
DROP FUNCTION IF EXISTS public.obtener_productos_reporte(p_fecha_desde timestamp without time zone, p_fecha_hasta timestamp without time zone);
DROP FUNCTION IF EXISTS public.obtener_productos_mas_vendidos_reportes(p_fecha_desde timestamp without time zone, p_fecha_hasta timestamp without time zone);
DROP FUNCTION IF EXISTS public.obtener_productos_mas_vendidos_dashboard(p_limite integer);
DROP FUNCTION IF EXISTS public.obtener_productos_factura_por_ids(p_ids_productos integer[]);
DROP FUNCTION IF EXISTS public.obtener_producto_imagen(p_id_producto integer);
DROP FUNCTION IF EXISTS public.obtener_producto_edicion_por_id(p_id_producto integer);
DROP FUNCTION IF EXISTS public.obtener_metricas_dashboard();
DROP FUNCTION IF EXISTS public.obtener_lineas_factura_para_impresion(p_id_factura integer);
DROP FUNCTION IF EXISTS public.obtener_lineas_detalle_factura(p_id_factura integer);
DROP FUNCTION IF EXISTS public.obtener_id_cliente_fugaz();
DROP FUNCTION IF EXISTS public.obtener_facturas_recientes_dashboard(p_limite integer);
DROP FUNCTION IF EXISTS public.obtener_factura_para_impresion(p_id_factura integer);
DROP FUNCTION IF EXISTS public.obtener_factura_detalle_por_id(p_id_factura integer);
DROP FUNCTION IF EXISTS public.obtener_detalles_factura_edicion(p_id_factura integer);
DROP FUNCTION IF EXISTS public.obtener_detalles_compra(p_id_compra integer);
DROP FUNCTION IF EXISTS public.obtener_compra_por_id(p_id_compra integer);
DROP FUNCTION IF EXISTS public.obtener_clientes_reporte(p_fecha_desde timestamp without time zone, p_fecha_hasta timestamp without time zone);
DROP FUNCTION IF EXISTS public.obtener_clientes_recientes_dashboard(p_limite integer);
DROP FUNCTION IF EXISTS public.obtener_cliente_por_id(p_id_cliente integer);
DROP FUNCTION IF EXISTS public.obtener_cliente_factura_edicion(p_id_cliente integer);
DROP FUNCTION IF EXISTS public.obtener_cliente_edicion_por_id(p_id_cliente integer);
DROP FUNCTION IF EXISTS public.obtener_categoria_por_id(p_id_categoria integer);
DROP FUNCTION IF EXISTS public.listar_usuarios_para_compras();
DROP FUNCTION IF EXISTS public.listar_usuarios_ordenados();
DROP FUNCTION IF EXISTS public.listar_secciones_ordenadas();
DROP FUNCTION IF EXISTS public.listar_roles_ordenados();
DROP FUNCTION IF EXISTS public.listar_proveedores_producto();
DROP FUNCTION IF EXISTS public.listar_proveedores_para_compras();
DROP FUNCTION IF EXISTS public.listar_proveedores_ordenados();
DROP FUNCTION IF EXISTS public.listar_proveedores_form_producto();
DROP FUNCTION IF EXISTS public.listar_productos_para_factura();
DROP FUNCTION IF EXISTS public.listar_clientes_habituales();
DROP FUNCTION IF EXISTS public.listar_categorias_producto();
DROP FUNCTION IF EXISTS public.listar_categorias_ordenadas();
DROP FUNCTION IF EXISTS public.listar_categorias_form_producto();
DROP FUNCTION IF EXISTS public.listar_categorias_catalogo();
DROP FUNCTION IF EXISTS public.fn_auditar_delete_generico();
DROP FUNCTION IF EXISTS public.eliminar_usuario_sistema(p_id_usuario integer, p_id_usuario_actual integer);
DROP FUNCTION IF EXISTS public.eliminar_proveedor_sistema(p_id_proveedor integer);
DROP FUNCTION IF EXISTS public.eliminar_producto_sistema(p_id_producto integer);
DROP FUNCTION IF EXISTS public.eliminar_factura_sistema(p_id_factura integer);
DROP FUNCTION IF EXISTS public.eliminar_cliente_sistema(p_id_cliente integer);
DROP FUNCTION IF EXISTS public.eliminar_categoria_sistema(p_id_categoria integer);
DROP PROCEDURE IF EXISTS public.editar_factura_sistema(IN p_id_factura integer, IN p_fecha timestamp without time zone, IN p_id_cliente integer, IN p_id_usuario integer, IN p_id_seccion integer, IN p_tipo_cliente_venta character varying, IN p_nombre_cliente_fugaz character varying, IN p_descuento_global numeric, IN p_iva numeric, IN p_items jsonb);
DROP PROCEDURE IF EXISTS public.disminuir_stock_producto(IN p_id_producto integer, IN p_cantidad integer);
DROP FUNCTION IF EXISTS public.crear_usuario_sistema(p_nombre character varying, p_email character varying, p_password text, p_id_rol integer, p_id_seccion integer);
DROP FUNCTION IF EXISTS public.crear_proveedor_sistema(p_nombre character varying, p_telefono character varying, p_email character varying, p_direccion character varying);
DROP FUNCTION IF EXISTS public.calcular_total_compra(p_id_compra integer);
DROP FUNCTION IF EXISTS public.calcular_subtotal_factura(p_id_factura integer);
DROP FUNCTION IF EXISTS public.buscar_usuarios_filtrados(p_busqueda text, p_id_rol integer, p_seccion_filtro text);
DROP FUNCTION IF EXISTS public.buscar_proveedores_filtrados(p_busqueda text);
DROP FUNCTION IF EXISTS public.buscar_productos_inventario(p_busqueda text, p_id_categoria integer, p_id_proveedor integer, p_id_producto integer, p_stock_bajo boolean);
DROP FUNCTION IF EXISTS public.buscar_productos_catalogo(p_busqueda text, p_id_categoria integer, p_disponibilidad character varying);
DROP FUNCTION IF EXISTS public.productos_mas_vendidos_catalogo(p_limite integer);
DROP FUNCTION IF EXISTS public.buscar_facturas_filtradas(p_id_rol integer, p_busqueda text, p_id_seccion integer, p_id_usuario integer, p_fecha_desde timestamp without time zone, p_fecha_hasta timestamp without time zone);
DROP FUNCTION IF EXISTS public.buscar_compras_filtradas(p_busqueda text, p_id_proveedor integer, p_id_usuario integer, p_fecha_desde timestamp without time zone, p_fecha_hasta timestamp without time zone);
DROP FUNCTION IF EXISTS public.buscar_clientes_filtrados(p_busqueda text, p_tipo_cliente character varying);
DROP FUNCTION IF EXISTS public.buscar_categorias(p_busqueda text);
DROP PROCEDURE IF EXISTS public.aumentar_stock_producto(IN p_id_producto integer, IN p_cantidad integer);
DROP PROCEDURE IF EXISTS public.agregar_detalle_factura(IN p_id_factura integer, IN p_id_producto integer, IN p_cantidad integer, IN p_descuento_linea numeric);
DROP PROCEDURE IF EXISTS public.agregar_detalle_compra(IN p_id_compra integer, IN p_id_producto integer, IN p_cantidad integer, IN p_costo_unitario numeric);
DROP FUNCTION IF EXISTS public.actualizar_usuario_sistema(p_id_usuario integer, p_nombre character varying, p_email character varying, p_id_rol integer, p_id_seccion integer, p_password text);
DROP FUNCTION IF EXISTS public.actualizar_usuario_configurar_cuenta(p_id_usuario integer, p_nombre character varying, p_email character varying, p_password text);
DROP PROCEDURE IF EXISTS public.actualizar_totales_factura(IN p_id_factura integer, IN p_descuento numeric, IN p_porcentaje_impuesto numeric);
DROP PROCEDURE IF EXISTS public.actualizar_total_compra(IN p_id_compra integer);
DROP FUNCTION IF EXISTS public.actualizar_proveedor_sistema(p_id_proveedor integer, p_nombre character varying, p_telefono character varying, p_email character varying, p_direccion character varying);
DROP FUNCTION IF EXISTS public.actualizar_producto_edicion(p_id_producto integer, p_codigo character varying, p_nombre character varying, p_descripcion text, p_imagen character varying, p_id_categoria integer, p_id_proveedor integer, p_precio_compra numeric, p_precio_venta numeric, p_stock integer);
DROP FUNCTION IF EXISTS public.actualizar_password_usuario_login(p_id_usuario integer, p_password_hash text);
DROP FUNCTION IF EXISTS public.actualizar_cliente_sistema(p_id_cliente integer, p_nombres character varying, p_apellidos character varying, p_telefono character varying, p_direccion character varying, p_identificacion character varying, p_tipo_cliente character varying);
DROP FUNCTION IF EXISTS public.actualizar_categoria(p_id_categoria integer, p_nombre character varying);
-- *not* dropping schema, since initdb creates it
--
-- Name: public; Type: SCHEMA; Schema: -; Owner: -
--

-- *not* creating schema, since initdb creates it


--
-- Name: SCHEMA public; Type: COMMENT; Schema: -; Owner: -
--

COMMENT ON SCHEMA public IS '';


--
-- Name: actualizar_categoria(integer, character varying); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.actualizar_categoria(p_id_categoria integer, p_nombre character varying) RETURNS TABLE(filas_afectadas integer)
    LANGUAGE plpgsql
    AS $$
DECLARE
    v_filas_afectadas INT;
BEGIN
    IF p_id_categoria IS NULL OR p_id_categoria <= 0 THEN
        RAISE EXCEPTION 'ID de categoría no válido';
    END IF;

    IF p_nombre IS NULL OR TRIM(p_nombre) = '' THEN
        RAISE EXCEPTION 'El nombre de la categoría es obligatorio';
    END IF;

    IF LENGTH(TRIM(p_nombre)) > 80 THEN
        RAISE EXCEPTION 'El nombre de la categoría no debe superar los 80 caracteres';
    END IF;

    UPDATE Categoria
    SET nombre = TRIM(p_nombre)
    WHERE id_categoria = p_id_categoria;

    GET DIAGNOSTICS v_filas_afectadas = ROW_COUNT;

    RETURN QUERY
    SELECT v_filas_afectadas;
END;
$$;


--
-- Name: actualizar_cliente_sistema(integer, character varying, character varying, character varying, character varying, character varying, character varying); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.actualizar_cliente_sistema(p_id_cliente integer, p_nombres character varying, p_apellidos character varying, p_telefono character varying DEFAULT NULL::character varying, p_direccion character varying DEFAULT NULL::character varying, p_identificacion character varying DEFAULT NULL::character varying, p_tipo_cliente character varying DEFAULT 'Detallista'::character varying) RETURNS boolean
    LANGUAGE plpgsql
    AS $$
BEGIN
    IF p_id_cliente IS NULL OR p_id_cliente <= 0 THEN
        RAISE EXCEPTION 'ID de cliente no válido';
    END IF;

    IF p_nombres IS NULL OR TRIM(p_nombres) = '' THEN
        RAISE EXCEPTION 'Los nombres del cliente no pueden estar vacíos';
    END IF;

    IF p_apellidos IS NULL OR TRIM(p_apellidos) = '' THEN
        RAISE EXCEPTION 'Los apellidos del cliente no pueden estar vacíos';
    END IF;

    IF p_tipo_cliente IS NULL
       OR p_tipo_cliente NOT IN ('Mayorista', 'Detallista') THEN
        RAISE EXCEPTION 'Tipo de cliente no válido';
    END IF;

    UPDATE Cliente
    SET
        nombres = TRIM(p_nombres),
        apellidos = TRIM(p_apellidos),
        telefono = NULLIF(TRIM(p_telefono), ''),
        direccion = NULLIF(TRIM(p_direccion), ''),
        identificacion = NULLIF(TRIM(p_identificacion), ''),
        tipo_cliente = p_tipo_cliente
    WHERE Cliente.id_cliente = p_id_cliente;

    RETURN FOUND;
END;
$$;


--
-- Name: actualizar_password_usuario_login(integer, text); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.actualizar_password_usuario_login(p_id_usuario integer, p_password_hash text) RETURNS boolean
    LANGUAGE plpgsql
    AS $$
BEGIN
    IF p_id_usuario IS NULL OR p_id_usuario <= 0 THEN
        RAISE EXCEPTION 'ID de usuario no válido';
    END IF;

    IF p_password_hash IS NULL OR TRIM(p_password_hash) = '' THEN
        RAISE EXCEPTION 'El hash de contraseña no puede estar vacío';
    END IF;

    UPDATE Usuario
    SET password = p_password_hash
    WHERE Usuario.id_usuario = p_id_usuario;

    RETURN FOUND;
END;
$$;


--
-- Name: actualizar_producto_edicion(integer, character varying, character varying, text, character varying, integer, integer, numeric, numeric, integer); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.actualizar_producto_edicion(p_id_producto integer, p_codigo character varying, p_nombre character varying, p_descripcion text, p_imagen character varying, p_id_categoria integer, p_id_proveedor integer, p_precio_compra numeric, p_precio_venta numeric, p_stock integer) RETURNS boolean
    LANGUAGE plpgsql
    AS $$
BEGIN
    IF p_id_producto IS NULL OR p_id_producto <= 0 THEN
        RAISE EXCEPTION 'ID de producto no válido';
    END IF;

    IF p_codigo IS NULL OR TRIM(p_codigo) = '' THEN
        RAISE EXCEPTION 'El código del producto no puede estar vacío';
    END IF;

    IF p_nombre IS NULL OR TRIM(p_nombre) = '' THEN
        RAISE EXCEPTION 'El nombre del producto no puede estar vacío';
    END IF;

    IF p_precio_compra IS NULL OR p_precio_compra < 0 THEN
        RAISE EXCEPTION 'El precio de compra no puede ser negativo';
    END IF;

    IF p_precio_venta IS NULL OR p_precio_venta < 0 THEN
        RAISE EXCEPTION 'El precio de venta no puede ser negativo';
    END IF;

    IF p_stock IS NULL OR p_stock < 0 THEN
        RAISE EXCEPTION 'El stock no puede ser negativo';
    END IF;

    UPDATE Producto
    SET
        codigo = TRIM(p_codigo),
        nombre = TRIM(p_nombre),
        descripcion = COALESCE(NULLIF(TRIM(p_descripcion), ''), 'Sin descripción'),
        imagen = p_imagen,
        id_categoria = p_id_categoria,
        id_proveedor = p_id_proveedor,
        precio_compra = p_precio_compra,
        precio_venta = p_precio_venta,
        stock = p_stock
    WHERE Producto.id_producto = p_id_producto;

    RETURN FOUND;
END;
$$;


--
-- Name: actualizar_proveedor_sistema(integer, character varying, character varying, character varying, character varying); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.actualizar_proveedor_sistema(p_id_proveedor integer, p_nombre character varying, p_telefono character varying DEFAULT NULL::character varying, p_email character varying DEFAULT NULL::character varying, p_direccion character varying DEFAULT NULL::character varying) RETURNS boolean
    LANGUAGE plpgsql
    AS $$
BEGIN
    IF p_id_proveedor IS NULL OR p_id_proveedor <= 0 THEN
        RAISE EXCEPTION 'ID de proveedor no válido';
    END IF;

    IF p_nombre IS NULL OR TRIM(p_nombre) = '' THEN
        RAISE EXCEPTION 'El nombre del proveedor no puede estar vacío';
    END IF;

    UPDATE Proveedor
    SET
        nombre = TRIM(p_nombre),
        telefono = NULLIF(TRIM(p_telefono), ''),
        email = NULLIF(TRIM(p_email), ''),
        direccion = NULLIF(TRIM(p_direccion), '')
    WHERE Proveedor.id_proveedor = p_id_proveedor;

    RETURN FOUND;
END;
$$;


--
-- Name: actualizar_total_compra(integer); Type: PROCEDURE; Schema: public; Owner: -
--

CREATE PROCEDURE public.actualizar_total_compra(IN p_id_compra integer)
    LANGUAGE plpgsql
    AS $$
DECLARE
    v_total NUMERIC(10,2);
BEGIN
    SELECT calcular_total_compra(p_id_compra)
    INTO v_total;

    UPDATE Compra
    SET total = v_total
    WHERE id_compra = p_id_compra;

    IF NOT FOUND THEN
        RAISE EXCEPTION 'No existe una compra con el ID %', p_id_compra;
    END IF;
END;
$$;


--
-- Name: actualizar_totales_factura(integer, numeric, numeric); Type: PROCEDURE; Schema: public; Owner: -
--

CREATE PROCEDURE public.actualizar_totales_factura(IN p_id_factura integer, IN p_descuento numeric DEFAULT 0, IN p_porcentaje_impuesto numeric DEFAULT 0.15)
    LANGUAGE plpgsql
    AS $$
DECLARE
    v_subtotal NUMERIC(10,2);
    v_impuesto NUMERIC(10,2);
    v_total NUMERIC(10,2);
BEGIN
    IF p_descuento < 0 THEN
        RAISE EXCEPTION 'El descuento no puede ser negativo';
    END IF;

    IF p_porcentaje_impuesto < 0 THEN
        RAISE EXCEPTION 'El porcentaje de impuesto no puede ser negativo';
    END IF;

    SELECT calcular_subtotal_factura(p_id_factura)
    INTO v_subtotal;

    IF p_descuento > v_subtotal THEN
        RAISE EXCEPTION 'El descuento no puede ser mayor que el subtotal';
    END IF;

    v_impuesto := ROUND((v_subtotal - p_descuento) * p_porcentaje_impuesto, 2);
    v_total := ROUND((v_subtotal - p_descuento) + v_impuesto, 2);

    UPDATE Factura
    SET subtotal = v_subtotal,
        descuento = p_descuento,
        impuesto = v_impuesto,
        total = v_total
    WHERE id_factura = p_id_factura;

    IF NOT FOUND THEN
        RAISE EXCEPTION 'No existe una factura con el ID %', p_id_factura;
    END IF;
END;
$$;


--
-- Name: actualizar_usuario_configurar_cuenta(integer, character varying, character varying, text); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.actualizar_usuario_configurar_cuenta(p_id_usuario integer, p_nombre character varying, p_email character varying, p_password text) RETURNS boolean
    LANGUAGE plpgsql
    AS $$
BEGIN
    IF p_id_usuario IS NULL OR p_id_usuario <= 0 THEN
        RAISE EXCEPTION 'ID de usuario no válido';
    END IF;

    IF p_nombre IS NULL OR TRIM(p_nombre) = '' THEN
        RAISE EXCEPTION 'El nombre no puede estar vacío';
    END IF;

    IF p_email IS NULL OR TRIM(p_email) = '' THEN
        RAISE EXCEPTION 'El correo electrónico no puede estar vacío';
    END IF;

    IF p_password IS NULL OR TRIM(p_password) = '' THEN
        RAISE EXCEPTION 'La contraseña no puede estar vacía';
    END IF;

    UPDATE Usuario
    SET
        nombre = TRIM(p_nombre),
        email = TRIM(p_email),
        password = p_password
    WHERE Usuario.id_usuario = p_id_usuario;

    RETURN FOUND;
END;
$$;


--
-- Name: actualizar_usuario_sistema(integer, character varying, character varying, integer, integer, text); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.actualizar_usuario_sistema(p_id_usuario integer, p_nombre character varying, p_email character varying, p_id_rol integer, p_id_seccion integer DEFAULT NULL::integer, p_password text DEFAULT NULL::text) RETURNS boolean
    LANGUAGE plpgsql
    AS $$
BEGIN
    IF p_id_usuario IS NULL OR p_id_usuario <= 0 THEN
        RAISE EXCEPTION 'ID de usuario no válido';
    END IF;

    IF p_nombre IS NULL OR TRIM(p_nombre) = '' THEN
        RAISE EXCEPTION 'El nombre del usuario no puede estar vacío';
    END IF;

    IF p_email IS NULL OR TRIM(p_email) = '' THEN
        RAISE EXCEPTION 'El correo electrónico no puede estar vacío';
    END IF;

    IF p_id_rol IS NULL OR p_id_rol <= 0 THEN
        RAISE EXCEPTION 'El rol del usuario no es válido';
    END IF;

    UPDATE Usuario
    SET
        nombre = TRIM(p_nombre),
        email = TRIM(p_email),
        id_rol = p_id_rol,
        id_seccion = p_id_seccion,
        password = CASE
            WHEN p_password IS NULL OR TRIM(p_password) = ''
                THEN Usuario.password
            ELSE p_password
        END
    WHERE Usuario.id_usuario = p_id_usuario;

    RETURN FOUND;
END;
$$;


--
-- Name: agregar_detalle_compra(integer, integer, integer, numeric); Type: PROCEDURE; Schema: public; Owner: -
--

CREATE PROCEDURE public.agregar_detalle_compra(IN p_id_compra integer, IN p_id_producto integer, IN p_cantidad integer, IN p_costo_unitario numeric)
    LANGUAGE plpgsql
    AS $$
DECLARE
    v_total_linea NUMERIC(10,2);
BEGIN
    IF p_cantidad <= 0 THEN
        RAISE EXCEPTION 'La cantidad debe ser mayor que cero';
    END IF;

    IF p_costo_unitario < 0 THEN
        RAISE EXCEPTION 'El costo unitario no puede ser negativo';
    END IF;

    v_total_linea := ROUND(p_cantidad * p_costo_unitario, 2);

    INSERT INTO DetalleCompra (
        id_compra,
        id_producto,
        cantidad,
        costo_unitario,
        total_linea
    )
    VALUES (
        p_id_compra,
        p_id_producto,
        p_cantidad,
        p_costo_unitario,
        v_total_linea
    );

    CALL aumentar_stock_producto(p_id_producto, p_cantidad);

    CALL actualizar_total_compra(p_id_compra);
END;
$$;


--
-- Name: agregar_detalle_factura(integer, integer, integer, numeric); Type: PROCEDURE; Schema: public; Owner: -
--

CREATE PROCEDURE public.agregar_detalle_factura(IN p_id_factura integer, IN p_id_producto integer, IN p_cantidad integer, IN p_descuento_linea numeric DEFAULT 0)
    LANGUAGE plpgsql
    AS $$
DECLARE
    v_precio_unitario NUMERIC(10,2);
    v_stock_actual INT;
    v_total_linea NUMERIC(10,2);
BEGIN
    IF p_cantidad <= 0 THEN
        RAISE EXCEPTION 'La cantidad debe ser mayor que cero';
    END IF;

    IF p_descuento_linea < 0 THEN
        RAISE EXCEPTION 'El descuento de línea no puede ser negativo';
    END IF;

    SELECT precio_venta, stock
    INTO v_precio_unitario, v_stock_actual
    FROM Producto
    WHERE id_producto = p_id_producto;

    IF v_precio_unitario IS NULL THEN
        RAISE EXCEPTION 'No existe un producto con el ID %', p_id_producto;
    END IF;

    IF v_stock_actual < p_cantidad THEN
        RAISE EXCEPTION 'Stock insuficiente. Stock actual: %, cantidad solicitada: %',
            v_stock_actual,
            p_cantidad;
    END IF;

    v_total_linea := ROUND((p_cantidad * v_precio_unitario) - p_descuento_linea, 2);

    IF v_total_linea < 0 THEN
        RAISE EXCEPTION 'El total de línea no puede ser negativo';
    END IF;

    INSERT INTO DetalleFactura (
        id_factura,
        id_producto,
        cantidad,
        precio_unitario,
        descuento_linea,
        total_linea
    )
    VALUES (
        p_id_factura,
        p_id_producto,
        p_cantidad,
        v_precio_unitario,
        p_descuento_linea,
        v_total_linea
    );

    CALL disminuir_stock_producto(p_id_producto, p_cantidad);

    CALL actualizar_totales_factura(p_id_factura, 0, 0.15);
END;
$$;


--
-- Name: aumentar_stock_producto(integer, integer); Type: PROCEDURE; Schema: public; Owner: -
--

CREATE PROCEDURE public.aumentar_stock_producto(IN p_id_producto integer, IN p_cantidad integer)
    LANGUAGE plpgsql
    AS $$
BEGIN
    IF p_cantidad <= 0 THEN
        RAISE EXCEPTION 'La cantidad a agregar debe ser mayor que cero';
    END IF;

    UPDATE Producto
    SET stock = stock + p_cantidad
    WHERE id_producto = p_id_producto;

    IF NOT FOUND THEN
        RAISE EXCEPTION 'No existe un producto con el ID %', p_id_producto;
    END IF;
END;
$$;


--
-- Name: buscar_categorias(text); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.buscar_categorias(p_busqueda text DEFAULT ''::text) RETURNS TABLE(id_categoria integer, nombre character varying)
    LANGUAGE plpgsql
    AS $$
BEGIN
    RETURN QUERY
    SELECT
        c.id_categoria,
        c.nombre
    FROM Categoria c
    WHERE
        COALESCE(TRIM(p_busqueda), '') = ''
        OR c.nombre ILIKE '%' || TRIM(p_busqueda) || '%'
    ORDER BY c.nombre ASC;
END;
$$;


--
-- Name: buscar_clientes_filtrados(text, character varying); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.buscar_clientes_filtrados(p_busqueda text DEFAULT NULL::text, p_tipo_cliente character varying DEFAULT NULL::character varying) RETURNS TABLE(id_cliente integer, nombres character varying, apellidos character varying, telefono character varying, direccion character varying, identificacion character varying, tipo_cliente character varying)
    LANGUAGE plpgsql
    AS $_$
DECLARE
    v_busqueda TEXT;
    v_es_numerica BOOLEAN;
    v_palabras TEXT[];
BEGIN
    v_busqueda := REGEXP_REPLACE(TRIM(COALESCE(p_busqueda, '')), '\s+', ' ', 'g');
    v_es_numerica := v_busqueda ~ '^[0-9]+$';

    IF p_tipo_cliente IS NOT NULL
       AND TRIM(p_tipo_cliente) <> ''
       AND p_tipo_cliente NOT IN ('Mayorista', 'Detallista') THEN
        RAISE EXCEPTION 'Tipo de cliente no válido';
    END IF;

    IF v_busqueda <> '' AND NOT v_es_numerica THEN
        v_palabras := REGEXP_SPLIT_TO_ARRAY(v_busqueda, '\s+');
    END IF;

    RETURN QUERY
    SELECT
        c.id_cliente,
        c.nombres,
        c.apellidos,
        c.telefono,
        c.direccion,
        c.identificacion,
        c.tipo_cliente
    FROM Cliente c
    WHERE (
            v_busqueda = ''
            OR (
                v_es_numerica
                AND (
                    c.id_cliente = v_busqueda::INT
                    OR c.telefono ILIKE '%' || v_busqueda || '%'
                    OR c.identificacion ILIKE '%' || v_busqueda || '%'
                )
            )
            OR (
                NOT v_es_numerica
                AND (
                    SELECT BOOL_AND(
                        c.nombres ILIKE '%' || palabra || '%'
                        OR c.apellidos ILIKE '%' || palabra || '%'
                        OR c.telefono ILIKE '%' || palabra || '%'
                        OR c.direccion ILIKE '%' || palabra || '%'
                        OR c.identificacion ILIKE '%' || palabra || '%'
                        OR c.tipo_cliente ILIKE '%' || palabra || '%'
                        OR CONCAT_WS(' ', c.nombres, c.apellidos) ILIKE '%' || palabra || '%'
                        OR CONCAT_WS(' ', c.apellidos, c.nombres) ILIKE '%' || palabra || '%'
                        OR CONCAT_WS(
                            ' ',
                            c.nombres,
                            c.apellidos,
                            c.telefono,
                            c.direccion,
                            c.identificacion,
                            c.tipo_cliente
                        ) ILIKE '%' || palabra || '%'
                    )
                    FROM UNNEST(v_palabras) AS palabra
                )
            )
        )
      AND (
            p_tipo_cliente IS NULL
            OR TRIM(p_tipo_cliente) = ''
            OR c.tipo_cliente = p_tipo_cliente
        )
    ORDER BY c.id_cliente DESC;
END;
$_$;


--
-- Name: buscar_compras_filtradas(text, integer, integer, timestamp without time zone, timestamp without time zone); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.buscar_compras_filtradas(p_busqueda text DEFAULT NULL::text, p_id_proveedor integer DEFAULT NULL::integer, p_id_usuario integer DEFAULT NULL::integer, p_fecha_desde timestamp without time zone DEFAULT NULL::timestamp without time zone, p_fecha_hasta timestamp without time zone DEFAULT NULL::timestamp without time zone) RETURNS TABLE(id_compra integer, fecha timestamp without time zone, total numeric, proveedor character varying, usuario character varying)
    LANGUAGE plpgsql
    AS $$
BEGIN
    IF p_id_proveedor IS NOT NULL AND p_id_proveedor <= 0 THEN
        RAISE EXCEPTION 'ID de proveedor no válido';
    END IF;

    IF p_id_usuario IS NOT NULL AND p_id_usuario <= 0 THEN
        RAISE EXCEPTION 'ID de usuario no válido';
    END IF;

    RETURN QUERY
    SELECT
        c.id_compra,
        c.fecha,
        c.total,
        p.nombre AS proveedor,
        u.nombre AS usuario
    FROM Compra c
    INNER JOIN Proveedor p ON c.id_proveedor = p.id_proveedor
    INNER JOIN Usuario u ON c.id_usuario = u.id_usuario
    WHERE (
            p_busqueda IS NULL
            OR TRIM(p_busqueda) = ''
            OR p.nombre ILIKE '%' || TRIM(p_busqueda) || '%'
            OR u.nombre ILIKE '%' || TRIM(p_busqueda) || '%'
            OR CAST(c.id_compra AS TEXT) ILIKE '%' || TRIM(p_busqueda) || '%'
        )
      AND (
            p_id_proveedor IS NULL
            OR c.id_proveedor = p_id_proveedor
        )
      AND (
            p_id_usuario IS NULL
            OR c.id_usuario = p_id_usuario
        )
      AND (
            p_fecha_desde IS NULL
            OR c.fecha >= p_fecha_desde
        )
      AND (
            p_fecha_hasta IS NULL
            OR c.fecha <= p_fecha_hasta
        )
    ORDER BY c.fecha DESC;
END;
$$;


--
-- Name: buscar_facturas_filtradas(integer, text, integer, integer, timestamp without time zone, timestamp without time zone); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.buscar_facturas_filtradas(p_id_rol integer DEFAULT NULL::integer, p_busqueda text DEFAULT NULL::text, p_id_seccion integer DEFAULT NULL::integer, p_id_usuario integer DEFAULT NULL::integer, p_fecha_desde timestamp without time zone DEFAULT NULL::timestamp without time zone, p_fecha_hasta timestamp without time zone DEFAULT NULL::timestamp without time zone) RETURNS TABLE(id_factura integer, fecha timestamp without time zone, total numeric, cliente text, usuario character varying, seccion character varying)
    LANGUAGE plpgsql
    AS $$
BEGIN
    IF p_id_rol IS NOT NULL AND p_id_rol < 0 THEN
        RAISE EXCEPTION 'ID de rol no válido';
    END IF;

    IF p_id_seccion IS NOT NULL AND p_id_seccion <= 0 THEN
        RAISE EXCEPTION 'ID de sección no válido';
    END IF;

    IF p_id_usuario IS NOT NULL AND p_id_usuario <= 0 THEN
        RAISE EXCEPTION 'ID de usuario no válido';
    END IF;

    RETURN QUERY
    SELECT
        f.id_factura,
        f.fecha,
        f.total,
        c.nombres || ' ' || c.apellidos AS cliente,
        u.nombre AS usuario,
        s.nombre AS seccion
    FROM Factura f
    JOIN Cliente c ON f.id_cliente = c.id_cliente
    JOIN Usuario u ON f.id_usuario = u.id_usuario
    JOIN Seccion s ON f.id_seccion = s.id_seccion
    WHERE (
            p_id_rol IS NULL
            OR p_id_rol NOT IN (2, 3)
            OR (
                c.tipo_cliente = 'Detallista'
                AND s.nombre = 'Kitsune'
            )
        )
      AND (
            p_busqueda IS NULL
            OR TRIM(p_busqueda) = ''
            OR CAST(f.id_factura AS TEXT) ILIKE '%' || TRIM(p_busqueda) || '%'
            OR c.nombres ILIKE '%' || TRIM(p_busqueda) || '%'
            OR c.apellidos ILIKE '%' || TRIM(p_busqueda) || '%'
            OR c.nombres || ' ' || c.apellidos ILIKE '%' || TRIM(p_busqueda) || '%'
            OR u.nombre ILIKE '%' || TRIM(p_busqueda) || '%'
            OR s.nombre ILIKE '%' || TRIM(p_busqueda) || '%'
        )
      AND (
            p_id_seccion IS NULL
            OR f.id_seccion = p_id_seccion
        )
      AND (
            p_id_usuario IS NULL
            OR f.id_usuario = p_id_usuario
        )
      AND (
            p_fecha_desde IS NULL
            OR f.fecha >= p_fecha_desde
        )
      AND (
            p_fecha_hasta IS NULL
            OR f.fecha <= p_fecha_hasta
        )
    ORDER BY f.fecha DESC, f.id_factura DESC;
END;
$$;


--
-- Name: buscar_productos_catalogo(text, integer, character varying); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.buscar_productos_catalogo(p_busqueda text DEFAULT NULL::text, p_id_categoria integer DEFAULT NULL::integer, p_disponibilidad character varying DEFAULT NULL::character varying) RETURNS TABLE(id_producto integer, codigo character varying, nombre character varying, descripcion text, imagen character varying, categoria character varying, precio_venta numeric, stock integer)
    LANGUAGE plpgsql
    AS $$
BEGIN
    IF p_id_categoria IS NOT NULL AND p_id_categoria <= 0 THEN
        RAISE EXCEPTION 'ID de categoría no válido';
    END IF;

    IF p_disponibilidad IS NOT NULL
       AND p_disponibilidad <> ''
       AND p_disponibilidad NOT IN ('disponible', 'stock_bajo', 'agotado') THEN
        RAISE EXCEPTION 'Filtro de disponibilidad no válido';
    END IF;

    RETURN QUERY
    SELECT
        p.id_producto,
        p.codigo,
        p.nombre,
        p.descripcion,
        p.imagen,
        c.nombre AS categoria,
        p.precio_venta,
        p.stock
    FROM Producto p
    LEFT JOIN Categoria c ON p.id_categoria = c.id_categoria
    WHERE (
            p_busqueda IS NULL
            OR TRIM(p_busqueda) = ''
            OR p.codigo ILIKE '%' || TRIM(p_busqueda) || '%'
            OR p.nombre ILIKE '%' || TRIM(p_busqueda) || '%'
            OR p.descripcion ILIKE '%' || TRIM(p_busqueda) || '%'
            OR c.nombre ILIKE '%' || TRIM(p_busqueda) || '%'
        )
      AND (
            p_id_categoria IS NULL
            OR p.id_categoria = p_id_categoria
        )
      AND (
            p_disponibilidad IS NULL
            OR p_disponibilidad = ''
            OR (
                p_disponibilidad = 'disponible'
                AND p.stock > 5
            )
            OR (
                p_disponibilidad = 'stock_bajo'
                AND p.stock > 0
                AND p.stock <= 5
            )
            OR (
                p_disponibilidad = 'agotado'
                AND p.stock <= 0
            )
        )
    ORDER BY
        CASE
            WHEN p.stock <= 0 THEN 2
            WHEN p.stock <= 5 THEN 1
            ELSE 0
        END,
        p.nombre ASC;
END;
$$;


--
-- Name: buscar_productos_inventario(text, integer, integer, integer, boolean); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.buscar_productos_inventario(p_busqueda text DEFAULT ''::text, p_id_categoria integer DEFAULT NULL::integer, p_id_proveedor integer DEFAULT NULL::integer, p_id_producto integer DEFAULT NULL::integer, p_stock_bajo boolean DEFAULT false) RETURNS TABLE(id_producto integer, codigo character varying, nombre character varying, descripcion text, imagen character varying, categoria character varying, proveedor character varying, precio_compra numeric, precio_venta numeric, stock integer)
    LANGUAGE plpgsql
    AS $$
BEGIN
    RETURN QUERY
    SELECT
        prod.id_producto,
        prod.codigo,
        prod.nombre,
        prod.descripcion,
        prod.imagen,
        cat.nombre AS categoria,
        prov.nombre AS proveedor,
        prod.precio_compra,
        prod.precio_venta,
        prod.stock
    FROM Producto prod
    LEFT JOIN Categoria cat ON prod.id_categoria = cat.id_categoria
    LEFT JOIN Proveedor prov ON prod.id_proveedor = prov.id_proveedor
    WHERE
        (
            p_id_producto IS NULL
            OR prod.id_producto = p_id_producto
        )
        AND (
            COALESCE(TRIM(p_busqueda), '') = ''
            OR prod.codigo ILIKE '%' || TRIM(p_busqueda) || '%'
            OR prod.nombre ILIKE '%' || TRIM(p_busqueda) || '%'
        )
        AND (
            p_id_categoria IS NULL
            OR prod.id_categoria = p_id_categoria
        )
        AND (
            p_id_proveedor IS NULL
            OR prod.id_proveedor = p_id_proveedor
        )
        AND (
            p_stock_bajo = FALSE
            OR prod.stock <= 5
        )
    ORDER BY prod.nombre ASC;
END;
$$;


--
-- Name: buscar_proveedores_filtrados(text); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.buscar_proveedores_filtrados(p_busqueda text DEFAULT NULL::text) RETURNS TABLE(id_proveedor integer, nombre character varying, telefono character varying, email character varying, direccion character varying)
    LANGUAGE plpgsql
    AS $$
BEGIN
    RETURN QUERY
    SELECT
        p.id_proveedor,
        p.nombre,
        p.telefono,
        p.email,
        p.direccion
    FROM Proveedor p
    WHERE (
            p_busqueda IS NULL
            OR TRIM(p_busqueda) = ''
            OR CAST(p.id_proveedor AS TEXT) ILIKE '%' || TRIM(p_busqueda) || '%'
            OR p.nombre ILIKE '%' || TRIM(p_busqueda) || '%'
            OR p.telefono ILIKE '%' || TRIM(p_busqueda) || '%'
            OR p.email ILIKE '%' || TRIM(p_busqueda) || '%'
            OR p.direccion ILIKE '%' || TRIM(p_busqueda) || '%'
        )
    ORDER BY p.nombre ASC;
END;
$$;


--
-- Name: buscar_usuarios_filtrados(text, integer, text); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.buscar_usuarios_filtrados(p_busqueda text DEFAULT NULL::text, p_id_rol integer DEFAULT NULL::integer, p_seccion_filtro text DEFAULT NULL::text) RETURNS TABLE(id_usuario integer, nombre character varying, email character varying, id_rol integer, id_seccion integer, rol character varying, seccion character varying)
    LANGUAGE plpgsql
    AS $_$
BEGIN
    IF p_id_rol IS NOT NULL AND p_id_rol <= 0 THEN
        RAISE EXCEPTION 'ID de rol no válido';
    END IF;

    RETURN QUERY
    SELECT
        u.id_usuario,
        u.nombre,
        u.email,
        u.id_rol,
        u.id_seccion,
        r.nombre AS rol,
        s.nombre AS seccion
    FROM Usuario u
    INNER JOIN Rol r ON u.id_rol = r.id_rol
    LEFT JOIN Seccion s ON u.id_seccion = s.id_seccion
    WHERE u.id_usuario <> 1
      AND (
            p_busqueda IS NULL
            OR TRIM(p_busqueda) = ''
            OR u.nombre ILIKE '%' || TRIM(p_busqueda) || '%'
            OR u.email ILIKE '%' || TRIM(p_busqueda) || '%'
            OR r.nombre ILIKE '%' || TRIM(p_busqueda) || '%'
            OR COALESCE(s.nombre, 'Todas las secciones') ILIKE '%' || TRIM(p_busqueda) || '%'
        )
      AND (
            p_id_rol IS NULL
            OR u.id_rol = p_id_rol
        )
      AND (
            p_seccion_filtro IS NULL
            OR TRIM(p_seccion_filtro) = ''
            OR (
                p_seccion_filtro = 'none'
                AND u.id_seccion IS NULL
            )
            OR (
                p_seccion_filtro ~ '^[0-9]+$'
                AND u.id_seccion = p_seccion_filtro::INT
            )
        )
    ORDER BY u.nombre ASC;
END;
$_$;


--
-- Name: calcular_subtotal_factura(integer); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.calcular_subtotal_factura(p_id_factura integer) RETURNS numeric
    LANGUAGE plpgsql
    AS $$
DECLARE
    v_subtotal NUMERIC(10,2);
BEGIN
    SELECT COALESCE(SUM(total_linea), 0)
    INTO v_subtotal
    FROM DetalleFactura
    WHERE id_factura = p_id_factura;

    RETURN v_subtotal;
END;
$$;


--
-- Name: calcular_total_compra(integer); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.calcular_total_compra(p_id_compra integer) RETURNS numeric
    LANGUAGE plpgsql
    AS $$
DECLARE
    v_total NUMERIC(10,2);
BEGIN
    SELECT COALESCE(SUM(total_linea), 0)
    INTO v_total
    FROM DetalleCompra
    WHERE id_compra = p_id_compra;

    RETURN v_total;
END;
$$;


--
-- Name: crear_proveedor_sistema(character varying, character varying, character varying, character varying); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.crear_proveedor_sistema(p_nombre character varying, p_telefono character varying DEFAULT NULL::character varying, p_email character varying DEFAULT NULL::character varying, p_direccion character varying DEFAULT NULL::character varying) RETURNS boolean
    LANGUAGE plpgsql
    AS $$
BEGIN
    IF p_nombre IS NULL OR TRIM(p_nombre) = '' THEN
        RAISE EXCEPTION 'El nombre del proveedor no puede estar vacío';
    END IF;

    INSERT INTO Proveedor (
        nombre,
        telefono,
        email,
        direccion
    )
    VALUES (
        TRIM(p_nombre),
        NULLIF(TRIM(p_telefono), ''),
        NULLIF(TRIM(p_email), ''),
        NULLIF(TRIM(p_direccion), '')
    );

    RETURN TRUE;
END;
$$;


--
-- Name: crear_usuario_sistema(character varying, character varying, text, integer, integer); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.crear_usuario_sistema(p_nombre character varying, p_email character varying, p_password text, p_id_rol integer, p_id_seccion integer DEFAULT NULL::integer) RETURNS boolean
    LANGUAGE plpgsql
    AS $$
BEGIN
    IF p_nombre IS NULL OR TRIM(p_nombre) = '' THEN
        RAISE EXCEPTION 'El nombre del usuario no puede estar vacío';
    END IF;

    IF p_email IS NULL OR TRIM(p_email) = '' THEN
        RAISE EXCEPTION 'El correo electrónico no puede estar vacío';
    END IF;

    IF p_password IS NULL OR TRIM(p_password) = '' THEN
        RAISE EXCEPTION 'La contraseña no puede estar vacía';
    END IF;

    IF p_id_rol IS NULL OR p_id_rol <= 0 THEN
        RAISE EXCEPTION 'El rol del usuario no es válido';
    END IF;

    INSERT INTO Usuario (
        nombre,
        email,
        password,
        id_rol,
        id_seccion
    )
    VALUES (
        TRIM(p_nombre),
        TRIM(p_email),
        p_password,
        p_id_rol,
        p_id_seccion
    );

    RETURN TRUE;
END;
$$;


--
-- Name: disminuir_stock_producto(integer, integer); Type: PROCEDURE; Schema: public; Owner: -
--

CREATE PROCEDURE public.disminuir_stock_producto(IN p_id_producto integer, IN p_cantidad integer)
    LANGUAGE plpgsql
    AS $$
DECLARE
    v_stock_actual INT;
BEGIN
    IF p_cantidad <= 0 THEN
        RAISE EXCEPTION 'La cantidad a descontar debe ser mayor que cero';
    END IF;

    SELECT stock
    INTO v_stock_actual
    FROM Producto
    WHERE id_producto = p_id_producto;

    IF v_stock_actual IS NULL THEN
        RAISE EXCEPTION 'No existe un producto con el ID %', p_id_producto;
    END IF;

    IF v_stock_actual < p_cantidad THEN
        RAISE EXCEPTION 'Stock insuficiente. Stock actual: %, cantidad solicitada: %',
            v_stock_actual,
            p_cantidad;
    END IF;

    UPDATE Producto
    SET stock = stock - p_cantidad
    WHERE id_producto = p_id_producto;
END;
$$;


--
-- Name: editar_factura_sistema(integer, timestamp without time zone, integer, integer, integer, character varying, character varying, numeric, numeric, jsonb); Type: PROCEDURE; Schema: public; Owner: -
--

CREATE PROCEDURE public.editar_factura_sistema(IN p_id_factura integer, IN p_fecha timestamp without time zone, IN p_id_cliente integer, IN p_id_usuario integer, IN p_id_seccion integer, IN p_tipo_cliente_venta character varying, IN p_nombre_cliente_fugaz character varying, IN p_descuento_global numeric, IN p_iva numeric, IN p_items jsonb)
    LANGUAGE plpgsql
    AS $$
DECLARE
    item JSONB;
    v_id_producto INT;
    v_cantidad INT;
    v_descuento_linea NUMERIC;
    v_precio NUMERIC;
    v_stock INT;
    v_subtotal_linea NUMERIC;
    v_total_linea NUMERIC;
BEGIN
    IF NOT EXISTS (SELECT 1 FROM Factura WHERE id_factura = p_id_factura) THEN
        RAISE EXCEPTION 'La factura no existe.';
    END IF;

    -- 1) Restaurar stock de TODOS los detalles viejos de una sola vez
    UPDATE Producto
    SET stock = stock + df.cantidad
    FROM DetalleFactura df
    WHERE df.id_factura = p_id_factura
      AND df.id_producto = Producto.id_producto;

    -- 2) Eliminar detalles viejos
    DELETE FROM DetalleFactura
    WHERE id_factura = p_id_factura;

    UPDATE Factura
    SET
        fecha = p_fecha,
        id_cliente = p_id_cliente,
        id_usuario = p_id_usuario,
        id_seccion = p_id_seccion,
        tipo_cliente_venta = p_tipo_cliente_venta,
        nombre_cliente_fugaz = p_nombre_cliente_fugaz,
        descuento = p_descuento_global
    WHERE id_factura = p_id_factura;

    FOR item IN
        SELECT jsonb_array_elements(p_items)
    LOOP
        v_id_producto := (item->>'id_producto')::INT;
        v_cantidad := (item->>'cantidad')::INT;
        v_descuento_linea := COALESCE((item->>'descuento_linea')::NUMERIC, 0);

        SELECT precio_venta, stock
        INTO v_precio, v_stock
        FROM Producto
        WHERE id_producto = v_id_producto
        FOR UPDATE;

        IF v_precio IS NULL THEN
            RAISE EXCEPTION 'Uno de los productos seleccionados no existe.';
        END IF;

        IF v_stock < v_cantidad THEN
            RAISE EXCEPTION 'Stock insuficiente para el producto %.', v_id_producto;
        END IF;

        v_subtotal_linea := v_precio * v_cantidad;

        IF v_descuento_linea < 0 THEN
            RAISE EXCEPTION 'El descuento por línea no puede ser negativo.';
        END IF;

        IF v_descuento_linea > v_subtotal_linea THEN
            RAISE EXCEPTION 'El descuento por línea no puede superar el subtotal.';
        END IF;

        v_total_linea := v_subtotal_linea - v_descuento_linea;

        INSERT INTO DetalleFactura (
            id_factura,
            id_producto,
            cantidad,
            precio_unitario,
            descuento_linea,
            total_linea
        )
        VALUES (
            p_id_factura,
            v_id_producto,
            v_cantidad,
            v_precio,
            v_descuento_linea,
            v_total_linea
        );

        UPDATE Producto
        SET stock = stock - v_cantidad
        WHERE id_producto = v_id_producto;
    END LOOP;

    CALL actualizar_totales_factura(p_id_factura, p_descuento_global, p_iva);
END;
$$;


--
-- Name: eliminar_categoria_sistema(integer); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.eliminar_categoria_sistema(p_id_categoria integer) RETURNS boolean
    LANGUAGE plpgsql
    AS $$
BEGIN
    IF p_id_categoria IS NULL OR p_id_categoria <= 0 THEN
        RAISE EXCEPTION 'ID de categoría no válido';
    END IF;

    DELETE FROM detallefactura WHERE id_producto IN (SELECT id_producto FROM Producto WHERE id_categoria = p_id_categoria);
    DELETE FROM detallecompra WHERE id_producto IN (SELECT id_producto FROM Producto WHERE id_categoria = p_id_categoria);
    DELETE FROM Producto WHERE id_categoria = p_id_categoria;
    DELETE FROM Categoria WHERE Categoria.id_categoria = p_id_categoria;

    RETURN FOUND;
END;
$$;


--
-- Name: eliminar_cliente_sistema(integer); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.eliminar_cliente_sistema(p_id_cliente integer) RETURNS boolean
    LANGUAGE plpgsql
    AS $$
BEGIN
    IF p_id_cliente IS NULL OR p_id_cliente <= 0 THEN
        RAISE EXCEPTION 'ID de cliente no válido';
    END IF;

    DELETE FROM Cliente
    WHERE Cliente.id_cliente = p_id_cliente;

    RETURN FOUND;
END;
$$;


--
-- Name: eliminar_factura_sistema(integer); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.eliminar_factura_sistema(p_id_factura integer) RETURNS boolean
    LANGUAGE plpgsql
    AS $$
DECLARE
    v_existe_factura BOOLEAN;
BEGIN
    IF p_id_factura IS NULL OR p_id_factura <= 0 THEN
        RAISE EXCEPTION 'ID de factura no válido';
    END IF;

    SELECT EXISTS (
        SELECT 1
        FROM Factura
        WHERE id_factura = p_id_factura
    )
    INTO v_existe_factura;

    IF NOT v_existe_factura THEN
        RAISE EXCEPTION 'La factura especificada no existe';
    END IF;

    -- 1) Devolver stock de los productos vendidos en la factura
    UPDATE Producto p
    SET stock = p.stock + df.cantidad
    FROM DetalleFactura df
    WHERE df.id_producto = p.id_producto
      AND df.id_factura = p_id_factura;

    -- 2) Eliminar detalles de la factura
    DELETE FROM DetalleFactura
    WHERE id_factura = p_id_factura;

    -- 3) Eliminar factura principal
    DELETE FROM Factura
    WHERE id_factura = p_id_factura;

    RETURN TRUE;
END;
$$;


--
-- Name: eliminar_producto_sistema(integer); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.eliminar_producto_sistema(p_id_producto integer) RETURNS TABLE(filas_afectadas integer)
    LANGUAGE plpgsql
    AS $$
DECLARE
    v_filas_afectadas INT;
BEGIN
    IF p_id_producto IS NULL OR p_id_producto <= 0 THEN
        RAISE EXCEPTION 'Producto no válido';
    END IF;

    DELETE FROM detallefactura
    WHERE id_producto = p_id_producto;

    DELETE FROM detallecompra
    WHERE id_producto = p_id_producto;

    DELETE FROM Producto
    WHERE id_producto = p_id_producto;

    GET DIAGNOSTICS v_filas_afectadas = ROW_COUNT;

    RETURN QUERY
    SELECT v_filas_afectadas;
END;
$$;


--
-- Name: eliminar_proveedor_sistema(integer); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.eliminar_proveedor_sistema(p_id_proveedor integer) RETURNS boolean
    LANGUAGE plpgsql
    AS $$
BEGIN
    IF p_id_proveedor IS NULL OR p_id_proveedor <= 0 THEN
        RAISE EXCEPTION 'ID de proveedor no válido';
    END IF;

    DELETE FROM detallecompra WHERE id_compra IN (SELECT id_compra FROM Compra WHERE id_proveedor = p_id_proveedor);
    DELETE FROM detallefactura WHERE id_producto IN (SELECT id_producto FROM Producto WHERE id_proveedor = p_id_proveedor);
    DELETE FROM Compra WHERE id_proveedor = p_id_proveedor;
    DELETE FROM Producto WHERE id_proveedor = p_id_proveedor;
    DELETE FROM Proveedor WHERE Proveedor.id_proveedor = p_id_proveedor;

    RETURN FOUND;
END;
$$;


--
-- Name: eliminar_usuario_sistema(integer, integer); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.eliminar_usuario_sistema(p_id_usuario integer, p_id_usuario_actual integer) RETURNS TABLE(filas_afectadas integer)
    LANGUAGE plpgsql
    AS $$
DECLARE
    v_filas_afectadas INT;
BEGIN
    IF p_id_usuario IS NULL OR p_id_usuario <= 0 THEN
        RAISE EXCEPTION 'Trabajador no válido';
    END IF;

    IF p_id_usuario = 1 THEN
        RAISE EXCEPTION 'No se puede eliminar la cuenta del jefe';
    END IF;

    IF p_id_usuario_actual IS NOT NULL AND p_id_usuario = p_id_usuario_actual THEN
        RAISE EXCEPTION 'No puede eliminar su propia cuenta';
    END IF;

    DELETE FROM Usuario
    WHERE id_usuario = p_id_usuario;

    GET DIAGNOSTICS v_filas_afectadas = ROW_COUNT;

    RETURN QUERY
    SELECT v_filas_afectadas;
END;
$$;


--
-- Name: fn_auditar_delete_generico(); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.fn_auditar_delete_generico() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
DECLARE
    registro_json JSONB;
    registro_id TEXT;
BEGIN
    registro_json := row_to_json(OLD)::jsonb;

    registro_id := COALESCE(
        registro_json ->> 'id_cliente',
        registro_json ->> 'id_producto',
        registro_json ->> 'id_proveedor',
        registro_json ->> 'id_factura',
        registro_json ->> 'id_compra',
        registro_json ->> 'id_usuario',
        registro_json ->> 'id_categoria'
    );

    INSERT INTO auditoria (
        tabla_afectada,
        accion,
        registro_id,
        datos_anteriores,
        fecha
    )
    VALUES (
        TG_TABLE_NAME,
        'DELETE',
        registro_id,
        registro_json,
        NOW()
    );

    RETURN OLD;
END;
$$;


--
-- Name: listar_categorias_catalogo(); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.listar_categorias_catalogo() RETURNS TABLE(id_categoria integer, nombre character varying)
    LANGUAGE plpgsql
    AS $$
BEGIN
    RETURN QUERY
    SELECT
        c.id_categoria,
        c.nombre
    FROM Categoria c
    ORDER BY c.nombre;
END;
$$;


--
-- Name: listar_categorias_form_producto(); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.listar_categorias_form_producto() RETURNS TABLE(id_categoria integer, nombre character varying)
    LANGUAGE plpgsql
    AS $$
BEGIN
    RETURN QUERY
    SELECT
        c.id_categoria,
        c.nombre
    FROM Categoria c
    ORDER BY c.nombre ASC;
END;
$$;


--
-- Name: listar_categorias_ordenadas(); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.listar_categorias_ordenadas() RETURNS TABLE(id_categoria integer, nombre character varying)
    LANGUAGE plpgsql
    AS $$
BEGIN
    RETURN QUERY
    SELECT
        c.id_categoria,
        c.nombre
    FROM Categoria c
    ORDER BY c.nombre;
END;
$$;


--
-- Name: listar_categorias_producto(); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.listar_categorias_producto() RETURNS TABLE(id_categoria integer, nombre character varying)
    LANGUAGE plpgsql
    AS $$
BEGIN
    RETURN QUERY
    SELECT
        c.id_categoria,
        c.nombre
    FROM Categoria c
    ORDER BY c.nombre;
END;
$$;


--
-- Name: listar_clientes_habituales(); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.listar_clientes_habituales() RETURNS TABLE(id_cliente integer, nombre text, telefono text, identificacion text, tipo_cliente text)
    LANGUAGE plpgsql
    AS $$
BEGIN
    RETURN QUERY
    SELECT
        c.id_cliente,
        TRIM(c.nombres || ' ' || c.apellidos)::TEXT AS nombre,
        COALESCE(c.telefono, '')::TEXT AS telefono,
        COALESCE(c.identificacion, '')::TEXT AS identificacion,
        c.tipo_cliente::TEXT AS tipo_cliente
    FROM cliente c
    ORDER BY c.nombres ASC, c.apellidos ASC;
END;
$$;


--
-- Name: listar_productos_para_factura(); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.listar_productos_para_factura() RETURNS TABLE(id_producto integer, codigo character varying, nombre character varying, precio_venta numeric, stock integer)
    LANGUAGE plpgsql
    AS $$
BEGIN
    RETURN QUERY
    SELECT
        p.id_producto,
        p.codigo,
        p.nombre,
        p.precio_venta,
        p.stock
    FROM Producto p
    ORDER BY p.nombre;
END;
$$;


--
-- Name: listar_proveedores_form_producto(); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.listar_proveedores_form_producto() RETURNS TABLE(id_proveedor integer, nombre character varying)
    LANGUAGE plpgsql
    AS $$
BEGIN
    RETURN QUERY
    SELECT
        p.id_proveedor,
        p.nombre
    FROM Proveedor p
    ORDER BY p.nombre ASC;
END;
$$;


--
-- Name: listar_proveedores_ordenados(); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.listar_proveedores_ordenados() RETURNS TABLE(id_proveedor integer, nombre character varying)
    LANGUAGE plpgsql
    AS $$
BEGIN
    RETURN QUERY
    SELECT
        p.id_proveedor,
        p.nombre
    FROM Proveedor p
    ORDER BY p.nombre;
END;
$$;


--
-- Name: listar_proveedores_para_compras(); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.listar_proveedores_para_compras() RETURNS TABLE(id_proveedor integer, nombre character varying)
    LANGUAGE plpgsql
    AS $$
BEGIN
    RETURN QUERY
    SELECT
        p.id_proveedor,
        p.nombre
    FROM Proveedor p
    ORDER BY p.nombre;
END;
$$;


--
-- Name: listar_proveedores_producto(); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.listar_proveedores_producto() RETURNS TABLE(id_proveedor integer, nombre character varying)
    LANGUAGE plpgsql
    AS $$
BEGIN
    RETURN QUERY
    SELECT
        p.id_proveedor,
        p.nombre
    FROM Proveedor p
    ORDER BY p.nombre;
END;
$$;


--
-- Name: listar_roles_ordenados(); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.listar_roles_ordenados() RETURNS TABLE(id_rol integer, nombre character varying)
    LANGUAGE plpgsql
    AS $$
BEGIN
    RETURN QUERY
    SELECT
        r.id_rol,
        r.nombre
    FROM Rol r
    ORDER BY r.nombre;
END;
$$;


--
-- Name: listar_secciones_ordenadas(); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.listar_secciones_ordenadas() RETURNS TABLE(id_seccion integer, nombre character varying)
    LANGUAGE plpgsql
    AS $$
BEGIN
    RETURN QUERY
    SELECT
        s.id_seccion,
        s.nombre
    FROM Seccion s
    ORDER BY s.nombre;
END;
$$;


--
-- Name: listar_usuarios_ordenados(); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.listar_usuarios_ordenados() RETURNS TABLE(id_usuario integer, nombre character varying)
    LANGUAGE plpgsql
    AS $$
BEGIN
    RETURN QUERY
    SELECT
        u.id_usuario,
        u.nombre
    FROM Usuario u
    ORDER BY u.nombre;
END;
$$;


--
-- Name: listar_usuarios_para_compras(); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.listar_usuarios_para_compras() RETURNS TABLE(id_usuario integer, nombre character varying)
    LANGUAGE plpgsql
    AS $$
BEGIN
    RETURN QUERY
    SELECT
        u.id_usuario,
        u.nombre
    FROM Usuario u
    ORDER BY u.nombre;
END;
$$;


--
-- Name: obtener_categoria_por_id(integer); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.obtener_categoria_por_id(p_id_categoria integer) RETURNS TABLE(id_categoria integer, nombre character varying)
    LANGUAGE plpgsql
    AS $$
BEGIN
    IF p_id_categoria IS NULL OR p_id_categoria <= 0 THEN
        RAISE EXCEPTION 'ID de categoría no válido';
    END IF;

    RETURN QUERY
    SELECT
        c.id_categoria,
        c.nombre
    FROM Categoria c
    WHERE c.id_categoria = p_id_categoria;
END;
$$;


--
-- Name: obtener_cliente_edicion_por_id(integer); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.obtener_cliente_edicion_por_id(p_id_cliente integer) RETURNS TABLE(id_cliente integer, nombres character varying, apellidos character varying, telefono character varying, direccion character varying, identificacion character varying, tipo_cliente character varying)
    LANGUAGE plpgsql
    AS $$
BEGIN
    IF p_id_cliente IS NULL OR p_id_cliente <= 0 THEN
        RAISE EXCEPTION 'ID de cliente no válido';
    END IF;

    RETURN QUERY
    SELECT
        c.id_cliente,
        c.nombres,
        c.apellidos,
        c.telefono,
        c.direccion,
        c.identificacion,
        c.tipo_cliente
    FROM Cliente c
    WHERE c.id_cliente = p_id_cliente;
END;
$$;


--
-- Name: obtener_cliente_factura_edicion(integer); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.obtener_cliente_factura_edicion(p_id_cliente integer) RETURNS TABLE(id_cliente integer, nombre text, telefono text, identificacion text, tipo_cliente text)
    LANGUAGE plpgsql
    AS $$
BEGIN
    RETURN QUERY
    SELECT
        c.id_cliente,
        TRIM(c.nombres || ' ' || c.apellidos)::TEXT AS nombre,
        COALESCE(c.telefono, '')::TEXT AS telefono,
        COALESCE(c.identificacion, '')::TEXT AS identificacion,
        c.tipo_cliente::TEXT AS tipo_cliente
    FROM cliente c
    WHERE c.id_cliente = p_id_cliente
    LIMIT 1;
END;
$$;


--
-- Name: obtener_cliente_por_id(integer); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.obtener_cliente_por_id(p_id_cliente integer) RETURNS TABLE(id_cliente integer, nombres character varying, apellidos character varying, telefono character varying, direccion character varying, identificacion character varying, tipo_cliente character varying, fecha_registro date)
    LANGUAGE plpgsql
    AS $$
BEGIN
    IF p_id_cliente IS NULL OR p_id_cliente <= 0 THEN
        RAISE EXCEPTION 'ID de cliente no válido';
    END IF;

    RETURN QUERY
    SELECT
        c.id_cliente,
        c.nombres,
        c.apellidos,
        c.telefono,
        c.direccion,
        c.identificacion,
        c.tipo_cliente,
        c.fecha_registro
    FROM Cliente c
    WHERE c.id_cliente = p_id_cliente;
END;
$$;


--
-- Name: obtener_clientes_recientes_dashboard(integer); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.obtener_clientes_recientes_dashboard(p_limite integer DEFAULT 5) RETURNS TABLE(id_cliente integer, nombre text, telefono character varying, fecha_registro date)
    LANGUAGE plpgsql
    AS $$
BEGIN
    IF p_limite IS NULL OR p_limite <= 0 THEN
        RAISE EXCEPTION 'El límite debe ser mayor que cero';
    END IF;

    RETURN QUERY
    SELECT
        c.id_cliente,
        CONCAT(c.nombres, ' ', c.apellidos) AS nombre,
        c.telefono,
        c.fecha_registro
    FROM Cliente c
    ORDER BY c.fecha_registro DESC, c.id_cliente DESC
    LIMIT p_limite;
END;
$$;


--
-- Name: obtener_clientes_reporte(timestamp without time zone, timestamp without time zone); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.obtener_clientes_reporte(p_fecha_desde timestamp without time zone DEFAULT NULL::timestamp without time zone, p_fecha_hasta timestamp without time zone DEFAULT NULL::timestamp without time zone) RETURNS TABLE(id_cliente integer, cliente text, telefono character varying, tipo_cliente character varying, cantidad_facturas bigint, total_comprado numeric)
    LANGUAGE plpgsql
    AS $$
BEGIN
    RETURN QUERY
    SELECT
        c.id_cliente,
        c.nombres || ' ' || c.apellidos AS cliente,
        c.telefono,
        c.tipo_cliente,
        COUNT(f.id_factura) AS cantidad_facturas,
        COALESCE(SUM(f.total), 0) AS total_comprado
    FROM Cliente c
    LEFT JOIN Factura f ON f.id_cliente = c.id_cliente
    WHERE (p_fecha_desde IS NULL OR f.fecha IS NULL OR f.fecha >= p_fecha_desde)
      AND (p_fecha_hasta IS NULL OR f.fecha IS NULL OR f.fecha <= p_fecha_hasta)
    GROUP BY c.id_cliente, c.nombres, c.apellidos, c.telefono, c.tipo_cliente
    ORDER BY total_comprado DESC, cantidad_facturas DESC, cliente ASC
    LIMIT 50;
END;
$$;


--
-- Name: obtener_compra_por_id(integer); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.obtener_compra_por_id(p_id_compra integer) RETURNS TABLE(id_compra integer, fecha timestamp without time zone, total numeric, proveedor character varying, proveedor_telefono character varying, proveedor_email character varying, usuario character varying)
    LANGUAGE plpgsql
    AS $$
BEGIN
    IF p_id_compra IS NULL OR p_id_compra <= 0 THEN
        RAISE EXCEPTION 'ID de compra no válido';
    END IF;

    RETURN QUERY
    SELECT
        c.id_compra,
        c.fecha,
        c.total,
        p.nombre AS proveedor,
        p.telefono AS proveedor_telefono,
        p.email AS proveedor_email,
        u.nombre AS usuario
    FROM Compra c
    INNER JOIN Proveedor p ON c.id_proveedor = p.id_proveedor
    INNER JOIN Usuario u ON c.id_usuario = u.id_usuario
    WHERE c.id_compra = p_id_compra;
END;
$$;


--
-- Name: obtener_detalles_compra(integer); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.obtener_detalles_compra(p_id_compra integer) RETURNS TABLE(id_detalle integer, cantidad integer, costo_unitario numeric, total_linea numeric, producto_codigo character varying, producto_nombre character varying)
    LANGUAGE plpgsql
    AS $$
BEGIN
    IF p_id_compra IS NULL OR p_id_compra <= 0 THEN
        RAISE EXCEPTION 'ID de compra no válido';
    END IF;

    RETURN QUERY
    SELECT
        dc.id_detalle,
        dc.cantidad,
        dc.costo_unitario,
        dc.total_linea,
        pr.codigo AS producto_codigo,
        pr.nombre AS producto_nombre
    FROM DetalleCompra dc
    INNER JOIN Producto pr ON dc.id_producto = pr.id_producto
    WHERE dc.id_compra = p_id_compra
    ORDER BY dc.id_detalle;
END;
$$;


--
-- Name: obtener_detalles_factura_edicion(integer); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.obtener_detalles_factura_edicion(p_id_factura integer) RETURNS TABLE(id_detalle integer, id_producto integer, codigo character varying, nombre character varying, cantidad integer, precio_unitario numeric, descuento_linea numeric, total_linea numeric)
    LANGUAGE plpgsql
    AS $$
BEGIN
    RETURN QUERY
    SELECT
        df.id_detalle,
        df.id_producto,
        p.codigo,
        p.nombre,
        df.cantidad,
        df.precio_unitario,
        df.descuento_linea,
        df.total_linea
    FROM DetalleFactura df
    INNER JOIN Producto p ON p.id_producto = df.id_producto
    WHERE df.id_factura = p_id_factura
    ORDER BY df.id_detalle ASC;
END;
$$;


--
-- Name: obtener_factura_detalle_por_id(integer); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.obtener_factura_detalle_por_id(p_id_factura integer) RETURNS TABLE(id_factura integer, fecha timestamp without time zone, subtotal numeric, descuento numeric, impuesto numeric, total numeric, cliente text, telefono character varying, direccion character varying, usuario character varying, seccion character varying)
    LANGUAGE plpgsql
    AS $$
BEGIN
    IF p_id_factura IS NULL OR p_id_factura <= 0 THEN
        RAISE EXCEPTION 'ID de factura no válido';
    END IF;

    RETURN QUERY
    SELECT
        f.id_factura,
        f.fecha,
        f.subtotal,
        f.descuento,
        f.impuesto,
        f.total,
        c.nombres || ' ' || c.apellidos AS cliente,
        c.telefono,
        c.direccion,
        u.nombre AS usuario,
        s.nombre AS seccion
    FROM Factura f
    JOIN Cliente c ON f.id_cliente = c.id_cliente
    JOIN Usuario u ON f.id_usuario = u.id_usuario
    JOIN Seccion s ON f.id_seccion = s.id_seccion
    WHERE f.id_factura = p_id_factura;
END;
$$;


--
-- Name: obtener_factura_para_impresion(integer); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.obtener_factura_para_impresion(p_id_factura integer) RETURNS TABLE(id_factura integer, fecha timestamp without time zone, id_cliente integer, id_usuario integer, id_seccion integer, subtotal numeric, descuento numeric, impuesto numeric, total numeric, tipo_cliente_venta character varying, nombre_cliente_fugaz character varying, cli_nombres character varying, cli_apellidos character varying, cli_telefono character varying, cli_direccion character varying, cli_identificacion character varying, usuario_nombre character varying, seccion_nombre character varying)
    LANGUAGE plpgsql
    AS $$
BEGIN
    IF p_id_factura IS NULL OR p_id_factura <= 0 THEN
        RAISE EXCEPTION 'ID de factura no válido';
    END IF;

    RETURN QUERY
    SELECT
        f.id_factura,
        f.fecha,
        f.id_cliente,
        f.id_usuario,
        f.id_seccion,
        f.subtotal,
        f.descuento,
        f.impuesto,
        f.total,
        f.tipo_cliente_venta,
        f.nombre_cliente_fugaz,
        c.nombres AS cli_nombres,
        c.apellidos AS cli_apellidos,
        c.telefono AS cli_telefono,
        c.direccion AS cli_direccion,
        c.identificacion AS cli_identificacion,
        u.nombre AS usuario_nombre,
        s.nombre AS seccion_nombre
    FROM Factura f
    JOIN Cliente c ON f.id_cliente = c.id_cliente
    JOIN Usuario u ON f.id_usuario = u.id_usuario
    JOIN Seccion s ON f.id_seccion = s.id_seccion
    WHERE f.id_factura = p_id_factura;
END;
$$;


--
-- Name: obtener_facturas_recientes_dashboard(integer); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.obtener_facturas_recientes_dashboard(p_limite integer DEFAULT 5) RETURNS TABLE(id_factura integer, fecha timestamp without time zone, total numeric)
    LANGUAGE plpgsql
    AS $$
BEGIN
    IF p_limite IS NULL OR p_limite <= 0 THEN
        RAISE EXCEPTION 'El límite debe ser mayor que cero';
    END IF;

    RETURN QUERY
    SELECT
        f.id_factura,
        f.fecha,
        f.total
    FROM Factura f
    ORDER BY f.fecha DESC, f.id_factura DESC
    LIMIT p_limite;
END;
$$;


--
-- Name: obtener_id_cliente_fugaz(); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.obtener_id_cliente_fugaz() RETURNS integer
    LANGUAGE plpgsql
    AS $$
DECLARE
    v_id_cliente INT;
BEGIN
    SELECT c.id_cliente
    INTO v_id_cliente
    FROM Cliente c
    WHERE c.identificacion = 'FUGAZ'
    LIMIT 1;

    RETURN COALESCE(v_id_cliente, 0);
END;
$$;


--
-- Name: obtener_lineas_detalle_factura(integer); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.obtener_lineas_detalle_factura(p_id_factura integer) RETURNS TABLE(id_detalle integer, codigo character varying, nombre character varying, cantidad integer, precio_unitario numeric, descuento_linea numeric, total_linea numeric)
    LANGUAGE plpgsql
    AS $$
BEGIN
    IF p_id_factura IS NULL OR p_id_factura <= 0 THEN
        RAISE EXCEPTION 'ID de factura no válido';
    END IF;

    RETURN QUERY
    SELECT
        df.id_detalle,
        p.codigo,
        p.nombre,
        df.cantidad,
        df.precio_unitario,
        df.descuento_linea,
        df.total_linea
    FROM DetalleFactura df
    JOIN Producto p ON df.id_producto = p.id_producto
    WHERE df.id_factura = p_id_factura
    ORDER BY df.id_detalle ASC;
END;
$$;


--
-- Name: obtener_lineas_factura_para_impresion(integer); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.obtener_lineas_factura_para_impresion(p_id_factura integer) RETURNS TABLE(id_detalle integer, cantidad integer, precio_unitario numeric, descuento_linea numeric, total_linea numeric, producto_nombre character varying, producto_codigo character varying)
    LANGUAGE plpgsql
    AS $$
BEGIN
    IF p_id_factura IS NULL OR p_id_factura <= 0 THEN
        RAISE EXCEPTION 'ID de factura no válido';
    END IF;

    RETURN QUERY
    SELECT
        df.id_detalle,
        df.cantidad,
        df.precio_unitario,
        df.descuento_linea,
        df.total_linea,
        p.nombre AS producto_nombre,
        p.codigo AS producto_codigo
    FROM DetalleFactura df
    JOIN Producto p ON df.id_producto = p.id_producto
    WHERE df.id_factura = p_id_factura
    ORDER BY df.id_detalle ASC;
END;
$$;


--
-- Name: obtener_metricas_dashboard(); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.obtener_metricas_dashboard() RETURNS TABLE(total_clientes bigint, total_productos bigint, total_facturas bigint, total_ventas numeric, ventas_hoy numeric, stock_bajo bigint)
    LANGUAGE plpgsql
    AS $$
BEGIN
    RETURN QUERY
    SELECT
        (SELECT COUNT(*) FROM Cliente) AS total_clientes,
        (SELECT COUNT(*) FROM Producto) AS total_productos,
        (SELECT COUNT(*) FROM Factura) AS total_facturas,
        (SELECT COALESCE(SUM(total), 0) FROM Factura) AS total_ventas,
        (SELECT COALESCE(SUM(total), 0) FROM Factura WHERE DATE(fecha) = CURRENT_DATE) AS ventas_hoy,
        (SELECT COUNT(*) FROM Producto WHERE stock <= 5) AS stock_bajo;
END;
$$;


--
-- Name: obtener_producto_edicion_por_id(integer); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.obtener_producto_edicion_por_id(p_id_producto integer) RETURNS TABLE(id_producto integer, codigo character varying, nombre character varying, descripcion text, imagen character varying, id_categoria integer, id_proveedor integer, precio_compra numeric, precio_venta numeric, stock integer)
    LANGUAGE plpgsql
    AS $$
BEGIN
    IF p_id_producto IS NULL OR p_id_producto <= 0 THEN
        RAISE EXCEPTION 'ID de producto no válido';
    END IF;

    RETURN QUERY
    SELECT
        p.id_producto,
        p.codigo,
        p.nombre,
        p.descripcion,
        p.imagen,
        p.id_categoria,
        p.id_proveedor,
        p.precio_compra,
        p.precio_venta,
        p.stock
    FROM Producto p
    WHERE p.id_producto = p_id_producto;
END;
$$;


--
-- Name: obtener_producto_imagen(integer); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.obtener_producto_imagen(p_id_producto integer) RETURNS TABLE(id_producto integer, codigo character varying, nombre character varying, descripcion text, imagen character varying, precio_venta numeric, stock integer)
    LANGUAGE plpgsql
    AS $$
BEGIN
    IF p_id_producto IS NULL OR p_id_producto <= 0 THEN
        RAISE EXCEPTION 'ID de producto no válido';
    END IF;

    RETURN QUERY
    SELECT
        p.id_producto,
        p.codigo,
        p.nombre,
        p.descripcion,
        p.imagen,
        p.precio_venta,
        p.stock
    FROM Producto p
    WHERE p.id_producto = p_id_producto;
END;
$$;


--
-- Name: obtener_productos_factura_por_ids(integer[]); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.obtener_productos_factura_por_ids(p_ids_productos integer[]) RETURNS TABLE(id_producto integer, precio_venta numeric, stock integer, nombre character varying)
    LANGUAGE plpgsql
    AS $$
BEGIN
    IF p_ids_productos IS NULL OR ARRAY_LENGTH(p_ids_productos, 1) IS NULL THEN
        RAISE EXCEPTION 'Debe seleccionar al menos un producto';
    END IF;

    RETURN QUERY
    SELECT
        p.id_producto,
        p.precio_venta,
        p.stock,
        p.nombre
    FROM Producto p
    WHERE p.id_producto = ANY(p_ids_productos);
END;
$$;


--
-- Name: obtener_productos_mas_vendidos_dashboard(integer); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.obtener_productos_mas_vendidos_dashboard(p_limite integer DEFAULT 5) RETURNS TABLE(id_producto integer, producto character varying, cantidad_vendida bigint)
    LANGUAGE plpgsql
    AS $$
BEGIN
    IF p_limite IS NULL OR p_limite <= 0 THEN
        RAISE EXCEPTION 'El límite debe ser mayor que cero';
    END IF;

    RETURN QUERY
    SELECT
        p.id_producto,
        p.nombre AS producto,
        COALESCE(SUM(df.cantidad), 0)::BIGINT AS cantidad_vendida
    FROM DetalleFactura df
    INNER JOIN Producto p ON p.id_producto = df.id_producto
    GROUP BY p.id_producto, p.nombre
    ORDER BY cantidad_vendida DESC
    LIMIT p_limite;
END;
$$;


--
-- Name: obtener_productos_mas_vendidos_reportes(timestamp without time zone, timestamp without time zone); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.obtener_productos_mas_vendidos_reportes(p_fecha_desde timestamp without time zone DEFAULT NULL::timestamp without time zone, p_fecha_hasta timestamp without time zone DEFAULT NULL::timestamp without time zone) RETURNS TABLE(id_producto integer, producto character varying, codigo character varying, cantidad_vendida bigint, total_vendido numeric)
    LANGUAGE plpgsql
    AS $$
BEGIN
    RETURN QUERY
    SELECT
        p.id_producto,
        p.nombre AS producto,
        p.codigo,
        COALESCE(SUM(df.cantidad), 0)::BIGINT AS cantidad_vendida,
        COALESCE(SUM(df.total_linea), 0) AS total_vendido
    FROM DetalleFactura df
    INNER JOIN Factura f ON f.id_factura = df.id_factura
    INNER JOIN Producto p ON p.id_producto = df.id_producto
    WHERE (p_fecha_desde IS NULL OR f.fecha >= p_fecha_desde)
      AND (p_fecha_hasta IS NULL OR f.fecha <= p_fecha_hasta)
    GROUP BY p.id_producto, p.nombre, p.codigo
    ORDER BY cantidad_vendida DESC, total_vendido DESC
    LIMIT 10;
END;
$$;


--
-- Name: obtener_productos_reporte(timestamp without time zone, timestamp without time zone); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.obtener_productos_reporte(p_fecha_desde timestamp without time zone DEFAULT NULL::timestamp without time zone, p_fecha_hasta timestamp without time zone DEFAULT NULL::timestamp without time zone) RETURNS TABLE(id_producto integer, codigo character varying, nombre character varying, stock integer, cantidad_vendida bigint, total_vendido numeric)
    LANGUAGE plpgsql
    AS $$
BEGIN
    RETURN QUERY
    SELECT
        p.id_producto,
        p.codigo,
        p.nombre,
        p.stock,
        COALESCE(SUM(df.cantidad), 0)::BIGINT AS cantidad_vendida,
        COALESCE(SUM(df.total_linea), 0) AS total_vendido
    FROM Producto p
    LEFT JOIN DetalleFactura df ON df.id_producto = p.id_producto
    LEFT JOIN Factura f ON f.id_factura = df.id_factura
    WHERE (p_fecha_desde IS NULL OR f.fecha IS NULL OR f.fecha >= p_fecha_desde)
      AND (p_fecha_hasta IS NULL OR f.fecha IS NULL OR f.fecha <= p_fecha_hasta)
    GROUP BY p.id_producto, p.codigo, p.nombre, p.stock
    ORDER BY cantidad_vendida DESC, total_vendido DESC, p.nombre ASC
    LIMIT 50;
END;
$$;


--
-- Name: obtener_proveedor_por_id(integer); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.obtener_proveedor_por_id(p_id_proveedor integer) RETURNS TABLE(id_proveedor integer, nombre character varying, telefono character varying, email character varying, direccion character varying)
    LANGUAGE plpgsql
    AS $$
BEGIN
    IF p_id_proveedor IS NULL OR p_id_proveedor <= 0 THEN
        RAISE EXCEPTION 'ID de proveedor no válido';
    END IF;

    RETURN QUERY
    SELECT
        p.id_proveedor,
        p.nombre,
        p.telefono,
        p.email,
        p.direccion
    FROM Proveedor p
    WHERE p.id_proveedor = p_id_proveedor;
END;
$$;


--
-- Name: obtener_resumen_cliente(integer); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.obtener_resumen_cliente(p_id_cliente integer) RETURNS TABLE(total_facturas bigint, total_comprado numeric, promedio_compra numeric)
    LANGUAGE plpgsql
    AS $$
BEGIN
    IF p_id_cliente IS NULL OR p_id_cliente <= 0 THEN
        RAISE EXCEPTION 'ID de cliente no válido';
    END IF;

    RETURN QUERY
    SELECT
        COUNT(*) AS total_facturas,
        COALESCE(SUM(f.total), 0) AS total_comprado,
        COALESCE(AVG(f.total), 0) AS promedio_compra
    FROM Factura f
    WHERE f.id_cliente = p_id_cliente;
END;
$$;


--
-- Name: obtener_seccion_por_id(integer); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.obtener_seccion_por_id(p_id_seccion integer) RETURNS TABLE(id_seccion integer, nombre character varying)
    LANGUAGE plpgsql
    AS $$
BEGIN
    IF p_id_seccion IS NULL OR p_id_seccion <= 0 THEN
        RAISE EXCEPTION 'ID de sección no válido';
    END IF;

    RETURN QUERY
    SELECT
        s.id_seccion,
        s.nombre
    FROM Seccion s
    WHERE s.id_seccion = p_id_seccion;
END;
$$;


--
-- Name: obtener_seccion_por_nombre(character varying); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.obtener_seccion_por_nombre(p_nombre character varying) RETURNS TABLE(id_seccion integer, nombre character varying)
    LANGUAGE plpgsql
    AS $$
BEGIN
    IF p_nombre IS NULL OR TRIM(p_nombre) = '' THEN
        RAISE EXCEPTION 'El nombre de la sección no puede estar vacío';
    END IF;

    RETURN QUERY
    SELECT
        s.id_seccion,
        s.nombre
    FROM Seccion s
    WHERE s.nombre = TRIM(p_nombre)
    ORDER BY s.nombre;
END;
$$;


--
-- Name: obtener_stock_bajo_reportes(); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.obtener_stock_bajo_reportes() RETURNS integer
    LANGUAGE plpgsql
    AS $$
DECLARE
    v_total INT;
BEGIN
    SELECT COUNT(*)
    INTO v_total
    FROM Producto
    WHERE stock <= 5;

    RETURN v_total;
END;
$$;


--
-- Name: obtener_total_clientes_reportes(); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.obtener_total_clientes_reportes() RETURNS integer
    LANGUAGE plpgsql
    AS $$
DECLARE
    v_total INT;
BEGIN
    SELECT COUNT(*)
    INTO v_total
    FROM Cliente;

    RETURN v_total;
END;
$$;


--
-- Name: obtener_total_facturas_reportes(timestamp without time zone, timestamp without time zone); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.obtener_total_facturas_reportes(p_fecha_desde timestamp without time zone DEFAULT NULL::timestamp without time zone, p_fecha_hasta timestamp without time zone DEFAULT NULL::timestamp without time zone) RETURNS integer
    LANGUAGE plpgsql
    AS $$
DECLARE
    v_total INT;
BEGIN
    SELECT COUNT(*)
    INTO v_total
    FROM Factura f
    WHERE (p_fecha_desde IS NULL OR f.fecha >= p_fecha_desde)
      AND (p_fecha_hasta IS NULL OR f.fecha <= p_fecha_hasta);

    RETURN v_total;
END;
$$;


--
-- Name: obtener_total_ventas_reportes(timestamp without time zone, timestamp without time zone); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.obtener_total_ventas_reportes(p_fecha_desde timestamp without time zone DEFAULT NULL::timestamp without time zone, p_fecha_hasta timestamp without time zone DEFAULT NULL::timestamp without time zone) RETURNS numeric
    LANGUAGE plpgsql
    AS $$
DECLARE
    v_total NUMERIC;
BEGIN
    SELECT COALESCE(SUM(f.total), 0)
    INTO v_total
    FROM Factura f
    WHERE (p_fecha_desde IS NULL OR f.fecha >= p_fecha_desde)
      AND (p_fecha_hasta IS NULL OR f.fecha <= p_fecha_hasta);

    RETURN v_total;
END;
$$;


--
-- Name: obtener_ultimas_facturas_cliente(integer, integer); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.obtener_ultimas_facturas_cliente(p_id_cliente integer, p_limite integer DEFAULT 10) RETURNS TABLE(id_factura integer, fecha timestamp without time zone, subtotal numeric, descuento numeric, impuesto numeric, total numeric)
    LANGUAGE plpgsql
    AS $$
BEGIN
    IF p_id_cliente IS NULL OR p_id_cliente <= 0 THEN
        RAISE EXCEPTION 'ID de cliente no válido';
    END IF;

    IF p_limite IS NULL OR p_limite <= 0 THEN
        RAISE EXCEPTION 'El límite de facturas debe ser mayor que cero';
    END IF;

    RETURN QUERY
    SELECT
        f.id_factura,
        f.fecha,
        f.subtotal,
        f.descuento,
        f.impuesto,
        f.total
    FROM Factura f
    WHERE f.id_cliente = p_id_cliente
    ORDER BY f.fecha DESC, f.id_factura DESC
    LIMIT p_limite;
END;
$$;


--
-- Name: obtener_ultimos_productos_vendidos_dashboard(integer); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.obtener_ultimos_productos_vendidos_dashboard(p_limite integer DEFAULT 6) RETURNS TABLE(id_factura integer, id_producto integer, nombre character varying, cantidad integer, subtotal numeric, fecha timestamp without time zone)
    LANGUAGE plpgsql
    AS $$
BEGIN
    IF p_limite IS NULL OR p_limite <= 0 THEN
        RAISE EXCEPTION 'El límite debe ser mayor que cero';
    END IF;

    RETURN QUERY
    SELECT
        f.id_factura,
        p.id_producto,
        p.nombre,
        df.cantidad,
        df.total_linea AS subtotal,
        f.fecha
    FROM DetalleFactura df
    INNER JOIN Producto p ON p.id_producto = df.id_producto
    INNER JOIN Factura f ON f.id_factura = df.id_factura
    ORDER BY f.fecha DESC, f.id_factura DESC
    LIMIT p_limite;
END;
$$;


--
-- Name: obtener_usuario_configurar_cuenta(integer); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.obtener_usuario_configurar_cuenta(p_id_usuario integer) RETURNS TABLE(id_usuario integer, nombre character varying, email character varying, password text, id_rol integer, id_seccion integer, rol_nombre character varying, seccion_nombre character varying)
    LANGUAGE plpgsql
    AS $$
BEGIN
    IF p_id_usuario IS NULL OR p_id_usuario <= 0 THEN
        RAISE EXCEPTION 'ID de usuario no válido';
    END IF;

    RETURN QUERY
    SELECT
        u.id_usuario,
        u.nombre,
        u.email,
        u.password,
        u.id_rol,
        u.id_seccion,
        r.nombre AS rol_nombre,
        s.nombre AS seccion_nombre
    FROM Usuario u
    INNER JOIN Rol r ON r.id_rol = u.id_rol
    LEFT JOIN Seccion s ON s.id_seccion = u.id_seccion
    WHERE u.id_usuario = p_id_usuario;
END;
$$;


--
-- Name: obtener_usuario_edicion_por_id(integer); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.obtener_usuario_edicion_por_id(p_id_usuario integer) RETURNS TABLE(id_usuario integer, nombre character varying, email character varying, id_rol integer, id_seccion integer)
    LANGUAGE plpgsql
    AS $$
BEGIN
    IF p_id_usuario IS NULL OR p_id_usuario <= 0 THEN
        RAISE EXCEPTION 'ID de usuario no válido';
    END IF;

    RETURN QUERY
    SELECT
        u.id_usuario,
        u.nombre,
        u.email,
        u.id_rol,
        u.id_seccion
    FROM Usuario u
    WHERE u.id_usuario = p_id_usuario;
END;
$$;


--
-- Name: obtener_usuario_login(character varying); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.obtener_usuario_login(p_email character varying) RETURNS TABLE(id_usuario integer, nombre character varying, email character varying, password text, id_rol integer, id_seccion integer, rol character varying)
    LANGUAGE plpgsql
    AS $$
BEGIN
    IF p_email IS NULL OR TRIM(p_email) = '' THEN
        RAISE EXCEPTION 'El correo electrónico no puede estar vacío';
    END IF;

    RETURN QUERY
    SELECT
        u.id_usuario,
        u.nombre,
        u.email,
        u.password,
        u.id_rol,
        u.id_seccion,
        r.nombre AS rol
    FROM Usuario AS u
    INNER JOIN Rol AS r ON r.id_rol = u.id_rol
    WHERE u.email = TRIM(p_email)
    LIMIT 1;
END;
$$;


--
-- Name: obtener_ventas_dashboard(integer); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.obtener_ventas_dashboard(p_dias integer DEFAULT 30) RETURNS TABLE(dia date, total_dia numeric)
    LANGUAGE plpgsql
    AS $$
BEGIN
    IF p_dias IS NULL OR p_dias <= 0 THEN
        RAISE EXCEPTION 'La cantidad de días debe ser mayor que cero';
    END IF;

    RETURN QUERY
    SELECT
        DATE(f.fecha) AS dia,
        COALESCE(SUM(f.total), 0) AS total_dia
    FROM Factura f
    WHERE f.fecha >= CURRENT_DATE - (p_dias * INTERVAL '1 day')
    GROUP BY DATE(f.fecha)
    ORDER BY dia ASC;
END;
$$;


--
-- Name: obtener_ventas_detalladas_reportes(timestamp without time zone, timestamp without time zone); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.obtener_ventas_detalladas_reportes(p_fecha_desde timestamp without time zone DEFAULT NULL::timestamp without time zone, p_fecha_hasta timestamp without time zone DEFAULT NULL::timestamp without time zone) RETURNS TABLE(id_factura integer, fecha timestamp without time zone, subtotal numeric, descuento numeric, impuesto numeric, total numeric, cliente text, usuario character varying, seccion character varying)
    LANGUAGE plpgsql
    AS $$
BEGIN
    RETURN QUERY
    SELECT
        f.id_factura,
        f.fecha,
        f.subtotal,
        f.descuento,
        f.impuesto,
        f.total,
        COALESCE(NULLIF(f.nombre_cliente_fugaz, ''), c.nombres || ' ' || c.apellidos) AS cliente,
        u.nombre AS usuario,
        s.nombre AS seccion
    FROM Factura f
    INNER JOIN Cliente c ON c.id_cliente = f.id_cliente
    INNER JOIN Usuario u ON u.id_usuario = f.id_usuario
    INNER JOIN Seccion s ON s.id_seccion = f.id_seccion
    WHERE (p_fecha_desde IS NULL OR f.fecha >= p_fecha_desde)
      AND (p_fecha_hasta IS NULL OR f.fecha <= p_fecha_hasta)
    ORDER BY f.fecha DESC, f.id_factura DESC
    LIMIT 50;
END;
$$;


--
-- Name: obtener_ventas_por_dia_reportes(timestamp without time zone, timestamp without time zone); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.obtener_ventas_por_dia_reportes(p_fecha_desde timestamp without time zone DEFAULT NULL::timestamp without time zone, p_fecha_hasta timestamp without time zone DEFAULT NULL::timestamp without time zone) RETURNS TABLE(dia text, total_dia numeric, cantidad_facturas bigint)
    LANGUAGE plpgsql
    AS $$
BEGIN
    RETURN QUERY
    SELECT
        TO_CHAR(f.fecha::date, 'YYYY-MM-DD') AS dia,
        COALESCE(SUM(f.total), 0) AS total_dia,
        COUNT(*) AS cantidad_facturas
    FROM Factura f
    WHERE (p_fecha_desde IS NULL OR f.fecha >= p_fecha_desde)
      AND (p_fecha_hasta IS NULL OR f.fecha <= p_fecha_hasta)
    GROUP BY f.fecha::date
    ORDER BY f.fecha::date ASC
    LIMIT 30;
END;
$$;


--
-- Name: registrar_auditoria(character varying, character varying, character varying, text); Type: PROCEDURE; Schema: public; Owner: -
--

CREATE PROCEDURE public.registrar_auditoria(IN p_usuario character varying, IN p_accion character varying, IN p_tabla_afectada character varying, IN p_descripcion text)
    LANGUAGE plpgsql
    AS $$
BEGIN
    INSERT INTO Auditoria (
        usuario,
        accion,
        tabla_afectada,
        descripcion,
        fecha_registro
    )
    VALUES (
        p_usuario,
        p_accion,
        p_tabla_afectada,
        p_descripcion,
        NOW()
    );
END;
$$;


--
-- Name: registrar_categoria(character varying); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.registrar_categoria(p_nombre character varying) RETURNS TABLE(id_categoria integer, nombre character varying)
    LANGUAGE plpgsql
    AS $$
BEGIN
    IF p_nombre IS NULL OR TRIM(p_nombre) = '' THEN
        RAISE EXCEPTION 'El nombre de la categoría es obligatorio';
    END IF;

    IF LENGTH(TRIM(p_nombre)) > 80 THEN
        RAISE EXCEPTION 'El nombre de la categoría no debe superar los 80 caracteres';
    END IF;

    RETURN QUERY
    INSERT INTO Categoria (
        nombre
    )
    VALUES (
        TRIM(p_nombre)
    )
    RETURNING
        Categoria.id_categoria,
        Categoria.nombre;
END;
$$;


--
-- Name: registrar_cliente(character varying, character varying, character varying, character varying, character varying, character varying); Type: PROCEDURE; Schema: public; Owner: -
--

CREATE PROCEDURE public.registrar_cliente(IN p_nombres character varying, IN p_apellidos character varying, IN p_telefono character varying, IN p_direccion character varying, IN p_identificacion character varying, IN p_tipo_cliente character varying)
    LANGUAGE plpgsql
    AS $$
BEGIN
    IF p_tipo_cliente NOT IN ('Mayorista', 'Detallista') THEN
        RAISE EXCEPTION 'Tipo de cliente inválido. Debe ser Mayorista o Detallista';
    END IF;

    INSERT INTO Cliente (
        nombres,
        apellidos,
        telefono,
        direccion,
        identificacion,
        tipo_cliente
    )
    VALUES (
        p_nombres,
        p_apellidos,
        p_telefono,
        p_direccion,
        p_identificacion,
        p_tipo_cliente
    );
END;
$$;


--
-- Name: registrar_cliente_sistema(character varying, character varying, character varying, character varying, character varying, character varying); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.registrar_cliente_sistema(p_nombres character varying, p_apellidos character varying, p_telefono character varying DEFAULT NULL::character varying, p_direccion character varying DEFAULT NULL::character varying, p_identificacion character varying DEFAULT NULL::character varying, p_tipo_cliente character varying DEFAULT 'Detallista'::character varying) RETURNS boolean
    LANGUAGE plpgsql
    AS $$
BEGIN
    IF p_nombres IS NULL OR TRIM(p_nombres) = '' THEN
        RAISE EXCEPTION 'Los nombres del cliente no pueden estar vacíos';
    END IF;

    IF p_apellidos IS NULL OR TRIM(p_apellidos) = '' THEN
        RAISE EXCEPTION 'Los apellidos del cliente no pueden estar vacíos';
    END IF;

    IF p_tipo_cliente IS NULL
       OR p_tipo_cliente NOT IN ('Mayorista', 'Detallista') THEN
        RAISE EXCEPTION 'Tipo de cliente no válido';
    END IF;

    INSERT INTO Cliente (
        nombres,
        apellidos,
        telefono,
        direccion,
        identificacion,
        tipo_cliente
    )
    VALUES (
        TRIM(p_nombres),
        TRIM(p_apellidos),
        NULLIF(TRIM(p_telefono), ''),
        NULLIF(TRIM(p_direccion), ''),
        NULLIF(TRIM(p_identificacion), ''),
        p_tipo_cliente
    );

    RETURN TRUE;
END;
$$;


--
-- Name: registrar_factura_sistema(integer, integer, integer, numeric, numeric, numeric, numeric, character varying, character varying, jsonb); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.registrar_factura_sistema(p_id_cliente integer, p_id_usuario integer, p_id_seccion integer, p_subtotal numeric, p_descuento numeric, p_impuesto numeric, p_total numeric, p_tipo_cliente_venta character varying, p_nombre_cliente_fugaz character varying, p_items jsonb) RETURNS integer
    LANGUAGE plpgsql
    AS $$
DECLARE
    v_id_factura INT;
    v_item JSONB;
    v_id_producto INT;
    v_cantidad INT;
    v_precio_unitario NUMERIC;
    v_descuento_linea NUMERIC;
    v_total_linea NUMERIC;
BEGIN
    IF p_id_cliente IS NULL OR p_id_cliente <= 0 THEN
        RAISE EXCEPTION 'Debe seleccionar un cliente válido';
    END IF;

    IF p_id_usuario IS NULL OR p_id_usuario <= 0 THEN
        RAISE EXCEPTION 'ID de usuario no válido';
    END IF;

    IF p_id_seccion IS NULL OR p_id_seccion <= 0 THEN
        RAISE EXCEPTION 'Debe seleccionar una sección válida';
    END IF;

    IF p_tipo_cliente_venta NOT IN ('Habitual', 'Fugaz') THEN
        RAISE EXCEPTION 'Tipo de cliente de venta no válido';
    END IF;

    IF p_items IS NULL OR JSONB_TYPEOF(p_items) <> 'array' OR JSONB_ARRAY_LENGTH(p_items) = 0 THEN
        RAISE EXCEPTION 'Debe agregar al menos un producto a la factura';
    END IF;

    IF p_subtotal IS NULL OR p_subtotal < 0 THEN
        RAISE EXCEPTION 'Subtotal no válido';
    END IF;

    IF p_descuento IS NULL OR p_descuento < 0 THEN
        RAISE EXCEPTION 'Descuento no válido';
    END IF;

    IF p_impuesto IS NULL OR p_impuesto < 0 THEN
        RAISE EXCEPTION 'Impuesto no válido';
    END IF;

    IF p_total IS NULL OR p_total < 0 THEN
        RAISE EXCEPTION 'Total no válido';
    END IF;

    INSERT INTO Factura (
        id_cliente,
        id_usuario,
        id_seccion,
        subtotal,
        descuento,
        impuesto,
        total,
        tipo_cliente_venta,
        nombre_cliente_fugaz
    )
    VALUES (
        p_id_cliente,
        p_id_usuario,
        p_id_seccion,
        p_subtotal,
        p_descuento,
        p_impuesto,
        p_total,
        p_tipo_cliente_venta,
        CASE
            WHEN p_tipo_cliente_venta = 'Fugaz'
                THEN NULLIF(TRIM(p_nombre_cliente_fugaz), '')
            ELSE NULL
        END
    )
    RETURNING id_factura INTO v_id_factura;

    FOR v_item IN
        SELECT value
        FROM JSONB_ARRAY_ELEMENTS(p_items)
    LOOP
        v_id_producto := (v_item->>'id_producto')::INT;
        v_cantidad := (v_item->>'cantidad')::INT;
        v_precio_unitario := (v_item->>'precio_unitario')::NUMERIC;
        v_descuento_linea := (v_item->>'descuento_linea')::NUMERIC;
        v_total_linea := (v_item->>'total_linea')::NUMERIC;

        IF v_id_producto IS NULL OR v_id_producto <= 0 THEN
            RAISE EXCEPTION 'Producto no válido en el detalle de factura';
        END IF;

        IF v_cantidad IS NULL OR v_cantidad <= 0 THEN
            RAISE EXCEPTION 'Cantidad no válida en el detalle de factura';
        END IF;

        IF v_precio_unitario IS NULL OR v_precio_unitario < 0 THEN
            RAISE EXCEPTION 'Precio unitario no válido en el detalle de factura';
        END IF;

        IF v_descuento_linea IS NULL OR v_descuento_linea < 0 THEN
            RAISE EXCEPTION 'Descuento de línea no válido';
        END IF;

        IF v_total_linea IS NULL OR v_total_linea < 0 THEN
            RAISE EXCEPTION 'Total de línea no válido';
        END IF;

        UPDATE Producto
        SET stock = stock - v_cantidad
        WHERE Producto.id_producto = v_id_producto
          AND Producto.stock >= v_cantidad;

        IF NOT FOUND THEN
            RAISE EXCEPTION 'Stock insuficiente o producto no encontrado para el producto ID %', v_id_producto;
        END IF;

        INSERT INTO DetalleFactura (
            id_factura,
            id_producto,
            cantidad,
            precio_unitario,
            descuento_linea,
            total_linea
        )
        VALUES (
            v_id_factura,
            v_id_producto,
            v_cantidad,
            v_precio_unitario,
            v_descuento_linea,
            v_total_linea
        );
    END LOOP;

    RETURN v_id_factura;
END;
$$;


--
-- Name: registrar_historial_estado_factura(); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.registrar_historial_estado_factura() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
DECLARE
    v_tipo_evento VARCHAR(80);
    v_monto_abonado NUMERIC(12, 2);
    v_comentario TEXT;
BEGIN
    IF TG_OP = 'INSERT' THEN
        INSERT INTO factura_estado_historial (
            id_factura,
            tipo_evento,
            estado_pago_nuevo,
            estado_produccion_nuevo,
            monto_pagado_nuevo,
            saldo_nuevo,
            fecha_entrega_estimada_nueva,
            comentario
        ) VALUES (
            NEW.id_factura,
            'Factura creada',
            NEW.estado_pago,
            NEW.estado_produccion,
            NEW.monto_pagado,
            NEW.saldo_pendiente,
            NEW.fecha_entrega_estimada,
            'La factura fue registrada en el sistema.'
        );

        RETURN NEW;
    END IF;

    IF TG_OP = 'UPDATE' THEN
        v_tipo_evento := 'Factura actualizada';
        v_monto_abonado := GREATEST(COALESCE(NEW.monto_pagado, 0) - COALESCE(OLD.monto_pagado, 0), 0);

        IF COALESCE(NEW.monto_pagado, 0) <> COALESCE(OLD.monto_pagado, 0) THEN
            v_tipo_evento := 'Pago actualizado';
        END IF;

        IF COALESCE(NEW.estado_produccion, '') <> COALESCE(OLD.estado_produccion, '') THEN
            v_tipo_evento := 'Estado de producción actualizado';
        END IF;

        IF NEW.estado_produccion = 'Cancelada' AND OLD.estado_produccion IS DISTINCT FROM NEW.estado_produccion THEN
            v_tipo_evento := 'Factura cancelada';

            IF NEW.fecha_entrega_estimada IS NOT NULL AND CURRENT_DATE <= NEW.fecha_entrega_estimada THEN
                v_comentario := 'El cliente canceló antes o en la fecha estimada de entrega.';
            ELSE
                v_comentario := 'El cliente canceló después de la fecha estimada de entrega.';
            END IF;
        ELSE
            v_comentario := 'Cambio registrado automáticamente por el sistema.';
        END IF;

        IF
            COALESCE(NEW.estado_pago, '') <> COALESCE(OLD.estado_pago, '')
            OR COALESCE(NEW.estado_produccion, '') <> COALESCE(OLD.estado_produccion, '')
            OR COALESCE(NEW.monto_pagado, 0) <> COALESCE(OLD.monto_pagado, 0)
            OR COALESCE(NEW.saldo_pendiente, 0) <> COALESCE(OLD.saldo_pendiente, 0)
            OR NEW.fecha_entrega_estimada IS DISTINCT FROM OLD.fecha_entrega_estimada
        THEN
            INSERT INTO factura_estado_historial (
                id_factura,
                tipo_evento,
                estado_pago_anterior,
                estado_pago_nuevo,
                estado_produccion_anterior,
                estado_produccion_nuevo,
                monto_pagado_anterior,
                monto_pagado_nuevo,
                monto_abonado,
                saldo_anterior,
                saldo_nuevo,
                fecha_entrega_estimada_anterior,
                fecha_entrega_estimada_nueva,
                comentario
            ) VALUES (
                NEW.id_factura,
                v_tipo_evento,
                OLD.estado_pago,
                NEW.estado_pago,
                OLD.estado_produccion,
                NEW.estado_produccion,
                OLD.monto_pagado,
                NEW.monto_pagado,
                v_monto_abonado,
                OLD.saldo_pendiente,
                NEW.saldo_pendiente,
                OLD.fecha_entrega_estimada,
                NEW.fecha_entrega_estimada,
                v_comentario
            );
        END IF;

        RETURN NEW;
    END IF;

    RETURN NEW;
END;
$$;


--
-- Name: registrar_producto(character varying, character varying, text, character varying, integer, integer, numeric, numeric, integer); Type: PROCEDURE; Schema: public; Owner: -
--

CREATE PROCEDURE public.registrar_producto(IN p_codigo character varying, IN p_nombre character varying, IN p_descripcion text, IN p_imagen character varying, IN p_id_categoria integer, IN p_id_proveedor integer, IN p_precio_compra numeric, IN p_precio_venta numeric, IN p_stock integer)
    LANGUAGE plpgsql
    AS $$
BEGIN
    IF p_precio_compra < 0 THEN
        RAISE EXCEPTION 'El precio de compra no puede ser negativo';
    END IF;

    IF p_precio_venta < 0 THEN
        RAISE EXCEPTION 'El precio de venta no puede ser negativo';
    END IF;

    IF p_stock < 0 THEN
        RAISE EXCEPTION 'El stock no puede ser negativo';
    END IF;

    INSERT INTO Producto (
        codigo,
        nombre,
        descripcion,
        imagen,
        id_categoria,
        id_proveedor,
        precio_compra,
        precio_venta,
        stock
    )
    VALUES (
        p_codigo,
        p_nombre,
        COALESCE(p_descripcion, 'Sin descripción'),
        p_imagen,
        p_id_categoria,
        p_id_proveedor,
        p_precio_compra,
        p_precio_venta,
        p_stock
    );
END;
$$;


--
-- Name: registrar_producto_formulario(character varying, character varying, text, character varying, integer, integer, numeric, numeric, integer); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.registrar_producto_formulario(p_codigo character varying, p_nombre character varying, p_descripcion text, p_imagen character varying, p_id_categoria integer, p_id_proveedor integer, p_precio_compra numeric, p_precio_venta numeric, p_stock integer) RETURNS TABLE(id_producto integer)
    LANGUAGE plpgsql
    AS $$
BEGIN
    IF p_codigo IS NULL OR TRIM(p_codigo) = '' THEN
        RAISE EXCEPTION 'El código del producto es obligatorio';
    END IF;

    IF LENGTH(TRIM(p_codigo)) > 50 THEN
        RAISE EXCEPTION 'El código del producto no debe superar los 50 caracteres';
    END IF;

    IF p_nombre IS NULL OR TRIM(p_nombre) = '' THEN
        RAISE EXCEPTION 'El nombre del producto es obligatorio';
    END IF;

    IF LENGTH(TRIM(p_nombre)) > 120 THEN
        RAISE EXCEPTION 'El nombre del producto no debe superar los 120 caracteres';
    END IF;

    IF p_imagen IS NULL OR TRIM(p_imagen) = '' THEN
        RAISE EXCEPTION 'La imagen del producto es obligatoria';
    END IF;

    IF p_precio_compra IS NULL OR p_precio_compra < 0 THEN
        RAISE EXCEPTION 'El precio de compra debe ser mayor o igual a cero';
    END IF;

    IF p_precio_venta IS NULL OR p_precio_venta < 0 THEN
        RAISE EXCEPTION 'El precio de venta debe ser mayor o igual a cero';
    END IF;

    IF p_stock IS NULL OR p_stock < 0 THEN
        RAISE EXCEPTION 'El stock debe ser mayor o igual a cero';
    END IF;

    RETURN QUERY
    INSERT INTO Producto (
        codigo,
        nombre,
        descripcion,
        imagen,
        id_categoria,
        id_proveedor,
        precio_compra,
        precio_venta,
        stock
    )
    VALUES (
        TRIM(p_codigo),
        TRIM(p_nombre),
        COALESCE(NULLIF(TRIM(p_descripcion), ''), 'Sin descripción'),
        TRIM(p_imagen),
        p_id_categoria,
        p_id_proveedor,
        p_precio_compra,
        p_precio_venta,
        p_stock
    )
    RETURNING Producto.id_producto;
END;
$$;


--
-- Name: validar_factura_existe(integer); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.validar_factura_existe(p_id_factura integer) RETURNS boolean
    LANGUAGE plpgsql
    AS $$
DECLARE
    v_existe BOOLEAN;
BEGIN
    SELECT EXISTS (
        SELECT 1
        FROM Factura
        WHERE id_factura = p_id_factura
    )
    INTO v_existe;

    RETURN v_existe;
END;
$$;


SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: auditoria; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.auditoria (
    id_auditoria integer NOT NULL,
    usuario character varying(100) DEFAULT 'Sistema'::character varying,
    accion character varying(50) NOT NULL,
    tabla_afectada character varying(100) NOT NULL,
    descripcion text,
    fecha_registro timestamp without time zone DEFAULT now() NOT NULL,
    fecha timestamp without time zone DEFAULT now() NOT NULL,
    id_usuario integer,
    registro_id text,
    datos_anteriores jsonb
);


--
-- Name: auditoria_id_auditoria_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.auditoria_id_auditoria_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: auditoria_id_auditoria_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.auditoria_id_auditoria_seq OWNED BY public.auditoria.id_auditoria;


--
-- Name: categoria; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.categoria (
    id_categoria integer NOT NULL,
    nombre character varying(80) NOT NULL
);


--
-- Name: categoria_id_categoria_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.categoria_id_categoria_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: categoria_id_categoria_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.categoria_id_categoria_seq OWNED BY public.categoria.id_categoria;


--
-- Name: cliente; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.cliente (
    id_cliente integer NOT NULL,
    nombres character varying(80) NOT NULL,
    apellidos character varying(80) NOT NULL,
    telefono character varying(30),
    direccion character varying(200),
    identificacion character varying(40),
    tipo_cliente character varying(12) DEFAULT 'Detallista'::character varying NOT NULL,
    fecha_registro date DEFAULT CURRENT_DATE NOT NULL,
    CONSTRAINT ck_cliente_tipo CHECK (((tipo_cliente)::text = ANY (ARRAY[('Mayorista'::character varying)::text, ('Detallista'::character varying)::text])))
);


--
-- Name: cliente_id_cliente_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.cliente_id_cliente_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: cliente_id_cliente_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.cliente_id_cliente_seq OWNED BY public.cliente.id_cliente;


--
-- Name: compra; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.compra (
    id_compra integer NOT NULL,
    fecha timestamp without time zone DEFAULT now() NOT NULL,
    id_proveedor integer NOT NULL,
    id_usuario integer NOT NULL,
    total numeric(10,2) DEFAULT 0 NOT NULL
);


--
-- Name: compra_id_compra_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.compra_id_compra_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: compra_id_compra_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.compra_id_compra_seq OWNED BY public.compra.id_compra;


--
-- Name: detallecompra; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.detallecompra (
    id_detalle integer NOT NULL,
    id_compra integer NOT NULL,
    id_producto integer NOT NULL,
    cantidad integer NOT NULL,
    costo_unitario numeric(10,2) NOT NULL,
    total_linea numeric(10,2) NOT NULL,
    CONSTRAINT detallecompra_cantidad_check CHECK ((cantidad > 0)),
    CONSTRAINT detallecompra_costo_unitario_check CHECK ((costo_unitario >= (0)::numeric))
);


--
-- Name: detallecompra_id_detalle_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.detallecompra_id_detalle_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: detallecompra_id_detalle_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.detallecompra_id_detalle_seq OWNED BY public.detallecompra.id_detalle;


--
-- Name: detallefactura; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.detallefactura (
    id_detalle integer NOT NULL,
    id_factura integer NOT NULL,
    id_producto integer NOT NULL,
    cantidad integer NOT NULL,
    precio_unitario numeric(10,2) NOT NULL,
    descuento_linea numeric(10,2) DEFAULT 0 NOT NULL,
    total_linea numeric(10,2) NOT NULL,
    CONSTRAINT detallefactura_cantidad_check CHECK ((cantidad > 0)),
    CONSTRAINT detallefactura_precio_unitario_check CHECK ((precio_unitario >= (0)::numeric))
);


--
-- Name: detallefactura_id_detalle_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.detallefactura_id_detalle_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: detallefactura_id_detalle_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.detallefactura_id_detalle_seq OWNED BY public.detallefactura.id_detalle;


--
-- Name: factura; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.factura (
    id_factura integer NOT NULL,
    fecha timestamp without time zone DEFAULT now() NOT NULL,
    id_cliente integer NOT NULL,
    id_usuario integer NOT NULL,
    id_seccion integer NOT NULL,
    subtotal numeric(10,2) DEFAULT 0 NOT NULL,
    descuento numeric(10,2) DEFAULT 0 NOT NULL,
    impuesto numeric(10,2) DEFAULT 0 NOT NULL,
    total numeric(10,2) DEFAULT 0 NOT NULL,
    tipo_cliente_venta character varying(10) DEFAULT 'Habitual'::character varying NOT NULL,
    nombre_cliente_fugaz character varying(150),
    monto_pagado numeric(10,2) DEFAULT 0 NOT NULL,
    saldo_pendiente numeric(10,2) DEFAULT 0 NOT NULL,
    porcentaje_pagado numeric(5,2) DEFAULT 0 NOT NULL,
    estado_pago character varying(30) DEFAULT 'Pendiente'::character varying NOT NULL,
    estado_produccion character varying(30) DEFAULT 'Pendiente'::character varying NOT NULL,
    fecha_orden_produccion timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    fecha_entrega_estimada date,
    fecha_entrega_real date,
    CONSTRAINT chk_factura_estado_pago_valido CHECK (((estado_pago)::text = ANY (ARRAY[('Pendiente'::character varying)::text, ('Parcial'::character varying)::text, ('Pagado'::character varying)::text]))),
    CONSTRAINT chk_factura_estado_produccion_valido CHECK (((estado_produccion)::text = ANY (ARRAY[('Pendiente'::character varying)::text, ('En producción'::character varying)::text, ('Lista para entregar'::character varying)::text, ('Entregada'::character varying)::text, ('Cancelada'::character varying)::text]))),
    CONSTRAINT chk_factura_monto_pagado_no_negativo CHECK ((monto_pagado >= (0)::numeric)),
    CONSTRAINT chk_factura_porcentaje_pagado_rango CHECK (((porcentaje_pagado >= (0)::numeric) AND (porcentaje_pagado <= (100)::numeric))),
    CONSTRAINT chk_factura_saldo_pendiente_no_negativo CHECK ((saldo_pendiente >= (0)::numeric)),
    CONSTRAINT factura_tipo_cliente_venta_check CHECK (((tipo_cliente_venta)::text = ANY (ARRAY[('Habitual'::character varying)::text, ('Fugaz'::character varying)::text])))
);


--
-- Name: factura_estado_historial; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.factura_estado_historial (
    id_historial integer NOT NULL,
    id_factura integer NOT NULL,
    tipo_evento character varying(80) NOT NULL,
    estado_pago_anterior character varying(50),
    estado_pago_nuevo character varying(50),
    estado_produccion_anterior character varying(80),
    estado_produccion_nuevo character varying(80),
    monto_pagado_anterior numeric(12,2),
    monto_pagado_nuevo numeric(12,2),
    monto_abonado numeric(12,2) DEFAULT 0,
    saldo_anterior numeric(12,2),
    saldo_nuevo numeric(12,2),
    fecha_entrega_estimada_anterior date,
    fecha_entrega_estimada_nueva date,
    comentario text,
    fecha_evento timestamp without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL
);


--
-- Name: factura_estado_historial_id_historial_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.factura_estado_historial_id_historial_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: factura_estado_historial_id_historial_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.factura_estado_historial_id_historial_seq OWNED BY public.factura_estado_historial.id_historial;


--
-- Name: factura_id_factura_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.factura_id_factura_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: factura_id_factura_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.factura_id_factura_seq OWNED BY public.factura.id_factura;


--
-- Name: producto; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.producto (
    id_producto integer NOT NULL,
    codigo character varying(50) NOT NULL,
    nombre character varying(120) NOT NULL,
    descripcion text DEFAULT 'Sin descripción'::text,
    imagen character varying(200),
    id_categoria integer,
    id_proveedor integer,
    precio_compra numeric(10,2) NOT NULL,
    precio_venta numeric(10,2) NOT NULL,
    stock integer DEFAULT 0 NOT NULL,
    CONSTRAINT producto_precio_compra_check CHECK ((precio_compra >= (0)::numeric)),
    CONSTRAINT producto_precio_venta_check CHECK ((precio_venta >= (0)::numeric)),
    CONSTRAINT producto_stock_check CHECK ((stock >= 0))
);


--
-- Name: producto_id_producto_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.producto_id_producto_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: producto_id_producto_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.producto_id_producto_seq OWNED BY public.producto.id_producto;


--
-- Name: proveedor; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.proveedor (
    id_proveedor integer NOT NULL,
    nombre character varying(120) NOT NULL,
    telefono character varying(30),
    email character varying(120),
    direccion character varying(200)
);


--
-- Name: proveedor_id_proveedor_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.proveedor_id_proveedor_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: proveedor_id_proveedor_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.proveedor_id_proveedor_seq OWNED BY public.proveedor.id_proveedor;


--
-- Name: rol; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.rol (
    id_rol integer NOT NULL,
    nombre character varying(30) NOT NULL
);


--
-- Name: rol_id_rol_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.rol_id_rol_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: rol_id_rol_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.rol_id_rol_seq OWNED BY public.rol.id_rol;


--
-- Name: seccion; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.seccion (
    id_seccion integer NOT NULL,
    nombre character varying(30) NOT NULL
);


--
-- Name: seccion_id_seccion_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.seccion_id_seccion_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: seccion_id_seccion_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.seccion_id_seccion_seq OWNED BY public.seccion.id_seccion;


--
-- Name: usuario; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.usuario (
    id_usuario integer NOT NULL,
    nombre character varying(100) NOT NULL,
    email character varying(120) NOT NULL,
    password text NOT NULL,
    id_rol integer NOT NULL,
    id_seccion integer
);


--
-- Name: usuario_id_usuario_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.usuario_id_usuario_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: usuario_id_usuario_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.usuario_id_usuario_seq OWNED BY public.usuario.id_usuario;


--
-- Name: auditoria id_auditoria; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.auditoria ALTER COLUMN id_auditoria SET DEFAULT nextval('public.auditoria_id_auditoria_seq'::regclass);


--
-- Name: categoria id_categoria; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.categoria ALTER COLUMN id_categoria SET DEFAULT nextval('public.categoria_id_categoria_seq'::regclass);


--
-- Name: cliente id_cliente; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.cliente ALTER COLUMN id_cliente SET DEFAULT nextval('public.cliente_id_cliente_seq'::regclass);


--
-- Name: compra id_compra; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.compra ALTER COLUMN id_compra SET DEFAULT nextval('public.compra_id_compra_seq'::regclass);


--
-- Name: detallecompra id_detalle; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.detallecompra ALTER COLUMN id_detalle SET DEFAULT nextval('public.detallecompra_id_detalle_seq'::regclass);


--
-- Name: detallefactura id_detalle; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.detallefactura ALTER COLUMN id_detalle SET DEFAULT nextval('public.detallefactura_id_detalle_seq'::regclass);


--
-- Name: factura id_factura; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.factura ALTER COLUMN id_factura SET DEFAULT nextval('public.factura_id_factura_seq'::regclass);


--
-- Name: factura_estado_historial id_historial; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.factura_estado_historial ALTER COLUMN id_historial SET DEFAULT nextval('public.factura_estado_historial_id_historial_seq'::regclass);


--
-- Name: producto id_producto; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.producto ALTER COLUMN id_producto SET DEFAULT nextval('public.producto_id_producto_seq'::regclass);


--
-- Name: proveedor id_proveedor; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.proveedor ALTER COLUMN id_proveedor SET DEFAULT nextval('public.proveedor_id_proveedor_seq'::regclass);


--
-- Name: rol id_rol; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.rol ALTER COLUMN id_rol SET DEFAULT nextval('public.rol_id_rol_seq'::regclass);


--
-- Name: seccion id_seccion; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.seccion ALTER COLUMN id_seccion SET DEFAULT nextval('public.seccion_id_seccion_seq'::regclass);


--
-- Name: usuario id_usuario; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.usuario ALTER COLUMN id_usuario SET DEFAULT nextval('public.usuario_id_usuario_seq'::regclass);


--
-- Data for Name: auditoria; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.auditoria (id_auditoria, usuario, accion, tabla_afectada, descripcion, fecha_registro, fecha, id_usuario, registro_id, datos_anteriores) FROM stdin;
41	Sistema	DELETE	cliente	\N	2026-05-12 21:58:41.700417	2026-05-12 21:58:41.700417	\N	358	{"nombres": "Carlos Prueba", "telefono": "7777-1010", "apellidos": "Restauración", "direccion": "Managua, Nicaragua", "id_cliente": 358, "tipo_cliente": "Detallista", "fecha_registro": "2026-05-12", "identificacion": "PAP-CLI-001"}
42	Sistema	DELETE	cliente	\N	2026-05-12 21:58:41.700417	2026-05-12 21:58:41.700417	\N	359	{"nombres": "María Papelera", "telefono": "7777-2020", "apellidos": "Temporal", "direccion": "León, Nicaragua", "id_cliente": 359, "tipo_cliente": "Mayorista", "fecha_registro": "2026-05-12", "identificacion": "PAP-CLI-002"}
43	Sistema	DELETE	proveedor	\N	2026-05-12 21:58:41.703555	2026-05-12 21:58:41.703555	\N	11	{"email": "proveedor.papelera@test.com", "nombre": "Proveedor Prueba Papelera", "telefono": "8888-9090", "direccion": "Managua, Nicaragua", "id_proveedor": 11}
44	Sistema	DELETE	categoria	\N	2026-05-12 21:58:41.704884	2026-05-12 21:58:41.704884	\N	11	{"nombre": "Prueba Papelera Categoría", "id_categoria": 11}
45	Sistema	RESTAURADO	producto	 | Registro restaurado desde papelera administrativa.	2026-05-12 22:04:26.858734	2026-05-12 22:04:26.858734	\N	122	{"stock": 7, "codigo": "TEMP-PROD-001", "imagen": null, "nombre": "Producto temporal auditoria", "descripcion": "Producto creado para probar restauración.", "id_producto": 122, "id_categoria": 12, "id_proveedor": 12, "precio_venta": 240.00, "precio_compra": 120.00}
46	Sistema	DELETE	producto	\N	2026-05-12 22:39:13.128318	2026-05-12 22:39:13.128318	\N	121	{"stock": 12, "codigo": "PAP-PROD-004", "imagen": "prod_6a04006d25c598.81799647.png", "nombre": "Bolso prueba papelera", "descripcion": "Producto temporal adicional para probar registros eliminados.", "id_producto": 121, "id_categoria": 10, "id_proveedor": 10, "precio_venta": 295.00, "precio_compra": 160.00}
\.


--
-- Data for Name: categoria; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.categoria (id_categoria, nombre) FROM stdin;
1	Camisetas
2	Hoodies
3	Stickers
4	Tazas
5	Gorras
6	Llaveros
7	Posters
8	Bolsos
9	Mousepads
10	Accesorios personalizados
12	Categoria Temporal Producto
\.


--
-- Data for Name: cliente; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.cliente (id_cliente, nombres, apellidos, telefono, direccion, identificacion, tipo_cliente, fecha_registro) FROM stdin;
1	Héctor	Molina	88100015	Carazo	AUTO-0015	Mayorista	2026-01-14
2	Adriana	Chávez	88100016	Estelí	AUTO-0016	Detallista	2026-01-18
3	Samuel	Cruz	88100017	Chinandega	AUTO-0017	Detallista	2026-01-22
4	Isabel	López	88100018	Rivas	AUTO-0018	Detallista	2026-01-26
5	Ángel	Zamora	88100019	Matagalpa	AUTO-0019	Detallista	2026-01-30
6	Renata	Salinas	88100020	Jinotepe	AUTO-0020	Mayorista	2026-02-03
7	Roberto	Morales	88100021	Managua	AUTO-0021	Detallista	2026-02-07
8	Gabriela	Navarro	88100022	Masaya	AUTO-0022	Detallista	2026-02-11
9	Luis	Gutiérrez	88100023	León	AUTO-0023	Detallista	2026-02-15
10	Daniela	Rivas	88100024	Granada	AUTO-0024	Detallista	2026-02-19
11	Fernando	Aguilar	88100025	Carazo	AUTO-0025	Mayorista	2026-02-23
12	Valeria	Vargas	88100026	Estelí	AUTO-0026	Detallista	2026-02-27
13	Miguel	Pineda	88100027	Chinandega	AUTO-0027	Detallista	2026-03-03
14	Andrea	Reyes	88100028	Rivas	AUTO-0028	Detallista	2026-03-07
15	Sergio	Campos	88100029	Matagalpa	AUTO-0029	Detallista	2026-03-11
16	Camila	Duarte	88100030	Jinotepe	AUTO-0030	Mayorista	2026-03-15
17	Eduardo	Flores	88100031	Managua	AUTO-0031	Detallista	2026-03-19
18	Natalia	Castro	88100032	Masaya	AUTO-0032	Detallista	2026-03-23
19	Bryan	Obando	88100033	León	AUTO-0033	Detallista	2026-03-27
20	Fernanda	Rivera	88100034	Granada	AUTO-0034	Detallista	2026-03-31
\.


--
-- Data for Name: compra; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.compra (id_compra, fecha, id_proveedor, id_usuario, total) FROM stdin;
1	2026-01-07 09:30:00	1	1	2377.50
2	2026-01-09 10:30:00	2	2	2977.50
3	2026-01-11 11:30:00	3	3	3645.00
4	2026-01-13 12:30:00	4	4	4380.00
5	2026-01-15 13:30:00	5	5	5182.50
6	2026-01-17 14:30:00	6	6	6052.50
7	2026-01-19 15:30:00	7	7	6990.00
8	2026-01-21 08:30:00	8	8	7995.00
9	2026-01-23 09:30:00	9	9	6757.50
10	2026-01-25 10:30:00	10	10	5362.50
11	2026-01-27 11:30:00	1	11	3810.00
12	2026-01-29 12:30:00	2	12	4680.00
13	2026-01-31 13:30:00	3	13	5617.50
14	2026-02-02 14:30:00	4	14	6622.50
15	2026-02-04 15:30:00	5	15	7695.00
16	2026-02-06 08:30:00	6	16	8835.00
17	2026-02-08 09:30:00	7	17	10042.50
18	2026-02-10 10:30:00	8	18	11317.50
19	2026-02-12 11:30:00	9	19	12660.00
20	2026-02-14 12:30:00	10	20	14070.00
\.


--
-- Data for Name: detallecompra; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.detallecompra (id_detalle, id_compra, id_producto, cantidad, costo_unitario, total_linea) FROM stdin;
1	1	4	7	95.00	665.00
2	2	7	8	106.25	850.00
3	3	10	9	117.50	1057.50
4	4	1	10	128.75	1287.50
5	5	4	11	140.00	1540.00
6	6	7	12	151.25	1815.00
7	7	10	13	162.50	2112.50
8	8	13	14	173.75	2432.50
9	9	16	15	185.00	2775.00
10	10	19	16	196.25	3140.00
11	11	14	5	207.50	1037.50
12	12	17	6	218.75	1312.50
13	13	20	7	230.00	1610.00
14	14	3	8	241.25	1930.00
15	15	6	9	252.50	2272.50
16	16	9	10	263.75	2637.50
17	17	12	11	275.00	3025.00
18	18	15	12	286.25	3435.00
19	19	18	13	297.50	3867.50
20	20	1	14	308.75	4322.50
\.


--
-- Data for Name: detallefactura; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.detallefactura (id_detalle, id_factura, id_producto, cantidad, precio_unitario, descuento_linea, total_linea) FROM stdin;
1	1	3	3	145.75	0.00	437.25
2	3	7	1	166.75	0.00	166.75
3	4	9	2	177.25	0.00	354.50
4	5	11	3	187.75	0.00	563.25
5	7	3	1	208.75	0.00	208.75
6	8	5	2	219.25	0.00	438.50
7	9	7	3	229.75	0.00	689.25
8	11	11	1	250.75	0.00	250.75
9	12	13	2	261.25	0.00	522.50
10	13	15	3	271.75	10.00	805.25
11	15	19	1	292.75	0.00	292.75
12	16	13	2	303.25	0.00	606.50
13	17	15	3	313.75	0.00	941.25
14	19	19	1	334.75	0.00	334.75
15	20	1	2	345.25	10.00	680.50
16	1	3	3	355.75	0.00	1067.25
17	2	5	4	366.25	0.00	1465.00
18	3	7	1	376.75	0.00	376.75
19	4	9	2	387.25	0.00	774.50
20	5	11	3	397.75	0.00	1193.25
\.


--
-- Data for Name: factura; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.factura (id_factura, fecha, id_cliente, id_usuario, id_seccion, subtotal, descuento, impuesto, total, tipo_cliente_venta, nombre_cliente_fugaz, monto_pagado, saldo_pendiente, porcentaje_pagado, estado_pago, estado_produccion, fecha_orden_produccion, fecha_entrega_estimada, fecha_entrega_real) FROM stdin;
1	2026-02-27 14:15:00	6	26	2	2046.50	0.00	305.48	2341.98	Habitual	\N	1756.49	585.49	75.00	Parcial	En producción	2026-02-27 14:45:00	2026-03-02	\N
2	2026-02-28 15:15:00	7	27	1	1266.75	0.00	188.51	1445.26	Habitual	\N	1083.95	361.31	75.00	Parcial	En producción	2026-02-28 15:45:00	2026-03-04	\N
3	2026-03-01 09:15:00	8	28	2	2162.00	0.00	324.30	2486.30	Habitual	\N	1864.73	621.57	75.00	Parcial	En producción	2026-03-01 09:45:00	2026-03-06	\N
4	2026-03-02 10:15:00	9	29	1	3099.25	0.00	464.89	3564.14	Habitual	\N	1782.07	1782.07	50.00	Parcial	Lista para entregar	2026-03-02 10:45:00	2026-03-08	\N
5	2026-03-03 11:15:00	10	30	2	2256.50	25.00	334.73	2566.23	Fugaz	José Ramírez	1283.12	1283.11	50.00	Parcial	Lista para entregar	2026-03-03 11:45:00	2026-03-05	\N
6	2026-03-04 12:15:00	1	1	1	1392.75	0.00	208.91	1601.66	Habitual	\N	800.83	800.83	50.00	Parcial	Lista para entregar	2026-03-04 12:45:00	2026-03-07	\N
7	2026-03-05 13:15:00	2	2	2	2372.00	0.00	355.80	2727.80	Habitual	\N	1363.90	1363.90	50.00	Parcial	Lista para entregar	2026-03-05 13:45:00	2026-03-09	\N
8	2026-03-06 14:15:00	3	3	1	3393.25	0.00	507.49	3890.74	Habitual	\N	1945.37	1945.37	50.00	Parcial	Lista para entregar	2026-03-06 14:45:00	2026-03-11	\N
9	2026-03-07 15:15:00	4	4	2	2466.50	0.00	368.48	2824.98	Habitual	\N	1412.49	1412.49	50.00	Parcial	Lista para entregar	2026-03-07 15:45:00	2026-03-13	\N
10	2026-03-08 09:15:00	5	5	1	1518.75	25.00	224.06	1717.81	Habitual	\N	858.91	858.90	50.00	Parcial	Lista para entregar	2026-03-08 09:45:00	2026-03-10	\N
11	2026-03-09 10:15:00	6	6	2	2582.00	0.00	387.30	2969.30	Fugaz	Carlos Mendoza	1484.65	1484.65	50.00	Parcial	Lista para entregar	2026-03-09 10:45:00	2026-03-12	\N
12	2026-03-10 11:15:00	7	7	1	3687.25	0.00	553.09	4240.34	Habitual	\N	2120.17	2120.17	50.00	Parcial	Lista para entregar	2026-03-10 11:45:00	2026-03-14	\N
13	2026-03-11 12:15:00	8	8	2	2676.50	0.00	401.48	3077.98	Habitual	\N	1538.99	1538.99	50.00	Parcial	Lista para entregar	2026-03-11 12:45:00	2026-03-16	\N
14	2026-03-12 13:15:00	9	9	1	1644.75	0.00	246.71	1891.46	Habitual	\N	0.00	1891.46	0.00	Pendiente	En producción	2026-03-12 13:45:00	2026-03-18	\N
15	2026-03-13 14:15:00	10	10	2	2792.00	25.00	413.55	3170.55	Habitual	\N	0.00	3170.55	0.00	Pendiente	En producción	2026-03-13 14:45:00	2026-03-15	\N
16	2026-03-14 15:15:00	11	11	1	3981.25	0.00	595.69	4566.94	Habitual	\N	0.00	4566.94	0.00	Pendiente	En producción	2026-03-14 15:45:00	2026-03-17	\N
17	2026-03-15 09:15:00	12	12	2	2886.50	0.00	432.98	3319.48	Fugaz	José Ramírez	0.00	3319.48	0.00	Pendiente	En producción	2026-03-15 09:45:00	2026-03-19	\N
18	2026-03-16 10:15:00	13	13	1	1770.75	0.00	265.61	2036.36	Habitual	\N	0.00	2036.36	0.00	Pendiente	En producción	2026-03-16 10:45:00	2026-03-21	\N
19	2026-03-17 11:15:00	14	14	2	3002.00	0.00	450.30	3452.30	Habitual	\N	0.00	3452.30	0.00	Pendiente	En producción	2026-03-17 11:45:00	2026-03-23	\N
20	2026-03-18 12:15:00	15	15	1	4275.25	25.00	637.54	4887.79	Habitual	\N	0.00	4887.79	0.00	Pendiente	En producción	2026-03-18 12:45:00	2026-03-20	\N
\.


--
-- Data for Name: factura_estado_historial; Type: TABLE DATA; Schema: public; Owner: -
--

--

--
-- Data for Name: producto; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.producto (id_producto, codigo, nombre, descripcion, imagen, id_categoria, id_proveedor, precio_compra, precio_venta, stock) FROM stdin;
1	P013	Hoodie Oversize Negro #13	Producto generado para inventario académico de Panda Estampados y Kitsune.	prod_67817b473371f51443a44144.jpg	3	3	128.75	198.25	33
2	P014	Sticker Holográfico Kitsune #14	Producto generado para inventario académico de Panda Estampados y Kitsune.	prod_69f56fc4a61b44.25791177.jpg	4	4	132.50	203.50	4
3	P015	Taza Sublimada Panda #15	Producto generado para inventario académico de Panda Estampados y Kitsune.	prod_977042d6b3d3bdc28500a0b5.jpg	5	5	136.25	208.75	1
4	P016	Gorra Bordada Negra #16	Producto generado para inventario académico de Panda Estampados y Kitsune.	prod_692cba3e06cd65.71101317.png	6	6	140.00	214.00	36
5	P017	Llavero Acrílico Anime #17	Producto generado para inventario académico de Panda Estampados y Kitsune.	prod_69f56fd3dbc463.93497112.png	7	7	143.75	219.25	37
6	P018	Poster Ilustrado A3 #18	Producto generado para inventario académico de Panda Estampados y Kitsune.	prod_bbf90800dd3fd1f24deb27b4.webp	8	8	147.50	224.50	38
7	P019	Bolso Tote Personalizado #19	Producto generado para inventario académico de Panda Estampados y Kitsune.	prod_692e2130300f13.79885065.jpg	9	9	151.25	229.75	3
8	P020	Mousepad Gamer Estampado #20	Producto generado para inventario académico de Panda Estampados y Kitsune.	prod_69f56fdd0d4ab5.98973422.jpg	10	10	155.00	235.00	40
9	P021	Camiseta Oversize Negra #21	Producto generado para inventario académico de Panda Estampados y Kitsune.	prod_bd9ae845c714f7f64699fb75.jpg	1	1	158.75	240.25	41
10	P022	Camiseta Blanca Personalizada #22	Producto generado para inventario académico de Panda Estampados y Kitsune.	prod_692eb95bbb2083.00268187.gif	2	2	162.50	245.50	1
11	P023	Hoodie Oversize Negro #23	Producto generado para inventario académico de Panda Estampados y Kitsune.	prod_69f56fe7efb784.38860716.jpg	3	3	166.25	250.75	43
12	P024	Sticker Holográfico Kitsune #24	Producto generado para inventario académico de Panda Estampados y Kitsune.	prod_d67e3785273607d89e61a401.png	4	4	170.00	256.00	4
13	P025	Taza Sublimada Panda #25	Producto generado para inventario académico de Panda Estampados y Kitsune.	prod_69ab914e50de9c2ab70f17e2.jpg	5	5	173.75	261.25	45
14	P026	Gorra Bordada Negra #26	Producto generado para inventario académico de Panda Estampados y Kitsune.	prod_69f570ce0de300.86936150.jpg	6	6	177.50	266.50	46
15	P027	Llavero Acrílico Anime #27	Producto generado para inventario académico de Panda Estampados y Kitsune.	prod_e155b0fa66e83067205236e4.jpg	7	7	181.25	271.75	2
16	P028	Poster Ilustrado A3 #28	Producto generado para inventario académico de Panda Estampados y Kitsune.	prod_69f56f68b99380.15585436.jpg	8	8	185.00	277.00	48
17	P029	Bolso Tote Personalizado #29	Producto generado para inventario académico de Panda Estampados y Kitsune.	prod_69f57104731e04.45231154.jpg	9	9	188.75	282.25	49
18	P030	Mousepad Gamer Estampado #30	Producto generado para inventario académico de Panda Estampados y Kitsune.	prod_ee0704d79c323b08c7071c3e.jpg	10	10	192.50	287.50	50
19	P031	Camiseta Oversize Negra #31	Producto generado para inventario académico de Panda Estampados y Kitsune.	prod_69f56f74936e35.57858233.jpg	1	1	196.25	292.75	1
20	P032	Camiseta Blanca Personalizada #32	Producto generado para inventario académico de Panda Estampados y Kitsune.	prod_69f57111237e59.08360337.jpg	2	2	200.00	298.00	52
\.


--
-- Data for Name: proveedor; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.proveedor (id_proveedor, nombre, telefono, email, direccion) FROM stdin;
1	Textiles Managua S.A.	2255-1101	ventas@textilesmanagua.com	Carretera Norte, Managua
2	Serigrafía Central	2266-2304	contacto@serigrafiacentral.com	Altamira, Managua
3	Distribuidora Kitsune	2277-4512	proveedores@kitsunedist.com	Linda Vista, Managua
4	Panda Print Supplies	2288-7821	ventas@pandaprintsupplies.com	Ciudad Jardín, Managua
5	Importadora El Sol	2299-3344	info@importadoraelsol.com	Mercado Oriental, Managua
6	Creativa Nicaragua	2233-9021	creativa@ni.com	Los Robles, Managua
7	Sublimados León	2311-4400	ventas@sublimadosleon.com	Centro, León
8	Artes Gráficas Granada	2552-8820	contacto@artesgranada.com	Calle La Calzada, Granada
9	Materiales Omega	2244-9910	omega@materiales.com	Bolonia, Managua
10	Print House Nicaragua	2270-6543	ventas@printhouseni.com	Villa Fontana, Managua
12	Proveedor Temporal Producto	8888-3030	proveedor.temporal@test.com	Managua
\.


--
-- Data for Name: rol; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.rol (id_rol, nombre) FROM stdin;
1	Administrador
2	Supervisor
3	Facturador
\.


--
-- Data for Name: seccion; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.seccion (id_seccion, nombre) FROM stdin;
1	Panda Estampados
2	Kitsune
\.


--
-- Data for Name: usuario; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.usuario (id_usuario, nombre, email, password, id_rol, id_seccion) FROM stdin;
2	Daniel Pérez	daniel.perez@kitsune.com	$2y$12$q/FLcSnscgAJx5KLw6ZfkeKmqVNjVgsid.NzF1vIA7bFvwqZvrtEm	2	2
3	Jeremy Pérez	jeremy.perez@kitsune.com	$2y$12$9cCSd.m5eccghVDHnx1hZOM1KYPHUzQZsJP3Wx4rVYA6L.zbRLuiK	2	2
4	Jhossep Ramos	jhossep.ramos@kitsune.com	$2y$12$6iu4FfS3vWAN3g0dCpaJH./pq4u2fsOQmujzvPxtcoxX1/VhgmV8W	2	2
5	Diego Torres	diego.torres@kitsune.com	$2y$12$8rYAJPYHfmBYfUsvSQ6JQeYzXY/dfhv5minqtioSOT/OYNpYhKfx2	2	2
6	Carlos Núñez	carlos.nunez@kitsune.com	$2y$12$Wktc.2kJD1t1addvJTy6h.HZsofpoPdinZfkNuQpOzT6x1PdxjcbW	2	2
7	Mónica Larios	monica.larios@kitsune.com	$2y$12$VfV8bO4qFkH5AW42IEEeBebUH2OG8E24/adYxBHpkgNxxbpwpDlKe	2	2
8	Esteban Rodríguez	esteban.rodriguez@kitsune.com	$2y$12$6xrE3MOnkmTmYvQDepNuB.dxG7I2BFg9enlTc2Qu8s0JzmDYVm1ze	2	2
9	Eduardo Molina	eduardo.molina@kitsune.com	$2y$12$NHgiv5ky8RBEP.vlKcDZUeiV2ZjiRENZmcmnS9lWm7NsFl3N8Gqom	2	2
10	Andy Sánchez	andy.sanchez@panda.com	$2y$12$h/WagOY4zymqWqcyccvi7.ikKYZxbFknFzm6bqlEfySGINOBxM5US	3	2
11	Sofía Gómez	sofia.gomez@kitsune.com	$2y$12$hVV/KUpCbUX9EOKMueVA3Ozsdgx4na8c9K.HN7Y2LDB9YpoOuX72a	3	2
12	Luis Torres	luis.torres@panda.com	$2y$12$NMsgDw0o0RgTCGtdX9EY8eyhderZcaV4/VPHZOPYR52NJIrde/8q.	3	2
13	Carla Bermúdez	carla.bermudez@kitsune.com	$2y$12$ZuE7Qa26mz2IlL0hl7CW1u/1KL5Bw.Sx8syeol1a7Xm2LXssw7oC6	3	2
14	Karla Medina	karla.medina@panda.com	$2y$12$D5j0CPjHq4paoSBtFFBCDeFHcAd4Lm9onOQYPM9zBRRDJ3OWN/ml6	3	2
15	Wilmer Ruiz	wilmer.ruiz@kitsune.com	$2y$12$br0QmLjZnqcHE.UzWSpQieJYav6W4Fxqi1s8vrBwQuC0g2q0OSnHi	3	2
16	Miguel Hernández	miguel.hernandez@panda.com	$2y$12$H.Ui0n/1U4Ae32AI.C9bbOfSISzETo2MHFKkZWFot8UrObFuesTQ2	3	2
17	Paola López	paola.lopez@panda.com	$2y$12$FDyaXbpcOqlWn0dIk/XHTumo42ZM1aX1U.XZ5wMHtQ7lQo7LgQMOa	3	2
18	Kevin Castillo	kevin.castillo@panda.com	$2y$12$2kA9hBSf/QPIJuDf90I2luKFTeh95mGZqISMqBIdtIe8oFnbk45H2	3	2
19	María Fernández	maria.fernandez@kitsune.com	$2y$12$c1izNLMr5EpE1qhi4qB67evlAxuc8EDdQK09lFcoJzUeNdt0RoWTm	3	2
20	Josefina Rivas	josefina.rivas@kitsune.com	$2y$12$UBJcyEORA9eFtgMVbFqu3u327RnKP1PkiA2Fd.XmA.rKom1FrDISG	3	2
21	Roberto Gutiérrez	roberto.gutierrez@kitsune.com	$2y$12$.PixiEX1MN9hves7DgCE1eUm3vsLz04Mqdd35rzbPX8yFCLEqOpzG	3	2
22	Lucía Herrera	lucia.herrera@kitsune.com	$2y$12$zmQ8NBBVOrw.aO2Umt.hNumWlPWAJ2aA1PxMlz/A0I.jT6o6tl2Rq	3	2
23	Brandon Morales	brandon.morales@kitsune.com	$2y$12$xuhd3.8.x3E4ZKo9nh0yZev8bIXCxd1aDhzlhfpD8YcxTfDTBdUf2	3	2
24	Andrea Vega	andrea.vega@panda.com	$2y$12$CBUWv03lSPKoAbh6gVnbyO4xlbmSAJW0Tkl.QQWbpPHbj7iumaYoG	3	2
25	Sergio Mairena	sergio.mairena@panda.com	$2y$12$2i1oGVK1n6q9D0Iluy3mnuE.lCulA0tfM1pc09Xc8zHn/zAKLZIdW	3	2
26	Julia Campos	julia.campos@panda.com	$2y$12$F7zrVU53XF1dSiV3F8xcjuJrcXNAXgieRNXAhFXMOyBOeRdZPswoy	3	2
27	Laura Castillo	laura.castillo@admin.pandakitsune.com	$2y$12$.inALdr.Qy5DIq3dSxKjVuPSYFTL20B3VL3orm2BwxSSqwKsM3UkC	1	\N
28	Óscar Mejía	oscar.mejia@admin.pandakitsune.com	$2y$12$n1ZhPkXE/LMCwggOgwtHkus4Lt/XPkpgBDkz.lCdIGTU9.Kt1CV2y	1	\N
29	Carmen Rojas	carmen.rojas@panda.com	$2y$12$PsrYOcMFI9eBZlOJzV9RQOMx7uI9cm.3qqPk1tQYz6jxr2fIqhIjO	3	2
30	Nidia Solís	nidia.solis@kitsune.com	$2y$12$a9PzdMLz8ZNtGEDl6tPxnuMRq2qoYHCh55RlpcCDgC7nGvRxl2D7C	3	2
1	Leonel Messi	leonel.messi@admin.pandakitsune.com	$2y$10$oCDDt/YuxYESRT8888zim.7Mn1AsfYVBXbVOgesp.1CLQuhuBxo2m	1	\N
\.


--
-- Name: auditoria_id_auditoria_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.auditoria_id_auditoria_seq', 46, true);


--
-- Name: categoria_id_categoria_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.categoria_id_categoria_seq', 12, true);


--
-- Name: cliente_id_cliente_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.cliente_id_cliente_seq', 20, true);


--
-- Name: compra_id_compra_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.compra_id_compra_seq', 20, true);


--
-- Name: detallecompra_id_detalle_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.detallecompra_id_detalle_seq', 20, true);


--
-- Name: detallefactura_id_detalle_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.detallefactura_id_detalle_seq', 20, true);


--
-- Name: factura_estado_historial_id_historial_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.factura_estado_historial_id_historial_seq', 20, true);


--
-- Name: factura_id_factura_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.factura_id_factura_seq', 20, true);


--
-- Name: producto_id_producto_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.producto_id_producto_seq', 20, true);


--
-- Name: proveedor_id_proveedor_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.proveedor_id_proveedor_seq', 12, true);


--
-- Name: rol_id_rol_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.rol_id_rol_seq', 9, true);


--
-- Name: seccion_id_seccion_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.seccion_id_seccion_seq', 8, true);


--
-- Name: usuario_id_usuario_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.usuario_id_usuario_seq', 36, true);


--
-- Name: auditoria auditoria_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.auditoria
    ADD CONSTRAINT auditoria_pkey PRIMARY KEY (id_auditoria);


--
-- Name: categoria categoria_nombre_key; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.categoria
    ADD CONSTRAINT categoria_nombre_key UNIQUE (nombre);


--
-- Name: categoria categoria_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.categoria
    ADD CONSTRAINT categoria_pkey PRIMARY KEY (id_categoria);


--
-- Name: cliente cliente_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.cliente
    ADD CONSTRAINT cliente_pkey PRIMARY KEY (id_cliente);


--
-- Name: compra compra_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.compra
    ADD CONSTRAINT compra_pkey PRIMARY KEY (id_compra);


--
-- Name: detallecompra detallecompra_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.detallecompra
    ADD CONSTRAINT detallecompra_pkey PRIMARY KEY (id_detalle);


--
-- Name: detallefactura detallefactura_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.detallefactura
    ADD CONSTRAINT detallefactura_pkey PRIMARY KEY (id_detalle);


--
-- Name: factura_estado_historial factura_estado_historial_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.factura_estado_historial
    ADD CONSTRAINT factura_estado_historial_pkey PRIMARY KEY (id_historial);


--
-- Name: factura factura_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.factura
    ADD CONSTRAINT factura_pkey PRIMARY KEY (id_factura);


--
-- Name: producto producto_codigo_key; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.producto
    ADD CONSTRAINT producto_codigo_key UNIQUE (codigo);


--
-- Name: producto producto_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.producto
    ADD CONSTRAINT producto_pkey PRIMARY KEY (id_producto);


--
-- Name: proveedor proveedor_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.proveedor
    ADD CONSTRAINT proveedor_pkey PRIMARY KEY (id_proveedor);


--
-- Name: rol rol_nombre_key; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.rol
    ADD CONSTRAINT rol_nombre_key UNIQUE (nombre);


--
-- Name: rol rol_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.rol
    ADD CONSTRAINT rol_pkey PRIMARY KEY (id_rol);


--
-- Name: seccion seccion_nombre_key; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.seccion
    ADD CONSTRAINT seccion_nombre_key UNIQUE (nombre);


--
-- Name: seccion seccion_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.seccion
    ADD CONSTRAINT seccion_pkey PRIMARY KEY (id_seccion);


--
-- Name: usuario usuario_email_key; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.usuario
    ADD CONSTRAINT usuario_email_key UNIQUE (email);


--
-- Name: usuario usuario_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.usuario
    ADD CONSTRAINT usuario_pkey PRIMARY KEY (id_usuario);


--
-- Name: idx_auditoria_accion_fecha; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_auditoria_accion_fecha ON public.auditoria USING btree (accion, fecha DESC);


--
-- Name: idx_auditoria_datos_anteriores_gin; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_auditoria_datos_anteriores_gin ON public.auditoria USING gin (datos_anteriores);


--
-- Name: idx_auditoria_registro_id; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_auditoria_registro_id ON public.auditoria USING btree (registro_id);


--
-- Name: idx_auditoria_tabla_afectada; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_auditoria_tabla_afectada ON public.auditoria USING btree (tabla_afectada);


--
-- Name: idx_factura_estado_historial_factura; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_factura_estado_historial_factura ON public.factura_estado_historial USING btree (id_factura);


--
-- Name: categoria trg_auditar_delete_categoria; Type: TRIGGER; Schema: public; Owner: -
--

CREATE TRIGGER trg_auditar_delete_categoria AFTER DELETE ON public.categoria FOR EACH ROW EXECUTE FUNCTION public.fn_auditar_delete_generico();


--
-- Name: cliente trg_auditar_delete_cliente; Type: TRIGGER; Schema: public; Owner: -
--

CREATE TRIGGER trg_auditar_delete_cliente AFTER DELETE ON public.cliente FOR EACH ROW EXECUTE FUNCTION public.fn_auditar_delete_generico();


--
-- Name: producto trg_auditar_delete_producto; Type: TRIGGER; Schema: public; Owner: -
--

CREATE TRIGGER trg_auditar_delete_producto AFTER DELETE ON public.producto FOR EACH ROW EXECUTE FUNCTION public.fn_auditar_delete_generico();


--
-- Name: proveedor trg_auditar_delete_proveedor; Type: TRIGGER; Schema: public; Owner: -
--

CREATE TRIGGER trg_auditar_delete_proveedor AFTER DELETE ON public.proveedor FOR EACH ROW EXECUTE FUNCTION public.fn_auditar_delete_generico();


--
-- Name: factura trg_factura_estado_historial; Type: TRIGGER; Schema: public; Owner: -
--

CREATE TRIGGER trg_factura_estado_historial AFTER INSERT OR UPDATE ON public.factura FOR EACH ROW EXECUTE FUNCTION public.registrar_historial_estado_factura();


--
-- Name: factura_estado_historial factura_estado_historial_id_factura_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.factura_estado_historial
    ADD CONSTRAINT factura_estado_historial_id_factura_fkey FOREIGN KEY (id_factura) REFERENCES public.factura(id_factura) ON DELETE CASCADE;


--
-- Name: auditoria fk_auditoria_usuario; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.auditoria
    ADD CONSTRAINT fk_auditoria_usuario FOREIGN KEY (id_usuario) REFERENCES public.usuario(id_usuario);


--
-- Name: compra fk_compra_proveedor; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.compra
    ADD CONSTRAINT fk_compra_proveedor FOREIGN KEY (id_proveedor) REFERENCES public.proveedor(id_proveedor);


--
-- Name: compra fk_compra_usuario; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.compra
    ADD CONSTRAINT fk_compra_usuario FOREIGN KEY (id_usuario) REFERENCES public.usuario(id_usuario);


--
-- Name: detallecompra fk_detcom_compra; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.detallecompra
    ADD CONSTRAINT fk_detcom_compra FOREIGN KEY (id_compra) REFERENCES public.compra(id_compra);


--
-- Name: detallecompra fk_detcom_producto; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.detallecompra
    ADD CONSTRAINT fk_detcom_producto FOREIGN KEY (id_producto) REFERENCES public.producto(id_producto);


--
-- Name: detallefactura fk_detfac_factura; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.detallefactura
    ADD CONSTRAINT fk_detfac_factura FOREIGN KEY (id_factura) REFERENCES public.factura(id_factura);


--
-- Name: detallefactura fk_detfac_producto; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.detallefactura
    ADD CONSTRAINT fk_detfac_producto FOREIGN KEY (id_producto) REFERENCES public.producto(id_producto);


--
-- Name: factura fk_factura_cliente; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.factura
    ADD CONSTRAINT fk_factura_cliente FOREIGN KEY (id_cliente) REFERENCES public.cliente(id_cliente);


--
-- Name: factura fk_factura_seccion; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.factura
    ADD CONSTRAINT fk_factura_seccion FOREIGN KEY (id_seccion) REFERENCES public.seccion(id_seccion);


--
-- Name: factura fk_factura_usuario; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.factura
    ADD CONSTRAINT fk_factura_usuario FOREIGN KEY (id_usuario) REFERENCES public.usuario(id_usuario);


--
-- Name: producto fk_producto_categoria; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.producto
    ADD CONSTRAINT fk_producto_categoria FOREIGN KEY (id_categoria) REFERENCES public.categoria(id_categoria);


--
-- Name: producto fk_producto_proveedor; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.producto
    ADD CONSTRAINT fk_producto_proveedor FOREIGN KEY (id_proveedor) REFERENCES public.proveedor(id_proveedor);


--
-- Name: usuario fk_usuario_rol; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.usuario
    ADD CONSTRAINT fk_usuario_rol FOREIGN KEY (id_rol) REFERENCES public.rol(id_rol);


--
-- Name: usuario fk_usuario_seccion; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.usuario
    ADD CONSTRAINT fk_usuario_seccion FOREIGN KEY (id_seccion) REFERENCES public.seccion(id_seccion);


--
-- PostgreSQL database dump complete
--

-- =========================================================
-- SEED DATA: Datos completos para dashboard y pruebas
-- Solo inserta si las tablas estan vacias
-- =========================================================
SET search_path TO public;

BEGIN;

-- Secciones
INSERT INTO seccion (id_seccion, nombre)
SELECT 1, 'Panda Estampados' WHERE NOT EXISTS (SELECT 1 FROM seccion);
INSERT INTO seccion (id_seccion, nombre)
SELECT 2, 'Kitsune' WHERE NOT EXISTS (SELECT 1 FROM seccion WHERE id_seccion = 2);
SELECT setval('seccion_id_seccion_seq', (SELECT COALESCE(MAX(id_seccion), 2) FROM seccion));

-- Categorias
INSERT INTO categoria (nombre)
SELECT v.nombre FROM (VALUES
    ('Camisetas'), ('Hoodies'), ('Stickers'), ('Tazas'), ('Gorras'),
    ('Llaveros'), ('Posters'), ('Bolsos'), ('Mousepads'), ('Accesorios personalizados')
) AS v(nombre)
WHERE NOT EXISTS (SELECT 1 FROM categoria LIMIT 1);

-- Proveedores
INSERT INTO proveedor (nombre, telefono, direccion, email)
SELECT v.nombre, v.telefono, v.direccion, v.email FROM (VALUES
    ('Distribuidora Norte', '2255-1001', 'Managua, Barrio Martha Quezada', 'norte@proveedor.com'),
    ('Importadora Central', '2255-1002', 'Managua, Villa Libertad', 'central@proveedor.com'),
    ('Suministros del Sur', '2255-1003', 'Masaya, 2da Calle', 'sur@proveedor.com')
) AS v(nombre, telefono, direccion, email)
WHERE NOT EXISTS (SELECT 1 FROM proveedor LIMIT 1);

-- Productos (precios en C$)
INSERT INTO producto (codigo, nombre, descripcion, precio_compra, precio_venta, stock, id_categoria, id_proveedor)
SELECT v.codigo, v.nombre, v.descripcion, v.pc, v.pv, v.stock, v.cat, v.prov FROM (VALUES
    ('PAN-CAM-001', 'Camiseta Panda Basica', 'Camiseta 100% algodon estampa panda', 120.00, 250.00, 50, 1, 1),
    ('PAN-CAM-002', 'Camiseta Kitsune Edition', 'Camiseta premium estampa zorro', 150.00, 320.00, 35, 1, 1),
    ('PAN-HOO-001', 'Hoodie Panda Negro', 'Hoodie negro con logo panda bordado', 280.00, 550.00, 20, 2, 2),
    ('PAN-HOO-002', 'Hoodie Kitsune Rojo', 'Hoodie rojo con logo kitsune', 300.00, 600.00, 15, 2, 2),
    ('PAN-STI-001', 'Sticker Panda Pack x10', 'Pack de 10 stickers panda variados', 30.00, 80.00, 100, 3, 3),
    ('PAN-STI-002', 'Sticker Kitsune Pack x10', 'Pack de 10 stickers kitsune variados', 30.00, 80.00, 80, 3, 3),
    ('PAN-TAZ-001', 'Taza Panda Ceramic', 'Taza ceramica 350ml estampa panda', 60.00, 150.00, 40, 4, 1),
    ('PAN-TAZ-002', 'Taza Kitsune Ceramic', 'Taza ceramica 350ml estampa kitsune', 60.00, 150.00, 35, 4, 1),
    ('PAN-GOR-001', 'Gorra Panda Trucker', 'Gorra trucker bordado panda', 80.00, 180.00, 25, 5, 2),
    ('PAN-GOR-002', 'Gorra Kitsune Snapback', 'Gorra snapbacklogo kitsune', 85.00, 190.00, 20, 5, 2),
    ('PAN-LLA-001', 'Llavero Panda Metal', 'Llavero metalico panda 4cm', 25.00, 65.00, 60, 6, 3),
    ('PAN-LLA-002', 'Llavero Kitsune Metal', 'Llavero metalico kitsune 4cm', 25.00, 65.00, 55, 6, 3),
    ('PAN-POS-001', 'Poster Panda A3', 'Poster arte digital panda A3', 35.00, 90.00, 30, 7, 1),
    ('PAN-POS-002', 'Poster Kitsune A3', 'Poster arte digital kitsune A3', 35.00, 90.00, 28, 7, 1),
    ('PAN-BOL-001', 'Bolso Panda Canvas', 'Bolso canvas estampa panda', 90.00, 200.00, 18, 8, 2),
    ('PAN-MOU-001', 'Mousepad Panda XL', 'Mousepad XXL estampa panda 900x400mm', 70.00, 160.00, 22, 9, 3),
    ('PAN-MOU-002', 'Mousepad Kitsune XL', 'Mousepad XXL estampa kitsune 900x400mm', 70.00, 160.00, 20, 9, 3),
    ('PAN-PIN-001', 'Pin Panda Durosedoso', 'Pin acrilico panda 3cm', 15.00, 45.00, 70, 10, 1),
    ('PAN-PIN-002', 'Pin Kitsune Durosedoso', 'Pin acrilico kitsune 3cm', 15.00, 45.00, 65, 10, 1),
    ('PAN-CAM-003', 'Camiseta Personalizada', 'Camiseta personalizada impresion DTG', 180.00, 400.00, 10, 1, 1)
) AS v(codigo, nombre, descripcion, pc, pv, stock, cat, prov)
WHERE NOT EXISTS (SELECT 1 FROM producto LIMIT 1);

-- Clientes
INSERT INTO cliente (nombres, apellidos, telefono, direccion, identificacion, tipo_cliente)
SELECT v.n, v.a, v.t, v.d, v.i, v.tipo FROM (VALUES
    ('Carlos', 'Mendoza', '8888-1001', 'Managua, Bello Horizonte', '001-010185-0001A', 'Mayorista'),
    ('Maria', 'Gonzalez', '8888-1002', 'Managua, Los Vanegas', '001-020290-0002B', 'Detallista'),
    ('Jose', 'Ramirez', '8888-1003', 'Masaya, Centro', '001-030388-0003C', 'Detallista'),
    ('Lucia', 'Perez', '8888-1004', 'Granada, Parque Central', '001-040492-0004D', 'Mayorista'),
    ('Pedro', 'Martinez', '8888-1005', 'Leon, Universidad', '001-050587-0005E', 'Detallista'),
    ('Ana', 'Lopez', '8888-1006', 'Managua, Reparto San Juan', '001-060695-0006F', 'Detallista'),
    ('Roberto', 'Hernandez', '8888-1007', 'Matagalpa, Centro', '001-070783-0007G', 'Mayorista'),
    ('Laura', 'Castillo', '8888-1008', 'Chinandega, 1a Calle', '001-080891-0008H', 'Detallista'),
    ('Miguel', 'Ortega', '8888-1009', 'Juigalpa, Principal', '001-090986-0009I', 'Detallista'),
    ('Sofia', 'Ramirez', '8888-1010', 'Bluefields, Costera', '001-101094-0010J', 'Mayorista')
) AS v(n, a, t, d, i, tipo)
WHERE NOT EXISTS (SELECT 1 FROM cliente LIMIT 1);

-- Usuarios (admin ya existe, crear solo si la tabla esta vacia)
INSERT INTO usuario (nombre, email, password, id_rol, id_seccion)
SELECT v.nombre, v.email, v.pass, v.rol, v.sec FROM (VALUES
    ('Leonel Messi', 'leonel.messi@admin.pandakitsune.com', '$2y$12$x3m7SHevHbXLXNX2100ER.NRfv3QXFtUIu3GxcaRt7DfF3UkrOp9O', 1, NULL),
    ('Supervisor Panda', 'supervisor@pandakitsune.com', '$2y$12$x3m7SHevHbXLXNX2100ER.NRfv3QXFtUIu3GxcaRt7DfF3UkrOp9O', 2, 1),
    ('Facturador Uno', 'facturador@pandakitsune.com', '$2y$12$x3m7SHevHbXLXNX2100ER.NRfv3QXFtUIu3GxcaRt7DfF3UkrOp9O', 3, 1)
) AS v(nombre, email, pass, rol, sec)
WHERE NOT EXISTS (SELECT 1 FROM usuario LIMIT 1);

-- Disable trigger during seed updates to avoid extra historial entries
ALTER TABLE factura DISABLE TRIGGER trg_factura_estado_historial;

-- Recalcular totales de facturas desde detallefactura
UPDATE factura f
SET
    subtotal = COALESCE((
        SELECT SUM(df.total_linea)
        FROM detallefactura df
        WHERE df.id_factura = f.id_factura
    ), 0),
    impuesto = ROUND(COALESCE((
        SELECT SUM(df.total_linea)
        FROM detallefactura df
        WHERE df.id_factura = f.id_factura
    ), 0) * 0.15, 2),
    total = ROUND(COALESCE((
        SELECT SUM(df.total_linea)
        FROM detallefactura df
        WHERE df.id_factura = f.id_factura
    ), 0) * 1.15, 2);

-- Calcular pagos y estados
UPDATE factura f
SET
    monto_pagado = CASE
        WHEN f.id_factura % 3 = 0 THEN f.total
        WHEN f.id_factura % 3 = 1 THEN ROUND(f.total * 0.5, 2)
        ELSE 0
    END,
    saldo_pendiente = CASE
        WHEN f.id_factura % 3 = 0 THEN 0
        WHEN f.id_factura % 3 = 1 THEN ROUND(f.total * 0.5, 2)
        ELSE f.total
    END,
    porcentaje_pagado = CASE
        WHEN f.total = 0 THEN 0
        WHEN f.id_factura % 3 = 0 THEN 100.00
        WHEN f.id_factura % 3 = 1 THEN 50.00
        ELSE 0.00
    END,
    estado_pago = CASE
        WHEN f.id_factura % 3 = 0 THEN 'Pagado'
        WHEN f.id_factura % 3 = 1 THEN 'Parcial'
        ELSE 'Pendiente'
    END,
    estado_produccion = CASE
        WHEN f.id_factura % 5 = 0 THEN 'Entregada'
        WHEN f.id_factura % 5 = 1 THEN 'Lista para entregar'
        WHEN f.id_factura % 5 = 2 THEN 'En producción'
        ELSE 'Pendiente'
    END;

COMMIT;

-- Re-enable triggers
ALTER TABLE factura ENABLE TRIGGER trg_factura_estado_historial;

-- Reset sequences to correct values after seed
SELECT setval('public.factura_id_factura_seq', (SELECT COALESCE(MAX(id_factura), 1) FROM factura));
SELECT setval('public.detallefactura_id_detalle_seq', (SELECT COALESCE(MAX(id_detalle), 1) FROM detallefactura));
SELECT setval('public.factura_estado_historial_id_historial_seq', (SELECT COALESCE(MAX(id_historial), 1) FROM factura_estado_historial));
SELECT setval('public.producto_id_producto_seq', (SELECT COALESCE(MAX(id_producto), 1) FROM producto));
SELECT setval('public.categoria_id_categoria_seq', (SELECT COALESCE(MAX(id_categoria), 1) FROM categoria));
SELECT setval('public.proveedor_id_proveedor_seq', (SELECT COALESCE(MAX(id_proveedor), 1) FROM proveedor));
SELECT setval('public.cliente_id_cliente_seq', (SELECT COALESCE(MAX(id_cliente), 1) FROM cliente));
SELECT setval('public.usuario_id_usuario_seq', (SELECT COALESCE(MAX(id_usuario), 1) FROM usuario));
SELECT setval('public.compra_id_compra_seq', (SELECT COALESCE(MAX(id_compra), 1) FROM compra));
SELECT setval('public.detallecompra_id_detalle_seq', (SELECT COALESCE(MAX(id_detalle), 1) FROM detallecompra));

-- ============================================================================
-- Recalcular fechas de facturas para que estén dentro de los últimos 30 días
-- Esto asegura que la gráfica del dashboard muestre datos actualizados
-- cada vez que se ejecuta setup.sh
-- ============================================================================
DO $$
DECLARE
    max_fecha DATE;
    offset_dias INTEGER;
BEGIN
    -- Encontrar la fecha más reciente de las facturas seed
    SELECT MAX(fecha::date) INTO max_fecha FROM factura;

    -- Calcular cuántos días hay que retroceder para que la más reciente sea hoy - 2
    offset_dias := (CURRENT_DATE - interval '2 days')::date - max_fecha;

    -- Solo ajustar si el offset es positivo (las fechas están en el pasado)
    IF offset_dias > 0 THEN
        -- Actualizar fechas de facturas
        UPDATE factura SET
            fecha = fecha + make_interval(days => offset_dias),
            fecha_orden_produccion = fecha_orden_produccion + make_interval(days => offset_dias),
            fecha_entrega_estimada = fecha_entrega_estimada + make_interval(days => offset_dias),
            fecha_entrega_real = CASE
                WHEN fecha_entrega_real IS NOT NULL
                THEN fecha_entrega_real + make_interval(days => offset_dias)
                ELSE NULL
            END;

        -- Actualizar fechas en el historial de estados
        UPDATE factura_estado_historial SET
            fecha_evento = fecha_evento + make_interval(days => offset_dias),
            fecha_entrega_estimada_anterior = CASE
                WHEN fecha_entrega_estimada_anterior IS NOT NULL
                THEN fecha_entrega_estimada_anterior + make_interval(days => offset_dias)
                ELSE NULL
            END,
            fecha_entrega_estimada_nueva = CASE
                WHEN fecha_entrega_estimada_nueva IS NOT NULL
                THEN fecha_entrega_estimada_nueva + make_interval(days => offset_dias)
                ELSE NULL
            END;

        RAISE NOTICE 'Fechas de facturas ajustadas en % días para mostrar datos recientes.', offset_dias;
    END IF;
END
$$;

\unrestrict V5NevU0EBVHxMwc8Gie6sxI6SNUjy50UZHb49fCN6zZwXSZW0RMbbgEd4tR1cgg

