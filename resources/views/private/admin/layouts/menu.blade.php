<ul id="dropdown_academicos" class="dropdown-content">
  <li><a href="{{ route('estudiantes.index') }}" class="blue-text text-darken-2" ><i class="material-icons blue-text text-darken-2">school</i>Estudiantes</a></li>
  <li><a href="{{ route('docentes.index') }}" class="blue-text text-darken-2" ><i class="material-icons blue-text text-darken-2">work</i>Docentes</a></li>
  <li><a href="{{ route('clases.index') }}" class="blue-text text-darken-2" ><i class="material-icons blue-text text-darken-2">import_contacts</i>Clases</a></li>
</ul>

<ul id="dropdown_escolares" class="dropdown-content">
  <li><a href="{{ route('asignaturas.index') }}" class="blue-text text-darken-2" ><i class="material-icons blue-text text-darken-2">create</i>Asignaturas</a></li>
  <li><a href="{{ route('periodos.index') }}" class="blue-text text-darken-2" ><i class="material-icons blue-text text-darken-2">date_range</i>Periodos</a></li>
  <li><a href="{{ route('especialidades.index') }}" class="blue-text text-darken-2" ><i class="material-icons blue-text text-darken-2">build</i>Especialidades</a></li>
</ul>

<ul id="dropdown_configuraciones" class="dropdown-content">
  <li><a href="{{ route('estados_estudiantes.index') }}" class="blue-text text-darken-2" ><i class="material-icons blue-text text-darken-2">school</i>Estados de estudiante</a></li>
  <li><a href="{{ route('titulos_docentes.index') }}" class="blue-text text-darken-2" ><i class="material-icons blue-text text-darken-2">work</i>Títulos de profesor</a></li>
  <li><a href="#!" class="blue-text text-darken-2" ><i class="material-icons blue-text text-darken-2">build</i>Especialidades</a></li>
  <li><a href="{{ route('tipos_examenes.index') }}" class="blue-text text-darken-2" ><i class="material-icons blue-text text-darken-2">description</i>Tipos de exámenes</a></li>
  <li><a href="{{ route('oportunidades.index') }}" class="blue-text text-darken-2" ><i class="material-icons blue-text text-darken-2">autorenew</i>Oportunidades de clase</a></li>
  <li><a href="{{ route('niveles_academicos.index') }}" class="blue-text text-darken-2" ><i class="material-icons blue-text text-darken-2">class</i>Niveles y grados</a></li>
</ul>

<div class="navbar-fixed">
  <nav>
    <div class="nav-wrapper blue darken-2">
      <a href="/test-controlescolar" class="brand-logo" style="height: 90%;">
        <img src="{{ asset('/') }}images/buo-blanco.png" alt="" class="responsive-img" style="height: 100%" >
      </a>
      <a href="#" data-activates="mobile_menu" class="button-collapse"><i class="material-icons">menu</i></a>    
      <ul class="right hide-on-med-and-down">
        <li>
          <a href="#!" class="dropdown-button tooltipped" data-activates="dropdown_academicos" data-position="bottom" data-tooltip="Académicos">
            <i class="material-icons">school</i>
          </a>
        </li>
        <li>
          <a href="#!" class="dropdown-button tooltipped" data-activates="dropdown_escolares" data-position="bottom" data-tooltip="Escolares">
            <i class="material-icons">location_city</i>
          </a>
        </li>
        <li>
          <a href="#!" class="dropdown-button tooltipped" data-activates="dropdown_configuraciones" data-position="bottom" data-tooltip="Configuraciones">
            <i class="material-icons">settings</i>
          </a>
        </li>
        <li>
          <a href="{{route('logout')}}" class="tooltipped" data-position="bottom" data-tooltip="Salir">
            <i class="material-icons">power_settings_new</i>
          </a>
        </li>
      </ul>
    </div>
  </nav>
</div>

<ul class="side-nav" id="mobile_menu">
  <li><div class="user-view">
    <div class="background blue darken-2">
      <!-- <img src="images/office.jpg"> -->
    </div>
    <a href="#!user"><i class="medium material-icons white-text">account_circle</i></a>
    <a href="#!name"><span class="white-text name">Administrador</span></a>
    <a href="#!email"><span class="white-text email">{{ \Session::get('usuario')->email }}</span></a>
    </div>
  </li>
  <ul class="collapsible">
    <li>
      <div class="collapsible-header"><i class="material-icons">school</i>Académicos</a></div>
      <div class="collapsible-body">
        <ul>
          <li><a href="{{ route('estudiantes.index') }}"><i class="material-icons blue-text text-darken-2">school</i>Estudiantes</a></li>
          <li><a href="{{ route('docentes.index') }}"><i class="material-icons blue-text text-darken-2">work</i>Docentes</a></li>
          <li><a href="{{ route('clases.index') }}"><i class="material-icons blue-text text-darken-2">import_contacts</i>Clases</a></li>
        </ul>
      </div>
    </li>
    <li>
      <div class="collapsible-header"><i class="material-icons">location_city</i>Escolares</div>
      <div class="collapsible-body">
        <ul>
          <li><a href="{{ route('asignaturas.index') }}"><i class="material-icons blue-text text-darken-2">create</i>Asignaturas</a></li>
          <li><a href="{{ route('periodos.index') }}"><i class="material-icons blue-text text-darken-2">date_range</i>Periodos</a></li>
          <li><a href="{{ route('especialidades.index') }}"><i class="material-icons blue-text text-darken-2">build</i>Especialidades</a></li>  
        </ul>
      </div>
    </li>
    <li>
      <div class="collapsible-header"><i class="material-icons">settings</i>Configuraciones</div>
      <div class="collapsible-body">
        <ul>
          <li><a href="{{ route('estados_estudiantes.index') }}"><i class="material-icons blue-text text-darken-2">school</i>Estados de estudiante</a></li>
          <li><a href="{{ route('titulos_docentes.index') }}"><i class="material-icons blue-text text-darken-2">work</i>Títulos de profesor</a></li>
          <li><a href="{{ route('tipos_examenes.index') }}"><i class="material-icons blue-text text-darken-2">description</i>Tipos de exámenes</a></li>
          <li><a href="{{ route('oportunidades.index') }}"><i class="material-icons blue-text text-darken-2">autorenew</i>Oportunidades de clase</a></li>
          <li><a href="{{ route('niveles_academicos.index') }}"><i class="material-icons blue-text text-darken-2">class</i>Niveles y grados</a></li>
        </ul>
      </div>
    </li>
    <li><div class="divider"></div></li>
    <li>
      <div class="collapsible-header"><i class="material-icons">account_circle</i>Cuenta</div>
      <div class="collapsible-body">
        <ul>
          <li><a href="{{route('logout')}}"><i class="material-icons blue-text text-darken-2">power_settings_new</i>Salir</a></li>
        </ul>
      </div>
    </li>
  </ul>
</ul>