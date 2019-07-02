! function(e) {
    var a = {};

    function t(n) {
        if (a[n]) return a[n].exports;
        var r = a[n] = {
            i: n,
            l: !1,
            exports: {}
        };
        return e[n].call(r.exports, r, r.exports, t), r.l = !0, r.exports
    }
    t.m = e, t.c = a, t.d = function(e, a, n) {
        t.o(e, a) || Object.defineProperty(e, a, {
            configurable: !1,
            enumerable: !0,
            get: n
        })
    }, t.n = function(e) {
        var a = e && e.__esModule ? function() {
            return e.default
        } : function() {
            return e
        };
        return t.d(a, "a", a), a
    }, t.o = function(e, a) {
        return Object.prototype.hasOwnProperty.call(e, a)
    }, t.p = "/", t(t.s = 14)
}({
    14: function(e, a, t) {
        e.exports = t(15)
    },
    15: function(e, a) {
        ! function() {
            $("#table_kardex").DataTable({
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
                ajax: public_path + "admin/datatable/kardex?estudiante_id=" + $("#estudiante_id").val(),
                columns: [{
                    data: "codigo",
                    name: "codigo"
                }, {
                    data: "asignatura",
                    name: "asignatura"
                }, {
                    data: "calificacion",
                    name: "calificacion"
                }, {
                    data: "oportunidad",
                    name: "oportunidad"
                }, {
                    data: "semestre",
                    name: "semestre"
                }, {
                    data: "periodo",
                    name: "periodo"
                }, {
                    data: "anio",
                    name: "anio"
                }],
                order: [4, "asc"]
            });
            $("select[name$='table_kardex_length']").val("10"), $("select[name$='table_kardex_length']").material_select()
        }()
    }
});