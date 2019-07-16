<nav>
	<div class="nav-wrapper blue darken-2">
		<a href="/test-controlescolar" class="brand-logo" style="height: 90%;">
      <img src="{{ asset('/') }}images/buo-blanco.png" alt="" class="responsive-img" style="height: 100%" >
    </a>
		<ul id="nav-mobile" class="right hide-on-med-and-down">
			<li><a href="{{ route('importar') }}" class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="Importar"><i class="material-icons">get_app</i></a></li>
			<li><a href="{{ route('caja') }}" class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="Caja"><i class="material-icons">attach_money</i></a></li>
			<li><a href="{{ route('reportesCaja') }}" class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="Reportes"><i class="material-icons">show_chart</i></a></li>
			<li><a href="{{ route('logout') }}" class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="Salir"><i class="material-icons">power_settings_new</i></a></li>
		</ul>
	</div>
</nav>