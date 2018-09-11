@extends('layouts.parent.parent_master')



@section('breadcrumb')
    
    
    <li>
        
        <a href="{{ route('home') }}"> <span class="glyphicon glyphicon-dashboard"></span> Tableau de bord </a>
    
    </li>
    
    <li>
        
        <span class="glyphicon glyphicon-comment"></span> Centre de messagerie
    
    </li>
    
    
@endsection


@section('work-section')
    
    
    <div class="row heading">
        
        <div class="col-md-8">
            
            <h3>
                
                Centre de messagerie <br> <small>Lire et envoyer des messages aux professeurs</small>
            
            </h3>
        
        </div>
        
        <div class="col-md-4 pull-right">

            <h3 class="text-right"> {{ $student->classrooms->count() ?
             $student->classrooms()->latest()->first()->name : 'Pas de classe'}} </h3>
        
        </div>
    
    
    </div>
    
    <div class="row content">
    
        <div class="row">
        
        
            <div class="col-md-12">
            
            
                <div class="pull-right">
                
                
                    <button @click="submitMessageThreadForm" class="btn btn-success" type="button">
                    
                        <i class="fa fa-comment-o" aria-hidden="true"></i> Nouveau message
                
                    </button>
            
            
                </div>
            
                <form id="message-thread-form" method="POST" action="{{ route('message_center_parent.store') }}">
                
                
                    {{ csrf_field() }}
                
                    <div class = "form-group col-md-4 pull-right">
                    
                    
                        <label class="sr-only" for = "recipient">
                        
                            Destinataire
                    
                        </label>
                    
                        <select required id = "recipient" title = "Professeur..." data-live-search = "true"
                                class = "form-control selectpicker show-tick" name = "recipient">
                        
                        
                            @foreach($teachers as $teacher )
                            
                            
                                <option data-tokens="{{ $teacher->lastname . ' ' . $teacher->firstname }}"
                                        data-subtext="{{ App\Subject::find($teacher->pivot->subject_id)->name }}"
                                        value = "{{ $teacher->user->id }}">
                                    
                                    {{ $teacher->lastname . ' ' . $teacher->firstname }}</option>
                        
                        
                            @endforeach
                    
                    
                        </select>
                
                
                    </div> <!-- End recipient -->
            
            
                </form>
        
        
            </div>
    
    
        </div>
    
        <table class="message-thread-list table table-responsive table-hover">
        
        
            <thead>
        
        
            <tr>
            
            
            
                <th class="col-md-3 text-uppercase">
                
                    <strong>
                    
                        Destinataire
                
                    </strong>
            
                </th>
            
                <th class="col-md-2 text-uppercase">
                
                    <strong>
                    
                        Dernière activité
                
                    </strong>
            
                </th>
            
                <th class="col-md-7 text-uppercase">
                
                    <strong>
                    
                        Dernier message
                
                    </strong>
            
                </th>
            
                <th>
            
            
            
                </th>
        
        
            </tr>
        
        
            </thead>
        
            <tbody>
            
            @php (\Carbon\Carbon::setLocale('fr'))
            
            
            @foreach($messageThreads as $messageThread)
            
            
                <tr @click="showMessageThread($event)" style="cursor: pointer;"
                    data-href="{{ route('message_center_parent.show', $messageThread->id) }}">
                
                
                    <td>
                    
                    
                        @if ( $messageThread->originatorUser->userable instanceof App\Teacher ) {{-- If originator is a teacher --}}
    
                    
                            <img src="{{ Avatar::create($messageThread->originatorUser->lastname . ' '
                                        . $messageThread->originatorUser->firstname)->toBase64() }}"
                                 class="img-circle" width="45" height="45"/>
                    
                            {{  $messageThread->originatorUser->lastname . ' ' . $messageThread->originatorUser->firstname }}
                    
                    
                        @else {{-- If it's not a teacher --}}
                    
                    
                            @if ($messageThread->recipientUser->userable instanceof App\Teacher)
        
                                <img src="{{ Avatar::create($messageThread->originatorUser->lastname . ' '
                                                . $messageThread->originatorUser->firstname)->toBase64() }}"
                                     class="img-circle" width="45" height="45"/>
                        
                            @endif
                    
                            {{  $messageThread->recipientUser->lastname . ' ' . $messageThread->recipientUser->firstname }}
                    
                    
                        @endif
                
                
                    </td>
                
                    <td>
                    
                        {{ $messageThread->messages->count() > 0 ?
                            $messageThread->messages()->latest()->first()->created_at->diffForHumans() :
                              $messageThread->created_at->diffForHumans()}}
                
                    </td>
                
                    <td>
                    
                        {{ $messageThread->messages->count() > 0 ?
                            $messageThread->messages()->latest()->first()->body : ''}}
                
                    </td>
                
                    <td>
                    
                        @if($messageThread->unseenMessages() > 0)
                        
                            <span class="label label-danger">
                                    
                                        {{ $messageThread->unseenMessages() }}
                                    
                                </span>
                    
                        @endif
                
                    </td>
            
            
            
                </tr>
        
        
            @endforeach
        
        
            </tbody>
    
    
        </table>
    
    
    </div>


@endsection