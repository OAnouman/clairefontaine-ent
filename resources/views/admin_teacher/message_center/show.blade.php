@extends('layouts.teacher.teacher_master')



@section('breadcrumb')
    
    
    <li>
        
        <a href="{{ route('home') }}">Accueil</a>
    
    </li>

    <li>
    
        <a href="{{ route('message_center.index') }}">Centre de messagerie</a>

    </li>

    <li>
    
    
        Conversation avec
    
        @if ($messageThread->recipientUser->userable instanceof App\Teacher)
        
            {{ $messageThread->originatorUser->lastname . ' ' . $messageThread->originatorUser->firstname }}
    
        @else
        
            {{ $messageThread->recipientUser->lastname . ' ' . $messageThread->recipientUser->firstname }}
    
        @endif
        
        (Parent)

    </li>


@endsection


@section('work-section')
    
    
    <panel-default>
        
        
        <!-- Panel header -->
        
        
        <template slot = "header">
    
            <i class="fa fa-comment-o" aria-hidden="true"></i> &nbsp; Conversation avec
            
            @if ($messageThread->recipientUser->userable instanceof App\Teacher)
                
                {{ $messageThread->originatorUser->lastname . ' ' . $messageThread->originatorUser->firstname }}
                
            @else
        
                {{ $messageThread->recipientUser->lastname . ' ' . $messageThread->recipientUser->firstname }}
            
            @endif
            
            (Parent)
        
        </template>
        
        
        <!-- Panel content -->
        
        <div class="col-md-8 col-md-offset-2">
    
    
            <div class="message-form">
        
        
                <form>
            
                    
                    <input type="hidden" name="message_thread_id" value="{{ $messageThread->id }}"/>
                    
                    <input type="hidden" name="originator" value="{{ Auth::user()->id }}"/>
                    
                    {{-- If message thread recipicient if equal to current user id
                     
                     then the right recipient id must be the messag thread originator --}}
                    
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
                        {{ $message->originatorUser->userable instanceof App\Teacher ? '' : 'bg-muted' }}">
            
            
                        <div class="message-sender col-md-12">
                
                            
                            @if ($message->originatorUser->userable instanceof App\Teacher)
                                
                                <div class="timestamp text-left col-md-4">
                                
                                    <em class="text-muted">{{ $message->created_at->format('d-m-Y à h:i') }}</em>
                                    
                                </div>
                                
                                <div class="sender col-md-8 text-right"> Moi </div>
                                
                            @else
                                
                                <div class="sender col-md-8 text-left">
                                    
                                    {{ $message->originatorUser->lastname . ' ' . $message->originatorUser->firstname }} (Parent)
                                
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
        
    
    </panel-default>


@endsection