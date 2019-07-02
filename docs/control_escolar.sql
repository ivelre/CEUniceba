drop view if exists vw_estudiantes;
create view vw_estudiantes
as
	select 
		estudiantes.id as estudiante_id, 
        matricula, 
        concat(apaterno,' ',amaterno,' ',nombre) as nombre,
        grupo,
        concat(
			calle_numero,
            ', ',
            colonia,
            ', ',
            codigo_postal,
            ', ',
            municipio
		) as  direccion,
        telefono_personal,
        email,
        fecha_nacimiento,
        modalidad_estudiante,
        medio_enterado,
        empresa_id,
        empresa,
        puesto
    from estudiantes
		left join datos_generales 			on datos_generales.id 					= estudiantes.dato_general_id
        left join localidades 				on localidades.id 						= datos_generales.localidad_id
        left join municipios 				on municipios.id 						= localidades.municipio_id
        left join modalidades_estudiantes 	on modalidades_estudiantes.id 			= estudiantes.modalidad_id
        left join medios_enterados 			on medios_enterados.id 					= estudiantes.medio_enterado_id
        left join estudiantes_trabajos 		on estudiantes_trabajos.estudiante_id 	= estudiantes.id
        left join empresas 					on empresas.id 							= estudiantes_trabajos.empresa_id;
        
drop view if exists vw_fechas_examenes;
create view vw_fechas_examenes
as
	select
		fechas_examenes.id  as id,
        tipo_examen_id,
        tipo_examen,
        fecha,
        fechas_examenes.descripcion as descripcion,
        periodo_id
	from fechas_examenes
		join tipos_examenes on tipos_examenes.id = fechas_examenes.tipo_examen_id;

select * from vw_fechas_examenes;

drop view if exists vw_especialidades;
create view vw_especialidades
as
	select
		especialidades.id as id,
		nivel_academico_id,
		clave,
        especialidad,
        reconocimiento_oficial,
        fecha_reconocimiento,
        dges,
        especialidades.descripcion as descripcion,
        modalidad_id,
        modalidad_especialidad,
        tipo_plan_especialidad_id,
        tipo_plan_especialidad
    from especialidades
		join niveles_academicos 			on niveles_academicos.id 			= especialidades.nivel_academico_id
        join modalidades_especialidades 	on modalidades_especialidades.id 	= especialidades.modalidad_id
        join tipos_planes_especialidades 	on tipos_planes_especialidades.id 	= especialidades.tipo_plan_especialidad_id;

select * from vw_especialidades;

drop view if exists vw_docentes;
create view vw_docentes 
as
	select 
		docentes.id as docente_id,
        codigo,
        nombre,
        apaterno,
        amaterno,
        fecha_nacimiento,
        telefono_casa,
        rfc,
        titulo
    from docentes
		join datos_generales 	on datos_generales.id 	= docentes.dato_general_id
        join titulos			on titulos.id 			= docentes.titulo_id;
select * from vw_docentes;


drop view if exists vw_clases;
create view vw_clases 
as
	select 
		clases.id as clase_id,
		asignaturas.codigo,
        clases.clase,
        asignaturas.asignatura ,
        concat(datos_generales.nombre,' ',datos_generales.apaterno,' ',datos_generales.amaterno) as docente,
        clases.periodo_id,
        clases.especialidad_id
    from clases
        join asignaturas 		on asignaturas.id 		= clases.asignatura_id
        join docentes 			on docentes.id 			= clases.docente_id
        join datos_generales 	on datos_generales.id 	= docentes.dato_general_id
	order by clases.especialidad_id,clases.periodo_id,asignaturas.codigo,clases.clase;

select * from vw_clases;

drop view if exists vw_kardex;
create view vw_kardex 
as
	select 
		asignaturas.codigo,
        asignaturas.asignatura,
        kardexs.calificacion,
        oportunidades.oportunidad,
        kardexs.semestre,
        periodos.periodo,
        periodos.anio,
        kardexs.estudiante_id
    from kardexs
        join asignaturas 	on asignaturas.id 		= kardexs.asignatura_id
        join oportunidades 	on oportunidades.id 	= kardexs.oportunidad_id
        join periodos 		on periodos.id 			= kardexs.periodo_id
	order by kardexs.semestre asc;
select * from vw_kardex;

drop view if exists vw_grupos;
create view vw_grupos 
as
	select 
		grupos.id as grupo_id,
		estudiantes.matricula,
        concat(datos_generales.nombre,' ',datos_generales.apaterno,' ',datos_generales.amaterno) as nombre,
        estudiantes.semestre,
        oportunidades.oportunidad,
        grupos.clase_id
    from grupos
        join estudiantes		on estudiantes.id  		= grupos.estudiante_id
        join datos_generales	on datos_generales.id	= estudiantes.dato_general_id
        join oportunidades		on oportunidades.id		= grupos.oportunidad_id;
select * from vw_grupos;