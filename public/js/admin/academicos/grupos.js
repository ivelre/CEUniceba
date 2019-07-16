! function(e) {
	var a = {};

	function t(r) {
		if (a[r]) return a[r].exports;
		var i = a[r] = {
			i: r,
			l: !1,
			exports: {}
		};
		return e[r].call(i.exports, i, i.exports, t), i.l = !0, i.exports
	}
	t.m = e, t.c = a, t.d = function(e, a, r) {
		t.o(e, a) || Object.defineProperty(e, a, {
			configurable: !1,
			enumerable: !0,
			get: r
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
	}, t.p = "/", t(t.s = 8)
}({
	8: function(e, a, t) {
		e.exports = t(9)
	},
	9: function(e, a) {
		var t, r = !1;
		$("select[name$='table_grupo_length']").val("100"), $("select[name$='table_grupo_length']").material_select(),
			function(e, a) {
				
			}("#table_grupo tbody", t), $.validator.setDefaults({
				errorClass: "invalid",
				validClass: "valid",
				errorPlacement: function(e, a) {
					$(a).closest("form").find("label[for='" + a.attr("id") + "']").attr("data-error", e.text())
				}
			}), $("#matricula").bind("enterKey", function(e) {
				r || (json = {
					requisitos: 1,
					matricula: $("#matricula").val(),
					especialidad_id: $("#especialidad_id").val(),
					clase_id: $("#clase_id").val()
				}, $.get(public_path + "admin/academicos/estudiante", json, function(e) {
					($("#estudiante_id").val(e.estudiante_id), $("#nombre").val(e.nombre), $("#semestre").val(e.semestre), $("#oportunidad").val(e.oportunidad), $("#oportunidad_id").val(e.oportunidad_id), Materialize.updateTextFields(), r = !0)
				}).fail(function(e) {
					console.log(e)
				}))
			}), $("#matricula").keyup(function(e) {
				13 == e.keyCode && $(this).trigger("enterKey")
			});
		$("#form_grupo").validate({
			rules: {
				clase_id: {
					required: !0,
					digits: !0,
					min: 1
				},
				estudiante_id: {
					required: !0,
					digits: !0,
					min: 1
				},
				oportunidad_id: {
					required: !0,
					digits: !0,
					min: 1
				}
			},
			messages: {
				clase_id: {
					required: "La clase es requerida.",
					digits: "La clase tiene que ser un número entero.",
					min: "La clase mínima es 1."
				},
				estudiante_id: {
					required: "El estudiante es requerido.",
					digits: "El estudiante tiene que ser un número entero.",
					min: "El estudiante mínimos es 1."
				},
				oportunidad_id: {
					required: "La oportunidad es requerida.",
					digits: "La oportunidad tiene que ser un número entero.",
					min: "La oportunidad mínima es 1."
				}
			},
			submitHandler: function(e) {
				r && (json = {
					requisitos: 1,
					clase_id: $("#clase_id").val(),
					estudiante_id: $("#estudiante_id").val(),
					oportunidad_id: $("#oportunidad_id").val()
				}, function(e) {
					e.oportunidad_id = $("#oportunidad").val()
					// console.log(e);
					$.post(public_path + "admin/academicos/grupos", e, function(e) {
						$("#matricula").val(""), $("#nombre").val(""), $("#semestre").val(""), $("#oportunidad").val(""), $("#estudiante_id").val(""), $("#oportunidad_id").val(""), Materialize.updateTextFields(), Swal.fire({
							type: "success",
							title: "El alumno ha sido agregado",
							showConfirmButton: !1,
							timer: 1500
						}), r = !1
						location.reload();
					}).fail(function(e) {
						if (void 0 != e.responseJSON.errors) {
							var a = e.responseJSON.errors;
							for (var t in a) $("label[for='" + t + "']").attr("data-error", a[t]), $("#" + t).addClass("invalid");
							a.requisitos && Swal.fire({
								type: "error",
								title: "Error",
								text: a.requisitos[0]
							})
						}
					})
				}(json))
			}
		})
	}
});