@extends('layouts.admin_master')


@section('breadcrumb')
    
    
    <li>
        
        <a href="{{ route('home') }}">Accueil</a>
    
    </li>
    
    <li>
        
        Elèves
    
    </li>
    
    <li>
        
        <a href="{{ route('student.index') }}">Liste des élèves</a>
    
    </li>
    
    @if( request('search')  )
    
    
        <li>
                
                
            Recherche : {{ request('search') }}
                
          
        </li>
        
        
    @endif

    
@endsection


@section('work-section')
    
    
    
    
    <panel-default>
        
        {{-- Panel Header --}}
        
        <template slot="header">
            
            Liste des élèves
        
        </template>
        
        
        {{-- Panel Body --}}
        
        
        <!-- Message boxes -->

        @include('layouts.display-message')
        
        {{-- Search form and create button --}}
        
        <div class="row" style="margin-bottom: 10px">
    
    
            <div class="col-md-11">
        
        
                <form method="GET" action="{{ route('student.index') }}" class="form-horizontal">
            
            
                    <div class="col-md-6" style="padding-left : 0px;">
    
    
                       <div class="input-group">
        
        
                           <input name="search" type="search" placeholder="Rechercher..." class="form-control"
                                  data-toggle="tooltip" data-placement="top"
                                  title="La recherche s'effectue sur le matricule, le nom, les prénoms et le sexe">
        
                           <span class="input-group-btn">
                       
                                <button class="btn btn-default" type="submit">
                                    
                                        
                                    <span class="glyphicon glyphicon-search"></span>
                                    
                                    
                                </button>
                           
                           </span>
    
    
                       </div>
                       
                       
                    </div>
    
                    <div  class="checkbox col-md-5">
        
        
                        <label>
            
            
                            <input  name="removed_only" {{ \request()->input('removed_only') ? 'checked' : '' }}
                                    type="checkbox"> Uniquement les élèves radiés
        
        
                        </label>
    
    
                    </div>
        
        
                </form>
    
    
            </div>
    
           
    
    
            {{-- Create button --}}
    
            <div class="col-md-1 pull-right" >
        
                <a href="{{ route('student.create') }}" class="btn btn-success pull-right">
            
            
                    Créer
        
        
                </a>
    
            </div>
            
            
        </div> <!-- End search and create button -->
        
        <div class="row">
        
        
            <div class="col-md-12">
    
                <p>
                    
                    <strong>
        
                        {{ $students->firstItem() . ' à ' . $students->lastItem() . ' sur ' . $students->total() }} élèves
                        
                    </strong>
                    
                </p>
                
            </div>
        
        
        </div> <!-- Pagination state -->
        
        
        <table class="table table-responsive table-hover table-condensed">
            
            
            <thead>
            
            
                <tr>
    
    
                    <td class="col-md-1">
        
        
                        <strong>
            
                            Matricule
        
                        </strong>
    
    
                    </td>
    
                    <td class="col-md-6">
        
        
                        <strong>
            
                            Nom Prènoms
        
                        </strong>
    
    
                    </td>
    
                    <td class="col-md-2">
        
        
                        <strong>
            
                            Date naissance
        
                        </strong>
    
    
                    </td>
    
                    <td class="col-md-1">
        
        
                        <strong>
            
                            M. Père
        
                        </strong>
    
    
                    </td>
    
                    <td class="col-md-1">
        
        
                        <strong>
            
                            M. Mère
        
                        </strong>
    
    
                    </td>
    
    
                    <td></td>
    
                    <td></td>
    
                    <td></td>
                    
                    
                </tr>
            
            
            </thead>
            
            <tbody>
            
                @foreach($students as $student)
                    
                    
                    <tr class="{{ $student->is_removed ? 'bg-removed' : '' }}"
                        data-toggle="{{ $student->is_removed ? 'tooltip' : '' }}" data-placement="top"
                        title="{{ $student->is_removed ? 'Cette élève à été radié.' : '' }}">
                        
                        
                      
                        
                        <td>
                            
                            
                            {{ $student->reg_number }}
                        
                        
                        </td>
                        
                        <td>
                            
                            
                            {{ $student->lastname . ' ' . $student->firstname }}
                        
                        
                        </td>
        
                        <td>
            
            
                            {{ $student->birth_date }}
        
        
                        </td>
        
                        <td>
            
            
                            {{ $student->getFirstFatherNumber() }}
        
        
                        </td>
        
                        <td>
            
            
                            {{ $student->getFirstMotherNumber() }}
        
        
                        </td>
        
                        <td>
            
            
                            <a href="{{ route('student.show',[$student->id]) }}"
                               title="{{ 'Voir le profil de ' . $student->firstname . ' ' . $student->lastname }}"
                               data-toggle="tooltip" data-placement="top">
                
                
                                <span class="glyphicon glyphicon-eye-open text-success" aria-hidden="true"></span>
            
            
                            </a>
        
        
                        </td>
                        
                        <td>
                            
                            
                            <a href="{{ route('student.edit',[$student->id]) }}"
                               title="{{ 'Modifier ' . $student->firstname . ' ' . $student->lastname }}"
                               data-toggle="tooltip" data-placement="top">
                                
                                
                                <span class="glyphicon glyphicon-edit " aria-hidden="true"></span>
                            
                            
                            </a>
                        
                        
                        </td>
                        
                        <td>
                            
                            
                            <a @click.prevent="deleteForm($event)" href="#"
                               title="{{ 'Supprimer ' . $student->firstname . ' ' . $student->lastname }}"
                               data-toggle="tooltip" data-placement="top">
                                
                                
                                <span  class="glyphicon glyphicon-remove text-danger" aria-hidden="true"></span>
                                
                                
                                {{--Form for requesting school year deletion --}}
                                
                                <form action="{{ route('student.destroy',[$student->id]) }}"
                                      method="POST">
                                    
                                    
                                    {{ csrf_field() }}
                                    
                                    <input name="_method" type="hidden" value="DELETE">
                                
                                
                                </form>
                            
                            
                            </a>
                        
                        
                        
                        </td>
                        
                        
                    
                    
                    
                    </tr>
                
                
                @endforeach


            </tbody>
            
        
        </table>
        
        
        {{ $students->links() }}
    
    </panel-default>




@endsection
