<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
        {{-- <h3>General</h3> --}}
        <ul class="nav side-menu">
            <li>
                <a href="{{ route('super.admin.dashboard') }}">
                    <i class="fa fa-dashboard"></i>
                    Dashboard
                </a>
            </li>
            <li>
                <a><i class="fa fa-circle-o"></i> Services <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{ route('divisions.index') }}">Divisions </a></li>
                    <li><a href="{{ route('super.admin.learning.specialty') }}">Learning Specialty</a></li>
                    <li><a href="{{ route('units.index') }}">Units</a></li>
                    <li><a href="{{ route('unitscapacity.index') }}">Capacity</a></li>
                </ul>
            </li>
            <li>
                <a>
                    <i class="fa fa-circle-o"></i> Trainee <span class="fa fa-chevron-down"></span>
                </a>
                <ul class="nav child_menu">
                    <li><a href="{{ route('super.admin.type.programs') }}">Types Of Programs </a></li>
                    <li><a href="{{ route('trainee.index') }}">Lists Trainee</a></li>
                    <li><a href="{{ route('trainee.create') }}">Add Trainee </a></li>
                    <li><a href="{{ route('super.admin.trainee.import') }}">Import Trainee</a></li>
                </ul>
            </li>
            <li>
                <a href="{{ route('rotation.index') }}">
                    <i class="fa fa-circle-o"></i>
                    Rotations
                </a>
            </li>
            <li>
                <a href="{{ route('super.admin.reporting.index') }}">
                    <i class="fa fa-circle-o"></i>
                    Reporting
                </a>
            </li>
      </ul>
    </div>

  </div>
