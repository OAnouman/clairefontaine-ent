@extends('layouts.parent.parent_master')



@section('breadcrumb')
    
    
    <li>
        
        <a href="{{ route('home') }}"> <span class="glyphicon glyphicon-dashboard"></span> Tableau de bord</a>
    
    </li>

    <li>
    
        <a href="{{ route('message_center_parent.index') }}"> <span class="glyphicon glyphicon-comment"></span>
            
            Centre de messagerie
        
        </a>

    </li>
    
    <li>
    
        <i class="fa fa-comment-o" aria-hidden="true"></i>
        
        Conversation avec
    
        @if ($messageThread->recipientUser->userable instanceof App\Student)
        
            {{ $messageThread->originatorUser->lastname . ' ' . $messageThread->originatorUser->firstname }}
    
        @else
        
            {{ $messageThread->recipientUser->lastname . ' ' . $messageThread->recipientUser->firstname }}
    
        @endif
    
    </li>


@endsection


@section('work-section')
    
    
    <div class="row heading">
        
        <div class="col-md-8">
            
            <h3>
    
                Conversation avec
    
                @if ($messageThread->recipientUser->userable instanceof App\Student)
        
                    {{ $messageThread->originatorUser->lastname . ' ' . $messageThread->originatorUser->firstname }}
    
                @else
        
                    {{ $messageThread->recipientUser->lastname . ' ' . $messageThread->recipientUser->firstname }}
    
                @endif
                
                <br> <small>Envoyer un message au professeur  </small>
            
            </h3>
        
        </div>
        
        <div class="col-md-4 pull-right">
            
            <h3 class="text-right"> {{ $student->classrooms()->latest()->first()->name }} </h3>
        
        </div>
    
    
    </div>
    
    <div class="row content">
    
    
        <div class="col-md-8 col-md-offset-2">
        
        
            <div class="message-form">
            
            
                <form>
                
                
                    <input type="hidden" name="message_thread_id" value="{{ $messageThread->id }}"/>
                
                    <input type="hidden" name="originator" value="{{ Auth::user()->id }}"/>
                
                    <input type="hidden" name="recipient"
                           value="{{ $messageThread->recipient == Auth::user()->id ? $messageThread->originator : $messageThread->recipient }}"/>
                
                
                    <label class="control-label" for="body">Envoyer un message</label>
                
                    <div class="form-group">
                    
                    
                        <textarea @keyUp="allowSendingMessage" class="form-control" rows="5" placeholder="Message" name="body"></textarea>
                
                
                    </div>
                
                    <div class="pull-right">
                    
                        <button @click="onMessageSubmit($event)" class="btn btn-success send-button"
                                data-loading-text="Envoi en cours..." type="button" disabled>
                        
                            <i class="fa fa-paper-plane-o" aria-hidden="true"></i> &nbsp; Envoyer
                    
                        </button>
                 
                    </div>
            
            
                </form>
        
        
            </div>
    
    
        </div>
    
        <div class="col-md-8 col-md-offset-2">
        
        
            <ul class="message-thread list-unstyled">
            
            
                @foreach ($messages as $message)
                
                
                    <li class="message-item
                    
                        {{ $message->originatorUser->userable instanceof App\Student ? '' : 'bg-muted' }}">
                    
                    
                        <div class="message-sender col-md-12">
                        
                        
                            @if ($message->originatorUser->userable instanceof App\Student)
                            
                                <div class="timestamp text-left col-md-4">
                                
                                    <em class="text-muted">{{ $message->created_at->format('d-m-Y à h:i') }}</em>
                            
                                </div>
                            
                                <div class="sender col-md-8 text-right"> Moi </div>
                        
                            @else
                            
                                <div class="sender col-md-8 text-left">
                                
                                    {{ $message->originatorUser->lastname . ' ' . $message->originatorUser->firstname }}
                            
                                </div>
                            
                                <div class="timestamp col-md-4 text-right">
                                
                                    <em class="text-muted">{{ $message->created_at->format('d-m-Y à h:i') }}</em>
                            
                                </div>
                        
                            @endif
                    
                        </div>
                    
                        <hr>
                    
                        <p class="message-text">
                        
                        
                            {{ $message->body }}
                    
                    
                        </p>
                
                
                    </li>
            
            
                @endforeach
        
        
            </ul>
    
    
    
        </div>
    
    
    </div>


@endsection