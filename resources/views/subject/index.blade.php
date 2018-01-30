@extends('layouts.admin_master')


@section('breadcrumb')
    
    
    <li>
        
        <a href="{{ route('home') }}">Accueil</a>
    
    </li>
    
    <li>
        
        Paramètres
    
    </li>
    
    <li>
        
        <a href="{{ route('subject.index') }}">Matières</a>
    
    </li>




@endsection


@section('work-section')
    
    
    
    
    <panel-default>
        
        {{-- Panel Header --}}
        
        <template slot="header">
            
            Matières
        
        </template>
        
        
        {{-- Panel Body --}}
        
        
        @include('layouts.display-message')
    
        <div class="row">
        
        
            <div class="col-md-9">
            
                <p>
                
                    <strong>
                    
                        {{ $subjects->firstItem() . ' à ' .
                        $subjects->lastItem() . ' sur ' . $subjects->total() }} matières
                
                    </strong>
            
                </p>
        
            </div><!-- Pagination state -->
        
            <div class="col-md-3 pull-right">
    
    
                <a href="{{ route('subject.create') }}" class="btn btn-success pull-right">
        
        
                    Créer
    
    
                </a>
        
            </div>
    
    
        </div>
        
        
        <table class="table table-responsive table-hover table-condensed">
            
            
            <thead>
            
                <tr>
    
    
                    <td class="col-md-1">
        
                        #
    
                    </td>
    
                    <td class="col-md-5">
        
        
                        <strong>
            
                            Libellé
        
                        </strong>
    
    
                    </td>
    
                    <td class="col-md-4">
        
        
                        <strong>
            
                            Catégorie
        
                        </strong>
    
    
                    </td>
    
    
                    <td></td>
    
                    <td></td>
                    
                    
                </tr>
            
            </thead>
            
            <tbody>


                @foreach($subjects as $subject)
    
    
                <tr>
        
        
                    <td>
            
            
                        {{ $subject->id }}
        
        
                    </td>
        
                    <td>
            
            
                        {{ $subject->name }}
        
        
                    </td>
        
                    <td>
            
            
                        {{ $subject->category }}
        
        
                    </td>
        
                    <td>
            
            
                        <a href="{{ route('subject.edit',[$subject->id]) }}"
                           title="{{ 'Modifier ' . $subject->name }}" data-toggle="tooltip"
                           data-placement="top">
                
                
                            <span class="glyphicon glyphicon-edit " aria-hidden="true"></span>
            
            
                        </a>
        
        
                    </td>
        
                    <td>
            
            
                        <a v-on:click.prevent="deleteForm($event)" href="#"
                           title="{{ 'Supprimer ' . $subject->name }}" data-toggle="tooltip"
                           data-placement="top">
                
                
                            <span  class="glyphicon glyphicon-remove text-danger" aria-hidden="true"></span>
                
                
                            {{--Form for requesting school year deletion --}}
                
                            <form action="{{ route('subject.destroy',[$subject->id]) }}"
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
        
        
        {{ $subjects->links() }}
    
    </panel-default>




@endsection
