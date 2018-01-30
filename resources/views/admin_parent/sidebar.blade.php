

<div class="col-md-12 side-navbar-menu">
    
    
    <ul class="nav nav-pills nav-stacked menu">
        
        
        
        <li role="presentation"
            class="{{ request()->is('admin_parent') ? 'active' : ''}}">
            
            <a href="{{ route('parent.dashboard') }}">
                
                <span class="glyphicon glyphicon-dashboard"></span> &nbsp; Tableau de bord
            
            </a>
        
        </li>
        
        <li role="presentation"
            class="{{ request()->is('admin_parent/evaluation/*') ? 'active' : ''}}">
            
            
            <a href="#evaluationSubMenu" role="button" data-toggle="collapse"
                aria-expanded="{{ request()->is('admin_parent/evaluation/*') ? 'true' : 'false'}}" aria-controls="evaluationSubMenu">
                
                <span class="glyphicon glyphicon-star-empty"></span> &nbsp; Mes Evaluations
                
                
                <span class="caret pull-right"></span>
            
            </a>
    
            <ul class="nav nav-pills nav-stacked menu collapse submenu
                {{ request()->is('admin_parent/evaluation/*') ? 'collapse in' : ''}}"
                id="evaluationSubMenu" aria-expanded="{{ request()->is('admin_parent/evaluation/*') ? 'true' : 'false'}}">
            
                
                
                @foreach( \App\SchoolYear::latest()->first()->schoolYearPeriods as $period)
        
        
                    <li role="presentation"
                        class="{{ request()->is('admin_parent/evaluation/' . $period->id . '/*') ? 'active' : ''}}">
            
                        <a href="{{ route('parent.evaluation', [ $period->id,
                        auth()->user()->userable->classrooms()->latest()->first()->id]) }}">
                            <span class="glyphicon glyphicon-calendar"></span> {{ $period->name }} </a>
        
                    </li>
                
                
                @endforeach
               
                
            </ul>
            
        
        
        </li>
        
        <li role="presentation" class=" disabled {{ request()->is('admin_teacher/evaluation')
            || request()->is('admin_teacher/evaluation/*')? 'active' : ''}}" disabled>
            
            
            <a href="{{ route('evaluation.index') }}">
                
                <span class="glyphicon glyphicon-education"></span> &nbsp; Mes Bulletins
            
            </a>
        
        
        </li>
        
        <li role="presentation"
            class="{{ request()->is('admin_parent/message_center_parent')
             || request()->is('admin_parent/message_center_parent/*')? 'active' : ''}}">
            
            
            <a href="{{ route('message_center_parent.index') }}">
                
                <span class="glyphicon glyphicon-comment"></span> &nbsp; Centre de Messagerie
            
            </a>
        
        
        </li>
        
        <li role="presentation" class="disabled">
    
    
            <a href="#">
        
                <span class="glyphicon glyphicon-share"></span> &nbsp; Partage
    
            </a>


        </li>

        <li role="presentation" class="disabled">
    
    
            <a href="#">
        
                <span class="glyphicon glyphicon-time"></span> &nbsp; Mon Historique
    
            </a>


        </li>
    
    
    </ul>


</div>

<div class="" style="width: 100%; position: absolute; bottom: 0">





</div>





