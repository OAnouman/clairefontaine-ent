<div class = "col-md-2 sidebar-menu">
    
    
    <nav class = "navbar-default">
        
        
        <div class = "container-fluid sidenav-container">
            
            
            <div class = "navbar-collapse" id = "side-navbar-collapse">
                
                
                <ul class = "nav nav-pills nav-stacked">
                    
                    
                    <li role="presentation"
                        class="{{ request()->is('admin/student') || request()->is('admin/student/*')  ||  request()->is('admin/import')
                        ? 'active' : ''}}">
                        
                        <a data-toggle="collapse" data-target="#student-submenu"
                           aria-controls="student-submenu" aria-expanded = "false" href = "#student-submenu">
                            
                            
                            Elèves
                            
                            <span class = "caret pull-right"></span>
                        
                        
                        </a>
                        
                        <ul class = "collapse list-unstyled submenu {{ request()->is('admin/student')  ||  request()->is('admin/import') ? 'in' : ''}} "
                            id="student-submenu" >
    
                            <li class="{{ request()->is('admin/student') ? 'active' : ''}}">
        
                                <a href = "{{ route('student.index') }}">Liste des élèves</a>
    
                            </li>
                            
                            <li class="{{ request()->is('admin/student/create') ? 'active' : ''}}">
                                
                                <a href = "{{ route('student.create') }}">Nouvel élève</a>
                            
                            </li>
    
                            <li class="{{ request()->is('admin/import') ? 'active' : ''}}">
        
                                <a href = "{{ route('student.import') }}">Importer des données </a>
    
                            </li>
                            
                        
                        </ul>
                    
                    
                    </li> <!-- End Eleves dropdown -->
    
                    <li role="presentation"
                        class="{{ request()->is('admin/classroom') || request()->is('admin/classroom/*') || request()->is('admin/classroom_student')
                        ? 'active' : ''}}">
        
                        <a data-toggle="collapse" data-target="#classroom-submenu"
                           aria-controls="classroom-submenu" aria-expanded = "false" href = "#classroom-submenu">
            
            
                            Classes
    
                            <span class = "caret pull-right"></span>
        
        
                        </a>
        
                        <ul class = "collapse list-unstyled submenu
                            {{ request()->is('admin/classroom/*') || request()->is('admin/classroom') || request()->is('admin/classroom_student')
                            ? 'in' : ''}}"
                            id="classroom-submenu">
            
                            <li class="{{ request()->is('admin/classroom') ? 'active' : ''}}">
                
                                <a href = "{{ route('classroom.index') }}">Liste des classes</a>
            
                            </li>
            
                            <li class="{{ request()->is('admin/classroom/create') ? 'active' : ''}}">
                
                                <a href = "{{ route('classroom.create') }}">Nouvelle classe</a>
            
                            </li>
            
                            <li class="{{ request()->is('admin/classroom_student') ? 'active' : ''}}">
                
                                <a href = "{{ route('classroom_student.index') }}">Listes de classe</a>
            
                            </li>
        
        
                        </ul>
    
    
                    </li> <!-- End Classes dropdown -->
                    
                    <li class="sr-only"><a href = "#">Absences</a></li>
                    
                    <li class ="sr-only"><a href = "#">Notes</a></li>
                    
                    <li class="disabled"><a href = "#">Outils</a></li>
                    
                    <li role="presentation"
                        class="{{ request()->is('admin/user') ||  request()->is('register') ||
                        request()->is('admin/user/*') ? 'active' : ''}}">
                        
                        
                        <a  data-toggle="collapse" data-target="#user-submenu"
                            aria-controls="user-submenu" aria-expanded = "false" href = "#user-submenu">
                            
                            
                            Utilisateurs
    
                            <span class = "caret pull-right"></span>
                        
                        
                        </a>
                        
                        <ul class = "collapse list-unstyled submenu {{ request()->is('admin/user') ||  request()->is('register') ||
                        request()->is('admin/user/*') ? 'in' : ''}}"
                            id="user-submenu">
                            
                            
                            <li class="{{ request()->is('register') ? 'active' : ''}}">
                                
                                <a href = "{{ route('register') }}">Nouvel utilisateur</a>
                            
                            </li>
                            
                            <li class="{{ request()->is('admin/user') ? 'active' : ''}}">
                                
                                <a href = "{{ route('user.index') }}">Liste des utilisateurs</a>
                            
                            </li>
                        
                        </ul>
                    
                    
                    </li> <!-- Utilisateur -->
                    
                    
                    <li role="presentation" class="{{ request()->is('admin/settings/*')
                        ? 'active' : ''}}">
                        
                        
                        <a  data-toggle="collapse" data-target="#settings-submenu"
                            aria-controls="settings-submenu" aria-expanded = "false" href = "#settings-submenu">
                            
                            
                            Paramètres
                            
                            <span class = "caret pull-right"></span>
                        
                        
                        </a>
                        
                        
                        <ul class = "collapse list-unstyled submenu {{ request()->is('admin/settings/*')
                        ? 'in' : ''}}"
                            id="settings-submenu">
                            
                            
                            <li class="{{ request()->is('admin/settings/school_year')
                                || request()->is('admin/settings/school_year/*')
                                ? 'active' : ''}}">
                                
                                <a href = "{{ route('school_year.index') }}">Année scolaire</a>
                            
                            </li>
                            
                            
                            <li class="{{ request()->is('admin/settings/school_year_period')
                                || request()->is('admin/settings/school_year_period/*')
                                ? 'active' : ''}}">
                                
                                <a href = "{{ route('school_year_period.index') }}">Découpage annuel</a>
                            
                            </li>
                            
                            
                            <li role = "separator" class = "divider"></li>
                            
                            <li class="{{ request()->is('admin/settings/level')
                                || request()->is('admin/settings/level/*')
                                ? 'active' : ''}}">
                                
                                <a href = "{{ route('level.index') }}">Niveaux</a>
                            
                            </li>
                            
    
                            <li role = "separator" class = "divider"></li>
    
                            <li class="{{ request()->is('admin/settings/subject')
                                || request()->is('admin/settings/subject/*')
                                ? 'active' : ''}}">
        
                                <a href = "{{ route('subject.index') }}">Matières</a>
    
                            </li>
    
                            <li class="{{ request()->is('admin/settings/level_subject')
                                || request()->is('admin/settings/level_subject/*')
                                ? 'active' : ''}}">
        
                                <a href = "{{ route('level_subject.index') }}">Matières niveaux</a>
    
                            </li>
    
                            <li role = "separator" class = "divider"></li>
                            
                            <li class="{{ request()->is('admin/settings/teacher')
                                || request()->is('admin/settings/teacher/*')
                                ? 'active' : ''}}">
                                
                                <a href = "{{ route('teacher.index') }}">Enseignants</a>
                            
                            </li>
                            
                            <li class="{{ request()->is('admin/settings/classroom_teacher')
                                || request()->is('admin/settings/classroom_teacher/*')
                                ? 'active' : ''}}">
                                
                                <a href = "{{ route('classroom_teacher.index') }}">Matières enseignants</a>
                            
                            </li>
                        
                        
                        </ul>
                    
                    
                    </li> <!-- End paramtres dropdown -->
                
                
                </ul> <!-- End nav -->
            
            
            </div> <!-- End navbar section -->
        
        
        </div> <!-- End container -->
    
    
    </nav>  <!-- End nav-bar -->


</div>