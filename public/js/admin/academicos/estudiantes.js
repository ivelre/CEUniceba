! function(e) {
    var a = {};

    function r(t) {
        if (a[t]) return a[t].exports;
        var n = a[t] = {
            i: t,
            l: !1,
            exports: {}
        };
        return e[t].call(n.exports, n, n.exports, r), n.l = !0, n.exports
    }
    r.m = e, r.c = a, r.d = function(e, a, t) {
        r.o(e, a) || Object.defineProperty(e, a, {
            configurable: !1,
            enumerable: !0,
            get: t
        })
    }, r.n = function(e) {
        var a = e && e.__esModule ? function() {
            return e.default
        } : function() {
            return e
        };
        return r.d(a, "a", a), a
    }, r.o = function(e, a) {
        return Object.prototype.hasOwnProperty.call(e, a)
    }, r.p = "/", r(r.s = 10)
}({
    10: function(e, a, r) {
        e.exports = r(11)
    },
    11: function(e, a) {
        ! function() {
            $("#table_estudiantes").DataTable({
                language: {
                    sProcessing: "Procesando...",
                    sLengthMenu: "Mostrar _MENU_ registros",
                    sZeroRecords: "No se encontraron resultados",
                    sEmptyTable: "Ningún dato disponible en esta tabla",
                    sInfo: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    sInfoEmpty: "Mostrando registros del 0 al 0 de un total de 0 registros",
                    sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
                    sInfoPostFix: "",
                    sSearch: "Buscar:",
                    sUrl: "",
                    sInfoThousands: ",",
                    sLoadingRecords: "Cargando...",
                    oPaginate: {
                        sFirst: "Primero",
                        sLast: "Último",
                        sNext: "Siguiente",
                        sPrevious: "Anterior"
                    },
                    oAria: {
                        sSortAscending: ": Activar para ordenar la columna de manera ascendente",
                        sSortDescending: ": Activar para ordenar la columna de manera descendente"
                    }
                },
                destroy: !0,
                processing: !0,
                serverSide: !0,
                scrollX: !0,
                ajax: public_path + "admin/datatable/estudiantes",
                columns: [{
                    data: "matricula",
                    name: "matricula"
                }, {
                    data: "nombre",
                    render: function(e, a, r, t) {
                        var color = '#000'
                        if( r.estado_estudiante == 'Ac' || 
                            r.estado_estudiante == 'Bd' || 
                            r.estado_estudiante == 'Co' || 
                            r.estado_estudiante == 'Eg' || 
                            r.estado_estudiante == 'Nr' || 
                            r.estado_estudiante == 'Pe')
                            color ='#D90000'
                        if( r.estado_estudiante == 'Ad')
                            color = '#47A51F'
                        return '<p style="color:' + color + ';">' + r.nombre + '</p>'
                    }
                }, {
                    data: "especialidad",
                    name: "especialidad"
                }, {
                    data: "grupo",
                    name: "grupo"
                }, {
                    data: "email",
                    render: function(e, a, r, t) {
                        var n = new Date,
                            o = new Date(r.fecha_nacimiento),
                            s = n.getFullYear() - o.getFullYear();
                        o.setFullYear(n.getFullYear()), n < o && s--;
                        var e = r.direccion + "<br>" + r.telefono_personal + "<br>" + r.email + "<br>" + s + " años";
                        return e
                    }
                }, {
                    data: "modalidad_estudiante",
                    render: function(e, a, r, t) {
                        if (1 == r.empresa_id) var e = "<strong>Modalidad: </strong>" + r.modalidad_estudiante + "<br><strong>Enterado por: </strong>" + r.medio_enterado + "<br><strong>Trabajo: </strong>" + r.empresa + "<br> <strong>Estado: </strong>" + r.estado_estudiante;
                        else var e = "<strong>Modalidad: </strong>" + r.modalidad_estudiante + "<br><strong>Enterado por: </strong>" + r.medio_enterado + "<br><strong>Trabajo: </strong>" + r.empresa + " (" + r.puesto + ")<br> <strong>Estado: </strong>" + r.estado_estudiante;
                        return e
                    }
                }, {
                    data: "estudiante_id",
                    render: function(e, a, r, t) {
                        return '<a href="' + public_path + "admin/academicos/kardex/ver/" + r.matricula + '" class="btn-floating btn-meddium waves-effect waves-light">' +
                        '<i class="material-icons circle red darken-4">format_list_numbered</i></a>' +
                        '<a href="' + public_path + "admin/academicos/estudiantes/" + e + '/pagos" class="btn-floating btn-meddium waves-effect waves-light">' +
                        '<i class="material-icons circle orange">attach_money</i></a>' 
                    },
                    orderable: !1,
                    searchable: !1
                }, {
                    data: "estudiante_id",
                    render: function(e, a, r, t) {
                        return '\n              <a href="' + public_path + "admin/academicos/estudiantes/" + e + '/edit" \n                class="btn-floating btn-meddium waves-effect waves-light">\n                <i class="material-icons circle green">mode_edit</i>\n              </a>'
                    },
                    orderable: !1,
                    searchable: !1
                }]
            });
            $("select").val("10"), $("select").material_select()
        }()
    }
});

var modalCertificado = function(alumno) {
var url = public_path + "admin/pdf/certificado_total/" + alumno + "/" + prompt('Determine el número del certificado');

window.open(url);
}