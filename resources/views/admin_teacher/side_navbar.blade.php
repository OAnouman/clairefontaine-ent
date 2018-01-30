<div class="row">
    
    
    
    <div class="col-md-10 side-navbar-header">
    
    
       <a class="navbar-title clearfix text-uppercase" href="{{ route('home') }}">
           
           
           Clairefontaine ENT
        
        
       </a>
    
    
    </div>
    
    <div class="col-md-12 side-navbar-menu">
    
    
       <ul class="nav nav-pills nav-stacked menu">
    
          
          
           <li role="presentation"
               class="{{ request()->is('admin_teacher/classroom')
                || request()->is('admin_teacher/classroom/*')? 'active' : ''}}">
            
               <a href="{{ route('teacher_classroom.index') }}">
                
                   <span class="glyphicon glyphicon-folder-open"></span> &nbsp; Mes Classes
            
               </a>
        
           </li>
        
           <li role="presentation">
               
               
               <a href="#">
        
                   <span class="glyphicon glyphicon glyphicon-calendar"></span> &nbsp; Mon Planning
    
               </a>
               
           
           </li>
        
           <li role="presentation" class="{{ request()->is('admin_teacher/evaluation')
                || request()->is('admin_teacher/evaluation/*')? 'active' : ''}}">
    
    
               <a href="{{ route('evaluation.index') }}">
        
                   <span class="glyphicon glyphicon glyphicon-star-empty"></span> &nbsp; Evaluation
    
               </a>
           
               
           </li>
        
           <li role="presentation"
               class="{{ request()->is('admin_teacher/message_center')
                || request()->is('admin_teacher/message_center/*')? 'active' : ''}}">
    
    
               <a href="{{ route('message_center.index') }}">
        
                   <span class="glyphicon glyphicon glyphicon-comment"></span> &nbsp; Centre de messagerie
    
               </a>
               
               
           </li>
        
           <li role="presentation">
    
    
               <a href="#">
        
                   <span class="glyphicon glyphicon glyphicon-share"></span> &nbsp; Partage
    
               </a>
               
               
           </li>
    
    
       </ul>
       
       
    </div>
    
   <div class="" style="width: 100%; position: absolute; bottom: 0">
    
    
    
    
    
    </div>



</div>

