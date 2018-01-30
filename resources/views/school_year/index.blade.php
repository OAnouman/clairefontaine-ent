@extends('layouts.admin_master')



@section('breadcrumb')
    
    
    <li>
        
        <a href = "{{ route('home') }}">Accueil</a>
    
    </li>
    
    <li>
        
        Paramètres
    
    </li>
    
    <li>
        
        <a href = "{{ route('school_year.index') }}">Année scolaire</a>
    
    </li>

@endsection


@section('work-section')
    
    
    <panel-default>
        
        
        <!-- Panel header -->
        
        
        <template slot = "header">
            
            Nouvelle année scolaire
        
        </template>
        
        
        <!-- Panel content -->
        
        
        @include('layouts.display-message')
        
        <div class="row">
        
        
            <div class="col-md-9">
            
                <p>
                
                    <strong>
                    
                        {{ $schoolYears->firstItem() . ' à ' . $schoolYears->lastItem() . ' sur ' . $schoolYears->total() }} années
                
                    </strong>
            
                </p>
        
            </div><!-- Pagination state -->
    
            <div class="col-md-3 pull-right">
    
                <a href = "{{ route('school_year.create') }}" class = "btn btn-success pull-right">
        
        
                    Créer
    
    
                </a>
                
            </div>
            
            
        </div>
        
        
        <table class = "table table-responsive table-hover table-condensed">
            
            
            <thead>
            
               <tr>
    
    
                   <td class = "col-md-1">
        
        
                       <strong>
            
                           #
        
                       </strong>
    
    
                   </td>
    
                   <td class = "col-md-9">
        
        
                       <strong>
            
                           Libellé
        
                       </strong>
    
    
                   </td>
    
                   <td></td>
    
                   <td></td>
                   
                   
               </tr>
            
            </thead>
            
            <tbody>


                @foreach($schoolYears as $schoolYear)
    
    
                <tr>
        
        
                    <td>
            
            
                        {{ $schoolYear->id }}
        
        
                    </td>
        
                    <td>
            
            
                        {{ $schoolYear->name }}
        
        
                    </td>
        
                    <td>
            
            
                        <a href = "{{ route('school_year.edit',[$schoolYear->id]) }}"
                           title = "{{ 'Modifier ' . $schoolYear->name }}" data-toggle="tooltip"
                           data-placement="top">
                
                
                            <span class = "glyphicon glyphicon-edit " aria-hidden = "true"></span>
            
            
                        </a>
        
        
                    </td>
        
                    <td>
            
            
                        <a v-on:click.prevent = "deleteForm($event)" href = "#"
                           title = "{{ 'Supprimer ' . $schoolYear->name }}" data-toggle="tooltip"
                           data-placement="top">
                
                
                            <span class = "glyphicon glyphicon-remove text-danger" aria-hidden = "true"></span>
                
                
                            {{--Form for requesting school year deletion --}}
                
                            <form id = "{{ 'school-year' . $schoolYear->id }}"
                                  action = "{{ route('school_year.destroy',[$schoolYear->id]) }}"
                                  method = "POST">
                    
                    
                                {{ csrf_field() }}
                    
                                <input name = "_method" type = "hidden" value = "DELETE">
                
                
                            </form>
            
            
                        </a>
        
        
                    </td>
    
    
                </tr>


            @endforeach


            </tbody>
        
        </table>
    
    
    </panel-default>
    
    
    {{ $schoolYears->links() }}


@endsection